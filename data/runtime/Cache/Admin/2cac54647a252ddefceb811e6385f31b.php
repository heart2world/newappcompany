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
			<li><a href="<?php echo U('Banner/index');?>">轮播图管理</a></li>
			<li class="active"><a href="javascript:;">新增轮播图</a></li>
		</ul>
		<form class="form-horizontal" id="tagforms" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="control-group">
					<label class="control-label">标题：</label>
					<div class="controls">
						<input type="text" name="title" maxlength="20" placeholder="标题限制20字以内">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">分类：</label>
					<div class="controls">
						<select name="termid">
							<option value="">请选择</option>
							<?php if(is_array($term)): $i = 0; $__LIST__ = $term;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$va): $mod = ($i % 2 );++$i;?><option value="<?php echo ($va["term_id"]); ?>"><?php echo ($va["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>						
				<div class="control-group">
					<label class="control-label">图片：</label>
					<div class="controls">
						<input type="hidden" name="post_img" id="thumb" value="">
						<a href="javascript:upload_one_image('图片上传','#thumb');">							
							<img src="/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png" id="thumb-preview" width="100" height="100" style="cursor: hand" />
						</a>
						<input type="button" class="btn btn-small" onclick="$('#thumb-preview').attr('src','/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png');$('#thumb').val('');return false;" value="取消图片">
					</div><br/>
					<div style="margin-left: 180px;color: red;">建议图片尺寸：750*380</div>
				</div>
				<div class="control-group">
					<label class="control-label">排序：</label>
					<div class="controls">
						<input type="text" name="sortorder" maxlength="3" placeholder="请输入排序序号，序号越小越排前面">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">选择类型：</label>
					<div class="controls">
						<input type="radio" style="margin-top: -2px;" name="atype" id="changemylink" checked value="1"> 外链 &nbsp;&nbsp;
						<input type="radio" style="margin-top: -2px;" name="atype" id="changemylink2" value="2"> 详情页
					</div>
				</div>
				<div id="onelist">
				<div class="control-group">
					<label class="control-label">外部链接：</label>
					<div class="controls">
						<input type="text" name="url_link1"  placeholder="须以http://开头">
					</div>
				</div>
				</div>
				<div id="twolist" style="display: none;">
				<div class="control-group">
					<label class="control-label">详情页链接：</label>
					<div class="controls">
						<select name="url_link2">
							<option value="">请选择</option>
							<?php if(is_array($plist)): $i = 0; $__LIST__ = $plist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$va): $mod = ($i % 2 );++$i;?><option value="<?php echo ($va["id"]); ?>"><?php echo ($va["post_title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>
				</div>
			</fieldset>
			<div class="form-actions">
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
	<script type="text/javascript">
	$(function(){
		$("#changemylink").click(function(){
			$("#twolist").hide();
			$("#onelist").show();
		});
		$("#changemylink2").click(function(){
			$("#twolist").show();
			$("#onelist").hide();
		})
	})
	</script>
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
						url:'<?php echo U("Admin/Banner/add_post");?>',
						data:tagvals,
						type:"POST",
						dataType:"json",
						success:function (res) {							
							if(res.status==0){
								$.dialog({id: 'popup', lock: true,icon:"succeed", content: res.msg, time: 2});
								setInterval(function(){
									location.href='<?php echo U("Admin/Banner/index");?>';
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