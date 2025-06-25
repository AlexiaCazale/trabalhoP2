<!-- Mostra todas as atividades do workspace -->
<?php
require_once "Component/headerWorkspace.php";
?>

<div style="display: flex; align-items: center; justify-content: center; margin: 40px;">
	<div class="card" style="backgroud-color: #BEAFED; max-width: 280px; max-height: 300px; overflow: auto;">

		<div class="card-body">
			<h5 class="card-title"><?php echo $workspace->getNome() ?></h5>
			<p class="card-text">
				<?php echo $workspace->getDescricao() ?>
			</p>
		</div>

		<?php $avatares->criar() ?>

		<div class="text-center" style="margin: 10px;">
			<b>Para: </b> September 14, 2022
		</div>

		<div class="card-footer flex justify-content-end" style="display: flex; gap: 10px;">
			<a href="/trabalhoP2/criar_atividade?id=<?php echo $workspace->getId() ?>">Criar Atividade</a>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
				Launch demo modal
			</button>
			<button type="button" class="btn btn-danger">Excluir</button>
			<button type="button" class="btn btn-discovery">Editar</button>
		</div>

	</div>

</div>

<?php

foreach ($workspace->getAtividades() as $atividade) {
	$atividade->setUsuarios(new Usuario());
	$dataEntrega = explode(' ', $atividade->getDataEntrega())[0];
	$divAvatares = CompositionHandler::createUsersAvatar($atividade);
	echo "
	<div class='border'>
		<p>Nome: {$atividade->getNome()}</p>
		<p>Descrição: {$atividade->getDescricao()}</p>
		<p>Data para entrega: {$dataEntrega}</p>"
		. $divAvatares->criar() . "
		
	</div>
	";
}

?>

<!-- Modal para registro do usuário no workspace -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>