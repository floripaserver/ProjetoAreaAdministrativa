<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 19/09/14
 * Time: 14:23
 */

namespace Produto;

use Core\Model;

class ProdutoModel extends Model
{

    public function __construct()
    {
        $this->setTable('produto');
    }

    public function listaProdutos()
    {
        $prod = $this->read();

        return $prod;
    }

    public function getProduto()
    {
        $produto = $this->read();

        return $produto;
    }

    public function setWhereProduto($where)
    {
        $this->setWhere($where);
        return $this;
    }

    public function insertProduto($array)
    {
        $insert = $this->insert($array);
        return $insert;
    }

    public function updateProduto($array)
    {
        $update = $this->update($array);
        return $update;
    }

    public function deleteProduto($array)
    {
        $delete = $this->delete($array);
        return $delete;
    }

} 