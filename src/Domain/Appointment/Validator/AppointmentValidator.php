<?php

namespace App\Domain\Appointment\Validator;

use App\Domain\Appointment\Data\AppointmentCreatorData;
use Selective\Validation\ValidationResult;

/**
 * Validator.
 */
final class AppointmentValidator
{
    /**
     * Validate.
     *
     * @param UserCreatorData $user The user
     *
     * @return ValidationResult The validation result
     */
    public function validateAppointment(AppointmentCreatorData $appointment): ValidationResult
    {
        $validation = new ValidationResult();

        if (empty($appointment->firstname)) {
            $validation->addError('firstname', __('Input required'));
        }

        if (empty($appointment->lastname)) {
            $validation->addError('lastname', __('Input required'));
        }

        if (empty($appointment->subject)) {
            $validation->addError('subject', __('Input required'));
        }

        if (empty($user->email)) {
            $validation->addError('email', __('Input required'));
        } elseif (filter_var($user->email, FILTER_VALIDATE_EMAIL) === false) {
            $validation->addError('email', __('Invalid email address'));
        }

        return $validation;
    }
}
