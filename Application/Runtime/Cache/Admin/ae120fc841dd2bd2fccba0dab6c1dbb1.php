<?php if (!defined('THINK_PATH')) exit();?><div class="bjui-pageHeader">
    <form id="pagerForm" data-toggle="ajaxsearch" action="/index.php?m=Admin&c=Article&a=type&_=1524041914887" method="post">
        <input type="hidden" name="pageSize" value="">
        <input type="hidden" name="pageCurrent" value="">
        <input type="hidden" name="orderField" value="">
        <input type="hidden" name="orderDirection" value="">
        <div class="bjui-searchBar">
            <div class="pull-right">
                <button type="button" class="btn-green" data-url="<?php echo U($controller.'/typeadd');?>" data-toggle="dialog" data-width="1020" data-height="520" data-id="article_edit">添加</button>&nbsp;
                
                <div class="btn-group">
                    <button type="button" class="btn-default dropdown-toggle" data-toggle="dropdown" data-icon="copy">批量操作<span class="caret"></span></button>
                    <ul class="dropdown-menu right" role="menu">
                        <li><a href="<?php echo U($controller.'/delete');?>" data-toggle="doajaxchecked" data-confirm-msg="确定要删除选中项吗？" data-idname="ids" data-group="ids">删除</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="bjui-pageContent tableContent">
    <table data-toggle="tablefixed" data-width="100%" data-nowrap="true">
        <thead>
            <tr>
                <th width="50" data-order-field="id" align="center">ID</th>
                <th>标题</th>
                <th align="center" width="100">添加时间</th>
                <th align="center" width="100">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if(is_array($page_list)): foreach($page_list as $key=>$item): ?><tr data-id="<?php echo ($item["id"]); ?>">
                <td><?php echo ($item["id"]); ?></td>
                <td><?php echo ($item["title"]); ?> <?php if(!empty($item["thumb"])): ?><i id="icon_img" class="fa fa-picture-o"></i><?php endif; ?></td>
                <td align="center"><?php echo (date("Y-m-d",$item["inputtime"])); ?></td>
                <td align="center">
                    <a class="btn btn-green" href="<?php echo U($controller.'/typeedit?id='.$item[id]);?>" data-toggle="dialog" data-width="1020" data-height="520" data-id="<?php echo ($controller); ?>_edit" data-title="编辑-<?php echo ($item["title"]); ?>"><span>编辑</span></a>
                    <a class="btn btn-red" href="<?php echo U($controller.'/typedel?ids='.$item[id]);?>" data-toggle="doajax" data-confirm-msg="是否确定要删除？">删除</a>
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
                <option value="30">30</option>
                <option value="60">60</option>
                <option value="120">120</option>
                <option value="150">150</option>
            </select>
        </div>
        <span>&nbsp;条，共 <?php echo ($page["totalCount"]); ?> 条</span>
    </div>
    <div class="pagination-box" data-toggle="pagination" data-total="<?php echo ($page["totalCount"]); ?>" data-page-size="<?php echo ($page["pageSize"]); ?>" data-page-current="<?php echo ($page["pageCurrent"]); ?>"></div>
</div>