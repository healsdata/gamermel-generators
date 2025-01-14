<?php

namespace Healsdata\GamermelGenerators\Dto;

class Generator
{
    public function __construct(
        public string $name,
        public string $slug,
        public string $sheetId
    )
    {
    }
}