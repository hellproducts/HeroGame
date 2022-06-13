<?php

namespace App\Emagia\Character;

interface SkillSet
{
    public function rapidStrike(Generic $opponent);
    public function magicShield(Generic $opponent);
}
