<?php

class DataAccess
{	
	private $connect;
	
	public function __construct() {
		$this->connect();
	}
	
	public function connect()
	{
		//L -> 'localhost', 'hcb_criancas', '199405' DB -> hcb_criancas
        //W ->'localhost', 'root',''     DB -> hcb_criancas
        $this->connect = mysql_connect('localhost', 'root', '');//
		mysql_select_db('hcb_criancas', $this->connect)or die(mysql_error());//
	}
	
	public function getDBConnect()
	{
		return $this->connect;
	}

		
	/**/
	public function execute($sql)
	{
		//echo $sql;
		$query = mysql_query($sql, $this->getDBConnect());// or die(mysql_error()."Erro!!");

		/* Executa o SQL */
		if ($query)
			return $query;
			//throw new Exception('Division by zero.');
		else
			return null;
	}

	/**/
	public function executeAndReturnLastID($sql)
	{
		$query = mysql_query($sql, $this->getDBConnect()) or die(mysql_error()."Erro!!");				
				
		/* Executa o SQL */			
		if ($query)
		{
			return mysql_insert_id($this->getDBConnect());
		}
		else
			return null;	
	}
	

    /**
    * Returns any MySQL errors
    *
    * @return string a MySQL error
    *
    */
    public function isError ()
    {
        return mysql_error( $this->getDBConnect() );
    }
	
		
}

?>