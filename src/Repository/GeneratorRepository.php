<?php

namespace Healsdata\GamermelGenerators\Repository;

use Healsdata\GamermelGenerators\Dto\Generator;

class GeneratorRepository
{
    /**
     * @return array<Generator>
     */
    public function list(): array
    {
        return [
            new Generator('Monsters', 'monster', '1JK7hLLHhtMlhD-VmcuVIdY9wpfVyvcJpjQ039os-Xoo')
        ];
    }

    public function getBySlug(string $slug): ?Generator
    {
        foreach ($this->list() as $generator) {
            if ($generator->slug === $slug) {
                return $generator;
            }
        }

        return null;
    }
}