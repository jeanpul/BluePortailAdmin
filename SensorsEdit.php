<?php

$pageName = "SensorsEdit.php";
$pageTitle = "Sensors administration";

include("preInc.inc");

$params = array();

if($_GET)
{
  $params = $_GET;
}

$frame = "";

if($params["action"] == "Apply")
{  
  if(!isset($params["clients"]))
    {
      $frame = errorInput("Error empty Client list.");
    }
  else if(isset($params["id"]))
    {
      $frame = processUpdate("Sensors", "Sensors.php", $params, processSensorUpdateQuery);
    }
  else
    {
      $frame = processInsert("Sensors", "SensorsEdit.php", $params, processSensorInsertQuery);
    }
}
else if($params["action"] == "Delete")
{
  $frame = processDelete("Sensor", "Sensors.php", $params, processSensorDeleteQuery);
}
else if($params["action"] == "edit")
{
  $frame = getEditForm("Sensor", "Sensors.php", "SensorsEdit.php", $params, getSensorData, getSensorInputs);
}
else if($params["action"] == "create")
{
  $frame = getCreateForm("Sensor", "Sensors.php", "SensorsEdit.php", $params, getSensorInputs);
}

echo $frame;

?>

<div id="barHome">
<form action="Sensors.php" method="get">
<input type="hidden" name="action" value="Cancel" />
<button id="Home" type="submit" value="Back to Sensors" >Back to Sensors</button>
</form>
</div>

<?php

include("postInc.inc");

?>
