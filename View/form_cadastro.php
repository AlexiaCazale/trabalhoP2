<?php

  require_once "View/Component/header.php";

?>


<div class="card" style="display: flex;
    align-items: center;
    background-color: #BEAFED;
    padding: 60px 30px;
    border: unset;
    border-radius: 16px;
    margin: 10% 30%;" 
  >

<form class="was-validated"  style="display: flex;
    flex-direction: column;
    gap: 20px;">

<h1 style="font-size: 20px; text-align: center; color: black">Cadastre-se!</h1>

<div class="position-relative" style="display: flex;
    flex-direction: column;
    gap: 20px;">

<div class="row g-5">
  <div class="col">
  <label for="validationTooltip01" class="form-label" style="color: black">Nome</label>
	  <input type="text" class="form-control" placeholder="Nome completo" id="validationTooltip01" aria-label="Nome completo">
	  <div class="invalid-feedback">
    Campo obrigatório!.
  </div>
	</div>

	<div class="col">
	<label for="validationTooltip01" class="form-label" style="color: black">Data de nascimento</label>
		<input type="date" class="form-control" placeholder="Data de nascimento" id="validationTooltip01" aria-label="Data de nascimento">
		<div class="invalid-feedback">
    Campo obrigatório!.
  </div>
	</div>
</div>

<div class="row g-5">
  <div class="col">
  <label for="validationTooltip01" class="form-label" style="color: black">E-mail</label>
	  <input type="email" class="form-control" placeholder="E-mail" id="validationTooltip01" aria-label="E-mail">
	  <div class="invalid-feedback">
    Campo obrigatório!.
  </div>
</div>
	
<div class="col">
	<label for="validationTooltip01" class="form-label" style="color: black">Senha</label>
		<input type="password" class="form-control" placeholder="Sua senha" id="validationTooltip01" aria-label="Last name">
		<div class="invalid-feedback">
    Campo obrigatório!.
</div>


<div class="text-end" style="margin-top: 20px;">
  <button type="submit" class="btn btn-subtle me-2">Cancel</button>
  <button type="submit" class="btn btn-primary">Submit</button>
</div>

</div>

</form>
</div>