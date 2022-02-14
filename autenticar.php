<?php

require_once("conexao.php");
@session_start();

if(empty($_POST['usuario']) || empty($_POST['senha'])){
	header("Location:index.php");
}

$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);

$res = $pdo->prepare("SELECT * from usuarios where usuario = :usuario and senha = :senha");



$res->bindValue(":usuario", $usuario);
$res->bindValue(":senha", $senha);
$res->execute();

$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados);

if($linhas > 0){
	$_SESSION['nome-usuario'] = $dados[0]['nome'];
	$_SESSION['nivel-usuario'] = $dados[0]['nivel'];

	if($_SESSION['nivel-usuario'] == 'admin'){
		header("Location:painel-adm/index.php");
	}

	if($_SESSION['nivel-usuario'] == 'funcionario'){
		header("Location:painel-func/index.php");
	}
}else{
	echo "<script languagem='javascript'>window.alert('Dados incorretos!!'); </script>";

	echo "<script languagem='javascript'>window.location='index.php'; </script>";
}


?>