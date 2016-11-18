<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">

<div class="blank20"></div>
<div id="tagscontent" class="right_box">
    <style type="text/css">
.row{
  padding:1px 5px;
  color:white;
  font-weight:normal;
  background:#7080ad;
  }
.col{background:#f2f2f2;}
.unit{padding:5px 5px 5px 0px;background:#f9f9f9;}
</style>
    <script type="text/javascript">
	function addeve(str){
		$("#"+str).click(function(){
			if($("#"+str).attr('checked') == false){
				$("."+str).attr('checked',false);
				$("."+str).attr('disabled',true);
			}else{
				$("."+str).attr('checked',true);
				$("."+str).attr('disabled',false);
			}
		});
	}
	jQuery(function($){
		//---------------------config----------------//
		addeve('config');
		addeve('config_sitesystem');
		addeve('config_website');
		//---------------------content----------------//
		addeve('content');
		addeve('content_category');
		addeve('content_archive');
		addeve('content_mtype');
		addeve('content_special');
		//---------------------user----------------//
		addeve('user');
		addeve('user_manage');
		addeve('user_group');
		addeve('user_union');
		//---------------------user----------------//
		addeve('cache');
		addeve('cache_manage');
		addeve('cache_update');
		//---------------------order----------------//
		addeve('order');
		addeve('order_manage');
		//---------------------func----------------//
		addeve('func');
		addeve('func_announc');
		addeve('func_book');
		addeve('func_ballot');
		addeve('func_data');
		//---------------------template----------------//
		addeve('template');
		addeve('template_manage');
		addeve('templatetag_add');
		addeve('templatetag_list');
		//---------------------seo----------------//
		addeve('seo');
		addeve('seo_status');
		addeve('seo_linkword');
		addeve('seo_friendlink');
		addeve('seo_mail');
	//---------------------defined----------------//
		addeve('defined');
		addeve('defined_field');
		addeve('defined_form');
	//---------------------celive----------------//
		addeve('celive');
		addeve('celive_system');
		addeve('celive_center');
		addeve('celive_user');
		addeve('celive_code');
	//---------------------bbs----------------//
		addeve('bbs');
		addeve('bbs_category');
		addeve('bbs_archive');
	});
</script>
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
            
<tr>
<td width="19%" align="right">用户组</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('groupid',$form,$field,$data)}
</td>
</tr>

<tr>
<td width="19%" align="right">名称</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('name',$form,$field,$data)}
</td>
</tr>

