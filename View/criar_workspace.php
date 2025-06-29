<script>
  document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form_workspace");

    form.addEventListener("submit", function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }

      form.classList.add("was-validated");
    }, false);
  });
</script>

<h1 style="font-size: 18px; margin: 60px 0 40px 150px;">Criar Workspace</h1>
<a style="font-size: 16px; margin: 20px 0 40px 150px; display: flex; gap: 5px; align-items: center; cursor: pointer; text-decoration: none;" href="/trabalhoP2"><i class="ph ph-arrow-left"></i>Voltar para Home</a>

<form id="form_workspace" action="" method="post" novalidate>
  <!-- inserir, por causa do DAO -->

  <div style="display: flex; flex-direction:column; align-items:center; gap: 20px">

	<div class="col-md-4 position-relative">
	  <label for="inp_nome" class="form-label">Nome</label>
	  <input type="text" class="form-control" id="inp_nome" name="nome" placeholder="Defina um nome para o workspace"
		required>
	  <div class="invalid-feedback">
		Campo obrigatório!
	  </div>
	</div>

	<div class="col-md-4">
	  <label for="inp_descricao" class="form-label">Descrição</label>
	  <textarea class="form-control" id="inp_descricao" name="descricao" placeholder="Escreva uma desrição para seu workspace"
		required></textarea>
	  <div class="invalid-feedback">
		Campo obrigatório!
	  </div>
	</div>

	<!-- <div class="col-md-4">
	  <label for="inp_usuarios" class="form-label">Membros</label>
	  <textarea class="form-control" id="inp_usuarios" name="usuarios" placeholder="Escreva o email dos usuários" oninput="searchMemberData(this)"></textarea>
	  <div class="invalid-feedback">
	  </div>
	</div> -->

	<div class="mb-3" style="margin-top: 15px;">
	  <input class="btn btn-subtle me-2" type="reset" value="Cancelar">
	  <input class="btn btn-primary" type="submit" value="Salvar">
	</div>

  </div>
</form>

<script src="View/Scripts/fetchOnMemberSearchInput.js"></script>