<?php session_start(); ?>
<!DOCTYPE html>
<html>
<body>

<form action="login_u.php" method="post">
  <label>Login:</label><br>
  <input type="text" name="login"><br>
  <label>Hasło:</label><br>
  <input type="password" name="haslo"><br><br>
  <input type="submit" value="Zaloguj">
</form> 
<p style="color:red;"><?php if (isset($_SESSION['error'])){ 
echo $_SESSION['error'];
unset($_SESSION['error']);
}
?> </p>

</body>
</html>
