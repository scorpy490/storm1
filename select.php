<?php
include ('config.php');

//header('Content-Type: text/plain');
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
if ($ip!='109.111.171.42' && $ip!='5.44.173.85') {
    echo ('Уходим');
    exit;
}



try {    
    $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
    
    $db->exec("set names utf8");
} catch (PDOException $e) {
    
    print "!: " . $e->getMessage() . "<br/>";
}


$d1 = array( 'name' => $name, 'txt' => $text , 'ip' => $ip, "level" => $level ); 

//$query = $db->prepare("INSERT INTO $db_table (user, `address`, txt, dt, `level`) values (:name, :ip,  :txt, NOW(), :level )" );
$query = $db->prepare("SELECT user, address, txt, dt FROM `logs` ;");
//$query = $db->prepare($qstr);
foreach ($d1 as $values)
{
    //echo $values;
}
//echo $db_table;

//$query->execute();
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$json_output = json_encode($result);

// Вывод результата
echo $json_output;







?>