<?php

namespace App\Action\Schedule;

//use App\Domain\Cons\Data\ConsCreatorData;
use App\Domain\Schedule\Service\CalendarDataTable;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/**
 * Action.
 */
final class ScheduleAction
{
    /**
     * @var Twig
     */
    private $twig;

    private $schedule;

    /**
     * The constructor.
     *
     * @param Twig $twig The twig engine
     */
    public function __construct(Responder $responder, CalendarDataTable $schedule, Twig $twig)
    {
        $this->twig = $twig;
        $this->schedule = $schedule;
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
        return $this->twig->render($response, 'schedule/schedule.twig');
    }
}