<tr>
<td width="19%" align="right">商品折扣</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('discount',$form,$field,$data)}
</td>
</tr>
<tr>
<td width="19%" align="right">前台权限</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input type="checkbox" {getfchk($data['fpwlist'],'add_archive')} name="fpwlist[]" value="add_archive" />  添加文章
</td>
</tr>
<tr>
        <td colspan="3"><table width="100%" align="center" class="formtable">
            <tr class="trstyle2">
              <td class="trtitle02"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="4" class="row" valign="center"><input name="powerlist[config]" type="checkbox" id="config"  value="1" {getchecked($data['powerlist'],'config')} />
                      <b>设置</b></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="config" type="checkbox" name="powerlist[sitesystem]"  {getchecked($data['powerlist'],'sitesystem')} value="1" id="config_sitesystem">
                      网站设置</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="config config_sitesystem" type="checkbox" name="powerlist[system]"  {getchecked($data['powerlist'],'system')} value="1" />
                            系统设置</td>
                          <td class="unit"><input class="config config_sitesystem" type="checkbox" name="powerlist[language]"  {getchecked($data['powerlist'],'language')} value="1" />
                            语言包管理</td>
                          <td class="unit"><input class="config config_sitesystem" type="checkbox" name="powerlist[setting_archive]"  {getchecked($data['powerlist'],'setting_archive')} value="1" />
                            内容推荐</td>
                          <td class="unit"><input class="config config_sitesystem" type="checkbox" name="powerlist[sms]"  {getchecked($data['powerlist'],'sms')} value="1" />
                            短信管理</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="config" type="checkbox" name="powerlist[website]"  {getchecked($data['powerlist'],'website')} value="1" id="config_website">
                      多站点管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="config config_website" type="checkbox" name="powerlist[website_list]"  {getchecked($data['powerlist'],'website_list')} value="1" />
                            站点列表</td>
                          <td class="unit"><input class="config config_website" type="checkbox" name="powerlist[website_add]"  {getchecked($data['powerlist'],'website_add')} value="1" />
                            增加站点</td>
                          <td class="unit"><input class="config config_website" type="checkbox" name="powerlist[website_edit]"  {getchecked($data['powerlist'],'website_edit')} value="1" />
                            站点修改</td>
                          <td class="unit"><input class="config config_website" type="checkbox" name="powerlist[website_del]"  {getchecked($data['powerlist'],'website_del')} value="1" />
                            站点删除</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="4"><hr></td>
                  </tr>
                </table><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="4" class="row" valign="center"><input name="powerlist[content]" type="checkbox" id="content"  value="1" {getchecked($data['powerlist'],'content')} />
                      <b>内容</b></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="content" type="checkbox" name="powerlist[category]" {getchecked($data['powerlist'],'category')} value="1" id="content_category">
                      栏目管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="content content_category" type="checkbox" name="powerlist[category_list]" {getchecked($data['powerlist'],'category_list')} value="1" />
                            栏目列表</td>
                          <td class="unit"><input class="content content_category" type="checkbox" name="powerlist[category_add]" {getchecked($data['powerlist'],'category_add')} value="1" />
                            添加栏目</td>
                          <td class="unit"><input class="content content_category" type="checkbox" name="powerlist[category_edit]" {getchecked($data['powerlist'],'category_edit')} value="1" />
                            修改栏目</td>
                          <td class="unit"><input class="content content_category" type="checkbox" name="powerlist[category_del]" {getchecked($data['powerlist'],'category_del')} value="1" />
                            删除栏目</td>
                          <td class="unit"><input class="content content_category" type="checkbox" name="powerlist[category_htmlrule]" {getchecked($data['powerlist'],'category_htmlrule')} value="1" />
                            栏目url规则</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="content" type="checkbox" name="powerlist[archive]" {getchecked($data['powerlist'],'archive')} value="1" id="content_archive">
                      内容管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="content content_archive" type="checkbox" name="powerlist[archive_list]" {getchecked($data['powerlist'],'archive_list')} value="1" />
                            内容列表</td>
                          <td class="unit"><input class="content content_archive" type="checkbox" name="powerlist[archive_add]" {getchecked($data['powerlist'],'archive_add')} value="1" />
                            添加内容</td>
                          <td class="unit"><input class="content content_archive" type="checkbox" name="powerlist[archive_edit]" {getchecked($data['powerlist'],'archive_edit')} value="1" />
                            修改内容</td>
                          <td class="unit"><input class="content content_archive" type="checkbox" name="powerlist[archive_del]" {getchecked($data['powerlist'],'archive_del')} value="1" />
                            删除内容</td>
                          <td class="unit"><input class="content content_archive" type="checkbox" name="powerlist[archive_check]" {getchecked($data['powerlist'],'archive_check')} value="1" />
                            审核内容</td>
                          <td class="unit"><input class="content content_archive" type="checkbox" name="powerlist[archive_setting]" {getchecked($data['powerlist'],'archive_setting')} value="1" />
                            推荐位设置</td></tr><tr>
                          <td class="unit"><input class="content content_archive" type="checkbox" name="powerlist[archive_hotsearch]" {getchecked($data['powerlist'],'archive_hotsearch')} value="1" />
                            热门关键词</td>
                          <td class="unit"><input class="content content_archive" type="checkbox" name="powerlist[archive_image]" {getchecked($data['powerlist'],'archive_image')} value="1" />
                            图片管理</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="content" type="checkbox" name="powerlist[mtype]" {getchecked($data['powerlist'],'mtype')} value="1" id="content_mtype">
                      分类管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="content content_mtype" type="checkbox" name="powerlist[type_list]" {getchecked($data['powerlist'],'type_list')} value="1" />
                            分类列表</td>
                          <td class="unit"><input class="content content_mtype" type="checkbox" name="powerlist[type_add]" {getchecked($data['powerlist'],'type_add')} value="1" />
                            添加分类</td>
                          <td class="unit"><input class="content content_mtype" type="checkbox" name="powerlist[type_edit]" {getchecked($data['powerlist'],'type_edit')} value="1" />
                            修改分类</td>
                          <td class="unit"><input class="content content_mtype" type="checkbox" name="powerlist[type_del]" {getchecked($data['powerlist'],'type_del')} value="1" />
                            删除分类</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="content" type="checkbox" name="powerlist[special]" {getchecked($data['powerlist'],'special')} value="1" id="content_special">
                      专题管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="content content_special" type="checkbox" name="powerlist[special_list]" {getchecked($data['powerlist'],'special_list')} value="1" />
                            专题列表</td>
                          <td class="unit"><input class="content content_special" type="checkbox" name="powerlist[special_add]" {getchecked($data['powerlist'],'special_add')} value="1" />
                            添加专题</td>
                          <td class="unit"><input class="content content_special" type="checkbox" name="powerlist[special_edit]" {getchecked($data['powerlist'],'special_edit')} value="1" />
                            修改专题</td>
                          <td class="unit"><input class="content content_special" type="checkbox" name="powerlist[special_del]" {getchecked($data['powerlist'],'special_del')} value="1" />
                            删除专题</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="4"><hr></td>
                  </tr>
                </table><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="4" class="row" valign="center"><input name="powerlist[user]" type="checkbox" id="user"  value="1" {getchecked($data['powerlist'],'user')}>
                      <b>用户</b></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="user" type="checkbox" name="powerlist[user_manage]" {getchecked($data['powerlist'],'user_manage')} value="1" id="user_manage">
                      用户管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="user user_manage" type="checkbox" name="powerlist[user_list]" {getchecked($data['powerlist'],'user_list')} value="1" />
                            用户列表</td>
                          <td class="unit"><input class="user user_manage" type="checkbox" name="powerlist[user_add]" {getchecked($data['powerlist'],'user_add')} value="1" />
                            添加用户</td>
                          <td class="unit"><input class="user user_manage" type="checkbox" name="powerlist[user_edit]" {getchecked($data['powerlist'],'user_edit')} value="1" />
                            修改用户</td>
                          <td class="unit"><input class="user user_manage" type="checkbox" name="powerlist[user_del]" {getchecked($data['powerlist'],'user_del')} value="1" />
                            删除用户</td>
                          <td class="unit"><input class="user user_manage" type="checkbox" name="powerlist[user_ologin]" {getchecked($data['powerlist'],'user_ologin')} value="1" />
                            登录配置</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="user" type="checkbox" name="powerlist[user_group]" {getchecked($data['powerlist'],'user_group')} value="1" id="user_group">
                      用户组管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="user user_group" type="checkbox" name="powerlist[usergroup_list]" {getchecked($data['powerlist'],'usergroup_list')} value="1" />
                            用户组列表</td>
                          <td class="unit"><input class="user user_group" type="checkbox" name="powerlist[usergroup_add]" {getchecked($data['powerlist'],'usergroup_add')} value="1" />
                            添加用户组</td>
                          <td class="unit"><input class="user user_group" type="checkbox" name="powerlist[usergroup_edit]" {getchecked($data['powerlist'],'usergroup_edit')} value="1" />
                            修改用户组</td>
                          <td class="unit"><input class="user user_group" type="checkbox" name="powerlist[usergroup_del]" {getchecked($data['powerlist'],'usergroup_del')} value="1" />
                            删除用户组</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="user" type="checkbox" name="powerlist[user_union]" {getchecked($data['powerlist'],'user_union')} value="1" id="user_union">
                      推广联盟</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="user user_union" type="checkbox" name="powerlist[union_user]" {getchecked($data['powerlist'],'union_user')} value="1" />
                            联盟用户</td>
                          <td class="unit"><input class="user user_union" type="checkbox" name="powerlist[union_pay]" {getchecked($data['powerlist'],'union_pay')} value="1" />
                            结算记录</td>
                          <td class="unit"><input class="user user_union" type="checkbox" name="powerlist[union_visit]" {getchecked($data['powerlist'],'union_visit')} value="1" />
                            访问统计</td>
                          <td class="unit"><input class="user user_union" type="checkbox" name="powerlist[union_reguser]" {getchecked($data['powerlist'],'union_reguser')} value="1" />
                            注册统计</td>
                          <td class="unit"><input class="user user_union" type="checkbox" name="powerlist[union_config]" {getchecked($data['powerlist'],'union_config')} value="1" />
                            联盟配置</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="4"><hr></td>
                  </tr>
                </table><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="4" class="row" valign="center"><input name="powerlist[cache]" type="checkbox" id="cache"  value="1" {getchecked($data['powerlist'],'cache')} />
                      <b>生成静态</b></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="cache" type="checkbox" name="powerlist[cache_manage]" {getchecked($data['powerlist'],'cache_manage')} value="1" id="cache_manage">
                      生成管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_content]" {getchecked($data['powerlist'],'cache_content')} value="1" />
                            内容生成</td>
                          <td class="unit"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_category]" {getchecked($data['powerlist'],'cache_category')} value="1" />
                            栏目生成</td>
                          <td class="unit"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_index]" {getchecked($data['powerlist'],'cache_index')} value="1" />
                            首页生成</td>
                          <td class="unit"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_type]" {getchecked($data['powerlist'],'cache_type')} value="1" />
                            分类生成</td>
                          <td class="unit"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_special]" {getchecked($data['powerlist'],'cache_special')} value="1" />
                            专题生成</td>
                        </tr>
                        <tr>
                          <td class="unit"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_area]" {getchecked($data['powerlist'],'cache_area')} value="1" />
                            地区生成</td>
                          <td class="unit"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_tag]" {getchecked($data['powerlist'],'cache_tag')} value="1" />
                            标签生成</td>
                          <td class="unit"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_baidu]" {getchecked($data['powerlist'],'cache_baidu')} value="1" />
