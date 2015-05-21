<?php namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;

use App\Eloquent\Blog\Article;

class RssController extends Controller
{
    private $dom;

    /**
     * コンストラクタ
     *
     * @return void
     */
    public function __construct()
    {
        $root = route('blog.index');
        $rss = route('blog.rss');
        $data = <<<XML
<rdf:RDF xml:lang="ja"
 xmlns="http://purl.org/rss/1.0/"
 xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
 xmlns:atom="http://www.w3.org/2005/Atom"
 xmlns:dc="http://purl.org/dc/elements/1.1/">
    <channel rdf:about="{$rss}">
        <title>4uing</title>
        <link>{$root}</link>
        <atom:link href="{$rss}" rel="self" type="application/rss+xml" />
        <atom:link rel="hub" href="http://pubsubhubbub.appspot.com" />
        <description>プログラムやウェブ制作についての情報を配信しています。</description>
        <items><rdf:Seq/></items>
    </channel>
</rdf:RDF>
XML;

        $dom = new \DOMDocument;
        $dom->loadXML($data);
        $dom->encoding = 'UTF-8';
        $this->dom = $dom;
    }


    /**
     * RSSの表示
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
            $this->add($article);
        }

        return $this->dom;
    }



    /**
     * RSSにデータを追加する
     *
     * @param string $loc
     * @param string $changefreq
     * @return DOMDocument
     */
    public function add($article)
    {
        $root = $this->dom->documentElement;
        $rdf_ns = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#';
        $channel = $root->getElementsByTagNameNS($rdf_ns, 'Seq')->item(0);

        $loc = route('blog.show', $article->slug);

        $li = $this->dom->createElementNS($rdf_ns, 'rdf:li');
        $li->setAttributeNS($rdf_ns, 'rdf:resource', $loc);
        $channel->appendChild($li);

        $item = $this->dom->createElement('item');
        $item->setAttributeNS($rdf_ns, 'rdf:about', $loc);
        $root->appendChild($item);

        $title = $this->dom->createElement('title');
        $title->appendChild($this->dom->createTextNode($article->title));
        $item->appendChild($title);

        $link = $this->dom->createElement('link');
        $link->appendChild($this->dom->createTextNode($loc));
        $item->appendChild($link);

        $date = $this->dom->createElementNS('http://purl.org/dc/elements/1.1/', 'dc:date');
        $date->appendChild($this->dom->createTextNode($article->created_at->format('Y-m-d')));
        $item->appendChild($date);

        return $this->dom;
    }

}
