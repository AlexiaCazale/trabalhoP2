<?php

session_start(); // Inicia a sessão globalmente

set_error_handler(function ($severity, $message, $file, $line) {
    // Esta verificação respeita o operador '@' que suprime erros.
    if (!(error_reporting() & $severity)) {
        return false;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
});

set_exception_handler(function (Throwable $exception) {
    http_response_code(500);

    $errorCode = $exception->getCode();
    $errorTitle = "Ocorreu um Erro Inesperado";
    $errorDescription = "Nossa equipe foi notificada e está trabalhando para resolver o problema. Por favor, tente novamente mais tarde." . $exception->getMessage();
    
    if ($exception instanceof PDOException) {
        $errorTitle = "Erro no Banco de Dados";
    } else if ($exception->getCode() == 404) {
        http_response_code(404);
        $errorTitle = "Página Não Encontrada";
        $errorDescription == '' ? 
			$errorDescription = "O recurso que você está tentando acessar não existe ou foi movido." : 
			$errorDescription = $exception->getMessage();
    }

    // O @ irá suprimir erros que possam ser causados pelo método
	// Caso um erro ocorresse, o errorHandler seria chamado, que "subiria" o erro para uma exceção
	// chamando o exceptionHandler e voltando para o método abaixo onde o erro foi criado, formando um 
	// ciclo infinito de erros
    @ViewRenderer::renderErrorPage(
		errorCode: $errorCode, 
		errorTitle: $errorTitle, 
		errorDescription: $errorDescription
	);

    exit();
});

require_once "rotas.php";
spl_autoload_register(function ($class) {
	if (file_exists('Controller/' . $class . '.php')) {
		require_once 'Controller/' . $class . '.php';
	} else if (file_exists('Model/' . $class . '.class.php')) {
		require_once 'Model/' . $class . '.class.php';
	} else if (file_exists('Security/' . $class . '.sec.php')) {
		require_once 'Security/' . $class . '.sec.php';
	} else if (file_exists('View/Helpers/' . $class . '.helper.php')) {
		require_once 'View/Helpers/' . $class . '.helper.php';
	} else if (file_exists('View/Helpers/Interfaces/' . $class . '.interface.php')) {
		require_once 'View/Helpers/Interfaces/' . $class . '.interface.php';
	} else if (file_exists('View/Helpers/Composite/' . $class . '.class.php')) {
		require_once 'View/Helpers/Composite/' . $class . '.class.php';
	} else if (file_exists('Model/DAO/' . $class . '.class.php')) {
		require_once 'Model/DAO/' . $class . '.class.php';
	} else if (file_exists('Model/Traits/' . $class . '.php')) {
		require_once 'Model/Traits/' . $class . '.php';
	} else if (file_exists('Model/Interfaces/' . $class . '.interface.php')) {
		require_once 'Model/Interfaces/' . $class . '.interface.php';
	} else if (file_exists('Model/Utils/' . $class . '.util.php')) {
		require_once 'Model/Utils/' . $class . '.util.php';
	} else if (file_exists('View/' . $class . '.class.php')) {
		require_once 'View/' . $class . '.class.php';
	} 
	else {
		die("Arquivo não existe " . $class);
	}
});


$uri = parse_url($_SERVER["REQUEST_URI"])["path"];
$uri = substr($uri, strpos($uri, '/', 1));
$route->verificar_rota($_SERVER["REQUEST_METHOD"], $uri);

?>