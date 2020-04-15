<?php

namespace App\Domain\Appointment\Service;

use App\Domain\Appointment\Data\AppointmentCreatorData;
use App\Domain\Appointment\Repository\AppointmentGeneratorRepository;
use App\Domain\Appointment\Validator\AppointmentValidator;
use App\Factory\LoggerFactory;
use App\Interfaces\ServiceInterface;
use Psr\Log\LoggerInterface;
use Selective\Validation\Exception\ValidationException;

/**
 * Domain Service.
 */
final class AppointmentCreator implements ServiceInterface
{
    /**
     * @var UserGeneratorRepository
     */
    private $repository;

    /**
     * @var UserValidator
     */
    protected $appointmentValidator;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * The constructor.
     *
     * @param UserGeneratorRepository $repository The repository
     * @param UserValidator $userValidator The user validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        UserGeneratorRepository $repository,
        UserValidator $appointmentValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->appointmentValidator = $appointmentValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('appointment_creator.log')
            ->createInstance('appointment_creator');
    }

    /**
     * Create a new user.
     *
     * @param UserCreatorData $user The user data
     *
     * @throws ValidationException
     *
     * @return int The new user ID
     */
    public function createAppointment(AppointmentCreatorData $appointment): int
    {
        // Validation
        $validation = $this->appointmentValidator->validateAppointment($appointment);

        if ($validation->isFailed()) {
            $validation->setMessage(__('Please check your input'));

            throw new ValidationException($validation);
        }

        // Insert user
        $appointmentId = $this->repository->insertAppointment($appointment);

        // Logging
        $this->logger->info(__('Appointment created successfully: %s', $appointmentId));

        return $appointmentId;
    }
}
