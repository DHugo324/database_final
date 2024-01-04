<?php
	include_once("db/condb.php");
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS_hub</title>
    <style>
        body {
            margin: 0px;
        }
        
        .content {
            position: relative;
            word-wrap: break-word;
            width: 100%;
            height: 100%;
        }
        
        li img {
            width: 100%;
            height: 100%;
        }
    </style>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.bxslider.min.js"></script>
    <link href="css/jquery.bxslider.min.css" rel="stylesheet" />
    <script>
        $(document).ready(function(){
            slider = $('.bxslider').bxSlider(
                {
                    pagerCustom: '#bx-pager'
                }
            );
            slider.startAuto();
        });
    </script>
</head>
<body>
    <div class="content">
        <div>
            <ul class="bxslider">
                <li><img src="image/1.jpg"></li>
                <li><img src="image/2.jpg"></li>
                <li><img src="image/3.jpg"></li>
                <li><img src="image/4.jpg"></li>
                <li><img src="image/5.jpg"></li>
            </ul>
        </div>
    </div>
</body>
</html>