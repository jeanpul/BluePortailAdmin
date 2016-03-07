<?php

include_once("Config.inc");

loadBluePHP();

include_once("BluePortailLang.inc");

$plang = new BluePortailLang();

$params = array();

if(isset($_GET))
{
  $params = $_GET;
}

if(!isset($params["function"]))
{
  $params["function"] = "version";
}

$elts = $plang->callFunction($params["function"], $params);

if(is_array($elts))
{
  $frame = "";
  foreach($elts as $v)
    {
      $frame .= "";
      foreach($v as $w)
	{
	  $frame .= $w . " ; ";
	}
      $frame .= "\n";
    }
  header("Content-Type: application/csv-tab-delimited-table");
  header("Content-Length: " . strlen($frame));
  header("Pragma: no-cache");
  header("Expires: 0");      
  print $frame;

}

$plang->close();

?>
