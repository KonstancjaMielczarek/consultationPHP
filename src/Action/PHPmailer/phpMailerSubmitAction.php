<?php

namespace App\Action\PHPmailer;

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//use App\Domain\PHPmailer\Data\ConsCreatorData;
//use App\Domain\PHPmailer\Service\ConsCreator;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class phpMailerSubmitAction
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

        /*
        // Build the HTTP response
        return $this->responder->encodeJson($response, [
            //'cons_id' => $consId,
            //'id_consultation' => $consId,
            $this->responder->redirect($request, $response, "listConsultation.twig");
        ]);*/
        $url = 'listCons';
        return $this->responder->redirect($request, $response, $url);
    }
}