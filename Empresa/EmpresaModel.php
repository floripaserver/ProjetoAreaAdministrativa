<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 18/09/14
 * Time: 19:33
 */

namespace Empresa;

use Core\Model;

class EmpresaModel extends Model
{

    public function __construct()
    {
        $this->setTable('empresa');
    }

    public function getEmpresa()
    {
        $empresa = $this->read();

        return $empresa;
    }

    public function setWhereEmpresa($where)
    {
        $this->setWhere($where);
        return $this;
    }

    public function updateEmpresa($array)
    {
        $update = $this->update($array);
        return $update;
    }

} 