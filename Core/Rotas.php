<?php

namespace Core;

class Rotas
{
    private $url;
    private $error = array();
    public $app; //diretorio do aplicativo
    private $objController;
    private $action;
    private $params;

    public function __construct()
    {        
        /**
         * obtendo a url atraves do htaccess ou do PHP
         */
        $url = (isset($_GET['url']) ? $_GET['url'] : $_SERVER["REQUEST_URI"]);
        
        $this->getUrl($url);    
    }
    
    /**
     * Carrega um array com as paginas do projeto
     * 
     * @return type
     * @throws \InvalidArgumentException
     */
    private function setRotas()
    {
        $rotas = include 'Config/Config.php';

        try {

            if (!isset($rotas['rotas'])) {
                throw new \InvalidArgumentException('Configuração de Rotas não existe!');
            }

            return $rotas['rotas'];
            
        } catch (\Exception $e) {
            $this->error[] = $e->getMessage();
        }
    }
    
    private function getUrl($getUrl)
    {
        
        $urlDefault = preg_split("[\\/]", $getUrl, -1, PREG_SPLIT_NO_EMPTY);
                
        $url = (isset($urlDefault[0]) ? $urlDefault : ["index"]);
        
        if(isset($url[0]) && in_array($url[0], $this->setRotas())){
	
            $this->url = $url;        
            
        } else { 
            http_response_code(404);
            $this->url = ['erro','erro404'];            
        }  
        
        $this->setApp();
    }

    /**
     * retorna o caminho da pasta do APP
     */
    private function setApp()
    {
        $app = ucfirst($this->url[0]);

        try {
            if (!file_exists($app)) {
                http_response_code(404);
                throw new \InvalidArgumentException('Diretorio <strong>' . $app . '</strong> não exite!');
            }

            $this->app = $app;

            $this->setController();

        } catch (\Exception $e) {
            $this->error[] = $e->getMessage();
        }
    }

    public function getApp()
    {
        return $this->app;
    }

    private function setController()
    {
        $class = ucfirst($this->url[0]) . "Controller";

        $controller = $class . ".php";

        $dirController = $this->app . DIRECTORY_SEPARATOR . $controller;

        $arqClass = '\\' . $this->app . '\\' . $class;

        try {
            if (!file_exists($dirController)) {
                http_response_code(404);
                throw new \InvalidArgumentException('Controller <strong>' . $controller . '</strong> não exite no diretorio <strong>' . $this->app . '</strong>!');
            }

            if (!class_exists($arqClass)) {
                http_response_code(500);
                throw new \InvalidArgumentException('Class <strong>' . $class . '</strong> não exite no controller <strong>' . $controller . '</strong>!');
            }

            $this->objController = new $arqClass;

            $this->setAction();

        } catch (\Exception $e) {
            $this->error[] = $e->getMessage();
        }
    }

    private function setAction()
    {
        $action = (isset($this->url[1]) ? $this->url[1] : "index");

        try {
            if (!method_exists($this->objController, $action)) {
                throw new \InvalidArgumentException('Method <strong>' . $action . '</strong> não exite!');
            }

            $this->action = $action;

            $this->setParams();

        } catch (\Exception $e) {
            $this->error[] = $e->getMessage();
        }

    }

    protected function setParams()
    {
        $params = (isset($this->url[2]) ? ['id' => $this->url[2]] : (isset($_POST) ? $_POST : null));

        $this->params = $params;
    }

    public function getParams($nome)
    {
        $params = (isset($this->params[$nome]) ? $this->params[$nome] : null);

        return $params;
    }

    public function show()
    {
        if (isset($this->error)) {
            foreach ($this->error as $error) {
                echo $error . "<br>";
            }

        }

        $objController = $this->objController;
        $action = $this->action;

        (isset($objController) && isset($action) ? $objController->$action() : null);
    }

}