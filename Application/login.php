<?php
//$email = $_POST['email'];
//$password = $_POST['password'];
$host="datipomemoria.mysql.database.azure.com";
$dbUser="gioferola@datipomemoria";
$dbPwd="fufnusufre.90";
$dbName="promemoria";
$conn=mysqli_init(); 
mysqli_ssl_set($conn, NULL, NULL, "DigiCertGlobalRootCA.crt.pem", NULL, NULL);
 mysqli_real_connect($conn, "datipomemoria.mysql.database.azure.com", "gioferola@datipomemoria", "fufnusufre.90", "promemoria", 3306,MYSQLI_CLIENT_SSL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
if (mysqli_connect_errno($conn))
{
    die('Failed to connect to MySQL: '.mysqli_connect_error());
}
/*
* controllo che i parametri esistano
*/
if(!isset($_REQUEST['email'], $_REQUEST['password'])){
    exit('inserire email e password');
}
//****************************************

/*
* controllo login
*/
//recupero i dati di quell'utente se esiste
if($stmt = $con->prepare('SELECT id, password FROM persone WHERE email = ?')){
$stmt->bind_param('s', $_REQUEST['email']);
$stmt->execute();
//salvo il risultato
$stmt->store_result();
if($stmt->num_rows > 0){
$stmt->bind_result($id,$password);
$stmt->fetch();
//l'account esiste, adesso controllo se le password coincidono
if(password_verify($_REQUEST['password'], $password)){
//le password coincidono
echo "accesso effettuato";
} else {
//le password non coincidono
echo "username o password errati!";
}
} else {
//username errato
echo "username o password errati!";
}
$stmt->close();
}

?>