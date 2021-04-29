<?php
//$email = $_POST['email'];
//$password = $_POST['password'];
$host="datipomemoria.mysql.database.azure.com";
$dbUser="gioferola@datipomemoria";
$dbPwd="fufnusufre.90";
$dbName="promemoria";
$conn=mysqli_init(); 
mysqli_ssl_set($conn, NULL, NULL, "/DigiCertGlobalRootCA.crt.pem", NULL, NULL);
 mysqli_real_connect($con, "datipomemoria.mysql.database.azure.com", "gioferola@datipomemoria", "fufnusudre.90", "promemoria", 3306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$table = array();
$sql = "SELECT *
		FROM persone";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while ($row = $result->fetch_assoc()){
    	    $table[] = $row;
	    }
	}
print json_encode($table);
?>
