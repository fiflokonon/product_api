<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;
use App\Exception\ValidationException;

final class UserCreate
{
    private UserRepository $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new user.
     *
     * @param array $data The form data
     * @return int The new user ID
     */
    public function createUser(array $data): array
    {
        // Input validation
        $this->validateNewUser($data);

        // Insert user
        $user = $this->repository->insertUser($data);

        return $user;
    }

    /**
     * Input validation.
     *
     * @param array $data The form data
     *
     * @return void
     * @throws ValidationException
     *
     */
    private function validateNewUser(array $data): void
    {
        $errors = [];

        // Here you can also use your preferred validation library

        if (empty($data['firstName'])) {
            $errors['firstName'] = 'Input required';
        }

        if (empty($data['lastName'])) {
            $errors['lastName'] = 'Input required';
        }

        if (empty($data['email'])) {
            $errors['email'] = 'Input required';
        } elseif (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors['email'] = 'Invalid email address';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Input required';
        }
        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}
