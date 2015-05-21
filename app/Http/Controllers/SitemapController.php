<?php namespace App\Http\Controllers;

use App\Eloquent\Blog\Article;

class SitemapController extends Controller
{
    private $dom;
    private $main_contents;

    /**
     * コンストラクタ
     *
     * @return void
     */
    public function __construct()
    {
        $dom = new \DOMDocument;
        $dom->loadXML('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');
        $dom->encoding = 'UTF-8';
        $this->dom = $dom;

        $this->main_contents = [
            [route('index')],
            [route('about.index')],
            [route('work.index'), 'monthly'],
            [route('blog.index'), 'weekly'],
            [route('contact.index')],
        ];
    }



    /**
     * サイトマップの表示
     *
     * @return Response
     */
    public function index()
    {
        return response($this->getXml(), 200)->header('Content-Type', 'application/xml');
    }



    /**
     * XMLの生成
     *
     * @return string
     */
    public function getXml()
    {
        // add Contents
        foreach ($this->main_contents as $value) {
            call_user_func_array(array($this, 'add'), $value);
        }

        // add Article
        $this->addArticle();

        return $this->dom->saveXML();
    }



    /**
     * 公開済みのブログの記事を追加
     *
     * @return DOMDocument
     */
    public function addArticle()
    {
        $articles = Article::where('state', 'public')->get();

        foreach ($articles as $article) {
            $this->add(route('blog.show', $article->slug));
        }

        return $this->dom;
    }



    /**
     * サイトマップにデータを追加する
     *
     * @param string $loc
     * @param string $changefreq
     * @return DOMDocument
     */
    public function add($loc, $changefreq = null)
    {
        $root = $this->dom->documentElement;

        // urlset > url
        $url_elem = $this->dom->createElement('url');
        $root->appendChild($url_elem);

        // url > loc
        $loc_elem = $this->dom->createElement('loc');
        $loc_elem->appendChild($this->dom->createTextNode($loc));
        $url_elem->appendChild($loc_elem);

        // url > changefreq
        if ($changefreq !== null) {
            $changefreq_elem = $this->dom->createElement('changefreq');
            $changefreq_elem->appendChild($this->dom->createTextNode($changefreq));
            $url_elem->appendChild($changefreq_elem);
        }

        return $this->dom;
    }
}
