<?php

namespace App\Action\ListCons;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/**
 * Action.
 */
final class ListConsAction
{
    /**
     * @var Twig
     */
    private $twig;

    /**
     * The constructor.
     *
     * @param Twig $twig The twig engine
     */
    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
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
