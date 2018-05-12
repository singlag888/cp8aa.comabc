<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!DOCTYPE html>
<html style="font-size: 102.4px;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo ($seoInfo['seo_title']); ?></title>
    <meta content="<?php echo ($seoInfo['seo_description']); ?>" name="description">
    <meta content="<?php echo ($seoInfo['seo_keywords']); ?>" name="keywords">
    <link rel="icon" href="/Public/Mobile/images/favicon.png">
    <link rel="stylesheet" type="text/css" href="/Public/Mobile/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/Public/Mobile/css/style.css?s=126">
    <script type="text/javascript" src="/Public/Mobile/js/jquery.min.js"></script>
</head>
</head>
<body>
<body>
<header class="gd_header">
    <div class="logo">
        <a href="/">
            <img src="/Public/Mobile/images/logo.jpg">
        </a>
    </div>
</header>
<?php if(!empty($daoHangList)): ?><div class="gd_infos" style="margin-bottom:1erm;">
    <div class="gd_infos_title">
		<h1>导航链接</h1>
    </div>
	<div class="gd_infos_li">
		<ul class="m_ul">
		<?php if(is_array($daoHangList)): foreach($daoHangList as $key=>$item): ?><li>
			<a href="<?php echo ($item["url"]); ?>" target="_blank"  rel="nofollow">
                <span class="red"><?php echo ($item["title"]); ?></span>
            </a> 
		</li><?php endforeach; endif; ?>
		</ul>
	</div>
</div>
<p style="display:block;clear:both;"></p><?php endif; ?>
<?php if(!empty($beiYongDaoHangList)): ?><div class="gd_infos" style="margin-bottom:1erm;">
    <div class="gd_infos_title">
		<h1>备用导航链接</h1>
    </div>
	<div class="gd_infos_li">
		<ul class="m_ul">
		<?php if(is_array($beiYongDaoHangList)): foreach($beiYongDaoHangList as $key=>$item): ?><li>
			<a href="<?php echo ($item["url"]); ?>" target="_blank"  rel="nofollow">
                <span class="red"><?php echo ($item["title"]); ?></span>
            </a> 
		</li><?php endforeach; endif; ?>
		</ul>
	</div>
</div>
<p style="display:block;clear:both;"></p><?php endif; ?>

    <div class="lott_draw l_txt">
    <div style="width: 60%;float: left;">
	<input type="hidden" class="<?php echo ($resultInfo['categoryInfo']['url']); ?>nextExpect" value="<?php echo ($resultInfo['timeInfo']['expect']); ?>">
        <div class="lott_draw_1l">
            <span><?php echo ($resultInfo['categoryInfo']['catname']); ?></span>
            <span><?php echo ($resultInfo['resultInfo']['expect']); ?>期</span>
        </div>
        <div class="lott_draw_sphere">
            <?php foreach(explode(',', $resultInfo['resultInfo']['opencode']) as $value){ ?>
            <li><?php echo ($value); ?></li>
            <?php } ?>
        </div>
    </div>
    <div style="width: 40%;float: right;">
        <div class="lott_draw_1l">
            <span>距下一期开奖时间</span>
            <div class="djs djsbjsc" style="height: 1.25rem;margin: 0.7rem 0 0 0.75rem;">
                <span><?php echo ($resultInfo['other']['min']); ?></span><em>分</em><span><?php echo ($resultInfo['other']['sec']); ?></span><em>秒</em>
            </div>
        </div>

    </div>
</div>
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
                        $('.djs').html("<p style='height: 1.25rem;line-height:1.25rem;text-align: center;font-size: 24px;font-weight: 700;color: #fff;background: #e73f3f;border-radius: 3px;'>开奖中...</p>");
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
    <div class="draw_table">
        <div class="draw_table_title">
            <a href="/<?php echo ($categoryInfo['url']); ?>/">历史开奖</a>
            <a href="/<?php echo ($categoryInfo['url']); ?>/zjxw/" <?php if(($typeInfo["pinyin"]) == "zjxw"): ?>class="active"<?php endif; ?> >中奖新闻</a>
            <a href="/<?php echo ($categoryInfo['url']); ?>/zjyc/" <?php if(($typeInfo["pinyin"]) == "zjyc"): ?>class="active"<?php endif; ?> >专家预测</a>
            <a href="/<?php echo ($categoryInfo['url']); ?>/tzjq/" <?php if(($typeInfo["pinyin"]) == "tzjq"): ?>class="active"<?php endif; ?> >投注技巧</a>
        </div>
    </div>
    <div class="lott_history">
        <?php if(is_array($resultList)): foreach($resultList as $key=>$item): ?><a> <span>第<?php echo ($item["expect"]); ?>期</span> <strong><?php echo (date("H:i:s",$item["opentimestamp"])); ?></strong>
                <div class="history-ball">

                    <ul>
                        <?php foreach(explode(',', $item['opencode']) as $value){ ?>
                        <li class="history-red"><?php echo ($value); ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <s></s>
            </a><?php endforeach; endif; ?>
    </div>


<?php if(!empty($linkList)): ?><div class="gd_infos" style="margin-bottom:1erm;">
    <div class="gd_infos_title">
		<h1>友情链接</h1>
    </div>
	<div class="gd_infos_li">
		<ul class="m_ul">
		<?php if(is_array($linkList)): foreach($linkList as $key=>$item): ?><li>
			<a href="<?php echo ($item["url"]); ?>" target="_blank"  rel="nofollow">
                <span class="red"><?php echo ($item["title"]); ?></span>
            </a> 
		</li><?php endforeach; endif; ?>
		</ul>
	</div>
</div>
<p style="display:block;clear:both;"></p><?php endif; ?>
<footer class="gd_footer">
    <span>2018 @KJ2彩票开奖网 www.KJ2.com</span>
</footer>
<div style="display:none">
<script type="text/javascript" src="//pdc.bqwgxj.com/Json/public.js" charset="utf-8"></script>


<script type="text/javascript" src="//js.users.51.la/19457681.js"></script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?cd261799ede058867be9ae4cf46e058b";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

</div>

<script type="text/javascript">
    document.getElementsByTagName('html')[0].style.fontSize = document.documentElement.clientWidth / 18.75 + 'px';
    document.documentElement.style.fontSize = window.innerWidth / 18.75 + "px";
</script>

</body>
</html>

</body>
</html>