
<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        Grupo
* GENERATION DATE:  11.06.2015
* FOR MYSQL TABLE:  grupo
* FOR MYSQL DB:     hcb_criancas
* -------------------------------------------------------
* CODE GENERATED BY:
* @MURANO DESIGN
* -------------------------------------------------------
*
*/



class Grupo
{ 
private $grp_id;

private $grp_grupo;
private $grp_escola;
private $grp_professor;



public function Grupo()
{

}




public function getGrp_id()
{
return $this->grp_id;
}

public function getGrp_grupo()
{
return $this->grp_grupo;
}

public function getGrp_escola()
{
return $this->grp_escola;
}

public function getGrp_professor()
{
return $this->grp_professor;
}



public function setGrp_id($val)
{
$this->grp_id =  $val;
}

public function setGrp_grupo($val)
{
$this->grp_grupo =  $val;
}

public function setGrp_escola($val)
{
$this->grp_escola =  $val;
}

public function setGrp_professor($val)
{
$this->grp_professor =  $val;
}


} 

?>

