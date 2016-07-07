<div class="cont_bar outbox_left">
	<div class="drop_menu">
		<h4>MENU</h4>
		<img src="<?php echo ru_resource; ?>images/arrow_f.png" alt="Down Arrow" id="menu_open" />
	</div>
	<ul id="menu_close">
		<li><a href="<?php echo ru;?>inbox" <?php if($page == 'inbox') { ?>class="active"<?php } ?>>In.Box Archive</a></li>
		<li><a href="<?php echo ru;?>outbox" <?php if($page == 'outbox') { ?>class="active"<?php } ?>>Out.box Archive</a></li>
		<li><a href="<?php echo ru; ?>personal_reminder" <?php if($page == 'personal_reminder') { ?>class="active"<?php } ?>>Personal Reminders</a></li>
		<li><a href="<?php echo ru; ?>iftcliques" <?php if($page == 'iftcliques') { ?>class="active"<?php } ?>>Your iftCique</a></li>
		<li><a href="<?php echo ru;?>iftscoreboards" <?php if($page == 'iftscoreboards') { ?>class="active"<?php } ?>>iftScore Board</a></li>
		<li><a href="<?php echo ru; ?>retailer_rewards" <?php if($page == 'retailer_rewards') { ?>class="active"<?php } ?>>Retailer Rewards</a></li>
		<li><a href="<?php echo ru;?>item_selection" <?php if($page == 'item_selection') { ?>class="active"<?php } ?>>Item Selection Icons</a></li>
		<li><a href="<?php echo ru;?>wishlist" <?php if($page == 'wishlist') { ?>class="active"<?php } ?>>Your iftWish List</a></li>
		<li><a href="<?php echo ru;?>owned" <?php if($page == 'owned') { ?>class="active"<?php } ?>>Owned Items</a></li>
		<li><a href="<?php echo ru;?>hidden" <?php if($page == 'hidden') { ?>class="active"<?php } ?>>Hidden Items</a></li>
	</ul>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $("#menu_open").click(function(){
	$("#menu_close").slideToggle();
  });
});
</script>