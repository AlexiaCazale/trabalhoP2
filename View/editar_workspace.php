<h1 style="font-size: 18px; margin: 60px 0 40px 150px;">Editar Workspace</h1>

<form method="post" action="/trabalhoP2/editar_workspace">

  <input type="hidden" name="id_workspace" value="<?= $workspace->getId() ?>">
  <div style="display: flex; flex-direction:column; align-items:center">
    <div class="col-md-4 position-relative">
      <label for="validationTooltip01" class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" id="validationTooltip01"
        placeholder="Defina um nome para a atividade" required value="<?= htmlspecialchars($workspace->getNome()) ?>">
      <div class="invalid-feedback">
        Campo obrigatório!
      </div>
    </div>
    <div class="col-md-4">
      <label for="validationTextarea" class="form-label">Descrição</label>
      <textarea name="descricao" class="form-control" id="validationTextarea"
        placeholder="Escreva uma descrição para sua atividade"
        required><?= htmlspecialchars($workspace->getDescricao()) ?></textarea>
      <div class="invalid-feedback">
        Campo obrigatório!
      </div>
    </div>
    <div class="mb-3" style="margin-top: 15px;">
      <a href="/trabalhoP2/" class="btn btn-primary">Cancelar</a>
      <button class="btn btn-secondary" type="submit">Salvar</button>
    </div>
  </div>
</form>