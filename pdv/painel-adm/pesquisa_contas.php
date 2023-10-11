<?php
@session_start();
include_once('../conexao.php');
$pag = "contas_em_aberto";

$pesquisa = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);
$linha = ("SELECT * FROM contas_em_aberto WHERE CPF LIKE '%$pesquisa%' ");
$resultado = mysqli_query($conexao, $linha);

if(($resultado) and ($resultado->num_rows != 0)){
	$soma = 0;
	while ($linha = mysqli_fetch_assoc($resultado)) {
		echo('<tr><td>'.$linha["nome"].'</td><td>'.$linha["CPF"].'</td><td>R$ '.$linha["total_conta"].'</td><td><a href="index.php?pagina='.$pag.'&funcao=pagar&id='.$linha["id_contas"].'" title="Pagar" style="text-decoration: none">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
  <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
  <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
  <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
</svg>
					</a></td><td><a class="nav-link" href="visualizar.php?vi=true&cpf='.$linha['CPF'].'" title="Visualizar">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
</svg>
					</a></td></tr>');
		$cpf = $linha['CPF'];
		$soma = $soma+$linha['total_conta'];
	}
	?>
	

	
	<?php
	if(isset($_POST['descontar'])){
		$cpf_desc = $_POST['cpf'];
		$desconto = $_POST['desconto'];
		$query2 = $pdo->query("SELECT * from contas_em_aberto WHERE CPF = '$cpf_desc' ");
		$linha2 = $query2->fetch(PDO::FETCH_ASSOC);
		$total = $linha2['total_conta'] - $desconto;
		$query_con2 = $pdo->query("UPDATE contas_em_aberto SET total_conta = '$total'  WHERE CPF = '$cpf'");
	}

}else{
	echo("<tr><td colspan='3'>Nenhum resultado encontrado...".$pesquisa."</td></tr>");
}
?>
