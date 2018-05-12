<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
    var zNodes = <?php echo ($json_nodes); ?>;
    var setting = {
        view: {
            selectedMulti: false
        },
        edit: {
            enable: true,
            showRemoveBtn: false,
            showRenameBtn: false
        },
        data: {
            simpleData: {
                enable: true
            }
        },
        callback: {
            onClick       : do_open_layout
        },
    };

    $(document).ready(function(){
        $.fn.zTree.init($("#layout-tree-<?php echo ($controller); ?>"), setting, zNodes);
        var zTree    = $.fn.zTree.getZTreeObj("layout-tree-<?php echo ($controller); ?>");

        zTree.expandAll(true);

        //寻找第一个内部栏目, 并调用点击事件
        var nodes = zTree.getNodes();
        if(nodes.length > 0){
            for(var i = 0; i < nodes.length; i++){
                if(nodes[i].type == 0){
                    zTree.selectNode(nodes[i]);//选择点
                    zTree.setting.callback.onClick(event, "layout-tree-<?php echo ($controller); ?>", nodes[i]);//调用事件
                    break;
                }
            }
        }
    });
    function do_open_layout(event, treeId, treeNode) {
        var zTree = $.fn.zTree.getZTreeObj(treeId);
        console.log(treeNode);
        //如果是内部栏目, 则跳出列表, 否则跳出编辑页
        $(event.target).bjuiajax('doLoad', {url: treeNode.url, target: "#layout_<?php echo ($controller); ?>"});
        event.preventDefault()
    }
    function ztree_returnjson() {
        return <?php echo ($json_nodes); ?>
    }

</script>
<div class="bjui-pageContent">
    <div style="float:left; width:200px;">
        <ul id="layout-tree-<?php echo ($controller); ?>" class="ztree"></ul>
    </div>
    <div style="margin-left:210px; height:99.9%; overflow:hidden;">
        <div style="height:100%; overflow:hidden;">
            <fieldset style="height:100%;">
                <div id="layout_<?php echo ($controller); ?>" style="height:100%; overflow:hidden;">
                </div>
            </fieldset>
        </div>
    </div>
</div>