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
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo U('user/index');?>"><?php echo L('ADMIN_USER_INDEX');?></a></li>
			<li><a href="<?php echo U('user/add');?>"><?php echo L('ADMIN_USER_ADD');?></a></li>
		</ul>
        <form class="well form-search" method="post" action="<?php echo U('User/index');?>">
            用户名:
            <input type="text" name="user_login" style="width: 100px;" value="<?php echo I('request.user_login/s','');?>" placeholder="请输入<?php echo L('USERNAME');?>">
			&nbsp;&nbsp;
            <input type="submit" class="btn btn-primary" value="查询" />
            <a class="btn btn-danger" href="<?php echo U('User/index');?>">清空</a>
        </form>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th style="min-width: 50px;text-align: center;">ID</th>
					<th style="min-width: 80px;text-align: center;"><?php echo L('USERNAME');?></th>
					<th style="min-width: 80px;text-align: center;"><?php echo L('LAST_LOGIN_IP');?></th>
					<th style="min-width: 100px;text-align: center;"><?php echo L('LAST_LOGIN_TIME');?></th>
					<th style="min-width: 80px;text-align: center;"><?php echo L('STATUS');?></th>
					<th style="min-width: 150px;text-align: center;"><?php echo L('ACTIONS');?></th>
				</tr>
			</thead>
			<tbody>
				<?php $user_statuses=array("0"=>L('USER_STATUS_BLOCKED'),"1"=>L('USER_STATUS_ACTIVATED'),"2"=>L('USER_STATUS_UNVERIFIED')); ?>
				<?php if(is_array($users)): foreach($users as $key=>$vo): ?><tr>
					<td style="text-align: center;"><?php echo ($vo["id"]); ?></td>
					<td style="text-align: center;"><?php echo ($vo["user_login"]); ?></td>
					<td style="text-align: center;"><?php echo ($vo["last_login_ip"]); ?></td>
					<td style="text-align: center;">
						<?php if($vo['last_login_time'] == 0): echo L('USER_HAVENOT_LOGIN');?>
						<?php else: ?>
							<?php echo ($vo["last_login_time"]); endif; ?>
					</td>
					<td style="text-align: center;"><?php echo ($user_statuses[$vo['user_status']]); ?></td>
					<td style="text-align: center;">
						<?php if($vo['id'] == 1 || $vo['id'] == sp_get_current_admin_id()): if($vo['user_status'] == 1): ?><font class="btn btn-primary" style="padding: 2px 15px;color: white;background-color: #cccccc;">冻结</font>
							<?php else: ?>
								<font class="btn btn-primary" style="padding: 2px 15px;color: white;background-color: #cccccc;">解冻</font><?php endif; ?>
							<font class="btn btn-primary " style="padding: 2px 15px;color: white;background-color: #cccccc;"><?php echo L('EDIT');?></font> 
					    	<font class="btn btn-primary " style="padding: 2px 15px;color: white;background-color: #cccccc;"><?php echo L('DELETE');?></font>
						<?php else: ?>
							
							<?php if($vo['user_status'] == 1): ?><a href="<?php echo U('user/ban',array('id'=>$vo['id']));?>" class="btn btn-primary js-ajax-dialog-btn" style="padding: 2px 15px;color: white;background-color: #1dccaa;" data-msg="<?php echo L('BLOCK_USER_CONFIRM_MESSAGE');?>">冻结</a>  
							<?php else: ?>
								<a href="<?php echo U('user/cancelban',array('id'=>$vo['id']));?>" class="btn btn-primary js-ajax-dialog-btn" style="padding: 2px 15px;color: white;background-color: #1dccaa;" data-msg="<?php echo L('ACTIVATE_USER_CONFIRM_MESSAGE');?>">解冻</a><?php endif; ?>
							<a href='<?php echo U("user/edit",array("id"=>$vo["id"]));?>' class="btn btn-primary" style="padding: 2px 15px;color: white;background-color: #1dccaa;"><?php echo L('EDIT');?></a> 
							<a class="btn btn-primary js-ajax-delete" href="<?php echo U('user/delete',array('id'=>$vo['id']));?>" style="padding: 2px 15px;color: white;background-color: #1dccaa;"><?php echo L('DELETE');?></a><?php endif; ?>
					</td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
		<div class="pagination" style="float: right;"><?php echo ($page); ?></div>
	</div>
	<script src="/public/js/common.js"></script>
</body>
</html>