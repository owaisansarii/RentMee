<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>
    <script>
        // Function to check Whether both passwords
        // is same or not.
        function checkPassword(form) {
            password1 = form.password.value;
            password2 = form.cnfpassword.value;

            // If password not entered
            if (password1 == '') {
                alert("Please enter Password");
                return false;
            }

            // If confirm password not entered
            else if (password2 == '') {
                alert("Please enter confirm password");
                return false;
            }

            // If Not same return False.    
            else if (password1 != password2) {
                alert("\nPassword did not match: Please try again...")
                return false;
            }

            // If same return True.
            else {
                alert("Password Matched: You can now login!")
                return true;
            }
        }
    </script>
</head>

<body>
    <?php
    require('data.php');
    function process_ip($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if (isset($_REQUEST['username'])) {
        $user = process_ip($_REQUEST['username']);
        $email = process_ip($_REQUEST['email']);
        $pass = process_ip($_REQUEST['password']);
        $cpass = process_ip($_REQUEST['cnfpassword']);
        $query = "INSERT into users (username, email, password)
                VALUES ('$user','$email','$pass')";
        $result = pg_query($conn, $query);
        if ($result) {
            header("location:login.php");
        } else {
            echo "<div class='form'>
              <h3>Required fields are missing.</h3><br/>
              <p class ='link'>Click here to <a href='signup.php'>Try again</a></p>
              </div>";
        }
    } else {
    ?>
        <div class="container">
            <div class="box1-container">
                <div class="box1">
                    <h3>
                        Already have an Account?
                    </h3>
                    <div class="b">
                        <button class="btn transparent" onclick="window.location.href='login.php'" id="sign-up-btn">
                            Sign in
                        </button>
                    </div>
                </div>
                <img src="img/log1.svg" alt="" />
            </div>
            <div class="box2-s">
                <form action="" method="post" onSubmit="return checkPassword(this)" class="sign-in-form">
                    <h2 class="title">Sign up</h2>
                    <h3 class="v">Welcome to Online Renting System</h3>

                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="cnfpassword" placeholder="Confirm Password" required />
                    </div>
                    <input type="submit" value="Sign-up" class="btn solid" />
                </form>
            </div>
        </div>
    <?php
    }
    ?>
</body>

</html>