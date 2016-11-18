<?php
/*
  $id = get('id');
  $path=ROOT.'/config/tag/content_'.$id.'.php';
  $tag_config = array();
  $tag_config_content = @file_get_contents($path);
  if($tag_config_content){
  $tag_config = unserialize($tag_config_content);
  if(isset($tag_config['thumb'])){
  $checked = 'checked';
  }else{
  $checked = '';
  }
  }else{
  $tag_config['length'] = 20;
  $tag_config['limit'] = 10;
  $tag_config['thumb'] = 0;
  }
 */
$tplarray=include(ROOT.'/template/'.config::get('template_dir').'/tpltag/tag.config.php');
$tplarray=$tplarray['content'];
$tag_config=$data['setting'];
?>


        <?php
        echo "<tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">栏目<td width="1%">&nbsp;</td><td width="70%">'.form::select('catid', $tag_config['catid'], category::option());
        echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">子栏目<td width="1%">&nbsp;</td><td width="70%">'.form::select('son', $tag_config['son'], array("否","是"));
		echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">分类<td width="1%">&nbsp;</td><td width="70%">'.form::select('typeid', $tag_config['typeid'], type::option());
         echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">专题<td width="1%">&nbsp;</td><td width="70%">'.form::select('spid', $tag_config['spid'], special::option());
         echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">地区<td width="1%">&nbsp;</td><td width="70%">';
        echo form::select('province_id', $tag_config['province_id'], area::province_option());
        echo form::select('city_id', $tag_config['city_id'], area::city_option());
        echo form::select('section_id', $tag_config['section_id'], area::section_option());
         echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">标题截取字数<td width="1%">&nbsp;</td><td width="70%">';
        echo form::input('length', $tag_config['length'], 'class="input_c"');
		echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
		echo '<td width="19%" align="right">简介截取字数<td width="1%">&nbsp;</td><td width="70%">';
        echo form::input('introduce_length', $tag_config['introduce_length'], 'class="input_c"').'-1：不限制 0：不调用';
        echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">排序方式<td width="1%">&nbsp;</td><td width="70%">';
        echo form::select('ordertype', $tag_config['ordertype'],
                array(
			'adddate-desc'=>'最新(按发布时间倒序)',
            'aid-desc'=>'最新(按aid倒序)',
            'aid-asc'=>'最早(按按aid顺序)',
            'view-desc'=>'最热(按view倒序)',
            'comment_num-desc'=>'热评(按comment_num倒序)',
            'rand()'=>'随机',
        ));
         echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">调用置顶内容<td width="1%">&nbsp;</td><td width="70%">';
        echo form::select('istop', $tag_config['istop'],
                array(
			'1'=>'是',
            '0'=>'否',
        ));
         echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">调用记录条数<td width="1%">&nbsp;</td><td width="70%">';
        echo form::input('limit', $tag_config['limit'], 'class="input_c"');
         echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">缩略图<td width="1%">&nbsp;</td><td width="70%">';
		if($tag_config['thumb'] == 'on') $checked = 'checked';
        echo '<input type="checkbox" name="thumb" id="thumb" '.$checked.' />';
         echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">推荐位<td width="1%">&nbsp;</td><td width="70%">';
		$set=settings::getInstance();
        $sets=$set->getrow(array('tag'=>'table-archive'));
        $ds=unserialize($sets['value']);
		preg_match_all('%\(([\d\w\/\.-]+)\)(\S+)%s',$ds['attr1'],$result,PREG_SET_ORDER);
        $sdata=array();
        foreach ($result as $res) $sdata[$res[1]]=$res[2];
        echo form::select('attr1', $tag_config['attr1'], $sdata);
        echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">标签模板<td width="1%">&nbsp;</td><td width="70%">';
        echo form::select('tagtemplate', $tag_config['tagtemplate'], $tplarray);
        echo '<span class="hotspot" onmouseover="tooltip.show(\'标签模板文件存放在&nbsp;template/当前使用模板目录/tpltag/tag_content_*.html!\');" onmouseout="tooltip.hide();"><img src="images/admin/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span><br/><div style="display:none">';

        //echo form::getform('tagcontent',$form,$field,$data);
        echo form::textarea('tagcontent', 'null', 'cols="70" rows="20"');
		echo '</td></tr>';
        
        ?>
