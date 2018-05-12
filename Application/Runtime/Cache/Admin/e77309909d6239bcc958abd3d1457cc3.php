<?php if (!defined('THINK_PATH')) exit();?><div class="bjui-pageContent">
    <form action="/index.php?m=Admin&c=Publics&a=timeout&_=1524709031272" data-toggle="validate" method="post">
        <hr>
        <div class="form-group">
            <label for="j_pwschange_oldpassword" class="control-label x85">用户名：</label>
            <input type="password" data-rule="required" name="username" value="" placeholder="用户名" size="20">
        </div>
        <div class="form-group">
            <label for="j_pwschange_oldpassword" class="control-label x85">密码：</label>
            <input type="password" data-rule="required" name="password" value="" placeholder="密码" size="20">
        </div>
    </form>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li><button type="button" class="btn-close">取消</button></li>
        <li><button type="submit" class="btn-default">提交</button></li>
    </ul>
</div>