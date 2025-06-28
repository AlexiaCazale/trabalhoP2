
<div style="margin: 50px 20px 10px 20px; display: flex; flex-direction: column; gap: 15px">
	<div>
		<h1 style=" font-size: 20px; text-align: start; color: black"><?php echo $workspace->getNome() ?></h1>
		<p><?php echo $workspace->getDescricao() ?> </p>
		<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalWorkspace'>
				Adicionar usuário
			</button>
	</div>

	<a href="/trabalhoP2/criar_atividade?id=<?php echo $workspace->getId() ?>" style="text-decoration: none; display: flex; align-items: center; gap: 3px"><i class="ph ph-plus-circle" style="font-size: 20px;"></i>Adicionar atividade</a>
</div>

<div style="display: flex; align-items: center; margin: 40px;">

<?php

foreach ($workspace->getAtividades() as $atividade) {
	$atividade->setUsuarios(new Usuario());
	$dataEntrega = explode(' ', $atividade->getDataEntrega())[0];
	$divAvatares = CompositionHandler::createUsersAvatar($atividade);
	// Cards de atividade 
	echo "
	<div class='card' style='backgroud-color: #BEAFED; max-width: 280px; overflow: auto; width: 100%;'>

		<div class='card-body'>
			<h5 class='card-title'>{$atividade->getNome()}</h5>
			<p class='card-text'>
				{$atividade->getDescricao()}
			</p>
		</div>

		<div class='text-center' style='margin: 10px;'>
			<b>Para: </b> 
			{$atividade->getDataEntrega()}
		</div>

		<div class='card-footer flex justify-content-start' style='display: flex; gap: 10px; align-items: center;'>
			<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalAtividade'>
				Adicionar usuário
			</button>
			<i type='button' class='ph ph-trash' style='font-size: 20px; color: red'></i>
			<i type='button' class='ph ph-pencil-simple-line' style='font-size: 20px;'></i>
		</div>

	</div>
	";
}
?>

</div>



<!-- Modal para registro do usuário no workspace -->
<div class="modal fade" id="modalWorkspace" tabindex="-1" aria-labelledby="modalWorkspace" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="titleModalWorkspace">Modal title</h5>
			</div>
			<div class="modal-body">
				<form action="/trabalhoP2/usuario_em_workspace" method="POST">
					<label for="email_inp">Email:</label>
					<input type="email" id="email_inp" name="email">

					<input type="hidden" value="<?php echo $workspace->getId() ?>" name="id_workspace">

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<input type="submit" class="btn btn-primary" value="Save changes">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>