<?php
	$getuserImg = $db->get_row("select user_image from ".tbl_user." where userid = '".$_SESSION['LOGINDATA']['USERID']."'",ARRAY_A);
	$user_thumbimg = ru.'media/user_image/'.$_SESSION['LOGINDATA']['USERID'].'/thumb/'.$getuserImg['user_image'];
?>
<!--testing code for popup-->
	<div class="overlay" <?php	 if ( isset ($_SESSION['user_val']) ) {?>style="display:block" <?php } else {?> style="display:none"<?php }?>></div>
	
	<div class="modal" id="model_allfields" style="display:none">
	<a style="cursor:pointer" onClick="close_div();">
		<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
	</a>
	<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
	<div class="valid_msg"> Comming Soon!</div>
	
	<a style="cursor:pointer" class="orange" onClick="close_div();">
		Bach to Dashboard
	</a>
</div>
			<!--<div class="modal modal_b modal_c" id="thankyou_div_"  style="display:none">-->
			
		
			<div class="modal modal_b modal_c" id="thankyou_div_"  <?php	 if ( isset ($_SESSION['user_val']) ) {?>style="display:block" <?php } else {?> style="display:none"<?php }?>>
			<?php
			if ( isset ($_SESSION['user_val']) ) { 
			foreach($_SESSION['user_val'] as $key=>$value) { 
			   								 echo $value ."<br />"; ?>
										 
								<?php }	} unset ($_SESSION['user_val']);?>
						<a style="cursor:pointer" onClick="close_div();">
							<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
						</a>
						<div class="mid_contant thankyou">
							<div class="cont_bar_inner cont_bar_inner_d">
								<h4 class="snd">invite by email</h4>
								<img src="<?php echo ru_resource;?>images/jester_ar.jpg" alt="Jester Image" class="reg_jst_a reg_jst_e" />
								<div class="regs_form send_ques send_tansk" style="margin:0">
									<form id="invite_email" action="<?php echo ru; ?>process/process_invite_by_email.php" method="post"  >
									<!--<?php //echo ru; ?>process/process_invite_by_email.php-->
										<div class="flied fill" style="width: 77%;">
										<input type="text" name="name" id="name" placeholder="Enter Name Please" value="<?php echo $_SESSION['user_val']['name']; ?>"/>
										<input type="email" name="email" id="email" placeholder="Enter email please" value="<?php echo $_SESSION['user_val']['email']; ?>" />
										<input type="text" name="subject" id="subject" placeholder="So recipient sees in the email subject line that it&acute;s you and not SPAM"  value="<?php echo $_SESSION['user_val']['subject']; ?>" />
										<textarea name="message" id="message" placeholder="[Enter Your Text Here]" > <?php echo $_SESSION['user_val']['message']; ?></textarea>
										<input type="submit" name="invite" id="invite" value="Send mail">
										</div>
									</form>
									
								</div>
							</div>
						</div>
					</div>

<div class="dash_left">
	<div class="upload_img">
		<?php
			if(@getimagesize($user_thumbimg)) {
		?>
			<a href="<?php echo ru;?>photo_upload"><img src="<?php echo $user_thumbimg; ?>" alt="Upload Image" /></a>		
		<?php } else { ?>
			<a href="<?php echo ru;?>photo_upload"><img src="<?php echo ru_resource; ?>images/upload_img.jpg" alt="Upload Image" /></a>
		<?php } ?>

	</div>
										<br /><br /><br /><br /><br /><br />
							<a href="javascript:;" onclick="FBLogin()">Facebook</a><br />
							<a href="javascript:;" onclick="cmgsoon();">Linkedin</a><br />
							<a href="javascript:;"  onclick="cmgsoon();">Twitter</a><br />
							<a href="javascript:;"  onclick="cmgsoon();"> Google Plus</a> <br />
							<a href="javascript:;"  onclick="invitebyemail();"> Invite By Email</a> 
</div>
		<?php 
	unset($_SESSION['user_error']); 
	?>	
     
<script>
function cmgsoon() {
	$('.overlay').show();
	$('#model_allfields').slideDown();
}
function invitebyemail() {
	$('.overlay').show();
	$('#thankyou_div_').slideDown();
}
</script>
<script type="text/javascript">
function validateForm()
    {
		var erormsg='';
    var a=document.forms["invite_email"]["name"].value;
    var b=document.forms["invite_email"]["email"].value;
    var c=document.forms["invite_email"]["subject"].value;
    var d=document.forms["invite_email"]["message"].value;
    if (a==null || a==""){
      alert("Please Fill the name Field");
      return false;
      }
	  if(b==null || b==""){
	  	alert("Please Fill the eamil Field");
      return false;
	  }
	  if(c==null || c==""){
	  	alert("Please Fill the subject Field");
      return false;
	  }
	  if(d==null || d==""){
	  	alert("Please Fillthe  message Field");
      return false;
	  }
    }
    </script>
