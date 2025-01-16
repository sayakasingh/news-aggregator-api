<?php 
namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\NewsService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function fetchArticles(Request $request)
    {
        $query = Article::query();

       
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('source')) {
            $query->where('source', $request->source);
        }

        if ($request->has('author')) {
            $query->where('author', $request->author);
        }

        // Apply search query
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->get();

        return response()->json($articles);
    }

    public function updateArticles()
    {
        $articles = array_merge(
            $this->newsService->fetchFromNewsAPI(),
            $this->newsService->fetchFromOpenNews(),
            $this->newsService->fetchFromGuardian()
        );

        $this->newsService->storeArticles($articles);

        return response()->json(['message' => 'Articles updated successfully']);
    }
}
