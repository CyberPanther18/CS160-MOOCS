  <section id="register">
   <h2>Sign Up</h2>
    <form class="register" action="../db/register.php" method="post">
     <label for="firstname">First Name</label>
      <input type="text" name="firstname" id="firstname" placeholder="First Name">
       <label for="lastname">Last Name</label>
      <input type="text" name="lastname" id="lastname" placeholder="Last Name">
       <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="Email Address" />
       <label for="password1">Password</label>
      <input type="password" name="password" id="password1" placeholder="Password"/>
       <label for="password2">Confirm Password</label>
      <input type="password" id="password2" placeholder="Confirm Password" />
      <input type="submit" value="Register" class=" button button-primary"/>
      <div class="divider">
    <h5>Already have an account?</h5>
    </div>
    <div class="button button-alternate">Sign in here</div>
    </form>
      <div class="button close">Close</div>
    <script type="application/javascript" src="../js/validate.js">
    </script>
</section>