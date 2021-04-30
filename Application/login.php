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
printf("Reading data from table: \n");
$res = mysqli_query($conn, 'SELECT * FROM persone');
while ($row = mysqli_fetch_assoc($res))
 {
    var_dump($row);
 }
?>
