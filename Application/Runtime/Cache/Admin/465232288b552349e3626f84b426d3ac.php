<?php if (!defined('THINK_PATH')) exit();?>
<div class="bjui-pageContent">
    <form action="/index.php?m=Admin&c=Seo&a=edit&id=2&_=1524041660736" id="j_custom_form" data-toggle="validate" data-alertmsg="false">
        <table class="table table-condensed table-hover" width="100%">
            <tbody>
            <tr>
                <td>
                    <label for="a_title" class="control-label x85">标题：</label>
                    <input type="text" name="info[title]" id="a_title" value="<?php echo ($Detail["title"]); ?>" data-rule="required" size="30" class="required">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="a_func" class="control-label x85">方法：</label>
                    <input type="text" name="info[func]" id="a_func" value="<?php echo ($Detail["func"]); ?>" size="30" class="required">
                </td>
            </tr>
            <tr>
                <td>
                    <strong>设置说明：catname代表彩种名 typename代表资讯类型名 title代表标题 例:catname_typename_title_彩票网</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="seo_title" class="control-label x85">内容标题：</label>
                    <input type="text" id="seo_title" name="info[seo_title]" value="<?php echo ($Detail["seo_title"]); ?>" data-rule="" size="45">

                </td>
            </tr>
            <tr>
                <td>
                    <label for="seo_keywords" class="control-label x85">内容关键词：</label>
                    <input type="text" id="seo_keywords" name="info[seo_keywords]" value="<?php echo ($Detail["seo_keywords"]); ?>" data-rule="" size="45">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="control-label x85">内容描述：</label>
                    <textarea name="info[seo_description]" id="seo_description" data-toggle="autoheight" cols="60"  rows="1"><?php echo ($Detail["seo_description"]); ?></textarea>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li><button type="button" class="btn-close" data-icon="close">取消</button></li>
        <li><button type="submit" class="btn-default" data-icon="save">保存</button></li>
    </ul>
</div>