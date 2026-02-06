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

        $assets = $this->detectAssets($view);

        return parent::view('template/template', [
            'content' => $content,
            'css' => $assets['css'],
            'js'  => $assets['js'],
        ], $return);
    }

    /**
     * Summary of detectAssets
     * @param string $view
     * @return array
     * 
     * Padrão de criação de arquivos assets
     * assets/css/modulo/view.css
     * assets/js/modulo/view.js
     */
    private function detectAssets(string $view): array
    {
        $css = [];
        $js  = [];

        $cssPath = FCPATH . "assets/css/{$view}.css";
        $jsPath  = FCPATH . "assets/js/{$view}.js";

        if (file_exists($cssPath)) {
            $css[] = 'css/' . $view;
        }

        if (file_exists($jsPath)) {
            $js[] = 'js/' . $view;
        }

        return compact('css', 'js');
    }

    private function isAjax(): bool
    {
        return (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        );
    }
}
