<?php
$host="datipomemoria.mysql.database.azure.com";
$dbUser="gioferola@datipomemoria";
$dbPwd="fufnusufre.90";
$dbName="promemoria";
$conn=mysqli_init(); 
mysqli_ssl_set($conn, NULL, NULL, "DigiCertGlobalRootCA.crt.pem", NULL, NULL);
mysqli_real_connect($conn, "datipomemoria.mysql.database.azure.com", "gioferola@datipomemoria", "fufnusufre.90", "promemoria", 3306,MYSQLI_CLIENT_SSL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
if (mysqli_connect_errno($conn)) {
    die('Failed to connect to MySQL: '.mysqli_connect_error());
}
/*
* controllo che il parametro esista
*/
if(!isset($_REQUEST['email']) || !isset($_REQUEST['nome'])){
    exit('inserire email e nome');
}
//****************************************

/*
  * controllo che l'email sia presente
  */
if($stmt = $conn->prepare('SELECT * FROM persone WHERE email = ?')){
$stmt->bind_param('s', $_REQUEST['email']);
$stmt->execute();
//salvo il risultato
$stmt->store_result();
if($stmt->num_rows <= 0){
    exit('email non presente');
} 
$stmt->close();
}
//********************************************

/*
* rimuovo il luogo
*/

$luoghi = array();
if($stmt = $conn->prepare('DELETE FROM luoghi WHERE emailPersona = ? AND nome = ?')){
    $stmt->bind_param('ss', $_REQUEST['email'], $_REQUEST['nome']);
    $stmt->execute();
    echo "luogo eliminato";
}
//********************************************

?>
