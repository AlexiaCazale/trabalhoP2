<?php

class CompositionHandler 
{
    static public function createUsersAvatar(IUsuario $obj): div // Recebe qualquer estrutura que possua usuários
    {
        $div = new div(class: "avatar-stack flex justify-items-end", style: "'display: flex; justify-content: start;'");
        foreach ($obj->getUsuarios() as $usuario) {
            $div->setElemento(new img("avatar", $usuario->getAvatar()));
        }
        return $div;
    }

    static public function createWorkspaces(Usuario $usuario): div
    {
        $div = new div(style:"'display: flex; flex-direction: column; gap: 20px'");
        foreach($usuario->getWorkspaces() as $workspace)
        {
            $div_users = CompositionHandler::createUsersAvatar($workspace);

            $div_users->setElemento(new a("/trabalhoP2", "alterar"));
            $div_users->setElemento(new a("/trabalhoP2", "remover"));

            $div_card_body = new div(class: "card_body", style:"'border: unset'");
            $div_card_body->setElemento(new heading(5, $workspace->getNome(), class: "card-title"));

            $div_card = new div(class: "card", style:"'margin-left: 20px; width: 421px; border-radius: 18px; background-color: #BEAFED; border: unset'");
            $div_card->setElemento($div_card_body);

            var_dump($div_card->getElemento()[0]);
            
            $div->setElemento($div_card);
        }

        return $div;
    }

    static public function createQuickAccess()
    {
        $ul = new ul();
		$ul->setElemento(new li(new a("/trabalhoP2/form_cadastro", "Cadastro")));

		$ul->setElemento(new li(new a("/trabalhoP2/form_login", "Login")));

		$ul->setElemento(new li(new a("/trabalhoP2", "Home")));

		$ul->setElemento(new li(new a("/trabalhoP2/criar_workspace", "Criar Workspace")));

		$ul->setElemento(new li(new a("/trabalhoP2/workspace", "Workspace")));

		$ul->setElemento(new li(new a("/trabalhoP2/criar_atividade", "Criar atividade")));

        return $ul;
    }
}

?>