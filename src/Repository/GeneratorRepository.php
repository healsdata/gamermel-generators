<?php

namespace Healsdata\GamermelGenerators\Repository;

class GeneratorRepository
{
    const GENERATORS = [
        [
            'slug' => 'monster',
            'name' => 'Monsters',
        ],
        [
            'slug' => 'test',
            'name' => 'Test',
        ],
        [
            'slug' => 'gift',
            'name' => 'Gifts',
        ]

    ];

    public function list() : array
    {
        return self::GENERATORS;
    }

    public function getBySlug(string $slug) : ?array
    {
        foreach (self::GENERATORS as $generator) {
            if ($generator['slug'] === $slug) {
                return $generator;
            }
        }

        return null;
    }
}