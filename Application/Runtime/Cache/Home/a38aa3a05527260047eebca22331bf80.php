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


    <section class="lottery-card">
    <div class="img">
        <span><img src="<?php echo ($resultInfo['categoryInfo']['image']); ?>" alt="<?php echo ($resultInfo['categoryInfo']['catname']); ?>" style="width:80px;height:80px;"></span>
        <p><?php echo ($resultInfo['categoryInfo']['catname']); ?></p>
        <a href="/<?php echo ($resultInfo['categoryInfo']['url']); ?>/">历史开奖</a>
    </div>
    <div class="<?php echo ($resultInfo['categoryInfo']['url']); ?>">
        <input type="hidden" class="<?php echo ($resultInfo['categoryInfo']['url']); ?>nextExpect" value="<?php echo ($resultInfo['timeInfo']['expect']); ?>">
        <div class="txt">
            <p><img src="/Public/Home/images/star.png" class="star">第<span style="color: red;font-weight: bold;"><?php echo ($resultInfo['resultInfo']['expect']); ?></span>期开奖号码</p>
            <div class="cai-num pk10-num">
                <?php foreach(explode(',', $resultInfo['resultInfo']['opencode']) as $value){ ?>
                <span class="n<?php echo ($value); ?>" data-num="<?php echo ($value); ?>"><?php echo ($value); ?></span>
                <?php } ?>
            </div>
            <div class="clearfix">
                <a href="/<?php echo ($resultInfo['categoryInfo']['url']); ?>/">历史开奖</a>
                <?php if(is_array($types)): foreach($types as $key=>$typeItem): ?><a href="/<?php echo ($resultInfo['categoryInfo']['url']); ?>/<?php echo ($typeItem["pinyin"]); ?>"><?php echo ($typeItem["title"]); ?></a><?php endforeach; endif; ?>
            </div>
        </div>
        <div class="rule clearfix">
            <div class="open-time">
                <p>距下一期开奖时间<br>还剩：</p>
                <div class="djs">
                    <span><?php echo ($resultInfo['other']['min']); ?></span><em>分</em><span><?php echo ($resultInfo['other']['sec']); ?></span><em>秒</em>
                </div>
                <p>已开<span class="open"><?php echo ($resultInfo['other']['resultCount']); ?></span>期，还有<span class="left"><?php echo $resultInfo['other']['timeCount']-$resultInfo['other']['resultCount']; ?></span>期</p>
            </div>
            <div class="open-video">
                <img src="<?php echo ($resultInfo['categoryInfo']['zhiboimage']); ?>" alt="<?php echo ($resultInfo['categoryInfo']['catname']); ?>开奖直播" width="110" height="110">
                <span>开奖直播</span>
                <a href="/<?php echo ($resultInfo['categoryInfo']['url']); ?>/kjzb/" class="play">
                    <img src="/Public/Home/images/play.png" alt="播放">
                </a>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var intDiff = parseInt(<?php echo ($resultInfo['other']['remainTime']); ?>);//倒计时总秒数量
    var remainTime = <?php echo ($resultInfo['remainTime']); ?>;
    function timer(intDiff){
        var interval = window.setInterval(function(){
            var minute=0,
                    second=0;//时间默认值
            if(intDiff > 0){
                minute = Math.floor(intDiff / 60);
                second = Math.floor(intDiff) - (minute * 60);
            }
            if (minute <= 9) minute = '0' + minute;
            if (second <= 9) second = '0' + second;
            $(".djs").empty();
            $(".djs").html("<span>"+minute+"</span><em>分</em><span>"+second+"</span><em>秒</em>");
            intDiff--;
            if(0 == intDiff){
                var <?php echo ($resultInfo['categoryInfo']['url']); ?>nextExpect = $(".<?php echo ($resultInfo['categoryInfo']['url']); ?>nextExpect").val();
                resultTime(<?php echo ($resultInfo['categoryInfo']['url']); ?>nextExpect);
                window.clearInterval(interval);
            }
        }, 1000);
    }

    function resultTime(<?php echo ($resultInfo['categoryInfo']['url']); ?>nextExpect){
        var resultTimeInterval = window.setTimeout(function(){
            $.ajax({
                'url' : "<?php echo U('Ajax/resultInfo');?>",
                'type' : 'POST',
                'dataType': "json",
                'data' : {
                    'id' : <?php echo ($resultInfo['categoryInfo']['catid']); ?>,
                    'next' : <?php echo ($resultInfo['categoryInfo']['url']); ?>nextExpect
                },
                success : function(data){
                    if(1 == data.msgCode){
                        $(".l_txt").empty();
                        $(".l_txt").html(data.html);
                        window.clearInterval(resultTimeInterval);
                        timer(data.remainTime);
                    }else{
                        $('.djs').empty();
                        $('.djs').html("<p style='height: 50px;text-align: center;font-size: 24px;font-weight: 700;color: #fff;background: #e73f3f;border-radius: 3px;'>开奖中...</p>");
                        resultTime(<?php echo ($resultInfo['categoryInfo']['url']); ?>nextExpect);
                    }
                }
            });
            return false;
        }, 2000);
    }
    $(function(){
        timer(intDiff);
    });
