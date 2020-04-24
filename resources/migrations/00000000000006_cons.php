<?php

use Cake\Chronos\Chronos;
use Phinx\Migration\AbstractMigration;

/**
 * Fixtures
 */
class Cons extends AbstractMigration
{
    /**
     * Up Method.
     *
     * @return void
     */
    public function up(): void
    {

        $rows1[] = [
            'id_consultation' => 1,
            'date'=>date("1999-01-01"),
            'start_hour'=>date("12:10:00"),
            'end_hour'=>date("12:20:00"),
            'subject'=> "IAMI",
            'status'=> "oczekiwanie",
            'name'=>'Andrzej',
            'surname'=>'Luszcz',
            'email'=>'andrzej.luszcz@gmail.com',
            'id_user_FK'=> 1,
            'id_day_FK'=> 1,
        ];
        $this->table('consultation')->insert($rows1)->save();
    }
}
