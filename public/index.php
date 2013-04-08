<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Model\User;

require_once __DIR__.'/../bootstrap.php';

$app = new Silex\Application();

$app->get('/hello/{name}', function($name) use($app) {
    return 'Hello '.$app->escape($name);
});

$app->get('/testeorm', function() use($app, $em) {

  // $user = new User();
  // $user->setName('Kilton Calvet');
  // $user->setEmail('kiltoncls@gmail.com');
  // $user->setUsername('kiltoncls');
  // $user->setPassword('1234');
  // $em->persist($user);
  // $em->flush();

    //$data = $em->find('model\\'.ucfirst($entity), $id);

    $user = $em->find("Model\\User", 2);

  return print_r($user);
});

$app['debug'] = true;

$app->get('/{entity}/{id}', function($entity, $id) {
  return $entity . ' => ' . $id;
})->assert('id', '\d+');

$app->post('/{entity}', function(Request $request) {
  return new Response('{status: ok}', 200, array('Content-Type' => 'text/json'));
});

$app->get('/teste', function() use($app) {

  return new Response('oi', 200,  array('Content-Type' => 'text/json'));

});

//options - used in cross domain access
$app->match('{entity}/{id}', function ($entity, $id, Request $request) use ($app)
{
    return new Response('', 200, array(
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE',
        'Access-Control-Allow-Headers' => 'Authorization'
    ));
})->method('OPTIONS')->value('id', null);

$app->before(function (Request $request) use ($app) {
    if ($request->getMethod() == 'OPTIONS') {
        return;
    }
    if ($request->getPathInfo() == '/testeorm') {
        return;
    }

    if( ! $request->headers->has('authorization')){
        return new Response('Unauthorized', 401);
    }

    require_once __DIR__.'/../config/clients.php';
    if (!in_array($request->headers->get('authorization'), array_keys($clients))) {
        return new Response('Unauthorized', 401);
    }
});

$app->after(function (Request $request, Response $response) {
    $status = $response->getStatusCode();
    switch ($status) {
        case 405:
            //$response->headers->set('Content-Type', 'text/json');
        break;

        default:
            //$response->headers->set('Content-Type', 'text/json');
        break;
    }
});

if ($env != 'development' && $env != 'testing') {
    $app->error(function (\Exception $e, $code) {
        switch ($code) {
            case 404:
                $message = 'The requested page could not be found.';
                break;
            default:
                $message = 'We are sorry, but something went terribly wrong.';
        }

        return new Response($message);
    });
}

$app->run();