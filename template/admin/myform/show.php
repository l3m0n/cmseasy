<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
<tr class="th">
                <th align="center" width="180">字段名称</th>
                <th align="center" width="480">内容</th>
				<th align="center" width="60">关联</th>
            </tr>
            </thead>
        <tbody>
{user_cb_data($data,$table)}
            {loop $field $f}
                <?php

                $name=$f['name'];
				$aid = $data['aid'];
                if(!preg_match('/^my_/',$name)) continue;

                if(!isset($data[$name])) $data[$name]='';
                ?>

            <tr>
                <td width="180" align="center">{$name|lang}</td>
                <td width="480" align="center">{$data[$name]}</td>
				<td width="40" align="center">{if get(aid)}<center>
				<span class="hotspot" onmouseover="tooltip.show('查看表单关联内容页面！');" onmouseout="tooltip.hide();"><a href="index.php?case=archive&act=show&aid={get(aid)}" target="_blank" class="a_view" title="{getArchiveTitle($data[aid])}"></a></span></center>{else}无
				{/if}</td>
            </tr>

            {/loop}
        


        </tbody></table>

		</div>
