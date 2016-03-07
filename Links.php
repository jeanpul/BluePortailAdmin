<?php

$pageName = "Links.php";
$pageTitle = "Links administration";

include("preInc.inc");

// check if we have to change a link parameter
$params = array();
if(isset($_GET))
{
  $params = $_GET;
}

if(isset($params["bluecountId"]) and isset($params["clientId"]))
{
  if(!isset($params["isActivated"]))
    {
      $params["isActivated"] = 0;
    }
  else
    {
      $params["isActivated"] = 1;
    }
  $plang->processUpdateLink($params);
}

$links = $plang->getLinks();
$linksRows = "";
foreach($links as $obj)
{
  $linksRows .= "<tr>";
  $linksRows .= "<form action=\"$pageName\" method=\"get\">\n";
  $linksRows .= "<td><input type=\"text\" name=\"bluecountId\" value=\"" . $obj["bluecountId"] . "\" readonly /></td>\n";
  $linksRows .= "<td><input type=\"text\" name=\"clientId\" value=\"" . $obj["clientId"] . "\" readonly /></td>\n";
  $linksRows .= "<td><input type=\"checkbox\" name=\"isActivated\" value=\"" . $obj["isActivated"] . "\" onClick=\"submit();\" " . ($obj["isActivated"] == 1 ? "checked" : "") . "/></td>\n";
  $linksRows .= "</form>\n";
  $linksRows .= "</tr>\n";
}

$frame = "<div id=\"formWide\">\n";
$frame .= "<div id=\"SensorList\" class=\"Boxes\">\n";
$frame .= '<table border="1">' . "\n";
$frame .= '<tr><th id="topTitle">Ref.</th><th id="topTitle">Client</th><th id="topTitle">Activated</th></tr>' . "\n";
$frame .= $linksRows;
$frame .= "</table>\n";
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
