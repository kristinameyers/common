<!DOCTYPE html>
<html>
<head>
<title>Ift Gift</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" href="<?php echo ru_resource; ?>css/style.css" />
<link rel="shortcut icon" href="<?php echo ru; ?>favicon.ico"/>
<!--[if lt IE 9]><script type="text/javascript" src="excanvas.js"></script><![endif]-->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="<?php echo ru_resource; ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<?php if($page == 'home') {  ?>
	<link href="<?php echo ru_resource;?>css/animate.css" rel="stylesheet">
	<script src="<?php echo ru_resource;?>js/jquery.lettering.js"></script>
	<script src="<?php echo ru_resource;?>js/jquery.textillate.js"></script>
	<script src="<?php echo ru_resource; ?>js/tagcanvas.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		window.onload = function() {
			try {
				TagCanvas.Start('myCanvas','tags',{
				textColour: '#000000',
				outlineColour: '#ff00ff',
				outlineMethod: 'none',
				reverse: true,
				maxSpeed: 0.25,
				depth: 0.99,
				weight: true,
				weightMode: "size",
				weightFrom: null,
				activeCursor: 'auto',
				initial : [0.1,-0.1],
				decel : 0.98,
				maxSpeed : 0.24,
				minBrightness : 0.2,
				depth : 0.92,
				pulsateTo : 0.6
				});
				} catch(e) {
				// something went wrong, hide the canvas container
				document.getElementById('myCanvasContainer').style.display = 'none';
			}
		};
	</script>
