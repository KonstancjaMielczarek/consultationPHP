<?php

namespace App\Domain\Cons\Service;

use App\Domain\Cons\Repository\CalendarDataTableRepository;
use App\Interfaces\ServiceInterface;

/**
 * Service.
 */
final class CalendarDataTable implements ServiceInterface
{
    /**
     * @var CalendarDataTableRepository
     */
    private $repository;

    /**
     * Constructor.
     *
     * @param CalendarDataTableRepository $repository The repository
     */
    public function __construct(CalendarDataTableRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * List all users.
     *
     * @param array $params The parameters
     *
     * @return array The result
     */
    public function listAllConsultations(array $params): array
    {
        return $this->repository->getTableData($params);
    }
}
