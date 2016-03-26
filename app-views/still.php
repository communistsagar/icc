<div class="wrap match_details_area">
 <div class="heading">
 	<?php echo $matchDetails->match->team1_abbreviation;?> vs. <?php echo $matchDetails->match->team2_abbreviation;?>
 	</div>
 	<div class="current_score">
 		<?php echo $matchDetails->description;?>
 	</div>
 	<div class="ground_map">
 	<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $matchDetails->match->ground_latitude.','.$matchDetails->match->ground_longitude;?>&amp;zoom=16&amp;scale=false&amp;size=480x300&amp;maptype=satellite&amp;format=png&amp;visual_refresh=true&amp;&markers=color:blue|label:S|<?php echo $matchDetails->match->ground_latitude.','.$matchDetails->match->ground_longitude;?>" alt="<?php echo $matchDetails->match->ground_name;?>">
 	</div>
 	 	 	<div class="status">
 		<?php echo $matchDetails->live->status;?>
 	</div>
 </div>
 <div class="wrap team1_players">
 <div class="heading">
 <?php echo $matchDetails->match->team1_name;?>
 Squad
</div>
 <?php

 foreach($matchDetails->team[0]->squad as $team1_player):?>
<div class="player_list"><?php echo $team1_player->known_as;?>
<?php
// Check if player is skipper
if($team1_player->captain == '1'):?>
<span class="captain">C</span>
        <?php
        endif;
        ?>
</div>
 <?php endforeach;?>
</div>
 <div class="wrap team2_players">
 <div class="heading">
 <?php echo $matchDetails->match->team2_name;?>
 Squad
</div>
 <?php

 foreach($matchDetails->team[1]->squad as $team2_player):?>
<div class="player_list"><?php echo $team2_player->known_as;?>
<?php
// Check if player is skipper
if($team2_player->captain == '1'):?>
<span class="captain">C</span>
        <?php
        endif;
        ?>
</div>
 <?php endforeach;?>
</div>