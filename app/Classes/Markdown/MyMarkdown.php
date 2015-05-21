<?php namespace App\Classes\Markdown;

use cebe\markdown\GithubMarkdown;

class MyMarkdown extends GithubMarkdown {

    private $menu = [];
    private $max_level = 7;
    public $id_prefix = 'article-';



    protected function renderHeadline($block)
    {
        $level = intval($block['level']);

        // 最大レベルの調整
        if ($this->max_level > $level) {
            $this->max_level = $level;
        }

        $render = $this->renderAbsy($block['content']);

        // id出力用データ追加
        $html_id = $this->id_prefix . str_replace([' ', '#'], '_', mb_convert_kana(strip_tags($render), 'asK'));

        $tail = '';
        $count = 1;
        foreach ($this->menu as $value) {
            if ($html_id . $tail === $value[2]) {
                $tail = "-{$count}";
                $count++;

                continue;
            }
        }

        $html_id .= $tail;

        $this->menu[] = [$level, $render, $html_id];

        $tag = 'h' . $block['level'];
        return "<$tag id=\"" . $html_id . "\"><a href=\"#" . $html_id . "\">$render</a></$tag>\n";
    }



    public function createMenu($url = '')
    {
        if (empty($this->menu)) {
            return '';
        }

        $result = '<ol>';

        foreach ($this->menu as $value) {
            if ($value[0] === $this->max_level) {
                $href = "{$url}#{$value[2]}";
                $result .= "<li><a href=\"{$href}\">{$value[1]}</a></li>";
            }
        }

        $result .= '</ol>';

        return $result;
    }



    protected function consumeFencedCode($lines, $current)
    {
        // consume until ```
        $line = rtrim($lines[$current]);
        $fence = substr($line, 0, $pos = strrpos($line, $line[0]) + 1);
        $language = substr($line, $pos);
        $content = [];

        for ($i = $current + 1, $count = count($lines); $i < $count; $i++) {
            if (rtrim($line = $lines[$i]) !== $fence) {
                $content[] = strstr($line, "\t") ? str_replace("\t", '    ', $line) : $line;
            } else {
                break;
            }
        }

        $block = [
            'code',
            'content' => implode("\n", $content),
        ];

        if (!empty($language)) {
            $block['language'] = trim($language);
        }

        return [$block, $i];
    }



    protected function renderCode($block)
    {
        $language = isset($block['language']) ? $block['language'] : null;

        if ($language === 'html' || $language === 'xml') {
            $language = 'markup';
        }

        $class = $language !== null ? ' class="language-' . $language . '"' : '';

        return "<pre prism><code$class>" . htmlspecialchars($block['content'] . "\n", ENT_NOQUOTES | ENT_SUBSTITUTE, 'UTF-8') . "</code></pre>\n";
    }
}
