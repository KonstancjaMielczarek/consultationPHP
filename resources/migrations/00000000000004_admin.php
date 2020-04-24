<?php

use Cake\Chronos\Chronos;
use Phinx\Migration\AbstractMigration;

/**
 * Fixtures
 */
class Admin extends AbstractMigration
{
    /**
     * Up Method.
     *
     * @return void
     */
    public function up(): void
    {
        $rows = [];

        $rows[] = [
            'id_user' => 1,
            'name' => 'Mateusz',
            'surname'=> 'Kowalski',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'email' => 'admin@example.com',
            'role' => 'ROLE_ADMIN',
        ];

        $this->table('users')->insert($rows)->save();
    }
}
