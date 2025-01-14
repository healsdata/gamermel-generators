<?php

namespace Healsdata\GamermelGenerators\Repository;

use Healsdata\GamermelGenerators\Dto\Monster;

class MonsterRepository
{

    public function random(): Monster
    {
        return new Monster(
            "2d6 Skeletal Rats",
            "Surviving 10 Encounters gives 1 XP Roll if level 5 or lower and 5 Encounters gives 1 XP Roll if 6 or higher.",
            "Level 3 Undead",
            "5 Life",
            "2 Attacks",
            "Never test morale.",
            "Crushing weapon attacks are at +1 against skeletal rats, but they cannot be attacked by bows and slings. Clerics add +L when attacking them because they are undead.",
            "Reactions (d6): 1-2 flee, 3-6 fight",
            "Note: When you kill a Chaos Lord, roll a die; on a 5 or 6 a character of your choice finds a clue (see p.58).",
            "No Treasure", "Core Book"
        );
    }

}