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
			<li class="active"><a href="javascript:;"><?php echo L('PORTAL_ADMINPOST_INDEX');?></a></li>
			<li><a href="<?php echo U('AdminPost/add',array('term'=>empty($term['term_id'])?'':$term['term_id']));?>" target="_self"><?php echo L('PORTAL_ADMINPOST_ADD');?></a></li>
		</ul>
		<form class="well form-search" method="post" action="<?php echo U('AdminPost/index');?>">
			选择分类： 
			<select name="term" style="width: 120px;">
				<option value='0'>全部</option><?php echo ($taxonomys); ?>
			</select> &nbsp;&nbsp;
			关键字： 
			<input type="text" name="keyword" style="width: 120px;" value="<?php echo ((isset($formget["keyword"]) && ($formget["keyword"] !== ""))?($formget["keyword"]):''); ?>" placeholder="请输入关键字...">&nbsp; &nbsp;
			时间：
			<input type="text" name="start_time" class="js-date" value="<?php echo ((isset($formget["start_time"]) && ($formget["start_time"] !== ""))?($formget["start_time"]):''); ?>" style="width: 120px;" autocomplete="off">-
			<input type="text" class="js-date" name="end_time" value="<?php echo ((isset($formget["end_time"]) && ($formget["end_time"] !== ""))?($formget["end_time"]):''); ?>" style="width: 120px;" autocomplete="off"> &nbsp; &nbsp;
			
			<input type="submit" class="btn btn-primary" value="查询" />
			<a class="btn btn-danger" href="<?php echo U('AdminPost/index');?>">清空</a>
		</form>
		<form class="js-ajax-form" action="" method="post">
			<table class="table table-hover table-bordered table-list">
				<thead>
					<tr>
						<th style="min-width: 50px;text-align: center;">ID</th>
						<th style="min-width: 100px;text-align: center;"><?php echo L('TITLE');?></th>
						<th style="min-width: 50px;text-align: center;">分类名称</th>
						<th style="min-width: 120px;text-align: center;">缩略图</th>
						<th style="min-width: 120px;text-align: center;">功能描述</th>
						<th style="min-width: 50px;text-align: center;">关注度</th>
						<th style="min-width: 50px;text-align: center;">点赞</th>
						<th style="min-width: 50px;text-align: center;">排序</th>
						<th style="min-width: 80px;text-align: center;">添加时间</th>
						<th style="min-width: 100px;text-align: center;"><?php echo L('ACTIONS');?></th>
					</tr>
				</thead>
				<?php if(is_array($posts)): foreach($posts as $key=>$vo): ?><tr>
                    <td style="text-align: center;"><b><?php echo ($vo["id"]); ?></b></td>
					<td style="text-align: center;"><?php echo ($vo["post_title"]); ?></td>
					<td style="text-align: center;"><?php echo ($vo["cat_name"]); ?></td>
					<td style="text-align: center;"><img src="<?php echo ($vo["smeta"]); ?>" style="width: 120px;"></td>
					<td style="text-align: center;"><?php echo ($vo["post_excerpt"]); ?></td>
					<td style="text-align: center;"><?php echo ($vo["agentcount"]); ?></td>
					<td style="text-align: center;"><?php echo ($vo["likecount"]); ?></td>
					<td style="text-align: center;"><?php echo ($vo["sort"]); ?></td>
					<td style="text-align: center;"><?php echo date('Y-m-d H:i:s',strtotime($vo['post_date']));?></td>
					<td style="text-align: center;">
						<a href="<?php echo U('AdminPost/edit',array('id'=>$vo['id']));?>" class=" btn btn-primary" style="padding: 2px 15px;color: white;background-color: #1dccaa;"><?php echo L('EDIT');?></a> 
						<a href="<?php echo U('AdminPost/delete',array('id'=>$vo['id']));?>" class="btn btn-primary js-ajax-delete" style="padding: 2px 15px;color: white;background-color: #1dccaa;"><?php echo L('DELETE');?></a>
					</td>
				</tr><?php endforeach; endif; ?>
			</table>
			<div class="pagination" style="float: right;"><?php echo ($page); ?></div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
	<script>
		function refersh_window() {
			var refersh_time = getCookie('refersh_time');
			if (refersh_time == 1) {
				window.location = "<?php echo U('AdminPost/index',$formget);?>";
			}
		}
		setInterval(function() {
			refersh_window();
		}, 2000);
		$(function() {
			setCookie("refersh_time", 0);
			Wind.use('ajaxForm', 'artDialog', 'iframeTools', function() {
				//批量复制
				$('.js-articles-copy').click(function(e) {
					var ids=[];
					$("input[name='ids[]']").each(function() {
						if ($(this).is(':checked')) {
							ids.push($(this).val());
						}
					});
					
					if (ids.length == 0) {
						art.dialog.through({
							id : 'error',
							icon : 'error',
							content : '您没有勾选信息，无法进行操作！',
							cancelVal : '关闭',
							cancel : true
						});
						return false;
					}
					
					ids= ids.join(',');
					art.dialog.open("/index.php?g=portal&m=AdminPost&a=copy&ids="+ ids, {
						title : "批量复制",
						width : "300px"
					});
				});
				//批量移动
				$('.js-articles-move').click(function(e) {
					var ids=[];
					$("input[name='ids[]']").each(function() {
						if ($(this).is(':checked')) {
							ids.push($(this).val());
						}
					});
					
					if (ids.length == 0) {
						art.dialog.through({
							id : 'error',
							icon : 'error',
							content : '您没有勾选信息，无法进行操作！',
							cancelVal : '关闭',
							cancel : true
						});
						return false;
					}
					
					ids= ids.join(',');
					art.dialog.open("/index.php?g=portal&m=AdminPost&a=move&old_term_id=<?php echo ((isset($term["term_id"]) && ($term["term_id"] !== ""))?($term["term_id"]):0); ?>&ids="+ ids, {
						title : "批量移动",
						width : "300px"
					});
				});
			});
		});
	</script>
</body>
</html>