百度生成</td>
                          <td class="unit" colspan="2"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_google]" {getchecked($data['powerlist'],'cache_google')} value="1" />
GOOGLE生成</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="cache" type="checkbox" name="powerlist[cache_update]" {getchecked($data['powerlist'],'cache_update')} value="1" id="cache_update">
                    更新缓存</td>
                    <td colspan="3" class="col">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="4"><hr></td>
                  </tr>
                </table><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="4" class="row" valign="center"><input name="powerlist[order]" type="checkbox" id="order"  value="1" {getchecked($data['powerlist'],'order')} />
                      <b>订单</b></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="order" type="checkbox" name="powerlist[order_manage]" {getchecked($data['powerlist'],'order_manage')} value="1" id="order_manage">
                      订单管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="order order_manage" type="checkbox" name="powerlist[order_list]" {getchecked($data['powerlist'],'order_list')} value="1" />
                            订单列表</td>
                          <td class="unit"><input class="order order_manage" type="checkbox" name="powerlist[order_del]" {getchecked($data['powerlist'],'order_del')} value="1" />
                            删除订单</td>
                          <td class="unit"><input class="order order_manage" type="checkbox" name="powerlist[order_edit]" {getchecked($data['powerlist'],'order_edit')} value="1" />
                            处理订单</td>
                          <td class="unit"><input class="order order_manage" type="checkbox" name="powerlist[order_pay]" {getchecked($data['powerlist'],'order_pay')} value="1" />
                            支付配置</td>
                          <td class="unit"><input class="order order_manage" type="checkbox" name="powerlist[order_logistics]" {getchecked($data['powerlist'],'order_logistics')} value="1" />
                            配货配置</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="4"><hr></td>
                  </tr>
                </table><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="4" class="row" valign="center"><input name="powerlist[func]" type="checkbox" id="func"  value="1" {getchecked($data['powerlist'],'func')} />
                      <b>功能</b></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="func" type="checkbox" name="powerlist[func_announc]" {getchecked($data['powerlist'],'func_announc')} value="1" id="func_announc">
                      公告管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="func func_announc" type="checkbox" name="powerlist[func_announc_list]" {getchecked($data['powerlist'],'func_announc_list')} value="1" />
                            公告列表</td>
                          <td class="unit"><input class="func func_announc" type="checkbox" name="powerlist[func_announc_add]" {getchecked($data['powerlist'],'func_announc_add')} value="1" />
                            添加公告</td>
                          <td class="unit"><input class="func func_announc" type="checkbox" name="powerlist[func_announc_edit]" {getchecked($data['powerlist'],'func_announc_edit')} value="1" />
                            修改公告</td>
                          <td class="unit"><input class="func func_announc" type="checkbox" name="powerlist[func_announc_del]" {getchecked($data['powerlist'],'func_announc_del')} value="1" />
                            删除公告</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="func" type="checkbox" name="powerlist[func_book]" {getchecked($data['powerlist'],'func_book')} value="1" id="func_book">
                      留言评论</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="func func_book" type="checkbox" name="powerlist[func_book_list]" {getchecked($data['powerlist'],'func_book_list')} value="1" />
                            留言列表</td>
                          <td class="unit"><input class="func func_book" type="checkbox" name="powerlist[func_book_reply]" {getchecked($data['powerlist'],'func_book_reply')} value="1" />
                          回复留言</td>
                          <td class="unit"><input class="func func_book" type="checkbox" name="powerlist[func_book_del]" {getchecked($data['powerlist'],'func_book_del')} value="1" />
                            删除留言</td>
                          <td class="unit"><input class="func func_book" type="checkbox" name="powerlist[func_book_pllist]" {getchecked($data['powerlist'],'func_book_pllist')} value="1" />
                            评论列表</td>
                          <td class="unit"><input class="func func_book" type="checkbox" name="powerlist[func_book_pledit]" {getchecked($data['powerlist'],'func_book_pledit')} value="1" />
                            修改评论</td>
                          <td class="unit"><input class="func func_book" type="checkbox" name="powerlist[func_book_pldel]" {getchecked($data['powerlist'],'func_book_pldel')} value="1" />
                            删除评论</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="func" type="checkbox" name="powerlist[func_ballot]" {getchecked($data['powerlist'],'func_ballot')} value="1" id="func_ballot">
                      投票管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="func func_ballot" type="checkbox" name="powerlist[func_ballot_list]" {getchecked($data['powerlist'],'func_ballot_list')} value="1" />
                            投票列表</td>
                          <td class="unit"><input class="func func_ballot" type="checkbox" name="powerlist[func_ballot_add]" {getchecked($data['powerlist'],'func_ballot_add')} value="1" />
                            添加投票</td>
                          <td class="unit"><input class="func func_ballot" type="checkbox" name="powerlist[func_ballot_edit]" {getchecked($data['powerlist'],'func_ballot_edit')} value="1" />
                            修改投票</td>
                          <td class="unit"><input class="func func_ballot" type="checkbox" name="powerlist[func_ballot_del]" {getchecked($data['powerlist'],'func_ballot_del')} value="1" />
                            删除投票</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="func" type="checkbox" name="powerlist[func_data]" {getchecked($data['powerlist'],'func_data')} value="1" id="func_data">
                    数据管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="func func_data" type="checkbox" name="powerlist[func_data_baker]" {getchecked($data['powerlist'],'func_data_baker')} value="1" />
                            备份数据库</td>
                          <td class="unit"><input class="func func_data" type="checkbox" name="powerlist[func_data_restore]" {getchecked($data['powerlist'],'func_data_restore')} value="1" />
                            还原数据库</td>
                          <td class="unit"><input class="func func_data" type="checkbox" name="powerlist[func_data_phpweb]" {getchecked($data['powerlist'],'func_data_phpweb')} value="1" />
                            导入PHPweb数据</td>
                          <td class="unit"><input class="func func_data" type="checkbox" name="powerlist[func_data_replace]" {getchecked($data['powerlist'],'func_data_replace')} value="1" />
                            替换字符串</td>
                          <td class="unit"><input class="func func_data" type="checkbox" name="powerlist[func_data_adminlogs]" {getchecked($data['powerlist'],'func_data_adminlogs')} value="1" />
                            日志管理</td>
                          <td class="unit"><input class="func func_data" type="checkbox" name="powerlist[func_data_safe]" {getchecked($data['powerlist'],'func_data_safe')} value="1" />
                            网站安全</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="4"><hr></td>
                  </tr>
                </table><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="4" class="row" valign="center"><input name="powerlist[template]" type="checkbox" id="template"  value="1" {getchecked($data['powerlist'],'template')}>
                      <b>模板</b></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="template" type="checkbox" name="powerlist[template_manage]" {getchecked($data['powerlist'],'template_manage')} value="1" id="template_manage">
                      模板管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="template template_manage" type="checkbox" name="powerlist[template_set]" {getchecked($data['powerlist'],'template_set')} value="1" />
                            模板选择</td>
                          <td class="unit"><input class="template template_manage" type="checkbox" name="powerlist[template_note]" {getchecked($data['powerlist'],'template_note')} value="1" />
                          模板结构</td>
                   
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="template" type="checkbox" name="powerlist[templatetag_add]" {getchecked($data['powerlist'],'templatetag_add')} value="1" id="templatetag_add">
                      添加标签</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="template templatetag_add" type="checkbox" name="powerlist[templatetag_add_content]" {getchecked($data['powerlist'],'templatetag_add_content')} value="1" />
                            添加内容标签</td>
                          <td class="unit"><input class="template templatetag_add" type="checkbox" name="powerlist[templatetag_add_category]" {getchecked($data['powerlist'],'templatetag_add_category')} value="1" />
                            添加栏目标签</td>
                          <td class="unit"><input class="template templatetag_add" type="checkbox" name="powerlist[templatetag_add_define]" {getchecked($data['powerlist'],'templatetag_add_define')} value="1" />
                            添加自定义标签</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="template" type="checkbox" name="powerlist[templatetag_list]" {getchecked($data['powerlist'],'templatetag_list')} value="1" id="templatetag_list">
                      标签列表</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="template templatetag_list" type="checkbox" name="powerlist[templatetag_list_function]" {getchecked($data['powerlist'],'templatetag_list_function')} value="1" />
                            函数标签</td>
                          <td class="unit"><input class="template templatetag_list" type="checkbox" name="powerlist[templatetag_list_system]" {getchecked($data['powerlist'],'templatetag_list_system')} value="1" />
                            系统标签</td>
                          <td class="unit"><input class="template templatetag_list" type="checkbox" name="powerlist[templatetag_list_content]" {getchecked($data['powerlist'],'templatetag_list_content')} value="1" />
                            内容标签</td>
                          <td class="unit"><input class="template templatetag_list" type="checkbox" name="powerlist[templatetag_list_category]" {getchecked($data['powerlist'],'templatetag_list_category')} value="1" />
                            栏目标签</td>
                          <td class="unit"><input class="template templatetag_list" type="checkbox" name="powerlist[templatetag_list_define]" {getchecked($data['powerlist'],'templatetag_list_define')} value="1" />
                            自定义标签</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="4"><hr></td>
                  </tr>
                </table><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="4" class="row" valign="center"><input name="powerlist[seo]" type="checkbox" id="seo"  value="1" {getchecked($data['powerlist'],'seo')}>
                      <b>营销</b></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="seo" type="checkbox" name="powerlist[seo_status]" {getchecked($data['powerlist'],'seo_status')} value="1" id="seo_status">
                      数据统计</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="seo seo_status" type="checkbox" name="powerlist[seo_status_spider]" {getchecked($data['powerlist'],'seo_status_spider')} value="1" />
                            蜘蛛统计</td>
                          <td class="unit"><input class="seo seo_status" type="checkbox" name="powerlist[seo_status_cnzz]" {getchecked($data['powerlist'],'seo_status_cnzz')} value="1" />
                            CNZZ全景统计</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="seo" type="checkbox" name="powerlist[seo_linkword]" {getchecked($data['powerlist'],'seo_linkword')} value="1" id="seo_linkword">
                      内容链接管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="seo seo_linkword" type="checkbox" name="powerlist[seo_linkword_list]" {getchecked($data['powerlist'],'seo_linkword_list')} value="1" />
                            链接列表</td>
                          <td class="unit"><input class="seo seo_linkword" type="checkbox" name="powerlist[seo_linkword_add]" {getchecked($data['powerlist'],'seo_linkword_add')} value="1" />
                            添加链接</td>
                          <td class="unit"><input class="seo seo_linkword" type="checkbox" name="powerlist[seo_linkword_edit]" {getchecked($data['powerlist'],'seo_linkword_edit')} value="1" />
                            修改链接</td>
                          <td class="unit"><input class="seo seo_linkword" type="checkbox" name="powerlist[seo_linkword_del]" {getchecked($data['powerlist'],'seo_linkword_del')} value="1" />
                            删除链接</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="seo" type="checkbox" name="powerlist[seo_friendlink]" {getchecked($data['powerlist'],'seo_friendlink')} value="1" id="seo_friendlink">
                      友情链接管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="seo seo_friendlink" type="checkbox" name="powerlist[seo_friendlink_list]" {getchecked($data['powerlist'],'seo_friendlink_list')} value="1" />
                          链接列表</td>
                          <td class="unit"><input class="seo seo_friendlink" type="checkbox" name="powerlist[seo_friendlink_add]" {getchecked($data['powerlist'],'seo_friendlink_add')} value="1" />
                          添加链接</td>
                          <td class="unit"><input class="seo seo_friendlink" type="checkbox" name="powerlist[seo_friendlink_edit]" {getchecked($data['powerlist'],'seo_friendlink_edit')} value="1" />
                          修改链接</td>
                          <td class="unit"><input class="seo seo_friendlink" type="checkbox" name="powerlist[seo_friendlink_del]" {getchecked($data['powerlist'],'seo_friendlink_del')} value="1" />
                          删除链接</td>
                          <td class="unit"><input class="seo seo_friendlink" type="checkbox" name="powerlist[seo_friendlink_setting]" {getchecked($data['powerlist'],'seo_friendlink_setting')} value="1" />
                          友情链接配置</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="seo" type="checkbox" name="powerlist[seo_mail]" {getchecked($data['powerlist'],'seo_mail')} value="1" id="seo_mail">
                    邮件管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="seo seo_mail" type="checkbox" name="powerlist[seo_mail_usersend]" {getchecked($data['powerlist'],'seo_mail_usersend')} value="1" />
                            会员邮件群发</td>
                          <td class="unit"><input class="seo seo_mail" type="checkbox" name="powerlist[seo_mail_send]" {getchecked($data['powerlist'],'seo_mail_send')} value="1" />
                            发送邮件</td>
                          <td class="unit"><input class="seo seo_mail" type="checkbox" name="powerlist[seo_mail_subscription]" {getchecked($data['powerlist'],'seo_mail_subscription')} value="1" />
                            订阅邮件群发</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="4"><hr></td>
                  </tr>
                </table><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="4" class="row" valign="center"><input name="powerlist[defined]" type="checkbox" id="defined"  value="1" {getchecked($data['powerlist'],'defined')} />
                      <b>自定义</b></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="defined" type="checkbox" name="powerlist[defined_field]" {getchecked($data['powerlist'],'defined_field')} value="1" id="defined_field">
                      自定义字段</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="defined defined_field" type="checkbox" name="powerlist[defined_field_content]" {getchecked($data['powerlist'],'defined_field_content')} value="1" />
                            内容字段</td>
                          <td class="unit"><input class="defined defined_field" type="checkbox" name="powerlist[defined_field_content_add]" {getchecked($data['powerlist'],'defined_field_content_add')} value="1" />
                            添加内容字段</td>
                          <td class="unit"><input class="defined defined_field" type="checkbox" name="powerlist[defined_field_content_edit]" {getchecked($data['powerlist'],'defined_field_content_edit')} value="1" />
                          修改内容字段</td>
                          <td class="unit"><input class="defined defined_field" type="checkbox" name="powerlist[defined_field_content_del]" {getchecked($data['powerlist'],'defined_field_content_del')} value="1" />
                            删除内容字段</td>
                        </tr>
                        <tr>
                          <td class="unit"><input class="defined defined_field" type="checkbox" name="powerlist[defined_field_user]" {getchecked($data['powerlist'],'defined_field_user')} value="1" />
                            用户字段</td>
                          <td class="unit"><input class="defined defined_field" type="checkbox" name="powerlist[defined_field_user_add]" {getchecked($data['powerlist'],'defined_field_user_add')} value="1" />
                            添加用户字段</td>
                          <td class="unit"><input class="defined defined_field" type="checkbox" name="powerlist[defined_field_user_edit]" {getchecked($data['powerlist'],'defined_field_user_edit')} value="1" />
                            修改用户字段</td>
                          <td class="unit"><input class="defined defined_field" type="checkbox" name="powerlist[defined_field_user_del]" {getchecked($data['powerlist'],'defined_field_user_del')} value="1" />
                            删除用户字段</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="defined" type="checkbox" name="powerlist[defined_form]" {getchecked($data['powerlist'],'defined_form')} value="1" id="defined_form">
                      自定义表单</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="defined defined_form" type="checkbox" name="powerlist[defined_form_list]" {getchecked($data['powerlist'],'defined_form_list')} value="1" />
                            表单列表</td>
                          <td class="unit"><input class="defined defined_form" type="checkbox" name="powerlist[defined_form_add]" {getchecked($data['powerlist'],'defined_form_add')} value="1" />
                            添加表单</td>
                          <td class="unit"><input class="defined defined_form" type="checkbox" name="powerlist[defined_form_edit]" {getchecked($data['powerlist'],'defined_form_edit')} value="1" />
                            修改表单</td>
                          <td class="unit"><input class="defined defined_form" type="checkbox" name="powerlist[defined_form_del]" {getchecked($data['powerlist'],'defined_form_del')} value="1" />
                            删除表单</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="4"><hr></td>
                  </tr>
                </table><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr></tr>
                  <tr>
                    <td colspan="4" class="row" valign="center"><input name="powerlist[celive]" type="checkbox" id="celive"  value="1" {getchecked($data['powerlist'],'celive')}>
                      <b>在线客服</b></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="celive" type="checkbox" name="powerlist[celive_system]" {getchecked($data['powerlist'],'celive_system')} value="1" id="celive_system" />
                      客服系统管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td class="unit"><input class="celive celive_system" type="checkbox" name="powerlist[celive_enlarge]" {getchecked($data['powerlist'],'celive_enlarge')} value="1" />
                          调用配置</td>
                        <td class="unit"><input class="celive celive_system" type="checkbox" name="powerlist[celive_systeminfo]" {getchecked($data['powerlist'],'celive_systeminfo')} value="1" />
                          系统配置</td>
                        <td class="unit"><input class="celive celive_system" type="checkbox" name="powerlist[celive_departments]" {getchecked($data['powerlist'],'celive_departments')} value="1" />
                          部门管理</td>
                        <td class="unit"><input class="celive celive_system" type="checkbox" name="powerlist[celive_operators]" {getchecked($data['powerlist'],'celive_operators')} value="1" />
                          客服管理</td>
                        <td class="unit"><input class="celive celive_system" type="checkbox" name="powerlist[celive_assigns]" {getchecked($data['powerlist'],'celive_assigns')} value="1" />
                          任务管理</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="celive" type="checkbox" name="powerlist[celive_center]" {getchecked($data['powerlist'],'celive_center')} value="1" id="celive_center" />
                      客服中心</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td class="unit"><input class="celive celive_center" type="checkbox" name="powerlist[celive_monitor]" {getchecked($data['powerlist'],'celive_monitor')} value="1"  />
                          接通用户</td>
                        <td class="unit"><input class="celive celive_center" type="checkbox" name="powerlist[celive_chatlist]" {getchecked($data['powerlist'],'celive_chatlist')} value="1" />
                          交谈记录</td>
                        <td class="unit"><input class="celive celive_center" type="checkbox" name="powerlist[celive_book]" {getchecked($data['powerlist'],'celive_book')} value="1" />
                          客户留言</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="celive" type="checkbox" name="powerlist[celive_user]" {getchecked($data['powerlist'],'celive_user')} value="1" id="celive_user" />
                      帐号管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td class="unit"><input class="celive celive_user" type="checkbox" name="powerlist[celive_edit]" {getchecked($data['powerlist'],'celive_edit')} value="1" />
                          CELIVE资料修改</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td colspan="4" class="col" valign="center"><input class="celive" type="checkbox" name="powerlist[celive_code]" {getchecked($data['powerlist'],'celive_code')} value="1" id="celive_code"/>
                      生成代码</td>
                  </tr>
                  <tr>
                    <td colspan="4"><hr /></td>
                  </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="4" class="row" valign="center"><input name="powerlist[bbs]" type="checkbox" id="bbs"  value="1" {getchecked($data['powerlist'],'bbs')}>
                      <b>论坛</b></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="bbs" type="checkbox" name="powerlist[bbs_category]" {getchecked($data['powerlist'],'bbs_category')} value="1" id="bbs_category">
                      论坛专题</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="bbs bbs_category" type="checkbox" name="powerlist[bbs_category_list]" {getchecked($data['powerlist'],'bbs_category_list')} value="category_list" >
                            专题列表</td>
                          <td class="unit"><input class="bbs bbs_category" type="checkbox" name="powerlist[bbs_category_add]" {getchecked($data['powerlist'],'bbs_category_add')} value="category_add">
                            添加专题</td>
                          <td class="unit"><input class="bbs bbs_category" type="checkbox" name="powerlist[bbs_category_edit]" {getchecked($data['powerlist'],'bbs_category_edit')} value="category_edit">
                            修改专题</td>
                          <td class="unit"><input class="bbs bbs_category" type="checkbox" name="powerlist[bbs_category_del]" {getchecked($data['powerlist'],'bbs_category_del')} value="category_del">
                            删除专题</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="1" width="120" class="col" valign="center"><input class="bbs" type="checkbox" name="powerlist[bbs_archive]" {getchecked($data['powerlist'],'bbs_archive')} value="1" id="bbs_archive">
                      帖子管理</td>
                    <td colspan="3" class="col" valign="center"><table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="unit"><input class="bbs bbs_archive" type="checkbox" name="powerlist[bbs_archive_list]" {getchecked($data['powerlist'],'bbs_archive_list')} value="1">
                            帖子列表</td>
                          <td class="unit"><input class="bbs bbs_archive" type="checkbox" name="powerlist[bbs_archive_edit]" {getchecked($data['powerlist'],'bbs_archive_edit')} value="1">
                            修改帖子</td>
                          <td class="unit"><input class="bbs bbs_archive" type="checkbox" name="powerlist[bbs_archive_del]" {getchecked($data['powerlist'],'bbs_archive_del')} value="1">
                            删除帖子</td>
                          <td class="unit"><input class="bbs bbs_archive" type="checkbox" name="powerlist[bbs_archive_check]" {getchecked($data['powerlist'],'bbs_archive_check')} value="1" />
                            审核帖子</td>
                          <td class="unit"><input class="bbs bbs_archive" type="checkbox" name="powerlist[bbs_archive_batdel]" {getchecked($data['powerlist'],'bbs_archive_batdel')} value="1" />
                            批量删帖</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="4"><hr></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td></td>
            </tr>
          </table></td>
      </tr>
</tbody>
</table>
</div>

<div class="blank20"></div>
<input type="submit" name="submit" value="提交" class="btn_a" />
</form>