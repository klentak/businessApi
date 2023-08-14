<?php

declare(strict_types=1);

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class CreateCompanyRequest extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    protected string $name;

    #[Assert\NotBlank]
    #[Assert\Length(min: 10, max: 10)]
    protected string $nip;

    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    protected string $address;

    #[Assert\NotBlank]
    #[Assert\Length(max: 70)]
    protected string $city;

    #[Assert\NotBlank]
    #[Assert\Length(max: 11)]
    protected string $postCode;
}
