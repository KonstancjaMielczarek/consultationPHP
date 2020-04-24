<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AlterDay extends AbstractMigration
{
    /**
     * Change.
     *
     * @return void
     */
    public function change()
    {
        $this->execute("ALTER DATABASE CHARACTER SET 'utf8mb4';");
        $this->execute("ALTER DATABASE COLLATE='utf8mb4_unicode_ci';");

$this->table('day', [
                'id' => false,
                'primary_key' => ['id_day'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
                ->addColumn('id_day', 'integer', [
                    'null' => false,
                    'limit' => MysqlAdapter::INT_REGULAR,
                    'identity' => 'enable',
                ])
                ->addColumn('day_name', 'string', [
                    'null' => false,
                    'limit' => 255,
                    'collation' => 'utf8mb4_unicode_ci',
                    'encoding' => 'utf8mb4',
                    'after' => 'id_day',
                ])
                ->addColumn('start_cons', 'time', [
                    'null' => true,
                    'after' => 'day_name',
                ])
                ->addColumn('end_cons', 'time', [
                    'null' => true,
                    'after' => 'start_cons',
                ])
                ->addColumn('id_owner2_FK', 'integer', [
                    'null' => false,
                    'limit' => MysqlAdapter::INT_REGULAR,
                    'after' => 'end_cons',
                ])
                ->addForeignKey('id_owner2_FK','users','id_user',
                ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_user_FK2'])
                ->create();
    }
}