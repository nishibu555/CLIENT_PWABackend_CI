<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url()?>assets/css/sb-admin-2.min.css" rel="stylesheet">
 <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
</head>

<body class="bg-gradient-primary">

  <div class="container" ng-app="loginApp">

    <!-- Outer Row -->
    <div class="row justify-content-center" ng-controller="myController">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                      <span style="color:red">
                      <?php echo validation_errors(); ?>
                    </span>
                      <span style="color:red;">{{ not_match }}</span>
                  <form class="user" enctype="multipart/form-data" method="POST">
                  <!-- <form class="user" action="check_login" enctype="multipart/form-data" method="POST"> -->
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="email" placeholder="Enter Email Address..." ng-model="email">
                      <span style="color:red;">{{ email_error }}</span>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" ng-model="password">
                      <span style="color:red;">{{ pass_error }}</span>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" ng-model="remember" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <!-- <a href="index.html" class="btn btn-primary btn-user btn-block">
                      Login
                    </a> -->

                    <button class="btn btn-primary btn-user btn-block" ng-click="login_check()">Login</button>
                    <hr>
                    <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url()?>assets/js/sb-admin-2.min.js"></script>

<script>
var app = angular.module('loginApp', []);
app.controller('myController', function($scope, $http) {


$scope.login_check = function(){
$scope.email_error = "";
 $scope.pass_error = "";
 $scope.not_match = "";
   $http({
        url: 'check_login',
        method: "POST",
        headers: {'Content-Type': 'application/json'},
        data: JSON.stringify({
                 'email' : $scope.email,
                 'password': $scope.password,
                 'remember':$scope.remember
              })
    })
    .then(function(response) {
            // obj = JSON.parse(response);
           if(response.data.code == 1){
            window.location.href = "dashboard";
           }else{
            $scope.email_error = response.data.email_err;
            $scope.pass_error = response.data.pass_err;
            $scope.not_match = response.data.incorrect_err;

           }

    }, 
    function(response) { // optional
            // failed
    });
  }



});
</script>
</body>

</html>
