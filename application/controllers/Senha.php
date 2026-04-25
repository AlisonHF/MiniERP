<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Senha extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Usuario_model');
        $this->load->model('PasswordReset_model');
        $this->load->library('form_validation');
        $this->load->library('email');
    }

    public function recuperar(): void
    {
        $this->load->view('senha/solicitar');
    }

    public function enviar()
    {
        $this->onlyPost();

        $email = trim((string) $this->input->post('email'));

        if (empty($email)) {
            return $this->outputJson(['status' => false, 'message' => 'Informe um e-mail.']);
        }

        $usuario = $this->Usuario_model->getByEmail($email);

        if (!$usuario) {
            return $this->outputJson([
                'status'  => true,
                'message' => 'Se o e-mail existir, enviaremos um link de recuperação.',
            ]);
        }

        $token     = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+30 minutes'));

        $this->PasswordReset_model->invalidatePrevious((int) $usuario['id']);

        $dto = new CreatePasswordResetDTO((int) $usuario['id'], $token, $expiresAt);

        if (!$this->PasswordReset_model->store($dto)) {
            return $this->outputJson(['status' => false, 'message' => 'Erro ao gerar token.']);
        }

        $link    = base_url('senha/redefinir/' . $token);
        $assunto = 'Recuperação de senha - WorkUp';
        $corpo   = '<p>Olá, <b>' . htmlspecialchars($usuario['nome']) . '</b>.</p>'
                 . '<p>Recebemos uma solicitação de redefinição de senha.</p>'
                 . '<p>Clique no link abaixo para definir uma nova senha (válido por 30 minutos):</p>'
                 . '<p><a href="' . $link . '">' . $link . '</a></p>'
                 . '<p>Se você não solicitou, ignore este e-mail.</p>';

        $this->email->from(config_item('from_email'), config_item('from_name'));
        $this->email->to($usuario['email']);
        $this->email->subject($assunto);
        $this->email->message($corpo);

        if (!$this->email->send()) {
            log_message('error', 'Falha no envio do e-mail de recuperação: ' . $this->email->print_debugger(['headers']));

            return $this->outputJson([
                'status'  => false,
                'message' => 'Não foi possível enviar o e-mail no momento. Tente novamente mais tarde.',
            ]);
        }

        return $this->outputJson([
            'status'  => true,
            'message' => 'Se o e-mail existir, enviaremos um link de recuperação.',
        ]);
    }

    public function redefinir(string $token = ''): void
    {
        $reset = $this->PasswordReset_model->getValidByToken($token);

        if (!$reset) {
            $this->load->view('senha/redefinir', ['tokenInvalido' => true]);
            return;
        }

        $this->load->view('senha/redefinir', ['token' => $token]);
    }

    public function atualizar()
    {
        $this->onlyPost();

        if (!$this->form_validation->run('senha/atualizar')) {
            return $this->outputJson(['status' => false, 'message' => validation_errors()]);
        }

        $token = (string) $this->input->post('token');
        $senha = (string) $this->input->post('senha');

        $reset = $this->PasswordReset_model->getValidByToken($token);

        if (!$reset) {
            return $this->outputJson([
                'status'  => false,
                'message' => 'Link inválido ou expirado. Solicite um novo.',
            ]);
        }

        $hash = password_hash($senha, PASSWORD_DEFAULT);

        $this->db->trans_begin();

        $update = $this->Usuario_model->updateSenhaById((int) $reset['id_usuario'], $hash);

        if (!$update) {
            $this->db->trans_rollback();
            return $this->outputJson(['status' => false, 'message' => 'Erro ao atualizar senha.']);
        }

        $this->PasswordReset_model->markAsUsed((int) $reset['id']);

        $this->db->trans_commit();

        return $this->outputJson([
            'status'  => true,
            'message' => 'Senha atualizada com sucesso! Faça login novamente.',
        ]);
    }
}
