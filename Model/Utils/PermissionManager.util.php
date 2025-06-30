<?php

class PermissionManager 
{
    public static function loggedUserIsAdmin(Workspace $workspace): bool
    {
        // Se não houver usuário logado, não pode ser admin.
        if (!isset($_SESSION['usuario_id'])) {
            return false;
        }
        
        // Usa o DAO para buscar os dados brutos do workspace.
        $workspaceDAO = new workspaceDAO();
        $workspaceStd = $workspaceDAO->buscarUmWorkspace($workspace);

        // Se o workspace não existe ou não tem admin, retorna false.
        if (!$workspaceStd || !isset($workspaceStd->id_usuario_admin_fk)) {
            return false;
        }

        // Compara o ID do admin com o ID do usuário na sessão.
        return $workspaceStd->id_usuario_admin_fk === $_SESSION['usuario_id'];
    }

    public static function loggedUserIsMemberInWorkspace(Workspace $workspace): bool
    {
        UserAuth::userIsLogged();

        $workspaceDAO = new workspaceDAO();
        return $workspaceDAO->usuarioEstaNoWorkspace(
            $workspace,
            new Usuario($_SESSION['usuario_id'])
        );
    }

    public static function loggedUserIsMemberInAtividade(Atividade $atividade)
    {
        UserAuth::userIsLogged();

        $atividadeDAO = new atividadeDAO();
        return $atividadeDAO->usuarioEstaNaAtividade(
            $atividade,
            new Usuario($_SESSION['usuario_id'])
        );
    }
}
?>