<?php } else if($page == 'step_2a' || $page == 'search_result' || $page == 'mine' || $page == 'theris' || $page == 'only' || $page == 'iftClique' || $page == 'similar_persons' || $page == 'locked' || $page == 'shopproduct') { ?>
	<link rel="stylesheet" href="<?php echo ru_resource; ?>css/jquery.mCustomScrollbar.min.css">
	<script src="<?php echo ru_resource; ?>js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?php echo ru_resource;?>js/jquery-ui.js"></script>
		
	<script src="<?php echo ru_resource;?>js/jquery-ui-slider-pips.js"></script>
	
		<script type="text/javascript">
			$(document).ready(function(){
			
				$(".user").click(function(){
					$(".cata_sub").slideToggle();
				});
			});
			
			$(document).ready(function(){
			  $(".prod").on('click',function(){
				var str = this.id;
				var category = str.replace("category_", ""); 
				$("#drop-down_"+category).slideToggle('slow');
				$( this ).toggleClass("active");
				$.ajax({
					url: '<?php echo ru;?>process/get_catpro.php?catid='+category,
					type: 'get',
					success: function(output) {
					$('#prev_nxt_product').html(output);
					<?php if($_SERVER['REQUEST_URI'] == '/step_2a' || $_SERVER['REQUEST_URI'] == '/shopproduct' ) {?>
						$("#load_productright").load("<?php echo $ru;?>common/get_productright.php?catid="+category);
					<?php } ?>
					$('#product_algo').hide();
					$('#load_product').hide();
					$('#rightproduct_algo2').hide();
					$('#rightproduct_algo').hide();
					$('#message_div').hide();
					},
					beforeSend: function(){
					$('.overlay').show();
					$('.loaderr').show();  
					  
					},
					complete: function(){
					$('.loaderr').hide();
					$('.overlay').hide();  			
			    }
				});
			  });
		  
			  $(".sub_cats").on('click', function () {
				var str = this.id;
				$.ajax({
					url: '<?php echo ru;?>process/get_subcatpro.php?scatid='+str,
					type: 'get',
					success: function(output) {
					$('#prev_nxt_product').html(output);
					$('#product_algo').hide();
					$('#load_product').hide();
					$('#rightproduct_algo2').hide();
					$('#rightproduct_algo').hide();
					<?php  if($_SERVER['REQUEST_URI'] == '/step_2a' || $_SERVER['REQUEST_URI'] == '/shopproduct') {?>
						$("#load_productright").load("<?php echo $ru;?>common/get_productright.php?scatid="+str);
					<?php } ?>	
					//$('#message_div').hide();
					},
					beforeSend: function(){
					$('.overlay').show();
					$('.loaderr').show();  
					  
					},
					complete: function(){
					$('.loaderr').hide();
					$('.overlay').hide();  			
			    }
				});
			  });
			});
        </script>
		
	<?php } else if($page == 'open') { ?>
		<script type="text/javascript">
		jQuery.noConflict();
			jQuery(document).ready(function(){
				jQuery(".user").click(function(){
					jQuery(".cata_sub").slideToggle();
				});
			});
		</script>	
	<?php } else { ?>
	<script type="text/javascript">
		$(document).ready(function(){
		  	$(".user").click(function(){
				$(".cata_sub").slideToggle();
		  	});
		});
		
		function close_div()
  		{
  			
			$(".modal").slideUp("slow");
			$(".overlay").css("display","none");
			
  	   }
	   
	   function IsEmail(email) {
        var regex = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return regex.test(email);
	   }
	</script>	
	<style>
		/*.hightlight{border:1px solid #ea4e18 !important}
		 overlay styles, all needed */
		/*.overlay{position:fixed; top:0; left:0; height:100%; width:100%; background:url(resource/images/overlay_bg.png); z-index:9999999}
		.modal{width:auto; max-width:510px; padding:20px; height:auto; background:#fff; position:fixed; top:50%; left:50%; margin-top:-110px; margin-left:-280px; -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; behavior:url(PIE.htc); text-align:center; z-index: 99999999}
		.modal img{float:left; margin:0}
		.valid_msg{font-size:18px; color:#3b3e3c; font-family: 'open_sansbold'; float:left; margin:-18px 0 0 136px}
		.valid_msg span{color:#ea4e18}
		.modal a{float:right;}
		.modal a img{ margin:-38px -38px 0 0}*/
	  </style>
	<?php } ?>
	<?php if($page == 'step_1' || $page == 'personal_information' || $page == 'withdraw_cash' || $page == 'deposit_cash' || $page == 'personal_reminder' || $page == 'checkout' || $page == 'checkout_step2' || $page == 'questionsadd' || $page == 'buildcheckoutshop' || $page == 'buildshopcheckout2') { ?>	
<script type="text/javascript">	
$(document).ready(function(){
	$(".custom-select").each(function(){
		$(this).wrap("<span class='select-wrapper'></span>");
		$(this).after("<span class='holder'></span>");
	});
	$(".custom-select").change(function(){
		var selectedOption = $(this).find(":selected").text();
		$(this).next(".holder").text(selectedOption);
	}).trigger('change');
})
</script>
<?php } ?>
<?php if($page == 'inbox' || $page == 'outbox' || $page == 'wishlist' || $page == 'owned' || $page == 'hidden') { ?>
<script src="<?php echo ru_resource; ?>/js/core.js" type="text/javascript"></script>
<?php } ?>
<?php if($page == 'wishlist' || $page == 'owned' || $page == 'hidden') { ?>
<link rel="stylesheet" href="<?php echo ru_resource?>js/datepicker/jquery-ui.css">
<script src="<?php echo ru_resource?>js/datepicker/jquery-ui.js"></script>	
<script language="javascript">
$(function() {
	$("#datepicker").hide();
	$("#buttonHere").click(function(){
		$("#datepicker").toggle();
	}); 

	$("#datepicker").datepicker({ 
		onSelect: function(data, date) {
			var pieces = data.split('/');
			$('#day').val(pieces[1]);
			$('#month').val(pieces[0]);
			$('#year').val(pieces[2]);
			$("#datepicker").hide(); 
		} 
	});
	
	$("#datepickers").hide();
	$("#buttonHeres").click(function(){
		$("#datepickers").toggle();
	}); 

	$("#datepickers").datepicker({ 
		onSelect: function(data, date) {
			var pieces = data.split('/');
			$('#days').val(pieces[1]);
			$('#months').val(pieces[0]);
			$('#years').val(pieces[2]);
			$("#datepickers").hide(); 
		} 
	});
});
</script>
<script>
$(document).ready(function(){
  $(".expirat").click(function(){
	$("#expirat_down").show();
	$("#amount_down").hide();
	$("#item_down").hide();
  });

  $(".amount").click(function(){
	$("#amount_down").show();
	$("#expirat_down").hide();
	$("#item_down").hide();
  });

  $(".items").click(function(){
	$("#item_down").show();
	$("#expirat_down").hide();
	$("#amount_down").hide();
  });
});	
</script>
<?php } ?>
</head>
<body>
<?php if($page == 'step_2a' ){?>
<div class="loaderr" >
   <center>
       <img class="loading-image" src="<?php echo ru_resource; ?>images/spinner2.gif" alt="loading.." >
   </center>
</div>
 <div class="overlay" style="display:none"></div>
<?php }?>
<?php if($page == 'home' || $page == 'register' || $page == 'login' || $page == 'forget_password' || $page == 'thankyou' || $page == 'welcome' || $page == 'reset_password' || $page == 'iftgiftgame') { ?>
	<div class="top_bar">
		<div class="top_bar_inner">
			<a href="<?php echo ru;?>"><img src="<?php echo ru_resource; ?>images/logo.png" alt="logo" title="logo" class="logo" /></a>
			<div class="top_right">
				<div class="top_right_inner">
					<a href="<?php echo ru;?>">Home</a>
					<a href="#">Contact</a>
					<?php if(isset($_SESSION['LOGINDATA']['ISLOGIN'])) { ?>
					<a href="<?php echo ru; ?>dashboard">Dashboard</a>
					<a href="<?php echo ru; ?>logout">Logout</a>
					<?php } else { ?>
					<a href="<?php echo ru;?>step_1">Send a Gift</a>
					<a href="<?php echo ru;?>register" class="reg">Register </a>
					<a href="<?php echo ru;?>login" class="reg signin">Sign in</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } else if(isset($_SESSION['LOGINDATA']['ISLOGIN'])){  ?>		
	<div class="top_bar">
		<div class="top_bar_inner">
			<a href="<?php echo ru;?>"><img src="<?php echo ru_resource; ?>images/logo.png" alt="logo" title="logo" class="logo" /></a>
			<div class="top_right">
				<div class="top_right_inner">
					<div class="container">
						<a class="toggleMenu"   href="#">Menu</a>
						
						<ul class="nav">
							<li class="test" >
								<a href="<?php echo ru;?>dashboard">
									<img src="<?php echo ru_resource; ?>images/nav_icon_a.png" />
									<span class="nav_text text_nav">Dashboard</span>
								</a>
							</li>
							<li>
								<a href="<?php echo ru;?>gift_collect">
									<img src="<?php echo ru_resource; ?>images/nav_icon_b.png" />
									<span class="nav_text text_nav">Unwrap</span>
								</a>
							</li>
							<li>
								<a href="<?php echo ru; ?>step_1">
									<img src="<?php echo ru_resource; ?>images/nav_icon_c.png" />
									<span class="nav_text text_nav">Send</span>
								</a>
							</li>
							<?php
								if(isset($_SESSION['LOGINDATA']['ISLOGIN'])) {
									$get_uimage = "select u.first_name,u.last_name,u.email,u.available_cash,u.user_image,p.points from ".tbl_user." as u, ".tbl_userpoints." as p where p.userId = u.userId and u.userId = '".$_SESSION['LOGINDATA']['USERID']."'"; 
									$view_image = $db->get_row($get_uimage,ARRAY_A);
									if($view_image > 0)
									{	
										$userId = $_SESSION['LOGINDATA']['USERID'];
										$user_name = ucfirst($view_image['first_name']);
										$user_points = $view_image['points'];
										$user_cashstash = $view_image['available_cash'];
										$user_first_name = $view_image['first_name'];
									}
								} else {
										$get_uimage = "select u.first_name,u.last_name,u.email,u.available_cash,u.user_image,p.points from ".tbl_user." as u, ".tbl_userpoints." as p where p.userId = u.userId and u.userId = '".$_COOKIE['USERID']."'"; 
									$view_image = $db->get_row($get_uimage,ARRAY_A);
									if($view_image > 0)
									{	
										$userId = $_COOKIE['USERID'];
										$user_name = ucfirst($view_image['first_name']);
										$user_points = $view_image['points'];
										$user_cashstash = $view_image['available_cash'];
										$user_first_name = $view_image['first_name'];
										$_SESSION['LOGINDATA']['USERID'] = $_COOKIE['USERID'];
									}
								}
							?>
							<li>
								<img src="<?php echo ru_resource; ?>images/nav_icon_d.png" />
								<a href="#"><span class="pink">Cash</span><span class="blue">^</span><span class="orang">Stash</span> <img src="<?php echo ru_resource; ?>images/arrow.png" alt="Down Arrow Icon" /></a>
								<ul>
									<li><a href="#">$<?php echo $user_cashstash;?></a></li>
									<li><a href="<?php echo ru;?>transfer_cash">Transfer Cash</a></li>
									<li><a href="<?php echo ru;?>shopproduct">Shop iftGift</a></li>
								</ul>
							</li>
							<li>
								<img src="<?php echo ru_resource; ?>images/nav_icon_e.png" />
								<a href="#">s&rsquo;Jester <span class="pink">Q</span><span class="blue">&amp;</span><span class="orang">A</span> <img src="<?php echo ru_resource; ?>images/arrow.png" alt="Down Arrow Icon" /></a>
								<ul>
									<li><a href="<?php echo ru;?>questionsadd">Answer Q&A</a></li>
									<li><a href="<?php echo ru;?>question_library">Question Library</a></li>
								</ul>
							</li>
							<li class="last">
								<a href="<?php echo ru;?>controls">
									<img src="<?php echo ru_resource; ?>images/nav_icon_f.png" />
									<span class="nav_text text_nav">Controls</span>
								</a>
							</li>
						</ul>
					</div>
					<a href="#" class="reg point"><?php echo $user_points;?> Points</a>
					<a href="javascript:;" class="reg user"><img src="<?php echo ru_resource; ?>images/user_icon.png" alt="Profile Icon" /><?php echo $user_name;?><img src="<?php echo ru_resource; ?>images/arrow.png" alt="Down Arrow Icon" class="down_arrw" /></a>
				</div>
			</div>
			<ul class="cata_sub" style="display:none">
				<li><a href="<?php echo ru; ?>personal_information">Personal Information</a></li>
				<li><a href="<?php echo ru; ?>logout">Logout</a></li>
			</ul>
		</div>
	</div>
<?php } else{ ?>	
			<div class="top_bar">
		<div class="top_bar_inner">
			<a href="<?php echo ru;?>"><img src="<?php echo ru_resource; ?>images/logo.png" alt="logo" title="logo" class="logo" /></a>
			<div class="top_right">
				<div class="top_right_inner">
					<a href="<?php echo ru;?>">Home</a>
					<a href="<?php echo ru;?>step_1">Send a Gift</a>
					<a href="#">Contact</a>
					<?php if(isset($_SESSION['LOGINDATA']['ISLOGIN'])) { ?>
					<a href="<?php echo ru; ?>dashboard">Dashboard</a>
					<a href="<?php echo ru; ?>logout">Logout</a>
					<?php } else { ?>
					<a href="<?php echo ru;?>register" class="reg">Register </a>
					<a href="<?php echo ru;?>login" class="reg signin">Sign in</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

