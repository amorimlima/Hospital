<?php

class DAO
{

    private $da;

    function __construct($da)
    {
        $this->da = $da;
    }

    /**
    * For SELECT queries
    *
    * @param $sql the query string
    * @return mixed either false if error or object DataAccessResult
    *
    */
    public function retrieve($sql)
    {
        $result = $this->da->execute($sql);

        if ($error = $this->da->isError())
        {
            trigger_error($error);
            return false;
        }
        else
        {
            return $result;
        }
    }

    /**
    * For INSERT, UPDATE and DELETE queries
    *
    * @param $sql the query string
    * @return boolean true if success
    *
    */
    public function execute($sql)
    {
        $result = $this->da->execute($sql);

        if ($error = $this->da->isError())
        {
            //trigger_error($error);
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
    * For INSERT, UPDATE and DELETE queries And Returns Last ID From Table
    *
    * @param $sql the query string
    * @return boolean true if success
    *
    */
    public function executeAndReturnLastID($sql)
    {
        $result = $this->da->executeAndReturnLastID($sql);

        if ($error = $this->da->isError())
        {
            trigger_error($error);
            return false;
        }
        else
        {
            return $result;
        }
    }

}

?>
