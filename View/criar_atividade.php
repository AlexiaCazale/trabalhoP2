<!-- Cria atividade que será exibida no Workspace -->
<?php

require_once "View/Component/headerWorkspace.php";

?>

<h1 style="font-size: 18px; margin: 60px 0 40px 150px;">Criar nota</h1>

<form class="was-validated" method="POST" action="">

	<div style="display: flex; flex-direction:column; align-items:center">

		<div class="col-md-4 position-relative">
			<label for="nome_inp" class="form-label">Nome</label>
			<input type="text" class="form-control" id="nome_inp" name="nome_atv" placeholder="Defina um nome para a atividade" required>
			<div class="invalid-feedback">
				Campo obrigatório!.
			</div>
		</div>

		<div class="col-md-4">
			<label for="data_inp" class="form-label">Data de entrega</label>
			<input type="date" class="form-control" id="data_inp" name="data_ent_atv" placeholder="Defina um nome para a atividade" required>
			<div class="invalid-feedback">
				Campo obrigatório!.
			</div>
		</div>

		<div class="col-md-4">
			<label for="desc_inp" class="form-label">Descrição</label>
			<textarea class="form-control" id="desc_inp" name="desc_atv" placeholder="Escreva uma desrição para sua atividade" required></textarea>
			<div class="invalid-feedback">
				Campo obrigatório!.
			</div>
		</div>

		<input type="hidden" name="id_workspace" value="<?php echo $_GET['id'] ?>">

		<div class="mb-3" style="margin-top: 15px;">
			<input class="btn" type="reset" value="Cancelar">
			<input class="btn btn-secondary" type="submit" value="Salvar">
		</div>
	</div>
</form>