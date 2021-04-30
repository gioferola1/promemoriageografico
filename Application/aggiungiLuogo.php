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
* controllo che i parametri esistano
*/
if(!isset($_REQUEST['nome'],$_REQUEST['descrizione'], $_REQUEST['email'], $_REQUEST['latitudine'], $_REQUEST['longitudine'])){
    //se non inviati esce
    exit('inserire tutti i campi');
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
*salvo l'utente
*/

if($stmt = $conn->prepare('INSERT INTO luoghi (nome, descrizione, emailPersona, latitudine, longitudine) VALUES (?, ?, ?, ?, ?)')){
    $stmt->bind_param('sssdd', $_REQUEST['nome'], $_REQUEST['descrizione'], $_REQUEST['email'], $_REQUEST['latitudine'], $_REQUEST['longitudine']);
    $stmt->execute();
    $stmt->close();
    exit('Luogo inserito con successo');
}

?>