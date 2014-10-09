<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 19/09/14
 * Time: 14:16
 */

namespace Produto;

use Core\Controller;

class ProdutoController extends Controller
{

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

        $dados['listar'] = $this->setPodutoModel()
            ->getProduto();

        return $this->view('produto', $dados);
    }

    public function add()
    {
        $this->logado();

        if ($_POST) {
            $sql = [
                'values' => [
                    'nome' => $this->getParams('nome'),
                    'valor' => $this->getParams('valor')
                ]
            ];

            $result = $this->setPodutoModel()->insertProduto($sql);

            $resultInsert = ($result == 1 ? "<span class=\"label label-success\">Cadastrado com sucesso</span>" : "<span class=\"label label-danger\">Erro ao cadastrar tente novamente</span>");

        }

        $dados['result'] = (isset($resultInsert) ? $resultInsert : null);

        return $this->view('add', $dados);
    }

    public function alt()
    {
        $this->logado();

        $select = $this->setPodutoModel()
            ->setWhereProduto("id={$this->getParams('id')}")
            ->getProduto();

        $dados['id'] = $select[0]['id'];
        $dados['nome'] = ($this->getParams('nome') ? $this->getParams('nome') : $select[0]['nome']);
        $dados['valor'] = ($this->getParams('valor') ? $this->getParams('valor') : $select[0]['valor']);

        if ($_POST) {

            $sql = [
                'values' => [
                    'nome' => $dados['nome'],
                    'valor' => $dados['valor']
                ],
                'where' => [
                    'id' => $dados['id']
                ]
            ];

            $result = $this->setPodutoModel()->updateProduto($sql);

            $resultUpdate = ($result == 1 ? "<span class=\"label label-success\">Alterado com sucesso</span>" : "<span class=\"label label-warning\">Nada foi alterado</span>");
        }

        $dados['result'] = (isset($resultUpdate) ? $resultUpdate : null);

        return $this->view('alt', $dados);
    }

    private function del($array)
    {
        $this->logado();

        $resultDelete = $this->setPodutoModel()
            ->deleteProduto($array);

        $result = ($resultDelete == 1 ? "<span class=\"label label-success\">Deletado com sucesso</span>" : null);

        return $result;
    }

    private function setPodutoModel()
    {
        return new ProdutoModel();
    }

} 