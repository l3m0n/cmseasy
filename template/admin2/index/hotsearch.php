

<div class="tags" style="margin-bottom:20px;">
<div id="tagstitle">
<a class="hover">热门关键词</a>
</div>

<div id="tagscontent" class="right_box">
<div style="padding:15px;">

            <?php
            if (front::get('change')) {
                $path=ROOT.'/data/hotsearch/'.front::post('kfile');
                $keywordcount=intval(front::post('keywordcount'));
                file_put_contents($path, $keywordcount);
                if ($_GET['site'] != 'default') {
                    $ftp=new nobftp();
                    $ftpconfig=config::get('website');
                    $ftp->connect($ftpconfig['ftpip'], $ftpconfig['ftpuser'], $ftpconfig['ftppwd'], $ftpconfig['ftpport']);
                    $ftperror=$ftp->returnerror();
                    if ($ftperror) {
                        exit($ftperror);
                    }
                    else {
                        $ftp->nobchdir($ftpconfig['ftppath']);
                        $ftp->nobput($ftpconfig['ftppath'].'/data/hotsearch/'.front::post('kfile'), $path);
                    }
                }
                front::redirect(url::create('index/hotsearch/save/1'));
            }
            else {
                if (front::get('keyword') && !front::post('keyword'))
                    front::$post['keyword']=front::get('keyword');

                front::check_type(front::post('keyword'), 'safe');

                if (front::post('keyword')) {
                    $_keyword=trim(front::post('keyword'));
                    session::set('keyword', $_keyword);
                }
                else {
                    session::set('keyword', null);
                    $_keyword=session::get('keyword');
                }


                if (front::get('keywordcount') && !front::post('keywordcount'))
                    front::$post['keywordcount']=front::get('keywordcount');

                front::check_type(front::post('keywordcount'), 'safe');

                if (front::post('keywordcount')) {
                    $_keywordcount=trim(front::post('keywordcount'));
                    session::set('keywordcount', $_keywordcount);
                }
                else {
                    session::set('keywordcount', null);
                    $_keywordcount=session::get('keywordcount');
                }
            }




            if ($_GET['site'] != 'default') {
                $ftp=new nobftp();
                $ftpconfig=config::get('website');
                $ftp->connect($ftpconfig['ftpip'], $ftpconfig['ftpuser'], $ftpconfig['ftppwd'], $ftpconfig['ftpport']);
                $ftperror=$ftp->returnerror();
                if ($ftperror) {
                    exit($ftperror);
                }
                else {
                    $ftp->nobchdir($ftpconfig['ftppath']);
                    $hotkeywordlist=$ftp->nobnlist($ftpconfig['ftppath'].'/data/hotsearch');
                }
                if (is_array($hotkeywordlist)) {
                    foreach ($hotkeywordlist as $val) {
                        $val=str_replace($ftpconfig['ftppath'], config::get('site_url'), $val);
                        $keywordcount=@file_get_contents($val);
                        $valtmp=str_replace(config::get('site_url'), '', $val);
                        $valtmp=str_replace('/data/hotsearch', '', $valtmp);
                        $valtmp=str_replace('/', '', $valtmp);
                        $valtmp=str_replace('\\', '', $valtmp);
                        $keyword=urldecode(substr($valtmp, 0, -4));
                        if ($_keyword) {
                            if ($_keyword != $keyword) {
                                $path1=ROOT.'/data/hotsearch/'.urlencode($_keyword).'.txt';
                                file_put_contents($path1, $_keywordcount);

                                $ftp->nobchdir($ftpconfig['ftppath']);
                                $ftp->nobput($ftpconfig['ftppath'].'/data/hotsearch/'.urlencode($_keyword).'.txt', $path1);

                                front::redirect(url::create('index/hotsearch/post/1'));
                            }
                        }
                        echo '<a href="'.config::get('site_url').'?case=archive&act=search&keyword='.str_replace('%', '-', urlencode($keyword)).'&ule=1" target="_blank"><span>'.$keyword.'</span> ('.$keywordcount.')&nbsp;&nbsp;</a>';
                        $koption .= '<option value="'.$valtmp.'">'.$keyword.'</option>';
                    }
                }
            }
            else {



                $path=ROOT.'/data/hotsearch';
                $dir=opendir($path);
                $i=0;

                $files=-2;
                $dir2=opendir($path);
                while ($file=readdir($dir2)) {
                    $files++;
                }
                $koption='<option value="">选择关键词...</option>';
                while ($file=readdir($dir)) {
                    if ($file != '..' && $file != '.' && !is_dir($path.'/'.$file) || $files == 0) {
                        if ($files == 0)
                            $keyword=null;
                        else
                            $keyword=urldecode(substr($file, 0, -4));
                        if ($_keyword) {
                            if ($_keyword != $keyword) {
                                $path1=ROOT.'/data/hotsearch/'.urlencode($_keyword).'.txt';
                                file_put_contents($path1, $_keywordcount);
                                front::redirect(url::create('index/hotsearch/post/1'));
                            }
                        }
                        $keywordcount = @file_get_contents($path.'/'.$file);
                        echo '<a href="'.config::get('site_url').'?case=archive&act=search&keyword='.str_replace('%', '-', urlencode($keyword)).'&ule=1" target="_blank"><span>'.$keyword.'</span> ('.$keywordcount.')&nbsp;&nbsp;</a>';
                        $koption .= '<option value="'.$file.'">'.$keyword.'</option>';
                    }
                }
            }
            ?>
</div>

<div class="blank10"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">

<tr>
<td width="19%" align="right">修改热门关键词</td>
<td width="1%">&nbsp;</td>
<td width="70%">
</td>
</tr>
<form action="{url::create('index/hotsearch/change/1')}" method="post" name="form2">
<tr>
<td width="19%" align="right">关键词</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<select name="kfile" value=""><?php echo $koption; ?></select>
</td>
</tr>
<tr>
<td width="19%" align="right">搜索次数</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input name="keywordcount" type="text" class="input" value="" style="float:left;" />
<input name="确定" type="submit" value="确定" class="btn_d" style="margin:3px 10px 0px;" />
</td>
</tr>
</form>



<tr>
<td width="19%" align="right">添加热门关键词</td>
<td width="1%">&nbsp;</td>
<td width="70%">
</td>
</tr>
<form action="{url::create('index/hotsearch/')}" method="post" name="form1">
<tr>
<td width="19%" align="right">关键词</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input name="keyword" class="input" type="text" />
</td>
</tr>
<tr>
<td width="19%" align="right">搜索次数</td>
<td width="1%">&nbsp;</td>
<td width="70%">
<input name="keywordcount" type="text" value="" class="input" style="float:left;" />
<input name="确定" type="submit" value="确定" class="btn_d" style="margin:3px 10px 0px;" />
</td>
</tr>
</form>

</table>
</div>


</div>