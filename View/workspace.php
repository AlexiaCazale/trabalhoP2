<div style="margin: 50px 20px 10px 20px; display: flex; flex-direction: column; gap: 15px">
	<div>
		<h1 style=" font-size: 20px; text-align: start; color: black"><?php echo $workspace->getNome() ?></h1>
		<p><?php echo $workspace->getDescricao() ?> </p>
		<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalWorkspace'>
			Adicionar usuário
		</button>
		<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalAtividade'>
			<!-- 
				<i class="ph ph-plus-circle" style="font-size: 20px;"></i>
				#TODO Tentar implementar o ícone no text do botão de modo melhor
			-->
			Adicionar atividade
		</button>
	</div>
</div>

<div style="display: flex; align-items: center; margin: 40px;">

	<?php

	foreach ($workspace->getAtividades() as $atividade) {
		$atividade->setUsuarios(new Usuario()); // Usuário "padrão" #TODO alterar para buscar todos os usuários
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


<script>
	document.addEventListener("DOMContentLoaded", function () {
		const form = document.getElementById("form_usuario_workspace");

		form.addEventListener("submit", function (event) {
			if (!form.checkValidity()) {
				event.preventDefault();
				event.stopPropagation();
			}

			form.classList.add("was-validated");
		}, false);
	});
</script>

<!-- Modal para registro do usuário no workspace -->
<div class="modal fade" id="modalWorkspace" tabindex="-1" aria-labelledby="modalWorkspace" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="titleModalWorkspace">Adicionar usuário ao workspace</h5>
			</div>
			<div class="modal-body">
				<form id="form_usuario_workspace" action="/trabalhoP2/usuario_em_workspace" method="POST">
					<label for="email_inp">Email:</label>
					<input type="email" id="email_inp" name="email">

					<input type="hidden" value="<?= $workspace->getId() ?>" name="id_workspace">

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<input type="submit" class="btn btn-primary" value="Save changes">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function () {
		const form = document.getElementById("form_atividade");

		form.addEventListener("submit", function (event) {
			if (!form.checkValidity()) {
				event.preventDefault();
				event.stopPropagation();
			}

			form.classList.add("was-validated");
		}, false);
	});
</script>

<div class="modal fade" id="modalAtividade" tabindex="-1" aria-labelledby="modalAtividade" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="titleModalAtividade">Criar nova atividade</h5>
			</div>
			<div class="modal-body">
				<form id="form_atividade" method="post" action="/trabalhoP2/criar_atividade" novalidate>

					<input type="hidden" name="id_workspace" value="<?= $id ?>" />


					<div style="display: flex; flex-direction:column; align-items:center">

						<div class="col-md-4 position-relative">
							<label for="nome_inp" class="form-label">Nome</label>
							<input type="text" class="form-control" id="nome_inp" name="nome_atv"
								placeholder="Defina um nome para a atividade" required>
							<div class="invalid-feedback">
								Campo obrigatório!.
							</div>
						</div>

						<div class="col-md-4">
							<label for="data_inp" class="form-label">Data de entrega</label>
							<input type="date" class="form-control" id="data_inp" name="data_ent_atv"
								placeholder="Defina um nome para a atividade" required>
							<div class="invalid-feedback">
								Campo obrigatório!.
							</div>
						</div>

						<div class="col-md-4">
							<label for="desc_inp" class="form-label">Descrição</label>
							<textarea class="form-control" id="desc_inp" name="desc_atv"
								placeholder="Escreva uma desrição para sua atividade" required></textarea>
							<div class="invalid-feedback">
								Campo obrigatório!.
							</div>
						</div>

						<input type="hidden" name="id_workspace" value="<?= $workspace->getId() ?>" />

						<div class="mb-3" style="margin-top: 15px;">
							<input type="reset" class="btn btn-subtle me-2" value="Cancelar" />
							<input type="submit" class="btn btn-primary" value="Salvar" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>