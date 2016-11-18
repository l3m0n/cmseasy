<div class="div_tpllist"><?php echo $tpllist;?></div>
<div id="info_res"></div>
<script>
	var isdownloading = false;
	$(function(){
		$('.div_tpllist a').click(function(e) {
			var a = $(this).data('rel');
			//console.log(a);
			if(!isdownloading) {
				isdownloading = true;
				$('#info_res').html('<div id="message"><div id="message_bg"><img src="{$skin_path}/images/ico_11.gif" />&nbsp;正在下载安装。。。不要刷新本页</div><div id="message_bt"></div></div>');
				$.post('{url('template/down',true)}', {'f': a}, function (res) {
					isdownloading = false;
					$('#info_res').html(res.msg);
				}, 'json');
				return false;
			}else{
				alert('请等待下载完成!');
				return false;
			}
		});
	});
</script>

<div class="blank30"></div>

<style type="text/css">
	.page_box {padding-right:50px;}
</style>
<div class="page_btn clear">
<span class="page_box">
<a class="prev">上一页</a><span class="num"><span class="current_page">1</span><span style="padding:0 3px;">/</span><span class="total"></span></span><a class="next">下一页</a>
</span>
</div>


<div class="blank30"></div>

<script type="text/javascript">
    $(document).ready(function(){
            $(".template_box:gt(11)").hide();//初始化，前面12条数据显示，其他的数据隐藏。
            var total_q=$(".template_box").index()+1;//总数据
            var current_page=12;//每页显示的数据
            var current_num=1;//当前页数
            var total_page= Math.round(total_q/current_page);//总页数  
            var next=$(".next");//下一页
            var prev=$(".prev");//上一页
            $(".total").text(total_page);//显示总页数
            $(".current_page").text(current_num);//当前的页数
             
            //下一页
            $(".next").click(function(){
                if(current_num==12){
                        return false;//如果大于总页数就禁用下一页
                    }
                    else{
                        $(".current_page").text(++current_num);//点击下一页的时候当前页数的值就加1
                        $.each($('.template_box'),function(index,item){
                            var start = current_page* (current_num-1);//起始范围
                            var end = current_page * current_num;//结束范围
                            if(index >= start && index < end){//如果索引值是在start和end之间的元素就显示，否则就隐
                                $(this).show();
                            }else {
                                $(this).hide(); 
                            }
                        });
                    }
            });
            //上一页方法
            $(".prev").click(function(){
                    if(current_num==1){
                        return false;
                    }else{
                        $(".current_page").text(--current_num);
                        $.each($('.template_box'),function(index,item){
                            var start = current_page* (current_num-1);//起始范围
                            var end = current_page * current_num;//结束范围
                            if(index >= start && index < end){//如果索引值是在start和end之间的元素就显示，否则就隐藏
                                $(this).show();
                            }else {
                                $(this).hide(); 
                            }
                        });     
                    }
                     
                })
    })
</script>
