<?php require 'conecta.php';

$produto_id = isset($_GET['produtoId']) ? $_GET['produtoId'] : null;

$countSql = "SELECT * FROM produtos WHERE id=" . $produto_id;

$qryCount = $PDO->prepare($countSql);
$qryCount->execute();

$produto = $qryCount->fetchObject();

include 'header.php';
?>

<h2>Novo Pedido</h2>
<hr />
<form action="addPedido.php" method="post">
  <span id="valorProduto" style="display: none;"><?= $produto->valor ?></span>
  <!-- area de campos do form -->
  <div class="row">
    <div class="col-sm-6 h3">
      Você está comprando: <?= $produto->nome ?>
    </div>
    <div class="col-sm-6 text-right h3">
      Valor do Pedido: R$<span id="valorPedido"><?= $produto->valor ?></span>
    </div>
  </div>
  <hr />
  <div class="row">
    <input type="hidden" name="produto_id" value="<?= $produto->id ?>">
    <div class="form-group col-md-12">
      <label for="name">Quantidade:</label>
      <input type="number" class="form-control" id="produto_quantidade" name="produto_quantidade">
    </div>

    <div class="form-group col-md-12">
      <label for="name">Nome Cliente:</label>
      <input type="text" class="form-control" name="cliente_nome">
    </div>
    <div class="form-group col-md-12">
      <label for="name">Telefone Cliente:</label>
      <input type="text" class="form-control" name="cliente_telefone">
    </div>

    <div class="col-md-12">
      <button type="submit" class="btn btn-success">Confirmar Pedido</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
  </div>
</form>
<?php
include 'footer.php'
?>