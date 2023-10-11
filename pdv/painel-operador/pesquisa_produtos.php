<?php
@session_start();
include_once('../conexao.php');
$pag = "contas_em_aberto";

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta content="text/html" charset="utf-8">
		<title>pesquisa</title>
	</head>
	<body>

		<?php
		$pesquisa = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);
		$linha = ("SELECT * FROM produtos WHERE codigo LIKE '%$pesquisa%' OR nome LIKE '%$pesquisa%'");
		$resultado = mysqli_query($conexao, $linha);

		if(($resultado) and ($resultado->num_rows != 0)){
			$soma = 0;
			while ($linha = mysqli_fetch_assoc($resultado)) {
				echo('<tr><td>'.$linha["codigo"].'</td><td>'.$linha["nome"].'</td><td>'.$linha["estoque"].'</td><td>'.$linha["valor_venda"].'</td></tr>');
			}

		}else{
			echo("<tr><td colspan='3'>Nenhum resultado encontrado...".$pesquisa."</td></tr>");
		}

		?>

	</body>
</html>