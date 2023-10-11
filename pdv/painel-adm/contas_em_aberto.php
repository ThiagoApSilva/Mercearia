<?php
	@session_start();
	include('../conexao.php');
	$pag = "contas_em_aberto";
	$_SESSION['conf'] = "n";

	/*
	?>

	<section class="container">
			<table id="example" class="table table-hover my-4" style=" text-align: center;">
				<thead>
					<tr>
						<th colspan="6">
							<h3>Contas Pendentes</h3>
						</th>
					</tr>
					<tr>
						<th>Data</th>
						<th>Valor Venda</th>
						<th>Nome</th>
						<th>CPF</th>
						<th>Acões</th>
					</tr>
				</thead>	
				<tbody>

	<?php

	$query = $pdo->query("SELECT * from vendas");
	while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
	
		if($linha['forma_pgto']==4 and $linha['nome']=="sem nome"){
			$_SESSION['conf'] = "s";
		?>
			<tr>
				<td>
				<?php
					$dt_fin=implode("/",array_reverse(explode("-",$linha['data']))); 
						echo $dt_fin; 
				?>
				</td>
				<td>R$ <?php echo $linha['valor']; ?></td>
				<td><?php echo $linha['nome']; ?></td>
				<td><?php echo $linha['CPF']; ?></td>
				<td>
					<a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $linha['id'] ?>" title="Excluir Registro" style="text-decoration: none">
						<i class="bi bi-pencil-square text-primary"></i>
					</a>
				</td>
				
			</tr>
		<?php			
		}
	}
	if($_SESSION['conf']=="s"){

	}else{
		?>
		<tr>
			<td colspan="6">
				<h5 align="center">Não foi possivel encontrar contas pendentes</h5>
			</td>
		</tr>
		<?php
	}
?>
			</tbody>
		</table>
	</section>

	*/
	?>
	<br><br>
	<section class="container">
		
		<table id="example" class="table table-hover my-4" style=" text-align: center;">
			<thead>
				<tr>
					<th colspan="3">
						<h3>Contas Cadastradas</h3>
					</th>
					<th colspan="2">
						<form method="POST" id="form-pesquisa" action="">
							<input type="text" name="pesquisa" id="pesquisa" placeholder="Pesquisar CPF" onkeypress="$(this).mask('000.000.000-00')">
						</form>
					</th>
				</tr>
				<tr>
					<th>Nome</th>
					<th>CPF</th>
					<th>Valor</th>
					<th>Pagar</th>
					<th>Visualizar</th>
				</tr>
			</thead>	
			<tbody class="resultado">
				

			</tbody>
			
		</table>
		
	</section>

<!---------------------------------- processar os dados para pesquisa ------------------------------>

<script>
	$(function(){
		$("#pesquisa").keyup(function(){
			var pesquisa = $(this).val();

			if(pesquisa != ''){
				var dados = {
					palavra : pesquisa
				}
				$.post('pesquisa_contas.php', dados, function(retorna){
					$(".resultado").html(retorna);
				});
			}
		});
	});
</script>	

<div class="modal fade" tabindex="-1" id="modalEditar" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Adicionar Informações</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST" action="editar.php">
				<div class="modal-body">
					<div class="row">
						<div class="col-6">
								
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">CPF</label>
									<input type="text" class="form-control" name="cpf" placeholder="xxx.xxx.xxx-xx" onkeypress="$(this).mask('000.000.000-00')" required="" >
								</div> 
								
							</div>
						<div class="col-6">
								
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Nome</label>
									<input type="text" class="form-control" name="nome" required="">
								</div> 
								
							</div>
						</div>
					
						<div class="col-6">
								
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Desconto</label>
								<input type="text" class="form-control" name="desconto" value="0.00" required="">
							</div> 
							
						</div>
					</div>
				<div class="modal-footer">
					<button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button name="btn-editar" type="submit" class="btn btn-danger">Salvar</button>

					<input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">

				</div>
			</form>
		</div>
	</div>
</div>

<?php 
if(@$_GET['funcao'] == "editar"){ 
	$_SESSION['id_edit'] = @$_GET['id'];
	?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('modalEditar'), {
			
		})

		myModal.show();
	</script>
<?php } 
?>

<div class="modal fade" tabindex="-1" id="modalPagar" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Adicionar Informações</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST" action="editar.php">
				<div class="modal-body">
					<div class="row">
					
						<div class="col-6">
								
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Valor a ser Pago</label>
								<input type="text" class="form-control" name="pagamento" value="0,00" required="">
							</div> 
							
						</div>
						<div class="col-6">
								
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Nome do Pagador</label>
								<input type="text" class="form-control" name="nome" value="Sem nome" required="">
							</div> 
							
						</div>
					</div>
				<div class="modal-footer">
					<button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button name="btn-pagar" type="submit" class="btn btn-danger">Pagar</button>

					<input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">

				</div>
			</form>
		</div>
	</div>
</div>

<?php 
if(@$_GET['funcao'] == "pagar"){ 
	$_SESSION['id_pagar_conta'] = @$_GET['id'];

	$id = $_SESSION['id_pagar_conta'];
	$query = $pdo->query("SELECT * from contas_em_aberto where id_contas ='$id'");
	$linha = $query->fetch(PDO::FETCH_ASSOC);
	$_SESSION['valor'] = $linha['total_conta'];
	?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('modalPagar'), {
			
		})

		myModal.show();
	</script>
<?php
	
 } 
?>


<?php 
if(@$_GET['funcao'] == "visualizar"){ 
	$_SESSION['id_visualizar'] = @$_GET['id'];
	
} 
?>
