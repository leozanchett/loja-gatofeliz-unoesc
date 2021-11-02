<?php 
require 'conecta.php';

$grupo_produtoid = isset($_GET['id']) ? $_GET['id'] : null;
if(!empty($grupo_produtoid)){
  $countSql = "SELECT * FROM grupo WHERE id=" . $grupo_produtoid;
  $qryCount = $PDO->prepare($countSql);
  $qryCount->execute();
  $grupoProduto = $qryCount->fetchObject();
}


include 'header.php';
?>
<?= ($grupo_produtoid != null) ? '<h2>Editar Grupo</h2>' : '<h2>Novo Grupo</h2>' ?>

<hr />
<form action="addGrupo.php" enctype="multipart/form-data" method="post">
  <?= ($grupo_produtoid != null) ? '<input type="hidden" name="id" value="'.$grupoProduto->id.'">' : "" ?>
  <div class="row">
    <div class="form-group col-md-12">
      <label for="name">Nome:</label>
      <input type="text" class="form-control" name="nome" value="<?= ($grupo_produtoid != null) ? $grupoProduto->nome : "" ?>">
    </div>
    <div class="col-md-12">
      <button type="submit" class="btn btn-success">Salvar</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
  </div>
</form>
<?php
include 'footer.php'
?>