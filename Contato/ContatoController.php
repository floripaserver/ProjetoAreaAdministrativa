<?php

namespace Contato;

use Core\Controller;
use Core\Email;

class ContatoController extends Controller
{

    private $nome;
    private $email;
    private $assunto;
    private $menssagem;

    public function index()
    {

        $dados = [
            'nome' => trim($this->getParams('nome')),
            'email' => trim($this->getParams('email')),
            'assunto' => trim($this->getParams('assunto')),
            'menssagem' => trim($this->getParams('menssagem'))
        ];

        if ($_POST) {
            if ($dados['nome'] &&
                $dados['email'] &&
                $dados['assunto'] &&
                $dados['menssagem']
            ) {

                $this->setNome($dados['nome']);
                $this->setEmail($dados['email']);
                $this->setAssunto($dados['assunto']);
                $this->setMenssagem($dados['menssagem']);

                $statusEmail = $this->enviarEmail();

            } else {
                $statusEmail = "<span class=\"alert-error\">Todos os campos são obrigatorio</span>";
            }

        }

        $dados['statusEmail'] = (isset($statusEmail) ? $statusEmail : null);

        $dados = (isset($dados) ? $dados : null);

        return $this->view('contato', $dados);
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $menssagem
     */
    public function setMenssagem($menssagem)
    {
        $this->menssagem = $menssagem;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMenssagem()
    {
        return $this->menssagem;
    }

    /**
     * @param mixed $assunto
     */
    public function setAssunto($assunto)
    {
        $this->assunto = $assunto;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAssunto()
    {
        return $this->assunto;
    }

    public function enviarEmail()
    {
        $e = new Email();

        $e->remetenteNome = $this->nome;
        $e->remetenteEmail = $this->email;
        $e->assuntoEmail = $this->assunto;
        $e->conteudoEmail = $this->menssagem;

        return $e->enviar();
    }
} 