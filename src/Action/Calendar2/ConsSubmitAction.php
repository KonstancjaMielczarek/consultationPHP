<?php

namespace App\Action\Calendar2;

use App\Domain\Cons\Data\ConsCreatorData;
use App\Domain\Cons\Service\ConsCreator;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class ConsSubmitAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var ConsCreator
     */
    private $consCreator;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param ConsCreator $userCreator The service
     */
    public function __construct(Responder $responder, ConsCreator $consCreator)
    {
        $this->responder = $responder;
        $this->consCreator = $consCreator;
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
        $consData = new ConsCreatorData((array)$request->getParsedBody());

        // Invoke the Domain with inputs and retain the result
        $consId = $this->consCreator->createCons($consData);

        $url = 'listCons';
        return $this->responder->redirect($request, $response, $url);
    }
}
