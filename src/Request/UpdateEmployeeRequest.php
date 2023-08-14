<?php

declare(strict_types=1);

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;


class UpdateEmployeeRequest extends BaseRequest
{
    #[Assert\Type('string')]
    #[Assert\Length(max: 100)]
    private ?string $name;

    #[Assert\Type('string')]
    #[Assert\Length(max: 130)]
    private ?string $surname;

    #[Assert\Email]
    #[Assert\Length(max: 255)]
    private ?string $email;

    // TODO: #0000 - phoneNumber validation
    #[Assert\Type('string')]
    #[Assert\Length(max: 13)]
    private ?string $phoneNumber;

    private ?array $company;
}
