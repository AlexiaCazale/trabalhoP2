<!-- Mostra todos os Workspaces criados -->
<?php
require_once "View/Component/header.php";
?>

<div style="display: flex; justify-content: space-around; align-items: baseline;">
	<div>
		<h1 style="margin: 50px 20px 10px 20px; font-size: 20px; text-align: start; color: black">Bem-vindo(a), usuário</h1>

		<p style="margin-left: 20px; font-size: 16px; text-align: start; color: black">Workspaces</p>

		<div style="display: flex; flex-direction: column; gap: 20px">

			<!-- CARDS COM OS DADOS DO WORKSPACE -->
			<div class="card" style="margin-left: 20px; width: 421px; border-radius: 18px; background-color: #BEAFED; border: unset">
				<div class="card-body" style="border: unset">
					<h5 class="card-title">Workspace name</h5>
					<div style="display: flex;
				justify-content: space-between;
				align-items: center;">
						<div class="avatar-stack flex justify-items-end" style="display: flex; justify-content: start;">
							<span class="avatar">+6</span>
							<img class="avatar" src="/Images/avatar/1.jpg" />
							<img class="avatar" src="/Images/avatar/2.jpg" />
							<img class="avatar" src="/Images/avatar/4.jpg" />
							<img class="avatar" src="/Images/avatar/5.jpg" />
						</div>
						<div style="display: flex; gap: 10px;">
							<i class="ph ph-pencil-simple" style="color: #352171; font-size: 24px;"></i>
							<i class="ph ph-trash" style="color: red; font-size: 24px;"></i>
						</div>
					</div>
				</div>
			</div>

			<div class="card" style="margin-left: 20px; width: 421px; border-radius: 18px; background-color: #BEAFED; border: unset">
				<div class="card-body" style="border: unset">
					<h5 class="card-title">Workspace name</h5>
					<div style="display: flex;
				justify-content: space-between;
				align-items: center;">
						<div class="avatar-stack flex justify-items-end" style="display: flex; justify-content: start;">
							<span class="avatar">+6</span>
							<img class="avatar" src="/Images/avatar/1.jpg" />
							<img class="avatar" src="/Images/avatar/2.jpg" />
							<img class="avatar" src="/Images/avatar/4.jpg" />
							<img class="avatar" src="/Images/avatar/5.jpg" />
						</div>
						<div style="display: flex; gap: 10px;">
							<i class="ph ph-pencil-simple" style="color: #352171; font-size: 24px;"></i>
							<i class="ph ph-trash" style="color: red; font-size: 24px;"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="card" style="border: unset">
		<div class="card-body">
			<h5 class="card-title" style="margin: 50px 20px 10px 20px; font-size: 20px; text-align: start; color: black">Acesso rápido</h5>
			<?php
			$ul->criar();
			?>
		</div>
	</div>
</div>