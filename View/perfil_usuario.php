<h1 style="font-size: 18px; margin: 60px 0 40px 150px;">Perfil</h1>
<a style="font-size: 16px; margin: 0 0 40px 150px; display: flex; gap: 5px; align-items: center; cursor: pointer; text-decoration: none;" href="/trabalhoP2"><i class="ph ph-arrow-left"></i>Voltar para Home</a>

<div style="display: flex; flex-direction:column; align-items:center">

  <div class="col-md-4 position-relative">
   <span><b>Nome:</b> <?php echo $usuarioEncontrado->getNome() ?></span>
  </div>
  <div class="col-md-4 position-relative">
    <span><b>E-mail:</b> <?php echo $usuarioEncontrado->getEmail() ?></span>
  </div>

<form action="/trabalhoP2/logout" class="col-md-4 position-relative" style="margin-top: 15px" method="get">
  <button type="submit" class="btn btn-subtle me-2">Logout</button>
</form>
