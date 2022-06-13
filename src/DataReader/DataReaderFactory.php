<?php

declare(strict_types=1);

namespace App\Emagia\DataReader;

use App\Emagia\Exception\DataReaderFactoryException;

class DataReaderFactory
{
    /**
     * @param string $type
     *
     * @return DataReaderInterface
     * @throws DataReaderFactoryException
     */
    public function createReader(string $type): DataReaderInterface
    {
        switch ($type) {
            case DataReaderType::JSON:
                return new JsonDataReader();
            default:
                throw new DataReaderFactoryException(
                    'Type' . $type . ' is not a valid data reader type',
                    DataReaderFactoryException::INVALID_TYPE_READER
                );
        }
    }
}
