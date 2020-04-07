<?php

use Phinx\Db\Adapter\MysqlAdapter;

class DbChange20133849385e8cc5f4c8edb extends Phinx\Migration\AbstractMigration
{
    public function change()
    {
        $this->execute("ALTER DATABASE COLLATE='utf8mb4_general_ci';");
        $this->table('users', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->changeColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->changeColumn('username', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'id',
            ])
            ->changeColumn('password', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'username',
            ])
            ->changeColumn('email', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'password',
            ])
            ->changeColumn('first_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'email',
            ])
            ->changeColumn('last_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'first_name',
            ])
            ->changeColumn('role', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'last_name',
            ])
            ->changeColumn('locale', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'role',
            ])
            ->changeColumn('enabled', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'locale',
            ])
            ->changeColumn('created_at', 'datetime', [
                'null' => true,
                'default' => null,
                'after' => 'enabled',
            ])
            ->changeColumn('created_user_id', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'created_at',
            ])
            ->changeColumn('updated_at', 'datetime', [
                'null' => true,
                'default' => null,
                'after' => 'created_user_id',
            ])
            ->changeColumn('updated_user_id', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'updated_at',
            ])
            ->save();
    }
}
