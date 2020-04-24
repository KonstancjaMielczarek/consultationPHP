<?php

// Define app routes

use App\Middleware\UserAuthMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    //$app->get('/', \App\Action\Home\HomeAction::class)->setName('root');

    //$app->get('/hello/{name}', \App\Action\Hello\HelloAction::class)->setName('hello');

    // HTML view
    $app->get('/users/{id}', \App\Action\User\UserViewAction::class)->setName('user-view');

    // API endpint
    $app->post('/api/users', \App\Action\User\UserCreateAction::class)->setName('api-user-create');

    $app->get('/', \App\Action\Login\LoginAction::class)->setName('login');
    $app->post('/', \App\Action\Login\LoginSubmitAction::class);

    // Password protected area
    // $app->group('/users', function (RouteCollectorProxy $group) {
    //     $group->get('', \App\Action\User\UserListAction::class)->setName('user-list');
    //     $group->post('/datatable', \App\Action\User\UserListDataTableAction::class)->setName('user-datatable');
    // })->add(UserAuthMiddleware::class);

    $app->get('/listConsultation', \App\Action\ListCons\ListConsultationAction::class)->setName('listCons');
    $app->post('/listConsultation', \App\Action\ListCons\ListConsDataTableAction::class);

    // $app->group('/listConsultation', function (RouteCollectorProxy $group) {
    //      $group->get('', \App\Action\ListCons\ListConsultationAction::class)->setName('listCons');
    //      $group->post('/datatable', \App\Action\ListCons\ListConsDataTableAction::class)->setName('user-datatable');
    //  });

    // $app->get('/calendar', \App\Action\Calendar\CalendarAction::class)->setName('calendar');
    // $app->post('/calendar', \App\Action\Calendar\CalendarCreateAction::class);

    $app->get('/calendar', \App\Action\Calendar2\ConsCreateAction::class)->setName('calendar');
    $app->post('/calendar', \App\Action\Calendar2\CalendarDateTableAction::class);
    //$app->post('/calendar', \App\Action\Calendar2\ConsSubmitAction::class);

    

    //$app->get('/listConsultation', \App\Action\ListCons\ListConsAction::class)->setName('listConsultation');
    $app->get('/message', \App\Action\Message\MessageAction::class)->setName('message');

};
