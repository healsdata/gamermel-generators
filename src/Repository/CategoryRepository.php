<?php

namespace Healsdata\GamermelGenerators\Repository;

class CategoryRepository
{
    public function getByGenerator(string $generatorSlug) : ?array
    {
        if ($generatorSlug === "monster") {
            return [
                [
                    'slug' => 'vermin',
                    'name' => 'Vermin',
                ],
                [
                    'slug' => 'minion',
                    'name' => 'Minion',
                ],
                [
                    'slug' => 'boss',
                    'name' => 'Boss',
                ],
                [
                    'slug' => 'weird',
                    'name' => 'Weird Monster',
                ]
            ];
        }

        return null;
    }

    public function getBySlug(string $generatorSlug, string $slug) : ?array
    {
        return [
            'slug' => 'vermin',
            'name' => 'Vermin',
        ];
    }
}