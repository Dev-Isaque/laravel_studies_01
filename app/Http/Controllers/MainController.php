<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function init()
    {
        echo 'init';
    }

    public function view()
    {
        echo 'view';
    }

    public function teste($value): void {
        echo 'A string foi convertida para maiúsculas: ' . $this->cleanUpperCaseString($value);
    }
}
