<?php if (!defined('THINK_PATH')) exit();?><div class="bjui-pageHeader">
    <a href="<?php echo U('Article/categoryAdd');?>" class="btn btn-green" data-toggle="dialog" data-width="520" data-height="320" data-id="dialog-mask" data-mask="true">添加栏目</a>
    <a href="<?php echo U('Article/categoryCache');?>" class="btn btn-green" data-toggle="doajax">更新栏目缓存</a>
</div>
<div class="bjui-pageContent tableContent">
    <table data-toggle="tablefixed" data-width="100%" data-nowrap="true">
        <thead>
            <tr>
                <th width="100">ID</th>
                <th>栏目名</th>
                <th width="100">栏目类型</th>
                <th width="100">排序</th>
                <th width="200" align="center">添加时间</th>
            </tr>
        </thead>
        <tbody>
            <?php echo ($categoryList); ?>
        </tbody>
    </table>
</div>