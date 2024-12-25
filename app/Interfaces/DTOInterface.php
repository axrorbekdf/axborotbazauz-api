<?php

namespace App\Interfaces;

interface DTOInterface
{
    public function fromRequest($data): DTOInterface|array;
    public function rules(): array;
    public function toArray(): array;
    public function marge($data): DTOInterface;
}
