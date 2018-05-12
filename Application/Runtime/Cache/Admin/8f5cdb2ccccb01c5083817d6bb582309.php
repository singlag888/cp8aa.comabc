<?php if (!defined('THINK_PATH')) exit();?><div class="bjui-pageHeader">
    <form id="pagerForm" data-toggle="ajaxsearch" action="/index.php?m=Admin&c=System&a=adminManage&_=1523956189290" method="post">
        <input type="hidden" name="pageSize" value="">
        <input type="hidden" name="pageCurrent" value="">
        <input type="hidden" name="orderField" value="">
        <input type="hidden" name="orderDirection" value="">
        <div class="bjui-searchBar">
            <label>用户名：</label><input type="text" id="username" value="<?php echo ($username); ?>" name="username" class="form-control" size="10">&nbsp;
            <label>角色:</label>
            <select name="roleid" data-toggle="selectpicker">
                <option value="">所有角色</option>
                <?php if(is_array($roles)): foreach($roles as $key=>$role): ?><option value="<?php echo ($key); ?>" <?php if(($roleid) == $key): ?>selected<?php endif; ?> ><?php echo ($role["rolename"]); ?></option><?php endforeach; endif; ?>
            </select>&nbsp;
            <button type="submit" class="btn-default" data-icon="search">查询</button>&nbsp;
            <a class="btn btn-orange" href="javascript:;" data-toggle="reloadsearch" data-clear-query="true" data-icon="undo">清空查询</a>
            <div class="pull-right">
                <button type="button" class="btn-green" data-url="<?php echo U('System/adminAdd');?>" data-toggle="dialog" mask="true" data-width="550" data-height="200" data-icon="plus">添加管理员</button>&nbsp;
                <button type="button" class="btn-blue" data-url="<?php echo U('System/adminDelete?userid=');?>{#bjui-selected}" data-toggle="doajax" data-confirm-msg="确定要删除选中项吗？" data-icon="remove" title="可以在控制台(network)查看被删除ID">删除选中行</button>&nbsp;
            </div>
        </div>
    </form>
</div>
<div class="bjui-pageContent tableContent">
    <table data-selected-multi="true" data-toggle="tablefixed" data-width="100%" data-nowrap="true">
        <thead>
            <tr>
                <th width="50" data-order-field="userid">ID</th>
                <th>用户名</th>
                <th width="120">角色</th>
                <th width="120">真实姓名</th>
                <th width="120" align="center">最后登录IP</th>
                <th width="120" align="center" data-order-field="lastlogintime">最后登录时间</th>
                <th width="50" data-order-field="status">开启状态</th>
                <th align="center" width="250">管理</th>
            </tr>
        </thead>
        <tbody>
            <?php if(is_array($page_list)): foreach($page_list as $key=>$item): ?><tr data-id="<?php echo ($item["userid"]); ?>">
                <td><?php echo ($item["userid"]); ?></td>
                <td><?php echo ($item["username"]); ?></td>
                <td><?php echo ($roles[$item['roleid']]['rolename']); ?></td>
                <td><?php echo ($item["nickname"]); ?></td>
                <td align="center"><?php echo ($item["lastloginip"]); ?></td>
                <td align="center"><?php echo (date("Y-m-d",$item["lastlogintime"])); ?></td>
                <td align="center"><?php if(($item["status"]) == "1"): ?>是<?php else: ?>否<?php endif; ?></td>
                <td align="center">
                    <?php if(($item["userid"]) > "1"): ?><a class="btn btn-green" href="<?php echo U('System/adminEdit?userid='.$item[userid]);?>" data-toggle="dialog" mask="true" data-width="550" data-height="200"><span>修改</span></a> | <a title="密码将重置为1q2w3e4" class="btn btn-green" href="<?php echo U('System/adminResetPassword?userid='.$item[userid]);?>" data-toggle="doajax" data-confirm-msg="确定要重置密码吗？"><span>重置密码</span></a> | <a class="btn btn-green" href="<?php echo U('System/adminChangeStatus?userid='.$item[userid]);?>" data-toggle="doajax"><span><?php if(($item["status"]) == "0"): ?>启用<?php else: ?>禁用<?php endif; ?></span></a> | <a class="btn btn-red" href="<?php echo U('System/adminDelete?userid='.$item[userid]);?>" data-toggle="doajax" data-confirm-msg="确定要删除该管理员吗？"><span>删除</span></a>
                    <?php else: ?>
                        <button class="btn btn-default" ><span>修改</span></button> | <button class="btn btn-default" ><span>重置密码</span></button> | <button class="btn btn-default" ><span>禁用</span></button> | <button class="btn btn-default"><span>删除</span></button><?php endif; ?>
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