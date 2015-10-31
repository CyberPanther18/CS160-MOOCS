  <section id="register">
  <div class="leftcolumn"></div>
  <div class="rightcolumn">
  <!-- action="./db/register.php" -->
    <form class="register"  method="post" onsubmit="return validate()">
    <h2>Sign Up</h2>
      <input type="text" name="firstname" id="firstname" placeholder="First Name">
      <input type="text" name="lastname" id="lastname" placeholder="Last Name">
      <input type="email" name="email" id="email" placeholder="Email Address" />
      <input type="password" name="password" id="password1" placeholder="Password"/>
      <input type="password" id="password2" placeholder="Confirm Password" />
      <input type="submit" value="Register" class=" button button-primary"/>
       <nav>
        <p>Already have an account?</p>
        <ul>
          <li><a href="#" data-target="login">Sign In</a></li>
        </ul>
      </nav>
    </form>
    <script type="application/javascript">
	
    </script>
    </div>
  </section>