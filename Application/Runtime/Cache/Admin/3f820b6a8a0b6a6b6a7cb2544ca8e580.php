<?php if (!defined('THINK_PATH')) exit();?><div class="bjui-pageHeader">
    <form id="pagerForm" data-toggle="ajaxsearch" action="/index.php?m=Admin&c=Seo&a=index&_=1524041663518" method="post">
        <input type="hidden" name="pageSize" value="">
        <input type="hidden" name="pageCurrent" value="">
        <input type="hidden" name="orderField" value="">
        <input type="hidden" name="orderDirection" value="">
        <div class="bjui-searchBar">
            <button type="button" href="<?php echo U('Seo/add');?>" class="btn btn-green" data-toggle="dialog" data-width="820" data-height="690" data-id="dialog-mask" data-mask="true">添加友情链接</button>&nbsp;
            <div class="pull-right">

            </div>
        </div>
    </form>
</div>
<div class="bjui-pageContent tableContent">
    <table data-selected-multi="true" data-toggle="tablefixed" data-width="100%" data-nowrap="true">
        <thead>
        <tr>
            <th width="50" data-order-field="userid">ID</th>
            <th width="50">标题</th>
            <th width="30">方法</th>
            <th width="80" align="center">SEO标题</th>
            <th width="100" align="center">SEO关键词</th>
            <th width="100" align="center">SEO描述</th>
            <th width="50" align="center">添加时间</th>
            <th align="center" width="50">管理</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($page_list)): foreach($page_list as $key=>$item): ?><tr data-id="<?php echo ($item["id"]); ?>">
                <td><?php echo ($item["id"]); ?></td>
                <td><?php echo ($item["title"]); ?></td>
                <td><?php echo ($item["func"]); ?></td>
                <td><?php echo ($item["seo_title"]); ?></td>
                <td><?php echo ($item["seo_keywords"]); ?></td>
                <td><?php echo ($item["seo_description"]); ?></td>
                <td><?php echo (date('Y-m-d',$item["ctime"])); ?></td>
                <td align="center">
                    <a href="<?php echo U('Seo/edit?id='.$item['id']);?>" class="btn btn-green" data-toggle="dialog" data-width="720" data-height="290" data-id="dialog-mask" data-mask="true"><span>修改</span></a>
                 </td>
            </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
<div class="bjui-pageFooter">
    <div class="pages">
        <span>每页&nbsp;</span>
        <div class="selectPagesize">
            <select data-toggle="selectpicker" data-toggle-change="changepagesize">
                <option value="30" <?php if(($page["pageSize"]) == "30"): ?>selected<?php endif; ?>>30</option>
                <option value="60" <?php if(($page["pageSize"]) == "30"): ?>selected<?php endif; ?>>60</option>
                <option value="120" <?php if(($page["pageSize"]) == "30"): ?>selected<?php endif; ?>>120</option>
                <option value="150" <?php if(($page["pageSize"]) == "30"): ?>selected<?php endif; ?>>150</option>
            </select>
        </div>
        <span>&nbsp;条，共 <?php echo ($page["totalCount"]); ?> 条</span>
    </div>
    <div class="pagination-box" data-toggle="pagination" data-total="<?php echo ($page["totalCount"]); ?>" data-page-size="<?php echo ($page["pageSize"]); ?>" data-page-current="<?php echo ($page["pageCurrent"]); ?>"></div>
</div>