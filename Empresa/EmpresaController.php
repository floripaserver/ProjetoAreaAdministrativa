<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 18/09/14
 * Time: 19:14
 */

namespace Empresa;

use Core\Controller;

class EmpresaController extends Controller
{

    public function index()
    {

        if ($_POST) {
            $sql = [
                'values' => [
                    'texto' => $this->getParams('texto')
                ],
                'where' => [
                    'id' => $this->getParams('id')
                ]
            ];

            $update = $this->setEmpresaModel()->updateEmpresa($sql);

            $resultUpdate = ($update == 1 ? "<span class=\"label label-success\">Alterado com sucesso</span>" : "<span class=\"label label-danger\">Nada foi alterado</span>");

        }

        $dados['result'] = (isset($resultUpdate) ? $resultUpdate : null);

        $empresa = $this->setEmpresaModel()->setWhereEmpresa("id=1")->getEmpresa();

        $dados['id'] = $empresa[0]['id'];
        $dados['nome'] = $empresa[0]['nome'];
        $dados['texto'] = $empresa[0]['texto'];

        return $this->view('empresa', $dados);
    }

    private function setEmpresaModel()
    {
        return new EmpresaModel();
    }
} 