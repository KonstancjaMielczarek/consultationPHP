<?php

namespace App\Action\Edit;

use App\Domain\Cons\Data\ConsFewData;//
use App\Domain\Cons\Service\ConsUpdate;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use App\Action\PHPmailer\phpMailerAction;

/**
 * Action.
 */
final class EditSubmitAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var ConsCreator//
     */
    private $consUpdate;

    /**
     * @var phpMailerAction
     */
    private $sendMail;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param ConsCreator $userCreator The service
     */
    public function __construct(Responder $responder, ConsUpdate $consCreatorUpdate, phpMailerAction $sendMail)
    {
        $this->responder = $responder;
        $this->consCreatorUpdate = $consCreatorUpdate;
        $this->sendMail = $sendMail;
    }

    /**
     * Action.
     *
     * > curl -X POST -H "Content-Type: application/json" -d {\"key1\":\"value1\"} http://localhost/users
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Collect input from the HTTP request

        $consData = new ConsFewData((array)$request->getParsedBody());

        $date = $consData->date;
        $start_hour = $consData->start_hour;
        $end_hour = $consData->end_hour;
        $id_consultation = $consData->id_consultation;
        
        $this->sendMail->id_consultation = $id_consultation;
        $this->sendMail->topic = "Zmiana terminów konsultacji";
        $this->sendMail->content = "Administrator zmienił termin twoich konsultacji na: ".$date.". W godzinach: ".$start_hour." - ".$end_hour.". Aby zaakceptować termin, lub odrzucić prośbę o konsultację, prosimy użyć zakładki zmiana terminu na stronie wpisując numer konsultacji: ".$id_consultation;
        $this->sendMail->send();

        // Invoke the Domain with inputs and retain the result
        $consId = $this->consCreatorUpdate->createCons($consData);

        // Build the HTTP response
        return $this->responder->redirect($request, $response, 'listCons'); //listConsultation
    }
}
