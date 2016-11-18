
<div class="tags" style="margin-bottom:20px;">
<div id="tagstitle">
<a id="one1" class="hover">处理订单</a>
</div>


<div id="tagscontent" class="right_box">

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">

<div class="hid_box">
<div class="hbox">
<?php
switch($data['status']){
	case 1:
	$data['status']='完成';
	break;
	case 2:
	$data['status']='处理中';
	break;
	case 3:
	$data['status']='已发货';
	break;
	case 4:
	$data['status']='客户已付款，待审核';
	break;
	case 5:
	$data['status']='已核实客户支付';
	break;
	default:
	$data['status']='新订单';
	break;	
} 
if($data['mid']==0){
	$data['mid']='游客';
}else{
	$data['mid']='注册会员';
}

$string = $data['aid'];
$find   = ',';
$pos = strpos($string, $find);


if($pos!==false){
	$_aid = $string;
	$_aid = substr($_aid,0,-1);
	$_archivearr=archive::getInstance()->getrows('aid in ('.$_aid.')',100);
}else{
	$_archive=archive::getInstance()->getrow($data['aid']);
	$data['aid']=$_archive['title'];
	
	$logisticsid = substr($data['oid'],15,1);
	$where=array();
	$where['id'] = $logisticsid; 
	$logistics=logistics::getInstance()->getrows($where);
	if($logistics[0]['cashondelivery']){
		$logistics[0]['price'] = 0.00;
	}else{
		if($logistics[0]['insure']){
			$logistics[0]['price'] = $logistics[0]['price'] + ($_archive['attr2'] * $orders['pnums'])*($logistics[0]['insureproportion']/100);
		}
	}
	
	
	
	$where=array();
	$where['oid']=$data['oid'];
	$orders=orders::getInstance()->getrow($where);
	
	$where=array();
	$where['pay_code']=substr($data['oid'],19);
	$pay=pay::getInstance()->getrows($where);
	$pay_fee = $pay[0]['pay_fee'];
	$pay[0]['pay_fee'] = $pay[0]['pay_fee']/100;
	if(!isset($logistics[0]['price'])) $logistics[0]['price']=0;
	$total = $_archive['attr2'] * $orders['pnums'] + $logistics[0]['price'] + ($_archive['attr2'] * $orders['pnums'] * $pay[0]['pay_fee']);	
}


