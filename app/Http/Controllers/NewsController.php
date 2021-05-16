<?php

namespace App\Http\Controllers;

use App\Domain\NewsGetterUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private NewsGetterUseCase $newsGetterUseCase;

    public function __construct(NewsGetterUseCase $newsGetterUseCase)
    {
        $this->newsGetterUseCase = $newsGetterUseCase;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $news = ($this->newsGetterUseCase)((int)$request->get('limit'));

        return new JsonResponse($news);
    }
}
