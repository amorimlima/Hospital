<?php
if(!isset($_SESSION['PATH_SYS'])){
   session_start();  
}
$path = $_SESSION['PATH_SYS'];
include_once($path['DB'].'DataAccess.php');
include_once($path['DB'].'DAO.php');
include_once($path['beans'].'ForumView.php');

class ForumViewDAO extends DAO{

    
    public function  __construct($da) {
        parent::__construct($da);
     }
     
     public function insert($view)
     {
     	$sql  = "insert into forum_view (frv_questao,frv_usuario,frv_data) values ";
        $sql .= "('".$view->getFrv_questao()."','".$view->getFrv_usuario()."',";
        $sql .= "'".$view->getFrv_data()."')";
		return $this->execute($sql);
     }
     
     public function selectByQuestao($idQuestao){
        $sql = "select * from forum_view where frv_questao = ".$idQuestao;
        //echo $sql;
    	$result = $this->retrieve($sql);
    	$lista = array();
        while ($qr = mysqli_fetch_array($result))
    	{

                $view = new ForumView();
                $view->setFrv_id($qr["frv_id"]);
                $view->setFrv_usuario($qr["frv_usuario"]);
                $view->setFrv_questao($qr["frv_questao"]);
                $view->setFrv_data($qr["frv_data"]);
                array_push($lista, $view);
                
        }    	
    	return $lista;
     }
     
	public function totalByQuestao($idQuestao){
		$sql = "select count(*) as total from forum_view where frv_questao = $idQuestao";
		$result = $this->retrieve($sql);
		
		$qr = mysqli_fetch_array($result);
		$total = $qr["total"];
		return $total;
	}
	
	public function verificaUsuarioByQuestao($idUser, $idQuestao){
		$sql = "select count(*) as total from forum_view where frv_questao = $idQuestao and frv_usuario = $idUser";
		//echo $sql;
		$result = $this->retrieve($sql);
		
		$qr = mysqli_fetch_array($result);
		$total = $qr["total"];
		return $total;
	}
     
     
     
}
?>