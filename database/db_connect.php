<?php
/************************************************************
*                                                           *
* db_connect.php                                            *
*                                                           *
*   This code opens a connection to the mysql drd database  *
*                                                           *
************************************************************/

/* Set the variables for your database connection. */
// $dbname = 'DRD';
// $dbuser = 'bill';
// $dbpass = 'bill';
// $dbhost = 'localhost';

/* Set up the connection string to the database. */
// $conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
/* Establish the connection to the database. */
// mysqli_select_db($conn, $dbname) or die("Could not open the db '$dbname'");
  include 'db_config.php';
  class Mysql extends Dbconfig
  {
      // Store the single instance of Database
      // private static $m_pInstance;
    public $connectionString;
    public $dataSet;
    private $sqlQuery;

      protected $databaseName;
      protected $hostName;
      protected $userName;
      protected $passCode;

    function __construct()    {
      $this -> connectionString = NULL;
      $this -> sqlQuery = NULL;
      $this -> dataSet = NULL;

        $dbPara = new Dbconfig();
        $this -> databaseName = $dbPara -> dbName;
        $this -> hostName = $dbPara -> serverName;
        $this -> userName = $dbPara -> userName;
        $this -> passCode = $dbPara ->passCode;
        $dbPara = NULL;
    }

    function dbConnect()    {
        $this -> connectionString = mysql_connect($this -> serverName,$this -> userName,$this -> passCode);
        mysql_select_db($this -> databaseName,$this -> connectionString);
        return $this -> connectionString;
    }

    function dbDisconnect() {
        $this -> connectionString = NULL;
        $this -> sqlQuery = NULL;
        $this -> dataSet = NULL;
                $this -> databaseName = NULL;
                $this -> hostName = NULL;
                $this -> userName = NULL;
                $this -> passCode = NULL;
    }

    function selectAll($tableName)  {
        $this -> sqlQuery = 'SELECT * FROM '.$this -> databaseName.'.'.$tableName;
        $this -> dataSet = mysql_query($this -> sqlQuery,$this -> connectionString);
                return $this -> dataSet;
    }

    function selectWhere($tableName,$rowName,$operator,$value,$valueType)   {
        $this -> sqlQuery = 'SELECT * FROM '.$tableName.' WHERE '.$rowName.' '.$operator.' ';
        if($valueType == 'int') {
            $this -> sqlQuery .= $value;
        }
        else if($valueType == 'char')   {
            $this -> sqlQuery .= "'".$value."'";
        }
        $this -> dataSet = mysql_query($this -> sqlQuery,$this -> connectionString);
        $this -> sqlQuery = NULL;
        return $this -> dataSet;
        #return $this -> sqlQuery;
    }

    function insertInto($tableName,$values) {
        $i = NULL;

        $this -> sqlQuery = 'INSERT INTO '.$tableName.' VALUES (';
        $i = 0;
        while($values[$i]["val"] != NULL && $values[$i]["type"] != NULL)    {
            if($values[$i]["type"] == "char")   {
                $this -> sqlQuery .= "'";
                $this -> sqlQuery .= $values[$i]["val"];
                $this -> sqlQuery .= "'";
            }
            else if($values[$i]["type"] == 'int')   {
                $this -> sqlQuery .= $values[$i]["val"];
            }
            $i++;
            if($values[$i]["val"] != NULL)  {
                $this -> sqlQuery .= ',';
            }
        }
        $this -> sqlQuery .= ')';
                #echo $this -> sqlQuery;
        mysql_query($this -> sqlQuery,$this ->connectionString);
                return $this -> sqlQuery;
        #$this -> sqlQuery = NULL;
    }

    function selectFreeRun($query)  {
        $this -> dataSet = mysql_query($query,$this -> connectionString);
        return $this -> dataSet;
    }

    function freeRun($query)    {
        return mysql_query($query,$this -> connectionString);
      }
    }
?>
