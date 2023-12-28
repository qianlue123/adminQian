<?php 
/* 这个里面专门写注释，这样网页源码里就看不到了。不要用 <!-- --> 这个东西
 * 
 * 这个文件的名字和模块是配对的。比如新建一个 test 模块，那么它对应 home页就是 page.test.php
 * 当你在这个文件里写东西的时候，它本身内容会被全部放到页面的
 *     <body> 
 *       <div id="page"> - <div id="page_body"> 这里 </div></div>
 *     <body>
 * 所以不能直接写 html 哦，必须这么干。
 * 
 * author: wangpeng 2023.12.28
 */
?>

<?php
  echo "hello world"
?>
