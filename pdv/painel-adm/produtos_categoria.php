<?php

@session_start();
require_once('../conexao.php');
require_once('verificar-permissao.php');

if(isset($_GET['produ'])){
	$categoria = $_GET['categoria'];

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
			<a href="index.php?pagina=categorias" class="link"> Voltar</a>
		</button>
		<section class="container">
			<table id="example" class="table table-hover my-4" style=" text-align: center;">
				<thead>
					<tr>
						<th colspan="4">
							<h3>Produtos</h3>
						</th>
					</tr>
					<tr>
						<th>Nome</th>
						<th>Código</th>
						<th>Estoque</th>
						<th>Valor</th>
					</tr>
				</thead>	
				<tbody>
					<?php
					$query = $pdo->query("SELECT * from produtos WHERE categoria = '$categoria' ");
					while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
						?>
					<tr>
						<td>
							<?php
								echo $linha['nome'];
							?>
						</td>
						<td>
							<?php
								echo $linha['codigo'];
							?>
						</td>
						<td>
							<?php
								echo $linha['estoque'];
							?>
						</td>
						
						<td>
							<?php
								echo $linha['valor_venda'];
							?>
						</td>
					</tr>

						<?php
					}
					?>
				</tbody>
			</table>
		</section>


	</body>
</html>
<?php
}
?>
