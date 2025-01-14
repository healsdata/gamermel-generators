<?php

namespace Healsdata\GamermelGenerators\Dto;

class Category
{
    public string $slug;

    public function __construct(
        public string $name,
    )
    {
        $this->slug = urlencode(strtolower($this->name));
    }
}