<?php
//$email = $_POST['email'];
//$password = $_POST['password'];
$host="datipomemoria.mysql.database.azure.com";
$dbUser="gioferola@datipomemoria";
$dbPwd="fufnusufre.90";
$dbName="promemoria";
$conn = new mysqli($host, $dbUser, $dbPwd, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "show tables";
$result = $conn->query($sql);
$tabelle = new array();

if($result->num_rows > 0){
    while ($tabella = $result->fetch_assoc()){
        $tabelle[] = $tabella;
} 
print json_encode($tabelle);
?>
