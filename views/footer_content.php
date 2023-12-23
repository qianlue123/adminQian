<?php
global $amp_conf;
$html = '';
// $version = '16.0.33'
$version	 = get_framework_version();
$version = $version ? $version : getversion();
$version_tag = '?load_version=' . urlencode($version);
if ($amp_conf['FORCE_JS_CSS_IMG_DOWNLOAD']) {
  $this_time_append	= '.' . time();
  $version_tag 		.= $this_time_append;
} else {
	$this_time_append = '';
}

$baseUrl = isset($baseUrl) ? $baseUrl : "";

// Brandable logos in footer
// 去掉页脚左侧图片
$html .= '<div class="col-md-4">
	</div>';

//text
// 这块文本的样式表 footer_text 可能失效了，虽然在 /ucp/htdocs/assets/less/ucp/page.less 里有一个同名
$html .= '<div class="col-md-4" id="Qian_footer_text">';
$html .= 'QianPBX belongs to <a href="http://www.qianlue.cn/" target="_blank"> Qianlue Tech.</a>' 
         . br();
$html .= 'Happy &copy '.date('Y',time()).'</a>';

//module license
if (!empty($active_modules[$module_name]['license'])) {
  $html .= br() . sprintf(_('Current module licensed under %s'),
  trim($active_modules[$module_name]['license']));
}

//benchmarking
if (isset($amp_conf['DEVEL']) && $amp_conf['DEVEL']) {
	$benchmark_time = number_format(microtime_float() - $benchmark_starttime, 4);
	$html .= '<br><span id="benchmark_time">Page loaded in ' . $benchmark_time . 's</span>';
}
$html .= '</div>';

// 右侧图片显示, 删除后中间子块宽度变窄
$html .= '<div class="col-md-4">
	</div>';
echo $html;
?>
