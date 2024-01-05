<?php
if (!defined('FREEPBX_IS_AUTH')) {
    die('No direct script access allowed');
}

require_once('/etc/freepbx.conf');
global $db;

$ver_Asterisk = 0;
# get asterisk version from mysql
$sql = "SELECT value From asterisk.freepbx_settings 
        WHERE keyword='ASTVERSION'; ";
$res = $db->prepare($sql);
$res->execute();
if (DB::IsError($res)) {
    error_log("There was an error attempting to query <br>($sql)<br>\n" . $res->getMessage() . "\n<br>\n");
} else {
    $contacts = $res->fetchAll(PDO::FETCH_ASSOC);
    foreach ($contacts as $i => $contact) {
        # 这样遍历不影响, 虽然是刷新, 其实里面只有一个值
        $ver_Asterisk = $contact["value"];
    }
}

?>

<div class="element-container">
    <div class="row col-md-12">
        <div class="form-group">
            <div class="col-md-2">
                <label class="control-label"> Asterisk 版本 </label>
                <b id="icon-help" class="fa fa-question-circle"></b>
            </div>
            <div class="col-md-1">
                <?php
                echo " " . $ver_Asterisk
                ?>
            </div>
            <div id="text-show" style="visibility: hidden;" class="col-md-9">
                <span class="help-block fpbx-help-block">
                    确认 freepbx 自带的asterisk是什么版本。
                </span>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    <?php # 鼠标放到帮助图标上的时候, 显示和隐藏提示语 
    ?>
    var iconhelp = document.getElementById("icon-help");
    iconhelp.onmouseover = function() {
        var textDiv = document.getElementById("text-show");
        if (textDiv.style.visibility === "hidden") {
            textDiv.style.visibility = "visible";
        }
    }
    iconhelp.onmouseleave = function() {
        var textDiv = document.getElementById("text-show");
        textDiv.style.visibility = "hidden";
    }
</script>