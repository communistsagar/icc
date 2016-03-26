<?php
require_once 'app-inc/app-init.php';
$id=(int)$_GET['id'];
$cricket=New Miraz_Cricket(); // create a new cricket object
$matchDetails=$cricket->match_details($id);
// Redirect to home if the match ID is invalid
if(!$matchDetails){
	header('Location: '.$_SITE['url']);
	exit;
}
/* So, the match ID is correct. All right, lets do this! */
if($matchDetails->match->current_summary){
	$pageTitle=strip_tags($matchDetails->match->current_summary);
}
else{
	$pageTitle=strip_tags($matchDetails->live->status);
}
$pageTitle .=' - '.$_SITE['name'];

 require_once MAC_ROOT.'app-views/header.php';
 ?>
   <?php if($matchDetails->match->current_summary):?>
    <?php require_once MAC_ROOT.'app-views/live.php';?>
    <?php else:?>
        <?php require_once MAC_ROOT.'app-views/still.php';?>
        <?php endif;?>

<?php
require_once MAC_ROOT.'app-views/footer.php';
?>