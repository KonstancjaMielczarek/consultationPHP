<?php

namespace App\Domain\Cons\Data;

use App\Interfaces\DataInterface;
use Selective\ArrayReader\ArrayReader;
//include App\Domain\Cons\ConsValidator;

/**
 * Data object.
 */
final class ConsCreatorDataUpdate implements DataInterface
{
    /** @var int|null */
    public $id_consultation;

    /** @var string|null */
    public $start_date;

    /** @var string|null */
    public $start_hour;

    public $subject;

    /** @var string|null */
    public $end_hour;

    /** @var string|null */
    public $name;

    /** @var string|null */
    public $surname;

    /** @var string|null */
    public $email;

    public $status;//

    /** @var int|null */
    public $id_user_FK;


    /** @var int|null */
    public $id_day_FK;
    /**
     * The constructor.
     *
     * @param array $array The array with data
     */
    public function __construct(array $array = [])
    {

        //dayOfWeek();
        $data = new ArrayReader($array);
        $pom=strtotime($data->find('start_hour'));
        $pom=$pom+(int)$data->find('dur')*60;
        $this->id_consultation = $data->findInt('id_consultation');
        $this->start_date = date($data->find('start_date'));
        $this->start_hour = date($data->find('start_hour'));
        $this->subject = $data->find('subject');
        $this->end_hour = date('H:i:s',$pom);
        $this->name = $data->find('name');
        $this->surname = $data->findString('surname');
        $this->email = $data->findString('email');
        $this->status = "oczekiwanie";//nw
        $this->id_user_FK = 1;
        $this->id_day_FK = date('w',strtotime($data->find('start_date')));
    }
}
