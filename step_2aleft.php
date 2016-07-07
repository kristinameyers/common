<?php

	$getuserImg = $db->get_row("select user_image from ".tbl_user." where userid = '".$_SESSION['LOGINDATA']['USERID']."'",ARRAY_A);
	$user_thumbimg = ru.'media/user_image/'.$_SESSION['LOGINDATA']['USERID'].'/thumb/'.$getuserImg['user_image'];

	$recipt_info = $_SESSION['recipit_id']['New'];
	$recipit_Infoview = $db->get_row("select first_name from ".tbl_recipient." where recipit_id = '".$recipt_info."'",ARRAY_A);
	
	include("mobi_detect/Mobile_Detects.php");
	$detect = new Mobile_Detect();
	mysql_query("SET NAMES 'utf8'");
?>
<div class="cont_bar">
	<div class="cont_bar_inner">
		<div class="sugget_left">
			<h4>Who is in control:</h4>
			<div class="image">
				<img src="<?php echo ru_resource; ?>images/jester_img.jpg" id="jster_img" <?php if($page == 'only' || $page == 'iftClique' || $page == 'similar_persons') { } else {?> style="display:none"<?php } ?> alt="user" />
				<?php if($getuserImg['user_image']){ ?>
				<img src="<?php echo $user_thumbimg; ?>" id="user_img" <?php if($page == 'only' || $page == 'iftClique' || $page == 'similar_persons') { ?>style="display:none" <?php } else { }?> alt="Jester Image" style="width:36px;height:36px"/>
				<?php }else{?>
				<img src="<?php echo ru_resource; ?>images/user_image.jpg" id="jster_img"  alt="user" />
				<?php } ?>
			</div>
			<div class="terms">
				<div class="squaredFour left">
					<input type="radio" value="you" id="twelve" name="radiog_lite" <?php if($page == 'only' || $page == 'iftClique' || $page == 'similar_persons') { } else { ?> checked="checked"<?php } ?>/>
					<label for="twelve"></label>
				</div>
				<label class="title">You</label>
			</div>
			<div class="control_item" id="you_left" <?php if($page == 'only' || $page == 'iftClique' || $page == 'similar_persons') { ?>style="display:none;" <?php } else {  } ?>>
				<script type="text/javascript">
				$(function () {
					$(".mine,.theris").on('click', function () {
					var isChecked = this.value;
					if(isChecked == 'mine') {
						window.location = "<?php echo ru;?>mine";
					} else if(isChecked == 'theirs') {
						window.location = "<?php echo ru;?>theris";
					}
					});						
				});
				</script>
				<div id="intro-wrap_cat">
					<div class="cat_title cat_title_b">
						<h2>Browse Categories</h2>
						<div class="open-intro_cat" <?php if($detect->isMobile() || $detect->isTablet() || $detect->isIOS() || $detect->isAndroidOS()) { ?>style="display:none"<?php } else { ?>style="display:block"<?php } ?>>
							<img src="<?php echo ru_resource; ?>images/arrow_c.png" alt="Down Arrow" />
						</div>
						<div class="close-intro_cat" <?php if ($detect->isMobile() || $detect->isTablet() || $detect->isiOS() || $detect->isAndroidOS()) { } else {?> style="display:none"<?php } ?>>
							<img src="<?php echo ru_resource; ?>images/arrow_d.png" alt="Down Arrow" /></div>	
						</div>
						<div id="contentWrap_cat" class="show_option" <?php if ($detect->isMobile() || $detect->isTablet() || $detect->isiOS() || $detect->isAndroidOS()) { ?>style="display:none"<?php } else { } ?>>
							<ul class="content mCustomScrollbar">
								<?php
									$get_cat = "select * from ".tbl_category." where status = 1 and p_catid = 0 and you_cat = 1 order by cat_name asc";
									$view_cat = $db->get_results($get_cat,ARRAY_A);
									if($view_cat)
									{
										foreach($view_cat as $category )
										{
								?>
								<li class="prod" id="category_<?php echo $category['catid'] ?>">
									<div class="cat_arrow"></div><?php echo stripslashes($category['cat_name']);?>
								</li>
								<ul class="drop_down" id="drop-down_<?php echo $category['catid']?>" style="display:none;">
									<?php
										$get_subcat = "select * from ".tbl_category." where status = 1 and p_catid = '".$category['catid']."'";
										$view_subcategory = $db->get_results($get_subcat,ARRAY_A);
										if($view_subcategory)
										{
											foreach($view_subcategory as $subcategory )
											{
									?>
									<li class="sub_cats" id="<?php echo $subcategory['catid'];?>">
										<img src="<?php echo ru_resource; ?>images/sub_cat_arrow.png" /><?php echo stripslashes($subcategory['cat_name']);?>
									</li>
									<?php } }?>
								</ul>
							<?php } }?>	
						</ul>
					</div>
				</div>
				<div id="intro-wrap" >
					<div class="cat_title" >
						<h2>Optional search</h2>
						<div class="open-intro"><img src="<?php echo ru_resource; ?>images/arrow_c.png" alt="Down Arrow" /></div>
						<div class="close-intro"><img src="<?php echo ru_resource; ?>images/arrow_d.png" alt="Down Arrow" /></div>	
					</div>
					<div id="contentWrap" <?php if($_SESSION['search']['optional'] != '') { ?> style="display:block"<?php } else { ?>style="display:none"<?php } ?>>	
						<div class="flied">
							<form id="SearchForms" method="post" action="<?php echo ru;?>process/search.php">
								<input type="text" name="search" id="search" placeholder="Input keywords" value="<?php echo $s; ?>" />
								<input type="hidden" name="location" id="location" value="1" >
								<input type="submit" />
							</form>
						</div>
						<a href="javascript:;" onclick="funresets()">Clear keywords</a>
					</div>
				</div>
				<?php if($_SESSION['search']['optional'] != '') { ?>
					<script type="text/javascript">
						$(function(){ 
							$("#from_price").attr("value", "")
							$("#to_price").attr("value", "");
						});
					</script>
				<?php } else {?>
					<script type="text/javascript">
						$(function(){
							$("#search").attr("value", "");
						});
					</script>
				<?php } ?>
				<div id="intro-wrap2">
					<div class="cat_title">
						<h2>Optional price</h2>
						<div class="open-intro2"><img src="<?php echo ru_resource; ?>images/arrow_c.png" alt="Down Arrow" /></div>
						<div class="close-intro2"><img src="<?php echo ru_resource; ?>images/arrow_d.png" alt="Down Arrow" /></div>	
					</div>
					<div id="contentWrap2" <?php if($_SESSION['from_price']['optional1'] !='') {?> style="display:block"<?php } else { ?>style="display:none" <?php } ?> >		
						<div class="flied">
							<form id="SearchForms2" method="post" action="<?php echo ru;?>process/search.php">
							<input type="hidden" name="price_search" id="price_search" value="1" > 
								<input type="text" name="from_price" id="from_price" placeholder="$50" <?php if(is_numeric($s)){ ?>  value="<?php echo '$'.$s; ?>" <?php } ?> onclick="changeprice();" /> 
								<span>to</span>
								<input type="text" name="to_price" id="to_price" placeholder="$2,500" <?php if(is_numeric($o)){ ?> value="<?php echo '$'.$o; ?>" <?php } ?> onclick="changeto();" /> 
								<input type="submit"  value="GO" />
							</form>
						</div>
						<a href="javascript:;" onclick="funresets2()">Clear price</a>
					</div>
				</div>
			</div>
			<div id="jester_left" <?php if($page == 'only' || $page == 'iftClique' || $page == 'similar_persons') { } else { ?>style="display:none"<?php } ?> >
				<h5 class="resp_name">For <?php echo $recipit_Infoview['first_name']; ?><br/>s&rsquo;Jester is considering:</h5>
					<?php
					$recption_jid = $_SESSION['recipit_id']['New'];
	
					$get_jrecp = get_recp_info($recption_jid);
					$jcash = $get_jrecp['cash_amount'];
					$jgender = $get_jrecp['gender'];
					$jage = $get_jrecp['age'];
					$jocassion = $get_jrecp['ocassionid'];
					$get_jprice = get_price2($jcash);
					$get_jdata = get_category($jgender,$jage);
					$get_joccassion_data = get_ocassion($jocassion);
					
					$chk_jusers = mysql_query("select userId,email from ".tbl_user." where email = '".$get_jrecp['email']."'");
					if(isset($_SESSION['LOGINDATA']['USERID'])){
						$login_check1="and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
					} 
					if(mysql_num_rows($chk_jusers) > 0) {
					$get_juserid = mysql_fetch_array($chk_jusers);
					$juId = $get_juserid['userId'];
					$jowndata = "and own_id not like '%".$juId."%'";
					$jhidedata = "and hide_id not like '%".$juId."%'";
					$jlovedata = "and love_id like '%".$juId."%'";
					$query_judemo = "Union select * from ".tbl_product." where (status = 1 or status = 0) $get_jprice $jowndata $jhidedata $login_check1 $jlovedata";
					}
					
					$query_jdemo = "select * from ".tbl_product." where (status = 1 or status = 0) $get_jdata $get_jprice $get_joccassion_data $jowndata $jhidedata $login_check1";
					if(isset($_SESSION['LOGINDATA']['USERID'])){
						$login_check2="and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%' limit 0,5";
					} else {
						$login_check2="limit 0,5";
					}
					$query_jdemo2 = "select * from ".tbl_product." where (status = 1 or status = 0) $get_jdata $get_joccassion_data $login_check2";
					
					$query_jdemo3 = "select * from ".tbl_product." where (status = 1 or status = 0) $get_jdata $login_check2";
					$select_jproducts =  $query_jdemo." ".$query_judemo."limit 0,5";
					$view_jcat1 = $db->get_results($select_jproducts,ARRAY_A);
					$view_jcat2 = $db->get_results($query_jdemo2,ARRAY_A);
					$view_jcat3 = $db->get_results($query_jdemo3,ARRAY_A);
					?>
					<div class="control_item">
						<div class="show_option">
							<!-- content -->
							<div class="cloud_bar_inner">
								<div id="myCanvasContainer">
									<canvas width="230" height="531" id="myCanvas">
										<p>will be replaced by something else</p>
									</canvas>
								</div>
								<div id="tags">
									<ul>
									<?php 
									if($view_jcat1){
										foreach($view_jcat1 as $jcategory )
										{
									?>
										<li><a href="javascript:;" onclick="procloud('<?php echo $jcategory['proid']; ?>')" style="font-size: 20pt;color:#ff9c10"><?php echo stripslashes($jcategory['pro_name']);?></a></li>
									<?php } } ?>
									<?php 
									if($view_jcat2){
										foreach($view_jcat2 as $jcategory2 )
										{
									?>
										<li><a href="javascript:;" onclick="procloud('<?php echo $jcategory2['proid']; ?>')" style="font-size: 14pt;color:#c048bb"><?php echo stripslashes($jcategory2['pro_name']);?></a></li>
									<?php } } ?>
									<?php 
									if($view_jcat3){
										foreach($view_jcat3 as $jcategory3 )
										{
									?>
										<li><a href="javascript:;" onclick="procloud('<?php echo $jcategory3['proid']; ?>')" style="font-size: 10pt;color:#5ec0e9"><?php echo stripslashes($jcategory3['pro_name']);?></a></li>
									<?php } } ?>	
									</ul>
								</div>
							</div>
						</div>
						<div id="intro-wrap4">
							<div class="cat_title">
								<h2>Profiles to consider</h2>
								<div class="open-intro4"><img src="<?php echo ru_resource; ?>images/arrow_c.png" alt="Down Arrow" /></div>
								<div class="close-intro4"><img src="<?php echo ru_resource; ?>images/arrow_d.png" alt="Down Arrow" /></div>	
							</div>
							<div id="contentWrap4" <?php if($page == 'only' || $page == 'iftClique' || $page == 'similar_persons') { } else { ?> style="display:none" <?php } ?>>

								<ul>
									<li><a href="<?php echo ru; ?>only" <?php if($page == 'only') { ?>class="active" <?php } ?>><div class="pro_icon_a"></div><span><?php echo ucfirst($recipit_Infoview['first_name']);?> Only</span></a></li>
									<li><a href="<?php echo ru; ?>iftClique" <?php if($page == 'iftClique') { ?>class="active" <?php } ?>><div class="pro_icon_a pro_icon_b"></div><span><?php echo ucfirst($recipit_Infoview['first_name']);?> ifClique</span></a></li>
									<li class="last"><a href="<?php echo ru; ?>similar_persons" <?php if($page == 'similar_persons') { ?>class="active" <?php } ?>><div class="pro_icon_a pro_icon_c"></div><span>Similar Persons</span></a></li>
								</ul>
							</div>
						</div>
						<div id="intro-wrap5">
							<div class="cat_title">
								<h2>Optional Search Tools</h2>
								<div class="open-intro5"><img src="<?php echo ru_resource; ?>images/arrow_c.png" alt="Down Arrow" /></div>
								<div class="close-intro5"><img src="<?php echo ru_resource; ?>images/arrow_d.png" alt="Down Arrow" /></div>	
							</div>
							<div id="contentWrap5" style="display:none">
								<div class="flied">
									<form id="SearchForms" method="post" action="<?php echo ru;?>process/search.php">
										<input type="text" name="search" id="search" placeholder="Input keywords" />
										<input type="hidden" name="location" id="location" value="1" >
										<input type="submit" />
									</form>
								</div>
								<a href="javascript:;" onclick="funresets()">Clear keywords</a>
								<div class="flied flied_d">
									<form id="SearchForms2" method="post" action="<?php echo ru;?>process/search.php">
										<input type="hidden" name="price_search" id="price_search" value="1" >
										<input type="text" name="from_price" id="from_price" placeholder="$15" />
										<span>to</span>
										<input type="text" name="to_price" id="to_price" placeholder="$2,500" />
										<input type="submit" value="GO" />
									</form>
								</div>
								<a href="javascript:;" onclick="funresets2()">Clear price</a>
							</div>
						</div>
					</div>
				</div>
		</div>
		<?php 
		unset ($_SESSION['search']['optional']);
		unset ($_SESSION['from_price']['optional1']);
		?>
