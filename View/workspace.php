<div style="margin: 50px 20px 10px 40px; display: flex; flex-direction: column; gap: 15px">
	<div>
		<h1 style=" font-size: 20px; text-align: start; color: black"><?php echo $workspace->getNome() ?></h1>
		<p><?php echo $workspace->getDescricao() ?> </p>

		<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalWorkspace'>
			Adicionar usuário ao <?php echo $workspace->getNome() ?>
		</button>
		<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalAtividade'>
			Adicionar atividade
		</button>
	</div>
</div>

<div class="row row-cols-1 row-cols-md-3 row-cols-lg-6 g-4" style="margin: 40px;">

    <?php
    foreach ($workspace->getAtividades() as $atividade) {
        $avataresHtml = CompositionHandler::compositionAfterBuffer(CompositionHandler::createUsersAvatar($atividade));
        $opcoesDeUsuarioHtml = '';
        
        $idsDeUsuariosNaAtividade = array_map(function($u) {
            return $u->getId();
        }, $atividade->getUsuarios());

        foreach ($workspace->getUsuarios() as $usuario) {
            if (!in_array($usuario->getId(), $idsDeUsuariosNaAtividade)) {
                $opcoesDeUsuarioHtml .= "<option value='{$usuario->getId()}'>" . htmlspecialchars($usuario->getNome()) . "</option>";
            }
        }

        echo "
        <div class='col'> 
            <div class='card h-100' style='background-color: #BEAFED;'>
                <div class='card-body d-flex flex-column'>
                    <div>
                        <h5 class='card-title'>{$atividade->getNome()}</h5>
                        <p class='card-text activity-card-description'>
                            {$atividade->getDescricao()}
                        </p>
                    </div>
                    <div class='mt-auto'>
                        <div style='margin-top: 15px;'>
                            {$avataresHtml} 
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
					<a href='/trabalhoP2/finalizar_atividade?id={$atividade->getId()}' style='text-decoration: none;'><i class='ph ph-check'></i></a>
                    <a href='/trabalhoP2/desativar_atividade?id={$atividade->getId()}' style='text-decoration: none;'><i class='ph ph-trash' style='font-size: 20px; color: red'></i></a>
                    <button type='button' class='btn' data-bs-toggle='modal' data-bs-target='#modalEditarAtividade{$atividade->getId()}'>
                        <i class='ph ph-pencil-simple-line' style='font-size: 20px;'></i>
                    </button>
					<button type='button' class='btn' data-bs-toggle='modal' data-bs-target='#modalDetalhesAtividade{$atividade->getId()}'>
						<i class='ph ph-info' style='font-size: 20px;'></i>
					</button>
                </div>
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
									{$opcoesDeUsuarioHtml}
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
								<input type='date' name='data_entrega_atividade' class='form-control' value='{$atividade->getDataEntrega()->format('Y-m-d')}'>
							</div>
							<input name='id_atividade' type='hidden' value='{$atividade->getId()}'>
							<div class='modal-footer'>
								<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
								<input type='submit' class='btn btn-primary' value='Alterar'></input>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		";
		// NOVO: Modal de Detalhes da Atividade
		echo <<<HTML
		<div class='modal fade' id='modalDetalhesAtividade{$atividade->getId()}' tabindex='-1' aria-labelledby='modalDetalhesAtividadeLabel{$atividade->getId()}' aria-hidden='true'>
			<div class='modal-dialog modal-lg'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h5 class='modal-title' id='modalDetalhesAtividadeLabel{$atividade->getId()}'>Detalhes da Atividade: {$atividade->getNome()}</h5>
						<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
					</div>
					<div class='modal-body'>
						<h6>Descrição</h6>
						<p>{$atividade->getDescricao()}</p>
						<h6>Data de Entrega</h6>
						<p>{$atividade->getDataEntrega()->format('d/m/Y')}</p>
						<hr>
						<h6>Membros na Atividade</h6>
						<table class='table table-striped'>
							<thead>
								<tr>
									<th scope='col' style='width: 10%;'>Avatar</th>
									<th scope='col'>Nome</th>
									<th scope='col'>Email</th>
									<th scope='col' class='text-center'>Ação</th>
								</tr>
							</thead>
							<tbody>
		HTML;

		if (empty($atividade->getUsuarios())) {
			echo "<tr><td colspan='4'>Nenhum usuário atribuído a esta atividade.</td></tr>";
		} else {
			foreach ($atividade->getUsuarios() as $usuario) {
				$avatarSrc = $usuario->getAvatar() ? htmlspecialchars($usuario->getAvatar()) : 'View/Images/user.png';
				echo "
					<tr>
						<td><img src='{$avatarSrc}' style='width: 40px; height: 40px; border-radius: 50%; object-fit: cover;' alt='Avatar de " . htmlspecialchars($usuario->getNome()) . "'></td>
						<td>" . htmlspecialchars($usuario->getNome()) . "</td>
						<td>" . htmlspecialchars($usuario->getEmail()) . "</td>
						<td class='text-center'>
							<a href='/trabalhoP2/remover_usuario_atividade?id_atividade={$atividade->getId()}&id_usuario={$usuario->getId()}' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja remover este usuário da atividade?\");' title='Remover Usuário'>
								<i class='ph ph-trash'></i>
							</a>
						</td>
					</tr>
				";
			}
		}

		echo <<<HTML
							</tbody>
						</table>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
					</div>
				</div>
			</div>
		</div>
HTML;
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
					<!--
					<select class="form-select" name="id_usuario" required>
						<option selected disabled value="">Selecione um membro...</option>
						<?php foreach ($usuarios as $user): ?>
							<option value="<?= $user->id_usuario ?>">
							<?= $user->nome_usuario ?> (<?= $user->email_usuario ?>)
							</option>
						<?php endforeach; ?>
					</select>
					-->


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
								Campo obrigatório!
							</div>
						</div>

						<div class="col-md-4">
							<label for="data_inp" class="form-label">Data de entrega</label>
							<input type="date" class="form-control" id="data_inp" name="data_ent_atv"
								placeholder="Defina um nome para a atividade" style="width: 450px;" required>
							<div class="invalid-feedback">
								Campo obrigatório!
							</div>
						</div>

						<div class="col-md-4">
							<label for="desc_inp" class="form-label">Descrição</label>
							<textarea class="form-control" id="desc_inp" name="desc_atv"
								placeholder="Escreva uma descrição para sua atividade" style="width: 450px;" required></textarea>
							<div class="invalid-feedback">
								Campo obrigatório!
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