<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

<h2 align="center" style="margin-top: 20px;"><a href='../painel-operador/pdv.php' style="text-decoration: none;"><img src="../img/logotipo_mercearia_versao_carrinho.png" style="width: 280px; height: auto;"></a></h2>


	<section class="container">
		<table id="example" class="table table-hover my-4" style=" text-align: center;">
			<thead>
				<tr>
					<th colspan="5">
						<h3>Alerta</h3>
					</th>
				</tr>
				<tr>
					<th>Nome</th>
					<th>Código</th>
					<th>Estoque</th>
					<th>Valor Venda</th>
					<th>Validade</th>
				</tr>
			</thead>	
			<tbody>
		
		<?php
			include('../conexao.php');

			$query = $pdo->query("SELECT * from produtos");
			
			while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
	
				
				if($linha['dt_indefinida']=="nao"){
					
				}else{
					$dt_nascimento=$linha['dt_validade'];
					list($ano, $mes, $dia)=explode('-', $dt_nascimento);

					/*comparar data*/

					$anoA = date("Y");
					$mesA = date("m");
					$diaA = date("d");
					$comp_ano = $ano - $anoA;
					$comp_mes = $mes - $mesA;
					$comp_dia = $dia - $diaA;
				
					
					if($comp_ano>0){
						
					}else if($comp_ano==0){
						if($comp_mes>0){
							
							
						}else if($comp_mes == 0){
							
							
						}else{
							$dt_fin=implode("/",array_reverse(explode("-",$linha['dt_validade']))); 
							echo("<tr style='background-color: #000080; color: #fff;'><td>".$linha['nome']."</td><td>".$linha['codigo']."</td><td>".$linha['estoque']."</td><td>".$linha['valor_venda']."</td><td>".$dt_fin."</td></tr>");
						}
						
					}else{
						$dt_fin=implode("/",array_reverse(explode("-",$linha['dt_validade']))); 
						echo("<tr style='background-color: #000080; color: #fff;'><td>".$linha['nome']."</td><td>".$linha['codigo']."</td><td>".$linha['estoque']."</td><td>".$linha['valor_venda']."</td><td>".$dt_fin."</td></tr>");
					}
					

	
				}
			}

			$query = $pdo->query("SELECT * from produtos");
			
			while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
	
				
				if($linha['dt_indefinida']=="nao"){
					
				}else{
					$dt_nascimento=$linha['dt_validade'];
					list($ano, $mes, $dia)=explode('-', $dt_nascimento);

					/*comparar data*/

					$anoA = date("Y");
					$mesA = date("m");
					$diaA = date("d");
					$comp_ano = $ano - $anoA;
					$comp_mes = $mes - $mesA;
					$comp_dia = $dia - $diaA;
				
					
					if($comp_ano>0){
						
					}else if($comp_ano==0){
						if($comp_mes>0){
							
							
						}else if($comp_mes == 0){
							if($comp_dia>=0){
								$dt_fin=implode("/",array_reverse(explode("-",$linha['dt_validade']))); 
								echo("<tr style='background-color: #0000ff; color: #fff;'><td>".$linha['nome']."</td><td>".$linha['codigo']."</td><td>".$linha['estoque']."</td><td>".$linha['valor_venda']."</td><td>".$dt_fin."</td></tr>");
							}else{
								$dt_fin=implode("/",array_reverse(explode("-",$linha['dt_validade']))); 
						echo("<tr style='background-color: #000080; color: #fff;'><td>".$linha['nome']."</td><td>".$linha['codigo']."</td><td>".$linha['estoque']."</td><td>".$linha['valor_venda']."</td><td>".$dt_fin."</td></tr>");
							}
						}else{
							
						}
						
					}else{
						
					}
					

	
				}
			}

		?>
			</tbody>
		</table>
	</section>
	<section>
		<?php

		?>
	</section>

