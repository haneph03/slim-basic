<?php
require __DIR__.'/vendor/autoload.php';
$app = new Slim\App;
$container = $app->getContainer();

$container['view'] = function($container){
    $view = new \Slim\Views\Twig(__DIR__.'/views',[
        'cache' => false
    ]);
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));
    return $view;
};
//url(root halaman), callback(apa yg ingin dilakaukan)
$app->get('/',function($request,$response){
    $member = [
        'id' => 1,
        'name' => 'Hanif syahbandi'
    ];
    $this->view->render($response,'home.twig');
// return $response->withJson($member,202);
});
//untuk menjalankan slim harus menggunakan method run

//movies
// $app->get('/movies',function(){
// return 'Top Movies!';
// });

//cara 2 parameter dengan slug
// $app->get('/forum/{slug}/{user}',function($req,$response,$params){
//     return 'Forum '.$params['slug'].' ditulis oleh  '.$params['user'];
//     });

//Cara parameter opsional
$app->get('/forum[/{slug}]',function($request,$response,$params){
    if (empty($params['slug'])) {
        return 'Index Forum';
    } else {
        return 'Forum '.$params['slug'];
    }
    });

$app->run();



?>