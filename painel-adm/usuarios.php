<?php require_once('../conexao.php') ?>
<?php $pagina = 'usuarios' ?>


<div class="row botao-novo">
	<div class="col-md-12">
		<button data-toggle="modal" data-target="#modal" type="button" class="btn btn-secondary">Novo funcionario</button>
	</div>
</div>

<div class="row mt-4">
	<div class="col-md-6 col-sm-12">
		<form method="post">

			<div class="float-left">


				<select onChange="submit(); " class="form-control-sm" id="exampleFormControlSelect1" name="items-pagina">
					<option value=""> <?php echo @$_POST['items-pagina'] ?> Registros</option>

					<?php if(@$_POST['items-pagina'] != $opcao1)
					{ ?>
					 <option value="<?php echo $opcao1 ?>"> <?php echo $opcao1 ?>Registros</option>

					<?php } ?>

					<?php if(@$_POST['items-pagina'] != $opcao2)
					{ ?>
					 <option value="<?php echo $opcao2 ?>"> <?php echo $opcao2 ?>Registros</option>

					<?php } ?>
										
					<?php if(@$_POST['items-pagina'] != $opcao3)
					{ ?>
					 <option value="<?php echo $opcao3 ?>"> <?php echo $opcao3 ?>Registros</option>

					<?php } ?>

				</select>



			</div>
		</form>
	</div>

	<div class="col-md-6 col-sm-12">

		<div class="float-right mr-4">
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control form-control-sm mr-sm-2" type="search" placeholder="Buscar Nome" aria-label="Search" name="txtbuscar">
				<button class="btn btn-outline-secondary btn-sm my-2 my-sm-0" type="submit" name="<?php echo $pagina ?>"><i class="fas fa-search"></i>Pesquisar</button>
			</form>
		</div>
		
	</div>

	
</div>

