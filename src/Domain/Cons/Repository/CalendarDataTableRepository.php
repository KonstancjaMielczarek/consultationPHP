<?php

namespace App\Domain\Cons\Repository;

use App\Factory\QueryFactory;
use App\Repository\DataTableRepository;
use App\Repository\RepositoryInterface;

/**
 * Repository.
 */
class CalendarDataTableRepository implements RepositoryInterface
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
        $query = $this->queryFactory->newSelect('consultation');
        $query->select(['date', 'start_hour', 'end_hour','d.day_name', 'd.start_cons', 'd.end_cons',]);
        $query->join(['d'=> [
            'table' => 'day',
            'condition' => 'd.id_day = id_day_FK',
        ]]);

        return $this->dataTable->load($query, $params);
    }
}
