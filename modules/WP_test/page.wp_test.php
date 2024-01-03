<?php
# 第一行提供配置文件信息

use function Symfony\Component\VarDumper\Dumper\esc;

if (!defined('FREEPBX_IS_AUTH')) {
    die('No direct script access allowed');
}

$conn = new mysqli("localhost", "root", "like2022", "asterisk");
if($conn->connect_error) {
    die('连接失败: '.$conn->connect_error);
}

# <script type="text/javascript" src="assets/js/test.js" charset="utf-8"></script>
# 上面这种 JS 文件不需要引入，自动从 /admin/assets/ 里加载。使用 ln -s 

# 将功能分到3个对应的php文件里，这个文件作为入口点引用另外的指定功能文件
# feature_forceout.php  电话强拆
# feature_forcein.php   电话强插

$helptext1 = _('电话强拆功能就是两个电话本来打的好好的，现在不想让他们打了，
  选上对应的通话号码，按一下就断开。');
$helptext2 = _('电话强插功能就是几个电话本来聊得好好的，中途再加个人进来。
  选上未接入的电话，按一下就连上。');
?>

<div class="container-fluid">
    <div class="fpbx-container col-md-9">

        <?php include 'feature_forceout.php';
        echo '<br/>';
        include 'feature_forcein.php';
        echo '<br/>';
        ?>

        <form action="" method="POST" class="form-horizontal" role="form">
            <div class="form-group" data-for="asteriskcli">
                <legend>添加一个话机</legend>
            </div>

            <div class="container-fluid" data-id="asteriskcli">
                <div class="row form-group">
                    <div class="input-group col-md-4">
                        <div class="input-group-addon">分机号</div>
                        <input type="text" class="form-control" id="exampleInputAmount" placeholder="2024">

                        <div class="input-group-addon">显示名</div>
                        <input type="text" class="form-control" id="exampleInputAmount" placeholder="qianlue">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-3">
                        <button class="btn btn-info" id="create-extension" type="button">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i> 添加 </button>
                    </div>
                </div>
            </div>
        </form>

        <span class="badge"><span class="glyphicon glyphicon-console"></span> 系统反馈 </span>

        <div id="astcmd-scrollable-dropdown-menu">
            <input type="text" class="form-control typeaheadd" id="astcmd">
        </div>
    </div>

    <div class="fpbx-container col-md-3">
        <h2 class="section-title">已注册电话</h2>
        <table data-cookie="true" data-cookie-id-table="extensions-sip" data-url="ajax.php?module=core&amp;command=getExtensionGrid&amp;type=pjsip" data-cache="false" data-show-refresh="true" data-toolbar="#toolbar-sip" data-maintain-selected="true" data-show-columns="true" data-show-toggle="true" data-toggle="table" data-pagination="true" class="table table-striped ext-list">
            <thead>
                <tr> 
                    <th data-sortable="true" data-field="name"><?php echo _('Name')?></th>
                    <th data-sortable="true" data-field="extension"><?php echo _('Extension') ?></th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="col-md-9">
        <div class="input-group">
            <div id="astcmd-scrollable-dropdown-menu">
                <input type="text" class="form-control typeaheadd" id="astcmd">
            </div>
            <span class="input-group-btn">
                <button class="btn btn-default" id="send" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i> go </button>
            </span>
        </div>
    </div>
</div>