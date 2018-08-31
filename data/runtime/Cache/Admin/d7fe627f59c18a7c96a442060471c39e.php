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
			<li class="active"><a href="javascript:;">轮播图管理</a></li>
			<li><a href="<?php echo U('Banner/add');?>">添加轮播图</a></li>
		</ul>
		<form class="well form-search" method="post" action="<?php echo U('Banner/index');?>">	
			标题： 
			<input type="text" name="keyword" style="width: 200px;" value="<?php echo ((isset($formget["keyword"]) && ($formget["keyword"] !== ""))?($formget["keyword"]):''); ?>" placeholder="请输入关键字...">&nbsp;&nbsp;
			选择分类：
			<select name="termid" style="width: 120px;">
				<option value="">选择分类</option>
				<?php if(is_array($term)): $i = 0; $__LIST__ = $term;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$va): $mod = ($i % 2 );++$i;?><option value="<?php echo ($va["term_id"]); ?>" <?php if($va['term_id'] == $formget['termid']): ?>selected<?php endif; ?>><?php echo ($va["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>&nbsp;&nbsp;
			<input type="submit" class="btn btn-primary" value="查询" />
			<a class="btn btn-danger" href="<?php echo U('Banner/index');?>">清空</a>
		</form>
		<form class="js-ajax-form" action="" method="post">
			<table class="table table-hover table-bordered table-list">
				<thead>
					<tr>
						<th style="min-width: 50px;text-align: center;">ID</th>
						<th style="min-width: 100px;text-align: center;">标题</th>
						<th style="min-width: 150px;text-align: center;">图片</th>
						<th style="min-width: 100px;text-align: center;">链接</th>
						<th style="min-width: 100px;text-align: center;">分类</th>
						<th style="min-width: 80px;text-align: center;">添加时间</th>
						<th style="min-width: 50px;text-align: center;">状态</th>
						<th style="min-width: 30px;text-align: center;">排序</th>
						<th style="min-width: 200px;text-align: center;">操作</th>
					</tr>
				</thead>
				<?php if(is_array($posts)): foreach($posts as $key=>$vo): ?><tr>
                    <td style="text-align: center;"><b><?php echo ($vo["id"]); ?></b></td>
					<td style="text-align: center;"><?php echo ($vo["title"]); ?></td>
					<td style="text-align: center;"><a herf="<?php echo ($vo["post_img2"]); ?>" target="_blank"><img src="<?php echo ($vo["post_img2"]); ?>" width="100px" /></a></td>
					<td style="text-align: center;"><?php if($vo['atype'] == 1): echo ($vo["url_link"]); else: ?>案例详情-<?php echo ($vo["url_link"]); endif; ?></td>
					<td style="text-align: center;"><?php echo ($vo["cat_name"]); ?></td>
					<td style="text-align: center;"><?php echo date('Y-m-d H:i',$vo['addtime']);?></td>
					<td style="text-align: center;"><?php if($vo['status'] == 1): ?>上架<?php else: ?>下架<?php endif; ?></td>
					<td style="text-align: center;"><?php echo ($vo["sortorder"]); ?></td>
					<td style="text-align: center;">
						<?php if($vo['status'] == 1): ?><a href="<?php echo U('Banner/ban',array('id'=>$vo['id']));?>" class="btn btn-primary js-ajax-dialog-btn" style="padding: 2px 15px;color: white;background-color: #1dccaa;"  data-msg="确认下架该轮播图吗？">下架</a> 
						<?php else: ?>
							<a href="<?php echo U('Banner/cancelban',array('id'=>$vo['id']));?>" class="btn btn-primary js-ajax-dialog-btn" style="padding: 2px 15px;color: white;background-color: #1dccaa;"  data-msg="确认上架该轮播图吗？">上架</a><?php endif; ?> 
						<a href="<?php echo U('Banner/edit',array('id'=>$vo['id']));?>" class="btn btn-primary" style="padding: 2px 15px;color: white;background-color: #1dccaa;"><?php echo L('EDIT');?></a>  
						<a href="<?php echo U('Banner/delete',array('id'=>$vo['id']));?>" class="btn btn-primary js-ajax-delete" style="padding: 2px 15px;color: white;background-color: #1dccaa;"><?php echo L('DELETE');?></a>
					</td>
				</tr><?php endforeach; endif; ?>				
			</table>
			<div class="pagination" style="float: right;"><?php echo ($page); ?></div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
	
</body>
</html>