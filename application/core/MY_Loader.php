<?php
declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader
{
    public function view($view, $vars = [], $return = FALSE)
    {
        // Caso houver alguma view que não utilizara o template padrão, colocar na lista
        $withoutTemplate = [
            'template/template',
        ];

        if (in_array($view, $withoutTemplate)) {
            return parent::view($view, $vars, $return);
        }

        if ($this->isAjax()) {
            return parent::view($view, $vars, $return);
        }

        $content = parent::view($view, $vars, TRUE);

        return parent::view('template/template', [
            'content' => $content
        ], $return);
    }

    private function isAjax(): bool
    {
        return (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        );
    }
}
