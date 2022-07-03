<?php

namespace App\Tests\Domain\Readings\Converter\File;

use App\Domain\Readings\Converter\ConverterFactory;
use App\Domain\Readings\Converter\ConverterSource;
use App\Domain\Readings\Converter\File\Converter;
use App\Domain\Readings\Converter\Converter as ConverterInterface;
use PHPUnit\Framework\TestCase;

class ConverterTest extends TestCase
{
    private ConverterFactory $factory;
    private Converter $converter;

    protected function setUp(): void
    {
        parent::setUp();
        $this->factory = \Mockery::mock(ConverterFactory::class);
        $this->converter = new Converter($this->factory);
    }

    public function testShouldCallConvertInFactoryServiceAndReturnResult()
    {
        $service = \Mockery::mock(ConverterInterface::class);
        $this->factory->shouldReceive('get')->andReturn($service);
        $service->shouldReceive('convert')->andReturn([1,2,3]);
        $result = $this->converter->__invoke('test', 'test');
        $this->assertEquals($result, [1,2,3]);
    }
}