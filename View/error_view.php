<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center shadow-sm" style="border-radius: 15px; border: 1px solid #dee2e6;">
                <div class="card-header bg-danger text-white" style="border-top-left-radius: 14px; border-top-right-radius: 14px;">
                    <h4 class="mb-0">Ocorreu um Problema</h4>
                </div>
                <div class="card-body p-4">
                    <i class="ph-fill ph-warning-circle" style="font-size: 4rem; color: #dc3545;"></i>
                    <h5 class="card-title mt-3"><?= htmlspecialchars($errorTitle) ?></h5>
                    <p class="card-text text-muted"><?= htmlspecialchars($errorDescription) ?></p>
                    
                    <?php if (isset($errorCode) && $errorCode): ?>
                        <p class="small text-muted mb-4">Código do Erro: <?= htmlspecialchars($errorCode) ?></p>
                    <?php endif; ?>

                    <button class="btn btn-primary" onclick="history.back()">Voltar para a Página Inicial</button>
                </div>
            </div>
        </div>
    </div>
</div>