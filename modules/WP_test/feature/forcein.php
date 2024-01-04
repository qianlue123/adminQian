<?php
# <div class="fpbx-container col-md-9"> 此处不写, 写在调用文件
?>
<div class="display full-border">
    <h1 class="section-title" data-for="asteriskcli">通话中新插入分机</h1>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $helptext2 ?>.
    </div>
    <div class="container-fluid" data-id="asteriskcli">
        <div class="row">
            <div class="col-md-3 group-vertical">
                <span class="glyphicon glyphicon-earphone"></span> 准备加入通话的分机
                <select name="" id="ExtensionList" class="form-control">
                    <?php generate_selectoption(); ?>
                    <!-- <option value="111"> 111 (a) </option> -->
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 group-vertical">
                <span class="label label-info">选择要插入的通话路线</span>
                <select name="" id="Extension_forcein" class="form-control">
                    <?php generate_selectoption(); ?>
                </select>
            </div>
            <div class="col-md-3 group-vertical">
                <span class="label label-default">其余分机</span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9"></div>
            <span class="glyphicon glyphicon-log-in"></span> &nbsp;
            <button class="btn btn-warning" id="btn-forcein" type="button">
                <i aria-hidden="true"></i> 插 入
            </button>
        </div>
        <div class="cmdresult-forcein"></div>
    </div>
</div>

<script type="text/javascript">
    $('#btn-forcein').click(function() {
        var box_output = $('div.cmdresult-forcein');
        var post_data = {
            module: 'asterisk-cli',
            command: 'clicmd',
            // 直接拼装能在 asterisk 命令行里运行的命令
            data: 'pjsip show version',
        };

        box_output.html("<span>" + _("Loading...") + "</span>");
        $.post(window.FreePBX.ajaxurl, post_data, function(data) {
            var msg = "";
            if (data.status) {
                msg = "<pre>" + JSON.parse(data.message) + "</pre>";
            } else {
                msg = "<b>Error</b>";
            }
            box_output.html(msg);
        });
    });
</script>