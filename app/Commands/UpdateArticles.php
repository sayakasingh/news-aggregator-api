<?php 
namespace App\Console\Commands;

use App\Http\Controllers\ArticleController;
use Illuminate\Console\Command;
use GuzzleHttp\Client;

class UpdateArticles extends Command
{
    protected $signature = 'articles:update';
    protected $description = 'Update articles from external sources';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controller = new ArticleController(new \App\Services\NewsService(new Client()));
        $controller->updateArticles();
        $this->info('Articles updated successfully!');
    }
}
