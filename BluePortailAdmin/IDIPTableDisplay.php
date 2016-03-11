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

$str = "";

if($data)
  {
    $str = "<div id=\"SensorList\" class=\"Boxes\">\n";
    $str .= "<table border='1'>\n";
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
    $str .= "</div>\n";
  }
else 
  {
    $str = "<p>No data received from declared sensors</p>";
  }

$frame = "<div id=\"formWide\">\n";
$frame .= $str;
$frame .= "</div>\n";

echo $frame;

?>

<div id="barHome">
<form action="index.php" method="get">
<input type="hidden" name="action" value="Cancel" />
<button id="Home" type="submit" value="Back to Main menu" >Back to Main menu</button>
</form>
</div>


<?php

include_once("postInc.inc");

?>
