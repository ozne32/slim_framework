<?php
use \Psr\HTTP\Message\ResponseInterface as Response;
use \Psr\HTTP\Message\ServerRequestInterface as Request;
require 'vendor/autoload.php';
// middleware, respostas e databases
/*tipos de resposta:
Cabeçaho, texto, JSON, XML  */
$app = new \Slim\App;
$app->get('/header', function($request, $response){
    $response->write('este é um header');
    // essa linha permite que o usuário envie requisições do tipo put 
    $response->withHeader('allow', 'PUT');
    return $response->withAddedHeader('Content-Length', 5);//informações de cabeçalho
});
$app->get('/json', function($request, $response){
    // se eu tentar passar só como write ele vai entender como se fosse um texto html
    return $response->withJson([
        "no me"=>"enzo",
        "email"=>"enzo@gmail.com"
    ]);
});
$app->get('/xml', function($request, $response){
    $xml = file_get_contents('arquivo');
    $response->write($xml);
    return $response->withHeader('Content-Type', 'application/xml');

});
// middlewares
$app->add( function($request, $response, $next){
    $response->write(' Inicio camada 1 + ');
    $response = $next($request, $response);
    $response->write(' + Fim camada 1');
    return $response;
});
$app->add( function($request, $response, $next){
    $response->write(' Inicio camada 2 + ');
    $response = $next($request, $response);
    $response->write(' + Fim camada 2');
    return $response;
});
$app->run();
