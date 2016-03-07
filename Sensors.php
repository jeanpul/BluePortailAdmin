<?php

$pageName = "Sensors.php";
$pageTitle = "Sensors administration";

include("preInc.inc");

$sensors = $plang->getBlueCounts();
$sensorRows = "";
foreach($sensors as $obj)
{
  $sensorRows .= "<tr><td>" . "<a href=\"SensorsEdit.php?action=edit&id=" . $obj["ref"] . "\">" . htmlentities($obj["ref"]) . "</a></tr>\n";
}

$frame = "<div id=\"formWide\">\n";
$frame .= "<div id=\"SensorList\" class=\"Boxes\">\n";
$frame .= '<a href="SensorsEdit.php?action=create">Add a new sensor</a>' . "\n";
$frame .= '<table border="1">' . "\n";
$frame .= '<tr><th id="topTitle">Ref.</th></tr>' . "\n";
$frame .= $sensorRows;
$frame .= "</table>\n";
$frame .= '<a href="SensorsEdit.php?action=create">Add a new sensor</a>' . "\n";
$frame .= "</div>\n";
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

include("postInc.inc");

?>
