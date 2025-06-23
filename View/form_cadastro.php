<?php

require_once "View/Component/header.php";

?>

<div class="card" style="display: flex;
	align-items: center;
	background-color: #BEAFED;
	padding: 60px 30px;
	border: unset;
	border-radius: 16px;
	margin: 10% 30%;">

  <form class="was-validated" style="display: flex;
	flex-direction: column;
	gap: 20px;" method="post">

	<h1 style="font-size: 20px; text-align: center; color: black">Cadastre-se!</h1>

	<div class="position-relative" style="display: flex;
	flex-direction: column;
	gap: 20px;">

	  <div class="row g-5">
		<div class="col">
		  <label for="inp_nome" class="form-label" style="color: black">Nome</label>
		  <input type="text" class="form-control" placeholder="Nome completo" id="inp_nome" name="nome"
			aria-label="Nome completo">
		  <div class="invalid-feedback">
			Campo obrigatório!
		  </div>
		</div>

		<div class="row g-5">
		  <div class="col">
			<label for="inp_email" class="form-label" style="color: black">E-mail</label>
			<input type="email" class="form-control" placeholder="E-mail" id="inp_email" name="email"
			  aria-label="E-mail">
			<div class="invalid-feedback">
			  Campo obrigatório!
			</div>
		  </div>

		  <div class="col">
			<label for="inp_senha" class="form-label" style="color: black">Senha</label>
			<input type="password" class="form-control" placeholder="Sua senha" id="inp_senha" name="senha"
			  aria-label="Last name">
			<div class="invalid-feedback">
			  Campo obrigatório!
			</div>


			<div class="text-end" style="margin-top: 20px;">
			  <input type="reset">
			  <input type="submit" class="btn btn-primary" value="Cadastrar">
			</div>

		  </div>

  </form>
</div>