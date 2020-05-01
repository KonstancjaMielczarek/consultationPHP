<?php

namespace App\Domain\Cons\Repository;

use App\Domain\Cons\Data\ConsFewData;//
use App\Repository\QueryFactory;
use App\Repository\RepositoryInterface;

/**
 * Repository.
 */
class ConsGeneratorRepositoryUpdate implements RepositoryInterface
{
    /**
     * @var QueryFactory The query factory
     */
    private $queryFactory;

    /**
     * Constructor.
     *
     * @param QueryFactory $queryFactory The query factory
     */
    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    /**
     * Insert user row.
     *
     * @param ConsCreatorData $user The user
     *
     * @return int The new ID
     */
    public function updateCons(ConsFewData $cons)
    {
        $this->queryFactory->newUpdate('consultation',['start_date' =>$cons->start_date,
        'start_hour' =>$cons->start_hour, 
        'end_hour' => $cons->end_hour, 
        'id_day_FK' => $cons->id_day_FK,])->andWhere(['id_consultation' => $_SESSION["id"]])->execute();
    }
}
