<?php
require_once('../conexao.php');
session_start();

try{

	$nome = filter_var($_POST['nome']);
	$especialidade = filter_var($_POST['especialidade']);
	$setor = filter_var($_POST['setor']);
	$cpf = filter_var($_POST['cpf']);
	$telefone = filter_var($_POST['telefone']);
	$email = filter_var($_POST['email']);

	$res_c = $pdo->query("SELECT * from funcionarios where email = '$email' AND cpf = '$cpf' ");
	$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_c);

		//echo $linhas;


	if($linhas > 0){
		$_SESSION['msg'] = "<p style='color:red;'>Já existe um funcionario com este cpf ou email no sistema </p>";	
		header("Location: index.php?acao=funcionarios");
	}else{
		
		$inserir = $pdo->prepare("INSERT INTO funcionarios(nome, especialidade, setor, cpf, telefone, email) VALUES(:nome, :especialidade, :setor, :cpf, :telefone, :email)");
		$inserir->bindParam(":nome", $nome);
		$inserir->bindParam(":especialidade", $especialidade);
		$inserir->bindParam(":setor", $setor);
		$inserir->bindParam(":cpf", $cpf);
		$inserir->bindParam(":telefone", $telefone);
		$inserir->bindParam(":email", $email);
		$inserir->execute();
		

		$_SESSION['msg'] = "<p style='color:green;'>Usuário cadastrado com sucesso</p>";
		header("Location: index.php?acao=funcionarios");
		
	}

	

}catch(PDOException $e){
	echo "Erro ao cadastrar o funcionario " . $e->getMessage();
}


?>