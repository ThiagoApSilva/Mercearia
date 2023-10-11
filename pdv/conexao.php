<?php 
require_once('config.php');

date_default_timezone_set('America/Sao_Paulo');	

try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (Exception $e) {
	echo 'Erro ao Conectar com o banco de dados! <p>' .$e;
}


$servdor = "çpcalhost";
$usuario = "root";
$senha = "";
$dbname = "pdv";
$conexao = mysqli_connect($servidor, $usuario, $senha, $dbname);
 ?>