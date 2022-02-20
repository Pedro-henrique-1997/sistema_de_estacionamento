<!DOCTYPE html>
<html>
<head>
	<title>Pesquisar</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>

	<h1>Pesquise um funcionario</h1>

	<a href="index.php?acao=funcionarios"><button type="button" class="btn btn-primary">Voltar Para funcionarios</button></a>	

	<br>
	<br>

<form method="POST" action="">
	<div class="float-center mr-4">
		<div class="input-group">
			<label>Nome: </label>
			<input type="text" name="nome" placeholder="Digite o nome" aria-label="Search"
				aria-describedby="search-addon"><br><br>
			
			<input name="SendPesqFunc" class="btn btn-outline-primary" type="submit" value="Pesquisar">
		</div>
	</div>
		</form><br><br>

	<?php
	 require_once('../conexao2.php');
     
     $SendPesqFunc = filter_input(INPUT_POST, 'SendPesqFunc', FILTER_SANITIZE_STRING);
     if($SendPesqFunc){
     	$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);

     	$result_func = "SELECT * FROM funcionarios WHERE nome LIKE '%$nome%' ";
     	$resultado_func = mysqli_query($conexao, $result_func);
     	while($row_func = mysqli_fetch_assoc($resultado_func))
     	{
     		echo "Nome: " . $row_func['nome'] . "<br>";
     		echo "Especialidade: " . $row_func['especialidade'] . "<br>";
     		echo "Setor: " . $row_func['setor'] . "<br>";
     		echo "CPF: " . $row_func['cpf'] . "<br>";
     		echo "Telefone: " . $row_func['telefone'] . "<br>";
     		echo "Email: " . $row_func['email'] . "<br>";
     		echo "<a href='edit_func.php?id=$row_func[id]'><button type='button' style='font-size: 16px; '' margin:0 1em 0 0; class='btn btn-warning'>Alterar</button ></a>";
     		echo "<a href='del_func.php?id=$row_func[id]'><button type='button' class='btn btn-danger'style='font-size: 16px;'' >Deletar</button></a><br>";

     		echo "<hr>";
     	}
     }


	?>
</form>
</body>
</html>