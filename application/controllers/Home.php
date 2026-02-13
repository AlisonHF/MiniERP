<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->checkAuth()) {
            redirect(base_url() . 'auth/');
        }
    }

    public function index()
    {
        $this->load->view('home/index');
    }
}
