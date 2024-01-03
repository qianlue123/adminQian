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
    <h1 class="section-title" data-for="asteriskcli"> 话机强拆 </h1>

    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $helptext1 ?>.
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
            <button class="btn btn-sm btn-danger" id="btn_forceout" type="button"> 强 拆 </button>
            </span>
        </div>
    </div>
</div>