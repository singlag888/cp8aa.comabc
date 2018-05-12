<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta charset="utf-8" />
<title><?php echo ($seoInfo['seo_title']); ?></title>
<meta name="description" content="<?php echo ($seoInfo['seo_description']); ?>">
<meta name="keywords" content="<?php echo ($seoInfo['seo_keywords']); ?>">
<link rel="icon" href="/Public/Home/images/favicon.ico" />
<link rel="stylesheet" href="/Public/Home/css/reset.css" />
<link rel="stylesheet" href="/Public/Home/css/style.css" />
<link rel="stylesheet" href="/Public/Home/css/navStyle.css" />
<link rel="stylesheet" href="/Public/Home/css/lists.css" />
<script type="text/javascript" src="/Public/Home/js/jquery.min.js"></script>
</head>
<body>
<div class="docHead">
    <div class="logo">
        <a href="/"><img src="/Public/Home/images/logo.png" alt="logo" /></a>
    </div>
</div>
<nav class="doc_nav_box">
    <div class="doc_nav">
        <a href="/" <?php if(empty($_GET['catpinyin'])) echo 'class="hover"'; ?> >首页</a>
        <?php if(is_array($categorys)): foreach($categorys as $key=>$item): ?><a href="/<?php echo ($item["url"]); ?>/" <?php if($item['url'] == $_GET['catpinyin']) echo 'class="hover"'; ?>><?php echo ($item["catname"]); ?></a><?php endforeach; endif; ?>
    </div>
</nav>
<div style="margin-top: 10px;"></div>

<!--
<notemp0ty name="daoHangList">
    <div class="l_nav" style="width: 967px;margin: 5px auto;">
        <div class="tab clearfix">
            <h6>导航链接</h6>
        </div>
        <?php if(is_array($daoHangList)): foreach($daoHangList as $key=>$item): ?><p class="nav_p" style="width: 165px;">

                <a href="<?php echo ($item["url"]); ?>" target="_blank"  rel="nofollow">
                    <span class="red"><?php echo ($item["title"]); ?></span>
                </a>
            </p><?php endforeach; endif; ?>
        </p>
    </div>
</notemp0ty>
<?php if(!empty($beiYongDaoHangList)): ?><div class="l_nav" style="width: 967px;margin: 5px auto;">
        <div class="tab clearfix">
            <h6>备用导航网址</h6>
        </div>
        <?php if(is_array($beiYongDaoHangList)): foreach($beiYongDaoHangList as $key=>$item): ?><p class="nav_p" style="width: 165px;">
                <a href="<?php echo ($item["url"]); ?>" target="_blank"  rel="nofollow">
                    <span class="red"><?php echo ($item["title"]); ?></span>
                </a>
            </p><?php endforeach; endif; ?>
        </p>
    </div><?php endif; ?>

-->


    <section class="dangqian_wz">
        <span>当前位置：
            <a href="/">首页</a>
            &gt; <a href="/<?php echo ($categoryInfo['url']); ?>/"><?php echo ($categoryInfo['catname']); ?></a>
            &gt; <a id="urlmbx" href="/<?php echo ($categoryInfo['url']); ?>/<?php echo ($typeInfo['pinyin']); ?>/"><?php echo ($typeInfo['title']); ?></a>
        </span>
    </section>
    <section class="lottery_comtent info_comtent clearfix">
        <aside class="info_comtent_left">
            <div class="info_comtent_li">
                <?php if(is_array($list)): foreach($list as $key=>$item): ?><li>
                        <i></i>
                        <a href="/<?php echo ($categoryInfo['url']); ?>/<?php echo ($typeInfo['pinyin']); ?>/<?php echo ($item["id"]); ?>.html" title="<?php echo ($item["title"]); ?>"><?php echo (_substr($item["title"],25,'...')); ?></a>
                        <time><?php echo (date("Y-m-d",$item["inputtime"])); ?></time>
                    </li><?php endforeach; endif; ?>
            </div>
            <div class="digg">
                <?php echo ($page); ?>
            </div>
        </aside>
        <aside class="lottery_comtent_right">
            <?php if(is_array($typeData)): foreach($typeData as $key=>$dataItem): if(!empty($dataItem["data"])): ?><div class="lottcom_list">
                    <div class="lottcom_darw_title">
                        <h2><?php echo ($dataItem["title"]); ?></h2>
                        <a href="/<?php echo ($categoryInfo['url']); ?>/<?php echo ($dataItem['pinyin']); ?>/">更多&gt;&gt;</a>
                    </div>
                    <ul>
                        <?php if(is_array($dataItem["data"])): foreach($dataItem["data"] as $key=>$item): ?><li>
                                <i></i>
                                <a href="/<?php echo ($categoryInfo['url']); ?>/<?php echo ($dataItem['pinyin']); ?>/<?php echo ($item["id"]); ?>.html" title="<?php echo ($item["title"]); ?>"><?php echo (_substr($item["title"],25,'...')); ?></a>
                                <time><?php echo (date("Y-m-d",$item["inputtime"])); ?></time>
                            </li><?php endforeach; endif; ?>
                    </ul>
                </div><?php endif; endforeach; endif; ?>
        </aside>
    </section>


<div class="footer" style="border: none;">
    <?php if(!empty($linkList)): ?><div id="nav" class="l_nav" style="margin-top: 10px;">
            <div class="tab clearfix">
                <h6>友情链接</h6>
            </div>
            <?php if(is_array($linkList)): foreach($linkList as $key=>$item): ?><p class="nav_p">
                    <a href="<?php echo ($item["url"]); ?>" target="_blank">
                        <span class="red"><?php echo ($item["title"]); ?></span>
                    </a>
                </p><?php endforeach; endif; ?>
            </p>
        </div><?php endif; ?>
