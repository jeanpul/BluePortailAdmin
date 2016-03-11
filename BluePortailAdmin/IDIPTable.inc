<?php

include_once("BluePHP/DBConnect.inc");

define("IDIPTable_tableName","IDIPTable");

function IDIPTable_connect()
{
  $name = "/home/DATA/BluePortail/IDIPTable_IDIPBase.db";
  $base = new DBConnect("SQLITE3", "", $name,
		     "", "");
  $base->connectToDB();
  return $base->connection ? $base : false;
}

function IDIPTable_createTable()
{
  $base = IDIPTable_connect();
  
  if($base)
    { 
      $query = "CREATE TABLE ".IDIPTable_tableName."(
      IDclient char(50) PRIMARY KEY,
      IPadress char(50),
      lasttimestamp text
      )";
      $result = $base->query($query);
      $result->freeResult();
      $base->closeDB();
      return true;
    }
  else 
    {    
      return false;
    }
}

function IDIPTable_updateTable($idclient, $ipadress,
			       $table = IDIPTable_tableName)
{
  $timestamp = date('Y:m:d H:i:s');

  $base = IDIPTable_connect();
  if($base)
    {
      $query = "REPLACE INTO $table ".
	"(IDclient, IPadress, lasttimestamp) ".
	"VALUES ('$idclient', '$ipadress', '$timestamp')";
      $result = $base->query($query);
      $result->freeResult();
      $base->closeDB();
      return true;
    }
  else 
    {
      return false;
    }
}

?>