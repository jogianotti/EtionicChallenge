<?php declare(strict_types=1);

namespace App\Domain;

final class NewsGetterUseCase
{
    private $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function __invoke($limit): array
    {
        return $this->newsService->lastNews($limit);
    }
}
