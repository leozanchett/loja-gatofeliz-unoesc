<?php
require_once 'conecta.php';

$id = isset($_POST['id']) ? $_POST['id'] : null;
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;

if (empty($nome)){
    echo "Informe um nome para o grupo";
    exit;
}

if($id == null){
    $sql = "INSERT INTO grupo(nome) VALUES (:nome)";
    $qryAdd = $PDO->prepare($sql);
    $qryAdd->bindParam(':nome', $nome);
}else{
    $sql = "UPDATE grupo SET nome = :nome WHERE id = :id";
    $qryAdd = $PDO->prepare($sql);
    $qryAdd->bindParam(':nome', $nome);
}

if($qryAdd->execute()){
    header("Location:index.php");
}else{
    echo "Erro ao cadastrar grupo";
    print_r($qryAdd->errorInfo());
}
