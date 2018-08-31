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
			<li class="active"><a href="javascript:;">新增会员</a></li>
		</ul>
		<form class="form-horizontal" id="tagforms" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="control-group">
					<label class="control-label">姓名：</label>
					<div class="controls">
						<input type="text" name="nicename" maxlength="20" value="<?php echo ($member["nicename"]); ?>" placeholder="输入姓名">
					</div>
				</div>	
				<div class="control-group">
					<label class="control-label">手机号：</label>
					<div class="controls">
						<input type="text" name="mobile" maxlength="11" value="<?php echo ($member["mobile"]); ?>" placeholder="输入手机号">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">所属公司：</label>
					<div class="controls">
						<div>
							<input type="radio" style="margin-top: -2px;" name="address" value="1" <?php if($member['address'] == 1): ?>checked<?php endif; ?>>
							<span style="margin-left: 5px;">重庆心联宇科技有限公司 <br/>重庆市渝中区大坪万科中心4栋30-17</span>
						</div><br/>
						<div>
							<input type="radio" name="address" value="2" <?php if($member['address'] == 2): ?>checked<?php endif; ?>>
							<span style="margin-left: 5px;">成都迪英特科技有限公司 <br/>四川省成都市金牛区二环路北一段111号创新中心</span>
						</div>
					</div>
				</div>						
			</fieldset>
			<div class="form-actions">
				<input type="hidden" name="id" value="<?php echo ($member["id"]); ?>">
				<input type="hidden" name="oldmobile" value="<?php echo ($member["mobile"]); ?>">
				<input type="button" @click="add()" class="btn btn-primary" value="保存"/>
				<a class="btn" href="javascript:history.back(-1);"><?php echo L('BACK');?></a>
			</div>
		</form>
	</div>
	<script type="text/javascript" src="/public/js/common.js"></script>
	<script src="/public/js/vue.js"></script>
	<script src="/public/js/content_addtop.js"></script>
	<script src="/public/js/define_my.js"></script>
	<script src="/public/js/artDialog/artDialog.js"></script>
	<script>
		var app = new Vue({
			el:"#app",
			data:{
				info:{},				
			},
			created:function () {
			},
			methods:{
				add:function () {	
				     var tagvals=$('#tagforms').serialize();				
					$.ajax({
						url:'<?php echo U("Admin/Member/edit_post");?>',
						data:tagvals,
						type:"POST",
						dataType:"json",
						success:function (res) {							
							if(res.status==0){
								$.dialog({id: 'popup', lock: true,icon:"succeed", content: res.msg, time: 2});
								setInterval(function(){
									location.href='<?php echo U("Admin/Member/index");?>';
								},3000)
							}
							else {
								$.dialog({id: 'popup', lock: true,icon:"warning", content: res.msg, time: 2});
							}
						}

					})
				}
			}
		});	

	</script>
</body>
</html>