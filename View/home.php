<!-- Mostra todos os Workspaces criados -->
<?php
require_once "View/Component/header.php";
?>


<div style="display: flex; justify-content: space-around; align-items: baseline;">
	<div>
		<h1 style="margin: 50px 20px 10px 20px; font-size: 20px; text-align: start; color: black">Bem-vindo(a), <?php echo isset($_SESSION['usuario_primeiro_nome']) ? (string) $_SESSION['usuario_primeiro_nome'] : "usuário" ?></h1>

		<p style="margin-left: 20px; font-size: 16px; text-align: start; color: black">Workspaces</p>

		<?php $tagWorkspaces->criar() // Usa CompositionHandler::createWorkspaces?>

	</div>

	<div class="card" style="border: unset">
		<div class="card-body">
			<h5 class="card-title" style="margin: 50px 20px 10px 20px; font-size: 20px; text-align: start; color: black">Acesso rápido</h5>
			<?php
			$ul->criar() // Usa Composition::createQuickAccess;
			?>
		</div>
	</div>
</div>