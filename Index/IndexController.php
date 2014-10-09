<?php

namespace Index;

use Core\Controller;

class IndexController extends Controller
{

    public function index()
    {
        return $this->view('home');
    }

    public function add()
    {
        $dados['id'] = $this->getParams('id');

        return $this->view('index', $dados);
    }
} 