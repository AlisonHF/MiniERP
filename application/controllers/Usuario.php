<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends MY_Controller
{
    public function __construct() 
    {
        parent::__construct();

        if (!$this->checkAuth()) {
            redirect(base_url() . 'auth/');
        }
    }

    public function index(): void
    {
        $this->load->view('usuario/index');
    }

    public function create()
    {
        $this->load->view('usuario/form');
    }

}
