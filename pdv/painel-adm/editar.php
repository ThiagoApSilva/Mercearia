<?php
@session_start();
include('../conexao.php');
if(isset($_POST['btn-editar'])){
	$id = $_SESSION['id_edit'];
	$nome = $_POST['nome'];
	$cpf = $_POST['cpf'];
	$desconto1 = $_POST['desconto'];
	$desconto = str_replace(',', '.', $desconto1);
	$cpf_confirmado = "não";

	$query_con = $pdo->query("UPDATE vendas SET nome = '$nome', cpf = '$cpf' WHERE id = '$id'");
	$query = $pdo->query("SELECT * from vendas where id ='$id'");
	$linha = $query->fetch(PDO::FETCH_ASSOC);

	if($query_con){
		$total = 0;
		$query2 = $pdo->query("SELECT * from contas_em_aberto");
		while ($linha2 = $query2->fetch(PDO::FETCH_ASSOC)) {
			if($cpf == $linha2['CPF']){
				$cpf_confirmado = "sim";
				$valor = $linha2['total_conta'];
			}else{

			}
		}
		if($cpf_confirmado == "sim"){
			$total = $valor - $desconto + $linha['valor'];
			$query_con = $pdo->query("UPDATE contas_em_aberto SET total_conta = '$total'  WHERE CPF = '$cpf'");

			$res = $pdo->prepare("INSERT INTO pagamento SET dt_pagamento = curDate(), pagamento = :pagamento, cpf = :cpf");
			$res->bindValue(":pagamento", $desconto);
			$res->bindValue(":cpf", $cpf);
			$res->execute();

			echo('<script>window.location="index.php?pagina=contas_em_aberto"</script>');
		}else{
			$total = $linha['valor']-$desconto;
			$res = $pdo->prepare("INSERT INTO contas_em_aberto SET total_conta = :total, nome = :nome, CPF = :cpf");
			$res->bindValue(":total", $total);
			$res->bindValue(":nome", $nome);
			$res->bindValue(":cpf", $cpf);
			$res->execute();

			$res2 = $pdo->prepare("INSERT INTO pagamento SET dt_pagamento = curDate(), pagamento = :pagamento, cpf = :cpf");
			$res2->bindValue(":pagamento", $desconto);
			$res2->bindValue(":cpf", $cpf);
			$res2->execute();

			echo('<script>window.location="index.php?pagina=contas_em_aberto"</script>');
		}
				
	}
}
if(isset($_POST['btn-pagar'])){
	$pagamento1 = $_POST['pagamento'];
	$pagamento = str_replace(',', '.', $pagamento1);
	$nome = $_POST['nome'];
	$id = $_SESSION['id_pagar_conta'];
	$query = $pdo->query("SELECT * from contas_em_aberto where id_contas ='$id'");
	$linha = $query->fetch(PDO::FETCH_ASSOC);
	$total = $linha['total_conta'] - $pagamento;

	$query_con = $pdo->query("UPDATE contas_em_aberto SET total_conta = '$total'  WHERE id_contas = '$id'");

	$res = $pdo->prepare("INSERT INTO pagamento SET dt_pagamento = curDate(), pagamento = :pagamento, nome = :nome, cpf = :cpf");
	$res->bindValue(":pagamento", $pagamento);
	$res->bindValue(":nome", $nome);
	$res->bindValue(":cpf", $linha['CPF']);
	$res->execute();

	echo('<script>window.location="index.php?pagina=contas_em_aberto"</script>');
}
?>
