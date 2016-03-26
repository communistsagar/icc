<?php
require_once 'app-inc/app-init.php';
require_once MAC_ROOT.'app-lib/simplepie/autoloader.php';
$feed = new SimplePie();
$cricket=New Miraz_Cricket();
$data=$cricket->get_macthes();
$cricketNews=$cricket->get_news();
require_once MAC_ROOT.'app-views/header.php';
?>

<!-- Recent Matches -->
<div class="wrap live_score_area">
<div class="heading">Live Scores <a href="<?php echo $_SITE['url'];?>" class="refreshIcon"><img src="<?php echo $_SITE['url'];?>/app-static/refresh.png" alt="Refresh"></a></div>
<?php
if(!empty($data)):?>
    <?php foreach($data as $match):?>
    	<div class="match_list isLive<?php echo $match->live_match;?>" id="match_<?php echo $match->id;?>">
    	<h3 class="teamNames"><?php echo $match->team1_name;?> <span class="vsText">VS</span> <?php echo $match->team2_name;?></h3>
    	<?php if(isset($match->start_string)):?>
    		<span class="start_string">To be played at: <?php echo $match->start_string;?></span>
    	<?php else:?>
    	<div class="scoreText">
    	<h3 class="team1">
    	<span class="team1abbr"><?php echo $match->team1_abbrev;?></span> 
    	<span class="team1score">
    	<?php if($match->team1_score):?>
    		<?php
    	echo $match->team1_score;
    	?>
    	<?php else:?>
    		(Still to bat)
    		<?php
    		endif;?></span>
    	</h3>
    	<h3 class="team2">
    	<span class="team2abbr"><?php echo $match->team2_abbrev;?></span>
    	<span class="team2score">
    		<?php if($match->team2_score):?>
    		<?php
    	echo $match->team2_score;
    	?>
    	<?php else:?>
    		(Still to bat)
    		<?php
    		endif;?>
    	</span>
    	</h3>
    	</div>
    <?php endif;?>
    <?php if(isset($match->result)):?>
    	<p class="resultText">
    	<?php echo $match->result;?>
    	</p>
    	<a class="btn full_score_btn" href="<?php echo $_SITE['url'].'/expand'.$match->url.'/'.$match->urlID;?>.html">Full Scorecard</a>
    <?php else:?>
    <a class="btn ball_by_ball_btn" href="<?php echo $_SITE['url'].'/expand'.$match->url.'/'.$match->urlID;?>.html">Ball by Ball</a>
    <?php endif;?>
    </div>
    <?php endforeach;?>
    
<?php else:?>
	<div class="sorry">No Recent Match Scheduled or Running!</div>
<?php endif;
?>
</div>

<!-- Latest Cricket News -->
<div class="wrap cricket_news_area">
<div class="heading">Cricket News</div>
<?php if($cricketNews):?>
	<?php foreach($cricketNews as $news):?>
	<div class="news_list">
	<h3 class="newsTitle"><a href="<?php echo $news->get_permalink(); ?>" rel="external nofollow" target="_blank"><?php echo $news->get_title(); ?></a></h3>
	<span class="newsDate"><?php echo $news->get_date('j F Y, g:i a'); ?></span>
	</div>
<?php endforeach;?>
	<?php else:?>
	<?php endif;?>
</div>

<?php
require_once MAC_ROOT.'app-views/footer.php';
?>