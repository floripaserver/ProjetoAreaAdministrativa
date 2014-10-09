<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 24/09/14
 * Time: 15:03
 */

namespace Pessoa;

use Core\Controller;

class PessoaController extends Controller
{

    public function index()
    {
        $t = $this->setPessoaModel()
            ->getPessoa();

        print_r($t);
    }

    private function setPessoaModel()
    {
        return new PessoaModel();
    }

}
