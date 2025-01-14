<?php

namespace Healsdata\GamermelGenerators\Dto;

class Monster
{
    public function __construct(
        public string $name,
        public string $categoryNote,
        public string $level,
        public string $life,
        public string $attacks,
        public string $morale,
        public string $attackNotes,
        public string $reactions,
        public string $specialNotes,
        public string $treasure,
        public string $source,
    ){

    }
}