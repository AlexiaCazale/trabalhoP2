<script>
  document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form_cadastro");

    form.addEventListener("submit", function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }

      form.classList.add("was-validated");
    }, false);
  });
</script>

<div class="card" style="display: flex;
  align-items: center;
  background-color: #BEAFED;
  padding: 60px 30px;
  border: unset;
  border-radius: 16px;
  margin: 10% 30%;">
  
  <form id="form_cadastro" style="display: flex; flex-direction: column; gap: 20px;" method="post" novalidate>

    <h1 style="font-size: 20px; text-align: center; color: black">Cadastre-se!</h1>

    <div class="row g-5">
      <div class="col">
        <label for="inp_nome" class="form-label" style="color: black">Nome</label>
        <input type="text" class="form-control" placeholder="Nome completo" id="inp_nome" name="nome" required>
        <div class="invalid-feedback">
          Campo obrigatório!
        </div>
      </div>
    </div>

    <div class="row g-5">
      <div class="col">
        <label for="inp_email" class="form-label" style="color: black">E-mail</label>
        <input type="email" class="form-control" placeholder="E-mail" id="inp_email" name="email" required>
        <div class="invalid-feedback">
          Campo obrigatório!
        </div>
      </div>
      <div class="col">
        <label for="inp_senha" class="form-label" style="color: black">Senha</label>
        <input type="password" class="form-control" placeholder="Sua senha" id="inp_senha" name="senha" required>
        <div class="invalid-feedback">
          Campo obrigatório!
        </div>
      </div>
    </div>

    <div class="text-end" style="margin-top: 20px;">
      <input type="reset" class="btn btn-subtle me-2" value="Cancelar" />
      <input type="submit" class="btn btn-primary" value="Cadastrar" />
    </div>

  </form>
</div>
