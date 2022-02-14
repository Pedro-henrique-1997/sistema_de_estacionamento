<?php

require_once("config.php");

try{
	$pdo = new PDO("mysql:dbname=$dbname;host=$host", "$usuario", "$senha");
}catch(Exception $e){
	echo "Não foi possivel estabelecer a conexao".$e;
}

?>