<?php

namespace App\Http\Controllers;

use App\Models\Posts\Article;
use App\Models\Posts\ArticleComment;
use App\Models\Posts\ArticleLike;
use App\Models\Posts\ArticleView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psr\Log\LoggerInterface;

class ArticleController extends Controller
{
    private const COUNT_SHOW_ARTICLES = 10;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;

    }
    public function articles()
    {
        $articles = (new Article())
            ->select(DB::raw('id, name, image, RIGHT(description, 20) as description'))
            ->orderByDesc("created_at")
            ->limit(self::COUNT_SHOW_ARTICLES)
            ->paginate(10)
        ;

        return view('articles.articles', ['articles' => $articles]);
    }

    public function article($id)
    {
        $article = (new Article())
            ->where('id', $id)
            ->with(['comments', 'likes', 'views', 'tags'])
            ->first()
        ;

        return view('articles.article', ['article' => $article]);
    }

    public function toggleView($id)
    {
        try {
            $articleView = ArticleView::where(['article_id' => $id])->first();

            if ($articleView !== null) {
                ArticleView::where('article_id', $id)->increment('count');
            } else {
                ArticleView::create([
                    "count" => 1,
                    "article_id" => $id,
                ]);
            }

            return json_encode(['response' => 'success']);
        } catch (\InvalidArgumentException $e) {
            $this->logger->error($e);

            return json_encode(['response' => 'bad']);
        }
    }

    public function toggleLike($id)
    {
        try {
            $articleLike = ArticleLike::where(['article_id' => $id])->first();

            if ($articleLike !== null) {
                ArticleLike::where('article_id', $id)->increment('count');
            } else {
                 ArticleLike::create([
                    "count" => 1,
                    "article_id" => $id,
                ]);
            }

            $articleLike = ArticleLike::where(['article_id' => $id])->first();

            return json_encode(['count' => $articleLike->count]);
        } catch (\InvalidArgumentException $e) {
            $this->logger->error($e);

            return json_encode(['bad']);
        }
    }

    public function addComment(Request $request)
    {
        try {
            ArticleComment::create([
                "comment" => $request->get('comment'),
                "article_id" => $request->get('id'),
            ]);

            return json_encode($request->get('id'));
        } catch (\InvalidArgumentException $e) {
            $this->logger->error($e);

            return json_encode(['bad']);
        }
    }
}
