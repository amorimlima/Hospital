<?php

if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}

//session_start();

$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'Mensagem.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MensagemDAO
 *
 * @author Kevyn
 */
class MensagemDAO extends DAO{
    //put your code here
    
    public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($mens)
     {
         $sql  = "insert into  mensagem (msg_destinatario, msg_remetente,msg_assunto,msg_mensagem,msg_lida,msg_cx_entrada,msg_cx_enviado,msg_tipo_mensagem,msg_data,msg_proprietario,msg_anexo,destinatarios,msg_destinatario_grupo) values ";
         $sql .= "('".$mens->getMsg_destinatario()."','".$mens->getMsg_remetente()."',";
         $sql .= "'".$mens->getMsg_assunto()."',";
         $sql .= "'".$mens->getMsg_mensagem()."',";
         $sql .= "'".$mens->getMsg_lida()."',";
         $sql .= "'".$mens->getMsg_cx_entrada()."',";
         $sql .= "'".$mens->getMsg_cx_enviado()."',";
         $sql .= "'".$mens->getMsg_tipo_mensagem()."',";
         $sql .= "'".$mens->getMsg_data()."',";
         $sql .= "'".$mens->getMsg_proprietario()."',";
         $sql .= "'".$mens->getMsg_anexo()."',";
         $sql .= "'".$mens->getDestinatarios()."','".$mens->getMsg_destinatario_grupo()."')";
		echo $sql;
    	return $this->execute($sql);
     }
     
      public function update($mens)
     {
        $sql  = "update mensagem set msg_destinatario = '".$mens->getMsg_destinatario()."',";
    	$sql .= "msg_remetente = '".$mens->getMsg_remetente()."',";
        $sql .= "msg_assunto = '".$mens->getMsg_assunto()."',";
        $sql .= "msg_mensagem = '".$mens->getMsg_mensagem()."',";
        $sql .= "msg_lida = '".$mens->getMsg_lida()."',";
        $sql .= "msg_cx_entrada = '".$mens->getMsg_cx_entrada()."',";
        $sql .= "msg_cx_enviado = '".$mens->getMsg_cx_enviado()."',";
        $sql .= "msg_tipo_mensagem = '".$mens->getMsg_tipo_mensagem()."',";
        $sql .= "msg_data = '".$mens->getMsg_data()."',";
        $sql .= "msg_proprietario = '".$mens->getMsg_proprietario()."',";
        $sql .= "msg_anexo = '".$mens->getMsg_anexo()."',";
        $sql .= "destinatarios = '".$mens->getDestinatarios()."',";
    	$sql .= "msg_destinatario_grupo = ".$mens->getMsg_destinatario_grupo().",";
        $sql .= "where  msg_id = ".$mens    ->getMsg_id()." limit 1";
        return $this->execute($sql);
     }
     
     public function delete($idmens)
     {
         $sql = "update mensagem set msg_ativo = 0 where msg_id = ".$idmens."";
    	return $this->execute($sql); 
     }
     
     public function select($idmens)
     {
        $sql = "select * from mensagem where msg_ativo = 1 and msg_id = ".$idmens." ";
    	$result = $this->retrieve($sql);
    	$qr = mysqli_fetch_array($result);

                $mens = new Mensagem();
                $mens->setMsg_id($qr["msg_id"]);
                $mens->setMsg_destinatario($qr["msg_destinatario"]);
                $mens->setMsg_remetente($qr["msg_remetente"]);
                $mens->setMsg_assunto($qr["msg_assunto"]);
                $mens->setMsg_mensagem($qr["msg_mensagem"]);
                $mens->setMsg_lida($qr["msg_lida"]);
                $mens->setMsg_cx_entrada($qr["msg_cx_entrada"]);
                $mens->setMsg_cx_enviado($qr["msg_cx_enviado"]);
                $mens->setMsg_tipo_mensagem($qr["msg_tipo_mensagem"]);
                $mens->setMsg_data($qr["msg_data"]);
                $mens->setMsg_proprietario($qr["msg_proprietario"]);
                $mens->setMsg_anexo($qr["msg_anexo"]);
                $mens->setDestinatarios($qr["destinatarios"]);
                $mens->setMsg_destinatario_grupo($qr["msg_destinatario_grupo"]);
                
    	return $mens;
     }
     
     public function count($idmens){
        $sql = "select * from mensagem where msg_ativo = 1 and msg_lida = 'n' and msg_destinatario=".$idmens." ";
        $result = $this->retrieve($sql);
        $qr = mysqli_num_rows($result);
        
        return $qr;
        
     }
     
     public function listaEnviadas($idmens) {
     
        $sql = "select * from mensagem where msg_ativo = 1 and msg_remetente = ".$idmens." ";
        $lista = array();
    	$result = $this->retrieve($sql);
    	while ($qr = mysqli_fetch_array($result))
    	{  
               $mens = new Mensagem();
                $mens->setMsg_id($qr["msg_id"]);
                $mens->setMsg_destinatario($qr["msg_destinatario"]);
                $mens->setMsg_remetente($qr["msg_remetente"]);
                $mens->setMsg_assunto($qr["msg_assunto"]);
                $mens->setMsg_mensagem($qr["msg_mensagem"]);
                $mens->setMsg_lida($qr["msg_lida"]);
                $mens->setMsg_cx_entrada($qr["msg_cx_entrada"]);
                $mens->setMsg_cx_enviado($qr["msg_cx_enviado"]);
                $mens->setMsg_tipo_mensagem($qr["msg_tipo_mensagem"]);
                $mens->setMsg_data($qr["msg_data"]);
                $mens->setMsg_proprietario($qr["msg_proprietario"]);
                $mens->setMsg_anexo($qr["msg_anexo"]);
                $mens->setDestinatarios($qr["destinatarios"]);
                $mens->setMsg_destinatario_grupo($qr["msg_destinatario_grupo"]);
                array_push($lista, $mens);

        } 
    	return $lista;
         
     }
     