<table class="table table-bordered">
	<thead>
		<tr>
			<th scope="col">Nome</th>
			<th scope="col">Usuario</th>
			<th scope="col">Senha</th>							
			<th scope="col">Nivel</th>      
			<th scope="col" width="200px">Ações</th>
		</tr>
	</thead>
	<tbody>

		<?php

		//Definir o numero de itens por pagina

		if(isset($_POST['items-pagina'])){
			$itens_por_pagina = $_POST['items-pagina'];
		}else{
			$itens_por_pagina = 5;
		}

		//Pegando a pagina atual

		$pagina_pag = intval(@$_GET['pagina']);
		$limite = $pagina_pag * $itens_por_pagina;

		//Caminho da paginação


		$caminho_pag = 'index.php?acao='.$pagina.'&'; 


		if(isset($_GET[$item4]) and $_GET['txtbuscar'] != ''){
			$nome_buscar = '%'.@$_GET['txtbuscar'].'%';
			$res = $pdo->prepare("SELECT * from usuarios where nome LIKE :nome order by nome asc  LIMIT $limite, $itens_por_pagina");
			$res->bindValue(":nome", $nome_buscar);
			$res->execute();
		}else{
			$res = $pdo->query("SELECT * from usuarios order by nome asc LIMIT $limite, $itens_por_pagina");
		}



		$dados = $res->fetchAll(PDO::FETCH_ASSOC);

		//Totalizando os registros
		$res_todos = $pdo->query("SELECT * from usuarios");
		$dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
		$num_total = count($dados_total);

		//Totalizando o numero de paginas

		$num_paginas = ceil($num_total/$itens_por_pagina);


		for ($i=0; $i < count($dados); $i++) { 
			foreach ($dados[$i] as $key => $value) {
			}

			$id = $dados[$i]['id'];	
			$nome = $dados[$i]['nome'];
			$usuario = $dados[$i]['usuario'];
			$senha = $dados[$i]['senha'];	
			$senha_original = $dados[$i]['senha_original'];		
			$nivel = $dados[$i]['nivel'];

			
			$linhas = count($dados);


			?>
			<tr>
				<td><?php echo $nome ?></td>
				<td><?php echo $usuario?></td>				
				<td><?php echo $senha_original?></td>
				<td><?php echo $nivel?></td>
				
				<td>
					<a href="index.php?acao=<?php echo $pagina; ?>&funcao=editar&id=<?php echo $id ?>"> <button type="button" style="font-size: 16px; margin:0 1em 0 0;" class="btn btn-warning" type="button" class="btn btn-primary" data-toggle="modal" id="#modalExemplo" >Alterar</button></a>
					<a href="index.php?acao=<?php echo $pagina; ?>&funcao=excluir&id=<?php echo $id ?>">
						<button type="button" class="btn btn-danger"style="font-size: 16px;" >Deletar</button></a>
					</td>
				</tr>

			<?php } ?>
		</tbody>

	</table>


	<nav aria-label="Page navigation example">
		<ul class="pagination">
			<li class="page-item">
				<a class="btn btn-outline-dark mr-1" href="<?php echo $caminho_pag; ?>pagina=0" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
					<span class="sr-only">Previous</span>
				</a>
			</li>
			<?php 
			for($i=0;$i<$num_paginas;$i++){
				$estilo = "";
				if($pagina_pag == $i)
					$estilo = "active";
				?>
				<li class="page-item"><a class="btn btn-outline-dark mr-1 <?php echo $estilo; ?>" href="<?php echo $caminho_pag; ?>pagina=<?php echo $i; ?>"><?php echo $i+1; ?></a></li>
			<?php } ?>

			<li class="page-item">
				<a class="btn btn-outline-dark" href="<?php echo $caminho_pag; ?>pagina=<?php echo $num_paginas-1; ?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
					<span class="sr-only">Next</span>
				</a>
			</li>
		</ul>
	</nav>


	<!-- Modal Para cadastrar-->
	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Cadastro de Funcioncarios</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>


				<div class="modal-body">


					<form method="post">
						
						<div class="form-group">
							<label for="exampleFormControlInput1">Nome</label>
							<input type="text" class="form-control" id="" placeholder="Insira o Nome" name="nome">
						</div>



						<div class="form-group">
							<label for="exampleFormControlInput1">Email</label>
							<input type="email" class="form-control" id="" name="usuario" placeholder="Insira o Email">
						</div>



						<div class="form-group">
							<label for="exampleFormControlInput1">Senha</label>
							<input type="password" class="form-control" id="" placeholder="Insira a Senha" name="senha" >
						</div>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

						<button type="submit" name="btn-salvar" class="btn btn-primary">Salvar</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Codigo do botão salvar-->
	
	<?php 
	if(isset($_POST['btn-salvar'])){
		$nome = $_POST['nome'];
		$usuario = $_POST['usuario'];
		$senha = $_POST['senha'];
		$senha_cript = md5($senha);


	//VERIFICAR SE O USUÁRIO JÁ ESTÁ CADASTRADO
		$res_c = $pdo->query("SELECT * from usuarios where usuario = '$usuario'");
		$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
		$linhas = count($dados_c);
		if($linhas == 0){
			$res = $pdo->prepare("INSERT into usuarios (nome, usuario, senha, senha_original, nivel) values (:nome, :usuario, :senha, :senha_original, :nivel) ");

			$res->bindValue(":nome", $nome);
			$res->bindValue(":usuario", $usuario);
			$res->bindValue(":senha", $senha_cript);
			$res->bindValue(":senha_original", $senha);
			$res->bindValue(":nivel", 'admin');

			$res->execute();


			echo "<script language='javascript'>window.location='usuarios.php?acao=$pagina </script>";

		}else{
			echo "<script language='javascript'>window.alert('Este usuário já está cadastrado!!'); </script>";
		}



	}

	?>

	<!-- Buscar dados do usuario a ser editado-->
	
	<?php 
	if(@($_GET['funcao']) == 'editar'){
		$id_usuario = $_GET['id'];

	//BUSCAR O USUARIO A SER EDITADO
		$res_c = $pdo->query("SELECT * from usuarios where id = '$id_usuario'");
		$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
		$nome_usuario = $dados_c[0]['nome'];
		$email_usuario = $dados_c[0]['usuario'];
		$senha_usuario = $dados_c[0]['senha_original'];
        $email_usuario_rec = $dados[0]['usuario'];
		?>

		<!-- Modal -->
		<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Cadastro de Usuários</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">


						<form method="post">


							<div class="form-group">
								<label for="exampleFormControlInput1">Nome</label>
								<input type="text" class="form-control" id="" placeholder="Insira o Nome" name="nome" value="<?php echo $nome_usuario ?>">
							</div>



							<div class="form-group">
								<label for="exampleFormControlInput1">Email</label>
								<input type="email" class="form-control" id="" name="usuario" placeholder="Insira o Email" value="<?php echo $email_usuario ?>">
							</div>



							<div class="form-group">
								<label for="exampleFormControlInput1">Senha</label>
								<input type="password" class="form-control" id="" placeholder="Insira a Senha" name="senha" value="<?php echo $senha_original ?>">
							</div>


						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

							<button type="submit" name="btn-editar" class="btn btn-primary">Salvar</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php 
		if(isset($_POST['btn-editar'])){
			$nome = $_POST['nome'];
			$usuario = $_POST['usuario'];
			$senha = $_POST['senha'];
			$senha_cript = md5($senha);

	//VERIFICAR SE O USUÁRIO JÁ ESTÁ CADASTRADO SOMENTE SE FOR TROCADO O USUÁRIO
			if($email_usuario_rec != $usuario){
				$res_c = $pdo->query("select * from usuarios where usuario = '$usuario'");
				$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
				$linhas = count($dados_c);
				if($linhas = 0){

					echo "<script language='javascript'>window.alert('Este usuário já está cadastrado!!'); </script>";
					exit();
				}
			}


			$res = $pdo->prepare("UPDATE usuarios set nome = :nome, usuario = :usuario, senha = :senha_cript, senha_original = :senha where id = :id ");

			$res->bindValue(":nome", $nome);
			$res->bindValue(":usuario", $usuario);
			$res->bindValue(":senha", $senha);
			$res->bindValue(":senha_cript", $senha_cript);
			$res->bindValue(":id", $id_usuario);


			$res->execute();


			echo "<script language='javascript'>window.location='index.php?acao=$pagina'; </script>";





		}

		?>

	<?php } ?>





	

	<?php 
	if(@$_GET['funcao'] == 'excluir'){
		$id_usuario = $_GET['id'];
		$res = $pdo->query("DELETE FROM usuarios  where id = '$id_usuario'");

		echo "<script language='javascript'>window.alert('Registro Deletado!!'); </script>";
		 "<script language='javascript'>window.location='usuarios.php'; </script>";

	}

	?>
	

	<!--MASCARAS -->
	<script>$("#modalEditar").modal("show");</script>
	

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

	<script src="../js/mascaras.js"></script>