<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
//多图上传
function pic_upload_success(file, data) {
    var json = $.parseJSON(data);
    if (json[BJUI.keys.statusCode] == BJUI.statusCode.ok) {
        var html = $('#j_custom_span_pic').html();
        var vale = $('#j_custom_pic').val();
        $('#j_custom_pic').val(vale+'|'+json.file);
        $('#j_custom_span_pic').html(html+'<img src="'+ json.filename +'" width="100" />');
        $('.l_imgs_span').hide();
    }
}
//缩略图
var thumbUploader = KindEditor.editor({
    allowFileManager : true,
    uploadJson       : "<?php echo U('Attachment/uploadJson');?>",            //更改默认的上传控件
    fileManagerJson  : "<?php echo U('Attachment/fileManagerJson');?>",  //更改默认的空间控件
});
KindEditor('#a_insertimage').click(function() {
    thumbUploader.loadPlugin('image', function() {
        thumbUploader.plugin.imageDialog({
            imageUrl : KindEditor('#a_thumb').val(),
            clickFn : function(url, title, width, height, border, align) {
                KindEditor('#a_thumb').val(url);
                $('#a_thumb_preview').html('<img src="'+ url +'" width="100" />')
                $('#a_thumb_clear').show();
                thumbUploader.hideDialog();
            }

        });
    });
});

$("#a_thumb_clear").click(function(){
    $('#a_thumb').val('');
    $('#a_thumb_preview').html('')
    $('#a_thumb_clear').hide();
});

//描述字数限制相关
var charset = 'utf-8';
function strlen_verify(obj, checklen, maxlen) {
    var v = obj.value, charlen = 0, maxlen = !maxlen ? 200 : maxlen, curlen = maxlen, len = strlen(v);
    for(var i = 0; i < v.length; i++) {
        if(v.charCodeAt(i) < 0 || v.charCodeAt(i) > 255) {
            curlen -= charset == 'utf-8' ? 2 : 1;
        }
    }
    if(curlen >= len) {
        $('#'+checklen).html(curlen - len);
    } else {
        obj.value = mb_cutstr(v, maxlen, true);
    }
}
function strlen(str) {
    return ($.browser.msie && str.indexOf('\n') != -1) ? str.replace(/\r?\n/g, '_').length : str.length;
}
function mb_cutstr(str, maxlen, dot) {
    var len = 0;
    var ret = '';
    var dot = !dot ? '...' : '';
    maxlen = maxlen - dot.length;
    for(var i = 0; i < str.length; i++) {
        len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? (charset == 'utf-8' ? 3 : 2) : 1;
        if(len > maxlen) {
            ret += dot;
            break;
        }
        ret += str.substr(i, 1);
    }
    return ret;
}
</script>
<div class="bjui-pageContent">
    <form action="/index.php?m=Admin&c=Article&a=add&catid=5&_=1524709049734" id="j_custom_form" data-toggle="validate" data-alertmsg="false">
        <table class="table table-condensed table-hover" width="100%">
            <tbody>
                <tr>
                    <td>
                        <label class="control-label x85">栏目名：</label>
                        <input type="hidden" name="info[catid]" value="<?php echo ($catid); ?>">
                        <span><?php echo ($categorys[$catid]['catname']); ?></span>
                       
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="control-label x90">文章类型：</label>
                        <select data-toggle="selectpicker" name="info[type]">
                            <option value="0">请选择类型</option>
                            <?php if(is_array($typeList)): foreach($typeList as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if(($Detail["type"]) == $vo["id"]): ?>selected<?php endif; ?>><?php echo ($vo[title]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="a_title" class="control-label x85">标题：</label>
                        <input type="text" name="info[title]" id="a_title" value="<?php echo ($Detail["title"]); ?>" data-rule="required" size="30" class="required">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label class="control-label x85">缩略图：</label>
                        <input type="text" name="info[thumb]" id="a_thumb" value="<?php echo ($Detail["thumb"]); ?>" readonly/>
                        <input type="button" id="a_insertimage" value="选择文件" />
                        <label class="control-label x85">预览：</label>
                        <span id="a_thumb_preview"><?php if(!empty($Detail["thumb"])): ?><img src="<?php echo ($Detail["thumb"]); ?>" width="100" /><?php endif; ?></span>
                        <a href="javascript:;" id="a_thumb_clear" <?php if(empty($Detail["thumb"])): ?>style="display:none;"<?php endif; ?>取消</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="a_description" class="control-label x85">描述：</label>
                        <textarea name="info[description]" id="a_description" data-toggle="autoheight" cols="60" onkeyup="strlen_verify(this, 'description_len', 255)" rows="1"><?php echo ($Detail["description"]); ?></textarea>
                        还可输入<b><span id="description_len">255</span></b> 字符
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <label for="j_custom_content" class="control-label x85">内容：</label>
                        <div style="display: inline-block; vertical-align: middle;">
                            <textarea name="content" id="j_custom_content" class="j-content" style="width: 700px;" data-toggle="kindeditor" data-minheight="200" data-rule="required" data-uploadjson="<?php echo U('Attachment/uploadJson');?>" data-filemanagerjson="<?php echo U('Attachment/fileManagerJson');?>"><?php echo ($Detail["content"]); ?></textarea>
                            <!-- <textarea data-toggle="ueditor" id="ueditor"></textarea> -->
                            <div style="  border: 1px solid #CCC;  padding: 5px 8px;  background: #FFC;  margin-top: 6px;">
                                <input name="add_introduce" id="add_introduce" type="checkbox" data-toggle="icheck" data-label="是否截取内容&nbsp;" checked><input type="text" name="introcude_length" value="200" size="4" data-rule="range[0~255]"> 字符至内容摘要 <input type="checkbox" name="auto_thumb" value="1" id="auto_thumb" type="checkbox" data-toggle="icheck" data-label="是否获取内容第&nbsp;" checked><input type="text" name="auto_thumb_no" value="1" size="4" data-rule="range[1~5]"> 张图片作为标题图片
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li><button type="button" class="btn-close" data-icon="close">关闭</button></li>
        <li><button type="submit" class="btn-default" data-icon="save">保存</button></li>
    </ul>
</div>