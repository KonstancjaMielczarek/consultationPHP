<?php

namespace App\Action\ListCons;

//use App\Domain\Cons\Data\ConsCreatorData;
use App\Domain\listCons\Service\ListConsDataTable;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/**
 * Action.
 */
final class ListConsultationAction
{
    /**
     * @var Twig
     */
    private $twig;

    private $listCons;

    /**
     * The constructor.
     *
     * @param Twig $twig The twig engine
     */
    public function __construct(Responder $responder, ListConsDataTable $listCons, Twig $twig)
    {
        $this->twig = $twig;
        $this->listCons = $listCons;
        $this->responder = $responder;
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
        return $this->twig->render($response, 'listCons/listConsultation.twig');
    }
}
