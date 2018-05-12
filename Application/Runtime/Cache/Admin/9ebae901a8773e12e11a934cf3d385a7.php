<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
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
    KindEditor('#a_insertimage_img').click(function() {
        thumbUploader.loadPlugin('image', function() {
            thumbUploader.plugin.imageDialog({
                imageUrl : KindEditor('#a_thumb_img').val(),
                clickFn : function(url, title, width, height, border, align) {
                    KindEditor('#a_thumb_img').val(url);
                    $('#a_thumb_preview_img').html('<img src="'+ url +'" width="100" />')
                    $('#a_thumb_clear_img').show();
                    thumbUploader.hideDialog();
                }

            });
        });
    });

    $("#a_thumb_clear_img").click(function(){
        $('#a_thumb_img').val('');
        $('#a_thumb_preview_img').html('')
        $('#a_thumb_clear_img').hide();
    });
</script>
<div class="bjui-pageContent">
    <form action="/index.php?m=Admin&c=Article&a=categoryEdit&catid=1&_=1524041871987" id="j_custom_form" data-toggle="validate" data-alertmsg="false">
        <input type="hidden" name="catid" value="<?php echo ($catid); ?>">
        <div style="margin:15px auto 0; width:100%;">
            <fieldset>
                <legend>栏目设置</legend>
                <!-- Tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab_setting_1" role="tab" data-toggle="tab">基本选项</a></li>
                    <!--<li><a href="#tab_setting_2" role="tab" data-toggle="tab">模版设置</a></li>
                    <li><a href="#tab_setting_3" role="tab" data-toggle="tab">SEO设置</a></li>-->
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_setting_1">
                        <table class="table table-condensed table-hover" width="100%">
                            <tbody>
                                <tr>
                                    <td>
                                        <label class="control-label x85">上级栏目：</label>
                                        <?php echo \Lain\Phpcms\form::select_category('', $parentid , 'data-toggle="selectpicker" name="info[parentid]"','≡ 作为一级栏目 ≡');?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="c_catname" class="control-label x85">栏目名称：</label>
                                        <input type="text" id="c_catname" name="info[catname]" value="<?php echo ($Detail["catname"]); ?>" data-rule="required" size="15" class="required">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="c_url" class="control-label x85">拼音：</label>
                                        <input type="text" id="c_url" name="info[url]" value="<?php echo ($Detail["url"]); ?>" size="15" class="required">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label class="control-label x85">缩略图：</label>
                                        <input type="text" name="info[image]" id="a_thumb" value="<?php echo ($Detail["image"]); ?>" readonly/>
                                        <input type="button" id="a_insertimage" value="选择文件" />
                                        <label class="control-label x85">预览：</label>
                                        <span id="a_thumb_preview"><?php if(!empty($Detail["image"])): ?><img src="<?php echo ($Detail["image"]); ?>" width="100" /><?php endif; ?></span>
                                        <a href="javascript:;" id="a_thumb_clear" <?php if(empty($Detail["image"])): ?>style="display:none;"<?php endif; ?>取消</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label class="control-label x85">直播图片：</label>
                                        <input type="text" name="info[zhiboimage]" id="a_thumb_img" value="<?php echo ($Detail["zhiboimage"]); ?>" readonly/>
                                        <input type="button" id="a_insertimage_img" value="选择文件" />
                                        <label class="control-label x85">预览：</label>
                                        <span id="a_thumb_preview_img"><?php if(!empty($Detail["zhiboimage"])): ?><img src="<?php echo ($Detail["zhiboimage"]); ?>" width="100" /><?php endif; ?></span>
                                        <a href="javascript:;" id="a_thumb_clear_img" <?php if(empty($Detail["zhiboimage"])): ?>style="display:none;"<?php endif; ?>取消</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="j_custom_name" class="control-label x85">栏目类型：</label>
                                        <?php if(empty($Detail)): ?><select data-toggle="selectpicker" name="info[type]">
                                            <option value="0" >内部栏目</option>
                                            <option value="1" >单网页</option>
                                        </select>
                                        <?php else: ?>
                                        <input type="text" value="<?php if(($Detail["type"]) == "1"): ?>单网页<?php else: ?>内部栏目<?php endif; ?>" disabled><?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="a_description" class="control-label x85">直播代码：</label>
                                        <textarea name="description" id="a_description" data-toggle="autoheight" cols="60" rows="1"><?php echo ($Detail["description"]); ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="c_listorder" class="control-label x85">排序值：</label>
                                        <input type="text" name="info[listorder]" id="c_listorder" value="<?php echo ($Detail["listorder"]); ?>" size="15">
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </fieldset>
        </div>
        
    </form>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li><button type="button" class="btn-close" data-icon="close">取消</button></li>
        <li><button type="submit" class="btn-default" data-icon="save">保存</button></li>
    </ul>
</div>