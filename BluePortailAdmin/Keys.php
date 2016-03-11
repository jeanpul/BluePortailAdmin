<?php

$pageName = "Keys.php";
$pageTitle = "Keys administration";

include("preInc.inc");

$keys = $plang->getKeys();
$keyRows = "";
foreach($keys as $obj)
{
  $keyRows .= "<tr><td>" . "<a href=\"KeysEdit.php?action=edit&id=" . $obj["keyId"] . "\">"
    . $obj["keyId"] . "</a></td>"
    . "<td>" . $obj["clientId"] . "</td>"
    . "<td>" . $obj["startDate"] . "</td>"
    . "<td>" . $obj["endDate"] . "</td>"
    . "<td>" . htmlentities($obj["propName"]) . "</td>" 
    . "<td>" . $obj["propEmail"] . "</td>"
    . "<td>" . "<a href=\"keys/" . $obj["clientId"] . "/cert_" . $obj["keyId"] . ".p12\">" . "X</a></td>"
    . "</tr>\n";
}

$frame = "<div id=\"SensorList\" class=\"Boxes\">\n";
$frame .= '<a href="KeysEdit.php?action=create">Add a new key</a>' . "\n";
$frame .= '<table border="1">' . "\n";
$frame .= '<tr><th id="topTitle">Id</th><th id="topTitle">Client</th><th id="topTitle">StartDate UTC</th><th id="topTitle">EndDate UTC</th><th id="topTitle">Name</th><th id="topTitle">Email</th><th id="topTitle">P12 Key</th></tr>' . "\n";
$frame .= $keyRows;
$frame .= "</table>\n";
$frame .= '<a href="KeysEdit.php?action=create">Add a new key</a>' . "\n";
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
