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


<h1 style="font-size: 18px; margin: 60px 0 40px 150px;">Criar nota</h1>

<?php $id = isset($_GET['id']) ? intval($_GET['id']) : 0; ?>

<form id="form_atividade" method="post" action="" novalidate>

	<input type="hidden" name="id_workspace" value="<?= $id ?>" />
	<a style="font-size: 16px; margin: 10px 0 40px 150px; display: flex; gap: 5px; align-items: center; cursor: pointer; text-decoration: none;" href="/trabalhoP2"><i class="ph ph-arrow-left"></i>Voltar para Home</a>


	<div style="display: flex; flex-direction:column; align-items:center">

		<div class="col-md-4 position-relative">
			<label for="nome_inp" class="form-label">Nome</label>
			<input type="text" class="form-control" id="nome_inp" name="nome_atv"
				placeholder="Defina um nome para a atividade" required>
			<div class="invalid-feedback">
				Campo obrigatório!
			</div>
		</div>

		<div class="col-md-4">
			<label for="data_inp" class="form-label">Data de entrega</label>
			<input type="date" class="form-control" id="data_inp" name="data_ent_atv"
				placeholder="Defina um nome para a atividade" required>
			<div class="invalid-feedback">
				Campo obrigatório!
			</div>
		</div>

		<div class="col-md-4">
			<label for="desc_inp" class="form-label">Descrição</label>
			<textarea class="form-control" id="desc_inp" name="desc_atv"
				placeholder="Escreva uma desrição para sua atividade" required></textarea>
			<div class="invalid-feedback">
				Campo obrigatório!
			</div>
		</div>

		<input type="hidden" name="id_workspace" value="<?= $id ?>" />

		<div class="mb-3" style="margin-top: 15px;">
			<input type="reset" class="btn btn-subtle me-2" value="Cancelar" />
			<input type="submit" class="btn btn-primary" value="Salvar" />
		</div>
	</div>
</form>