<?php
//Set DSN
date_default_timezone_set("Asia/Tehran");
define('DB_HOST','localhost');
define('DB_USER','mdktest_obir');
define('DB_PASS','g]_&MaJZqT,@');
define('DB_NAME','mdktest_obir');
$host = DB_HOST;
$user = DB_USER;
$pass = DB_PASS;
$dbname = DB_NAME;
$dsn= "mysql:host=$host;dbname=$dbname";

try{
    // create a PDO connection with the configuration data
    $conn = new PDO($dsn, $user, $pass);

    // display a message if connected to database successfully

}catch (PDOException $e){
    // report error message
    echo $e->getMessage();
}
/*function delete_day_ip($conn){
    $stmt = $conn->prepare("INSERT INTO archived_click
SELECT * FROM day_ip;DELETE FROM day_ip;");
    $stmt->execute();
}
if( date("H:i")=="12:43"){
    delete_day_ip($conn);
}*/

$stmt = $conn->prepare("SELECT u_id,last_activit FROM users");
$row=$stmt->fetchAll();
die(var_dump($row));
foreach ($row as $user){
    $id=$user['u_id'];
    if (time()-$row['last_activity'] > 172800){
        $stmt = $conn->prepare("UPDATE users SET status=AFK WHERE u_id=?");
        $stmt->execute([$id]);
        echo $id.' -> ok';
    }
}
