<?php

namespace Spider;

class Downloader {
    protected $ch;
    protected $code;
    protected $content;
    public function __construct()
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($this->ch, CURLOPT_HEADER,0);
    }

    /**
     * @param $url
     * 设置入口链接
     * @return $this
     */
    public function setUrl($url)
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        return $this;
    }

    /**
     * @param $proxy
     * 设置代理信息
     * @return $this
     */
    public function setProxy($proxy)
    {
        curl_setopt ($this->ch, CURLOPT_PROXY, $proxy);
        return $this;
    }
    /**
     * @param $userAgent
     * set User-Agent
     * @return $this
     */
    public function setUserAgent($userAgent)
    {
        curl_setopt ($this->ch, CURLOPT_USERAGENT, $userAgent);
        return $this;
    }

    public function execute()
    {   $this->content = curl_exec($this->ch);
        $this->code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        return $this;
    }
    public function getCode():int
    {
        return $this->code ?? 0;
    }
    public function getContent():string
    {
        return $this->content ?? "";
    }
    public function setHeader($headers)
    {
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
    }
    public function __destruct()
    {
        curl_close($this->ch);
        // TODO: Implement __destruct() method.
    }
}
