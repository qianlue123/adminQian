<?php if($errors) {?>
	<span class="obe_error">
		<?php echo _('Please correct the following errors:')?>
		<?php echo ul($errors);?>
	</span>
<?php } ?>
<div id="login_form">
	<form id="loginform" method="post" role="form">
		<h3><?php echo _('To get started, please enter your credentials:')?></h3>
		<div class="form-group">
			<input type="text" name="username" class="form-control" value="" placeholder="username" autocomplete="off">
		</div>
		<div class="form-group">
			<input type="password" name="password" class="form-control" value="" placeholder="password" autocomplete="off">
		</div>
	</form>
</div>
<?php
	if (\FreePBX::Modules()->checkStatus('pbxmfa') && $PBXMFA_LICENSED) {
		$webrootpath = \FreePBX::Config()->get('AMPWEBROOT');
		include $webrootpath . '/admin/modules/pbxmfa/views/mfa/otpModal.php';
	}
?>
<div id="login_icon_holder">
	<div class="login_item_title">
		<a href="#" class="login_item" id="login_admin" style="background-image: url(assets/images/sys-admin.png);"/>&nbsp;</a>
		<span class="login_item_text" style="display: block;width: 160px;text-align: center;">
			管理员后台
		</span>
	</div>
	<?php
	/**
	 *  class="login_item" 提供了背景图片显示能力, 本身 <a> 没有 
	 * 
	 *  TODO: showPopupBox() 用来点击后显示一个技术人员联系方式的小弹出框, 还不会写
	 */ 
	?>
	<div class="login_item_title">
		<a class="login_item" id="login_support" style="background-image: url(assets/images/support.png);"/>&nbsp;</a>
		<span class="login_item_text" style="display: block;width: 160px;text-align: center;">
			<button id="btn_itSupport" onclick="showPopupBox()" >联系技术支持</button>
		</span>
	</div>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<div id="key" style="color: white;font-size:small">
		<?php echo session_id();?>
	</div>
</div>
<script type="text/javascript" src="assets/js/views/login.js"></script>
<?php
	if (\FreePBX::Modules()->checkStatus('userman')) {
?>
	<script type="text/javascript" src='/admin/modules/userman/assets/js/adminPwdExpReminder.js'></script>
<?php
	}
?>