<?php

namespace App\Domain\Cons\Repository;

use App\Domain\Cons\Data\ConsCreatorData;
use App\Repository\QueryFactory;
use App\Repository\RepositoryInterface;
use App\Repository\TableName;

/**
 * Repository.
 */
class ConsGeneratorRepository implements RepositoryInterface
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
    public function insertCons(ConsCreatorData $cons): int
    {
        $row = [
            'date' =>$cons->date,
            'start_hour' =>$cons->start_hour,
            'end_hour' => $cons->end_hour,
            'name' => $cons->name,
            'surname' => $cons->surname,
            'email'=> $cons->email,
            'subject'=> $cons->subject,
            'status'=> $cons->status,
            'id_user_FK' => $cons->id_user_FK,
            'id_day_FK' => $cons->id_day_FK,
        ];

        return (int)$this->queryFactory->newInsert(TableName::CONSULTATION, $row)->execute()->lastInsertId();
    }
}
