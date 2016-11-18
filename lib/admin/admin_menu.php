<?php

if (!defined('ROOT'))
    exit('Can\'t Access !');
include_once('version.php');
class admin_menu {
    static $menu=array();
    static function get() {
        if (front::get('mod')) {
            $mod=front::get('mod');
            session::set('mod',$mod);
        }
        if (front::get('act')) {
            $act=front::get('act');
            session::set('act',$act);
        }
        if (front::get('table')) {
            $table=front::get('table');
            session::set('table',$table);
        }
        if (front::get('set')) {
            $set=front::get('set');
            session::set('set',$set);
        }
        if (front::get('tagfrom')) {
            $tagfrom=front::get('tagfrom');
            session::set('tagfrom',$tagfrom);
        }
        if (front::get('item')) {
            $item=front::get('item');
            session::set('item',$item);
        }
        $mod=session::get('mod');
        switch ($mod) {
            case 'system':
                $menu=self::fetch('网站设置,数据库管理,数据维护');
                break;
            case 'config':
            	$menu=self::fetch('网站设置,多站点设置');
                break;
            case 'content':
                $menu=self::fetch('栏目管理,内容管理,分类管理,专题管理');
                break;
            case 'cache':
                $menu=self::fetch('生成管理,手机版生成');
                break;
            case 'order':
                $menu=self::fetch('订单管理');
                break;
            case 'celive':
                $menu=self::fetch('客服系统管理,客服中心,账号管理,生成代码');
                break;
            case 'user':
                $menu=self::fetch('用户管理,用户组管理,推广联盟');
                break;
            case 'func':
                $menu=self::fetch('公告管理,留言评论,投票管理,数据管理,网站安全');
                break;
            case 'defined':
                $menu=self::fetch('自定义字段,自定义表单');
                break;
            case 'help':
                $menu=self::fetch('模板管理,添加标签,标签列表');
                break;
            case 'seo':
                $menu=self::fetch('微信公众号,数据统计,内容链接管理,友情链接管理,邮件管理');
                break;
            case 'map':
                $menu=self::fetch('网站设置,数据库管理,数据维护,内容管理,生成管理,栏目管理,分类管理,专题管理,幻灯片管理,用户管理,用户组管理,公告管理,自定义字段,自定义表单,订单管理,留言管理,专题管理,评论管理,投票管理,数据备份,批量替换,模板管理,添加标签,标签列表,内容链接管理,推广联盟,友情链接管理,统计管理,邮件管理,内容链接管理,推广联盟,友情链接管理,统计管理,邮件管理,系统管理,客服中心,账号管理,生成代码');
                break;
			case 'bbs':
                $menu=self::fetch('论坛专题,帖子管理');
                break;
            default:
                $menu=self::fetch('常用操作');
                break;
        }
        if(empty($menu)){
        	return;
        }
        $menu=array_merge($menu,self::$menu);
        if (front::get('mod')) {
            foreach ($menu as $menu_1) {
                foreach ($menu_1 as $menu_2) {
                    if ($menu_2)
                        break;
                }
                if ($menu_2)
                    break;
            }
            front::redirect($menu_2);
        }
        return $menu;
    }
    static function top() {
    	$arr = array(
             	'设置'=>url::create('index/index/mod/config/system/set/site'),
                '内容'=>url::create('index/index/mod/content'),
                '用户'=>url::create('index/index/mod/user'),
                '订单'=>url::create('index/index/mod/order'),
                '功能'=>url::create('index/index/mod/func'),
                '模板'=>url::create('index/index/mod/help'),
                '营销'=>url::create('index/index/mod/seo'),
                '自定义'=>url::create('index/index/mod/defined'),
                '在线客服'=>url::create('index/index/mod/celive'),
				'论坛'=>url::create('index/index/mod/bbs'),
        );
	    if(!chkpower('config')){
	    	unset($arr['设置']);
	    }
	    if(!chkpower('content')){
	    	unset($arr['内容']);
	    }
	    if(!chkpower('user')){
	    	unset($arr['用户']);
	    }
	    if(!chkpower('order')){
	    	unset($arr['订单']);
	    }
	    if(!chkpower('func')){
	    	unset($arr['功能']);
	    }
	    if(!chkpower('template')){
	    	unset($arr['模板']);
	    }
	    if(!chkpower('seo')){
	    	unset($arr['营销']);
	    }
	    if(!chkpower('defined')){
	    	unset($arr['自定义']);
	    }
        if(!chkpower('celive')){
            unset($arr['在线客服']);
        }
	    if(!chkpower('bbs')){
	    	unset($arr['论坛']);
	    }
    	return $arr;
    }
    static function mod_top() {
        $smod=config::get('mods');
        $smod=explode(',',$smod);
        $_smod1=array();
        if (is_array($smod)) {
            foreach ($smod as $key=>$val) {
                if (file_exists(ROOT.'/lib/mods/'.$val.'/menu_top.php')) {
                    $_smod[$key]=include_once(ROOT.'/lib/mods/'.$val.'/menu_top.php');
                    $_smod1=array_merge($_smod[$key],$_smod1);
                }
            }
            return $_smod1;
        }
        return array();
    }
    static function fetch($string) {
        $names=explode(',',$string);
        $allmenu=self::allmenu();
        $menus=array();
        foreach ($names as $key) {
            $menus[$key]=$allmenu[$key];
        }
        //var_dump($menus);
        return $menus;
    }
    static function allmenu() {
        return $menu=array(
                '常用操作'=>array(
                        '网站设置'=>url::create('index/index/mod/config/system/set/site'),
                        '添加内容'=>url::create('table/add/table/archive'),
                        '订单管理'=>url::create('table/list/table/orders'),
                        '生成HTML'=>url::create('index/index/mod/cache'),
                        '更新缓存'=>url::create('config/remove'),
                ),
                '网站设置'=>array(
                        '网站配置'=>url::create('config/system/set/site'),
                        '水印设置'=>url::create('config/system/set/image'),
                        '附件设置'=>url::create('config/system/set/upload'),
                        '字符过滤'=>url::create('config/system/set/security'),
                        '邮件发送'=>url::create('config/system/set/mail'),
                        '统计配置'=>url::create('config/system/set/cnzz'),
                        '热门标签'=>url::create('config/hottag'),
                        '语言包编辑'=>url::create('language/edit'),
                        '幻灯片设置'=>url::create('config/system/set/slide'),
						'内页切换图片'=>url::create('config/system/set/cslide'),
						'手机幻灯片'=>url::create('config/system/set/wslide'),
						'手机内页图片'=>url::create('config/system/set/wapcslide'),
                        '焦点图设置'=>url::create('config/system/set/ifocus'),
                        '短信设置'=>url::create('config/system/set/sms'),
                        '短信管理'=>url::create('sms/manage'),
						'地图设置'=>url::create('config/system/set/ditu'),
                ),
                '多站点设置'=>array(
                        '站点列表'=>url::create('website/listwebsite'),
                        '增加站点'=>url::create('website/addwebsite'),
                ),
                '数据管理'=>array(
                        '备份数据库'=>url::create('database/baker'),
                        '还原数据库'=>url::create('database/restore'),
                        '备份整站'=>url::create('database/backAll'),
						'导入PHPweb数据'=>url::create('database/phpwebinsert'),
						'替换字符串'=>url::create('database/str_replace'),
						'日志管理'=>url::create('adminlogs/manage'),

                ),
                '内容管理'=>array(
                        '内容列表'=>url::create('table/list/table/archive'),
                        '添加内容'=>url::create('table/add/table/archive'),
                		'批量导入'=>url::create('table/import/table/archive'),
                        '审核内容'=>url::create('table/list/table/archive/needcheck/1'),
                        '推荐位设置'=>url::create('table/setting/table/archive'),
						'热门关键词'=>url::create('index/hotsearch'),
                        '图片管理'=>url::create('image/listdir'),
                		'标签管理'=>url::create('table/list/table/tag'),
                ),
                '内容链接管理'=>array(
                        '链接管理'=>url::create('table/list/table/linkword'),
                        '添加链接'=>url::create('table/add/table/linkword'),
                ),
                '自定义字段'=>array(
                        '内容字段'=>url::create('field/list/table/archive'),
                        '添加内容字段'=>url::create('field/add/table/archive'),
                        '用户字段'=>url::create('field/list/table/user'),
                        '添加用户字段'=>url::create('field/add/table/user'),
                ),
                '栏目管理'=>array(
                        '栏目管理'=>url::create('table/list/table/category'),
                        '添加栏目'=>url::create('table/add/table/category'),
                        '栏目URL规则'=>url::create('table/htmlrule/table/category'),
                		'生成网站地图'=>'index.php?case=cache&act=ctsitemap',
                ),
                '分类管理'=>array(
                        '分类管理'=>url::create('table/list/table/type'),
                        '添加分类'=>url::create('table/add/table/type'),
                ),
                '公告管理'=>array(
                        '公告管理'=>url::create('table/list/table/announcement'),
                        '添加公告'=>url::create('table/add/table/announcement'),
                ),
				'微信公众号'=>array(
						'公众号管理'=>url::create('weixin/list'),
						'添加公众号'=>url::create('weixin/add'),
				),
                '投票管理'=>array(
                        '投票管理'=>url::create('table/list/table/ballot'),
                        '添加投票'=>url::create('table/add/table/ballot'),
                ),
                '数据统计'=>array(
                        '蜘蛛统计'=>url::create('stats/list/table/stats'),
                        'CNZZ全景统计'=>url::create('table/viewcnzz/table/user',true,true),
                ),
                '留言评论'=>array(
                        '留言管理'=>url::create('table/list/table/guestbook'),
                        '评论管理'=>url::create('table/list/table/comment'),
                ),
                '友情链接管理'=>array(
                        '友情链接配置'=>url::create('table/setting/table/friendlink'),
                        '友情链接管理'=>url::create('table/list/table/friendlink'),
                        '添加友情链接'=>url::create('table/add/table/friendlink'),
                ),
                '用户管理'=>array(
                        '用户管理'=>url::create('table/list/table/user'),
                        '添加用户'=>url::create('table/add/table/user'),
                        '登录配置'=>url::create('ologin/list/table/ologin'),
					    '邀请码' => url::create('invite/list'),
                ),
                '用户组管理'=>array(
                        '用户组管理'=>url::create('table/list/table/usergroup'),
                        '添加用户组'=>url::create('table/add/table/usergroup'),
                ),
                '生成管理'=>array(
                        '内容Html生成'=>url::create('cache/make_show'),
                        '栏目Html生成'=>url::create('cache/make_list'),
                        '首页Html生成'=>url::create('cache/make_index'),
                        '分类Html生成'=>url::create('cache/make_type'),
                        '专题Html生成'=>url::create('cache/make_special'),
                        '地区Html生成'=>url::create('cache/make_area'),
                        '标签Html生成'=>url::create('cache/make_tag'),
                        'Google地图生成'=>url::create('cache/make_sitemap_google'),
                        'Baidu地图生成'=>url::create('cache/make_sitemap_baidu'),
				),
				'手机版生成'=>array(
                        '内容Html生成'=>url::create('wapcache/make_show'),
                        '栏目Html生成'=>url::create('wapcache/make_list'),
                        '首页Html生成'=>url::create('wapcache/make_index'),
                        '分类Html生成'=>url::create('wapcache/make_type'),
                        '专题Html生成'=>url::create('wapcache/make_special'),
                        '地区Html生成'=>url::create('wapcache/make_area'),
                        '标签Html生成'=>url::create('wapcache/make_tag'),
                ),
                '标签列表'=>array(
                        '内容标签'=>url::create('table/list/table/templatetag/tagfrom/content'),
                        '栏目标签'=>url::create('table/list/table/templatetag/tagfrom/category'),
                        '自定义标签'=>url::create('table/list/table/templatetag/tagfrom/define'),

                        '手机内容标签'=>url::create('table/list/table/templatetagwap/tagfrom/content'),
                        '手机栏目标签'=>url::create('table/list/table/templatetagwap/tagfrom/category'),
                        '手机自定义标签'=>url::create('table/list/table/templatetagwap/tagfrom/define'),
                ),
                '添加标签'=>array(
                        '添加内容标签'=>url::create('table/add/table/templatetag/tagfrom/content'),
                        '添加栏目标签'=>url::create('table/add/table/templatetag/tagfrom/category'),
                        '添加自定义标签'=>url::create('table/add/table/templatetag/tagfrom/define'),
						
						'添加手机内容标签'=>url::create('table/add/table/templatetagwap/tagfrom/content'),
                        '添加手机栏目标签'=>url::create('table/add/table/templatetagwap/tagfrom/category'),
                        '添加手机自定义标签'=>url::create('table/add/table/templatetagwap/tagfrom/define'),
                ),
                '模板管理'=>array(
                        '选择模板'=>url::create('config/system/set/template'),
                        '模板结构标注'=>url::create('template/note'),
                        '查看模板内容'=>url::create('template/edit'),
						'更多模板'=>url::create('template/downlist'),
                ),
                '自定义表单'=>array(
                        '添加表单'=>url::create('form/addform'),
                        '管理表单'=>url::create('form/listform'),
                ),
                '邮件管理'=>array(
                        '会员邮件群发'=>url::create('table/mail/table/user'),
                        '发送邮件'=>url::create('table/send/table/user'),
                        '订阅邮件群发'=>url::create('table/send/table/user/type/subscription'),
                ),
                '专题管理'=>array(
                        '专题管理'=>url::create('table/list/table/special'),
                        '添加专题'=>url::create('table/add/table/special'),
                ),
                '订单管理'=>array(
                        '订单列表'=>url::create('table/list/table/orders'),
                        '支付配置'=>url::create('pay/list/table/pay'),
                        '配货配置'=>url::create('logistics/list/table/logistics'),
                ),
                '推广联盟'=>array(
                        '联盟用户'=>url::create('union/list/table/union'),
                        '结算记录'=>url::create('union/pay/table/union'),
                        '访问统计'=>url::create('union/visit/table/union'),
                        '注册统计'=>url::create('union/reguser/table/union'),
                        '联盟配置'=>url::create('union/config/table/union'),
                ),
                '客服系统管理'=>array(
                        '调用配置'=>url::create('config/system/set/enlarge'),
                        '系统配置'=>url::create('celive/system/item/systeminfo'),
                        '部门管理'=>url::create('celive/system/item/departments'),
                        '客服管理'=>url::create('celive/system/item/operators'),
                        '任务管理'=>url::create('celive/system/item/assigns'),
                ),
                '客服中心'=>array(
                        '接通用户'=>url::create('celive/chat/item/monitor'),
                        '交谈记录'=>url::create('celive/chat/item/chatlist'),
                        '客户留言'=>url::create('table/list/table/guestbook'),
                ),
                '账号管理'=>array(
                        'CELIVE资料修改'=>url::create('celive/user/item/details'),
                ),
                '生成代码'=>array(
                        '生成代码'=>url::create('celive/system/item/createcode'),
                ),
                'CELIVE独立后台'=>array(
                        '独立后台'=>url::create('celive/admin'),
                ),
				'论坛专题'=>array(
                '专题管理'=>url::create('bbs/category/item/admin-list-cat'),
                ),
                '帖子管理'=>array(
                        '帖子管理'=>url::create('bbs/archive/item/admin-list-archive'),
                        '批量删帖'=>url::create('bbs/archive/item/admin-del-archive'),
                ),
				'网站安全'=>array(
                        '后门查杀'=>url::create('safe/webshell'),
                        '黑客攻击防护'=>url::create('safe/protect'),
                ),
        );
    }
}