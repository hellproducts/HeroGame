<?php

declare(strict_types=1);

namespace App\Emagia\Character;

class Beast extends Generic
{
    public function toString(): string
    {
        return 'Beast';
    }

    public function attack(Generic $enemy): string
    {
        $message = $this->toString().' attacks. ';
        $defend = $enemy->defend($this);
        if (true === $defend[0]) {
            return $message.$defend[1];
        }
        return $message.parent::attack($enemy);
    }

    public function defend(Generic $enemy): array
    {
        $chance = mt_rand(1, 100);
        return [$this->getLuck() >= $chance, sprintf('%s got lucky and the attack failed. Health is still %f', $this->toString(), $this->getHealth())];
    }
}
