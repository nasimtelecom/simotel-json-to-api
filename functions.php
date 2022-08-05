<?php

function varexport($expression, $return=false)
{
    $export = var_export($expression, true);
    $patterns = [
        "/array \(/" => '[',
        "/^([ ]*)\)(,?)$/m" => '$1]$2',
        "/=>[ ]?\n[ ]+\[/" => '=> [',
        "/([ ]*)(\'[^\']+\') => ([\[\'])/" => '$1$2 => $3',
    ];
    $export = preg_replace(array_keys($patterns), array_values($patterns), $export);
    if ((bool)$return) {
        return $export;
    } else {
        echo $export;
    }
}
