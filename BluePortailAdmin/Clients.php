<?php

$pageName = "Clients.php";
$pageTitle = "Clients administration";

include("preInc.inc");

$clients = $plang->getClients();
$clientRows = "";
foreach($clients as $obj)
{
  $clientRows .= "<tr><td>" . "<a href=\"ClientsEdit.php?action=edit&id=" . $obj["clientId"] . "\">"
    . htmlentities($obj["clientId"]) . "</a></td>"
    . "<td>" . htmlentities($obj["clientName"]) . "</td>" 
    . "<td>" . $obj["email"] . "</td><td>" . $obj["server"] . "</td>"
    . "<td><ul>" 
    . "<li><a target=\"_blank\" rel=\"nofollow\" href=\"" . $obj["server"] . "/BluePortail/index.php?clientBluePortail=" . $obj["clientId"] . "/" . "\">Portail</a></li>"
    . "<li><a target=\"_blank\" rel=\"nofollow\" href=\"" . $obj["server"] . "/BTopLocalServer/index.php?clientBluePortail=" . $obj["clientId"] . "/" . "\">LServer</a></li>"
    . "<li><a target=\"_blank\" rel=\"nofollow\" href=\"" . $obj["server"] . "/BlueCountGUI/index.php?clientBluePortail=" . $obj["clientId"] . "/" . "\">BCGUI</a></li>"
    . "</ul></td>"
    . "</tr>\n";
}

$frame = "<div id=\"SensorList\" class=\"Boxes\">\n";
$frame .= '<a href="ClientsEdit.php?action=create">Add a new client</a>' . "\n";
$frame .= '<table border="1">' . "\n";
$frame .= '<tr><th id="topTitle">Id</th><th id="topTitle">Name</th><th id="topTitle">Email</th>' .
          '<th id="topTitle">BlueCount Host</th><th id="topTitle">Links</th></tr>' . 
          "\n";
$frame .= $clientRows;
$frame .= "</table>\n";
$frame .= '<a href="ClientsEdit.php?action=create">Add a new client</a>' . "\n";
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