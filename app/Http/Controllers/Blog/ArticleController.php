<?php namespace App\Http\Controllers\Blog;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Eloquent\Blog\Article;
use App\Eloquent\Blog\Tag;

use App\Services\GoogleDrive;
use App\Classes\Markdown\MyMarkdown;


class ArticleController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('pjax');
    }



    /**
     * Blogの表示
     *
     * @return Response
     */
    public function getIndex()
    {
        $articles = Article::where('state', 'public')->orderBy('created_at', 'desc')->take(10)->get();
        $count = Article::where('state', 'public')->count();

        return view('contents.blog.index')->with('articles', $articles)
                                          ->with('count', $count)
                                          ->with('title', 'Blog');
    }



    /**
     * Blogの全件表示
     *
     * @return Response
     */
    public function getArchivesAll()
    {
        $articles = Article::where('state', 'public')->orderBy('created_at', 'desc')->get();

        return view('contents.blog.archives.all')->with('articles', $articles)
                                                 ->with('title', 'Archives');
    }



    /**
     * Tagの一覧表示
     *
     * @return Response
     */
    public function getTagAll()
    {
        $tags = Tag::all();

        return view('contents.blog.tag.all')->with('tags', $tags)
                                            ->with('title', 'Tag');
    }



    /**
     * 指定したTagをもつ記事の一覧表示
     *
     * @return Response
     */
    public function getTag($slug)
    {
        $name = Tag::where('slug', $slug)->first();

        if (! $name) {
            return abort(404);
        } else {
            $title = $name->name;
        }

        $articles = Article::where('state', 'public')->whereHas('tags', function($q) use($slug)
        {
            $q->where('slug', $slug);
        })->orderBy('created_at', 'desc')->with('icon')->get();

        $count = $articles->count();

        return view('contents.blog.tag.index')->with('articles', $articles)
                                              ->with('count', $count)
                                              ->with('title', $title);
    }



    /**
     * 個別記事の表示
     *
     * @param string $slug
     *
     * @return Response
     */
    public function getSingle($slug)
    {
        $article = Article::where('slug', $slug)->with('tags', 'icon')->first();

        if (! $article) {
            return abort(404);
        }

        $client = new GoogleDrive($article->text);

        $created_at = new \DateTime($article->created_at);
        $updated_at = $client->getModifiedDate($created_at);

        $parser = new MyMarkdown();
        $parser->html5 = true;

        $html_content = $parser->parse($client->getContent());
        $html_menu = $parser->createMenu(route('blog.show', $slug));

        return view('contents.blog.single')->with('article', $article)
                                           ->with('created_at', $created_at)
                                           ->with('updated_at', $updated_at)
                                           ->with('title', $article->title)
                                           ->with('html_menu', $html_menu)
                                           ->with('html_content', $html_content);
    }
}
