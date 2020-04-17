<?php

namespace App\Domain\ListCons\Service;

use App\Domain\ListCons\Repository\ListConsDataTableRepository;
use App\Interfaces\ServiceInterface;

/**
 * Service.
 */
final class ListConsDataTable implements ServiceInterface
{
    /**
     * @var ListConsDataTableRepository
     */
    private $repository;

    /**
     * Constructor.
     *
     * @param ListConsDataTableRepository $repository The repository
     */
    public function __construct(ListConsDataTableRepository $repository)
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
