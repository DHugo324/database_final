<?php
	include_once("db/condb.php");
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>最新公告</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="main" style="margin-left: 8px; margin-right: 8px;">
    <h2 class="sub-header">最新公告</h2>
    <?php

        // 目标网页的URL
        $url = 'https://cse.ntou.edu.tw/?Lang=zh-tw';

        // 创建DOMDocument对象
        $dom = new DOMDocument;

        // 使用file_get_contents获取HTML内容
        $html = file_get_contents($url);

        // 忽略HTML中的错误
        libxml_use_internal_errors(true);

        // 加载HTML内容到DOMDocument
        $dom->loadHTML($html);

        // 恢复错误处理
        libxml_clear_errors();

        // 创建DOMXPath对象
        $xpath = new DOMXPath($dom);

        // 使用XPath查询目标元素
        $elements = $xpath->query('//div[@class="d-item d-title col-sm-12"]/div[@class="mbox"]/div[@class="d-txt"]/div[@class="mtitle"]');

        // 开始表格
        echo '<table class="table table-striped" id="table-responsive-01">';
        echo '<thead>';
        echo '<tr>';
        echo '<th colspan="2" style="text-align:center;font-size:20px;width:25%">時間</th>';
        echo '<th style="text-align:center;font-size:20px;width:70%">事由</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // 遍历查询到的元素
        $count = 0;
        foreach ($elements as $element) {
            // 获取超链接
            $link = $element->getElementsByTagName('a')->item(0)->getAttribute('href');
            
            // 获取标题
            $title = $element->getElementsByTagName('a')->item(0)->getAttribute('title');
            
            // 获取日期
            $date = $element->getElementsByTagName('i')->item(0)->nodeValue;

            // 输出表格的每一行
            echo '<tr>';
            echo '<td style="text-align:left;vertical-align:middle"><span class="label label-danger">NEW</span></td>';
            echo '<td class="bulletin-date">' . $date . '</td>';
            echo '<td style="text-align:center;vertical-align:middle;"><a target="_blank" href="'. $link .'">' . $title . '</td>';
            echo '</tr>';

            // 增加计数器
            $count++;

            // 如果已经抓取了五个，退出循环
            if ($count === 5) {
                break;
            }
        }

        // 结束表格
        echo '</tbody>';
        echo '</table>';

    ?>
    </div>
</body>
</html>