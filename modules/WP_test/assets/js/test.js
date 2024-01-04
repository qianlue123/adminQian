var selectMap = new Map();
var selectBox1 = document.getElementById('Extension1_forceout');
var selectBox2 = document.getElementById('Extension2_forceout');

/**
 * 刷新页面时自动加载
 */
window.onload = function () {
  // 选择分机用的下拉单选框, 里面的选项都是在刷新页面时从数据库导入
  for (let i = 0; i < selectBox1.options.length; ++i) {
    selectMap.set(selectBox1.options[i].value, selectBox1.options[i].text);
  }
};

/**
 * 打开分机选择框时，把所有分机增加到选项里
 * 第一个选择框数据查表，第2个框数据简接从第1个选择框中过滤
 * 
 * ps: 第 2 个选项框始终比它少 1 个选项
 */
document.getElementById('Extension2_forceout').addEventListener('mousedown', function () {
  // 先清空。不要用 for + length 那一套，容易清不干净
  while (selectBox2.firstChild) {
    selectBox2.removeChild(selectBox2.firstChild);
  }

  // 过滤掉第一个选项框已经选了的分机
  var box1val = selectBox1[selectBox1.selectedIndex].value;
  for (let [k, v] of selectMap) {
    if (k != box1val) {
      selectBox2.options.add(new Option(v, k))
    }
  }
});

// 打开分机选择框时，读取数据库，把正在通话的分机增加到选项里（不是所有）
document.getElementById('Extension_List').addEventListener('mousedown', function () {

});

document.addEventListener('DOMContentLoaded', btn_create);
function btn_create() {
  var btn = document.getElementById("create-extension");
  btn.onclick = function () {
    // 创建连接
    alert("111");
  }
}

document.addEventListener('DOMContentLoaded', joinStr);

function joinStr() {
  var btn = document.getElementById("btnSend");
  btn.addEventListener("click", function () {

    let toolName = document.getElementById("scanf_name").value;
    let lines = document.getElementById("scanf_lines").value;
    console.log(toolName, lines);
    alert("按钮被点击了！" + toolName, lines);
    resultText = document.getElementById("resultText");
  });
}
