<?php

require_once "View/Component/header.php";

?>

<h1 style="font-size: 18px; margin: 60px 0 40px 150px;">Criar Workspace</h1>

<form class="was-validated" action="" method="post">
  <!-- inserir, por causa do DAO -->

  <div style="display: flex; flex-direction:column; align-items:center">

    <div class="col-md-4 position-relative">
      <label for="inp_nome" class="form-label">Nome</label>
      <input type="text" class="form-control" id="inp_nome" name="nome" placeholder="Defina um nome para a atividade"
        required>
      <div class="invalid-feedback">
        Campo obrigatório!
      </div>
    </div>

    <div class="col-md-4">
      <label for="inp_descricao" class="form-label">Descrição</label>
      <textarea class="form-control" id="inp_descricao" name="descricao" placeholder="Escreva uma desrição para sua atividade"
        required></textarea>
      <div class="invalid-feedback">
        Campo obrigatório!
      </div>
    </div>

    <div class="col-md-4">
      <label for="inp_usuarios" class="form-label">Membros</label>
      <textarea class="form-control" id="inp_usuarios" name="usuarios" placeholder="Escreva o email dos usuários" oninput="searchMemberData(this)"
        ></textarea>
      <div class="invalid-feedback">
      </div>
    </div>

    <div class="mb-3" style="margin-top: 15px;">
      <input class="btn btn-primary" type="reset" value="Cancelar">
      <input class="btn btn-secondary" type="submit" value="Salvar">
    </div>

  </div>
</form>

<script src="View/Scripts/fetchOnMemberSearchInput.js"></script>