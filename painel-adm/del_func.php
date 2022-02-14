<?php

require_once("../conexao.php");

try{

	 $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

	$delete = $pdo->prepare("DELETE FROM funcionarios  WHERE id = :id");
	$delete->bindParam(":id", $id);	
	$delete->execute();

	header("Location: index.php?acao=funcionarios");


}catch(PDOException $e){
	echo "Erro ao deletar: " . $e->getMessage();
}

?>