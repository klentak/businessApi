<?php

declare(strict_types=1);

namespace App\Request;

use App\Arrayable;
use App\ToArrayTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseRequest implements Arrayable
{
    use ToArrayTrait;

    public function __construct(
        protected ValidatorInterface $validator
    ) {
        $this->fill();
        $this->validate();
    }

    public function validate(): void
    {
        $messages = ['message' => 'Validation failed', 'errors' => []];

        /** @var ConstraintViolation $message */
        foreach ( $this->validator->validate($this) as $message) {
            $messages['errors'][] = [
                'property' => $message->getPropertyPath(),
                'value' => $message->getInvalidValue(),
                'message' => $message->getMessage(),
            ];
        }

        if (count($messages['errors']) > 0) {
            (new JsonResponse($messages, Response::HTTP_BAD_REQUEST))
                ->send();
        }
    }

    public function getRequest(): Request
    {
        return Request::createFromGlobals();
    }

    protected function fill(): void
    {
        foreach ($this->getRequest()->toArray() as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
}
