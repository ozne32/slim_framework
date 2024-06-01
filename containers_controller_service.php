<?php
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
require 'vendor/autoload.php';


$app = new \Slim\App([
    'settings'=>[
        'displayErrorDetails'=> true,
    ]
]);
class Servico{

}
$servico = new Servico();//se eu quiser utilizar está classe dentro de um $app>get não dá certo, ele vai me 
// retornar um erro, para isso eu posso colocar após a classe um use, ou fazer container utilizando a biblioteca 
// pimple(que é o mais recomendado)
$container = $app->getContainer();
$container['servico'] = function(){
    return new Servico();
};//assim eu posso colocar ele dentro de uma função

$app->get('/servico', function(Request $request, Response $response){
    $servico = $this->get('servico');
    var_dump($servico);
});
// controller como serviço, ao ínves de ficar colocando funções anônimas, dá para só instanciar uma classe e passar o método 
// $app->get('/servico', 'Classe:metodo')
$container['Home'] = function(){
    return new MyApp\controllers\Home(new MyApp\View);
};
// quando você não coloca as coisas de MyApp e etc você está falando que você msm que vai estanciar as coisas
//estou utilizando a instância de container que eu fiz anteriormente
$app->get('/usuarios', 'Home:index');
$app->run();