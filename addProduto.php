<?php

require_once 'conecta.php';


$id = isset($_POST['id']) ? $_POST['id'] : null;
$nome = isset($_POST['nome_produto']) ? $_POST['nome_produto'] : null;
$valor = isset($_POST['valor']) ? $_POST['valor'] : null;
$grupo_id = isset($_POST['grupo_id']) ? $_POST['grupo_id'] : null;

if (empty($nome) || empty($valor)) {
	echo "Preencha todos os campos.";
	exit;
}

if (isset($_FILES['imagem']) && $_FILES['imagem']['size'] > 0) {
	$tmpName  = $_FILES['imagem']['tmp_name'];
	$fp = fopen($tmpName, 'rb');
	if ($id != null) {
		$sql = "UPDATE produtos SET nome = :nome, valor = :valor, imagem = :imagem, grupo_id = :grupo_id WHERE id = :id";
		$qryAdd = $PDO->prepare($sql);
		$qryAdd->bindParam(':id', $id);
		$qryAdd->bindParam(':nome', $nome);
		$qryAdd->bindParam(':valor', $valor);
		$qryAdd->bindParam(':imagem', $fp, PDO::PARAM_LOB);
		$qryAdd->bindParam(':grupo_id', $grupo_id);
	} else {
		$sql = "INSERT INTO produtos(nome, valor, imagem, grupo_id) VALUES (:nome, :valor, :imagem, :grupo_id)";
		$qryAdd = $PDO->prepare($sql);
		$qryAdd->bindParam(':nome', $nome);
		$qryAdd->bindParam(':valor', $valor);
		$qryAdd->bindParam(':imagem', $fp, PDO::PARAM_LOB);
		$qryAdd->bindParam(':grupo_id', $grupo_id);
	}
} else {
	if ($id != null) {
		$sql = "UPDATE produtos SET nome = :nome, valor = :valor, grupo_id = :grupo_id WHERE id = :id";
		$qryAdd = $PDO->prepare($sql);
		$qryAdd->bindParam(':id', $id);
		$qryAdd->bindParam(':nome', $nome);
		$qryAdd->bindParam(':valor', $valor);
		$qryAdd->bindParam(':grupo_id', $grupo_id);
	} else {
		$sql = "INSERT INTO produtos(nome, valor, grupo_id) VALUES (:nome, :valor, :grupo_id)";
		$qryAdd = $PDO->prepare($sql);
		$qryAdd->bindParam(':nome', $nome);
		$qryAdd->bindParam(':valor', $valor);
		$qryAdd->bindParam(':grupo_id', $grupo_id);
	}
}

if ($qryAdd->execute()) {
	header('Location: index.php');
} else {
	echo "Erro ao cadastrar pedido";
	print_r($qryAdd->errorInfo());
}
