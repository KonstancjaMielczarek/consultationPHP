<?php

namespace App\Domain\ListCons\Repository;

use App\Factory\QueryFactory;
use App\Repository\DataTableRepository;
use App\Repository\RepositoryInterface;

/**
 * Repository.
 */
class ListConsDataTableRepository implements RepositoryInterface
{
    /**
     * @var QueryFactory
     */
    private $queryFactory;

    /**
     * @var DataTableRepository
     */
    private $dataTable;

    /**
     * Constructor.
     *
     * @param QueryFactory $queryFactory The query factory
     * @param DataTableRepository $dataTableRepository The repository
     */
    public function __construct(QueryFactory $queryFactory, DataTableRepository $dataTableRepository)
    {
        $this->queryFactory = $queryFactory;
        $this->dataTable = $dataTableRepository;
    }

    /**
     * Load data table entries.
     *
     * @param array $params The user
     *
     * @return array The table data
     */
    public function getTableData(array $params): array
    {
        $query = $this->queryFactory->newSelect('CONSULTATION');
        $query->select(['CONSULTATION.*']);

        return $this->dataTable->load($query, $params);
    }
}
