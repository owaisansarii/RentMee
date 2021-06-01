<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="#" />
</head>

<body>
  <?php
  require('data.php');
  $error = "username/password incorrect";
  function process_ip($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $message = "";
  if (isset($_POST['Submit'])) {
    $user = (process_ip($_REQUEST['username']));
    $pass = (process_ip($_REQUEST['password']));
    $query = "SELECT  * from users where username='$user' and password='$pass'";
    $result = pg_query($conn, $query);

    $row = pg_fetch_row($result);
    if (is_array($row)) {
      $_SESSION["Active"] = True;
      $q2 = "SELECT id FROM users where username='$user'";
      $rs = pg_query($conn, $q2) or die("Cannot execute query: $query\n");
      while ($row = pg_fetch_row($rs)) {
        $uid = $row[0];
      }
      $_SESSION["uid"] = $uid;
      header("Location:home.php");
      exit;
    } else {
      $message = "Invalid username/Password";
    }
  }
  ?>
  <div class="container">
    <div class="box1-container">
      <div class="box1">
        <h3>New here ?</h3>
        <i class="v">JOIN US NOW!</i>
        <div class="b">
          <button class="btn transparent" onclick="window.location.href='signup.php'" id="sign-up-btn">
            Sign up
          </button>
        </div>
      </div>
      <img src="img/log1.svg" alt="">
    </div>
    <div class="box2">
      <form action="" method="post" class="sign-in-form">
        <h2 class="title">Sign in</h2>
        <div class="input-field">
          <i class="fas fa-user"></i>
          <input type="text" name="username" placeholder="Username" required />
        </div>
        <div class="input-field">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required />
        </div>
        <?php
        echo '<p style="color: red; display: block;">' . $message . '</p>';
        ?>
        <input type="submit" name="Submit" value="Login" class="btn solid" />
      </form>
    </div>
  </div>
</body>

</html>