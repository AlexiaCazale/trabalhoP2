<div style="display: flex; justify-content: space-around; align-items: baseline;">
	<div>
		<h1 style="margin: 50px 20px 10px 20px; font-size: 20px; text-align: start; color: black">
			Bem-vindo(a), 
			<?php echo isset($_SESSION['usuario_primeiro_nome']) ? (string) $_SESSION['usuario_primeiro_nome'] : "faça seu login!"; ?>
		</h1>

		<?php if (isset($_SESSION['usuario_primeiro_nome'])): ?>
			<p style="margin-left: 20px; font-size: 16px; text-align: start; color: black">Workspaces</p>
			<?php $tagWorkspaces->criar(); // Usa CompositionHandler::createWorkspaces ?>
		<?php endif; ?>
	</div>

	<div class="card" style="border: unset">
		<div class="card-body">
			<h5 class="card-title" style="margin: 50px 20px 10px 20px; font-size: 20px; text-align: start; color: black">
				Acesso rápido
			</h5>
			<?php $ul->criar(); // Usa CompositionHandler::createQuickAccess ?>
		</div>
	</div>
</div>
