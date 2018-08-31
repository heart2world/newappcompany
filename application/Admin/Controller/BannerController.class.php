<?php
// +----------------------------------------------------------------------
// | ThinkCMF 轮播图管理板块
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Tuolaji <479923197@qq.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Common\Controller\AdminbaseController;
class BannerController extends AdminbaseController {
	// 后台轮播图管理列表
	public function index(){				
		$where=array();	
		$this->posts_model =M('banner');

		$keyword=I('request.keyword');
		$termid=I('request.termid');
		if(!empty($keyword)){
		    $where['title']=array('like',"%$keyword%");
		}
		if(!empty($termid)){
		    $where['termid']=$termid;
		}
		$count=$this->posts_model->where($where)->count();
			
		$page = $this->page($count, 20);
			
		$posts=$this->posts_model
		->where($where)
		->limit($page->firstRow , $page->listRows)
		->order("sortorder ASC")
		->select();
		
		foreach ($posts as $key => $value) {
			if($value['post_img'])
			{
				$posts[$key]['post_img2'] ='http://'.$_SERVER['HTTP_HOST'].'/'.$value['post_img'];
			}
			$posts[$key]['cat_name'] =M('terms')->where("term_id='".$value['termid']."'")->getField('name');
			if($value['atype'] == 2)
			{
				$posts[$key]['url_link'] =M('posts')->where("id='".$value['url_link']."'")->getField('post_title');
			}
		}
		$list=M('terms')->field('term_id,name')->select();
		$this->assign('term',$list);
		$this->assign("page", $page->show('Admin'));
		$this->assign("formget",array_merge($_GET,$_POST));
		$this->assign("posts",$posts);
		$this->display();
	}
	
	// 轮播图添加
	public function add(){
		
		$list=M('terms')->field('term_id,name')->select();
		$this->assign('term',$list);

		$plist =M('posts')->field("id,post_title")->select();
		$this->assign('plist',$plist);
		$this->display();
	}
	
	// 轮播图添加提交
	public function add_post(){
		if (IS_POST) {
			$pdata =I('post.');
			$article=array();
			if(empty($pdata['title']))
			{
				$this->ajaxReturn(array('msg'=>"请输入标题",'status'=>1));
			}
			if(empty($pdata['termid']))
			{
				$this->ajaxReturn(array('msg'=>"请选择分类",'status'=>1));
			}	
			if(empty($pdata['post_img']))
			{
				$this->ajaxReturn(array('msg'=>"请上传图片",'status'=>1));
			}
					
			$article['title']   = strcontentjs($pdata['title']);	
			$article['post_img']=$pdata['post_img'];		
			$article['addtime'] =time();
			$article['termid']  =$pdata['termid'];
			
			$article['atype'] =$pdata['atype'];
			if($pdata['atype'] ==1)
			{
				$article['url_link'] =$pdata['url_link1'];
			}else{
				$article['url_link'] =$pdata['url_link2'];
			}
			$article['sortorder'] =$pdata['sortorder'];
			$result=M('banner')->add($article);
			if ($result) {				
				$this->ajaxReturn(array('msg'=>"添加成功！",'status'=>0));
			} else {
				
				$this->ajaxReturn(array('msg'=>"添加失败！",'status'=>1));
			}
			 
		}
	}
	
	// 轮播图编辑
	public function edit(){
		$id=  I("get.id",0,'intval');
		
		$post=M('banner')->where("id='$id'")->find();
		if($post['post_img'])
		{
			$post['post_img2'] = 'http://'.$_SERVER['HTTP_HOST'].'/'.$post['post_img'];
		}
		$this->assign("post",$post);
		$list=M('terms')->field('term_id,name')->select();
		$this->assign('term',$list);
		$plist =M('posts')->field("id,post_title")->select();
		$this->assign('plist',$plist);
		$this->display();
	}
	
	// 轮播图编辑提交
	public function edit_post(){
		if (IS_POST) {
			
			$pdata=I("post.");		
			
			$article=array();			
			if(empty($pdata['title']))
			{
				$this->ajaxReturn(array('msg'=>"请输入标题",'status'=>1));
			}
			if(empty($pdata['termid']))
			{
				$this->ajaxReturn(array('msg'=>"请选择分类",'status'=>1));
			}	
			if(empty($pdata['post_img']))
			{
				$this->ajaxReturn(array('msg'=>"请上传图片",'status'=>1));
			}
			
			$article['title']   = strcontentjs($pdata['title']);
			$article['termid']  =$pdata['termid'];	
			$article['atype'] =$pdata['atype'];
			$article['post_img']=$pdata['post_img'];
			$article['sortorder'] =$pdata['sortorder'];
			if($pdata['atype'] ==1)
			{
				$article['url_link'] =$pdata['url_link1'];
			}else{
				$article['url_link'] =$pdata['url_link2'];
			}
			$result=M('banner')->where("id='".$pdata['id']."'")->save($article);			
			if ($result!==false) {			
				
				$this->ajaxReturn(array('msg'=>'保存成功！','status'=>0));
			} else {
				$this->ajaxReturn(array('msg'=>'保存失败！','status'=>1));
			}
		}
	}
	
	// 轮播图删除
	public function delete(){
		if(isset($_GET['id'])){
			$id = I("get.id",0,'intval');
			if (M('banner')->where(array('id'=>$id))->delete() !==false) {
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
		}
		
	}
		
    public function ban(){
        $id = I('get.id',0,'intval');
    	if (!empty($id)) {
    		$result = M('banner')->where(array("id"=>$id))->setField('status','0');
    		if ($result!==false) {
    			$this->success("下架成功！", U("Banner/index"));
    		} else {
    			$this->error('下架失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }

   
    public function cancelban(){
    	$id = I('get.id',0,'intval');
    	if (!empty($id)) {
    		$result = M('banner')->where(array("id"=>$id))->setField('status','1');
    		if ($result!==false) {
    			$this->success("上架成功！", U("Banner/index"));
    		} else {
    			$this->error('上架失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
	
}