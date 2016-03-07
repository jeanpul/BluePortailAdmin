<?php

$pageName = "index.php";
$pageTitle = "Main menu";

include_once("preInc.inc");

?>

<div class="linkList">
<table>
<tr>
<td><ul>

<li><a id="clients" href="Clients.php">Clients</a></li>
<li><a id="sensors" href="Sensors.php">Sensors</a></li>

</ul></td>
<td><ul>

<li><a id="links" href="Links.php">Links</a></li>
<li><a id="log" href="Status.php">System status</a></li>

</ul></td>
<td><ul>

<li><a id="keys" href="Keys.php">Keys</a></li>
<li><a id="help" target="_blank" rel="nofollow" href="help.php">Inline help</a></li>

</ul></td>

</tr>
</table>

</div>

<div id="barHome">
<form action="/cgi-bin/BlueSystem/index.cgi" method="get">
<input type="hidden" name="action" value="Cancel" />
<button id="Home" type="submit" value="Back to Main menu" >Back to Main menu (BlueSystem)</button>
</form>
</div>

<?php

include_once("postInc.inc");


?>
