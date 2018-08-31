<?php
// +----------------------------------------------------------------------
// | ThinkCMF 客户管理板块
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Tuolaji <479923197@qq.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Common\Controller\AdminbaseController;
class MemberController extends AdminbaseController {
	// 后台客户管理列表
	public function index(){				
		$where=array();	
		$this->member =M('member');
		$keyword=I('keyword','','trim');
		$mobile=I('mobile','','trim');

		if(!empty($keyword)){
		    $where['nicename']=array('like',"%$keyword%");
		}
		if(!empty($mobile)){
		    $where['mobile']=array('like',"%$mobile%");
		}
        
		$count=$this->member->where($where)->count();			
		$page = $this->page($count, 20);			
		$member=$this->member
				->where($where)
				->limit($page->firstRow , $page->listRows)
				->order($order)
				->select();
		$this->assign("page", $page->show('Admin'));
		$this->assign("formget",array_merge($_GET,$_POST));
		$this->assign("member",$member);
		$this->display();
	}	
    public function add()
    {
        $this->display();
    }
    public function add_post()
    {
        if(IS_POST)
        {
            $pdata =I('post.');
            if(empty($pdata['nicename']))
            {
                $this->ajaxReturn(array('status'=>1,'msg'=>'请输入姓名'));
            }
            if(empty($pdata['mobile']))
            {
                $this->ajaxReturn(array('status'=>1,'msg'=>'请输入姓名'));
            }else
            {
                if(!preg_match('/^1[345789]{1}\d{9}$/', $pdata['mobile']))
                {
                    $this->ajaxReturn(array('status'=>1,'msg'=>'手机号格式有误'));
                }
            }
            $count =M('member')->where("mobile='".$pdata['mobile']."'")->count();
            if($count > 0)
            {
                $this->ajaxReturn(array('status'=>1,'msg'=>'手机号已经注册'));
            }
            $pdata['addtime']=time();
            $pdata['password'] = sp_password(123456);
            $result= M('member')->add($pdata);
            if($result)
            {
                $this->ajaxReturn(array('status'=>0,'msg'=>'添加成功'));            
            }else
            {
                $this->ajaxReturn(array('status'=>1,'msg'=>'添加失败')); 
            }
        }
    }
    public function edit()
    {
        $id =I('id','','intval');
        if($id)
        {
            $member =M('member')->find($id);
            $this->assign('member',$member);
            $this->display();
        }
    }
    // 查看会员详情
    public function detail()
    {
        if(isset($_GET['id'])){
            $id = I("get.id",0,'intval');
            $member =M('member')->find($id);
            $this->assign('member',$member);
        }
        $this->display();
    }
    public function edit_post()
    {
        if(IS_POST)
        {
            $pdata =I('post.');
            if(empty($pdata['nicename']))
            {
                $this->ajaxReturn(array('status'=>1,'msg'=>'请输入姓名'));
            }
            if(empty($pdata['mobile']))
            {
                $this->ajaxReturn(array('status'=>1,'msg'=>'请输入姓名'));
            }else
            {
                if(!preg_match('/^1[345789]{1}\d{9}$/', $pdata['mobile']))
                {
                    $this->ajaxReturn(array('status'=>1,'msg'=>'手机号格式有误'));
                }
            }
            if($pdata['oldmobile'] != $pdata['mobile'])
            {
                $count =M('member')->where("mobile='".$pdata['mobile']."'")->count();
                if($count > 0)
                {
                    $this->ajaxReturn(array('status'=>1,'msg'=>'手机号已经注册'));
                }
            }
            
            $result= M('member')->where("id='".$pdata['id']."'")->save($pdata);
           
            $this->ajaxReturn(array('status'=>0,'msg'=>'编辑成功'));            
            
        }
    }
    public function delete(){
        if(isset($_GET['id'])){
            $id = I("get.id",0,'intval');
            if (M('member')->where(array('id'=>$id))->delete() !==false) {
                $this->success("删除成功！");
            } else {
                $this->error("删除失败！");
            }
        }
        
    }
    public function ban(){
        $id = I('get.id',0,'intval');
    	if (!empty($id)) {
    		$result = M('member')->where(array("id"=>$id))->setField('status','0');
    		if ($result!==false) {
    			$this->success("冻结成功！", U("member/index"));
    		} else {
    			$this->error('冻结失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
    public function cancelban(){
    	$id = I('get.id',0,'intval');
    	if (!empty($id)) {
    		$result = M('member')->where(array("id"=>$id))->setField('status','1');
    		if ($result!==false) {
    			$this->success("解冻成功！", U("member/index"));
    		} else {
    			$this->error('解冻失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
    
	
}