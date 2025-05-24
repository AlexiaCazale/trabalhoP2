<!-- Cria atividade que será exibida no Workspace -->

<h1>Criar nota</h1>

<form class="was-validated">
<div class="col-md-4 position-relative">
  <label for="validationTooltip01" class="form-label">Nome</label>
  <input type="text" class="form-control" id="validationTooltip01" placeholder="Defina um nome para a atividade" required>
  <div class="invalid-feedback">
    Campo obrigatório!.
  </div>
 </div>

  <label for="validationTooltip01" class="form-label">Data de entrega</label>
  <input type="date" class="form-control" id="validationTooltip01" placeholder="Defina um nome para a atividade" required>
  <div class="invalid-feedback">
    Campo obrigatório!.
  </div>
 </div>

  <div class="col-md-4">
  <label for="validationTextarea" class="form-label">Descrição</label>
  <textarea class="form-control" id="validationTextarea" placeholder="Escreva uma desrição para sua atividade" required></textarea>
  <div class="invalid-feedback">
    Campo obrigatório!.
  </div>
  </div>

  <div class="col-md-4">
  <label for="validationServer04" class="form-label">Membros</label>
  <select class="form-select is-invalid" id="validationServer04"
   required>
  <option selected disabled value="">Selecione um membro...</option>
  <option>...</option>
  </select>
  
</div>


  <div class="mb-3">
  <button class="btn btn-primary" type="submit" >Cancelar</button>
  <button class="btn btn-secondary" type="submit" >Salvar</button>
  </div>
</form>