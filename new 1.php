<?php  
require_once 'script login.php';
$conn2 = new mysqli($hn,$un,$pw,$db);

if ($conn2->connect_error) die ($conn2->connect_error);

echo "01";
$query = "SET NAMES utf8"; 	
$result = $conn2->query($query);
if (!$result) die ($conn2->error);

echo "02"; 
if (isset($_POST['supprimer']) && isset($_POST['nomcli']))
{
$numcli = get_post($conn2,'client');
$query= "DELETE from client where nomcli = 'nomcli'";
$result = $conn2->query($query);
 if (!$result) echo "echec suppression : $query <br>".
$conn2->error . "<br><br>";
}
if (isset($_POST['numcli'])  &&
	isset($_POST['nomcli'])  &&
 	isset($_POST['prenomcli'])   &&
	isset($_POST['telcli'])   &&
	isset($_POST['emailcli']) )  
{ 
$numcli = get_post($conn2,'numcli');
$nomcli = get_post($conn2,'nomcli');
$prenomcli = get_post($conn2,'prenomcli');
$telcli = get_post($conn2,'telcli');
$emailcli = get_post($conn2,'emailcli');
$query= "INSERT INTO ARTICLE VALUE" . 
"('$numcli','$nomcli','$prenomcli','$telcli','$emailcli')";
$result = $conn2->query($query);

echo "03";
if(!$result) echo "echec insertion : $query<br>". 
$conn2->error. "<br><br>";
}
echo<<<_END
<form action="SQL40TEST40.PHP" method="post"><pre>
numcli <input type="text" name="numcli">
nomcli <input type="text" name="nomcli">
prenomcli <input type="text" name="prenomcli">
telcli <input type="text" name="telcli">
emailcli <input type="text" name="emailcli">

<input type="submit" value="ajouter un client">
</pre></form>
_END;
/*$query = "SELECT * FROM COMPTEURARTICLE";
$result = $conn2->query($query);
if (!$result) die (" echec acces bdd  :" . $conn2->error);
echo ("nbre de article dans la base de donnée  ");
$rows = $result->num_rows;
$rows = $result->fetch_array(MYSQLI_NUM);
echo $rows[0];

$query = "SELECT * FROM article";
$result = $conn2->query($query);
if (!$result) die (" echec acces bdd  :" . $conn2->error);
$rows = $result->num_rows;

for ($j = 0 ; $j < $rows ; ++$j)
{
$result->data_seek($j);
$row = $result->fetch_array(MYSQLI_NUM);
echo <<<_END
<pre>
numcli $row[0]
nomcli $row[1]
prenomcli $row[2]
telcli $row[3]
emailcli $row[4]

</pre>
<form action="SQL40TEST40.PHP" method="post">
<input type="hidden" name="supprimer" value="yes">
 <input type="hidden" name="article" value="$row[0]">
<input type = "submit" value="supprimer fiche">
</form>
_END;
}
$result->close();
$conn2->close();
function get_post($conn2,$var)
{
return $conn2->real_escape_string($_POST[$var]);
}*/*
?>