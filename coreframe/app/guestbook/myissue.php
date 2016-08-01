<?php
// +----------------------------------------------------------------------
// | wuzhicms [ 五指互联网站内容管理系统 ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
defined('IN_WZ') or exit('No direct script access allowed');
load_class('foreground', 'member');
load_class('session');
class myissue extends WUZHI_foreground {
 	function __construct() {
        $this->member = load_class('member', 'member');
        $this->upload  = load_class('UploadFile', 'guestbook');
        load_function('common', 'member');
        $this->member_setting = get_cache('setting', 'member');

        if(!isset($_SESSION['uid'])){
            MSG('请登录......');
        }
        parent::__construct();
    }

	public function listing() {

        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $page = max($page,1);
        $uid = $this->memberinfo['uid'];
        $publisher = $this->memberinfo['username'];
        $result = $this->db->get_list('guestbook', "`publisher`='$publisher'", '*', 0, 20,$page,'id DESC');
        $pages = $this->db->pages;
        $total = $this->db->number;
        include T('guestbook','myissue_listing');
	}
    public function ask() {
        $formdata = array();
        $formdata['title'] = isset($GLOBALS['title']) ? remove_xss($GLOBALS['title']) : strcut($GLOBALS['content'],80);
        $formdata['content'] = $GLOBALS['content'];
        $formdata['addtime'] = SYS_TIME;
        $formdata['publisher'] = $this->memberinfo['username'];
        $formdata['ip'] = get_ip();
        $this->db->insert('guestbook', $formdata);
        MSG('您的提问已经提交，我们的专家会尽快给您回复','?m=guestbook&f=myissue&v=listing');
    }
    public function newask() {
        include T('guestbook','newask');
    }
    //客服中心start
    public function jianyi() {

        $formdata = array();
        $formdata['title'] = isset($GLOBALS['biaoti']) ? remove_xss($GLOBALS['biaoti']) : strcut($GLOBALS['yijian'],80);
        $formdata['content'] = $GLOBALS['yijian'];
        $formdata['yxqf'] = $GLOBALS['qufu'];
        $formdata['player'] = $GLOBALS['player'];
        $formdata['type'] = $GLOBALS['type'];
        $formdata['addtime'] = SYS_TIME;
        $formdata['publisher'] = $this->memberinfo['username'];
        $formdata['ip'] = get_ip();
        $Uploads = $this->upload;
        $Uploads->maxSize  = 3145728 ;// 设置附件上传大小
        $Uploads->allowExts  = array('jpg', 'gif', 'png', 'jpeg', 'zip', 'rar');// 设置附件上传类型
        $Uploads->savePath = './uploadfile/kefu/';
        //print_r($formdata);  exit;
        if (!$Uploads->upload()) {
            //捕获上传异常
            MSG($Uploads->getErrorMsg());
        }else{
            // 上传成功 获取上传文件信息
            $info =  $Uploads->getUploadFileInfo();
            //print_r($info); exit;
            $formdata['url'] = './uploadfile/kefu/'.$info[0]['savename'];
            $this->db->insert('guestbook', $formdata);
            }
        //$this->db->insert('guestbook', $formdata);
        MSG('您的提问已经提交，我们的专家会尽快给您回复','javascript:history.back()');
    }

    public function bug() {

        $formdata = array();
        $formdata['title'] = isset($GLOBALS['bug_biaoti']) ? remove_xss($GLOBALS['bug_biaoti']) : strcut($GLOBALS['bugms'],80);
        $formdata['content'] = $GLOBALS['bugms'];
        $formdata['yxqf'] = $GLOBALS['qufu'];
        $formdata['player'] = $GLOBALS['player'];
        $formdata['type'] = $GLOBALS['type'];
        $formdata['addtime'] = SYS_TIME;
        $formdata['publisher'] = $this->memberinfo['username'];
        $formdata['ip'] = get_ip();
        $Uploads = $this->upload;
        $Uploads->maxSize  = 3145728 ;// 设置附件上传大小
        $Uploads->allowExts  = array('jpg', 'gif', 'png', 'jpeg', 'zip', 'rar');// 设置附件上传类型
        $Uploads->savePath = './uploadfile/kefu/';

        if (!$Uploads->upload()) {
            //捕获上传异常
            MSG($Uploads->getErrorMsg());
        }else{
            // 上传成功 获取上传文件信息
            $info =  $Uploads->getUploadFileInfo();
            //print_r($info); exit;
            $formdata['url'] = './uploadfile/kefu/'.$info[0]['savename'];
            $this->db->insert('guestbook', $formdata);
        }
        //$this->db->insert('guestbook', $formdata);
        MSG('您的提问已经提交，我们的专家会尽快给您回复','javascript:history.back()');
    }

