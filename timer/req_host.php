<?php

header('Content-Type: text/plain');

$db_host = "localhost";
$db_user = "host1232814_nt32";
$db_password = "wilEXfs8";
$db_base = 'host1232814_nt32';
$db_table = "logs";

$date = date('m/d/Y h:i:s a', time());

$json = file_get_contents('php://input');
$data = json_decode($json, true);

//echo "PHP: name:".$data["name"]." score: ".$data["txt"]."\n";


if ($data !=null ) {
$name = $data["name"];
$text = $data["txt"];
$level = $data["level"];
} else {
$name = "name";
$text = "txt";
$level = 10;
}
$ip = $_SERVER['REMOTE_ADDR'];

try {    
    $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
    
    $db->exec("set names utf8");
} catch (PDOException $e) {
    
    print "!: " . $e->getMessage() . "<br/>";
}


$d1 = array( 'name' => $name, 'txt' => $text , 'ip' => $ip, "level" => $level ); 

$query = $db->prepare("INSERT INTO $db_table (user, `address`, txt, dt, `level`) values (:name, :ip,  :txt, NOW(), :level )" );
//$query = $db->prepare($qstr);
foreach ($d1 as $values)
{
    echo $values;
}

//$query->execute();
$query->execute($d1);

 

 
?>