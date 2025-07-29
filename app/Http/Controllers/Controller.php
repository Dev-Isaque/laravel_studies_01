<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function cleanUpperCaseString($string): string
    {
        // Remover os espaços em branco do início e do fim da string e converter para maiúsculas
        return strtoupper(trim($string));
    }
}
