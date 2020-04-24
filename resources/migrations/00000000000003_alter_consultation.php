<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AlterConsultation extends AbstractMigration
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

$this->table('consultation', [
                'id' => false,
                'primary_key' => ['id_consultation'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
                ->addColumn('id_consultation', 'integer', [
                    'null' => false,
                    'limit' => MysqlAdapter::INT_REGULAR,
                    'identity' => 'enable',
                ])
                ->addColumn('date', 'date', [
                    'null' => true,
                    'after' => 'id_consultation',
                ])
                ->addColumn('start_hour', 'time', [
                    'null' => true,
                    'after' => 'date',
                ])
                ->addColumn('end_hour', 'time', [
                    'null' => true,
                    'after' => 'start_hour',
                ])               
                ->addColumn('name', 'string', [
                    'null' => false,
                    'limit' => 100,
                    'collation' => 'utf8mb4_unicode_ci',
                    'encoding' => 'utf8mb4',
                    'after' => 'end_hour',
                ])
                ->addColumn('surname', 'string', [
                    'null' => false,
                    'limit' => 100,
                    'collation' => 'utf8mb4_unicode_ci',
                    'encoding' => 'utf8mb4',
                    'after' => 'name',
                ])
                ->addColumn('email', 'string', [
                    'null' => false,
                    'limit' => 255,
                    'collation' => 'utf8mb4_unicode_ci',
                    'encoding' => 'utf8mb4',
                    'after' => 'surname',
                ])
                ->addColumn('subject', 'string', [
                    'null' => false,
                    'limit' => 255,
                    'collation' => 'utf8mb4_unicode_ci',
                    'encoding' => 'utf8mb4',
                    'after' => 'email',
                ])
                ->addColumn('status', 'string', [
                    'null' => false,
                    'limit' => 255,
                    'collation' => 'utf8mb4_unicode_ci',
                    'encoding' => 'utf8mb4',
                    'after' => 'subject',
                ])
                ->addColumn('id_user_FK', 'integer', [
                    'null' => false,
                    'limit' => MysqlAdapter::INT_REGULAR,
                    'after' => 'status',
                ])
                ->addColumn('id_day_FK', 'integer', [
                    'null' => false,
                    'limit' => MysqlAdapter::INT_REGULAR,
                    'after' => 'id_subject_FK',
                ])
                ->addForeignKey('id_user_FK','users','id_user',
                ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_user_FK3'])
                ->addForeignKey('id_day_FK','day','id_day',
                ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_day_FK'])
                ->create();

    }
}