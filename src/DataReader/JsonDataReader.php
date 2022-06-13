<?php

declare(strict_types=1);

namespace App\Emagia\DataReader;

class JsonDataReader implements DataReaderInterface
{
    public function convertFromString(string $data)
    {
        return json_decode($data, true);
    }
}
