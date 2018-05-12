<?php if (!defined('THINK_PATH')) exit();?><div class="bjui-pageHeader">
    <form id="pagerForm" data-toggle="ajaxsearch" action="/index.php?m=Admin&c=Result&a=timemanage&catid=1&_=1523956915475" method="post">
        <input type="hidden" name="pageSize" value="">
        <input type="hidden" name="pageCurrent" value="">
        <input type="hidden" name="orderField" value="">
        <input type="hidden" name="orderDirection" value="">
        <div class="bjui-searchBar">
            <input type="text" id="keyword" value="<?php echo ($keyword); ?>" name="keyword" class="form-control" size="10">&nbsp;
            <label>添加时间：</label><input type="text" id="a_start_time" name="start_time" value="<?php echo ($start_time); ?>" data-toggle="datepicker" readonly size="12"> - <input type="text" id="a_end_time" name="end_time" value="<?php echo ($end_time); ?>" data-toggle="datepicker" readonly size="12">
            <button type="submit" class="btn-default" data-icon="search">搜索</button>&nbsp;
            <a class="btn btn-orange" href="javascript:;" data-toggle="reloadsearch" data-clear-query="true" data-icon="undo">重置</a>
            <div class="pull-right">
                <button type="button" class="btn-green" data-url="<?php echo U('Article/add?catid='.$catid);?>" data-toggle="dialog" data-width="1050" data-height="625" data-id="article_edit">添加</button>&nbsp;
                
                <div class="btn-group">
                    <button type="button" class="btn-default dropdown-toggle" data-toggle="dropdown" data-icon="copy">批量操作<span class="caret"></span></button>
                    <ul class="dropdown-menu right" role="menu">
                        <li><a href="<?php echo U('Article/delete');?>" data-toggle="doajaxchecked" data-confirm-msg="确定要删除选中项吗？" data-idname="ids" data-group="ids">删除</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="bjui-pageContent tableContent">
    <table data-toggle="tablefixed" data-width="100%" data-nowrap="false">
        <thead>
        <tr>
            <th width="40" data-order-field="id" align="center">编号</th>
            <th width="70" align="center">日期</th>
            <th width="40" align="center">期数</th>
            <th width="90" align="center">开盘时间</th>
            <th width="90" align="center">封盘时间</th>
            <th width="90" align="center">开奖时间</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($page_list as $key=>$value){ ?>
        <tr data-id="<?php echo $value['id']; ?>">
            <td align="center"><?php echo $value['id']; ?></td>
            <td align="center"><?php echo $value['riqi']; ?></td>
            <td align="center"><?php echo $value['expect']; ?></td>
            <td align="center"><?php echo date('Y-m-d H:i:s',$value['opentime']); ?></td>
            <td align="center"><?php echo date('Y-m-d H:i:s',$value['closetime']); ?></td>
            <td align="center"><?php echo date('Y-m-d H:i:s',$value['kjtime']); ?></td>
        </tr>
        <?php } ?>
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