<?php

declare(strict_types=1);

namespace App\Emagia\Character;

class Orderus extends Generic implements SkillSet
{
    private const SHIELD_CHANCE = 20;
    private const RAPID_STRIKE_CHANCE = 10;

    public function rapidStrike(Generic $opponent): string
    {
        $damage = $this->strength - $opponent->getDefence();

        $opponent->setHealth($opponent->getHealth() - (2 * $damage));
        return sprintf('%s used RapidStrike. %s health is now %f', $this->toString(), $opponent->toString(), $opponent->getHealth());
    }

    public function magicShield(Generic $opponent): string
    {
        $damage = ($opponent->getStrength() - $this->defence) / 2;
        $this->health = $this->health - $damage;

        return sprintf('%s used MagicShield and took only half damage (%f). Health is now %f', $this->toString(), $damage, $this->getHealth());
    }

    public function attack(Generic $enemy): string
    {
        $message = $this->toString().' attacks. ';
        if ($enemy->defend($enemy)[0]) {
            return $message.$enemy->toString().' got lucky and the attack failed. Health is still '. $enemy->getHealth();
        } else {
            $chance = mt_rand(1, 100);
            if (self::RAPID_STRIKE_CHANCE >= $chance) {
                return $message.$this->rapidStrike($enemy);
            } else {
                return $message.parent::attack($enemy);
            }
        }
    }

    public function defend(Generic $enemy): array
    {
        $chance = mt_rand(1, 100);
        if ($this->getLuck() >= $chance) {
            return [true, sprintf($this->toString().' got lucky and the attack failed')];
        }

        $useMagicShield = rand(1, 100);
        if (self::SHIELD_CHANCE >= $useMagicShield) {
            return [true, $this->magicShield($enemy)];
        }
        return [false, ''];
    }

    public function toString(): string
    {
        return 'Orderus';
    }
}