$listtotal = 0;
?>
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
      <tr> 
        <td width="20%" align="right">订单号：</td> 
        <td width="70%"><font color="red">{$data[oid]}</font></td> 
      </tr>  
      <tr> 
        <td width="20%" align="right">下单时间：</td> 
        <td width="70%">{date('Y-m-d H:i:s',$data[adddate])}</td> 
      </tr> 
      <tr> 
        <td align="right">客户IP：</td> 
        <td>{$data[ip]}</td> 
      </tr>

      <tr> 
        <td align="right">订购产品：</td> 
        <td>
      <?php
	  if($pos!==false){
		  ?>          
<table width="70%" border="0">
  <tr>
    <th scope="col">产品</th>
    <th scope="col">单价</th>
    <th scope="col"></th>
  </tr>
  {loop $_archivearr $key $_archive}
  
  <?php
  
  $logisticsid = substr($data['oid'],15,1);
	$where=array();
	$where['id'] = $logisticsid; 
	$logistics=logistics::getInstance()->getrows($where);
	if($logistics[0]['cashondelivery']){
		$logistics[0]['price'] = 0.00;
	}else{
		if($logistics[0]['insure']){
			$logistics[0]['price'] = $logistics[0]['price'] + ($_archive['attr2'] * $orders['pnums'])*($logistics[0]['insureproportion']/100);
		}
	}
	
	if(!isset($logistics[0]['price'])) $logistics[0]['price']=0;
	
	
	
	$where=array();
	$where['oid']=$data['oid'];
	$orders=orders::getInstance()->getrow($where);
	
	$pnums = explode(',',$orders['pnums']);
	$orders['pnums']=$pnums[$key];
	
	$where=array();
	$where['pay_code']=substr($data['oid'],19);
	$pay=pay::getInstance()->getrows($where);
	$pay_fee = $pay[0]['pay_fee'];
	$pay[0]['pay_fee'] = $pay[0]['pay_fee']/100;
	$total = $_archive['attr2'] * $orders['pnums'] + $logistics[0]['price'] + ($_archive['attr2'] * $orders['pnums'] * $pay[0]['pay_fee']);	
    $listtotal +=$total;
  ?>
  
  
  <tr>
    <td><a href="{url('archive/show/aid/'.$_archive[aid], false)}" target="_blank">{$_archive[title]}</a></td>
    <td>{$_archive[attr2]}</td>
    <td><strong>小计</strong>：[产品单价] * [订购数量] +  [配送费用] + [支付手续费] = [总额]
        <br />
        {$_archive[attr2]} * {$orders[pnums]} + {$logistics[0]['price']} + ({$_archive[attr2]} * {$orders[pnums]} * {$pay[0][pay_fee]}) = {$total}</td>
  </tr>
  {/loop}
  <tr>
    <td colspan="3"><strong>总计：{$listtotal}</strong></td>
  </tr>
  
</table>

      <?php
	  }else{
	  ?>  
       <div>
        <a href="{url('archive/show/aid/'.$_archive[aid], false)}" target="_blank">{$data[aid]} ￥{$_archive[attr2]}</a>&nbsp;&nbsp;(订购量：{$data[pnums]})&nbsp;&nbsp; <br />
        <strong>合计</strong>：[产品单价] * [订购数量] +  [配送费用] + [支付手续费] = [总额]
        <br />
        {$_archive[attr2]} * {$orders[pnums]} + {$logistics[0]['price']} + ({$_archive[attr2]} * {$orders[pnums]} * {$pay[0][pay_fee]}) = {$total}
        </div> 
      <?php
	  }
	  ?>
        </td> 
      </tr>
      <tr>       
        <td align="right">单位名称：</td> 
        <td>{$data[pname]}({$data[mid]})</td> 
      </tr> 
      <tr> 
        <td align="right">联系电话：</td> 
        <td>{$data[telphone]}</td> 
      </tr> 
      <tr> 
        <td align="right">详细地址：</td> 
        <td>{$data[address]}</td> 
      </tr> 
            <tr> 
        <td align="right">邮政编码：</td> 
        <td>{$data[postcode]}</td> 
      </tr> 
            <tr> 
        <td align="right">订单留言：</td> 
        <td>{$data[content]}</td> 
      </tr> 
      <tr> 
        <td align="right">订单状态：</td> 
        <td><font color="red">{$data[status]}</font>
        <br />
        
        <?php 
		if($data[orderlog]){
			echo '<div style="border:1px solid #CCC">';
			$data[orderlog] = unserialize($data[orderlog]);
			echo '支付类型：'.$data[orderlog]['code'].'&nbsp;&nbsp;';
			if($data[orderlog]['code']=='alipay'){
				echo '客户邮箱：'.rawurldecode($data[orderlog]['buyer_email']).'&nbsp;&nbsp;';
				echo '支付时间：'.rawurldecode($data[orderlog]['gmt_payment']).'&nbsp;&nbsp;';
				echo '支付金额：'.$data[orderlog]['total_fee'].'&nbsp;&nbsp;';
				echo '交易编号：'.$data[orderlog]['trade_no'].'&nbsp;&nbsp;';
			}
			echo '</div>';
		}
		?>
        
        </td> 
      </tr> 
    </table>


</div>
</div>

<div class="blank10"></div>
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<div class="hid_box">
<div class="hbox">
<table border="0" cellspacing="0" cellpadding="0" name="table2" id="table2" width="100%">
<tr> 
<td width="20%" align="right">
更改状态：
</td> 
<td width="70%">
<select id=status name=status >
<option value="0" selected>新订单</option>
<option value="2" >处理中</option>
<option value="3" >已发货</option>
<option value="4" >客户已付款，待审核</option>
<option value="5" >已核实客户支付</option>
<option value="1" >完成（已经处理）</option>
</select>
</td>
</tr>
<tr> 
<td width="20%" align="right">
快递单号：
</td> 
<td width="70%">
<label>
<input type="text" name="courier_number" id="courier_number" class="input" />
</label>
</td>
</tr>
</table>
<div class="blank20"></div>

</div>
</div>
</div>

<div class="blank20"></div>
<input type="submit" name="submit" value="提交" class="btn_a"/>
<div class="blank20"></div>
</form>
</div>

