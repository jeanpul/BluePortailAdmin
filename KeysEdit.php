<?php

$pageName = "KeysEdit.php";
$pageTitle = "Keys administration";

include("preInc.inc");

$params = array();

if($_GET)
{
  $params = $_GET;
}

$frame = "";

if($params["action"] == "Apply")
{  
  // check if we have to insert or update  
  if(isset($params["id"]))
    {
      $frame = processUpdate("Key", "Keys.php", $params, processKeyUpdateQuery);
    }
  else
    {
      $frame = processInsert("Key", "KeysEdit.php", $params, processKeyInsertQuery);
    }
}
else if($params["action"] == "Delete")
{
  $frame = processDelete("Key", "Keys.php", $params, processKeyDeleteQuery);
}
else if($params["action"] == "edit")
{
  $frame = getEditForm("Key", "Keys.php", "KeysEdit.php", $params, getKeyData, getKeyInputs);
}
else if($params["action"] == "create")
{
  $frame = getCreateForm("Key", "Keys.php", "KeysEdit.php", $params, getKeyInputs);
}

echo $frame;

?>

<div id="barHome">
<form action="Keys.php" method="get">
<input type="hidden" name="action" value="Cancel" />
<button id="Home" type="submit" value="Back to Keys" >Back to Keys</button>
</form>
</div>

<?php

include("postInc.inc");

?>
