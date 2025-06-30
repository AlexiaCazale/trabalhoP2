<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-7">
            <div class="card p-3 py-4" style="background-color: #f8f9fa;">
                <div class="text-center">
                    <img src="<?= $usuario->getAvatar() ? htmlspecialchars($usuario->getAvatar()) : 'View/Images/user.png' ?>" width="100" class="rounded-circle" alt="Avatar do Usuário">
                </div>
                
                <div class="text-center mt-3">
                    <h5 class="mt-2 mb-0"><?= htmlspecialchars($usuario->getNome()) ?></h5>
                    <span><?= htmlspecialchars($usuario->getEmail()) ?></span>
                    
                    <div class="px-4 mt-1">
                        <p class="fonts">Aqui você pode gerenciar suas informações de perfil e configurações de conta.</p>
                    </div>
                    
                     <div class="buttons px-3">
                        <button type="button" class="btn btn-outline-primary px-4" data-bs-toggle="modal" data-bs-target="#modalEditarPerfil">
                            Alterar Dados
                        </button>
                        <a href="/trabalhoP2/desativar_conta" class="btn btn-danger px-4 ms-3" onclick="return confirm('Tem certeza que deseja desativar sua conta? Esta ação não pode ser desfeita.');">Desativar Conta</a>
                    </div>

                    <div class="mt-4">
                        <a href="/trabalhoP2/" class="btn btn-secondary px-4">Voltar para Home</a>
                         <a href="/trabalhoP2/logout" class="btn btn-subtle me-2">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditarPerfil" tabindex="-1" aria-labelledby="modalEditarPerfilLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarPerfilLabel">Editar Perfil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/trabalhoP2/editar_perfil" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($usuario->getNome()) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($usuario->getEmail()) ?>" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>