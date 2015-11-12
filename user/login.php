<section id="login">
	<h2>Sign in</h2>
  <form class="login" action="./db/login.php" method="post">
  <label for"email">Email </label>
    <input type="email" name="email" id="email" placeholder="Email Address" />
    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Password"/>
    <div id="formerrors"></div>
    <input type="submit" value="Sign in" class=" button button-primary"/>
    <div class="divider">
    <h5 >New to Ulearn?</h5>
    </div>
    <div class="button button-alternate">Create an account</div>
  </form>
  
  <div class="button close">Close</div>
  <script type="application/javascript">
  $("form input").focusout(function() {
	"use strict";
		var $value = $(this).val();
        if ($value === null || $value === ""){
			$(this).addClass("invalid");
			$(this).effect("shake");
		} else{
			if($(this).hasClass("invalid")){
				$(this).removeClass("invalid");
			}
			$(this).addClass("valid");
		}
    });
	
   $("form").submit(function(event){
	"use strict";
	var validated = true;
	var errors = "<ul class='error'>";
	var email = $("#email").val();
	var password = $("#password").val();
	if(email.length < 7){
		errors += "<li>Email must be 7 or more characters.</li>";
		validated = false;
	}
	if(password.length < 7){
		errors += "<li>Password must be 6 or more characters.</li>";
		validated = false;
	}
	if(validated){
		return true;
	} else{
		errors += "</ul>";
		$("#formerrors").html(errors);
		event.preventDefault();
	}
});
    </script> 
</section>
