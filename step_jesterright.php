<?php 
	include("../connect/connect.php");
	include("../config/config.php");
?>
<div class="sugget_left sugget_right">
<?php
	if(isset($_SESSION['recipit_id']['New'])) {
	$recption_jid = $_SESSION['recipit_id']['New'];
	$get_jrecp = get_recp_info($recption_jid);
	$jcash = $get_jrecp['cash_amount'];
	$jgender = $get_jrecp['gender'];
	$jage = $get_jrecp['age'];
	$jocassion = $get_jrecp['occassionid'];
	$get_jprice = get_price2($jcash);
	$get_jdata = get_category($jgender,$jage);
	$get_joccassion_data = get_ocassion($jocassion);
	
	$chk_jusers = mysql_query("select userId,email from ".tbl_user." where email = '".$get_jrecp['email']."'");
	if(mysql_num_rows($chk_jusers) > 0) {
	$get_juserid = mysql_fetch_array($chk_jusers);
	$juId = $get_juserid['userId'];
	$jowndata = "and own_id not like '%".$juId."%'";
	$jhidedata = "and hide_id not like '%".$juId."%'";
	$jlovedata = "and love_id like '%".$juId."%'";
	$query_judemo2 = "Union select * from ".tbl_product." where (status = 1 or status = 0) $get_jprice $jowndata $jhidedata $jlovedata";
	}
	
	if(isset($_SESSION['LOGINDATA']['USERID'])){
		$login_check="and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
	}
	
	$query_jdemo1 = "select * from ".tbl_product." where (status = 1 or status = 0) $get_jdata $get_jprice $get_joccassion_data $login_check";
	
	$query_jdemo3 = "select * from ".tbl_product." where (status = 1 or status = 0) $get_jdata $get_joccassion_data $login_check limit 0,10";
	
	$query_jdemo4 = "select * from ".tbl_product." where (status = 1 or status = 0) $get_jdata $login_check limit 0,10";
	$select_jproducts2 =  $query_jdemo1." ".$query_judemo2."limit 0,10";
	} else {
	$query_jdemo1 = "select * from ".tbl_product." where (status = 1 or status = 0) and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%' limit 0,10";
	
	$query_jdemo3 = "select * from ".tbl_product." where (status = 1 or status = 0) and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%' limit 0,10";
	
	$query_jdemo4 = "select * from ".tbl_product." where (status = 1 or status = 0) and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%' limit 0,10";
	$select_jproducts2 =  $query_jdemo1;
	}
	$view_jcat4 = $db->get_results($select_jproducts2,ARRAY_A);
	$view_jcat5 = $db->get_results($query_jdemo3,ARRAY_A);
	$view_jcat6 = $db->get_results($query_jdemo4,ARRAY_A);
?>
	<div class="show_option">
		<span class="view">Click image to view item:</span>
		<ul class="content mCustomScrollbar">
		<?php
			if($view_jcat4) {
			foreach($view_jcat4 as $allproducts) {
		?>
			<li onclick="get_product('<?php echo $allproducts['proid']; ?>')"><img src="<?php get_image($allproducts['image_code']); ?>" alt="<?php echo $allproducts['pro_name']; ?>" width="92" height="92" id="countButton" /></li>
		<?php } } ?>
		<?php
			if($view_jcat5) {
			foreach($view_jcat5 as $allproducts) {
		?>
			<li onclick="get_product('<?php echo $allproducts['proid']; ?>')"><img src="<?php get_image($allproducts['image_code']); ?>" alt="<?php echo $allproducts['pro_name']; ?>" width="92" height="92" id="countButton" /></li>
		<?php } } ?>	
		<?php
			if($view_jcat6) {
			foreach($view_jcat6 as $allproducts) {
		?>
			<li onclick="get_product('<?php echo $allproducts['proid']; ?>')"><img src="<?php get_image($allproducts['image_code']); ?>" alt="<?php echo $allproducts['pro_name']; ?>" width="92" height="92" id="countButton" /></li>
		<?php } } ?>		
		</ul>
	</div>
</div>
			
<script type="text/javascript">

function get_product(pid)
{
	var count = $.cookie('count');
	
	if (count != null)
	{
		count = parseInt(count) + 1;
		$.cookie("count", count, {
		   expires : date           
		});
	}
	
	var proId = pid;
	$.ajax({
		url: '<?php echo ru;?>process/get_jesterproduct.php?picID='+proId,
		type: 'get', 
		success: function(output) {
			$('#prev_nxt_product').html(output);
			$('#product_algo').hide();
			if ((count == 5 || count == 10)) {
				$('.overlays').show();
				$('#schedule_awards_div').slideDown();
				setTimeout(function() { 
					$('#schedule_awards_div').slideUp();
					$.ajax({
					url: "<?php echo ru;?>process/get_cartquestion.php",
					type: "POST",
					success:function(output) {
						$('#modal_checkouts').html(output);
					}
				});
				}, 10000);
				return false;
			}
		}
	});
}	
</script>