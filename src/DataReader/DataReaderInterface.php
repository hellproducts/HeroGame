<?php

declare(strict_types=1);

namespace App\Emagia\DataReader;

interface DataReaderInterface
{
    public function convertFromString(string $data);
}
