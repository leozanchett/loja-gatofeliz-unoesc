<?php

require_once 'conecta.php';

$produto_id = isset($_POST['produto_id']) ? $_POST['produto_id'] : null;
$produto_quantidade = isset($_POST['produto_quantidade']) ? $_POST['produto_quantidade'] : null;
$cliente_nome = isset($_POST['cliente_nome']) ? $_POST['cliente_nome'] : null;
$cliente_telefone = isset($_POST['cliente_telefone']) ? $_POST['cliente_telefone'] : null;

if (empty($produto_id) || empty($produto_quantidade) ||  empty($cliente_nome) || empty($cliente_telefone)) {
	echo "Preencha todos os campos.";
	exit;
}
$sql = "INSERT INTO pedidos(produto_id, produto_quantidade, cliente_nome, cliente_telefone) VALUES (:produto_id, :produto_quantidade, :cliente_nome, :cliente_telefone)";
$qryAdd = $PDO->prepare($sql);
$qryAdd->bindParam(':produto_id',$produto_id);
$qryAdd->bindParam(':produto_quantidade',$produto_quantidade);
$qryAdd->bindParam(':cliente_nome',$cliente_nome);
$qryAdd->bindParam(':cliente_telefone',$cliente_telefone);

if ($qryAdd->execute()) {
	header('Location: index.php');
} else {
	echo "Erro ao cadastrar pedido";
	print_r($qryAdd->errorInfo());
}

?>