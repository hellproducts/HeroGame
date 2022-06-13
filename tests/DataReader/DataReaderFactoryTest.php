<?php

declare(strict_types=1);

namespace App\Emagia\Tests\DataReader;

use App\Emagia\DataReader\DataReaderFactory;
use App\Emagia\DataReader\DataReaderType;
use App\Emagia\DataReader\JsonDataReader;
use App\Emagia\Exception\DataReaderFactoryException;
use PHPUnit\Framework\TestCase;

class DataReaderFactoryTest extends TestCase
{

    /** @var DataReaderFactory */
    private $factory;

    protected function setUp(): void
    {
        $this->factory = new DataReaderFactory();
    }

    public function testValidJsonDataReader(): void
    {
        $reader = $this->factory->createReader(DataReaderType::JSON);
        $this->assertInstanceOf(JsonDataReader::class, $reader);
    }

    public function testInvalidDataReaderType(): void
    {
        $this->expectException(DataReaderFactoryException::class);
        $reader = $this->factory->createReader("awesome-reader");
    }

}
