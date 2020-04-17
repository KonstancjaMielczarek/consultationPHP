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

        $this->id = $data->findInt('id_appointment');
        $this->firstName = $data->findString('firstName');
        $this->lastName = $data->findString('lastName');
        $this->email = $data->findString('email');
        $this->subject = $data->findString('subject');
        $this->time = $data->findString('time');

    }
}
