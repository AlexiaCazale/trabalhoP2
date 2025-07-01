<?php

class PermissionManager 
{
    public static function loggedUserIsAdmin(Workspace $workspace): bool
    {
        if (!isset($_SESSION['usuario_id'])) {
            return false;
        }
        
        $workspaceDAO = new workspaceDAO();
        $workspaceStd = $workspaceDAO->buscarUmWorkspace($workspace);

        if (!$workspaceStd || !isset($workspaceStd->id_usuario_admin_fk)) {
            return false;
        }

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