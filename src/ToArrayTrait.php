<?php

declare(strict_types=1);

namespace App;

trait ToArrayTrait
{
    public function toArray(): array
    {
        $values = [];

        foreach ($this as $name => $value) {
            $values[$name] = $value instanceof Arrayable ? $value->toArray() : $value;
        }

        return $values;
    }
}
