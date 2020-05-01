<?php

// Define app routes

use App\Middleware\UserAuthMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->get('/users/{id}', \App\Action\User\UserViewAction::class)->setName('user-view');
    $app->post('/api/users', \App\Action\User\UserCreateAction::class)->setName('api-user-create');

    $app->get('/login', \App\Action\Login\LoginAction::class)->setName('login');
    $app->post('/login', \App\Action\Login\LoginSubmitAction::class);

    $app->get('/calendar', \App\Action\Calendar2\ConsCreateAction::class)->setName('calendar');
    $app->post('/calendar', \App\Action\Calendar2\ConsSubmitAction::class);//formularz konsultacji

    $app->get('/', \App\Action\Schedule\ScheduleAction::class)->setName('schedule');
    $app->post('/', \App\Action\ListCons\ListConsDataTableAction::class);//lista konsultacji

    $app->get('/message', \App\Action\Message\MessageAction::class)->setName('message');

    $app->group('/listConsultation', function (RouteCollectorProxy $group) {
        $group->get('', \App\Action\ListCons\ListConsultationAction::class)->setName('listCons');
            })->add(UserAuthMiddleware::class);
        $app->post('/listConsultation', \App\Action\ListCons\ListConsDataTableAction::class); //->setName('cons-datatable');

    $app->get('/edit', \App\Action\Edit\EditAction::class)->setName('edit');
    $app->post('/edit', \App\Action\Edit\EditSubmitAction::class);

        
    };