</script>

    <section class="table h45 history-table" data-type="pk10">
        <table cellpadding="0" cellspacing="0" width="100%" id="table-pk10">
            <tbody>
            <tr>
                <th width="20%">更新时间</th>
                <th width="20%">期号</th>
                <th class="tab-a" width="40%">
                    <a href="javascript:;" class="active">显示号码</a>
                </th>
                <th width="20%">开奖时间</th>
            </tr>
            <?php if(is_array($resultList)): foreach($resultList as $key=>$item): ?><tr class="tr" id="tr-<?php echo ($item['expect']); ?>">
                    <td class="time">
                        <span><?php echo (date("H:i:s",$item["ctime"])); ?></span>
                    </td>
                    <td>
                        <?php echo ($item["expect"]); ?>
                    </td>
                    <td class="td-num td-pk10">
                        <div class="td-box cai-num size-32 center pk10-num" style="display: block;">
                            <?php foreach(explode(',', $item['opencode']) as $value){ ?>
                            <span class="n<?php echo ($value); ?>" data-num="<?php echo ($value); ?>"><?php echo ($value); ?></span>
                            <?php } ?>
                        </div>

                    </td>
                    <td>
                        <?php echo (date("Y-m-d H:i:s",$item["opentimestamp"])); ?>
                    </td>
                </tr><?php endforeach; endif; ?>

            </tbody>
        </table>
    </section>

    <section class="lottery_list_info clearfix">
        <?php if(is_array($typeData)): foreach($typeData as $key=>$dataItem): if(!empty($dataItem["data"])): ?><div class="list_info_li">
                    <div class="list_info_li_title">
                        <h2><?php echo ($dataItem["title"]); ?></h2>
                        <a href="/<?php echo ($categoryInfo['url']); ?>/<?php echo ($dataItem['pinyin']); ?>/">更多&gt;&gt;</a>
                    </div>
                    <ul>
                        <?php if(is_array($dataItem["data"])): foreach($dataItem["data"] as $key=>$item): ?><li>
                                <i></i>
                                <a href="/<?php echo ($categoryInfo['url']); ?>/<?php echo ($dataItem['pinyin']); ?>/<?php echo ($item["id"]); ?>.html"
                                   title="<?php echo ($item["title"]); ?>"><?php echo (_substr($item["title"],25,'...')); ?></a>
                                <time><?php echo (date("Y-m-d",$item["inputtime"])); ?></time>
                            </li><?php endforeach; endif; ?>
                    </ul>
                </div><?php endif; endforeach; endif; ?>
    </section>
    <script type="text/javascript" src="/Public/Home/js/jquery.min.js"></script>
    <script type="text/javascript">
        var intDiff = parseInt(<?php echo ($resultInfo['other']['remainTime']); ?>);//倒计时总秒数量
        function timer(intDiff) {

            window.setInterval(function () {
                var day = 0,
                    hour = 0,
                    minute = 0,
                    second = 0;//时间默认值
                if (intDiff > 0) {
                    day = Math.floor(intDiff / (60 * 60 * 24));
                    hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
                    minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
                    second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
                }
                if (minute <= 9) minute = '0' + minute;
                if (second <= 9) second = '0' + second;
                $('.djs').html("<span>" + minute + "</span><em>分</em><span>" + second + "</span><em>秒</em>");
                intDiff--;
                if (0 == intDiff) {
                    setTimeout(function () {
                        window.location.reload();
                        return false;
                    }, 2000);

                }
            }, 1000);
        }

        $(function () {
            timer(intDiff);
        });
    </script>


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