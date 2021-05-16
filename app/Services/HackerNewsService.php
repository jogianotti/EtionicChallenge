<?php declare(strict_types=1);

namespace App\Services;

use App\Domain\NewsService;
use GuzzleHttp\Client;

final class HackerNewsService implements NewsService
{
    const API_URL = 'https://hacker-news.firebaseio.com/v0';
    const NEW_STORIES_PATH = '/newstories.json';
    const ITEMS_PATH = '/item/%s.json';

    public function lastNews(int $limit = 10): array
    {
        $client = new Client();

        $new_stories_ids = $this->getNewStoriesIDs($client);
        $new_stories = $this->getStories($limit, $new_stories_ids, $client);

        return $new_stories;
    }

    private function getNewStoriesIDs(Client $client): array
    {
        $response = $client->request('GET', self::API_URL . self::NEW_STORIES_PATH);
        $stories_json = $response->getBody()->getContents();

        return json_decode($stories_json, true);
    }

    private function getStories(int $limit, array $new_stories_ids, Client $client): array
    {
        $new_stories = [];
        for ($i = 0; $i < $limit; $i++) {
            $id = $new_stories_ids[$i];
            $response = $client->request('GET', self::API_URL . sprintf(self::ITEMS_PATH, $id));
            $object = json_decode($response->getBody()->getContents());
            $new_stories[] = [
                'title' => $object->title,
                'url' => $object->url ?? '',
            ];
        }

        return $new_stories;
    }
}
