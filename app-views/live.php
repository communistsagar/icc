<div class="wrap match_details_area">
 <div class="heading">
 	<?php echo $matchDetails->match->team1_abbreviation;?> vs. <?php echo $matchDetails->match->team2_abbreviation;?>
    <a href="javascript:void()" class="refreshIcon"  onClick="window.location.href=window.location.href"><img src="<?php echo $_SITE['url'];?>/app-static/refresh.png" alt="Refresh"></a>
 	</div>
 	<div class="current_score">
 		<?php echo $matchDetails->match->current_summary;?>
 	</div>
 	 	 	<div class="status">
 		<?php echo $matchDetails->live->status;?>
 	</div>
 </div>
<?php if($matchDetails->centre->batting):?>
 <div class="wrap match_details_batting_area">
 <div class="heading">Current Batting</div>
    <table class="b_table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Run</th>
            <th>Balls</th>
            <th>SR</th>
        </tr>
        </thead>
        <tbody class="liveScore">
                 <?php
         foreach ($matchDetails->centre->batting as $key => $value):?>
         <tr>
         <th><?php echo $value->known_as;?>
          <?php
        // Check if batsman is in strike
        if($value->live_current_name == 'striker'):?>
        <span class="current">*</span>
        <?php
        endif;
        ?>
         </th>
         <th><?php echo $value->dismissal_name;?></th>
         <th><?php echo $value->runs;?></th>
         <th><?php echo $value->balls_faced;?></th>
         <th><?php echo $value->strike_rate;?></th>
         </tr>
         <?php endforeach;?>
        </tbody>
    </table>
    </div> 

  <div class="wrap match_details_batting_area">
 <div class="heading">Current Bowling</div>
    <table class="b_table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Run</th>
            <th>Over</th>
            <th>Wicket</th>
            <th>ER</th>
        </tr>
        </thead>
        <tbody class="liveScore">
                 <?php
         foreach ($matchDetails->centre->bowling as $bkey => $bowler):?>
         <tr>
        <th>
        <?php echo $bowler->known_as;?> 
        <?php
        // Check if he is the current bowler
        if($bowler->live_current_name == 'current bowler'):?>
        <span class="current">*</span>
        <?php
        endif;
        ?>
        </th>
        <th>
        <?php echo $bowler->conceded;?>
        </th>
        <th>
        <?php echo $bowler->overs;?>
        </th>
        <th>
        <?php echo $bowler->wickets;?>
        </th>
        <th>
        <?php echo $bowler->economy_rate;?>
        </th>
         </tr>
         <?php endforeach;?>
        </tbody>
    </table>
    </div>
<?php endif;?>