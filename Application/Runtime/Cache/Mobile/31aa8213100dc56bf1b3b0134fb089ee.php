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

    <!--<div class="lott_nav">-->
        <!--<span>热彩:</span>-->
        <!--<a href="/ssq/">双色球</a>-->
        <!--<a href="/fc3d/">3D</a>-->
        <!--<a href="/dlt/">大乐透</a>-->
        <!--<a href="/qxc/">七星彩</a>-->
        <!--<a href="/qlc/">七乐彩</a>-->
        <!--<a href="/ssq/">双色球</a>-->
        <!--<a href="/fc3d/">3D</a>-->
        <!--<a href="/dlt/">大乐透</a>-->
        <!--<a href="/qxc/">七星彩</a>-->
        <!--<a href="/qlc/">七乐彩</a>-->
    <!--</div>-->
    <div class="lottery-text">
        <div class="lottery-text-center">
            <div class="infos_list_title">
                <a href="/<?php echo ($categoryInfo['url']); ?>/">历史开奖</a>
                <a href="/<?php echo ($categoryInfo['url']); ?>/zjxw/" <?php if(($typeInfo["pinyin"]) == "zjxw"): ?>class="active"<?php endif; ?> >中奖新闻</a>
                <a href="/<?php echo ($categoryInfo['url']); ?>/zjyc/" <?php if(($typeInfo["pinyin"]) == "zjyc"): ?>class="active"<?php endif; ?> >专家预测</a>
                <a href="/<?php echo ($categoryInfo['url']); ?>/tzjq/" <?php if(($typeInfo["pinyin"]) == "tzjq"): ?>class="active"<?php endif; ?> >投注技巧</a>
            </div>
            <h5><?php echo ($Detail["title"]); ?></h5>
            <span><?php echo (date("Y-m-d H:i:s",$Detail["inputtime"])); ?> 来源：网络</span>
            <div class="article_text_con">
                <?php echo ($Detail["content"]); ?>
            </div>
        </div>
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