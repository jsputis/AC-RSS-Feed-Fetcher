<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="banner">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaewTamDmze2SRqUVk1Lrijdi4m99siK7ZCx_QHz_F81Uj1UJm-niqAAOUJ7CntkcIbw&usqp=CAU" alt="" width="450px">
    <div ><center><h1>Requirements in IPTECH 2</h1><h2>RSS FEEDS Fetcher</h2></center></div>
    <img src="https://ccse.io/wp-content/uploads/2019/03/CCSE-1024x205.jpg" alt="" width="450px">
    </div>
    <form method='post'action=''>
        <input type="text" name="feedurl" placeholder="Enter website feed URL"> &nbsp;
        <input name="submit" type="submit" value="Submit">
    </form>    

    <?php
    $url = "https://www.asiancollege.edu.ph/feed/";
    if(isset($_POST['submit'])){
        if($_POST['feedurl'] != ''){
            $url = $_POST['feedurl'];
        }
    }

    $invalidUrl = false;
    if(@simplexml_load_file($url)){
        $feeds = simplexml_load_file($url);
    }else{
        $invalidUrl = true;
        echo "<h2>Invalid RSS feed URL.</h2>";
    }

    $i = 0;
    if(!empty($feeds)){
        $site = $feeds -> channel -> title;
        $sitelink = $feeds ->channel -> link;
        echo "<h1>". $site . "</h1>";
        foreach($feeds -> channel->item as $item){
            $title = $item -> title;
            $link = $item -> link;
            $description  = $item -> description;
            $postDate = $item -> pubDate;
            $pubDate = date('D, d M Y', strtotime($postDate));
            
            if($i >= 5){
                break;
            }
            ?>

            
            
            <div class = 'post'>
                <div class='post-head'>
                    <h2> <a class = "feed_title" href="<?=$link?>"> <?=$title ?> </a> </h2>
                    <span><?=$pubDate ?> </span>

                </div>
                <div class='post-content'>
                    <?= implode(" ",array_slice(explode(' ',$description), 0,20))?>
                    
                </div>

            </div>

            <?php
            $i++;



        }
    }else{
        if(!$invalidUrl){
            echo "<h2>No item found.</h2>";
        }
    }
    
    ?>

</body>
</html>