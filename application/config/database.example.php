<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Configuração de banco de dados — TEMPLATE.
 *
 * Copie este arquivo para `database.php` e preencha com as credenciais do
 * seu banco. O arquivo `database.php` está no .gitignore e não será versionado.
 *
 *     cp application/config/database.example.php application/config/database.php
 *
 * Para a estrutura completa, consulte:
 *  https://codeigniter.com/userguide3/database/configuration.html
 */
$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'seu_usuario',
	'password' => 'sua_senha',
	'database' => 'projeto_produtos',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
