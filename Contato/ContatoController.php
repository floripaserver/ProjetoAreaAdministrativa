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

        if ($_POST) {
            if ($this->getParams('nome') &&
                $this->getParams('email') &&
                $this->getParams('assunto') &&
                $this->getParams('menssagem')
            ) {
                $dados = [
                    'nome' => $this->getParams('nome'),
                    'email' => $this->getParams('email'),
                    'assunto' => $this->getParams('assunto'),
                    'menssagem' => $this->getParams('menssagem')
                ];

                $this->setNome($this->getParams('nome'));
                $this->setEmail($this->getParams('email'));
                $this->setAssunto($this->getParams('assunto'));
                $this->setMenssagem($this->getParams('menssagem'));

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