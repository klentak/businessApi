<?php

declare(strict_types=1);

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;


class UpdateCompanyRequest extends BaseRequest
{
    #[Assert\Type('string')]
    #[Assert\Length(max: 255)]
    private ?string $name;

    #[Assert\Type('string')]
    #[Assert\Length(min: 10, max: 10)]
    #[Assert\Unique]
    private ?string $nip;

    #[Assert\Type('string')]
    #[Assert\Length(max: 255)]
    private ?string $address;

    #[Assert\Type('string')]
    #[Assert\Length(max: 70)]
    private ?string $city;

    #[Assert\Type('string')]
    #[Assert\Length(max: 11)]
    private ?string $postCode;
}
