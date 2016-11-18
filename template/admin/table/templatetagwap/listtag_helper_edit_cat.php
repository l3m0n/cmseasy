<?php
/*
  $tag_info=templatetag::id(get('id'));
  $tag_config=$tag_info['setting'];

  if(isset($tag_config['subcat'])){
  $subcatchecked = 'checked';
  }else{
  $subcatchecked = '';
  }
  if(isset($tag_config['catname'])){
  $catnamechecked = 'checked';
  }else{
  $catnamechecked = '';
  }
  if(isset($tag_config['categorycontent'])){
  $categorycontentchecked = 'checked';
  }else{
  $categorycontentchecked = '';
  }
  if(isset($tag_config['catimage'])){
  $catimagechecked = 'checked';
  }else{
  $catimagechecked = '';
  }

  $tag_config['length'] = 20;
  $tag_config['limit'] = 10;
  $tag_config['thumb'] = 0;
 */
$tplarray=include(ROOT.'/template/'.config::get('template_mobile_dir').'/tpltag/tag.config.php');
$tplarray=$tplarray['category'];
$tag_config=$data['setting'];
?>


        <?php
        echo "<tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">栏目</td><td width="1%">&nbsp;</td><td width="70%">'.form::select('catid', $tag_config['catid'], category::option()).'<span class="hotspot" onmouseover="tooltip.show(\'默认所有栏目!\');" onmouseout="tooltip.hide();"><img src="images/admin/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>';
       echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">子栏目<td width="1%">&nbsp;</td><td width="70%">';
        echo '<input type="checkbox" name="subcat" id="subcat" class="radio" '.$subcatchecked.'  /><span class="hotspot" onmouseover="tooltip.show(\'默是否调用栏目下级子栏目!\');" onmouseout="tooltip.hide();"><img src="images/admin/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>';
        echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">栏目名称<td width="1%">&nbsp;</td><td width="70%">';
        echo '<input type="checkbox" name="catname" class="radio" id="cat_name" '.$catnamechecked.'  /><span class="hotspot" onmouseover="tooltip.show(\'默是否调用栏目名称!\');" onmouseout="tooltip.hide();"><img src="images/admin/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>';
        echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">封面内容<td width="1%">&nbsp;</td><td width="70%">';
        echo '<input type="checkbox" class="radio" name="categorycontent" id="categorycontent" '.$categorycontentchecked.'  /><span class="hotspot" onmouseover="tooltip.show(\'是否调用栏目封面内容!\');" onmouseout="tooltip.hide();"><img src="images/admin/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>';
        echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">栏目图片<td width="1%">&nbsp;</td><td width="70%">';
        echo '<input type="checkbox" class="radio" name="catimage" id="catimage" '.$catimagechecked.'  /><span class="hotspot" onmouseover="tooltip.show(\'是否调用栏目说明图片!\');" onmouseout="tooltip.hide();"><img src="images/admin/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span>';
        echo "</td></tr><tr onmouseover=this.bgColor='#FFFFF0'; onmouseout=this.bgColor=''; bgcolor=''>";
        echo '<td width="19%" align="right">标签模板<td width="1%">&nbsp;</td><td width="70%">';
        echo form::select('tagtemplate', $tag_config['tagtemplate'], $tplarray);
        echo '<span class="hotspot" onmouseover="tooltip.show(\'标签模板文件存放在&nbsp;template/当前使用模板目录/tpltag/tag_category_*.html!\');" onmouseout="tooltip.hide();"><img src="images/admin/remind.gif" alt="" width="14" height="20"  style="margin-left:10px; margin-right:5px;"></span><div style="display:none">';
        //echo form::getform('tagcontent',$form,$field,$data);
        echo form::textarea('tagcontent', 'null', 'cols="70" rows="20"');
        echo '</div></td></tr>';
        echo '';
        ?>
