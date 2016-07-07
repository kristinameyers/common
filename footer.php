<div class="footer">
	<?php if($page == 'home' || $page == 'welcome') { ?>
		<?php if($page == 'home') { ?>
			<div class="footer_top">
					<h2 class="tlt5"><li>Gifting Perfected, Never Rejected</li>
					<li>The True Gift of Choice</li>
					<li>The Purchasing Power of Suggestion</li>
					<li>s&rsquo;Jester &ndash;&ndash; More Than a Gesture</li>
					<li>Economical, Ecological & Logical</li>
					<li>Advanced Digital Transactions for Enhanced Social Interactions</li>
					<li>Generous Becomes Genius</li>
					<li>Make Happy Happen</li>
					<li>The Present With a Future</li>
					<li>Gift&ndash;giving Grief Relief</li>
					<li>Cash Without Being Crass</li>
					</h2>
					<a href="#"><img src="<?php echo ru_resource; ?>images/footer_logo.png" /></a>
			</div>
		<?php } else if($page == 'welcome') { ?>
			<div class="footer_top welcome_ftr">
				<h2>Only gifting, the <span class="i">i</span><span class="f">f</span><span class="t">t</span>Gift way!</h2>
			</div>
		<?php } ?>
		<div class="footer_bottom">
			<div class="links">
				<a href="#">What is iftGift?</a>
				<?php /*?><a href="#">Schedule of iftPoints</a>
				<a href="#">FAQ</a><?php */?>
				<a href="#">Contact</a>
				<?php /*?><a href="#">Survey</a><?php */?>
				<a href="#">Terms</a>
				<a href="#">Privacy</a>
			</div>	
			<p>Protected by one or more of the following US Patent and Patents Pending: 8,280,825 and 8,589,314</p>
			<p>Copyright &copy; 2011, 2012, 2013, 2014, Morris Fritz Friedman &ndash; All Rights Reserved &ndash; iftGiftSM</p>
			<p>All &reg; and TM trademarks/SM service marks are the property of their respective owners</p>
			<p>and may have been used without permission.</p>
			<p>Cash StashSM, iftCliqueSM, iftGiftSM, iftWishSM, Reality CheckSM, REGiftRYSM, s&rsquo;JesterSM, Suggest Gifts Send CashSM &ndash;</p>
			<p>Are all service marks property of Morris Fritz Friedman</p>
		</div>
	<?php } else { ?>	
		<div class="footer_top">
			<div class="links">
				<a href="#">What is iftGift?</a>
				<?php /*?><a href="#">Schedule of iftPoints</a>
				<a href="#">FAQ</a><?php */?>
				<a href="#">Contact</a>
				<?php /*?><a href="#">Survey</a><?php */?>
				<a href="#">Terms</a>
				<a href="#">Privacy</a>
			</div>
		</div>
		<div class="footer_bottom footer_bottom_b">
			<p>Protected by one or more of the following US Patent and Patents Pending: 8,280,825 and 8,589,314</p>
			<p>Copyright &copy; 2011, 2012, 2013, 2014, Morris Fritz Friedman &ndash; All Rights Reserved &ndash; iftGiftSM</p>
			<p>All &reg; and TM trademarks/SM service marks are the property of their respective owners</p>
			<p>and may have been used without permission.</p>
			<p>Cash StashSM, iftCliqueSM, iftGiftSM, iftWishSM, Reality CheckSM, REGiftRYSM, s&rsquo;JesterSM, Suggest Gifts Send CashSM &ndash;</p>
			<p>Are all service marks property of Morris Fritz Friedman</p>
		</div>
	<?php } ?>	
		
	</div>
