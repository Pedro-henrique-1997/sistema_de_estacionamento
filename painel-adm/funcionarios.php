<?php require_once('../conexao.php') ?>

<a href="form_func.php"><button type="button" class="btn btn-primary"> Novo Funcionario</button></a>

<div class="row mt-4">
	<div class="col-md-6 col-sm-12">
		<div class="float-left">
			
			<label class="registro" for="exampleFormControlSelect1">Registros</label>
			<select class="form-control-sm" id="exampleFormControlSelect1">
				<option>10</option>
				<option>25</option>
				<option>50</option>

			</select>
			
		</div>
	</div>

	<div class="col-md-6 col-sm-12">

		<div class="float-right mr-4">
			<div class="input-group">
				<input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
				aria-describedby="search-addon" />
				<button type="button" class="btn btn-outline-primary" name="<?php echo $item2?>">search</button>
			</div>
		</div>
		
	</div>

	<table class="table table-bordered">
  <thead>

  	<?php $ver_funcionarios = $pdo->query("SELECT * FROM funcionarios");
       
  	 ?>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Especialidade</th>
      <th scope="col">Setor</th>
      <th scope="col">CPF</th>
      <th scope="col">telefone</th>
      <th scope="col">Email</th>
      <th scope="col" width="200px">Ações</th>
    </tr>
  </thead>
  <tbody>
  	<?php while($linhas = $ver_funcionarios->fetch(PDO::FETCH_ASSOC)) {
   echo " <tr>
      <th scope='row'>$linhas[nome]</th>
      <td>$linhas[especialidade]</td>
      <td>$linhas[setor]</td>
      <td>$linhas[cpf]</td>
      <td>$linhas[telefone]</td>
      <td>$linhas[email]</td>
      <td>
      	<a href='edit_func.php?id=$linhas[id]'><button type='button' style='font-size: 16px; '' margin:0 1em 0 0; class='btn btn-warning'>Alterar</button ></a>
      	<a href='del_func.php?id=$linhas[id]'><button type='button' class='btn btn-danger'style='font-size: 16px;'' >Deletar</button></a>
      </td>
    </tr>";

    ?>
    <?php  } ?>
  </tbody>
</table>





<!--MASCARAS -->

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script src="../js/mascaras.js"></script>