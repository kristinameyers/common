			<?php 
			if($view_product) {?>
			<div class="sugget_left sugget_right" id="rightproduct_algo">
				<div class="show_option">
					<span class="view">Click image to view item:</span>
					<!-- content step_2aright-->
					<ul class="content mCustomScrollbar">
					<?php
					if($_SESSION['recipit_id']['New'] != '' || $_SESSION['DRAFT']['delivery_id']) {
						if(isset($_SESSION['LOGINDATA']['USERID'])){
							$login_check="and (own_id not like '%".$_SESSION['LOGINDATA']['USERID']."%' and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%')";
						}
						$query_demo2 = "select * from ".tbl_product." where (status = 1 or status = 0) $get_data $get_price $get_occassion_data $login_check";
 						$select_products2 =  $query_demo2." ".$query_udemo;
					} else {
						$select_products2 = "select * from ".tbl_product." where (status = 1 or status = 0) and price <= '".$available_cash."' and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%' limit 0,60";
					}	
						$view_allproduct = $db->get_results($select_products2,ARRAY_A);
						if($view_allproduct) {
						foreach($view_allproduct as $allproducts) {
					?>
						<li onclick="get_product('<?php echo $allproducts['proid']; ?>')"><?php if($allproducts['img'] != ''){ ?><img src="<?php echo  $allproducts['img'];?>" alt="<?php echo  $allproducts['pro_name'];?>" width="92" height="92" id="countButton_<?php echo $allproducts['proid']; ?>" /><?php }else{ ?><img src="<?php get_image($allproducts['image_code']); ?>" alt="<?php echo $allproducts['pro_name']; ?>" width="92" height="92" id="countButton_<?php echo $allproducts['proid']; ?>" /><?php } ?><?php /*?><img src="<?php get_image($allproducts['image_code']); ?>" alt="<?php echo $allproducts['pro_name']; ?>" width="92" height="92" id="countButton_<?php echo $allproducts['proid']; ?>"/><?php */?></li>
					<?php } } ?>	
					</ul>
				</div>
			</div>
			<?php }  ?>
			<div id="load_productright"></div>
		</div>
		<div id="jester_right"></div>
	</div>
	
	<div class="modal modal_b modal_c" id="schedule_awards_div" style="display:none">
			<a style="cursor:pointer" onClick="close_div2();">
				<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" class="cls_img" />
			</a>
			<h3 class="gift_title">Hungry for Gift Ideas?</h3>
			<div class="cont_bar_inner cont_bar_inner_b gift_idea">
				<img src="<?php echo ru_resource; ?>images/jester_af.jpg" alt="Jester Image" class="reg_jst_a reg_jst_e" />
				<div class="regs_form">
					<div class="box blue">
						<div class="num_outer">
							<div class="one">1</div>
						</div>
						<div class="box_data">
							<h4>The s&rsquo;Jester Only Knows What He&rsquo;s Been Fed.</h4>
							<p>The more, the better. So take a few, fun moments to input s&rsquo;Jester Q&A&rsquo;s about your recipient. And, if you want future iftGifts to reflect the true you, <a href="#">answer about yourself, too.</a></p>
						</div>
					</div>
					<div class="box pink">
						<div class="num_outer">
							<div class="one">2</div>
						</div>
						<div class="box_data">
							<h4>Follow Your Own Instincts.</h4>
							<p>The s&rsquo;Jester and the recipient&rsquo;s iftClique may think one way, but that doesn&rsquo;t mean you can&rsquo;t go another. Take control and find anything you like. <a href="#">using the easy item selection tools.</a></p>
						</div>
					</div>
					<div class="box blue green">
						<div class="num_outer">
							<div class="one">3</div>
						</div>
						<div class="box_data">
							<h4>Even Dumb Suggestions Are Smart.</h4>
							<p>No matter what&rsquo;s suggested, the recipient is going to use the gift cash exactly how they choose. That&rsquo;s the iftGift secret &ndash;  <a href="#">C.A.S.H. means: Can Always Satisfy Him/Herself.</a></p>
						</div>
					</div>
					<a href="<?php echo ru;?>step_2a" class="orange">Back to Your iftGift</a>
				</div>
			</div>
		</div>
		
	
<div id="modal_checkouts"></div>
<div class="overlay" style="display:none"></div>	
<style>
.cont_bar h3{-moz-border-radius:12px 12px 0 0; -webkit-border-radius:12px 12px 0 0; border-radius:12px 12px 0 0}
.modal .ques_rangebar{width:90%}
</style>	
<script src="<?php echo ru_resource;?>js/jquery.cookie.js"></script>	
<script type="text/javascript">
var date = new Date();
date.setTime(date.getTime() + (30 * 1000));
$.cookie("count", 0, {
		   expires : date
		});

function close_div2() {
	$('#schedule_awards_div').hide();
	$('.overlay').hide();
}


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
		url: '<?php echo ru;?>process/get_product.php?picID='+proId,
		type: 'get', 
		success: function(output) {
		$("#countButton_"+proId).addClass("active_border");
			$('#prev_nxt_product').html(output);
			$('#product_algo').hide();
			$('#load_product').hide();
			if ((count == 5 || count == 10)) {
				$('.overlay').show();
				$('#schedule_awards_div').slideDown();
				setTimeout(function() { 
					$('#schedule_awards_div').slideUp();
					$('.overlay').hide();
					/*$.ajax({
					url: "<?php //echo ru;?>process/get_cartquestion.php",
					type: "POST",
					success:function(output) { 
						$('#modal_checkouts').html(output);
					}
				});*/
				}, 10000);
				return false;
			}
		}
	});
}
</script>