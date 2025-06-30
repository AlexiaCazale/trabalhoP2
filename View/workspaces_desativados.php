<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Workspaces Desativados</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">Abaixo estão todos os workspaces que você administra e que foram desativados. Você pode reativá-los a qualquer momento.</p>
                    
                    <?php if (empty($workspacesInativos)): ?>
                        <div class="alert alert-info" role="alert">
                            Você não possui workspaces desativados.
                        </div>
                    <?php else: ?>
                        <ul class="list-group">
                            <?php foreach ($workspacesInativos as $workspace): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>
                                        <i class="ph-fill ph-archive-box me-2"></i>
                                        <?= htmlspecialchars($workspace->getNome()) ?>
                                    </span>
                                    <a href="/trabalhoP2/desativar_workspace?id=<?= $workspace->getId() ?>" class="btn btn-success btn-sm">
                                        <i class="ph-fill ph-arrow-counter-clockwise me-1"></i>
                                        Reativar
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="mt-4 text-center">
                        <a href="/trabalhoP2/" class="btn btn-secondary">Voltar para a Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>