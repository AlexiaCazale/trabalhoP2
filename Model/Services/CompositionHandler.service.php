<?php

class CompositionHandler
{
	static public function createUsersAvatar(IUsuario $obj, ?string $class = null, ?string $style = null): div // Recebe qualquer estrutura que possua usuários
	{
		$div = new div(
			class: $class == null ? "avatar-stack flex justify-items-end" : $class, 
			style: $style == null ? "'display: flex; justify-content: start;'" : $style);
		foreach ($obj->getUsuarios() as $usuario) {
			$div->setElemento(new img(class:"avatar", src:$usuario->getAvatar() != null ? $usuario->getAvatar() : "View/Images/user_img.png"));
		}
		return $div;
	}

	static public function createWorkspaces(Usuario $usuario): div
	{
        $div = new div(style:"'display: flex; flex-direction: column; gap: 20px'");

        foreach($usuario->getWorkspaces() as $workspace)
        {
            $divCard = new div(class:"card", style:"'margin-left: 20px; width: 421px; border-radius: 18px; background-color: #BEAFED; border: unset'");

            $divCardBody = new div(class:"card-body", style:"'border: unset'");
            $divCardBody->setElemento(new a("/trabalhoP2/workspace?id={$workspace->getId()}", $workspace->getNome()));

            $divAvatarIcon = new div(style:"'display: flex; justify-content: space-between; align-items: center'");

            $divAvatarIcon->setElemento(CompositionHandler::createUsersAvatar($workspace));
            
            $divIcons = new div(style:"'display: flex; gap: 10px'");
            $divIcons->setElemento(new a("/trabalhoP2", "Alterar"));
            $divIcons->setElemento(new a("/trabalhoP2", "Remover"));

            $divAvatarIcon->setElemento($divIcons);

            $divCardBody->setElemento($divAvatarIcon);

            $divCard->setElemento($divCardBody);

            $div->setElemento($divCard);
        }

		return $div;
	}

	static public function createQuickAccess()
	{
		$ul = new ul();
		$ul->setElemento(new li(new a("/trabalhoP2/form_cadastro", "Cadastro", style: "'color: red'")));

		$ul->setElemento(new li(new a("/trabalhoP2/form_login", "Login")));

		$ul->setElemento(new li(new a("/trabalhoP2", "Home")));

		$ul->setElemento(new li(new a("/trabalhoP2/criar_workspace", "Criar Workspace")));

		$ul->setElemento(new li(new a("/trabalhoP2/workspace", "Workspace")));

		$ul->setElemento(new li(new a("/trabalhoP2/criar_atividade", "Criar atividade")));

		return $ul;
	}
}

?>