<script src="<?php echo ru_resource;?>js/tagcanvas.min.js" type="text/javascript"></script>				
<script>
window.onload = function() {
        try {
			
          TagCanvas.Start('myCanvas','tags',{
            textColour: null,
			shape: 'vcylinder',
			imageScale: null,
			outlineMethod: 'none', 
			padding: '10px',
			zoom: 1.3,
            reverse: true,
            maxSpeed: 0.05,
			depth: 0.99,
  			weight: true,
  			weightMode: "size",
  			weightFrom: null,
			activeCursor: 'pointer',
			initial : [0.1,-0.1],
			decel : 0.98,
			maxSpeed : 0.04,
			minBrightness : 0.2,
			depth : 0.92,
			pulsateTo : 0.6
          });
        } catch(e) {
			
          // something went wrong, hide the canvas container
          document.getElementById('myCanvasContainer').style.display = 'none';
        }
      };
/***************************SJESTER & YOU SHOW/HIDE*******************************/
$(function () {
	$("input[name=radiog_lite]").on('click', function() {
		var mode = $("input[name=radiog_lite]:checked").val();
		if(mode == 'sjester')
		{
			$('#jster_img').show();
			$('#user_img').hide();
			$("#you_left").hide();
			$("#product_algo").hide();
			$('#rightproduct_algo').hide();
			$("#jester_left").show();
			jQuery.ajax({
			url: "<?php echo ru;?>process/get_jesterproduct.php",
			type: "GET",
			dataType:'html',
			success:function(response)
			{
				$('#prev_nxt_product').html(response);
				$('#message_div').hide();
			}
			});
			jQuery.ajax({
			url: "<?php echo ru;?>common/step_jesterright.php",
			type: "GET",
			dataType:'html',
			success:function(response)
			{
				$('#jester_right').html(response);
			}
			});
		} else if(mode == 'you')
		{
			$('#user_img').show();
			$('#jster_img').hide();
			$("#jester_right").hide();
			$("#you_left").show();
			$("#product_algo").show();
			$("#product_algo2").hide();
			$("#rightproduct_algo").show();
			$("#jester_left").hide();
		}
	});
});


