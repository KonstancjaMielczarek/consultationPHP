<?php

namespace App\Action\ListCons;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use App\Responder\Responder;
use App\Repository\QueryFactory;
use App\Repository\DataTableRepository;
use App\Repository\RepositoryInterface;


use App\Action\PHPmailer\phpMailerAction;
use App\Domain\listCons\Service\ListConsDataTable;



/**
 * Action.
 */
final class ListConsultationAction
{
        /**
     * @var Responder
     */
    private $responder;
    /**
     * @var Twig
     */
    private $twig;

    /**
     * @var phpMailerAction
     */
    private $sendMail;


     private $queryFactory;
    private $dataTable;
    private $listCons;
    /**
     * The constructor.
     *
     * @param Twig $twig The twig engine
     */
    public function __construct(Responder $responder, Twig $twig, ListConsDataTable $listCons, QueryFactory $queryFactory, DataTableRepository $dataTableRepository, phpMailerAction $sendMail)
    {
        $this->responder = $responder;
        $this->twig = $twig;
        $this->sendMail = $sendMail;
        $this->queryFactory = $queryFactory;
        $this->dataTable = $dataTableRepository;
        $this->listCons = $listCons;
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

        if(isset($_GET['id_cons'])){
            $this->sendMail->id_consultation = $_GET['id_cons'];
            $this->sendMail->topic = "Konsultacje zaakceptowane";
            $this->sendMail->content = "Zaakceptowano wybrany przez Ciebie termin konsultacji.";
            $this->queryFactory->newUpdate('consultation',['status' => 'zaakceptowano'])->andWhere(['id_consultation' => $_GET['id_cons']])->execute();
            $this->sendMail->send();
        }
        // if(isset($_GET['id_cons2'])){
        //     $this->sendMail->id_consultation = $_GET['id_cons2'];
        //     $this->sendMail->topic = "Konsultacje odrzucone";
        //     $this->sendMail->content = "Wybrany przez Ciebie termin konsultacji został odrzucony przez prowadzącego";
        //     $this->queryFactory->newDelete('consultation')->andWhere(['id_consultation' => $_GET['id_cons2']])->execute();
        //     $this->sendMail->send();
        // }
        if(isset($_GET['id_cons2'])){
            $this->sendMail->id_consultation = $_GET['id_cons2'];
            $this->sendMail->topic = "Konsultacje odrzucone";
            $this->sendMail->content = "Twoje konsultacje zostały odrzucone przez prowadzącego";
            $this->queryFactory->newDelete('consultation')->andWhere(['id_consultation' => $_GET['id_cons2']])->execute();
            $this->sendMail->send();
        }

        return $this->twig->render($response, 'listCons/listConsultation.twig');
    }
}