    public function wenti() {
        $formdata = array();
        $formdata['title'] = isset($GLOBALS['wenti_biaoti']) ? remove_xss($GLOBALS['wenti_biaoti']) : strcut($GLOBALS['wentims'],80);
        $formdata['content'] = $GLOBALS['wentims'];
        $formdata['yxqf'] = $GLOBALS['qufu'];
        $formdata['player'] = $GLOBALS['player'];
        $formdata['type'] = $GLOBALS['type'];
        $formdata['addtime'] = SYS_TIME;
        $formdata['publisher'] = $this->memberinfo['username'];
        $formdata['ip'] = get_ip();
        $Uploads = $this->upload;
        $Uploads->maxSize  = 3145728 ;// 设置附件上传大小
        $Uploads->allowExts  = array('jpg', 'gif', 'png', 'jpeg', 'zip', 'rar');// 设置附件上传类型
        $Uploads->savePath = './uploadfile/kefu/';

        if (!$Uploads->upload()) {
            //捕获上传异常
            MSG($Uploads->getErrorMsg());
        }else{
            // 上传成功 获取上传文件信息
            $info =  $Uploads->getUploadFileInfo();
            //print_r($info); exit;
            $formdata['url'] = './uploadfile/kefu/'.$info[0]['savename'];
            $this->db->insert('guestbook', $formdata);
        }
        //$this->db->insert('guestbook', $formdata);
        MSG('您的提问已经提交，我们的专家会尽快给您回复','javascript:history.back()');
    }

    public function jbxx() {
        $formdata = array();
        $formdata['title'] = isset($GLOBALS['wjm']) ? remove_xss($GLOBALS['wjm']) : strcut($GLOBALS['jbtxt'],80);
        $formdata['content'] = $GLOBALS['jbtxt'];
        $formdata['yxqf'] = $GLOBALS['qufu'];
        $formdata['type'] = $GLOBALS['type'];
        $formdata['cjfl'] = $GLOBALS['jubaofl'];
        $formdata['addtime'] = SYS_TIME;
        $formdata['publisher'] = $this->memberinfo['username'];
        $formdata['ip'] = get_ip();

        //print_r($formdata); exit;
        $this->db->insert('guestbook', $formdata);
        MSG('您的提问已经提交，我们的专家会尽快给您回复','javascript:history.back()');
    }

    public function jbwg() {
        $formdata = array();
        $formdata['title'] = isset($GLOBALS['wjm']) ? remove_xss($GLOBALS['wjm']) : strcut($GLOBALS['jbtxt'],80);
        $formdata['content'] = $GLOBALS['jbtxt'];
        $formdata['yxqf'] = $GLOBALS['qufu'];
        $formdata['type'] = $GLOBALS['type'];
        $formdata['cjfl'] = $GLOBALS['changj'];
        $formdata['addtime'] = SYS_TIME;
        $formdata['publisher'] = $this->memberinfo['username'];
        $formdata['ip'] = get_ip();

        //print_r($formdata); exit;
        $this->db->insert('guestbook', $formdata);
        MSG('您的提问已经提交，我们的专家会尽快给您回复','javascript:history.back()');
    }

    public function logintime() {
        $uid = $this->memberinfo['uid'];
        $mid = $this->memberinfo['username'];
        //$mr = $this->db->get_one('member',array('uid'=>$uid),'username');
        $page = isset($GLOBALS['page']) ? intval($GLOBALS['page']) : 1;
        $page = max($page,1);
        $result = $this->db->get_list('logintime', array('uid'=>$uid), '*', 0, 50,$page,'id DESC');
        $pages = $this->db->pages;
        include T('guestbook','loginlisting');
    }

    public function test() {
        //$siteid = get_cookie('siteid');
        //echo time();
        $urlclass = load_class('url','content','');

        $urls = $urlclass->showurl(array('id'=>1,'cid'=>2,'addtime'=>1467612759,'page'=>1));
        //$res = random_string(basic);
        //$res = pages(12,1,20);
        //$res = url_unique('http://192.168.1.119/wuzhicms/www/index.php?m=guestbook&f=myissue&v=test&page=1');
        $res = remove_xss("select display_name from $Schema.members where user_name!='admin'");

        $formdata['name'] = '国际新闻';
        $pinyin = load_class('pinyin');
        $py = $pinyin->return_py($formdata['name']);
        print_r($py);
        
    }




}