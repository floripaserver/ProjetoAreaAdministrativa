<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 24/09/14
 * Time: 15:22
 */

namespace Pessoa;

use Core\Model;

class PessoaModel extends Model
{

    public function __construct()
    {
        $this->setTable('pessoa');
    }

    public function getPessoa()
    {
        $pessoa = $this->read();

        return $pessoa;
    }

    public function setWherePessoa($where)
    {
        $this->setWhere($where);
        return $this;
    }

    public function insertPessoa($array)
    {
        $insert = $this->insert($array);
        return $insert;
    }

    public function updatePessoa($array)
    {
        $update = $this->update($array);
        return $update;
    }

    public function deletePessoa($array)
    {
        $delete = $this->delete($array);
        return $delete;
    }

} 