     public function msgLida($idmens){
          $sql  = "update mensagem set msg_lida ='s' where msg_id=".$idmens." ";
          return $this->execute($sql);
     }

          public function detalhe($idmens){
         $sql = "select * from mensagem where msg_ativo = 1 and msg_id = ".$idmens." ";
         $result = $this->retrieve($sql);
    	 $qr = mysqli_fetch_array($result);
         $mens = new Mensagem();
                $mens->setMsg_id($qr["msg_id"]);
                $mens->setMsg_destinatario($qr["msg_destinatario"]);
                $mens->setMsg_remetente($qr["msg_remetente"]);
                $mens->setMsg_assunto($qr["msg_assunto"]);
                $mens->setMsg_mensagem($qr["msg_mensagem"]);
                $mens->setMsg_lida($qr["msg_lida"]);
                $mens->setMsg_cx_entrada($qr["msg_cx_entrada"]);
                $mens->setMsg_cx_enviado($qr["msg_cx_enviado"]);
                $mens->setMsg_tipo_mensagem($qr["msg_tipo_mensagem"]);
                $mens->setMsg_data($qr["msg_data"]);
                $mens->setMsg_proprietario($qr["msg_proprietario"]);
                $mens->setMsg_anexo($qr["msg_anexo"]);
                $mens->setDestinatarios($qr["destinatarios"]);
                $mens->setMsg_destinatario_grupo($qr["msg_destinatario_grupo"]);
 
    	return $mens;
         
     }


     public function listaRecebidos($idmens){
         
        $sql = "select * from mensagem where msg_ativo = 1 and msg_destinatario = ".$idmens." ";
        $lista = array();
    	$result = $this->retrieve($sql);
    	while ($qr = mysqli_fetch_array($result))
    	{  
               $mens = new Mensagem();
                $mens->setMsg_id($qr["msg_id"]);
                $mens->setMsg_destinatario($qr["msg_destinatario"]);
                $mens->setMsg_remetente($qr["msg_remetente"]);
                $mens->setMsg_assunto($qr["msg_assunto"]);
                $mens->setMsg_mensagem($qr["msg_mensagem"]);
                $mens->setMsg_lida($qr["msg_lida"]);
                $mens->setMsg_cx_entrada($qr["msg_cx_entrada"]);
                $mens->setMsg_cx_enviado($qr["msg_cx_enviado"]);
                $mens->setMsg_tipo_mensagem($qr["msg_tipo_mensagem"]);
                $mens->setMsg_data($qr["msg_data"]);
                $mens->setMsg_proprietario($qr["msg_proprietario"]);
                $mens->setMsg_anexo($qr["msg_anexo"]);
                $mens->setDestinatarios($qr["destinatarios"]);
                $mens->setMsg_destinatario_grupo($qr["msg_destinatario_grupo"]);
                array_push($lista, $mens);

        } 
    	return $lista;
     }

     public function selectFull()
     {
        $sql = "select * from mensagem msg_ativo = 1";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysql_fetch_array($result))
    	{
                $mens = new Mensagem();
                $mens->setMsg_id($qr["msg_id"]);
                $mens->setMsg_destinatario($qr["msg_destinatario"]);
                $mens->setMsg_remetente($qr["msg_remetente"]);
                $mens->setMsg_assunto($qr["msg_assunto"]);
                $mens->setMsg_mensagem($qr["msg_mensagem"]);
                $mens->setMsg_lida($qr["msg_lida"]);
                $mens->setMsg_cx_entrada($qr["msg_cx_entrada"]);
                $mens->setMsg_cx_enviado($qr["msg_cx_enviado"]);
                $mens->setMsg_tipo_mensagem($qr["msg_tipo_mensagem"]);
                $mens->setMsg_data($qr["msg_data"]);
                $mens->setMsg_proprietario($qr["msg_proprietario"]);
                $mens->setMsg_anexo($qr["msg_anexo"]);
                $mens->setDestinatarios($qr["destinatarios"]);
                $mens->setMsg_destinatario_grupo($qr["msg_destinatario_grupo"]);
                array_push($lista, $mens);
        }    
    	return $lista;
     }
     
     public function deletadas(){
        $sql = "select * from mensagem where msg_ativo = 0";
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{
                $mens = new Mensagem();
                $mens->setMsg_id($qr["msg_id"]);
                $mens->setMsg_destinatario($qr["msg_destinatario"]);
                $mens->setMsg_remetente($qr["msg_remetente"]);
                $mens->setMsg_assunto($qr["msg_assunto"]);
                $mens->setMsg_mensagem($qr["msg_mensagem"]);
                $mens->setMsg_lida($qr["msg_lida"]);
                $mens->setMsg_cx_entrada($qr["msg_cx_entrada"]);
                $mens->setMsg_cx_enviado($qr["msg_cx_enviado"]);
                $mens->setMsg_tipo_mensagem($qr["msg_tipo_mensagem"]);
                $mens->setMsg_data($qr["msg_data"]);
                $mens->setMsg_proprietario($qr["msg_proprietario"]);
                $mens->setMsg_anexo($qr["msg_anexo"]);
                $mens->setDestinatarios($qr["destinatarios"]);
                $mens->setMsg_destinatario_grupo($qr["msg_destinatario_grupo"]);
                array_push($lista, $mens);
        }    
    	return $lista;
     }
}
?>
