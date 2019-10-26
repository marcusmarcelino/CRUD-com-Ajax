<?php
$hostname = "localhost";
$user = "root";
$password = "";
$database = "mysqlDataManager";

$conn = mysqli_connect ($hostname,$user,$password,$database);

if(!$conn){
   echo die("Falha na conexão".mysqli_connect_error());
}//else {echo "Parabéns!! A conexão ao banco de dados ocorreu normalmente!";}
?>