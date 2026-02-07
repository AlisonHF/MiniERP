<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
    /**
     * Params:
     * tabela.campo.idCampo.empresaCampo
     * Ex: produtos.nome.id.empresa_id
     */
    public function unique_field(string $value, string $params): bool
    {
        [$table, $field, $idField, $empresaField] = explode('.', $params);

        $CI = &get_instance();

        $id = $CI->input->post($idField);
        $empresaId = $CI->session->userdata('id_empresa');

        if (empty($empresaId)) {
            $this->set_message(
                'unique_field',
                "Ocorreu um erro ao validar o campo {$field}."
            );

            return false;
        }

        $CI->db->where($field, $value);
        $CI->db->where($empresaField, $empresaId);

        if (!empty($id)) {
            $CI->db->where("{$idField} !=", $id);
        }

        $exists = $CI->db->get($table)->row();

        if ($exists) {
            $this->set_message(
                'unique_field',
                "Duplicidade de {$field}!"
            );

            return false;
        }

        return !$exists;
    }
}
