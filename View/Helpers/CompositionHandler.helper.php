<?php

class CompositionHandler
{
    public static function compositionAfterBuffer(IComponente|string $componente) {
        ob_start();
        if (is_string($componente)) {
            echo $componente;
        } else {
            $componente->criar();
        }
        return ob_get_clean();
    }

	public static function createUsersAvatar(IUsuario $obj, ?string $class = null, ?string $style = null): div // Recebe qualquer estrutura que possua usuários
	{
		$div = new div(
			class: $class == null ? "avatar-stack flex justify-items-end" : $class,
			style: $style == null ? "'display: flex; justify-content: start;'" : $style);
		foreach ($obj->getUsuarios() as $index=>$usuario) {
            $avatarSrc = $usuario->getAvatar() != null ? $usuario->getAvatar() : "View/Images/user.png";

            // Define os atributos para a tooltip
            $tooltipAttributes = [
                'title' => $usuario->getNome(), 
                'data-bs-toggle' => 'tooltip',  
                'data-bs-placement' => 'top'
            ];

            $div->setElemento(new img(
                class: "avatar",
                src: $avatarSrc,
                attributes: $tooltipAttributes
            ));

            if ($index >= 4) { // Coloque o valor X onde X + 1 é o a quantidade de avatares que devem ser mostrados
                $numeroDeAvataresExtras = count($obj->getUsuarios()) - 5;
                if ($numeroDeAvataresExtras > 0) {
                    $div->setElemento(new span(texto:"+{$numeroDeAvataresExtras}", class:"avatar"));
                }
                $div->reverseElementos();
                break;
            }

            $div->reverseElementos();
		}
		return $div;
	}

	public static function createWorkspaces(Usuario $usuario): div
	{
        $div = new div(style:"'display: flex; flex-direction: column; gap: 20px'");

        foreach($usuario->getWorkspaces() as $workspace)
        {
            $divCard = new div(class:"card", style:"'margin-left: 20px; width: 421px; border-radius: 18px; background-color: #BEAFED; border: unset;'");

            $divCardBody = new div(class:"card-body", style:"'border: unset'");
            $divCardBody->setElemento(new a("/trabalhoP2/workspace?id={$workspace->getId()}", $workspace->getNome(), style:"'text-decoration: none; color: black'"));

            $divAvatarIcon = new div(style:"'margin-top: 10px; display: flex; justify-content: space-between; align-items: center'");

            $divAvatarIcon->setElemento(CompositionHandler::createUsersAvatar($workspace));
            
            $divIcons = new div(style:"'display: flex; gap: 10px'");

            $divIcons->setElemento(new a(
                "/trabalhoP2/editar_workspace?id={$workspace->getId()}", 
                "<i class='ph ph-pencil-simple-line'></i>", 
                style: "'text-decoration: none; color: black'"
            ));

            $divIcons->setElemento(new a(
                "/trabalhoP2/desativar_workspace?id={$workspace->getId()}",
                "<i class='ph ph-trash' style='color: red;'></i>",
                style: "'text-decoration: none;'"
            ));


            $divAvatarIcon->setElemento($divIcons);

            $divCardBody->setElemento($divAvatarIcon);

            $divCard->setElemento($divCardBody);

            $div->setElemento($divCard);
       
        }

		return $div;
	}

	public static function createQuickAccess()
	{
		$ul = new ul();

		if (isset($_SESSION['usuario_primeiro_nome'])){
			//$ul->setElemento(new li(new a("/trabalhoP2", "Home")));
			$ul->setElemento(new li(new a("/trabalhoP2/criar_workspace", "Criar Workspace")));
			$ul->setElemento(new li(new a("/trabalhoP2/perfil", "Meu perfil")));
			$ul->setElemento(new li(new a("/trabalhoP2/workspaces_desativados", "Workspaces Desativados")));
			
		}else{
			$ul->setElemento(new li(new a("/trabalhoP2/form_cadastro", "Cadastro")));
			$ul->setElemento(new li(new a("/trabalhoP2/form_login", "Login")));
		}
		
		return $ul;
	}
}

?>