<div style="display:none">
<script src="https://s11.cnzz.com/z_stat.php?id=3956453&web_id=3956453" language="JavaScript"></script>
</div>
    <div class="copyright"> 
        <p><span>2018 &copy;彩票吧www.cp8aa.com 彩票开奖网 </span><span style="color:#f13131;">温馨提醒：购买彩票有风险，在线投注须谨慎 </span> 不向未满18周岁的青少年出售彩票</p>
    </div>

</div>
<script type="text/javascript">
    <?php if(!empty($resultArray)): if(is_array($resultArray)): foreach($resultArray as $key=>$resultInfo): ?>var intDiff<?php echo ($resultInfo['categoryInfo']['url']); ?> = parseInt(<?php echo ($resultInfo['other']['remainTime']); ?>);//倒计时总秒数量
    var remainTime<?php echo ($resultInfo['categoryInfo']['url']); ?> = parseInt(<?php echo ($resultInfo['remainTime']); ?>);
    function timer<?php echo ($resultInfo['categoryInfo']['url']); ?>(intDiff<?php echo ($resultInfo['categoryInfo']['url']); ?>){
        var interval<?php echo ($resultInfo['categoryInfo']['url']); ?> = window.setInterval(function(){
            var day<?php echo ($resultInfo['categoryInfo']['url']); ?>=0,
                    hour<?php echo ($resultInfo['categoryInfo']['url']); ?>=0,
                    minute<?php echo ($resultInfo['categoryInfo']['url']); ?>=0,
                    second<?php echo ($resultInfo['categoryInfo']['url']); ?>=0;//时间默认值
            if(intDiff<?php echo ($resultInfo['categoryInfo']['url']); ?> > 0){
                day<?php echo ($resultInfo['categoryInfo']['url']); ?> = Math.floor(intDiff<?php echo ($resultInfo['categoryInfo']['url']); ?> / (60 * 60 * 24));
                hour<?php echo ($resultInfo['categoryInfo']['url']); ?> = Math.floor(intDiff<?php echo ($resultInfo['categoryInfo']['url']); ?> / (60 * 60)) - (day<?php echo ($resultInfo['categoryInfo']['url']); ?> * 24);
                minute<?php echo ($resultInfo['categoryInfo']['url']); ?> = Math.floor(intDiff<?php echo ($resultInfo['categoryInfo']['url']); ?> / 60) - (day<?php echo ($resultInfo['categoryInfo']['url']); ?> * 24 * 60) - (hour<?php echo ($resultInfo['categoryInfo']['url']); ?> * 60);
                second<?php echo ($resultInfo['categoryInfo']['url']); ?> = Math.floor(intDiff<?php echo ($resultInfo['categoryInfo']['url']); ?>) - (day<?php echo ($resultInfo['categoryInfo']['url']); ?> * 24 * 60 * 60) - (hour<?php echo ($resultInfo['categoryInfo']['url']); ?> * 60 * 60) - (minute<?php echo ($resultInfo['categoryInfo']['url']); ?> * 60);
            }
            if (minute<?php echo ($resultInfo['categoryInfo']['url']); ?> <= 9) minute<?php echo ($resultInfo['categoryInfo']['url']); ?> = '0' + minute<?php echo ($resultInfo['categoryInfo']['url']); ?>;
            if (second<?php echo ($resultInfo['categoryInfo']['url']); ?> <= 9) second<?php echo ($resultInfo['categoryInfo']['url']); ?> = '0' + second<?php echo ($resultInfo['categoryInfo']['url']); ?>;
            $(".djs<?php echo ($resultInfo['categoryInfo']['url']); ?>").empty();
            $(".djs<?php echo ($resultInfo['categoryInfo']['url']); ?>").html("<span style='color: #ff0000'>"+minute<?php echo ($resultInfo['categoryInfo']['url']); ?>+"</span><em>分</em><span style='color: #ff0000'>"+second<?php echo ($resultInfo['categoryInfo']['url']); ?>+"</span><em>秒</em>");
            intDiff<?php echo ($resultInfo['categoryInfo']['url']); ?>--;
            if(0 == intDiff<?php echo ($resultInfo['categoryInfo']['url']); ?>){
                setTimeout(function(){
                    $.ajax({
                        'url' : "<?php echo U('Ajax/result');?>",
                        'type' : 'POST',
                        'data' : {
                            'id' : <?php echo ($resultInfo['categoryInfo']['catid']); ?>
                        },
                        success : function(data){
                            //$(".<?php echo ($resultInfo['categoryInfo']['url']); ?>").empty();
                            $(".<?php echo ($resultInfo['categoryInfo']['url']); ?>").html(data);
                            window.clearInterval(interval<?php echo ($resultInfo['categoryInfo']['url']); ?>);
                            timer<?php echo ($resultInfo['categoryInfo']['url']); ?>(remainTime<?php echo ($resultInfo['categoryInfo']['url']); ?>);
                        }
                    });
                    return false;
                }, 2000);
            }
        }, 1000);
    }
    $(function(){
        timer<?php echo ($resultInfo['categoryInfo']['url']); ?>(intDiff<?php echo ($resultInfo['categoryInfo']['url']); ?>);
    });<?php endforeach; endif; endif; ?>
</script>

</body>
</html>