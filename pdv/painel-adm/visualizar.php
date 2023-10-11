<?php

@session_start();
require_once('../conexao.php');
require_once('verificar-permissao.php');

if(isset($_GET['vi'])){
	$cpf = $_GET['cpf'];
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
	<meta charset="utf-8">
	<title>visualizar</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../vendor/DataTables/datatables.min.css"/>
 
	<script type="text/javascript" src="../vendor/DataTables/datatables.min.js"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<style type="text/css">
		.botao{
			margin: 30px;
			border-radius: 20px;
		}
		.botao:hover{
			background-color: #00f;
		}

		.link{
			text-decoration: none;
		}
		.link:hover{
			color: #fff;
		}
	</style>
	</head>
	<body>
		<button class="botao">
			<a href="index.php?pagina=contas_em_aberto" class="link"> Voltar</a>
		</button>
		<section class="container">
			<table id="example" class="table table-hover my-4" style=" text-align: center;">
				<thead>
					<tr>
						<th colspan="4">
							<h3>Compras</h3>
						</th>
					</tr>
					<tr>
						<th>Data da compra</th>
						<th>Nome</th>
						<th>Valor</th>
						<th>Compra</th>
					</tr>
				</thead>	
				<tbody>
					<?php
					$query = $pdo->query("SELECT * from vendas WHERE CPF = '$cpf' ");
					while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
						?>
					<tr>
						<td>
							<?php
								$dt_fin=implode("/",array_reverse(explode("-",$linha['data']))); 
								echo $dt_fin;
							?>
						</td>
						<td>
							<?php
								echo $linha['nome'];
							?>
						</td>
						<td>
							<?php
								echo $linha['valor'];
							?>
						</td>
						
						<td>
							<a href="visualizar.php?vi=true&cpf=<?php echo($cpf); ?>&funcao=visualizar&id=<?php echo $linha['id'] ?>" title="Excluir Registro" style="text-decoration: none">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg>
							</a>
						</td>
					</tr>

						<?php
					}
					$query2 = $pdo->query("SELECT * from pagamento WHERE CPF = '$cpf' ");
					while ($linha2 = $query2->fetch(PDO::FETCH_ASSOC)) {
						?>
					<tr>
						<td>
							<?php
								$dt_fin=implode("/",array_reverse(explode("-",$linha2['dt_pagamento']))); 
								echo $dt_fin;
							?>
						</td>
						<td>
							<?php
								echo $linha2['nome'];
							?>
						</td>
						<td>
							<?php
								echo $linha2['pagamento'];
							?>
						</td>
						
						<td>
							Pagamento
						</td>
					</tr>

						<?php
					}
					$query3 = $pdo->query("SELECT * from contas_em_aberto WHERE CPF = '$cpf' ");
					$linha3 = $query3->fetch(PDO::FETCH_ASSOC);
					?>
					<tr>
						<th colspan="3">Total</th>
						<th><?php echo($linha3['total_conta']); ?></th>
					</tr>
				</tbody>
			</table>
		</section>


<div class="modal fade" tabindex="-1" id="modalVisualizar" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Adicionar Informações</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div>
				<table align="center" width="350">
					<thead>
						<tr>
							<th colspan="4">Produtos Comprados</th>	
						</tr>
						<tr>
							<th>Cod</th>
							<th>Produto</th>
							<th>Quant</th>
							<th>Valor</th>
						</tr>
					</thead>
					<tbody>
						<?php
							
						if(isset($_SESSION['id_produtos'])){
						    $produ = $_SESSION['id_produtos'];
							$query4 = $pdo->query("SELECT * from itens_venda WHERE venda = '$produ' ");
							while ($linha4 = $query4->fetch(PDO::FETCH_ASSOC)) {
								$nome_prod = $linha4['produto'];
								$query5 = $pdo->query("SELECT * from produtos WHERE id = '$nome_prod' ");
								$linha5 = $query5->fetch(PDO::FETCH_ASSOC);
						?>
								<tr>
									<td>
										<?php
											echo($linha4['produto'])
										?>
									</td>
									<td>
										<?php
											echo $linha5['nome'];
										?>
									</td>
									<td>
										<?php
											echo $linha4['quantidade'];
										?>
									</td>
									
									<td>
										<?php
											echo $linha4['valor_total'];
										?>
									</td>
								</tr>

						<?php
						}
						echo('<tr><td colspan="4" style="color: #f00;">Em caso de replicação feche e tente novamente<td><tr>');
					}else{
						echo("<tr><td>Tente Novamente<td></tr>");
					}
						?>
					
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>

<?php 
if(@$_GET['funcao'] == "visualizar"){ 
	$_SESSION['id_produtos'] = @$_GET['id'];
	
	?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('modalVisualizar'), {
			
		})

		myModal.show();
	</script>
<?php } 
?>

	</body>
</html>
<?php
}
?>
