<?php

$pageName = "ClientsEdit.php";
$pageTitle = "Clients administration";

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
      $frame = processUpdate("Client", "Clients.php", $params, 'processClientUpdateQuery');
    }
  else
    {
      $frame = processInsert("Client", "ClientsEdit.php", $params, 'processClientInsertQuery');
    }
}
else if($params["action"] == "Delete")
{
  $frame = processDelete("Client", "Clients.php", $params, 'processClientDeleteQuery');
  $frame .= processRevokeKeys($params);
}
else if($params["action"] == "edit")
{
  $frame = getEditForm("Client", "Clients.php", "ClientsEdit.php", $params, 'getClientData', 'getClientInputs');
}
else if($params["action"] == "create")
{
  $frame = getCreateForm("Client", "Clients.php", "ClientsEdit.php", $params, 'getClientInputs');
}

echo $frame;

?>

<div id="barHome">
<form action="Clients.php" method="get">
<input type="hidden" name="action" value="Cancel" />
<button id="Home" type="submit" value="Back to Clients" >Back to Clients</button>
</form>
</div>

<?php

include("postInc.inc");

?>
