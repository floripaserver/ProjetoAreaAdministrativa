<?php
ini_set('display_errors', true);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL | E_STRICT);

require_once 'bootstrap.php';

use Core\Fixture;

$fixture = new Fixture();

$fixture->dropTables();

$inTable['config'] = $fixture->setTabelas("CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_site` varchar(45) NOT NULL,
  `titulo_empresa` varchar(45) NOT NULL,
  `descricao_empresa` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

$inTable['empresa'] = $fixture->setTabelas("CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) COLLATE utf8_bin NOT NULL,
  `texto` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;");

$inTable['pessoa'] = $fixture->setTabelas("
CREATE TABLE IF NOT EXISTS `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) COLLATE utf8_bin NOT NULL,
  `cpf` varchar(11) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `senha` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` enum('0','1','2') COLLATE utf8_bin NOT NULL COMMENT '0=desativado, 1= administrador, 2=usuario',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;");

$inTable['produto'] = $fixture->setTabelas("CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `valor` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

if ($inTable['config'] == 1) {

    echo "Tabela 'config' inserida com sucesso!<br>";

    $inRegistros['config'] = $fixture->insertRegistros("INSERT INTO `config` (`id`, `titulo_site`, `titulo_empresa`, `descricao_empresa`) VALUES
    (1, 'SoftEmp', 'SoftEmp', 'A nossa empresa e destinada ao estudo e desenvolvimento de software para gerenciamento.');");

}

if ($inTable['empresa'] == 1) {

    echo "Tabela 'empresa' inserida com sucesso!<br>";

    $inRegistros['empresa'] = $fixture->insertRegistros("INSERT INTO `empresa` (`id`, `nome`, `texto`) VALUES
(1, 'SoftEmp', '<p>Curso de PHP online pela code.education.</p>\r\n\r\n<ol>\r\n	<li>Paulo.</li>\r\n</ol>\r\n');");
}

if ($inTable['pessoa'] == 1) {

    echo "Tabela 'pessoa' inserida com sucesso!<br>";

    $inRegistros['pessoa'] = $fixture->insertRegistros("INSERT INTO `pessoa` (`id`, `nome`, `cpf`, `email`, `senha`, `status`) VALUES
(1, 'paulo', '123456', 'paulo@teste.com', 'admin', '1'),
(2, 'Luciane', '8374748', 'luciane@teste.com.br', '123456', '0'),
(5, 'teste', '2356463473', 'paulo@tttt.com', 'teste1', '2'),
(7, 'teste', '95465452', 'email@tet.com', 'asassda', '1'),
(9, 'dgtve', '23456373875', 'duda@duda.na', 'd', '1'),
(10, 'rtv', '23453264357', 'duda@duda.na', '', '0'),
(11, 'dfg ss', '135462466', 'duda@duda.com', '1', '0'),
(12, 'gyvbitv', '76848373', 'yubi@bkjyi.gj', 'hhybgg76', '1'),
(13, 'gfbjy', '32543631246', 'hgbj@ybuy.com', '', '0');");

}


if ($inTable['produto'] == 1) {

    echo "Tabela 'produto' inserida com sucesso!<br>";

    $inRegistros['produto'] = $fixture->insertRegistros("INSERT INTO `produto` (`id`, `nome`, `valor`) VALUES
    (1, 'Banana', '10,50'),
    (2, 'Placa Mae', '130,77'),
    (3, 'Memoria', '87,12'),
    (4, 'Arroz', '9,90'),
    (5, 'cooler', '21,00'),
    (6, 'Camisa', '142,00'),
    (7, 'Tenis', '378,94'),
    (8, 'Gabinete', '99,00'),
    (9, 'sofa', '543,79'),
    (10, 'Bala', '0,10'),
    (11, 'Massa', '3,45'),
    (12, 'Cafe', '12,13');");

}

echo "<hr>";
if ($inRegistros['config'] == 1) {
    echo "Tabela 'config' populada com sucesso!<br>";
}

if ($inRegistros['empresa'] == 1) {
    echo "Tabela 'empresa' populada com sucesso!<br>";
}

if ($inRegistros['pessoa'] == 1) {
    echo "Tabela 'pessoa' populada com sucesso!<br>";
}

if ($inRegistros['produto'] == 1) {
    echo "Tabela 'produto' populada com sucesso!<br>";
}
