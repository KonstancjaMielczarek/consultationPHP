<?php

namespace App\Domain\Cons\Data;

use App\Interfaces\DataInterface;
use Selective\ArrayReader\ArrayReader;

/**
 * Data object.
 */
final class ConsCreatorData implements DataInterface
{
    /** @var int|null */
    public $id_consultation;

    /** @var string|null */
    public $date;

    /** @var string|null */
    public $start_hour;

    /** @var string|null */
    public $end_hour;

    /** @var string|null */
    public $name;

    /** @var string|null */
    public $surname;

    /** @var string|null */
    public $email;

    /** @var string|null */
    public $subject;

    /** @var string|null */
    public $status;

    /** @var int|null */
    public $id_user_FK;


    /**
     * The constructor.
     *
     * @param array $array The array with data
     */
    public function __construct(array $array = [])
    {
        $data = new ArrayReader($array);
        // $pom=strtotime($data->find('start_hour'));
        // $pom=$pom+(int)$data->find('dur')*60;
        $this->id_consultation = $data->findInt('id_consultation');
        // $this->id_consultation = 3;
        $this->date = date($data->find('date'));
        $this->start_hour = date($data->find('start_hour'));
        $this->end_hour = date($data->find('end_hour'));
        $this->name = $data->find('name');
        $this->surname = $data->findString('surname');
        $this->email = $data->findString('email');
        $this->subject = $data->findString('subject');
        // $this->status = $data->findString('status');
        // $this->id_user_FK = 1;

        // $this->id_consultation = 3;
        // $this->date = date("1999-01-01");
        // $this->start_hour = date("12:00:00");
        // $this->end_hour = date("12:00:00");
        // $this->name = 'Konstancja';
        // $this->surname = 'Mielczarek';
        // $this->email = 'k.m@wp.pl';
        // $this->subject = 'IAM';
        $this->status = 'oczekiwanie';
        $this->id_user_FK = 1;
    }
}
