<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

/***
 * Função dedicada para renderizar a paginação utilizando a biblioteca pagination do CodeIgniter.
 * 
 * @param int $total_rows O total de registros no banco de dados.
 * @param int $per_page O número de registros por página.
 * 
 * @return string Links que são necessários implementar na view
 */
function Render_pagination_helper(int $total_rows, int $per_page)
{
	$CI = &get_instance();
	$CI->load->library('pagination');

	// Config paginacao
	$config['base_url'] = site_url('produto');
	$config['total_rows'] = $total_rows;
	$config['per_page'] = $per_page;

	// Wrapper
	$config['full_tag_open']  = '<nav data-bs-theme="dark"><ul class="pagination">';
	$config['full_tag_close'] = '</ul></nav>';

	// Numeros
	$config['num_tag_open']  = '<li class="page-item">';
	$config['num_tag_close'] = '</li>';

	// Pagina atual
	$config['cur_tag_open']  = '<li class="page-item active" aria-current="page"><span class="page-link">';
	$config['cur_tag_close'] = '</span></li>';

	// Anterior
	$config['prev_tag_open']  = '<li class="page-item">';
	$config['prev_tag_close'] = '</li>';
	$config['prev_link']      = '<span aria-hidden="true">&laquo;</span>';

	// Próximo
	$config['next_tag_open']  = '<li class="page-item">';
	$config['next_tag_close'] = '</li>';
	$config['next_link']      = '<span aria-hidden="true">&raquo;</span>';

	// Primeiro / Ultimo
	$config['first_tag_open']  = '<li class="page-item">';
	$config['first_tag_close'] = '</li>';
	$config['first_link']      = '<span aria-hidden="true">&laquo;</span>';

	$config['last_tag_open']   = '<li class="page-item">';
	$config['last_tag_close']  = '</li>';
	$config['last_link']       = '<span aria-hidden="true">&raquo;</span>';

	// Classe nos a
	$config['attributes'] = ['class' => 'page-link'];

	// Inicialização
	$CI->pagination->initialize($config);

	// links
	$links = $CI->pagination->create_links();

	return $links;
}

