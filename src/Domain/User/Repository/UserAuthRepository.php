<?php

namespace App\Domain\User\Repository;

use App\Factory\QueryFactory;

/**
 * Repository.
 */
final class UserAuthRepository
{
    /**
     * @var QueryFactory
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
     * Find user by username.
     *
     * @param string $username Username
     *
     * @return array The user
     */
    public function findUserByUsername(string $email): array
    {
        $query = $this->queryFactory->newSelect('users');

        $query->select([
            'id_user',
            'password',
            'email',
            'role',
            'name',
            'surname',
        ]);

        $query->andWhere([
            'email' => $email,
        ]);

        $row = $query->execute()->fetch('assoc');

        return $row ?: [];
    }
}
