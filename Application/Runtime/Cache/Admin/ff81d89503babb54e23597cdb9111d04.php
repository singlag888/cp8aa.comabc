<?php if (!defined('THINK_PATH')) exit();?><div class="bjui-pageHeader">
    <form id="pagerForm" data-toggle="ajaxsearch" action="/index.php?m=Admin&c=Other&a=links&_=1523956514672" method="post">
        <input type="hidden" name="pageSize" value="">
        <input type="hidden" name="pageCurrent" value="">
        <input type="hidden" name="orderField" value="">
        <input type="hidden" name="orderDirection" value="">
        <div class="bjui-searchBar">
            <button type="button" href="<?php echo U('Other/linksAdd');?>" class="btn btn-green" data-toggle="dialog" data-width="720" data-height="290" data-id="dialog-mask" data-mask="true">添加友情链接</button>&nbsp;
            <button type="button" class="btn-blue" data-url="<?php echo U('Other/linksDel');?>?ids={#bjui-selected}" data-toggle="doajax" data-confirm-msg="确定要删除选中项吗？" data-icon="remove">删除选中行</button>&nbsp;
            <!--<label>网站名：</label><input type="text" id="username" value="<?php echo ($username); ?>" name="username" class="form-control" size="10">&nbsp;
            <button type="submit" class="btn-default" data-icon="search">查询</button>&nbsp;
            <a class="btn btn-orange" href="javascript:;" data-toggle="reloadsearch" data-clear-query="true" data-icon="undo">清空查询</a>-->
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
            <th>网站名</th>
            <th width="120">网址</th>
            <th width="50" align="center">类型</th>
            <th width="50" align="center">是否显示</th>
            <th width="120" align="center">添加时间</th>
            <th align="center" width="250">管理</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($page_list)): foreach($page_list as $key=>$item): ?><tr data-id="<?php echo ($item["id"]); ?>">
                <td><?php echo ($item["id"]); ?></td>
                <td><?php echo ($item["title"]); ?></td>
                <td><a href="<?php echo ($item["url"]); ?>" target="_blank"><?php echo ($item["url"]); ?></a></td>
                <td align="center">
                    <?php if(($item["type"]) == "1"): ?>友情链接
                    <?php else: ?>
                        导航链接<?php endif; ?>
                </td>
                <td align="center">
                    <a class="btn <?php if(($item["status"]) == "99"): ?>btn-green<?php else: ?>btn-red<?php endif; ?>" data-toggle="doajax" href="<?php echo U('Other/linksStatus', array('id'=>$item['id']));?>">
                    <?php if(($item["status"]) == "99"): ?>是<?php else: ?>否<?php endif; ?>
                    </a>
                </td>
                <td><?php echo (date('Y-m-d',$item["inputtime"])); ?></td>
                <td align="center">
                    <a href="<?php echo U('Other/linksEdit?id='.$item['id']);?>" class="btn btn-green" data-toggle="dialog" data-width="720" data-height="290" data-id="dialog-mask" data-mask="true"><span>修改</span></a>
                    <a class="btn btn-red" href="<?php echo U('Other/linksDel?ids='.$item[id]);?>" data-toggle="doajax" data-confirm-msg="确定要删除选中项吗？">删</a>
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