<?php
/**
 * Created by PhpStorm.
 * User: liuxiaoyang
 * Date: 15/11/29
 * Time: 下午9:38
 */

namespace App\Markdown;


class Markdown
{
    protected $parser;

    public function __construct(Parser $parser){
        $this->parser = $parser;
    }

    public function markdown($text){

        $html = $this->parser->makeHtml($text);

        return $html;
    }
}