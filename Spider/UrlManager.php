<?php

namespace Spider;

class UrlManager
{
    private $crawledUrl;
    private $unCrawlUrl;
    private $crawlFailedUrl;
    public function __construct()
    {
        $this->crawledUrl = [];
        $this->crawlFaildUrl = [];
        $this->unCrawlUrl = new \SplQueue();
    }

    /**
     * @param $url
     * 设置待抓取URL
     */
    public function setUnCrawlUrl(string $url)
    {
        $this->unCrawlUrl->push($url);
    }

    /**
     * 返回所有待抓取url
     * @return \SplQueue
     */
    public function getUnCrawlUrls():\SplQueue
    {
        return $this->unCrawlUrl;
    }

    /**
     * 返回一条待抓取URL
     * @return mixed
     */
    public function getUnCrawlUrl():string
    {
        return $this->unCrawlUrl->pop();
    }

    /**
     * 返回待抓取URL条数
     * @return int
     */
    public function getUnCrawlUrlCount():int
    {
        return $this->unCrawlUrl->count();
    }

    /**
     * 设置已抓取URL
     * @param $url
     */
    public function setCrawledUrl(string $url)
    {
        array_push($this->crawledUrl,$url);
    }

    /**
     * 返回所有已抓取URL
     * @return \SplQueue
     */
    public function getCrawledUrls()
    {
        return $this->crawledUrl;
    }

    public function isCrawled($url)
    {
        if (in_array($url,$this->crawledUrl)){
            return true;
        }
        return false;
    }

    /**
     * 返回已抓取URL条数
     * @return int
     */
    public function getCrawledUrlCount():int
    {
        return count($this->crawledUrl);
    }
    /**
     * @param $url
     */
    public function setCrawlFailedUrl(string $url)
    {
        array_push($this->crawlFaildUrl,$url);
    }

    /**
     * @return mixed
     */
    public function getCrawlFailedUrls()
    {
        return $this->crawlFailedUrl;
    }

    /**
     * @return mixed
     */
    public function getCrawlFailedUrlCount():int
    {
        return count($this->crawlFailedUrl);
    }
}