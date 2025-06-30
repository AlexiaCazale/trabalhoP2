<div style="margin: 50px 20px 10px 40px; display: flex; flex-direction: column; gap: 15px">
	<div>
		<h1 style=" font-size: 20px; text-align: start; color: black"><?php echo $workspace->getNome() ?></h1>
		<p><?php echo $workspace->getDescricao() ?> </p>

		<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalWorkspace'>
			Adicionar usuário
		</button>
		<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalAtividade'>
			Adicionar atividade
		</button>
	</div>
</div>

<div class="row row-cols-1 row-cols-md-3 row-cols-lg-6 g-4" style="margin: 40px;">

	<?php

	foreach ($workspace->getAtividades() as $atividade) {
		$divAvatares = CompositionHandler::createUsersAvatar($atividade); // Cria o objeto div para os avatares.

		// Inicia o buffer de saída para capturar o HTML dos avatares
		ob_start();
		$divAvatares->criar(); // Esta chamada imprime para o buffer.
		$avatarsHtml = ob_get_clean(); // Captura o conteúdo do buffer.

		// Modal para cadastrar um usuário em um workspace
		echo "
		<div class='card' style='backgroud-color: #BEAFED; max-width: 280px; overflow: auto; width: 100%; '>

				<div class='card-body'>
					<h5 class='card-title'>{$atividade->getNome()}</h5>
					<p class='card-text'>
						{$atividade->getDescricao()}
					</p>
					<div style='margin-top: 15px;'>
						{$avatarsHtml} </div>
				</div>

                        <div class='text-center' style='margin: 10px;'>
                            <b>Para: </b>
                            {$atividade->getDataEntrega()->format('d/m/Y')}
                        </div>
                    </div>
                </div>

				<div class='card-footer d-flex justify-content-start align-items-center' style='gap: 10px;'>
					<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalUsuarioAtividade{$atividade->getId()}'>
						Adicionar usuário
					</button>

					<a href='/trabalhoP2/desativar_atividade?id={$atividade->getId()}' style='text-decoration: none;'><i type='button' class='ph ph-trash' style='font-size: 20px; color: red'></i></a>

					<button class='btn btn-link p-0' 
						data-bs-toggle='modal'
						data-bs-target='#modalEditarAtividade{$atividade->getId()}'
						title='Editar Atividade' style='text-decoration: none; color: black;'>
    						<i class='ph ph-pencil-simple-line' style='font-size: 20px; cursor: pointer;'></i>
					</button>
				</div>
			</div>
		";

		// Modal para adicionar um usuário à atividade
		echo <<<HTML
		<div class='modal fade' id='modalUsuarioAtividade{$atividade->getId()}' tabindex='-1' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h5 class='modal-title'>Adicionar usuário à atividade</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class='modal-body'>
						<form action='/trabalhoP2/usuario_em_atividade' method='POST'>
							<div class="mb-3">
								<label for="select-usuario-{$atividade->getId()}" class="form-label">Membro</label>
								<select class="form-select" name="id_usuario" id="select-usuario-{$atividade->getId()}" required>
									<option selected disabled value="">Selecione um membro...</option>
									
								</select>
							</div>
							<input type='hidden' value='{$atividade->getId()}' name='id_atividade'>
							<div class='modal-footer'>
								<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
								<input type='submit' class='btn btn-primary' value='Salvar'>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		HTML;

		// Modal para alterar uma atividade
		echo "
		<div class='modal fade' id='modalEditarAtividade{$atividade->getId()}' tabindex='-1'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h5 class='modal-title'>Editar Atividade</h5>
						<button type='button' class='btn-close' data-bs-dismiss='modal'></button>
					</div>
					<div class='modal-body'>
						<form id='form-editar-{$atividade->getId()}' action='/trabalhoP2/alterar_atividade' method='POST'>
							<div class='mb-3'>
								<label>Nome</label>
								<input type='text' name='nome_atividade' class='form-control' value='{$atividade->getNome()}'>
							</div>
							<div class='mb-3'>
								<label>Descrição</label>
								<textarea name='descricao_atividade' class='form-control'>{$atividade->getDescricao()}</textarea>
							</div>
							<div class='mb-3'>
								<label>Data de entrega</label>
								<input type='date' name='data_entrega_atividade' class='form-control' value='{$atividade->getDataEntrega()->format('d/m/Y')}'>
							</div>
							<input name='id_atividade' type='hidden' value='{$atividade->getId()}'>
							<div class='modal-footer'>
								<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
								<input type='submit' class='btn btn-primary' value'Alterar'></input>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		";
	}
	?>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		const form = document.getElementById("form_usuario_workspace");

		form.addEventListener("submit", function(event) {
			if (!form.checkValidity()) {
				event.preventDefault();
				event.stopPropagation();
			}

			form.classList.add("was-validated");
		}, false);
	});
</script>

<script src="View/Scripts/changeAtividade.js"></script>

<div class="modal fade" id="modalWorkspace" tabindex="-1" aria-labelledby="modalWorkspace" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="titleModalWorkspace">Adicionar usuário ao workspace</h5>
			</div>
			<div class="modal-body">
				<form id="form_usuario_workspace" method="POST" action="usuario_em_workspace">
					<label for="email_inp">Email:</label>
					<input type="email" class="form-control" id="email_inp" name="email" placeholder="E-mail do usuário" style="width: 450px;">

					<input type="hidden" value="<?= $workspace->getId() ?>" name="id_workspace">

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
						<input type="submit" class="btn btn-primary" value="Salvar">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		const form = document.getElementById("form_atividade");

		form.addEventListener("submit", function(event) {
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

					<div style="display: flex; flex-direction:column;">

						<div class="col-md-4 position-relative">
							<label for="nome_inp" class="form-label">Nome</label>
							<input type="text" class="form-control" id="nome_inp" name="nome_atv"
								placeholder="Defina um nome para a atividade" style="width: 450px;" required>
							<div class="invalid-feedback">
								Campo obrigatório!.
							</div>
						</div>

						<div class="col-md-4">
							<label for="data_inp" class="form-label">Data de entrega</label>
							<input type="date" class="form-control" id="data_inp" name="data_ent_atv"
								placeholder="Defina um nome para a atividade" style="width: 450px;" required>
							<div class="invalid-feedback">
								Campo obrigatório!.
							</div>
						</div>

						<div class="col-md-4">
							<label for="desc_inp" class="form-label">Descrição</label>
							<textarea class="form-control" id="desc_inp" name="desc_atv"
								placeholder="Escreva uma descrição para sua atividade" style="width: 450px;" required></textarea>
							<div class="invalid-feedback">
								Campo obrigatório!.
							</div>
						</div>

						<input type="hidden" name="id_workspace" value="<?= $workspace->getId() ?>" />

						<div class="mb-3 modal-footer" style="margin-top: 15px; display: flex; justify-content: end; gap: 5px">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
							<input type="submit" class="btn btn-primary" value="Salvar" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>