<?php

namespace App\Domain\Cons\Validator;

use App\Domain\Cons\Data\ConsCreatorData;
use Selective\Validation\ValidationResult;

/**
 * Validator.
 */
final class ConsValidator
{
    /**
     * Validate.
     *
     * @param ConsCreatorData $user The user
     *
     * @return ValidationResult The validation result
     */
    public function validateCons(ConsCreatorData $cons): ValidationResult
    {
        $validation = new ValidationResult();

        // if (empty($user->name)) {
        //     $validation->addError('name', __('Input required'));
        // }

        // if (empty($user->surname)) {
        //     $validation->addError('surname', __('Input required'));
        // }

       


        
        // if (empty($user->email)) {
        //     $validation->addError('email', __('Input required'));
        // }
         if (filter_var($cons->email, FILTER_VALIDATE_EMAIL) === false) {
            $validation->addError('email', __('Invalid email address'));
        }

        return $validation;
    }
}
