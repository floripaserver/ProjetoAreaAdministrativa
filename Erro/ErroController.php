<?php

namespace Erro;

use Core\Controller;

class ErroController extends Controller {

    public function erro404()
    {
        return $this->view('404');
    }
    
}
