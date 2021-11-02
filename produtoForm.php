<?php 
require 'conecta.php';

$produto_id = isset($_GET['id']) ? $_GET['id'] : null;
$id_grupo_selecionado;

if(!empty($produto_id)){
  $countSql = "SELECT p.id, p.nome, p.valor, p.grupo_id, g.nome as gruponome FROM produtos p LEFT JOIN grupo g on (p.grupo_id = g.id) WHERE p.id=" .$produto_id;
  $qryCount = $PDO->prepare($countSql);
  $qryCount->execute();
  $produto = $qryCount->fetchObject();
}

$gruposSQL = "SELECT * FROM grupo";
$qryGrupo = $PDO->prepare($gruposSQL);
$qryGrupo->execute();

include 'header.php';
?>
<?= ($produto_id != null) ? '<h2>Editar Produto</h2>' : '<h2>Novo Produto</h2>' ?>

<hr />
<form action="addProduto.php" enctype="multipart/form-data" method="post">
  <?= ($produto_id != null) ? '<input type="hidden" name="id" value="'.$produto->id.'">' : "" ?>
  <div class="row">
    <div class="form-group col-md-8">
      <label for="name">Nome:</label>
      <input type="text" class="form-control" name="nome_produto" value="<?= ($produto_id != null) ? $produto->nome : "" ?>">
    </div>
    <div style="margin-top: 2%" class="form-group col-md-4 dropdown">
      <select onchange="idGrupoSelecionado()" style="margin-top:1%; width:50%; height:30px;" id="grupos" name="grupo_id">
        <?= (empty($produto_id)) ? '<option name="grupo_null" value="null" selected></option>' : '<option name="grupo_null" value="null"></option>'?>
        <?php while ($grupo = $qryGrupo->fetch(PDO::FETCH_ASSOC)) { ?>
          <?= ($produto->grupo_id == $grupo['id']) ? '<option value="'.$grupo['id'].'" selected>'.$grupo['nome'].'</option>' : '<option value="'.$grupo['id'].'">'.$grupo['nome'].'</option>' ?>
        <?php } ?>
      </select>
    </div>
    <div class="form-group col-md-12">
      <label for="name">Valor:</label>
      <input type="number" class="form-control" name="valor" value="<?= ($produto_id != null) ? $produto->valor : "" ?>">
    </div>
    <div class="form-group col-md-12">
      <label for="name">Imagem:</label>
      <input type="file" class="form-control-file" name="imagem">
    </div>
    <div class="col-md-12">
      <button type="submit" class="btn btn-success">Salvar</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>    
  </div>
</form>
<?php
include 'footer.php';
?>

<script>
function idGrupoSelecionado() {
    d = document.getElementsByName("grupo_id").value;
    //alert(d);
}
</script>