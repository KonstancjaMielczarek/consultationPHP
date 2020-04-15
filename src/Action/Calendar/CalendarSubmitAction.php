<?php

namespace App\Action\Calendar;

use App\Domain\User\Data\ApointmentCreatorData;
use App\Domain\User\Service\UserAuth;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Action.
 */
final class CalendarSubmitAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var UserAuth
     */
    private $auth;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param Session $session The session handler
     * @param UserAuth $auth The user auth
     */
    public function __construct(Responder $responder, Session $session, UserAuth $auth)
    {
        $this->responder = $responder;
        $this->session = $session;
        $this->auth = $auth;
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
        $data = (array)$request->getParsedBody();
        $firstName = (string)($data['firstName'] ?? '');
        $lastName = (string)($data['lastName'] ?? '');
        $email = (string)($data['email'] ?? '');
        $subject = (string)($data['subject'] ?? '');
        $time = (string)($data['time'] ?? '');

        $user = $this->auth->authenticate($firstName, $lastName, $email, $subject, $time);

        $flash = $this->session->getFlashBag();
        $flash->clear();

            $flash->set('success', __('Dodano konsultacje'));
            $url = 'calendar';


        return $this->responder->redirect($request, $response, $url);
    }

}
