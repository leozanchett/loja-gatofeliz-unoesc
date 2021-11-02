<?php
require_once 'conecta.php';

$countSql = "SELECT COUNT(*) AS total FROM pedidos ORDER BY id ASC";
$dataSql = "SELECT pedidos.*, produtos.nome
FROM pedidos
INNER JOIN produtos ON pedidos.produto_id = produtos.id
ORDER BY id ASC";

$qryCount = $PDO->prepare($countSql);
$qryCount->execute();

$total = $qryCount->fetchColumn();

$qryData = $PDO->prepare($dataSql);
$qryData->execute();

include 'header.php'

?>

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Pedidos</h2>
		</div>
		<div class="col-sm-6 text-right h2">
			<a class="btn btn-default" href="pedidosForm.php"><i class="fa fa-refresh"></i> Atualizar</a>
		</div>
	</div>
</header>
<hr>
<table class="table table-hover">
	<thead>
		<tr>
			<th width="2%">#</th>
			<th>Produto</th>
			<th>Quantidade</th>
			<th>Nome Cliente</th>
			<th>Telefone Cliente</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($total > 0) { ?>
			<?php while ($produto = $qryData->fetch(PDO::FETCH_ASSOC)) { ?>
				<tr>
					<td><?= $produto['id']; ?></td>
					<td><?= $produto['nome']; ?></td>
					<td><?= $produto['produto_quantidade']; ?></td>
					<td><?= $produto['cliente_nome']; ?></td>
					<td><?= $produto['cliente_telefone']; ?></td>
					
					<td class="actions text-right">
						<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-pedido=1 data-id="<?= $produto['id']; ?>">
							<i class="fa fa-trash"></i> Excluir
						</a>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr>
				<td colspan="6">Nenhum produto cadastrado.</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php
include 'footer.php'
?>