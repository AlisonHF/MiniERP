<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Gera breadcrumbs automaticamente a partir dos segmentos da URI atual.
 *
 * Mapeamento:
 *  - segmento 1 (módulo): produto, cliente, usuario, venda → vira link para a listagem
 *  - segmento 2 (ação)  : create, edit → vira o item ativo (sem link)
 *  - números (IDs)      : ignorados
 *
 * Para usar manualmente:
 *  echo breadcrumb_helper([
 *      ['label' => 'Início',    'url' => 'home'],
 *      ['label' => 'Vendas',    'url' => 'venda'],
 *      ['label' => 'Cadastrar'],
 *  ]);
 */
if (!function_exists('breadcrumb_helper')) {
    function breadcrumb_helper(?array $items = null): string
    {
        $CI = &get_instance();

        if ($items === null) {
            $items = breadcrumb_auto_items($CI);
        }

        if (empty($items)) {
            return '';
        }

        $html  = '<nav aria-label="breadcrumb" class="page-breadcrumb">';
        $html .= '<div class="container-fluid">';
        $html .= '<ol class="breadcrumb">';

        $total = count($items);

        foreach ($items as $i => $item) {
            $isLast = ($i === $total - 1);
            $label  = htmlspecialchars($item['label']);

            if ($isLast || empty($item['url'])) {
                $html .= '<li class="breadcrumb-item active" aria-current="page">' . $label . '</li>';
            } else {
                $html .= '<li class="breadcrumb-item"><a href="' . site_url($item['url']) . '">' . $label . '</a></li>';
            }
        }

        $html .= '</ol></div></nav>';

        return $html;
    }
}

if (!function_exists('breadcrumb_auto_items')) {
    function breadcrumb_auto_items($CI): array
    {
        $labels = [
            'home'    => 'Início',
            'produto' => 'Produtos',
            'cliente' => 'Clientes',
            'usuario' => 'Usuários',
            'venda'   => 'Vendas',
            'create'  => 'Cadastrar',
            'edit'    => 'Editar',
        ];

        $segment1 = $CI->uri->segment(1);
        $segment2 = $CI->uri->segment(2);

        if (empty($segment1) || in_array($segment1, ['auth', 'register', 'senha'], true)) {
            return [];
        }

        $items = [['label' => 'Início', 'url' => 'home']];

        if ($segment1 !== 'home') {
            $items[] = [
                'label' => $labels[$segment1] ?? ucfirst($segment1),
                'url'   => $segment1,
            ];

            if (!empty($segment2) && !is_numeric($segment2)) {
                $items[] = [
                    'label' => $labels[$segment2] ?? ucfirst($segment2),
                ];
            }
        }

        return $items;
    }
}
