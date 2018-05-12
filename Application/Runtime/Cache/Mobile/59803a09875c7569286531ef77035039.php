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

    <div class="newest_prize">
        <?php if(is_array($resultArray)): foreach($resultArray as $key=>$resultInfo): ?><a href="/<?php echo ($resultInfo['categoryInfo']['url']); ?>/">
                <div class="lett_logo">
                    <img src="<?php echo ($resultInfo['categoryInfo']['image']); ?>"><span><?php echo ($resultInfo['categoryInfo']['catname']); ?></span>
                </div>
                <div class="lett_time">
                    <span><?php echo ($resultInfo['resultInfo']['expect']); ?>期</span><span><?php echo (date('Y-m-d H:i:s',$resultInfo['resultInfo']['opentimestamp'])); ?></span>
                </div>
                <div class="lett_sphere">
                    <?php foreach(explode(',', $resultInfo['resultInfo']['opencode']) as $value){ ?>
                    <li><?php echo ($value); ?></li>
                    <?php } ?>
                </div>
                <s class="sanjiao"></s>
            </a><?php endforeach; endif; ?>
    </div>

    <?php if(is_array($dataArray)): foreach($dataArray as $key=>$dataItem): ?><div class="gd_infos">
            <div class="gd_infos_title">
                <h1><a href="/<?php echo ($dataItem['cateInfo']['url']); ?>/<?php echo ($dataItem['typeInfo']['pinyin']); ?>/" title="<?php echo ($dataItem['cateInfo']['catname']); echo ($dataItem['typeInfo']['title']); ?>"><?php echo ($dataItem['cateInfo']['catname']); echo ($dataItem['typeInfo']['title']); ?></a></h1>
            </div>
            <div class="gd_infos_li">
                <?php if(is_array($dataItem["data"])): foreach($dataItem["data"] as $key=>$item): ?><a href="/<?php echo ($dataItem['cateInfo']['url']); ?>/<?php echo ($dataItem['typeInfo']['pinyin']); ?>/<?php echo ($item["id"]); ?>.html" title="<?php echo ($item["title"]); ?>">
                        <h2><?php echo (_substr($item["title"],25,'...')); ?></h2>
                        <s></s>
                        <time><?php echo (date("Y-m-d H:i:s",$item["inputtime"])); ?></time>
                    </a><?php endforeach; endif; ?>
            </div>
        </div><?php endforeach; endif; ?>



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