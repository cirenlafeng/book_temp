<?php
set_time_limit(3600);
header("Content-Type:text/html;charset=utf-8");
error_reporting(E_ALL ^ E_NOTICE);
require('phpQuery/phpQuery.php');
$urls = json_decode(file_get_contents('json_data.php'),true);
$titleList = [];
foreach ($urls as $key => $value) {
    $html = @file_get_contents($value);
    phpQuery::newDocumentHTML($html);
    $title = pq('div.title:eq(0) > h2')->text();
    if(strlen($title) > 1)
    {
        $titleList[] = $title;
        echo $title.PHP_EOL;
    }else{
        echo "书名获取失败：".$value.PHP_EOL;
    }
    phpQuery::unloadDocuments();
}
file_put_contents('book_data.php', json_encode($titleList));
echo "completed ..".PHP_EOL;