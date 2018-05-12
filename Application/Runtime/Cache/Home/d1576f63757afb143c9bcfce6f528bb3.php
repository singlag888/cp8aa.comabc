<?php if (!defined('THINK_PATH')) exit();?><td>
	<span class="table_name ">
		<a href="/<?php echo ($resultInfo['categoryInfo']['url']); ?>/"><?php echo ($resultInfo['categoryInfo']['catname']); ?></a>
	</span>
</td>
<td>
	<span class="table_hao">
		<?php echo ($resultInfo['resultInfo']['expect']); ?>
	</span>
</td>
<td align="center">
	<div class="boll_box cai-num" style="padding-left: 10px;height:38px;line-height:38px;">
		<?php foreach(explode(',', $resultInfo['resultInfo']['opencode']) as $value){ ?>
		<span class="n<?php echo ($value); ?>" data-num="<?php echo ($value); ?>"><?php echo ($value); ?></span>
		
		<?php } ?>
	</div>
</td>
<td class="djs<?php echo ($resultInfo['categoryInfo']['url']); ?>">
	<span style="color: #ff0000" ><?php echo ($resultInfo['other']['min']); ?></span>分
	<span style="color: #ff0000" ><?php echo ($resultInfo['other']['sec']); ?></span>秒
</td>