<?php

namespace App\Domain\Apointment;

use App\Interfaces\DataInterface;
use Selective\ArrayReader\ArrayReader;

/**
 * Data object.
 */
final class ApointmentCreatorData implements DataInterface
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

    /**
     * The constructor.
     *
     * @param array $array The array with data
     */
    public function __construct(array $array = [])
    {
        $data = new ArrayReader($array);

        $this->id_appointment = $data->findInt('id_appointment');
        $this->firstName = $data->findString('first_name');
        $this->lastName = $data->findString('last_name');
        $this->email = $data->findString('email');
        $this->subject = $data->findString('subject');
        $this->time = $data->findTime('time');
        $this->date = $data->findDate('date');
    }
}
