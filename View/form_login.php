<?php

  require_once "View/Component/header.php";

?>

<div style="display: flex; justify-content: center; margin-top: 50px;">

<div class="card" style="display: flex;
    align-items: center;
    background-color: #BEAFED;
    padding: 60px 30px;
    border: unset;
	border-radius: 16px" >

<form class="was-validated" style="display: flex;
    flex-direction: column;
    gap: 20px;">

<h1 style="font-size: 20px; text-align: center; color: black">Bem-vindo(a)!</h1>
<div class="position-relative">
  <label for="validationTooltip01" class="form-label" style="color: black">E-mail</label>
  <input type="email" class="form-control" id="validationTooltip01" placeholder="nome@exemplo.com" required>
  <div class="invalid-feedback">
    Campo obrigatório!
  </div>
 </div>

 <div class="position-relative">
  <label for="validationTooltip01" class="form-label" style="color: black">Senha</label>
  <input type="password" class="form-control" id="validationTooltip01" placeholder="Digite sua senha" required>
  <div class="invalid-feedback">
    Campo obrigatório!
  </div>
 </div>

  <div class="text-end">
    <button type="submit" class="btn btn-subtle me-2">Cancel</button>
    <button type="submit" class="btn btn-primary">Enviar</button>
  </div>
</div>
</div>
</form>
</div>