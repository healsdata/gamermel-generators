<?php

namespace Healsdata\GamermelGenerators\Repository;

use Google\Service\Exception as GoogleServiceException;
use Google\Service\Sheets;
use Healsdata\GamermelGenerators\Dto\Category;
use Healsdata\GamermelGenerators\Dto\Generator;
use Healsdata\GamermelGenerators\Dto\Monster;

class MonsterRepository
{
    public function __construct(
        private readonly Sheets $googleSheets
    ){}

    /**
     * @param Generator $generator
     * @param Category $category
     * @return null|Monster
     * @throws GoogleServiceException
     */
    public function random(Generator $generator, Category $category): ?Monster
    {
        $monster = new Monster();

        $range = $category->name . "!A2";
        $response = $this->googleSheets->spreadsheets_values->get($generator->sheetId, $range);
        $monster->categoryNote = $response->getValues()[0][0];

        $range = $category->name . "!5:5";
        $response = $this->googleSheets->spreadsheets_values->get($generator->sheetId, $range);
        $keys = $response->getValues()[0];
        $keys = array_map('strtolower', $keys);

        $columns = range('A', 'Z');
        $lastColumn = $columns[sizeof($keys) - 1];

        $range = $category->name . "!A6:" . $lastColumn . "99";
        $response = $this->googleSheets->spreadsheets_values->get($generator->sheetId, $range);
        $data = $response->getValues();

        $datum = array_combine($keys, $data[array_rand($data)]);

        $monster->name = $datum['name'];
        $monster->level = $datum['level'];
        $monster->life  = $datum['life'];
        $monster->attacks = $datum['attacks'];
        $monster->morale = $datum['morale'];
        $monster->attackNotes = $datum['attack notes'];
        $monster->reactions = $datum['reactions'];
        $monster->specialNotes = $datum['special notes'];
        $monster->treasure = $datum['treasure'];
        $monster->source = $datum['source'];

        return $monster;
    }
}