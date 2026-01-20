<?php
defined('BASEPATH') OR exit('No direct script access allowed');

declare(strict_types=1);

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function outputJson($data)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}
