<?php
if(!isset($_SESSION['PATH_SYS'])){
   require_once '_loadPaths.inc.php'; 
}

$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'UsuarioVariavel.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioVariavelDAO
 *
 * @author Kevyn
 */
class UsuarioVariavelDAO extends DAO{
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
    
     public function insert($userv)
     {
        $sql  = "insert into  usuario_variavel (usv_usuario,usv_ano_letivo,usv_serie,usv_grau_instrucao,usv_categoria_funcional,usv_grupo,usv_status) values ";
        $sql .= "(".$userv->getUsv_usuario().",".$userv->getUsv_ano_letivo().",";
        $sql .= "".$userv->getUsv_serie().",".$userv->getUsv_grau_instrucao().",";
        $sql .= "".$userv->getUsv_categoria_funcional().",".$userv->getUsv_grupo().",".$userv->getUsv_status().")";

    	return $this->executeAndReturnLastID($sql);
     }
     
     public function update($userv)
     {
        $sql  = "update usuario_variavel set usv_usuario = '".$userv->getUsv_usuario()."',";
    	$sql .= "usv_ano_letivo = '".$userv->getUsv_ano_letivo()."',";
        $sql .= "usv_serie = '".$userv->getUsv_serie()."',";
        $sql .= "usv_grau_instrucao = ".$userv->getUsv_grau_instrucao().",";
        $sql .= "usv_categoria_funcional = ".$userv->getUsv_categoria_funcional().",";
    	$sql .= "usv_grupo = ".$userv->getUsv_grupo().", ";
    	$sql .= "usv_status = ".$userv->getUsv_status()." ";
        $sql .= "where usv_id = ".$userv->getUsv_id()." limit 1";
//        echo $sql;
        return $this->execute($sql);
     }
     
     public function delete($id)
     {
//         $sql = "delete from usuario_variavel where usv_id = ".$iduserv."";
 		$sql  = "update usuario_variavel set usv_status = '1' where usv_id = ".$id." limit 1";
    	return $this->execute($sql); 
     }
     
     public function select($iduserv)
     {
        $sql = "select * from usuario_variavel where usv_id = ".$iduserv;
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);

                $userv = new UsuarioVariavel();
                $userv->setUsv_id($qr["usv_id"]);
                $userv->setUsv_usuario($qr["usv_usuario"]);
                $userv->setUsv_ano_letivo($qr["usv_ano_letivo"]);
                $userv->setUsv_serie($qr["usv_serie"]);
                $userv->setUsv_grau_instrucao($qr["usv_grau_instrucao"]);
                $userv->setUsv_categoria_funcional($qr["usv_categoria_funcional"]);
                $userv->setUsv_grupo($qr["usv_grupo"]);
                $userv->setUsv_status($qr["usv_status"]);
	    	    	
    	return $userv;
     }
     
     public function selectFull()
     {
        $sql = "select * from usuario_variavel where usv_status = 0";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{

                $userv = new UsuarioVariavel();
                $userv->setUsv_id($qr["usv_id"]);
                $userv->setUsv_usuario($qr["usv_usuario"]);
                $userv->setUsv_ano_letivo($qr["usv_ano_letivo"]);
                $userv->setUsv_serie($qr["usv_serie"]);
                $userv->setUsv_grau_instrucao($qr["usv_grau_instrucao"]);
                $userv->setUsv_categoria_funcional($qr["usv_categoria_funcional"]);
                $userv->setUsv_grupo($qr["usv_grupo"]);
                $userv->setUsv_status($qr["usv_status"]);
                array_push($lista, $userv);
               
        }    	
    	return $lista;
     }

     public function selectByIdUsuario($iduser)
     {
        $sql = "select * from usuario_variavel where usv_usuario = ".$iduser." limit 1";
        $result = $this->retrieve($sql);

        if (mysqli_num_rows($result) > 0) {
            $qr = mysqli_fetch_array($result);

                    $userv = new UsuarioVariavel();
                    $userv->setUsv_id($qr["usv_id"]);
                    $userv->setUsv_usuario($qr["usv_usuario"]);
                    $userv->setUsv_ano_letivo($qr["usv_ano_letivo"]);
                    $userv->setUsv_serie($qr["usv_serie"]);
                    $userv->setUsv_grau_instrucao($qr["usv_grau_instrucao"]);
                    $userv->setUsv_categoria_funcional($qr["usv_categoria_funcional"]);
                    $userv->setUsv_grupo($qr["usv_grupo"]);
                    $userv->setUsv_status($qr["usv_status"]);
                    return $userv;
        }
     }
     
     public function removeGrupoByIdGrupo($idGrupo)
     {
        $sql  = "update usuario_variavel set usv_grupo = null ";
    	$sql .= "where usv_grupo = ".$idGrupo;
//        echo $sql;
        return $this->execute($sql);
     }
}
?>