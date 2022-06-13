<?php

declare(strict_types=1);

namespace App\Emagia;

use App\Emagia\Character\Beast;
use App\Emagia\Character\Generic;
use App\Emagia\Character\Orderus;

class Game
{
    private Orderus $orderus;
    private Beast $beast;

    private const ROUNDS = 20;

    public function __construct(Orderus $orderus, Beast $beast)
    {
        $this->orderus = $orderus;
        $this->beast = $beast;
    }


    public function fight(): void
    {
        $fighters = $this->determineFirstBlood();
        $this->log($fighters[0]->toString() . ' will attack first');
        for ($i = 0; $i < self::ROUNDS; $i++) {
            $this->log('Rount #'. ($i+1). '!');
            $log = ($fighters[0]->attack($fighters[1]));
            $this->log($log);
            if (!$fighters[1]->isAlive()) {
                $this->log($fighters[1]->toString(). ' died.');
                break;
            }
            $fighters = array_reverse($fighters);
        }
        $this->log($this->determineWinner($fighters));
    }

    private function determineWinner(array $fighters): string
    {
        if ($fighters[0]->getHealth() > $fighters[1]->getHealth()) {
            return $fighters[0]->toString(). ' won!';
        }
        if ($fighters[0]->getHealth() < $fighters[1]->getHealth()) {
            return $fighters[1]->toString(). ' won!';
        }
        if ($fighters[0]->getHealth() === $fighters[1]->getHealth()) {
            return 'Both '.$fighters[0]->toString().' and '.$fighters[1]->toString(). ' fought with honor. It\'s a tie.';
        }
    }

    private function determineFirstBlood(): array
    {
        if ($this->orderus->getSpeed() > $this->beast->getSpeed()) {
            return [$this->orderus, $this->beast];
        } else {
            return [$this->beast, $this->orderus];
        }
        if ($this->orderus->getLuck() > $this->beast->getLuck()) {
            return [$this->orderus, $this->beast];
        } else {
            return [$this->beast, $this->orderus];
        }
    }

    private function log(string $message): void
    {
        echo $message . PHP_EOL;
    }
}
