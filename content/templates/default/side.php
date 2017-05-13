<?php 
/**
 * 侧边栏
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<ul id="sidebar">
<?php 
$widgets = !empty($options_cache['widgets1']) ? unserialize($options_cache['widgets1']) : array();
doAction('diff_side');
foreach ($widgets as $val)
{
	$widget_title = @unserialize($options_cache['widget_title']);
	$custom_widget = @unserialize($options_cache['custom_widget']);
	if(strpos($val, 'custom_wg_') === 0)
	{
		$callback = 'widget_custom_text';
		if(function_exists($callback))
		{
			call_user_func($callback, htmlspecialchars($custom_widget[$val]['title']), $custom_widget[$val]['content']);
		}
	}else{
		$callback = 'widget_'.$val;
		if(function_exists($callback))
		{
			preg_match("/^.*\s\((.*)\)/", $widget_title[$val], $matchs);
			$wgTitle = isset($matchs[1]) ? $matchs[1] : $widget_title[$val];
			call_user_func($callback, htmlspecialchars($wgTitle));
		}
	}
}
?>
<?php if (Option::get('rss_output_num')):?>
<li style="padding-left:0;background:none;">
<div class="rss">
<a href="<?php echo BLOG_URL; ?>rss.php" title="RSS订阅"><img src="<?php echo TEMPLATE_URL; ?>images/rss.gif" alt="订阅Rss"/></a>
</div>
</li>
<?php endif;?>
<?php if(1):/*全部页面显示*/?>
<div class="widget nowrap">
<h3>博客统计</h3>
<?php $sta_cache = Cache::getInstance()->readCache('sta');?>
<li><a>日志数量:<?php echo $sta_cache['lognum']; ?></a></li>
<li><a>微语数量:<?php echo $sta_cache['twnum']; ?></a></li>
<li><a>评论数量:<?php echo $sta_cache['comnum']; ?></a></li>
<li><a>运行天数:<?php echo floor((time()-strtotime("2015-11-15"))/86400); ?></a></li>
<li><a><?php
/*使用文本文件记录数据的简单实现*/
$counter=1;
if(file_exists("mycounter.txt")){
$fp=fopen("mycounter.txt","r");
$counter=fgets($fp,9);
$counter++;
fclose($fp);
}
$fp=fopen("mycounter.txt","w");
fputs($fp,$counter);
fclose($fp);
echo "博客访问: ".$counter."";
?></a></li>
</div>
<?php endif;?>
</ul><!--end #siderbar-->
