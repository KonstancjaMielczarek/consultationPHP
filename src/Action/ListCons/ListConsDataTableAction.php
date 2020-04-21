<?php

namespace App\Action\ListCons;

use App\Domain\ListCons\Service\ListConsDataTable;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class ListConsDataTableAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var ListConstDataTable
     */
    private $listConsDataTable;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param ListConsDataTable $listConsDataTable The service
     */
    public function __construct(Responder $responder, ListConsDataTable $listConsDataTable)
    {
        $this->responder = $responder;
        $this->listConsDataTable = $listConsDataTable;
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

        return $this->responder->encodeJson($response, $this->listConsDataTable->listAllConsultations($params));
    }
}
