<?php
    //载入composer类
    require('vendor/autoload.php');
    //类加载函数
    function autoload($class){
        require __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    }
    spl_autoload_register('autoload');
    $start = time();
    $count =1;
    $url = "http://www.afwing.com";
    $download = new Spider\Downloader();
    $urlmanager = new Spider\UrlManager();
    $htmlpaser = new Spider\HTMLParser();
    $urlmanager->setUnCrawlUrl($url);
    $download->setUrl($url)->execute();
    while ($urlmanager->getUnCrawlUrlCount()!=0){
        $count+=1;
        $url = $urlmanager->getUnCrawlUrl();
        $download->setUrl($url)->execute();
        if($download->getCode()==200){
            echo 'Crawling'.$url;
            echo "\n";
            $urlmanager->setCrawledUrl($url);
            $node = $htmlpaser->setParserContent($download->getContent(),'string')->findNode('a');
            $length = count($node);
            for($i=0;$i<$length;$i++){
                if(preg_match('/(\w+\.)+[\w\/\.\-]*html/', $node[$i]->href))
                {
                    if(!$urlmanager->isCrawled($node[$i]->href)){
                        $urlmanager->setUnCrawlUrl($url.$node[$i]->href);
                    }
                }
            }
        }else{
            $urlmanager->setCrawlFailedUrl($url);
        }
    }
    echo "Use".time()-$start.'s';
    echo "Crawled:".$count.'Page';
    print_r($urlmanager->getCrawledUrls());
?>
