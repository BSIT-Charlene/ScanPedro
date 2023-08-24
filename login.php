<?php
session_start();
require "./php/config.php";

if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $typeId = $_POST["type_id"];

  $query = "SELECT * FROM `users` 
            INNER JOIN `user_type` ON users.type_id = user_type.type_id 
            WHERE users.username = '$username' AND users.type_id = '$typeId';";

  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  if (mysqli_num_rows($result) > 0) {
    if ($password === $row['password']) {
      echo "<script> alert('Login Successful'); </script>";
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      header("Location: dashboard.html");
    } else {
      echo "<script> alert('Wrong Password'); </script>";
    }
  } else {
    echo "<script> alert('User Not Registered'); </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login | Scan Pedro</title>
  <link rel="stylesheet" href="./css/boxicons.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./fonts/poppins.css">
  <link rel="stylesheet" href="./css/login.css">
</head>
<body>
  <div class="page-section">
    <div class="col-8 title-side">
      <div class="cityhall-img">
        <img src="./img/cityhall.jpg" alt="">
      </div>
      <div class="overlay"></div>
      <div class="title">
        <div class="title-container">
          <div class="row">
            <div class="logo-img">
              <img src="./img/sanpedro-logo.png" alt="">
            </div>
          </div>
          <div class="row tru-text">
            Transportation Regulatory Unit
          </div>
          <div class="row tru-text-2">
            City of San Pedro, Laguna
          </div>
          <div class="row tru-text-3">
            "Endeavors to stand for and serve the riding public."
          </div>
        </div>
      </div>
    </div>
    <div class="col login-side">
      <i class='bx bx-qr-scan logo'></i>
      <span class="scanpedro-text"><i>Scan Pedro</i></span>
      <span class="scanpedro-text-2">QR-Code Record Management System</span>
      <form action="" method="POST">
        <div class="input">
          <div class="row">
            <span>Username</span>
          </div>
          <div class="row">
            <input type="text" name="username" id="" placeholder="Enter Username" required>
          </div>
        </div>
        <div class="input">
          <div class="row">
            <span>Password</span>
          </div>
          <div class="row input-with-icon">
            <input type="password" name="password" id="password" placeholder="Enter Password" required>
            <i class='bx bxs-hide hide-icon' id="togglePassword"></i>
          </div>
        </div>      
        <div class="input">
          <div class="row">
            <span>User Type</span>
          </div>
          <div class="row">
            <select name="type_id" id="" required>
              <option value="" disabled selected>Choose User Type</option>
              <option value="1">Super Admin</option>
              <option value="2">Admin</option>
            </select>
          </div>
        </div>
        <div class="input forgot-pw">
          <div class="row">
            <a href=""><u>Forgot Password?</u></a>
          </div>
        </div>
        <div class="input">
          <div class="row">
            <input type="submit" value="Login" class="login-btn" name="submit">
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    const passwordInput = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");
  
    togglePassword.addEventListener("click", () => {
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        togglePassword.classList.remove("bxs-hide");
        togglePassword.classList.add("bxs-show");
      } else {
        passwordInput.type = "password";
        togglePassword.classList.remove("bxs-show");
        togglePassword.classList.add("bxs-hide");
      }
    });
  </script>

</body>
</html>
