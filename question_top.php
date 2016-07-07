<div id="cart_suggest"></div>
	<?php if($_SESSION['question_ans']) { ?>
	<div id="no_cart" class="no_card_ques">
		<?php
		include_once("process/question_functions.php");
		$max=count($_SESSION['question_ans']);
		?>
		<div id="slider1">
			<?php if($max >= '7') {?>
				<a class="buttons prev" href="#"><img src="<?php echo ru_resource;?>images/arrow_l.png" alt="Arrow" /></a>
			<?php } ?>
			<div class="viewport">
				<ul class="overview">
					<?php	
						for($i=0;$i<$max;$i++){
						$qid=$_SESSION['question_ans'][$i]['qid'];
						$q=$_SESSION['question_ans'][$i]['qty'];
					?>
					<li>
						<div class="sugget_item">
							<div class="sugget_item_inner">
								<a href="javascript"><img alt="close" src="<?php echo ru_resource;?>images/zoom_icon.png"></a>
								<h4>Q&A# </h4> <h4>A- <?php echo $qid;?></h4>
							</div>
							<a href="javascript:del(<?php echo $qid?>)"><img class="closed" alt="close" src="<?php echo ru_resource;?>images/close.png"></a>
						</div>	
					</li>
					<script type="text/javascript">
						$(function () {
							var qId = '<?php echo $qid;?>';
							$('#'+qId).prop( "checked", true ); 
						})
					</script>													
					<?php } ?>
					<?php if($max == '1') {?>
						<div class="sugget_item">
							<img alt="Question Answer C" src="<?php echo ru_resource;?>images/qa_c.jpg">
						</div>
						<div class="sugget_item">
							<img alt="Question Answer C" src="<?php echo ru_resource;?>images/qa_c.jpg">
						</div>
						<div class="sugget_item">
							<img alt="Question Answer C" src="<?php echo ru_resource;?>images/qa_c.jpg">
						</div>
						<div class="sugget_item">
							<img alt="Question Answer D" src="<?php echo ru_resource;?>images/qa_c.jpg">
						</div>
						<div class="sugget_item">
							<img alt="Question Answer E" src="<?php echo ru_resource;?>images/qa_c.jpg">
						</div>
					<?php } else if($max == '2') {?>
						<div class="sugget_item">
							<img alt="Question Answer C" src="<?php echo ru_resource;?>images/qa_c.jpg">
						</div>
						<div class="sugget_item">
							<img alt="Question Answer C" src="<?php echo ru_resource;?>images/qa_c.jpg">
						</div>
						<div class="sugget_item">
							<img alt="Question Answer C" src="<?php echo ru_resource;?>images/qa_c.jpg">
						</div>
						<div class="sugget_item">
							<img alt="Question Answer D" src="<?php echo ru_resource;?>images/qa_c.jpg">
						</div>
					<?php } else if($max == '3') {?>
						<div class="sugget_item">
							<img alt="Question Answer C" src="<?php echo ru_resource;?>images/qa_c.jpg">
						</div>
						<div class="sugget_item">
							<img alt="Question Answer C" src="<?php echo ru_resource;?>images/qa_c.jpg">
						</div>
						<div class="sugget_item">
							<img alt="Question Answer C" src="<?php echo ru_resource;?>images/qa_c.jpg">
						</div>
					<?php } else if($max == '4') {?>
						<div class="sugget_item">
							<img alt="Question Answer C" src="<?php echo ru_resource;?>images/qa_c.jpg">
						</div>
						<div class="sugget_item">
							<img alt="Question Answer C" src="<?php echo ru_resource;?>images/qa_c.jpg">
						</div>
					<?php } else if($max == '5') {?>
						<div class="sugget_item">
							<img alt="Question Answer C" src="<?php echo ru_resource;?>images/qa_c.jpg">
						</div>
					<?php } else if($max == '6') {} ?>				
				</ul>
			</div>
			<?php if($max >= '7') {?>
				<a class="buttons next" href="#"><img src="<?php echo ru_resource;?>images/arrow_k.png" alt="Arrow" /></a>
			<?php } ?>
		</div>
	</div>
	<?php } else { ?>
		<div id="no_cart" class="no_card_ques">		
			<div class="sugget_item">
				<img alt="Question Answer C" src="<?php echo ru_resource;?>images/qa_c.jpg">
			</div>
			<div class="sugget_item">
				<img alt="Question Answer C" src="<?php echo ru_resource;?>images/qa_c.jpg">
			</div>
			<div class="sugget_item">
				<img alt="Question Answer C" src="<?php echo ru_resource;?>images/qa_c.jpg">
			</div>
			<div class="sugget_item">
				<img alt="Question Answer D" src="<?php echo ru_resource;?>images/qa_c.jpg">
			</div>
			<div class="sugget_item">
				<img alt="Question Answer E" src="<?php echo ru_resource;?>images/qa_c.jpg">
			</div>
			<div class="sugget_item">
				<img alt="Question Answer F" src="<?php echo ru_resource;?>images/qa_c.jpg">
			</div>
		</div>
	<?php } ?>
<script type="text/javascript">
function del(qid){
	var myData = 'qid='+qid+'&type=delete';
	$.ajax({
		url: "<?php echo ru;?>process/process_question.php",
		type: "GET",
		data: myData,
		success:function(output) {
			$('#cart_suggest').html(output);
			$('#cart_suggest').addClass('no_card_ques');
			$('#'+qid).prop('checked', false);
			$('#no_cart').hide();
		}
	});
}
</script>