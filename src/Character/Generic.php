<?php

namespace App\Emagia\Character;

abstract class Generic
{
    protected int $health;

    protected int $strength;

    protected int $defence;

    protected int $speed;

    protected int $luck;


    /**
     * Get the value of health
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * Set the value of health
     */
    public function setHealth(int $health): self
    {
        $this->health = $health;

        return $this;
    }

    /**
     * Get the value of luck
     */
    public function getLuck(): int
    {
        return $this->luck;
    }

    /**
     * Set the value of luck
     */
    public function setLuck($luck): self
    {
        $this->luck = $luck;

        return $this;
    }

    /**
     * Get the value of strength
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * Set the value of strength
     */
    public function setStrength(int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get the value of defence
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * Set the value of defence
     */
    public function setDefence(int $defence): self
    {
        $this->defence = $defence;

        return $this;
    }

    /**
     * Get the value of speed
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * Set the value of speed
     */
    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function attack(Generic $enemy): string
    {
        // Damage = Attacker strength – Defender defence
        $damage = $this->strength - $enemy->getDefence();
        $enemy->setHealth($enemy->getHealth() - $damage);
        return sprintf('%s took %d damage. %s now has %d health.', $enemy->toString(), $damage, $enemy->toString(), $enemy->getHealth());
    }

    abstract public function defend(Generic $enemy): array;

    abstract public function toString(): string;

    public static function loadCharacter(string $class, array $specs): self
    {
        $character = new $class();

        foreach ($specs as $property => $values) {
            $setter = 'set'.ucfirst($property);
            if (method_exists($character, $setter)) {
                $min = $values['min'];
                $max = $values['max'];
                $value = rand($min, $max);
                $character->$setter($value);
            }
        }

        return $character;
    }

    public function isAlive(): bool
    {
        return $this->health > 0;
    }
}
