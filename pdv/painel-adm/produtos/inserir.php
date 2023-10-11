<?php 
require_once("../../conexao.php");

$nome = $_POST['nome'];
$codigo = $_POST['codigo'];
$valor_venda = $_POST['valor_venda'];
$valor_venda = str_replace(',', '.', $valor_venda);
$descricao = $_POST['descricao'];
$categoria = $_POST['categoria'];
$dt_validade = $_POST['data'];
$controle = $_POST['controle'];
$estoque = $_POST['estoque'];
$minimo = $_POST['minimo'];
$id = $_POST['id'];

$antigo = $_POST['antigo'];
$antigo2 = $_POST['antigo2'];

// EVITAR DUPLICIDADE NO NOME
if($antigo != $nome){
	$query_con = $pdo->prepare("SELECT * from produtos WHERE nome = :nome");
	$query_con->bindValue(":nome", $nome);
	$query_con->execute();
	$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res_con) > 0){
		echo 'Produto já Cadastrado!';
		exit();
	}
}


// EVITAR DUPLICIDADE NO CÓDIGO
if($antigo2 != $codigo){
	$query_con = $pdo->prepare("SELECT * from produtos WHERE codigo = :codigo");
	$query_con->bindValue(":codigo", $codigo);
	$query_con->execute();
	$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res_con) > 0){
		echo('<script>window.alert("codigo ja existente")</script>');
		exit();
	}
}



//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['imagem']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../img/produtos/' .$nome_img;
if (@$_FILES['imagem']['name'] == ""){
  $imagem = "sem-foto.jpg";
}else{
    $imagem = $nome_img;
}

$imagem_temp = @$_FILES['imagem']['tmp_name']; 
$ext = pathinfo($imagem, PATHINFO_EXTENSION);   
if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
move_uploaded_file($imagem_temp, $caminho);
}else{
	echo 'Extensão de Imagem não permitida!';
	exit();
}



if($id == ""){
	$res = $pdo->prepare("INSERT INTO produtos SET codigo = :codigo, nome = :nome, descricao = :descricao, estoque = :estoque, valor_venda = :valor_venda, quantidade_min = :minimo, categoria = :categoria, dt_validade = :data, dt_indefinida = :controle, foto = :foto");
	$res->bindValue(":codigo", $codigo);
	$res->bindValue(":nome", $nome);
	$res->bindValue(":descricao", $descricao);
	$res->bindValue(":valor_venda", $valor_venda);
	$res->bindValue(":minimo", $minimo);
	$res->bindValue(":categoria", $categoria);
	$res->bindValue(":data",$dt_validade);
	$res->bindValue(":controle",$controle);
	$res->bindValue(":foto", $imagem);
	$res->bindValue(":estoque", $estoque);
	$res->execute();

	
}else{

	if($imagem != 'sem-foto.jpg'){
		$res = $pdo->prepare("UPDATE produtos SET codigo = :codigo, nome = :nome, descricao = :descricao, estoque = :estoque, valor_venda = :valor_venda, categoria = :categoria, dt_validade = :data, dt_indefinida = :controle, foto = :foto WHERE id = :id");
		$res->bindValue(":foto", $imagem);
		$res->bindValue(":codigo", $codigo);
		$res->bindValue(":nome", $nome);
		$res->bindValue(":descricao", $descricao);
		$res->bindValue(":valor_venda", $valor_venda);
		$res->bindValue(":minimo", $minimo);
		$res->bindValue(":categoria", $categoria);
		$res->bindValue(':data',$dt_validade);
		$res->bindValue(":controle",$controle);
		$res->bindValue(":estoque", $estoque);
		$res->bindValue(":id", $id);
		$res->execute();
	}else{
		$res = $pdo->prepare("UPDATE produtos SET codigo = :codigo, nome = :nome, descricao = :descricao, estoque = :estoque, valor_venda = :valor_venda, quantidade_min = :minimo, categoria = :categoria, dt_validade = :data, dt_indefinida = :controle, foto = :foto WHERE id = :id");
		$res->bindValue(":codigo", $codigo);
		$res->bindValue(":nome", $nome);
		$res->bindValue(":descricao", $descricao);
		$res->bindValue(":valor_venda", $valor_venda);
		$res->bindValue(":minimo", $minimo);
		$res->bindValue(":categoria", $categoria);
		$res->bindValue(':data',$dt_validade);
		$res->bindValue(":controle",$controle);
		$res->bindValue(":foto", $imagem);
		$res->bindValue(":estoque", $estoque);
		$res->bindValue(":id", $id);
		$res->execute();
	}
}

echo('cadastrado com sucesso!');


?>