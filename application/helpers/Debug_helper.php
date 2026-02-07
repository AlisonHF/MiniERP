<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('dd')) {
    function dd(...$vars): void
    {
        echo '<style>
            body { background:#111; color:#eee; font-family: monospace; }
            .dd-box { background:#1e1e1e; padding:15px; margin:10px; border-radius:8px; }
            .dd-title { color:#4fc3f7; margin-bottom:8px; }
            pre { white-space: pre-wrap; }
        </style>';

        foreach ($vars as $index => $var) {
            echo '<div class="dd-box">';
            echo '<div class="dd-title">Dump #' . ($index + 1) . '</div>';

            echo '<strong>Tipo:</strong> ' . gettype($var) . '<br><br>';

            echo '<pre>';
            var_dump($var);
            echo '</pre>';

            echo '</div>';
        }

        exit;
    }
}
