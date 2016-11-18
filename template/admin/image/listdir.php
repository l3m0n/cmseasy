

<style>td {padding-left:10px;}a.j{padding:0px 8px;}</style>
<div id="tagscontent" class="right_box">

    <table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
        <tbody>
            <tr class="th">
			<th></th>
        <th>文件夹名称</th>
        <th>操作</th>
    </tr>
</thead>
<tbody>
{loop $dir_arr $t}
<tr>
<td align="center"><img src="{$skin_path}/images/folder.gif" /></td>
<td width="70%">&nbsp;&nbsp;<span class="hotspot" onmouseover="tooltip.show('查看图片文件夹，<br />可方便的观察上传后的图片，进行筛选工作！');" onmouseout="tooltip.hide();"><a  href="{url('image/listimg/dir/'.$t)}">&nbsp;{$t}</a></span></td>
<td align="center"> 
<span class="hotspot" onmouseover="tooltip.show('查看图片文件夹，<br />可方便的观察上传后的图片，进行筛选工作！');" onmouseout="tooltip.hide();"><a  href="{url('image/listimg/dir/'.$t)}" class="a_view"></a></span>
</td>
</tr>
{/loop}

      </tbody>
    </table>
    
   </div>
