<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 19/09/14
 * Time: 14:49
 */

namespace Servico;

use Core\Controller;

class ServicoController extends Controller {

    public function index()
    {
        return $this->view('servico');
    }
} 