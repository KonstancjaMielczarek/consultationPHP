<?php

namespace App\Domain\Appointment;

use App\Interfaces\DataInterface;
use Selective\ArrayReader\ArrayReader;

/**
 * Data object.
 */
final class AppointmentCreatorData implements DataInterface
{
    /** @var int|null */
    public $id_appointment;

    /** @var string|null */
    public $firstName;

    /** @var string|null */
    public $lastName;

    /** @var string|null */
    public $email;

    /** @var string|null */
    public $subject;

    /** @var time|null */
    public $time;

    /** @var date|null */
    public $date;

    /** @var status|null */
    public $status;

    

    /**
     * The constructor.
     *
     * @param array $array The array with data
     */
    public function __construct(array $array = [])
    {
        $data = new ArrayReader($array);
        //$this->id_Appointment = $data->find('id_appointment');//
        $this->firstName = $data->find('firstName');
        $this->lastName = $data->find('lastName');
        $this->email = $data->find('email');
        $this->subject = $data->find('subject');
        $this->time = $data->find('time');//
        //date, status
        /*
        $this->id_Appointment = 2;//
        $this->firstName = "Tomek";
        $this->lastName = "Nowak";
        $this->email = "kofds@op.pl";
        $this->subject = "pis";
        $this->time = "09:02:01";*/

    }
}
