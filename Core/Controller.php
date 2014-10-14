<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 16/09/14
 * Time: 23:01
 */

namespace Core;

//use Core\Rotas;

class Controller
{

    private $extencaoView = '.phtml';

    protected function view($view, $dados = null)
    {
        $app = $this->setRotas()->app;

        if (file_exists($app . "/View/{$view}{$this->extencaoView}")) {

            if (is_array($dados) && count($dados) > 0) {
                //extraimos os dados e colocamos um prefixo com o nome do aplicativo
                //seguido de underline mais o nome do campo(indice) ex: $index_dataHoje
                extract($dados, EXTR_PREFIX_ALL, strtolower($app));
            }

            return require_once $app . "/View/{$view}{$this->extencaoView}";
        } else {
            echo "<div class=\"alert alert-error\">View {$view} não foi criada!</div>";
        }
    }

    protected function logado($url = null)
    {
        $page = (isset($url) ? $url : "/index");

        if (!isset($_SESSION['logado'])) {
            echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url={$page}\">";
        }
    }

    protected function getParams($nome)
    {
        return $this->setRotas()->getParams($nome);
    }

    protected function setUrlDefault($url)
    {
        $this->setRotas()->setUrl($url);
        return $this;
    }

    private function setRotas()
    {
        return new Rotas();
    }

} 