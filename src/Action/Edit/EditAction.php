<?php

namespace App\Action\Edit;

use App\Domain\Cons\Data\ConsFewData;//
use App\Domain\Cons\Service\ConsUpdate;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;


use App\Repository\QueryFactory;
/**
 * Action.
 */
final class EditAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var ConsUpdate//
     */
    private $consCreatorUpdate;
/**
     * @var Twig
     */
    private $twig;

    private $queryFactory;
    
    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param UserCreator $userCreator The service
     */
    public function __construct(Responder $responder, ConsUpdate $consCreatorUpdate, Twig $twig, QueryFactory $queryFactory)//
    {
        $this->twig = $twig;
        $this->responder = $responder;
        $this->consCreatorUpdate = $consCreatorUpdate;
        $this->queryFactory = $queryFactory;
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
        

        $query = $this->queryFactory->newSelect('consultation')->select([
            'start_hour',
        ])->andWhere(['id_consultation' => $_GET['id_cons3']]);
        $result = $query->execute()->fetch('assoc');
        $_SESSION["id"]=$_GET['id_cons3'];//
       
        //echo "Wynosi: ", $_SESSION["id"];

        return $this->twig->render($response, 'edit/edit.twig');
    }
}
