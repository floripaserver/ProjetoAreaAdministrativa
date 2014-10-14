Criando um site com area de gerenciamento.

Instalação:

Carregue os arquivos para a pasta web do servidor,
<<<<<<< HEAD
Defina  um virtual Host para a pasta public,
=======
>>>>>>> 71f99c17f7845093e3092ea7df6c537b811dff65
crie um uma base de dados no banco mysql,
configure o arquivo Config/Config.php,
depois acesse seudominio/fixture.php se estiver tudo certo você recebe-ra as as mensagens de que as tabelas foram
criadas e populadas com dados de teste, depois exclua o arquivo.

O login:
<<<<<<< HEAD
O login esta definido pelo campo cpf da tabela pessoa;

Login: 94258418049
=======
O login esta definido pelo campo cpf da tabela pessoa, para alterar o campo cpf pelo campo email altere o
arquivoAuth/AuthController.php na linha 81 $user = $conn->setWherePessoa("cpf='{$login}' AND senha='{$senha}'")->getPessoa();

Login: 123456
>>>>>>> 71f99c17f7845093e3092ea7df6c537b811dff65
Senha: admin
