<?php

namespace Spider;
use Sunra\PhpSimple\HtmlDomParser;

class HTMLParser
{
    protected $dom;
    public function setParserContent($html,$type='string')
    {
        switch ($type){
            case 'string':
                $this->dom = HtmlDomParser::str_get_html($html);
                break;
            case 'file':
                $this->dom = HtmlDomParser::file_get_html($html);
                break;
        }
        return $this;
    }
    public function findNode($rules)
    {
        return $this->dom->find($rules);
    }
}