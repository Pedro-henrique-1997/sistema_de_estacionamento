<?php

$notificacoes = 3;

require_once('../conexao.php');

@session_start();
if(!isset($_SESSION['nome-usuario'])){
	header("Location:../index.php");
}

//VARIAVEIS DO MENU
$item1 = "home";
$item2 = "funcionarios";
$item3 = "clientes";
$item4 = "usuarios";
$item5 = "notificacoes";


//VERIFICAR QUAL O MENU CLICADO E PASSAR A CLASSE ATIVO
if(@$_GET['acao'] == $item1){
	$item1Ativo = 'active';
}elseif(@$_GET['acao'] == $item2 or isset($_GET[$item2])){
	$item2Ativo = 'active';
}elseif(@$_GET['acao'] == $item3){
	$item3Ativo = 'active';
}elseif(@$_GET['acao'] == $item4  or isset($_GET[$item4])){
	$item4Ativo = 'active';
}elseif(@$_GET['acao'] == $item5){
	$item5Ativo = 'active';
}else{
	$item1Ativo = 'active'; 
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Painel Administrativo</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="../css/painel.css">

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-light bg-light">
		<div class="col-md-12">
			<img class="float-left" src="../img/logo-painel.png">
			<li class="float-right nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Administrador - <?php echo $_SESSION['nome-usuario']?>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="../logout.php">Sair</a>
				</div>
			</li>


		</div>
	</nav>

	<div class="container-fluid mt-4">
		<div class="row">
			<div class="col-md-3 col-sm-12 mb-4">
				<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					<a class="nav-link <?php echo $item1ativo?>" id="v-pills-home-tab" href="index.php?acao=<?php echo $item1 ?>" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-home mr-1"></i>Home</a>
					<a class="nav-link <?php echo $item2ativo?>"  id="link-funcionarios"  href="index.php?acao=<?php echo $item2?>" role="tab" aria-controls="v-pills-profile"  aria-selected="false"><i class="fas fa-user-md mr-1"></i>Cadastro de Funcionarios</a>
					<a class="nav-link <?php echo $item3ativo?>" id="v-pills-messages-tab"  href="index.php?acao=<?php echo $item3 ?>" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="far fa-user mr-1"></i>Cadastro de Clientes</a>

					<a class="nav-link <?php echo $item4Ativo?>" href="index.php?acao=<?php echo $item4 ?>" role="tab" aria-controls="v-pills-profile" aria-selected="false">Cadastro de Usuarios</a>

					<?php if ($notificacoes > 0) {?>
						<a class="nav-link <?php echo $item4ativo?>" id="v-pills-messages-tab"  href="index.php?acao=<?php echo $item5 ?>" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="far fa-user mr-1"></i>Notificações</a>
					<?php 	} ?>
				</div>
			</div>

			<div class="col-md-9 col-sm-12">
				<div class="tab-content" id="v-pills-tabContent">

					<div class="tab-pane fade show active"  role="tabpanel">
						<?php if(@$_GET['acao'] == $item1){
							include_once($item1.".php"); 
					}elseif(@$_GET['acao'] == $item2 or isset($_GET[$item2])){
							include_once($item2.".php"); 
					}elseif(@$_GET['acao'] == $item3){
							include_once($item3.".php"); 
					}elseif(@$_GET['acao'] == $item4 or isset($_GET[$item4])){
							include_once($item4.".php");

					}elseif(@$_GET['acao'] == $item5){
							include_once($item5.".php");
							}else{
						include_once($item1.".php"); 
						}
						?>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>

</body>
</html>