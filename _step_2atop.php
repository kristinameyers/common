<?php
	if(isset($_SESSION['recipit_id']['New'])){
		unset($_SESSION['DRAFT']);
		$get_recipit = "select r.recp_first_name,r.recp_last_name,r.delivery_id,r.recp_email,r.cash_amount,r.occassionid,r.proid,o.occasionid,o.occasion_name from ".tbl_delivery." as r left join ".tbl_occasion." as o on r.occassionid=o.occasionid where r.delivery_id = '".$_SESSION['recipit_id']['New']."'";
		$view = $db->get_row($get_recipit,ARRAY_A);
		$cash_gift = $view['cash_amount'];
		$fullname = ucfirst($view['recp_first_name']).' '.ucfirst($view['recp_last_name']);
		$getoccss = explode("_",$view['occassionid']);
		if($view['occassionid'] == 'other_'.$getoccss[1]){
		 	$occasion_name = $getoccss[1];
		}else{ 
			$occasion_name = $view['occasion_name'];
		}
		
		$proid = json_decode($view['proid'],true);
		if($proid) {
			$_SESSION['cart'] = $proid;
		}
	} else if(isset($_SESSION['DRAFT'])) {
		$get_recipit = "select r.recp_first_name,r.recp_last_name,r.delivery_id,r.recp_email,r.proid,r.cash_amount,r.occassionid,o.occasionid,o.occasion_name from ".tbl_delivery." as r left join ".tbl_occasion." as o on r.occassionid=o.occasionid where r.delivery_id = '".$_SESSION['DRAFT']['delivery_id']."'";
		$view = $db->get_row($get_recipit,ARRAY_A);
 		$cash_gift = $view['cash_amount'];
		$fullname = ucfirst($view['recp_first_name']).' '.ucfirst($view['recp_last_name']);
		$getoccss = explode("_",$view['occassionid']);
		if($view['occassionid'] == 'other_'.$getoccss[1]){
		 	$occasion_name = $getoccss[1];
		}else{ 
			$get_occas = $db->get_row("select occasion_name from ".tbl_occasion." where occasionid='".$view['occassionid']."' ",ARRAY_A);
			$occasion_name = $get_occas['occasion_name'];
		}
		
		$proid = json_decode($view['proid'],true);
		if($proid) {
				$_SESSION['cart'] = $proid;
		}
}
	
?>
<ul class="steps">
	<?php if(isset($_SESSION['recipit_id']['New']) || isset($_SESSION['DRAFT']['delivery_id'])) { ?>
		<li class="step_a"><a href="<?php echo ru; ?>step_1"><span>1.</span> Enter cash gift and recipient info</a><span class="arrow"></span></li>
		<li class="step_b active"><span class="arrow arrow_left"></span><a href="<?php echo ru;?>step_2a"><span>2.</span> Select your gift suggestions</a><span class="arrow"></span></li>
		<li class="step_a step_c"><span class="arrow arrow_left"></span><a href="javascript:;"><span>3.</span> Delivery details</a><span class="arrow"></span></li>
		<li class="step_c step_d"><span class="arrow arrow_left"></span><a href="javascript:;"><span>4.</span> Checkout</a></li>
	<?php } else { ?>
		<li class="step_a"><a href="#"><span>1.</span> Unwrap Your iftGift</a><span class="arrow"></span></li>
		<li class="step_b active"><span class="arrow arrow_left"></span><a href="#"><span>2.</span> Shop iftGift</a><span class="arrow"></span></li>
		<li class="step_c step_d"><span class="arrow arrow_left"></span><a href="#"><span>3.</span> Delivery details & Checkout</a></li>
	<?php } ?>