<?php if($page == 'open') {?>
<script type="text/javascript" src="<?php echo ru_resource; ?>js/openscript.js"></script>
<?php  } else { ?>	
<script type="text/javascript" src="<?php echo ru_resource; ?>js/script.js"></script>
<?php } ?>
<?php if($page == 'checkout_step2' || $page == 'buildshopcheckout2') { ?>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="<?php echo ru_resource; ?>bootstrap_js/bootstrap-min.js"></script>
<script src="<?php echo ru_resource; ?>bootstrap_js/bootstrap-formhelpers-min.js"></script>
<script type="text/javascript" src="<?php echo ru_resource; ?>bootstrap_js/bootstrapValidator-min.js"></script>	
<?php } ?>
<?php if($page == 'buildshopcheckout2') { ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#payment-form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            //valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitHandler: function(validator, form, submitButton) {
                    //var chargeAmount = 3000; //amount you want to charge, in cents. 1000 = $10.00, 2000 = $20.00 ...
                    // createToken returns immediately - the supplied callback submits the form if there are no errors
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val(),
						name: $('.fname').val()+" "+$('.lname').val(),
						address_line1: $('.address').val(),
						address_line2: $('.address2').val(),
						address_city: $('.city').val(),
						address_zip: $('.zip').val(),
						address_state: $('.state').val()
                    }, stripeResponseHandler);
                    return false; // submit from callback
        },
        fields: {
			/*amount: {
                validators: {
                    notEmpty: {
                        message: 'The Amount is required and cannot be empty'
                    },
					digits: {
                        message: 'The Amount can contain digits only'
                    }
                }
            },*/
			cardnumber: {
		selector: '#cardnumber',
                validators: {
                    notEmpty: {
                        message: 'The credit card number is required and can\'t be empty'
                    },
					creditCard: {
						message: 'The credit card number is invalid'
					},
                }
            },
			expMonth: {
                selector: '[data-stripe="exp-month"]',
                validators: {
                    notEmpty: {
                        message: 'The expiration month is required'
                    },
                    digits: {
                        message: 'The expiration month can contain digits only'
                    },
                    callback: {
                        message: 'Expired',
                        callback: function(value, validator) {
                            value = parseInt(value, 10);
                            var year         = validator.getFieldElements('expYear').val(),
                                currentMonth = new Date().getMonth() + 1,
                                currentYear  = new Date().getFullYear();
                            if (value < 0 || value > 12) {
                                return false;
                            }
                            if (year == '') {
                                return true;
                            }
                            year = parseInt(year, 10);
                            if (year > currentYear || (year == currentYear && value > currentMonth)) {
                                validator.updateStatus('expYear', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
            expYear: {
                selector: '[data-stripe="exp-year"]',
                validators: {
                    notEmpty: {
                        message: 'The expiration year is required'
                    },
                    digits: {
                        message: 'The expiration year can contain digits only'
                    },
                    callback: {
                        message: 'Expired',
                        callback: function(value, validator) {
                            value = parseInt(value, 10);
                            var month        = validator.getFieldElements('expMonth').val(),
                                currentMonth = new Date().getMonth() + 1,
                                currentYear  = new Date().getFullYear();
                            if (value < currentYear || value > currentYear + 100) {
                                return false;
                            }
                            if (month == '') {
                                return false;
                            }
                            month = parseInt(month, 10);
                            if (value > currentYear || (value == currentYear && month > currentMonth)) {
                                validator.updateStatus('expMonth', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
			cvv: {
		selector: '#cvv',
                validators: {
                    notEmpty: {
                        message: 'The cvv is required and can\'t be empty'
                    },
					cvv: {
                        message: 'The value is not a valid CVV',
                        creditCardField: 'cardnumber'
                    }
                }
            },
			fname: {
                validators: {
                    notEmpty: {
                        message: 'The First Name is required and cannot be empty'
                    }
                }
            },
			lname: {
                validators: {
                    notEmpty: {
                        message: 'The Last Name is required and cannot be empty'
                    }
                }
            },
            address1: {
                validators: {
                    notEmpty: {
                        message: 'The Address 1 is required and cannot be empty'
                    },
					stringLength: {
                        min: 6,
                        max: 96,
                        message: 'The Address 1 must be more than 6 and less than 96 characters long'
                    }
                }
            },
            city: {
                validators: {
                    notEmpty: {
                        message: 'The city is required and cannot be empty'
                    }
                }
            },
			state: {
                validators: {
                    notEmpty: {
                        message: 'The state is required and cannot be empty'
                    }
                }
            },
			zip: {
                validators: {
                    notEmpty: {
                        message: 'The zip is required and cannot be empty'
                    },
					stringLength: {
                        min: 3,
                        max: 9,
                        message: 'The zip must be more than 3 and less than 9 characters long'
                    },
					digits: {
                        message: 'The Zip Code can contain digits only'
                    }
                }
            },
        }
    });
});
</script>
<?php } else if($page == 'checkout_step2') { ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#payment-form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            //valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitHandler: function(validator, form, submitButton) {
                    //var chargeAmount = 3000; //amount you want to charge, in cents. 1000 = $10.00, 2000 = $20.00 ...
                    // createToken returns immediately - the supplied callback submits the form if there are no errors
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val(),
						name: $('.fname').val()+" "+$('.lname').val(),
						address_line1: $('.address').val(),
						address_line2: $('.address2').val(),
						address_city: $('.city').val(),
						address_zip: $('.zip').val(),
						address_state: $('.state').val()
                    }, stripeResponseHandler);
                    return false; // submit from callback
        },
        fields: {
			/*amount: {
                validators: {
                    notEmpty: {
                        message: 'The Amount is required and cannot be empty'
                    },
					digits: {
                        message: 'The Amount can contain digits only'
                    }
                }
            },*/
			cardnumber: {
		selector: '#cardnumber',
                validators: {
                    notEmpty: {
                        message: 'The credit card number is required and can\'t be empty'
                    },
					creditCard: {
						message: 'The credit card number is invalid'
					},
                }
            },
			expMonth: {
                selector: '[data-stripe="exp-month"]',
                validators: {
                    notEmpty: {
                        message: 'The expiration month is required'
                    },
                    digits: {
                        message: 'The expiration month can contain digits only'
                    },
                    callback: {
                        message: 'Expired',
                        callback: function(value, validator) {
                            value = parseInt(value, 10);
                            var year         = validator.getFieldElements('expYear').val(),
                                currentMonth = new Date().getMonth() + 1,
                                currentYear  = new Date().getFullYear();
                            if (value < 0 || value > 12) {
                                return false;
                            }
                            if (year == '') {
                                return true;
                            }
                            year = parseInt(year, 10);
                            if (year > currentYear || (year == currentYear && value > currentMonth)) {
                                validator.updateStatus('expYear', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
            expYear: {
                selector: '[data-stripe="exp-year"]',
                validators: {
                    notEmpty: {
                        message: 'The expiration year is required'
                    },
                    digits: {
                        message: 'The expiration year can contain digits only'
                    },
                    callback: {
                        message: 'Expired',
                        callback: function(value, validator) {
                            value = parseInt(value, 10);
                            var month        = validator.getFieldElements('expMonth').val(),
                                currentMonth = new Date().getMonth() + 1,
                                currentYear  = new Date().getFullYear();
                            if (value < currentYear || value > currentYear + 100) {
                                return false;
                            }
                            if (month == '') {
                                return false;
                            }
                            month = parseInt(month, 10);
                            if (value > currentYear || (value == currentYear && month > currentMonth)) {
                                validator.updateStatus('expMonth', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
			cvv: {
		selector: '#cvv',
                validators: {
                    notEmpty: {
                        message: 'The cvv is required and can\'t be empty'
                    },
					cvv: {
                        message: 'The value is not a valid CVV',
                        creditCardField: 'cardnumber'
                    }
                }
            },
			fname: {
                validators: {
                    notEmpty: {
                        message: 'The First Name is required and cannot be empty'
                    }
                }
            },
			lname: {
                validators: {
                    notEmpty: {
                        message: 'The Last Name is required and cannot be empty'
                    }
                }
            },
            address1: {
                validators: {
                    notEmpty: {
                        message: 'The Address 1 is required and cannot be empty'
                    },
					stringLength: {
                        min: 6,
                        max: 96,
                        message: 'The Address 1 must be more than 6 and less than 96 characters long'
                    }
                }
            },
            city: {
                validators: {
                    notEmpty: {
                        message: 'The city is required and cannot be empty'
                    }
                }
            },
			state: {
                validators: {
                    notEmpty: {
                        message: 'The state is required and cannot be empty'
                    }
                }
            },
			zip: {
                validators: {
                    notEmpty: {
                        message: 'The zip is required and cannot be empty'
                    },
					stringLength: {
                        min: 3,
                        max: 9,
                        message: 'The zip must be more than 3 and less than 9 characters long'
                    },
					digits: {
                        message: 'The Zip Code can contain digits only'
                    }
                }
            },
        }
    });
});
</script>
<?php } ?>
<?php if($page == 'checkout_step2' || $page == 'buildshopcheckout2') { ?>
<script type="text/javascript">
            // this identifies your website in the createToken call below
            Stripe.setPublishableKey('<?php echo STRIPE_PUBLISH; ?>');
 
            function stripeResponseHandler(status, response) {
				var $form = $('#payment-form');
                if (response.error) {
                    // re-enable the submit button
                    $('.submit-button').removeAttr("disabled");
					// show hidden div
					//document.getElementById('a_x200').style.display = 'block';
                    // show the errors on the form
                    //$(".payment-errors").html(response.error.message);
					$form.find('.payment-errors').text(response.error.message);
                } else {
					
                   // var form$ = $("#payment-form");
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                    // and submit
                    $form.get(0).submit();
                }
            }
</script>	
<?php }
if($page == 'open') {?>
<script>
//var jQuery = $.noConflict();
$j(window).load(function() {
    $j('.overlay').show();
	$j('#model_allfields').slideDown();
    });
function divclose() {
	$j('.overlay').slideUp(500);
	$j('#model_allfields').slideUp(500);
}
</script>
<script type="text/javascript" src="<?php echo ru; ?>game/prototype-1.5.1.js"></script>
<script type="text/javascript" src="<?php echo ru; ?>game/gameconsole.js"></script>
<script type="text/javascript" src="<?php echo ru; ?>game/brickslayer.js"></script>
<script type="text/javascript" src="<?php echo ru; ?>game/soundmanager2.js"></script> 
<script type="text/javascript">
soundManager.url = '<?php echo ru; ?>game/soundmanager2.swf'; // path to movie
soundManager.onload = function () { loadSounds() }; 
soundManager.debugMode = false;
</script>
<script language="javascript">
  initGame(); 
  <!--test code-->
  function loseLife() {
  var id = '<?php echo $delivery_id; ?>';
    soundManager.play('fall');
    if (ballsLeft == 1) {
	//alert(id);
	$j.ajax({
	url: '<?php echo ru;?>process/process_unwrap.php?gId='+id,
	type: 'GET', 
	success: function(output) {
	if(output == 'Success')
	{
		window.location = "<?php echo ru?>open/"+id;
	}
	}
	});
    } else {
        if (el = $("spare" + ballsLeft)) {
	    el.style.display = 'none';
	}
        ballsLeft--;
        ball.stickToPaddle();
    }
}
  
  <!--test code-->
</script>

<?php } ?>
</body>
</html>	