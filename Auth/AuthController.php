<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 20/09/14
 * Time: 08:55
 */

namespace Auth;

use Core\Controller;
use Pessoa\PessoaModel;

class AuthController extends Controller
{

    private $rowCount;

    public function index()
    {
        return $this->view('login');
    }

    public function logar()
    {

        $login = $this->getParams('login');
        $senha = $this->getParams('loginPassword');

        try {

            if (!isset($login) && !isset($senha)) {

                throw new \InvalidArgumentException('Login e senha é obrigatório!');
            }

            $result = $this->getUser($login, $senha);

            if (!$this->rowCount) {
                throw new \InvalidArgumentException('Login ou senha inválidos!');
            }

            if ($result[0]['status'] == 0) {
                throw new \InvalidArgumentException('Acesso não autorizado!');
            }

            if ($result[0]['status'] != 0) {

                $_SESSION['id'] = $result[0]['id'];
                $_SESSION['pessoa'] = $result[0]['nome'];
                $_SESSION['status'] = $result[0]['status'];
                $_SESSION['avatar'] = (isset($result[0]['avatar']) ? $result[0]['avatar'] : null);
                $_SESSION['profissao'] = (isset($result[0]['profissao']) ? $result[0]['profissao'] : null);
                $_SESSION['datacadastro'] = (isset($result[0]['datacadastro']) ? $result[0]['datacadastro'] : null);
                $_SESSION['logado'] = 'logado';

                echo '<meta HTTP-EQUIV="REFRESH" content="0; url=/index">';
            }

        } catch (\Exception $e) {

            $dados['status'] = $e->getMessage();
            return $this->view('login', $dados);

        }

    }

    public function logout()
    {
        session_destroy();

        $this->view('logout');
        echo '<meta HTTP-EQUIV="REFRESH" content="1; url=/index">';
    }

    private function getUser($login, $senha)
    {
        $conn = $this->setPessoaModel();

        $user = $conn->setWherePessoa("cpf='{$login}' AND senha='{$senha}'")->getPessoa();

        $this->rowCount = $conn->getRowCount();

        return $user;
    }

    private function setPessoaModel()
    {
        return new PessoaModel();
    }

} 