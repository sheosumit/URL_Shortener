<?php 

//include database connection file
include('Database_Connect.php');

//redirect to real link if URL is set
if (!empty($_GET['url'])) { 
	$redirect = mysql_fetch_assoc(mysql_query("SELECT full_url FROM url_table WHERE short_url = '".addslashes($_GET['url'])."'"));
	$redirect = "http://".str_replace("http://","",$redirect[full_url]);
	header('HTTP/1.1 301 Moved Permanently');  
	header("Location: ".$redirect);  
}


function id_to_short_url($n)
{   $chars = array("a","b","c","d","e","f","g","i","h","j","k","l","m","n","p","q","r","s","t","u","v","w","x","y","o","z","0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F","G","H","I","J","K","L","M","N","P","Q","R","S","T","V","W","X","Y","Z","O","U");
    if($n >= 62) {
        $r= id_to_short_url(floor($n / 62)-1).$chars[$n % 62];
    } else {
        $r= $chars[$n];
		}
    
return $r;
}
 
 
$row =  mysql_fetch_array(mysql_query("SELECT MAX(url_id) AS max_page FROM url_table"));
$id= $row["max_page"];

 settype($id, "int");
if (!empty($_POST['url'])) { $result = mysql_query("SELECT short_url FROM url_table WHERE full_url = '".$_POST['url']."'") or exit(mysql_error());
if( mysql_num_rows($result) > 0 ) {
   $short=$result;
}
else {
  



$short =id_to_short_url($id);




mysql_query("INSERT INTO url_table (full_url, short_url) VALUES

	(
	'".addslashes($_POST['url'])."',
	'".$short."'
	
	)

");

$redirect = "?s=$short";
header('Location: '.$redirect); die;

} }
//

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sumit_11211021</title>
<style type="text/css">
<!--
body {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 20px;
	text-align: center;
}
input {
	font-size: 15px;
	padding: 10px;
}
h2 {
	font-size: 16px;
	margin: 0px;
	padding: 0px;
}
h1 {
	margin: 0px;
	padding: 0px;
	font-size: 20px;
	color: #765645;
}
form {
	margin: 0px;
	padding: 0px;
}
h3 {
	font-size: 13px;
	color: #454545;
	font-weight: normal;
}
h3 a {
	color: #ffffff;
	text-decoration: none;
}
table {
	font-size: 13px;
	background-color: #234354;
	border: 1px solid #878767;
}
-->
</style>
</head>

<body>


<h1> URL to be Shortened: </h1>
<form id="form1" name="form1" method="post" action="">
  <input name="url" type="text" id="url"  size="75" />
  <input type="submit" name="Submit" value="Shorten" />
</form>


<?php if (!empty($_GET['s'])) { ?>
<br />
<h2>Shortened URL: <a href="<?php include('Database_Connect.php');  $r=mysql_query("SELECT full_url FROM url_table WHERE short_url = '".$_GET['s']."'") ; 

while ($row = mysql_fetch_array($r, MYSQL_ASSOC)) {
    echo $row['full_url']; } ?>" target="_blank"><?php echo $server_name; ?><?php include('Database_Connect.php');  $r=mysql_query("SELECT short_url FROM url_table WHERE short_url = '".$_GET['s']."'") ; 

while ($row = mysql_fetch_array($r, MYSQL_ASSOC)) {
    echo $row['short_url'];} ?></a></h2>
<?php } ?>
<!---->

<br />
<br />

</body>
</html>
