<?php if (!defined('THINK_PATH')) exit();?><div class="bjui-pageHeader">
    <a href="<?php echo U('System/adminNodeAdd');?>" class="btn btn-green" data-toggle="dialog" data-width="520" data-height="290" data-id="dialog-mask" data-mask="true">添加菜单</a>
</div>
<div class="bjui-pageContent tableContent">
    <table data-toggle="tablefixed" data-width="100%" data-nowrap="true">
        <thead>
            <tr>
                <th width="100">ID</th>
                <th>菜单名</th>
                <th width="100">排序</th>
                <th width="30">图标</th>
                <th width="200">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php echo ($categorys); ?>
        </tbody>
    </table>
</div>