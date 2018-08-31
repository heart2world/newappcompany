<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/public/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/public/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/public/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
	<script type="text/javascript">
	//全局变量
	var GV = {
	    ROOT: "/",
	    WEB_ROOT: "/",
	    JS_ROOT: "public/js/",
	    APP:'<?php echo (MODULE_NAME); ?>'/*当前应用名*/
	};
	</script>
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/wind.js"></script>
    <script src="/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
    <script>
    	$(function(){
    		$("[data-toggle='tooltip']").tooltip();
    	});
    </script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
<style type="text/css">
.pic-list li {
	margin-bottom: 5px;
}
</style>
</head>
<body>
	<div class="wrap js-check-wrap" id="app">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo U('Member/index');?>">会员列表</a></li>
			<li class="active"><a href="javascript:;">会员详情</a></li>
		</ul>
		<form class="form-horizontal" id="tagforms" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="control-group">
					<label class="control-label">头像：</label>
					<div class="controls">
						<?php if($member['avatar'] != ''): ?><img src="<?php echo ($member["avatar"]); ?>" style="width: 100px;" />
						<?php else: ?>
							<img src="/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png" style="width: 100px;" /><?php endif; ?>
					</div>
				</div>	
				<div class="control-group">
					<label class="control-label">姓名：</label>
					<div class="controls" style="margin-top: 5px;">
						<span><?php echo ($member["nicename"]); ?></span>
					</div>
				</div>	
				<div class="control-group">
					<label class="control-label">手机号：</label>
					<div class="controls" style="margin-top: 5px;">
						<span><?php echo ($member["mobile"]); ?></span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">职务：</label>
					<div class="controls" style="margin-top: 5px;">
						<span><?php if($member['duty'] != ''): echo ($member["duty"]); else: ?>未填写<?php endif; ?></span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">邮箱：</label>
					<div class="controls" style="margin-top: 5px;">
						<span><?php if($member['email'] != ''): echo ($member["email"]); else: ?>未填写<?php endif; ?></span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">所属公司：</label>
					<div class="controls">
						<?php if($member['address'] == 1): ?><div>
							<span style="margin-left: 5px;">重庆心联宇科技有限公司 <br/>重庆市渝中区大坪万科中心4栋30-17</span>
						</div>
						<?php else: ?>
						<div>
							<span style="margin-left: 5px;">成都迪英特科技有限公司 <br/>四川省成都市金牛区二环路北一段111号创新中心</span>
						</div><?php endif; ?>
					</div>
				</div>	
				<hr/>				
			</fieldset>
		</form>
	</div>
	<script type="text/javascript" src="/public/js/common.js"></script>
</body>
</html>