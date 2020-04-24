<?php

namespace App\Action\Calendar2;

use App\Domain\Cons\Service\CalendarDataTable;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class CalendarDataTableAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var CalendarDataTable
     */
    private $calendarDataTable;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param CalendarDataTable $listConsDataTable The service
     */
    public function __construct(Responder $responder, ListConsDataTable $calendarDataTable)
    {
        $this->responder = $responder;
        $this->calendarDataTable = $calendarDataTable;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = (array)$request->getParsedBody();

        return $this->responder->encodeJson($response, $this->calendarDataTable->listAllConsultations($params));
    }
}
