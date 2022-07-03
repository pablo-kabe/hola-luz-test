<?php

namespace App\Test\Domain\Readings\Services\Finder;

use App\Domain\Readings\ReadingRepository;
use App\Domain\Readings\Services\Finder\ReadingsMedianByClientFinder;
use App\Tests\Domain\Traits\ReadingTestTrait;
use PHPUnit\Framework\TestCase;

class ReadingsMedianByClientFinderTest extends TestCase
{
    use ReadingTestTrait;

    private ReadingsMedianByClientFinder $readingsMedianByClientFinder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->readingsMedianByClientFinder = new ReadingsMedianByClientFinder($this->readingRepository());
    }

    public function testInvoke()
    {
        $this->readingRepository()->shouldReceive('findGroupByClientAndSumValue')->andReturn([]);
        $result = $this->readingsMedianByClientFinder->__invoke();
        $this->assertEquals($result, []);
    }
}