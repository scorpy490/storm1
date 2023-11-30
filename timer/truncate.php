<?php
/**
 * @var string $db_host
 * @var string $db_base
 * @var string $db_user
 * @var string $db_password
 */
//include ('config.php');
require('config.php');

//header('Content-Type: text/plain');

if(isset($_GET["command"])){

    $command = $_GET["command"];
}

$ip = $_SERVER['REMOTE_ADDR'];
if ($ip!='109.111.171.42' && $ip!='5.44.173.85') {
    echo json_encode('Уходим');
    exit;
}
if ($command="truncate") {

    try {
        $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);

    } catch (PDOException $e) {

        print "!: " . $e->getMessage() . "<br/>";
    }

    $query = $db->prepare("Truncate table `logs` ;");
//$query = $db->prepare($qstr);

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
}

?>