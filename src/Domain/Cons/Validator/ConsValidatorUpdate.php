<?php

namespace App\Domain\Cons\Validator;

use App\Domain\Cons\Data\ConsFewData;//
use App\Domain\Cons\Data\ConsCreatorDataUpdate;//
use Selective\Validation\ValidationResult;
use App\Repository\QueryFactory;
/**
 * Validator.
 */
final class ConsValidatorUpdate
{
    /**
     * Validate.
     *
     * @param ConsCreatorDataUpdate $user The user
     *
     * @return ValidationResult The validation result
     */

    /**
     * @var QueryFactory
     */
    private $queryFactory;

    private $repository;
    /**
     * Constructor.
     *
     * @param QueryFactory $queryFactory The query factory
     */
    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function validateCons(ConsCreatorData $cons): ValidationResult
    {
        $validation = new ValidationResult();

        $query = $this->queryFactory->newSelect('consultation')->select('*');

        $results = $query->execute()->fetch('assoc');
        //array("hello" => "val")["hello"];

        // while ($row = mysql_fetch_array($results)) {
 
        //     if($row['start_hour']<=$cons->start_hour && $result["end_hour"]>=$cons->start_hour && $result["accept"]==1 && $result["start_date"]==$cons->start_date){
        //         $validation->addError('start_hour', __("O tej godzinie sa inne konsultacje"));
        //     }
        //     if($result["start_hour"].""<=$cons->end_hour && $result["end_hour"]>=$cons->start_hour && $result["accept"]==1 && $result["start_date"]==$cons->start_date){
        //         $validation->addError('end_hour', __("O tej godzinie sa inne konsultacje"));
        //     }

        //    $id = $row['id'];
        //    $array[] = $id;
        // }
        // for($i=0; $i<count($results); $i++){
        //         echo $i;
        //       for($j=0; $j<11; $j++){
        //             echo $j;
        //       }  
        // }

        // foreach($results as $result1){
        //     foreach($result1 as $result){
        //         if($result["start_hour"].""<=$cons->start_hour && $result["end_hour"]>=$cons->start_hour && $result["accept"]==1 && $result["start_date"]==$cons->start_date){
        //             $validation->addError('start_hour', __("O tej godzinie sa inne konsultacje"));
        //         }
        //         if($result["start_hour"].""<=$cons->end_hour && $result["end_hour"]>=$cons->start_hour && $result["accept"]==1 && $result["start_date"]==$cons->start_date){
        //             $validation->addError('end_hour', __("O tej godzinie sa inne konsultacje"));
        //         }

        //     }
            
        // }

        if (filter_var($cons->email, FILTER_VALIDATE_EMAIL) === false) {
            $validation->addError('email', __('Invalid email address'));
        }

        $query = $this->queryFactory->newSelect('day')->select('*');
        $id_day= $query->execute()->fetchAll('assoc');
        
        switch(sizeof($id_day)){
            case 1:
                if (date('w',strtotime(($cons->date))) != $id_day[0]['id_day']) {
                    $validation->addError('id_day', __("W tym dniu nie ma konsultacji"));
                }
            break;
            case 2:
                if ((date('w',strtotime(($cons->date))) != $id_day[0]['id_day']) && (date('w',strtotime(($cons->date))) != $id_day[1]['id_day'])) {
                    $validation->addError('id_day', __("W tym dniu nie ma konsultacji"));
                }
            break;
        }
            
        return $validation;
    }
    public function validateCons1(ConsFewData $cons): ValidationResult
    {
        $validation = new ValidationResult();


        $query = $this->queryFactory->newSelect('day')->select('*');
        $id_day= $query->execute()->fetchAll('assoc');
        
        switch(sizeof($id_day)){
            case 1:
                if (date('w',strtotime(($cons->date))) != $id_day[0]['id_day']) {
                    $validation->addError('id_day', __("W tym dniu nie ma konsultacji"));
                }
            break;
            case 2:
                if ((date('w',strtotime(($cons->date))) != $id_day[0]['id_day']) && (date('w',strtotime(($cons->date))) != $id_day[1]['id_day'])) {
                    $validation->addError('id_day', __("W tym dniu nie ma konsultacji"));
                }
            break;
        }
            
        return $validation;
    }
}
