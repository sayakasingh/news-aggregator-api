<?php 
namespace App\Services;

use GuzzleHttp\Client;

class NewsService
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetchFromNewsAPI()
    {
        $response = $this->client->get('https://newsapi.org/v2/top-headlines', [
            'query' => [
                'apiKey' => 'api_key',
                'country' => 'us',
                'pageSize' => 5
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true)['articles'];
    }

    public function fetchFromOpenNews()
    {
       
        $response = $this->client->get('https://opennewsapi.com/articles', [
            'query' => [
                'apiKey' => 'api_key',
                'country' => 'us',
                'pageSize' => 5
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true)['articles'];
    }

    public function fetchFromGuardian()
    {
       
        $response = $this->client->get('https://content.guardianapis.com/search', [
            'query' => [
                'apiKey' => 'api_key',
                'section' => 'world',
                'pageSize' => 5
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true)['response']['results'];
    }

    public function storeArticles($articles)
    {
        foreach ($articles as $article) {
            \App\Models\Article::create([
                'title' => $article['title'],
                'description' => $article['description'] ?? $article['content'] ?? 'No content available',
                'source' => $article['source']['name'] ?? 'Default',
                'category' => $article['category'] ?? 'General',
                'author' => $article['author'] ?? 'Default',
                'created_at' => $article['publishedAt'] ?? now()
            ]);
        }
    }
}