</ul>
		<div class="sugget">
			<?php if(isset($_SESSION['recipit_id']['New']) || isset($_SESSION['DRAFT']['delivery_id'])) { ?>
				<h4>Your <span><?php echo $fullname; ?></span> iftGift for <span><?php echo $occasion_name; ?></span> Contains These Suggestions:</h4>
			<?php }else { ?>	
				<h4>Your iftCart Contains These Items:</h4>
			<?php } ?>	
			<div class="sugget_box">
			<div id="cart_suggest" class="suggst_pro_img"></div>
			<?php if($_SESSION['cart']) { ?>
			<div id="no_cart" class="suggst_pro_img">
			<?php
			include_once("process/cart_functions.php");
			$max=count($_SESSION['cart']);
			for($i=0;$i<$max;$i++){
			if(isset($_SESSION['recipit_id']['New'])){
				$pid=$_SESSION['cart'][$i]['proid'];
				$q=$_SESSION['cart'][$i]['qty'];
			} else {
				$pid=$_SESSION['cart'][$i]['proid'];
				$q=$_SESSION['cart'][$i]['qty'];
			}
			$pname=get_product_name($pid);
			$image=get_pro_image($pid);
			$imges=get_image_name($pid);
			?>
				<div class="sugget_item">
				<?php if($imges != ''){ ?>
					<img src="<?php  echo $imges;?>" width="92" height="92" alt="Suggection Item A"/>
					<?php }else{ ?>
					<img src="<?php  get_image($image);?>" width="92" height="92" alt="Suggection Item A"/>
				<?php } ?>
					<?php /*?><img src="<?php  get_image($image);?>" width="92" height="92" alt="Suggection Item A"/><?php */?>
					<a href="javascript:del(<?php echo $pid?>)"><img src="<?php echo ru_resource; ?>images/close.png" alt="close" class="closed" /></a>
				</div>
			<?php } if($max == '1') { ?>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<?php } else if($max == '2') { ?>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<?php } else if($max == '3') { ?>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<?php } else if($max == '4') { ?>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<?php } else if($max == '5') { ?>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
			<?php } ?>
			</div>
			<?php } else { ?>
			<div id="no_cart" class="suggst_pro_img">
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
				<div class="sugget_item">
					<img src="<?php echo ru_resource; ?>images/suggt_item_empty.jpg" alt="Suggection Item A"/>
				</div>
			</div>	
			<?php } ?>	
			</div>
				<?php if(!isset($_SESSION['LOGINDATA']['USERID'])){?>
					<?php if(isset($_SESSION['recipit_id']['New']) && isset($_SESSION['cart']) == '') { ?>
						<a href="javascript:;" onclick="chk_checkout()" id="no_cart_btn" class="orange">Checkout</a>
					<?php } else if(isset($_SESSION['cart']) && isset($_SESSION['recipit_id']['New'])) { ?>
						<a href="javascript:;" onclick="new_registers()" id="no_cart_btn" class="orange">Checkout</a>	
					<?php } ?>
				<?php } else {?>
					<?php if(isset($_SESSION['recipit_id']['New']) && isset($_SESSION['cart']) == '') { ?>
						<a href="javascript:;" onclick="chk_checkout()" id="no_cart_btn" class="orange">Checkout</a>
					<?php if(isset($_SESSION['LOGINDATA']['USERID'])){?>
						<a href="javascript:;" onclick="chk_checkout()" id="no_cart_btn3" class="orange save_resume">Save & Resume Later</a>
					<?php } } else if(isset($_SESSION['cart']) && isset($_SESSION['recipit_id']['New'])) { ?>
						<a href="<?php echo ru ?>delivery_detail" id="no_cart_btn" class="orange">Checkout</a>
					<?php if(isset($_SESSION['LOGINDATA']['USERID'])){?>
						<a href="javascript:;" onclick="SaveDraft(<?php echo $_SESSION['recipit_id']['New']; ?>)" id="no_cart_btn2" class="orange save_resume">Save & Resume Later</a>	
					<?php } } else if(isset($_SESSION['DRAFT']['delivery_id']) && isset($_SESSION['cart']) == '') {?>
						<a href="javascript:;" onclick="chk_checkout()" id="no_cart_btn" class="orange">Checkout</a>
					<?php if(isset($_SESSION['LOGINDATA']['USERID'])){?>
						<a href="javascript:;" onclick="chk_checkout()" id="no_cart_btn2" class="orange save_resume">Save & Resume Later</a>
					<?php } } else if(isset($_SESSION['cart']) && isset($_SESSION['DRAFT']['delivery_id'])) { ?>
						<a href="<?php echo ru ?>delivery_detail/<?php echo base64_encode($_SESSION['DRAFT']['delivery_id']); ?>" id="no_cart_btn" class="orange">Checkout</a>
					<?php if(isset($_SESSION['LOGINDATA']['USERID'])){?>
						<a href="javascript:;" onclick="SaveDraft(<?php echo $_SESSION['DRAFT']['delivery_id']; ?>)" id="no_cart_btn2" class="orange save_resume">Save & Resume Later</a>
					<?php } } else if(isset($_SESSION['cart']) && $_SESSION['recipit_id']['New'] == '' && $_SESSION['DRAFT']['delivery_id'] == '') { ?>
						<a href="<?php echo ru ?>buildcheckoutshop" id="no_cart_btn" class="orange">Checkout</a>
					<?php } else { ?>
						<a href="javascript:;" onclick="chk_checkout()" id="no_cart_btn" class="orange">Checkout</a>	
				<?php } ?>
			<?php  } ?>
		</div>
		<?php if(isset($_SESSION['SHOPPRODUCT']) && $_SESSION['recipit_id']['New'] == '' && $_SESSION['DRAFT']['delivery_id'] == '' ) { ?>
		<div class="sugget ycash_blnc">
			<div class="ycash_blnc_left">
				<label>Your Cash Stash Balance</label>
				<div class="ycash_blnc_value">$<?php echo $user_cashstash;?></div>
			</div>
			<div class="ycash_blnc_left ycash_blnc_right">
				<label>Your Points</label>
				<div class="ycash_blnc_value"><?php echo $user_points;?></div>
			</div>
		</div>
		<?php } ?>
		<div class="overlay" style="display:none"></div>
		<div class="modal" id="modal_checkout" style="display:none"><a style="cursor:pointer" onClick="close_div();"><img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" /></a><img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  /><div class="valid_msg">Please select an item to continue.</div></div>
<script type="text/javascript">
function del(pid){
	var myData = 'proid='+pid+'&type=delete';
	$.ajax({
		url: "<?php echo ru;?>process/process_cart.php",
		type: "GET",
		data: myData,
		success:function(output) {
			$('#cart_suggest').html(output);
			$('#no_cart').hide();
			$('#no_cart_btn').hide();
			$('#no_cart_btn2').hide();
			$('#no_cart_btn3').hide();
		}
	});
}

function close_div()
{
	jQuery(document).ready(function () {
	jQuery(".modal").slideUp("slow");
	jQuery(".overlay").css("display","none");
	});
}	

function chk_checkout()
{
	$(".overlay").show();
	$("#modal_checkout").toggle("slow");
}
function SaveDraft(pid){
	var myData = 'rid='+pid;
	//alert(myData);
	$.ajax({
		url: '<?php echo ru;?>process/process_draft.php',
		type: "GET",
		data: myData,
		success:function(output) {
		if(output == 'success'){
			window.location = "<?php echo ru?>dashboard";
			}	
		}
	});
}

function new_registers(){

	var myData = 'newreg='+1;
	$.ajax({
		url: '<?php echo ru;?>process/process_draft.php',
		type: "GET",
		data: myData,
		success:function(output) {
			if(output == 'success'){
				window.location = '<?php echo ru; ?>register';
			}
		}
	});
}
</script>