<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AulasRoutesController extends Controller
{
    public function index(){
        echo 'index';
    }

    public function about(){
        echo 'about';
    }

    public function mostrarValor($valor) {
        echo "Valor enviado pela rota: $valor";
    }

    public function mostrarValores($valor1, $valor2) {
        echo "Valores enviados pela rota: $valor1, $valor2";
    }

    public function mostrarValores2(Request $request, $valor1, $valor2) {
        echo "Valores enviados pela rota: $valor1, $valor2";
    }

    public function mostrarValorOpcional($valor = null) {
        echo "Valor opcional: $valor";
    }

    public function mostrarValoresOpcional( $valor1, $valor2 = null) {
        echo "Valor opcional: $valor1 e $valor2";
    }

    public function mostrarPosts( $user_id, $post_id) {
        echo "Posts do usuário ID: $user_id e o post com ID: $post_id";
    }
}
