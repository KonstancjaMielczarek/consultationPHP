<?php

namespace App\Domain\Cons\Data;

use App\Interfaces\DataInterface;
use Selective\ArrayReader\ArrayReader;
//include App\Domain\Cons\ConsValidator;

/**
 * Data object.
 */
final class ConsFewData implements DataInterface
{
    /** @var int|null */
    public $id_consultation;

    /** @var string|null */
    public $start_date;

    /** @var string|null */
    public $start_hour;

    /** @var string|null */
    public $end_hour;

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
        $this->end_hour = date('H:i:s',$pom);
        $this->id_day_FK = date('w',strtotime($data->find('start_date')));
    }
}
