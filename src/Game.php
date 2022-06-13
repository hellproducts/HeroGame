<?php

declare(strict_types=1);

namespace App\Emagia;

use App\Emagia\Character\Beast;
use App\Emagia\Character\Generic;
use App\Emagia\Character\Orderus;

class Game
{
    private const ROUNDS = 20;

    public function fight(Orderus $orderus, Beast $beast): void
    {
        $fighters = $this->determineFirstBlood($orderus, $beast);
        $this->log($fighters[0]->toString() . ' will attack first');
        for ($i = 0; $i < self::ROUNDS; $i++) {
            $this->log('Turn #'. ($i+1). '!');
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

    private function determineFirstBlood(Orderus $orderus, Beast $beast): array
    {
        if ($orderus->getSpeed() > $beast->getSpeed()) {
            return [$orderus, $beast];
        } else {
            return [$beast, $orderus];
        }
        if ($orderus->getLuck() > $beast->getLuck()) {
            return [$orderus, $beast];
        } else {
            return [$beast, $orderus];
        }
    }

    private function log(string $message): void
    {
        echo $message . PHP_EOL;
    }
}
