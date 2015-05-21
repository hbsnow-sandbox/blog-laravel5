<?php namespace App\Http\Controllers\Admin\Blog;

use App\Http\Requests;
use App\Http\Requests\Admin\DestroyRequest;
use App\Http\Requests\Admin\Blog\ArticleRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Eloquent\Blog\Article;
use App\Eloquent\Blog\Icon;
use App\Eloquent\Blog\Tag;

use Hbsnow\Pshb\Publisher;
use Twitter;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::orderBy('id', 'desc')->get();

        return view('admin.contents.blog.article.index')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $icons = Icon::orderBy('name', 'asc')->get();
        $tags = Tag::orderBy('name', 'asc')->get();

        return view('admin.contents.blog.article.create')->with('icons', $icons)
                                                         ->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ArticleRequest $request)
    {
        $inputs = $request->only('title', 'slug', 'text', 'state', 'tags', 'icon');

        $article = Article::create([
            'title' => array_get($inputs, 'title'),
            'slug' => array_get($inputs, 'slug'),
            'text' => array_get($inputs, 'text'),
            'state' => array_get($inputs, 'state'),
            'icon_id' => array_get($inputs, 'icon'),
            'created_at' => new \DateTime,
            'updated_at' => new \DateTime,
        ]);

        $article->tags()->sync(array_get($inputs, 'tags'));

        if (array_get($inputs, 'state') === 'public') {
            $error_message = $this->pshb();
            $this->tweet(array_get($inputs, 'title'), route('blog.show', array_get($inputs, 'slug')));
        }

        return redirect()->route('admin.blog.article.index')
                         ->with('success', '新規記事を投稿しました。')
                         ->with('error', $error_message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $article = Article::find($id);

        return view('admin.contents.blog.article.show')->with('article', $article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $icons = Icon::all();
        $tags = Tag::all();

        return view('admin.contents.blog.article.edit')->with('article', $article)
                                                       ->with('icons', $icons)
                                                       ->with('tags', $tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $inputs = $request->only('title', 'slug', 'text', 'state', 'tags', 'icon');

        $article = Article::find($id);

        switch (array_get($inputs, 'state')) {
            case 'delete':
                return redirect()->route('admin.blog.article.show', $id);

            case 'public':
                $error_message = $this->pshb();

                // draftからpublicにしたときは新規作成と同じ扱い
                if ($article->state === 'draft') {
                    $this->tweet(array_get($inputs, 'title'), route('blog.show', array_get($inputs, 'slug')));
                }
                break;
        }

        $article->title = array_get($inputs, 'title');
        $article->slug = array_get($inputs, 'slug');
        $article->text = array_get($inputs, 'text');
        $article->state = array_get($inputs, 'state');
        $article->icon_id = array_get($inputs, 'icon');
        $article->updated_at = new \DateTime;
        $article->save();

        $article->tags()->sync(array_get($inputs, 'tags'));

        return redirect()->route('admin.blog.article.index', $id)
                         ->with('article', $article)
                         ->with('success', '記事を編集しました。')
                         ->with('error', $error_message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(DestroyRequest $request, $id)
    {
        Article::destroy($id);

        return redirect()->route('admin.blog.article.index')
                         ->with('success', '記事を削除しました。');
    }


    /**
     * Tweet
     *
     * @param string $title
     * @param string $url
     * @return void
     */
    private function tweet($title, $url)
    {
        $status = '"' . $title . ' | 4uing" ' . $url;

        Twitter::postTweet(['status' => $status, 'format' => 'json']);
    }

    /**
     * PSHB
     *
     * @return string
     */
    private function pshb()
    {
        $message = '';

        if (getenv('APP_ENV') !== 'local') {
            $pshb = new Publisher('http://pubsubhubbub.appspot.com/');
            $rss = route('blog.rss');

            if (! $pshb->update($rss)) {
                $message = 'PubSubHubBubのPostに失敗しました。';
            }
        }

        return $message;
    }
}
