<?php


namespace App\Domain;

interface NewsService
{
    public function lastNews(int $limit): array;
}
