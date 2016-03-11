<?php

$pageName = "Status.php";
$pageTitle = "Status";

include("preInc.inc");

// check all BlueHTTP server for all links
$links = $plang->getLinks();
$statusRows = "";
foreach($links as $obj)
{
  $statusRows .= "<tr>";
  $statusRows .= "<td>" . $obj["bluecountId"] . "</td><td>" . $obj["clientId"] . "</td>";
  if($obj["isActivated"] == 1)
    {
      // check the status of the BlueCount server
      if($plang->getServerStatus($obj))
	{
	  $statusRows .= "<td>OK</td>";
	  // check the status of BlueHTTP
	  if($plang->getBlueHTTPServerStatus($obj))
	    {
	      $statusRows .= "<td>OK</td>";
	    }
	  else
	    {
	      $statusRows .= "<td>Error</td>";
	    }
	}
      else
	{
	  $statusRows .= "<td colspan=\"2\">Error</td>";
	}
    }
  else
    {
      $statusRows .= "<td colspan=\"2\">Not activated</td>";
    }
  $statusRows .= "</tr>\n";
}

$frame = "<div id=\"formWide\">\n";
$frame .= "<div id=\"SensorList\" class=\"Boxes\">\n";
$frame .= '<table border="1">' . "\n";
$frame .= '<tr><th id="topTitle">Ref.</th><th id="topTitle">Client</th><th id="topTitle">Server</th><th id="topTitle">BlueHTTP</th></tr>' . "\n";
$frame .= $statusRows;
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
