<?php

namespace Youtubedl\Tests;

use PHPUnit\Framework\TestCase;
use Youtubedl\Youtubedl;

class YoutubedlTest extends TestCase
{
    protected $youtubedl;

    /**
     * @test
     */
    public function shouldBeAsync(): void
    {
        $this->assertInstanceOf('Youtubedl\Youtubedl', $this->youtubedl->isAsync(true));
    }

    /**
     * @test
     */
    public function shouldBeVerbose(): void
    {
        $this->assertInstanceOf('Youtubedl\Youtubedl', $this->youtubedl->isVerbose(true));
    }

    /**
     * @test
     */
    public function shouldBeDownloadVerbosely(): void
    {
        $this->youtubedl->isVerbose(true);
        $this->download();
        $this->assertIsArray($this->youtubedl->execute());
    }

    /**
     * @test
     */
    public function shouldExtractAudio(): void
    {
        $this->youtubedl->isVerbose(true);
        $this->youtubedl->getOption()
            ->extractAudio()
            ->setAudioFormat('mp3');
        $this->download();
        $this->assertIsArray($this->youtubedl->execute());
    }


    /**
     * @test
     */
    public function shouldHaveOption(): void
    {
        $this->assertInstanceOf('Youtubedl\Option', $this->youtubedl->getOption());
    }

    /**
     * @test
     */
    public function shouldSetLink(): void
    {
        $this->assertInstanceOf('Youtubedl\Youtubedl', $this->download());
    }

    /**
     * @test
     */
    public function shouldSetLinks(): void
    {
        $this->assertInstanceOf('Youtubedl\Youtubedl', $this->downloads());
    }

    /**
     * @test
     */
    public function shouldThrowException(): void
    {
        $this->expectException(\Youtubedl\Exceptions\YoutubedlException::class);

        $this->youtubedl->getOption()
                    ->getExtractors();
        $this->youtubedl->execute();
    }


    private function downloads(): Youtubedl
    {
        return $this->youtubedl->download([
            'https://www.youtube.com/watch?v=BaW_jenozKc',
            'https://www.youtube.com/watch?v=BaW_jenozKc'
        ]);
    }

    private function download(): Youtubedl
    {
        return $this->youtubedl
                    ->isVerbose(true)
                    ->download('https://www.youtube.com/watch?v=BaW_jenozKc');
    }

    private function getRand(): int
    {
        return mt_rand();
    }

    public function setUp(): void
    {
        $this->youtubedl = new Youtubedl();
        $output = "./tmp/%(title)s_{$this->getRand()}.%(ext)s";
        $this->youtubedl
            ->getOption()
            ->setOutput($output);
    }

    public function tearDown(): void
    {
        foreach (glob('./tmp/*') as $key => $value) {
            unlink($value);
        }
    }
}