/***************************SCROLLBAR*******************************/
$('.open-intro_cat').click(function() {
		$('#intro-wrap_cat').animate({
		//opacity: 1,
		
	  }, function(){
		// Animation complete.
	  });
		$('.open-intro_cat').hide();
		$('.close-intro_cat').show();
		$('#contentWrap_cat').slideUp('slow');
	});
	$('.close-intro_cat').click(function() {
		$('#intro-wrap_cat').animate({
		//opacity: 0.25,
		
	  }, function() {
		// Animation complete.
	  });
		$('.open-intro_cat').show();
		$('.close-intro_cat').hide();
		$('#contentWrap_cat').slideDown('slow');
	});
	
$('.open-intro').click(function() {
		$('#intro-wrap').animate({
		//opacity: 1,
		
	  }, function(){
		// Animation complete.
	  });
		$('.open-intro').hide();
		$('.close-intro').show();
		$('#contentWrap').slideUp('fast');
	});
	$('.close-intro').click(function() {
		$('#intro-wrap').animate({
		//opacity: 0.25,
		
	  }, function() {
		// Animation complete.
	  });
		$('.open-intro').show();
		$('.close-intro').hide();
		$('#contentWrap').slideDown('slow');
	});
	
	$('.open-intro2').click(function() {
		$('#intro-wrap2').animate({
		//opacity: 1,
		
	  }, function(){
		// Animation complete.
	  });
		$('.open-intro2').hide();
		$('.close-intro2').show();
		$('#contentWrap2').slideUp('fast');
	});
	$('.close-intro2').click(function() {
		$('#intro-wrap2').animate({
		//opacity: 0.25,
		
	  }, function() {
		// Animation complete.
	  });
		$('.open-intro2').show();
		$('.close-intro2').hide();
		$('#contentWrap2').slideDown('slow');
	});
	
	$('.open-intro4').click(function() {
		$('#intro-wrap4').animate({
		//opacity: 1,
		
	  }, function(){
		// Animation complete.
	  });
		$('.open-intro4').hide();
		$('.close-intro4').show();
		$('#contentWrap4').slideUp('fast');
	});
	$('.close-intro4').click(function() {
		$('#intro-wrap4').animate({
		//opacity: 0.25,
		
	  }, function() {
		// Animation complete.
	  });
		$('.open-intro4').show();
		$('.close-intro4').hide();
		$('#contentWrap4').slideDown('slow');
	});
	
	
	
	$('.open-intro5').click(function() {
		$('#intro-wrap5').animate({
		//opacity: 1,
		
	  }, function(){
		// Animation complete.
	  });
		$('.open-intro5').hide();
		$('.close-intro5').show();
		$('#contentWrap5').slideUp('fast');
	});
	$('.close-intro5').click(function() {
		$('#intro-wrap5').animate({
		//opacity: 0.25,
		
	  }, function() {
		// Animation complete.
	  });
		$('.open-intro5').show();
		$('.close-intro5').hide();
		$('#contentWrap5').slideDown('slow');
	});
	
function funresets()
{
	document.getElementById("SearchForms").reset();
	$("#search").val("");
}

function funresets2()
{
	document.getElementById("SearchForms2").reset();
	$("#from_price").val('');
	$("#to_price").val('');
}

function procloud(id) {
	var myData = 'picID='+id;
	jQuery.ajax({
    url: "<?php echo ru;?>process/get_jesterproduct.php",
	type: "GET",
    dataType:'html',
	data:myData,
    success:function(response)
    {
        $('#prev_nxt_product').html(response);
		$('#product_algo').hide();
		$('#rightproduct_algo').hide();
    }
    });
	
}
function changeprice() {
	var value = $("#from_price").val('$');
	$('#from_price').attr('value');
}
function changeto() {
	var value = $("#to_price").val('$');
	$('#to_price').attr('value');
}
/*------------------ */

</script>				