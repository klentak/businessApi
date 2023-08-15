<?php

declare(strict_types=1);

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateCompanyRequest extends BaseRequest
{
    #[Assert\Type('string')]
    #[Assert\Length(max: 255)]
    protected ?string $name;

    #[Assert\Type('string')]
    #[Assert\Length(min: 10, max: 10)]
    protected ?string $nip;

    #[Assert\Type('string')]
    #[Assert\Length(max: 255)]
    protected ?string $address;

    #[Assert\Type('string')]
    #[Assert\Length(max: 70)]
    protected ?string $city;

    #[Assert\Type('string')]
    #[Assert\Length(max: 11)]
    protected ?string $postCode;
}
