<script>
  document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form_login");

    form.addEventListener("submit", function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }

      form.classList.add("was-validated");
    }, false);
  });
</script>


<div style="display: flex; justify-content: center; margin-top: 50px;">

  <div class="card" style="display: flex;
	align-items: center;
	background-color: #BEAFED;
	padding:60px 30px 30px 30px;
	border: unset;
	border-radius: 16px">

<form id="form_login" style="display: flex; flex-direction: column; gap: 20px;" method="post" novalidate>
	  <h1 style="font-size: 20px; text-align: center; color: black">Bem-vindo(a)!</h1>
	  <div class="position-relative">
		<label for="inp_email" class="form-label" style="color: black">E-mail</label>
		<input style="width: 350px;" type="email" class="form-control" id="inp_email" name="email" placeholder="nome@exemplo.com" required>
		<div class="invalid-feedback">
		  Campo obrigatório!
		</div>
	  </div>

	  <div class="position-relative">
		<label for="inp_senha" class="form-label" style="color: black">Senha</label>
		<input style="width: 350px;" type="password" class="form-control" id="inp_senha" name="senha" placeholder="Digite sua senha" required>
		<div class="invalid-feedback">
		  Campo obrigatório!
		</div>
	  </div>

	  <div class="text-end" style="margin-top: 10px">
		<button class="btn btn-subtle me-2" onclick="history.back()">Voltar</button>
		<input type="reset" class="btn btn-subtle me-2" value="Cancelar" />
		<input type="submit" class="btn btn-primary" value="Entrar" />
	  </div>
  </div>
</div>
</form>
</div>