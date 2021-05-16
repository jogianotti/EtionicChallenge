<?php

namespace Tests\Unit;

use App\Services\HackerNewsService;
use PHPUnit\Framework\TestCase;

class HackerNewsServiceTest extends TestCase
{
    private HackerNewsService $hackerNewsService;

    public function testItShouldRequestHackerNewsApi()
    {
        $limit = 10;

        $news = $this->hackerNewsService->lastNews($limit);

        self::assertIsArray($news);
        self::assertCount($limit, $news);
    }

    protected function setUp(): void
    {
        $this->hackerNewsService = new HackerNewsService();
    }
}
