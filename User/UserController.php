<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 25/09/14
 * Time: 18:28
 */

namespace User;

use Core\Controller;
use Pessoa\PessoaModel;

class UserController extends Controller
{

    public function __construct()
    {
        $this->logado();
    }

    public function index()
    {
        if ($this->getParams('id')) {
            $sql = [
                'where' => [
                    'id' => $this->getParams('id')
                ]
            ];

            $result = $this->del($sql);

        }

        $dados['result'] = (isset($result) ? $result : null);

        $dados['listar'] = $this->setPessoaModel()
            ->getPessoa();

        return $this->view('listar', $dados);
    }

    public function add()
    {
        if ($_POST) {

            $sql = [
                'values' => [
                    'nome' => $this->getParams('nome'),
                    'cpf' => $this->getParams('cpf'),
                    'email' => $this->getParams('email'),
                    'status' => $this->getParams('status'),
                    'senha' => ($this->getParams('password') ? $this->getParams('password') : '')
                ]
            ];

            $result = $this->setPessoaModel()->insertPessoa($sql);

            $resultInsert = ($result == 1 ? "<span class=\"label label-success\">Cadastrado com sucesso</span>" : "<span class=\"label label-danger\">Erro ao cadastrar tente novamente</span>");

        }

        $dados['result'] = (isset($resultInsert) ? $resultInsert : null);

        return $this->view('add', $dados);

    }

    public function alt()
    {
        $select = $this->setPessoaModel()
            ->setWherePessoa("id={$this->getParams('id')}")
            ->getPessoa();

        $dados['id'] = $select[0]['id'];
        $dados['nome'] = ($this->getParams('nome') ? $this->getParams('nome') : $select[0]['nome']);
        $dados['cpf'] = ($this->getParams('cpf') ? $this->getParams('cpf') : $select[0]['cpf']);
        $dados['email'] = ($this->getParams('email') ? $this->getParams('email') : $select[0]['email']);
        $dados['status'] = ($this->getParams('status') ? $this->getParams('status') : $select[0]['status']);
        $dados['senha'] = ($this->getParams('password') ? $this->getParams('password') : $select[0]['senha']);

        if ($_POST) {
            $sql = [
                'values' => [
                    'nome' => $dados['nome'],
                    'cpf' => $dados['cpf'],
                    'email' => $dados['email'],
                    'status' => $dados['status'],
                    'senha' => $dados['senha']
                ],
                'where' => [
                    'id' => $dados['id']
                ]
            ];

            $result = $this->setPessoaModel()->updatePessoa($sql);

            $resultUpdate = ($result == 1 ? "<span class=\"label label-success\">Alterado com sucesso</span>" : "<span class=\"label label-warning\">Nada foi alterado</span>");
        }
        $dados['result'] = (isset($resultUpdate) ? $resultUpdate : null);

        return $this->view('alt', $dados);
    }

    private function del($array)
    {
        $resultDelete = $this->setPessoaModel()
            ->deletePessoa($array);

        $result = ($resultDelete == 1 ? "<span class=\"label label-success\">Deletado com sucesso</span>" : null);

        return $result;
    }

    private function setPessoaModel()
    {
        return new PessoaModel();
    }
} 