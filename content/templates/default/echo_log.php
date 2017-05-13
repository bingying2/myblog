<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"3","bdPos":"right","bdTop":"100"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
<div id="content">
<div id="contentleft">
	<h2><?php topflg($top); ?><?php echo $log_title; ?></h2>
	<p class="date"><?php echo gmdate('Y-n-j', $date); ?>  <?php blog_author($author); ?> <?php blog_sort($logid); ?> <?php editflg($logid,$author); ?></p>
	<div id='o_cts'><?php echo str_replace("https://www.you748.com","",$log_content); ?></div>
	<p class="tag"><?php blog_tag($value['logid']); ?></p>
	<?php doAction('log_related', $logData); ?>
	<div class="nextlog"><?php neighbor_log($neighborLog); ?></div>
        <div class="wtfpl"><?php include View::getView("wtfpl"); ?></div>
	<?php blog_comments($comments); ?>
	<?php if (ROLE !== ROLE_ADMIN){blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark);} ?>
	<div style="clear:both;"></div>
</div><!--end #contentleft-->
<?php
 include View::getView('side');
 include View::getView('footer');
?>
