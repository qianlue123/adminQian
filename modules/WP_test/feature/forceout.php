<?php # 提供话机的强拆功能

# <div class="fpbx-container col-md-9"> 此处不写, 写在调用文件

function generate_selectoption()
{
    global $conn;
    global $selectMap;
    $result = mysqli_query($conn, "select * from devices;");
    if ($result) {
        $countExtension = mysqli_num_rows($result);
        // echo " " .$countExtension;
    }
    while ($row = $result->fetch_assoc()) {
        $extensionID = $row["id"];
        $name = $row["description"];
        // 单引号双引号太多，只能用 echo 比较繁杂，不好用。
        // echo "<option value='$ExtensionID'>$name ($extensionID) </option>";
        printf("<option value=\"%s\"> %s (%s) </option>", $extensionID, $name, $extensionID);
    }
}

?>

<div class="display full-border">
    <div class="row col-md-3">
        <h1 class="section-title" data-for="asteriskcli">话机强拆
            <b id="iconhelp-forceout" class="fa fa-question-circle"></b>
        </h1>
    </div>
    <div class="row col-md-9">
        <div id="text1-forceout" style="visibility: hidden;" class="alert alert-warning">
            <?php echo $helptext1 ?>.
        </div>
    </div>

    <div class="container-fluid" data-id="asteriskcli">
        <div class="row">
            <div class="col-md-3 group-vertical">
                <span class="label label-info">分机1</span>
                <select name="" id="Extension1_forceout" class="form-control">
                    <?php generate_selectoption(); ?>
                    <!-- <option value="111"> 111 </option> -->
                </select>
            </div>
            <div class="col-md-3 group-vertical">
                <span class="label label-info">分机2</span>
                <select name="" id="Extension2_forceout" class="form-control">

                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9"></div>
            <span class="glyphicon glyphicon-resize-full"></span> &nbsp;
            <button class="btn btn-sm btn-danger" id="btn-forceout" type="button"> 强 拆 </button>
            </span>
        </div>
        <div class="cmdresult-forceout"></div>
    </div>
</div>

<script type="text/javascript">
    $('#btn-forceout').click(function() {
        var box_output = $('div.cmdresult-forceout');
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

    var iconhelp = document.getElementById("iconhelp-forceout");
    iconhelp.onmouseover = function() {
        var textDiv = document.getElementById("text1-forceout");
        if (textDiv.style.visibility === "hidden") {
            textDiv.style.visibility = "visible";
        }
    }
    iconhelp.onmouseleave = function() {
        var textDiv = document.getElementById("text1-forceout");
        textDiv.style.visibility = "hidden";
    }
</script>