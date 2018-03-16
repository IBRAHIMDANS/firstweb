<?php  
require_once 'script login.php';
$conn2 = new mysqli($hn,$un,$pw,$db);

if ($conn2->connect_error) die ($conn2->connect_error);

echo "01";
$query = "SET NAMES utf8"; 	
$result = $conn2->query($query);
if (!$result) die ($conn2->error);

echo "02"; 
if (isset($_POST['supprimer']) && isset($_POST['desart']))
{
$numart = get_post($conn2,'article');
$query= "DELETE from article where numart = 'numart'";
$result = $conn2->query($query);
 if (!$result) echo "echec suppression : $query <br>".
$conn2->error . "<br><br>";
}
if (isset($_POST['numart'])  &&
	isset($_POST['desart'])  &&
 	isset($_POST['stock'])   &&
	isset($_POST['limstock']) )  
{ 
$numart = get_post($conn2,'numart');
$desart = get_post($conn2,'desart');
$stock = get_post($conn2,'stock');
$limstock = get_post($conn2,'limstock');
$query= "INSERT INTO ARTICLE VALUE" . 
"('$numart','$desart','$stock','$limstock')";
$result = $conn2->query($query);

echo "03";
if(!$result) echo "echec insertion : $query<br>". 
$conn2->error. "<br><br>";
}
echo<<<_END
<form action="connection php mysql.PHP" method="post"><pre>
numart <input type="text" name="numart">
desart <input type="text" name="desart">
stock <input type="text" name="stock">
limstock <input type="text" name="limstock">

<input type="submit" value="ajouter fiche">
</pre></form>
_END;
//
$query = "SELECT * FROM COMPTEURARTICLE";
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
numart $row[0]
desart $row[1]
stock $row[2]
limstock $row[3]

</pre>
<form action="connection php mysql.PHP" method="post">
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
}
?>