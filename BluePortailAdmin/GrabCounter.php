<?php

include_once('Config.inc');
include_once("BluePortailLang.inc");

// create connexion to the BluePortail data
$plang = new BluePortailLang();

/**
 * Read and process a BlueHTTP request for B-Top or B-Queue sensor
 *
 * - Parse BlueHTTP
 * - get the reference number from the clientId, channel, counter and type
 * - get the clientId in the BluePortail from the reference
 * - get the bluecountserver adress for this clientId
 * - create and send the BlueHTTP for the bluecountserver
 */

if(!isset($_GET))
{
  exit("Incorrect BlueHHTP request");
}

$params = $_GET;

/**
 * Parse BlueHTTP and retrieve the reference
 */
if($params["type"] == 144)
  {
    $type = "B-TOP";
    $id = $params["counter"];
    $urlpart = "counter=$id&value=" . $params["value"] . "&timeStart=" . $params["timeStart"] . "&timeEnd=" . $params["timeEnd"];
  }
else if($params["type"] == 145)
  {
    $type = "B-QUEUE";
    $id = $params["region"];
    $urlpart = "region=$id&value=" . $params["value"] . "&timestamp=" . $params["timestamp"];
  }
else if($params["type"] == 146)
  {
    $type = "B-TOP";
    $id0 = $params["counter0"];
    $id1 = $params["counter1"];
    $id = $id0 . "_" . $id1;
    $urlpart = "counter0=${id0}&value0=" . $params["value0"] . "&counter1=${id1}&value1=" . $params["value1"] . 
      "&timeStart=" . $params["timeStart"] . "&timeEnd=" . $params["timeEnd"];    
  }
else
  {
    // maintenance server
    exit("Incorrect BlueHTTP request");
  }

$params["ref"] = $params["client"] . "_" . $type . "_" . $params["channel"] . "_" . $id;

/**
 * Get the clientids from the reference number
 */
$clients = $plang->getBlueCountData($params);

if(!is_array($clients) or !count($clients))
{
  // maintenance server
  syslog(LOG_INFO, "BluePortailGrabCounter : no client for the reference " . $params["ref"] . " with IP " . $_SERVER["REMOTE_ADDR"]);
  exit("No client for this reference");
}

foreach($clients as $obj)
{
  /**
   * Get the client bluecountserver configuration 
   */
  $client = $plang->getClientData($obj);

  $iptable = array( "bluecountId" => $params["client"],
		    "clientId" => $client[0]["clientId"],
		    "lasttimestamp" => date('Y:m:d H:i:s'),
		    "laststatus" => "not activated",
            "lastIP" => "ND",
            "lastCounterTime" => "ND");

  // if not activated send a message to the maintenance server
  if($obj["isActivated"])
    {
        // if not send a message to the maintenance server
      if(is_array($client) and count($client))
	{
	  /**
	   * Send the BlueHTTP request
	   */
	  $bluehttp = $client[0]["server"] . "/BTopLocalServer/GrabCounter.php" . "?" . 
	    "client=" .  $params["client"] . "&" .
	    "type=" . $params["type"] . "&" .
	    "channel=" . $params["channel"] . "&" .
	    "clientBluePortail=" . $client[0]["clientId"] . "&" . 
	    $urlpart;

	  if(isset($params["test"]))
	    {
	      $bluehttp .= "&test=1";
	    }

	  if(!file_get_contents($bluehttp))
	    {
	      syslog(LOG_INFO, "BluePortailAdmin:GrabCounter cannot forward BlueHTTP request to $bluehttp");	      
	      $iptable["laststatus"] = "cannot forward BlueHTTP request";
	    }
	  else
	    {
	      $iptable["laststatus"] = "BlueHTTP request forwarded";
	    }
	  $iptable["lastIP"] = $_SERVER["REMOTE_ADDR"];
      $iptable["lastCounterTime"] = $params["type"] == 145 ? $params["timestamp"] : $params["timeStart"];
	}
    }
  $plang->updateIPTable($iptable);
}

$plang->close();

?>
