<?php
	include_once('../connect/connect.php');
	include_once('../config/config.php');
	if(isset($_GET['catid'])) { 
			$category = mysql_real_escape_string(stripslashes(trim($_GET['catid'])));
			$categorys = mysql_query("select cat_name from ".tbl_category." where catid = '".$category."' and p_catid = '0'");
			$view_products = mysql_fetch_array($categorys);
			$view_product = $view_products['cat_name'];
			if(isset($_SESSION['LOGINDATA']['USERID'])){
				$login_check="and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
			}
			$query_demos = "select * from ".tbl_product." where category = '".mysql_real_escape_string(stripslashes(trim($view_products['cat_name'])))."' and (status = 1 or status = 0) $login_check limit 0,200";
			$view_pro = $db->get_row($query_demos,ARRAY_A);
		} else if(isset($_GET['scatid'])) { 
			$category = mysql_real_escape_string(stripslashes(trim($_GET['scatid'])));
			$categorys = mysql_query("select cat_name from ".tbl_category." where catid = '".$category."' and p_catid != '0'");
			$view_products = mysql_fetch_array($categorys);
			$view_product = $view_products['cat_name'];
			$query_demos = "select * from ".tbl_product." where sub_category = '".mysql_real_escape_string(stripslashes(trim($view_products['cat_name'])))."' and (status = 1 or status = 0)  $login_check limit 0,200";
			$view_pro = $db->get_row($query_demos,ARRAY_A);
		}
?>
<div class="sugget_left sugget_right">
		<div class="show_option">
			<div class="cat_title">
				<h2><span>Category:</span> <?php echo ucfirst($view_product); ?></h2>
			</div>
			<span class="view">Click image to view item:</span>
			<!-- content -->
			<ul class="content mCustomScrollbar">
			<?php
				$view_allproduct = $db->get_results($query_demos,ARRAY_A);
				if($view_allproduct) {
				foreach($view_allproduct as $allproducts) {
			?>
				<li onclick="get_product('<?php echo $allproducts['proid']; ?>')"><?php if($allproducts['img'] != ''){ ?><img src="<?php echo  $allproducts['img'];?>" alt="<?php echo  $allproducts['pro_name'];?>" width="92" height="92" id="countButton_<?php echo $allproducts['proid']; ?>" /><?php }else{ ?><img src="<?php get_image($allproducts['image_code']); ?>" alt="<?php echo $allproducts['pro_name']; ?>" width="92" height="92" id="countButton_<?php echo $allproducts['proid']; ?>" />
				<?php } ?><?php /*?><img src="<?php get_image($allproducts['image_code']); ?>" alt="<?php echo $allproducts['pro_name']; ?>" width="92" height="92" id="countButton_<?php echo $allproducts['proid']; ?>" /><?php */?></li>
			<?php } } ?>	
			</ul>
		</div>
	</div>