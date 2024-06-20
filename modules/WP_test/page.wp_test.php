<?php
# 第一行提供配置文件信息

use function Symfony\Component\VarDumper\Dumper\esc;

if (!defined('FREEPBX_IS_AUTH')) {
    die('No direct script access allowed');
}

$conn = new mysqli("localhost", "root", "like2022", "asterisk");
if ($conn->connect_error) {
    die('连接失败: ' . $conn->connect_error);
}

$helptext1 = _('电话强拆功能就是两个电话本来打的好好的，现在不想让他们打了，
  选上对应的通话号码，按一下就断开。');
$helptext2 = _('电话强插功能就是几个电话本来聊得好好的，中途再加个人进来。
  选上未接入的电话，按一下就连上。');
$helptext3 = _('添加话机，默认密码和分机号一样');

?>

<div class="container-fluid">
    <div class="fpbx-container col-md-9">

        <?php # __DIR__ 获取这个文件所在目录的路径
        include_once __DIR__ . '/feature/forceout.php';
        include_once __DIR__ . '/feature/forcein.php';
        ?>

        <span class="badge"><span class="glyphicon glyphicon-console"></span> 系统反馈 </span>
        <div class="cmd_output"></div>

    </div>

    <div class="fpbx-container col-md-3">
        <h2 class="section-title">增加话机</h2>
        <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>填写注册信息</a>
        <div class="modal fade" id="modal-id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title">注册 sip 话机</h3>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success"><?php echo $helptext3 ?></div>
                        <div class="container-fluid" data-id="asteriskcli">
                            <div class="element-container">
                                <div class="row">
                                    <div class="col-md-4">分机号</div>
                                    <div class="col-md-6">
                                        <input type="text" id="phoneID" placeholder="9001">
                                    </div>
                                </div>
                            </div>
                            <div class="element-container">
                                <div class="row">
                                    <div class="col-md-4">显示名</div>
                                    <div class="col-md-6">
                                        <input type="text" id="phonename" placeholder="qianlue">
                                    </div>
                                </div>
                            </div>
                            <div class="element-container">
                                <div class="row">
                                    <div class="col-md-4">密码</div>
                                    <div class="col-md-6">
                                        <input type="text" id="password" placeholder="9001">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" id="create-extension">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i> 添加
                        </button>
                    </div>
                    <script type="text/javascript">
                        $('#create-extension').click(function() {

                            var box_output = $('div.cmd_output');
                            var post_data = {
                                module: 'asterisk-cli',
                                command: 'clicmd',
                                // data: $('#astcmd').val(),
                                data: 'core show help',
                            };

                            box_output.html("<pre>" + _("Loading...") + "</pre>");
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
                </div>
            </div>
        </div>

        <br>
        <br>

        <h2 class="section-title">已注册电话</h2>
        <table data-cookie="true" data-cookie-id-table="extensions-sip" data-url="ajax.php?module=core&amp;command=getExtensionGrid&amp;type=pjsip" data-cache="false" data-show-refresh="true" data-toolbar="#toolbar-sip" data-maintain-selected="true" data-show-columns="true" data-show-toggle="true" data-toggle="table" data-pagination="true" class="table table-striped ext-list">
            <thead>
                <tr>
                    <th data-sortable="true" data-field="name"><?php echo _('Name') ?></th>
                    <th data-sortable="true" data-field="extension"><?php echo _('Extension') ?></th>
                </tr>
            </thead>
        </table>
    </div>
</div>