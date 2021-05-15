<?php

namespace Tests\Unit;

use App\Domain\NewsGetterUseCase;
use App\Domain\NewsService;
use Mockery;
use PHPUnit\Framework\TestCase;

class NewsGetterTest extends TestCase
{
    /** @var NewsService|Mockery\MockInterface */
    private $newsService;

    /** @doesNotPerformAssertions */
    public function testItShouldGetLatestNews()
    {
        $limit = 10;

        $this->newsService
            ->shouldReceive('lastNews')
            ->with($limit)
            ->once()
            ->andReturn([]);

        (new NewsGetterUseCase($this->newsService))($limit);
    }

    protected function setUp(): void
    {
        $this->newsService = Mockery::mock(NewsService::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
}
