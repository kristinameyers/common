			<div class="sugget_left sugget_right" id="rightproduct_algo">
				<div class="show_option">
					<div class="cat_title">
						<h2><span>Category:</span> <?php echo ucfirst($view_product['category']); ?></h2>
					</div>
					<span class="view">Click image to view item:</span>
					<!-- content -->
					<ul class="content mCustomScrollbar">
					<?php
						$view_allproduct = $db->get_results($select_products,ARRAY_A);
						if($view_allproduct) {
						foreach($view_allproduct as $allproducts) {
					?>
						<li onclick="get_product('<?php echo $allproducts['proid']; ?>')"><img src="<?php get_image($allproducts['image_code']); ?>" alt="<?php echo $allproducts['pro_name']; ?>" width="92" height="92" /></li>
					<?php } } ?>	
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="modals" id="schedule_awards_div" style="display:none">
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
</div>	
<div id="modal_checkouts"></div>
<div class="overlays" style="display:none"></div>	
<style>
.overlays{position:fixed; top:0; left:0; height:100%; width:100%; background:url(resource/images/overlay_bg.png); z-index:9999999}
.modals{width:auto; height:auto; padding:0 0 10px; /*position:relative;*/ position:absolute; top:30%; left:32%; background-color:#fff; margin-top:-110px; margin-left:-280px; -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; behavior:url(PIE.htc);z-index:99999999}
.cont_bar h3{-moz-border-radius:12px 12px 0 0; -webkit-border-radius:12px 12px 0 0; border-radius:12px 12px 0 0}
.modals img{float:left; margin:0}
.modal a{float:right}
.modal a img{margin:-16px -16px 0 0}
.modal .ques_rangebar{width:96%}
.modal .ques_rangebar ul li a{float:none}
.modal .range_option{padding:5px 10px; width:70px; min-height:59px}
.modal .range_option img{float:none; width:22px}
.modal .range_option span{font-size:10px}
.modal .range_option.exit_qa{width:50px}
.modal .range_option.exit_qa img, .modal .range_option.bkm img.skip{width:26px}
.modal .ques_rangebar ul li span{ font-size:11px; font-family:Arial; color:#818181}
.modal .range_btm a{height:46px; line-height:46px; font-size:16px; padding:0 36px; margin:10px 15px 0 0}
.modal .ui-slider-horizontal .ui-slider-handle{ float:none; display:table}
.modal .ques_rangebar a.ui-slider-handle{margin:18px 0 0 -0.45em !important}
.modal .ui-slider-pip-last span.ui-slider-label{margin-left:-4em; width:6em; text-align:left}
.modals img.cls_img{float:right; margin:-16px -16px 0 0}
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
	$('.overlays').hide();
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
		url: '<?php echo ru;?>process/get_theirsproduct.php?picID='+proId,
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