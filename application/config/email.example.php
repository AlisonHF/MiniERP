<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Configuração de envio de e-mail (SMTP) — TEMPLATE.
 *
 * Copie este arquivo para `email.php` e preencha com as credenciais do seu
 * provedor (Gmail, Brevo, Mailtrap, SendGrid, etc.). O arquivo `email.php`
 * está no .gitignore e não será versionado.
 *
 * Exemplos:
 *  - Gmail:     smtp.gmail.com  / 465 / ssl  (usar Senha de App)
 *  - Brevo:     smtp-relay.brevo.com / 587 / tls
 *  - Mailtrap:  sandbox.smtp.mailtrap.io / 2525 / tls
 */
$config['protocol']     = 'smtp';
$config['smtp_host']    = 'smtp.exemplo.com';
$config['smtp_port']    = 587;
$config['smtp_user']    = 'seu_usuario';
$config['smtp_pass']    = 'sua_senha';
$config['smtp_crypto']  = 'tls';
$config['smtp_timeout'] = 10;

$config['mailtype'] = 'html';
$config['charset']  = 'utf-8';
$config['newline']  = "\r\n";
$config['crlf']     = "\r\n";
$config['wordwrap'] = TRUE;

$config['from_email'] = 'no-reply@workup.local';
$config['from_name']  = 'WorkUp';
