<?php

use Cake\Chronos\Chronos;
use Phinx\Migration\AbstractMigration;

/**
 * Fixtures
 */
class Days extends AbstractMigration
{
    /**
     * Up Method.
     *
     * @return void
     */
    public function up(): void
    {
        $rows1[] = [
            'id_day' => 1,
            'day_name'=>'poniedziałek',
            'start_cons'=> date('11:00:00'),
            'end_cons'=> date('13:00:00'),
            'id_owner2_FK'=> 1,
        ];
        $this->table('day')->insert($rows1)->save();
        $rows2[] = [
            'id_day' => 2,
            'day_name'=>'piątek',
            'start_cons'=> date('11:00:00'),
            'end_cons'=> date('13:00:00'),
            'id_owner2_FK'=> 1,
        ];
        $this->table('day')->insert($rows2)->save();
    }
}
