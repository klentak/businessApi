<?php

declare(strict_types=1);

namespace App;

trait ToArrayTrait
{
    public function toArray(): array
    {
        $values = [];

        foreach ($this as $name => $var) {
            $values[$name] = $var instanceof Arrayable ? $var->toArray() : $var;
        }

        return $values;
    }

}
