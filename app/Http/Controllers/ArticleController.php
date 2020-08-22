<?php

namespace App\Http\Controllers;

use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostLike;
use App\Models\Posts\PostView;
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
        $articles = (new Post())
            ->select(DB::raw('id, name, image, RIGHT(description, 20) as description'))
            ->orderByDesc("created_at")
            ->limit(self::COUNT_SHOW_ARTICLES)
            ->paginate(10)
        ;

        return view('articles.articles', ['articles' => $articles]);
    }

    public function article($id)
    {
        $article = (new Post())
            ->where('id', $id)
            ->with(['comments', 'likes', 'views', 'tags'])
            ->first()
        ;

        return view('articles.article', ['article' => $article]);
    }

    public function toggleView($id)
    {
        try {
            $postView = PostView::where(['post_id' => $id])->first();

            if ($postView !== null) {
                PostView::where('post_id', $id)->increment('count');
            } else {
                PostView::create([
                    "count" => 1,
                    "post_id" => $id,
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
            $articleLike = PostLike::where(['post_id' => $id])->first();

            if ($articleLike !== null) {
                PostLike::where('post_id', $id)->increment('count');
            } else {
                 PostLike::create([
                    "count" => 1,
                    "post_id" => $id,
                ]);
            }

            $articleLike = PostLike::where(['post_id' => $id])->first();

            return json_encode(['count' => $articleLike->count]);
        } catch (\InvalidArgumentException $e) {
            $this->logger->error($e);

            return json_encode(['bad']);
        }
    }

    public function addComment(Request $request)
    {
        try {
            PostComment::create([
                "comment" => $request->get('comment'),
                "post_id" => $request->get('id'),
            ]);

            return json_encode($request->get('id'));
        } catch (\InvalidArgumentException $e) {
            $this->logger->error($e);

            return json_encode(['bad']);
        }
    }
}
