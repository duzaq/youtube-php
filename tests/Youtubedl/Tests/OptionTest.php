<?php

namespace Youtubedl\Tests;

use PHPUnit\Framework\TestCase;
use Youtubedl\Option;

class OptionTest extends TestCase
{
    protected $option;

    /**
     * @test
     */
    public function shouldBeOption()
    {
        $this->assertInstanceOf('Youtubedl\Option', $this->option->getListExtractors());
    }

    /**
     * @test
     */
    public function shouldEmptyOptionBeString()
    {
        $this->assertIsArray($this->option->format());
    }

    /**
     * @test
     */
    public function shouldOptionBeString()
    {
        $this->option->getListExtractors()
            ->setUserAgent('Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14');
        $this->assertIsArray($this->option->format());
    }

    public function setUp(): void
    {
        $this->option = new Option();
    }
}
