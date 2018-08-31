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
			<li><a href="<?php echo U('AdminPost/index');?>"><?php echo L('PORTAL_ADMINPOST_INDEX');?></a></li>
			<li class="active"><a href="javascript:;"><?php echo L('PORTAL_ADMINPOST_ADD');?></a></li>
		</ul>
		<form class="form-horizontal" id="tagforms" method="post" enctype="multipart/form-data">
			<div class="row-fluid">
				<div class="span9">
					<table class="table table-bordered">
						<tr>
							<th width="80">分类</th>
							<td>
								<select  style="max-height: 100px;" name="post[term]">
									<option value="">选择分类</option>
									<?php if(is_array($terms)): $i = 0; $__LIST__ = $terms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$va): $mod = ($i % 2 );++$i;?><option value="<?php echo ($va["term_id"]); ?>"><?php echo ($va["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</td>
						</tr>
						<tr>
							<th>标题</th>
							<td>
								<input type="text" style="width:300px;" name="post[post_title]" id="title"  value="" maxlength="20" placeholder="标题限20字以内"/>	
							</td>
						</tr><tr>
							<th>功能描述</th>
							<td>
								<textarea name="post[post_excerpt]" id="description" style="width: 80%; height: 50px;" placeholder="请填写功能描述"></textarea>
							</td>
						</tr>						
						<tr>
							<th>案例内容</th>
							<td>
								<script type="text/plain" id="content" name="post[post_content]"></script>
							</td>
						</tr>
						
					</table>
				</div>
				<div class="span3">
					<table class="table table-bordered">
						<tr>
							<th><b>缩略图</b></th>
						</tr>
						<tr>
							<td>
								<div style="text-align: center;">
									<input type="hidden" name="smeta[thumb]" id="thumb" value="">
									<a href="javascript:upload_one_image('图片上传','#thumb');">
										<img src="/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png" id="thumb-preview" width="135" style="cursor: hand" />
									</a>
									<input type="button" class="btn btn-small" onclick="$('#thumb-preview').attr('src','/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png');$('#thumb').val('');return false;" value="取消图片">
								</div><br/>
								<div style="margin-left: 10px;color: red;">建议图片尺寸：646*488</div>
							</td>
						</tr>
						<tr>
							<th><b>关注度</b></th>
						</tr>
						<tr>
							<td><input type="number" name="post[agentcount]" id="agentcount" value="0" style="width: 100px" placeholder="请输入关注度数量"></td>
						</tr>
						<tr>
							<th><b>点赞数</b></th>
						</tr>
						<tr>
							<td><input type="number" name="post[likecount]" id="likecount" value="0" style="width: 100px" placeholder="请输入点赞数量"></td>
						</tr>
						<tr>
							<th><b>排序</b></th>
						</tr>
						<tr>
							<td><input type="number" name="post[sort]" id="sort" value="0" style="width: 100px" placeholder="请输入排序号"></td>
						</tr>
						<tr>
							<th><b>发布时间</b></th>
						</tr>
						<tr>
							<td><input type="text" name="post[post_date]" value="<?php echo date('Y-m-d H:i:s',time());?>" class="js-date" style="width: 160px;"></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="form-actions">
				<input type="button" @click="add()" class="btn btn-primary" value="保存"/>
				<a class="btn" href="<?php echo U('AdminPost/index');?>">返回</a>
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
						url:'<?php echo U("AdminPost/add_post");?>',
						data:tagvals,
						type:"POST",
						dataType:"json",
						success:function (res) {							
							if(res.status==0){
								$.dialog({id: 'popup', lock: true,icon:"succeed", content: res.msg, time: 2});
								setInterval(function(){
									location.href='<?php echo U("AdminPost/index");?>';
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
	<script type="text/javascript">
		//编辑器路径定义
		var editorURL = GV.WEB_ROOT;
	</script>
	<script type="text/javascript" src="/public/js/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="/public/js/ueditor/ueditor.all.min.js"></script>
	<script type="text/javascript">
		$(function() {
			Wind.use('validate','artDialog', function() {
				//javascript

				//编辑器
				editorcontent = new baidu.editor.ui.Editor();
				editorcontent.render('content');
				try {
					editorcontent.sync();
				} catch (err) {
				}
				//增加编辑器验证规则
				jQuery.validator.addMethod('editorcontent', function() {
					try {
						editorcontent.sync();
					} catch (err) {
					}
					return editorcontent.hasContents();
				});
			});
			////-------------------------
		});
	</script>
	
</body>
</html>