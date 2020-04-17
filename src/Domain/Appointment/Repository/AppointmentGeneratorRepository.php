<?php

namespace App\Domain\Appointment\Repository;

use App\Domain\Appointment\Data\AppointmentCreatorData;
use App\Factory\QueryFactory;
use App\Repository\RepositoryInterface;
use App\Repository\TableName;

/**
 * Repository.
 */
class AppointmentGeneratorRepository implements RepositoryInterface
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
     * @param AppointmentCreatorData $user The user
     *
     * @return int The new ID
     */
    public function insertAppointment(AppointmentCreatorData $appointment): int
    {
        $row = [
            'firstName' => $appointment->firstName,
            'lastName' => $appointment->lastName,
            'email' => $appointment->email,
            'subject' => $appointment->subject,
            //'date' => $appointment->date,
            'time' => $appointment->time,
            'date' =>"2019-12-11",
            'status' => "oczekiwanie",

        ];

        return (int)$this->queryFactory->newInsert(TableName::APPOINTMENT, $row)->execute()->lastInsertId();
    }
}
