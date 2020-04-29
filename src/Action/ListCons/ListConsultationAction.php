<?php

namespace App\Action\ListCons;

//use App\Domain\Cons\Data\ConsCreatorData;
use App\Domain\listCons\Service\ListConsDataTable;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

use App\Action\PHPmailer\phpMailerAction;
use App\Repository\QueryFactory;

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

    private $sendMail;

    private $queryFactory;

    /**
     * The constructor.
     *
     * @param Twig $twig The twig engine
     */
    public function __construct(Responder $responder,  Twig $twig, ListConsDataTable $listCons)//QueryFactory $queryFactory, PHPmailer $sendMail, ListConsDataTable $listCons,
    {
        $this->twig = $twig;
        $this->listCons = $listCons;
        $this->responder = $responder;
        // $this->sendMail = $sendMail;
        // $this->queryFactory = $queryFactory;
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
        echo "Wynosi: ", $_GET['id_cons3'];
        if(isset($_GET['id_cons'])){
            $this->sendMail->id_consultation = $_GET['id_cons'];
            $this->sendMail->topic = "Zaakceptowano konsultacje";
            $this->sendMail->content = "Konsultacje odbędą się w wybranym przez ciebie terminie.";
            $this->queryFactory->newUpdate('consultation',['status' => 'zaakceptowano'])->andWhere([id_consultation => $_GET['id_cons']])->execute();
            $this->sendMail->send();
        }

        if(isset($_GET['id_cons2'])){
            $this->sendMail->id_consultation = $_GET['id_cons2'];
            $this->sendMail->topic = "Odrzucono termin konsultacji";
            $this->sendMail->content = "Wybrany termin został odrzucony przez prowadzącego.";
            $this->queryFactory->newDelete('consultation')->andWhere([id_consultation => $_GET['id_cons2']])->execute();
            $this->sendMail->send();
        }

        return $this->twig->render($response, 'listCons/listConsultation.twig');
    }
}
