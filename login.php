<?php
include 'connection.php';
session_start();
if (isset($_POST['submit-btn'])){
    $filter_username=filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $username=mysqli_real_escape_string($conn, $filter_username);
    
    $filter_password=filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password=mysqli_real_escape_string($conn, $filter_password);
    
    $select_user=mysqli_query($conn, "SELECT * FROM `users` WHERE username='$filter_username'") or die('query failed');

    if(mysqli_num_rows($select_user)>0){
       $row=mysqli_fetch_assoc($select_user);
       if($row['user_type']=='admin'){
            if($row['username']==$username && $row['password']==$password){
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_username'] = $row['username'];
                $_SESSION['admin_id'] = $row['ID'];
                header("location:phpmyadmin/");
            }else{
                echo '<script>alert("Username/Password is incorrect")</script>'; 
            }
       }else if($row['user_type']=='student'){
            if($row['username']==$username && $row['password']==$password){
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_username'] = $row['username'];
                $_SESSION['user_id'] = $row['ID'];
                header("location:index.php");
            }else{
                echo '<script>alert("Username/Password is incorrect")</script>';
            }
        }else if($row['user_type']=='teacher'){
          if($row['username']==$username && $row['password']==$password){
              $_SESSION['user_name'] = $row['name'];
              $_SESSION['user_username'] = $row['username'];
              $_SESSION['user_id'] = $row['ID'];
              echo'<script type="text/javascript">
                          window.setTimeout(function() {
                              window.location.href="teacher.php";
                              }, 3000);
                      </script>';
              // header("index.html");
          }else{
              echo '<script>alert("Username/Password is incorrect")</script>';
          }
      }else{
          echo `<script>alert("User Type is Invalid")</script>`;
        }
    }else{
        echo `<script>alert("User Doesn't exist")</script>`;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .gradient-custom {
/* fallback for old browsers */
background: #6a11cb;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
}
    </style>
</head>
<body>
    <section class="vh-100" style="/* fallback for old browsers */
    background: #6a11cb;
    
    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
    
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                      alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;;height:500px;" />
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
      
                      <form method="POST" name="Login" onsubmit="required()">
      
                        <div class="d-flex align-items-center mb-3 pb-1">
                          <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                          <span class="h1 fw-bold mb-0">Logo</span>
                        </div>
      
                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
      
                        <div class="form-outline mb-4">
                          <input type="text" id="form2Example17" class="form-control form-control-lg" name="username" />
                          <label class="form-label" for="form2Example17">Username</label>
                        </div>
      
                        <div class="form-outline mb-4">
                          <input type="password" id="form2Example27" class="form-control form-control-lg" name="password" />
                          <label class="form-label" for="form2Example27">Password</label>
                        </div>
      
                        <div class="pt-1 mb-4">
                          <input type="submit" value="submit" class="btn btn-dark btn-lg btn-block" href="login.php" name="submit-btn" onclick="required()"></input>
                          <!-- <a class="btn btn-dark btn-lg btn-block" href="index.html" type="button" name="submit-btn">Login</a> -->
                        </div>

                      </form>
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
<script>
  function required(){
    var empt = document.forms["Login"]["username"].value;
    var empt2=document.forms["Login"]["password"].value;
    if (empt == "" || empt2==""){
      alert("fill all the fields");
      return false;
    }else{
      return true;
    }
    return false;
  }
</script>
</html>