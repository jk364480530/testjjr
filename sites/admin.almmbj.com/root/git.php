<meta charset="utf-8" />
<a href="/git.php?a=pull">拉取</a> 
<a href="/git.php?a=log">日志</a> 
<a href="/git.php?a=status">状态</a>
<a href="/git.php?a=diff">比较</a>
<div class="clear"></div>
<?php
$a = 99;
if(isset($_GET['a'])){
    $a = $_GET['a'];
}

switch($a){
	case 'status':
		exec('/usr/bin/git status', $output);
		foreach($output as $line){
			echo $line . '<br />';
		}
		break;
	case 'log':
		exec('/usr/bin/git log', $output);
		foreach($output as $line){
			echo $line . '<br />';
		}
		break;
	case 'diff':
		exec('/usr/bin/git diff', $output);
		foreach($output as $line){
			echo $line . '<br />';
		}
		break;
	default:
		exec('/usr/bin/git pull', $output);
		foreach($output as $line){
			echo $line . '<br />';
		}
	break;
}
?>
<style type="text/css">
a{ float:left; width:100px; height:32px; background:#00C6F8; margin:0px 10px; text-align:center; line-height:32px; color:#ffffff; font-size:16px; font-weight:bold; text-decoration:none; border-radius: 20px;-webkit-border-radius: 20px; -moz-border-radius: 20px;}
a:hover{ float:left; width:100px; height:32px; background:#00921E; margin:0px 10px; text-align:center; line-height:32px; color:#F8FF00; font-size:16px; font-weight:bold; text-decoration:none; border-radius: 20px;-webkit-border-radius: 20px; -moz-border-radius: 20px;}
.clear{clear:both;}
</style>