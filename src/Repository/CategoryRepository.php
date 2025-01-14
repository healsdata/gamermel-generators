<?php

namespace Healsdata\GamermelGenerators\Repository;

use Google\Service\Exception as GoogleServiceException;
use Google\Service\Sheets;
use Healsdata\GamermelGenerators\Dto\Category;
use Healsdata\GamermelGenerators\Dto\Generator;

class CategoryRepository
{
    public function __construct(
        private readonly Sheets $googleSheets
    )
    {
    }

    /**
     * @return array<Category>
     * @throws GoogleServiceException
     */
    public function getByGenerator(Generator $generator): array
    {
        $sheets = $this->googleSheets->spreadsheets->get($generator->sheetId)->getSheets();

        $categories = [];

        foreach ($sheets as $sheet) {
            $categories[] = new Category($sheet->getProperties()->title);
        }

        return $categories;
    }

    /**
     * @throws GoogleServiceException
     */
    public function getBySlug(Generator $generator, string $slug): ?Category
    {
        foreach ($this->getByGenerator($generator) as $category) {
            if ($category->slug === $slug) {
                return $category;
            }
        }

        return null;
    }
}