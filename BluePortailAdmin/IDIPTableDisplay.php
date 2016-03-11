<?php

$pageName = "IDIPTableDisplay.php";
$pageTitle = "Clients counters last status";

include_once("preInc.inc");

function buildXmlField($obj, $field)
{
  return '  <'.$field.'>'.$obj["$field"] . '</'.$field . ">\n";
}

$params = array_merge( array( "bluecountId" => false,
			      "clientId" => false ),
		       $_GET );

$data = $plang->getIPTable($params);

if($data)
  {
    $str = "<table border='1'>\n";
    $str .= "<tr><th>bluecountId</th><th>clientId</th><th>timestamp</th><th>IP</th><th>name</th></tr>\n";
    foreach($data as $k => $v)
      {
	$str .= "<tr>\n";
	$str .= "<td>" . $v['bluecountId'] . "</td>\n";
	$str .= "<td>" . $v['clientId'] . "</td>\n";
	$str .= "<td>" . $v['lasttimestamp'] . "</td>\n";
	$str .= "<td>" . $v["lastIP"] . "</td>\n";
	$str .= "<td>" . $v['name'] . "</td>\n";
	$str .= "</tr>\n";
      }
    $str .= "</table>\n";

    echo "<div id=\"SensorList\" class=\"Boxes\">\n";
    echo $str;
    echo "</div>\n";
  }
else 
  {
    die("Request for data in GrabIPTable failed");
  }

include_once("postInc.inc");

?>
