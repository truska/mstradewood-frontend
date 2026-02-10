<!-- START contact-form.php -->

        <form class="cmxform" id="commentForm" method="post" action="contacthandler">

            <input type="hidden" class="form-control" name="sourcepage" value="<?php echo $rowpage["slug"] ; ?>">

            <input type="hidden" class="form-control" id="captcha-token" name="token" value="">
            <input type="hidden" class="form-control" id="type" name="type" value="contactform">

            <div class="form-group">
                <label for="exampleInputEmail1">Your Name</label>
                <input type="text" class="form-control required" name="realname" placeholder="Your Name">
                <span class="error" id="nameError" >Name can only contain alpha-numeric characters</span>
            </div>   
            <div class="form-group">
                <label for="exampleInputEmail1">Company</label>
                <input type="text" class="form-control required" name="Company" placeholder="Company/Business Name if applicable">
                <span class="error" id="companyError" >Company can only contain alpha-numeric and selected characters</span>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email Address</label>
                <input type="email" class="form-control required" id="eemail" name="email" placeholder="Email Address">
                <span class="error" id="emailError" >Enter valid Email Address </span>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Contact Number</label>
                <input type="tel" class="form-control required" id="contact" name="tele" placeholder="Telephone">
                <span class="error" id="contactError" >Telephone Day can only contain numeric characters</span>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Postcode or County</label>
                <input type="text" class="form-control required" id="exampleInputEmail1" name="county" placeholder="Postcode or County">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Message or Question</label>
                <textarea class="form-control"  id="message" name="message" rows="5"></textarea>
                <span class="error" id="messageError" >Messages can only contain alpha-numeric and selected characters</span>
            </div>

            <?php 					  
             if( $prefs['prefCaptcha']=='Yes')
             {
                if($prefs['prefCaptchaVer']==2){ ?>
                    <div class="g-recaptcha required" id="recaptcha" data-sitekey="<?php echo $prefs['prefCaptchaSiteKey'] ; ?>"style="display: block;"></div>
                    <p  style="color:red;" id="error-recaptcha"></p>
                <?php 
                }

                if($prefs['prefCaptchaVer']==3) { ?>
                    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo $prefs['prefCaptchaSiteKeyV3'] ; ?>"></script>
                      <script>
                      grecaptcha.ready(function() {
                          grecaptcha.execute('<?php echo $prefs['prefCaptchaSiteKeyV3'] ; ?>', {action: 'homepage'}).then(function(token) {
                             document.getElementById("captcha-token").value = token;
                          });
                      });
                      </script>
                <?php 
                }

                echo "<input type='hidden' class='form-control' name='prefCaptcha' value='yes'>";
             }
             else
             {
                echo "<input type='hidden' class='form-control' name='prefCaptcha' value='no'>";
             }
            ?>
            <p>
                <input class="submit btn btn-default" id="btn-validate" type="submit" value="Submit">
            </p>


        </form>


<style type="text/css">
	.error {
    color: red;
    font-size: 12px;
    display: none;
    font-weight: bold;
}
</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="http://www.truskacms.co.uk/js/jquery.js"></script>
	<script src="http://www.truskacms.co.uk/js/jquery.validate.js"></script>
	<script>
		$( '#btn-validate' ).click(function(){
		  var $captcha = $( '#recaptcha' ),
		      response = grecaptcha.getResponse();
		  
		  	if (response.length === 0) {		  
		    	$( '#error-recaptcha').text( "reCAPTCHA is mandatory" );
			    if( !$captcha.hasClass( "error" ) ){
			      $captcha.addClass( "error" );
			    }
			    $("#commentForm").submit(function(e){
					e.preventDefault();
				});
		  	}
		  	else{		  
				$("#commentForm").submit(function(e){
					e.currentTarget.submit();
				});
			}
		});
		$().ready(function() {
			// validate the comment form when it is submitted
			jQuery.validator.addMethod("fname", function(value, element) {
			  return this.optional(element) ||  /[^ 0-9]/.test(value);
			}, "Name can only contain alpha-numeric characters.");

			jQuery.validator.addMethod("fcompany", function(value, element) {
			  return this.optional(element) ||  /[^ 0-9]/.test(value);
			}, "Company can only contain alpha-numeric and selected characters.");

			jQuery.validator.addMethod("fmsg", function(value, element) {
			  return this.optional(element) ||  /[^ 0-9]/.test(value);
			}, "Messages can only contain alpha-numeric and selected characters.");

			jQuery.validator.addMethod("fnumber", function(value, element) {
			  return this.optional(element) ||  /^[ 0-9-+]+$/.test(value);
			}, "Telephone can only contain numeric characters and minimum 10 numbers.");

			$("#commentForm").validate({
			rules: {
				lastname: "required",
				realname: {
					required: true,
					minlength: 3,
					fname: true,
				},
				Company: {
					required: true,
					fcompany:true
				},
				tele: {
					required: true,
					minlength: 10,
					fnumber: true
				},
				email: {
					required: true,
					email: true
				},
				message: {
					fmsg:true
				},
				agree: "required"
			},
			messages: {
				//realname: "Name can only contain alpha-numeric characters.",
				//Company: "Company can only contain alpha-numeric and selected characters.",
				email: "Enter valid Email Address",
				//tele: "Telephone can only contain numeric characters and minimum 10 numbers.",
			}
		});
		});
	</script>

<!-- END contact-form.php -->