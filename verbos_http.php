<?php 
// psr vem de php standard recomendations
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
require 'vendor/autoload.php';

// o próprio slim faz isso, mas é uma boa pratica explicitar isso
$app = new \Slim\App;
$app->get('/home/{id}',function (Request $request, Response $response){
    $id = $request->getAttribute('id');
    // escrevendo no corpo da resposta com o Pr7
    $response->getBody()->write('estou escrevendo no corpo que o id do usuário é '.$id);
    return $response;
});
$app->post('/usuarios/adiciona', function(Request $request, Response $response){
    // este getParsedBody, é como se eu estivesse utilizando o ($_POST)
    $post = $request->getParsedBody(); //isso retorna um array com par e valor bem definidos
    $nome = $post['nome'];
    $email = $post['email'];
    /*recebendo essas informações em um contexto normal iriamos dar um insert into na tabela
    e retornar uma mensagem de sucesso */
    return $response->getBody()->write('Nome:'.$post['nome'].'  Email:'.$post['email']);
});
$app->put('/usuarios/atualiza', function(Request $request, Response $response){
    //basicamente a mesma coisa do anterior, porém é utilizado para atualizar, oq muda é oq vc faz no banco de dados
    $post = $request->getParsedBody();
    $nome = $post['nome'];
    $email = $post['email'];
    $id = $post['id'];
    // lógica para atualizar obanco de dados
    return $id.' foi atualizado com sucesso';
});
$app->delete('/usuarios/remove/{id}', function(Request $request, Response $response){
    //basicamente a mesma coisa do anterior, porém é utilizado para atualizar ????
    $id = $request->getAttribute('id');
    // lógica para deletar do banco de dados
    return $id.' foi deletado com sucesso';
});
/*tipos de requisição ou verbos HTTP -->
get->recuperar dados do servidor 
put->atualizar dados
delete->deletar dados
post->colocar dados */
$app->run();





















// // o [] serve para falar que aquele dado não é obrigatório
// $app->get('/usuarios[/{id}]',function($request, $response){
//     $id = $request->getAttribute('id');
//     echo "o id deste usuário é:     $id";
// });
// // deixando vários paramêtros não são obrigatórios 
// $app->get('/postagens[/{ano}[/{mes}]]',function($request, $response){
//     $ano= $request->getAttribute('ano');
//     $mes = $request->getAttribute('mes');
//     echo "está postagem foi feita no ano: $ano e no mês: $mes";
// });
// // se definismos uma várivel e dps colocamos o :, após o : podemos colocar quais  valores aquela variável 
// // pode assumir, se for colocado o .* vai poder retornar qualquer tipo de valor
// $app->get('/lista/{itens:.*}',function($request, $response){
//     $itens= $request->getAttribute('itens');
//     echo $itens.'<br>';
//     var_dump(explode('/',$itens));
// });
// // nomear rotas-> para não precisar colocar toda a rota no final da definição de uma rota, podemos definir o 
// // nome para ela com um simples ->setName('nome')
// $app->get('/blog/postagens/{id}',function($request, $response){
//     $itens= $request->getAttribute('itens');
//     echo $itens.'<br>';
//     var_dump(explode('/',$itens));
// })->setName('blog');
// $app->get('/blogs_coisas', function($request,$response){
//     // dentro deste pathFor, colocamos primeiro oq foi colcoado no setName e dps os valores que queremos
//     $retorno = $this->get("router")->pathFor("blog",["id"=>"5"]);
//     echo $retorno;
// });
// // agrupar rotas--> se você tiver várias rotas com um endereço em comum, pode colocar tudo em um group e deixar
// // o código mais enxuto 
// $app->group('/pessoas', function(){
//     $this->get('/1', function(){
//         echo 'está é a pessoa1';
//     });
//     $this->get('/2', function(){
//         echo 'está é a pessoa2';
//     });
// });