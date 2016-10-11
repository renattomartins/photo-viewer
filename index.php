<?php
/**
 * Front Controller.
 *
 * Manuseia todas as requisições entrantes. Esse arquivo é
 * o ponto de entrada único da aplicação. Todos tem que passar
 * por aqui primeiro.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */

 // Requer arquivo de inicialização
 require __DIR__.'/bootstrap.php';

 // Encapsula superglobais

 // Para não usar as superglobais do PHP dentro de classes (o que não seria uma
 // boa prática de desenvolvimento) elas são analisadas e colocadas em variáveis
 // que são passadas para dentro das classes de Controller.

 // A análise e tratamento dessas superglobais pode ser feita no próprio
 // Front Controller ou em uma classe candidata Dispatcher (que também poderia
 // analisar, tratar e encapsular melhor outros aspectos do corpo e/ou cabeçalho
 // da requisição). Nessa aplicação, a decisão de projeto é tratá-las de maneira
 // bem simples passando-as do próprio Front Controller para a classe de
 // Controller instanciada.
 $globals = ['get' => $_GET, 'post' => $_POST, 'files' => $_FILES];

// Realiza roteamento para executar a classe e action adequadas
if ($_GET) {
    // Extrai parâmetros principais da query
    $class = isset($_GET['class']) ? 'Controllers\\'.$_GET['class'] : null;
    $action = isset($_GET['action']) ? $_GET['action'] : null;

    // Procura pela classe de controller correspondente
    if (class_exists($class)) {
        $controller = new $class($globals);

        // Procura pelo método correspondente
        if (method_exists($controller, $action)) {
            $viewVars = $controller->$action();

            // Extrai objetos e variáveis da view
            extract($viewVars);

            // Requer template
            require __DIR__.'/src/Templates/gallery.php';
            exit();
        }
    }
    // Renderiza "404 Not Found"
    http_response_code(404);
    require __DIR__.'/src/Templates/404.php';
    exit();
}

// Renderiza a home
require __DIR__.'/src/Templates/home.php';
