<?php

namespace App\Request;

class UpdateCompanyCommand
{
    #[Assert\Length(max: 255)]
    private  ?string $name;

    #[Assert\Length(min: 10, max: 10)]
    private  ?string $nip;

    #[Assert\Length(max: 255)]
    private  ?string $address;

    #[Assert\Length(max: 70)]
    private  ?string $city;

    #[Assert\Length(max: 11)]
    private  ?string $postCode;
}
