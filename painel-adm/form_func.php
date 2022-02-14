<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>
<body>
	<h1>Inserir Funcionario</h1>

	<form action="insert_func.php" method="post">

		<div class="form-group">
			<label>Nome</label>
			<input type="text" class="form-control" name="nome" placeholder="Nome">		
		</div>

		<div class="form-group">
			<label>Especialidade</label>
			<input type="text" class="form-control"  name="especialidade" placeholder="Especialidade">		
		</div>

		<div class="form-group">
			<label>Setor</label>
			<input type="text" class="form-control" name="setor"  placeholder="Setor">		
		</div>

		<div class="form-group">
			<label>Cpf</label>
			<input type="text" class="form-control" name="cpf"  placeholder="Cpf">		
		</div>

		<div class="form-group">
			<label>Telefone</label>
			<input type="text" class="form-control" name="telefone" placeholder="Telefone">		
		</div>

		<div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" name="email" placeholder="Email">		
		</div>

		 <input type="submit" class="btn btn-success" value="cadastrar">
		
	</form>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>