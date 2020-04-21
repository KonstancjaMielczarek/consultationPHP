<?php

namespace App\Action\Calendar;

use App\Domain\Appointment\Data\AppointmentCreatorData;
use App\Domain\Appointment\Service\AppointmentCreator;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class CalendarCreateAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var AppointmentCreator
     */
    private $appointmentCreator;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param AppointmentCreator $appointmentCreator The service
     */
    public function __construct(Responder $responder, AppointmentCreator $appointmentCreator)
    {
        $this->responder = $responder;
        $this->appointmentCreator = $appointmentCreator;
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
        $appointmentData = new AppointmentCreatorData((array)$request->getParsedBody());
        //echo $appointmentData;

        // Invoke the Domain with inputs and retain the result
        $appointmentId = $this->appointmentCreator->createAppointment($appointmentData);


        // Build the HTTP response
        return $this->responder->encodeJson($response, [
            'id_appointment' => $appointmentId,
        ]);

    }
}
