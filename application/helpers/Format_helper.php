<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Helpers de formatação para exibição.
 * Os dados são armazenados sem máscara no banco — estas funções aplicam
 * a máscara apenas na hora de mostrar na tela.
 */

if (!function_exists('format_cpf')) {
    function format_cpf(?string $cpf): string
    {
        $digits = preg_replace('/\D/', '', $cpf ?? '');

        if (strlen($digits) !== 11) {
            return $cpf ?? '';
        }

        return substr($digits, 0, 3) . '.' . substr($digits, 3, 3) . '.' . substr($digits, 6, 3) . '-' . substr($digits, 9, 2);
    }
}

if (!function_exists('format_cnpj')) {
    function format_cnpj(?string $cnpj): string
    {
        $digits = preg_replace('/\D/', '', $cnpj ?? '');

        if (strlen($digits) !== 14) {
            return $cnpj ?? '';
        }

        return substr($digits, 0, 2) . '.' . substr($digits, 2, 3) . '.' . substr($digits, 5, 3) . '/' . substr($digits, 8, 4) . '-' . substr($digits, 12, 2);
    }
}

if (!function_exists('format_cep')) {
    function format_cep(?string $cep): string
    {
        $digits = preg_replace('/\D/', '', $cep ?? '');

        if (strlen($digits) !== 8) {
            return $cep ?? '';
        }

        return substr($digits, 0, 5) . '-' . substr($digits, 5, 3);
    }
}

if (!function_exists('format_documento')) {
    function format_documento(?string $documento): string
    {
        $digits = preg_replace('/\D/', '', $documento ?? '');

        if (strlen($digits) === 11) {
            return format_cpf($digits);
        }

        if (strlen($digits) === 14) {
            return format_cnpj($digits);
        }

        return $documento ?? '';
    }
}
