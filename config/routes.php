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

    $app->get('/login', \App\Action\Login\LoginAction::class)->setName('login');
    $app->post('/login', \App\Action\Login\LoginSubmitAction::class);

    // Password protected area
    // $app->group('/users', function (RouteCollectorProxy $group) {
    //     $group->get('', \App\Action\User\UserListAction::class)->setName('user-list');
    //     $group->post('/datatable', \App\Action\User\UserListDataTableAction::class)->setName('user-datatable');
    // })->add(UserAuthMiddleware::class);

    // $app->get('/listConsultation', \App\Action\ListCons\ListConsultationAction::class)->setName('listCons');
    // $app->post('/listConsultation', \App\Action\ListCons\ListConsDataTableAction::class);//lista konsultacji


    $app->get('/calendar', \App\Action\Calendar2\ConsCreateAction::class)->setName('calendar');
    //$app->post('/calendar', \App\Action\Calendar2\CalendarDateTableAction::class);
    $app->post('/calendar', \App\Action\Calendar2\ConsSubmitAction::class);//formularz konsultacji


    // $app->get('/schedule', \App\Action\Schedule\ScheduleAction::class)->setName('schedule');
    // $app->post('/schedule', \App\Action\ListCons\ListConsDataTableAction::class);//lista konsultacji

    $app->get('/', \App\Action\Schedule\ScheduleAction::class)->setName('schedule');
    $app->post('/', \App\Action\ListCons\ListConsDataTableAction::class);//lista konsultacji

    $app->get('/message', \App\Action\Message\MessageAction::class)->setName('message');

    // $app->group('/listConsultation', function (RouteCollectorProxy $group) {
    //     $group->get('', \App\Action\ListCons\ListConsultationAction::class)->setName('listCons');
    //     $group->get('/listConsultation{id_consultation}', \App\Action\ListCons\ListConsultationAction::class)->setName('listCons');
    // })->add(UserAuthMiddleware::class);
    //     $app->post('/listConsultation', \App\Action\ListCons\ListConsDataTableAction::class);//lista konsultacji

        $app->group('/listConsultation', function (RouteCollectorProxy $group) {
            $group->get('', \App\Action\ListCons\ListConsultationAction::class)->setName('listCons');
            })->add(UserAuthMiddleware::class);
            $app->post('/listConsultation', \App\Action\ListCons\ListConsDataTableAction::class); //->setName('cons-datatable');

            // $app->get('/edit', \App\Action\EditCons\EditConsAction::class)->setName('edit');
            // $app->post('/edit', \App\Action\EditCons\EditSubmitAction::class);

        //$app->get('/mailer', \App\Action\PHPmailer\phpMailerAction::class)->setName('mailer');
        
    };
