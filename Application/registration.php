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

//*
* controllo che i parametri esistano
*/
if(!isset($_REQUEST['nome'],$_REQUEST['cognome'], $_REQUEST['email'], $_REQUEST['password'])){
  //se non inviati esce
  exit('inserire tutti i campi');
}
//****************************************

/*
  * controllo che l'email non sia già usata
  */
if($stmt = $conn->prepare('SELECT * FROM persone WHERE email = ?')){
  $stmt->bind_param('s', $_REQUEST['email']);
  $stmt->execute();
  //salvo il risultato
  $stmt->store_result();
  if($stmt->num_rows > 0){
    exit('email già usata');
  } 
  $stmt->close();
}
//********************************************

/*
*salvo l'utente
*/

if($stmt = $conn->prepare('INSERT INTO persone (nome, cognome, password, email) VALUES (?, ?, ?, ?)')){
  $password = password_hash($_REQUEST['password'],PASSWORD_BCRYPT);
  $stmt->bind_param('ssss', $_REQUEST['nome'], $_REQUEST['cognome'],$password, $_REQUEST['email']);
  $stmt->execute();
  $stmt->close();
  exit('Registrazione effettuata con successo');
}

?>