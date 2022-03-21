<title>WF3 Chat Login</title>
<?php
    require("db.php");
    session_start();
    /*if(isset($_COOKIE['email']) && isset($_COOKIE['password'])){
        header("location:timeline.php");
        exit();
    }*/
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $sql= "SELECT * FROM `register` WHERE email ='$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        while($rows = mysqli_fetch_assoc($result)){
            if(isset($_POST['logged'])){
                setcookie("email", $rows['email'], time()+3600);
                setcookie("password", md5($rows['password']), time()+3600);
            }
            $time = time()+10;
            $_SESSION['id'] = $rows['id'];
            $_SESSION['email'] = $rows['email'];
            $_SESSION['name'] = $rows['firstname'];
            $_SESSION['password'] = $rows['password'];
            header("location:timeline");
        }
        $error = "Email or password is incorrect, Please try again";
    }
    require("style.php");
?>
<div class="div-bg">
    <div class="div-bg2">
        <div class="py-lg-5 py-md-4">
            <div class="pt-lg-3 pt-md-4 my-5 div-background px-3 w-50 mx-auto">
                <form class="pt-lg-5 py-md-4" action="index" method="POST">
                    <div>
                        <h1 class="text-center">Login</h1>
                    </div>
                    <div class="form-group w-75 mx-auto">
                        <label for="exampleInputEmail1">Email address</label>
                        <div class="d-flex">
                            <i class="fa-solid fa-envelope icon"></i>
                            <input type="email" class="form-control px-5" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" name="email" value="<?php echo @$_COOKIE['email'];?>">
                        </div>
                        <p id="error-1"></p>
                        <p id="error-2"></p>
                    </div>
                    <div class="form-group w-75 mx-auto">
                        <label for="exampleInputPassword1">Password</label>
                        <div class="d-flex">
                            <i class="fa-solid fa-lock icon"></i>
                            <input type="password" class="form-control px-5" id="exampleInputPassword1" placeholder="Your Password" name="password">
                        </div>
                        <p id="error-3"></p>
                    </div>
                    <div class="form-group form-check w-75 mx-auto">
                        <div>
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="logged">
                            <label class="form-check-label" for="exampleCheck1">Keep me logged</label>
                        </div>
                        <b><p class="text-center text-danger pt-2"><?php echo @$error ?></p></b>
                    </div>
                    <div class="w-50 mx-auto">
                        <button type="submit" class="btn btn-primary ml-lg-5 btn-send" name="login">Login</button>
                        <input type="button" class="btn btn-primary ml-lg-5" value="Register here" onclick="window.open('register')">
                    </div>
                    <div class='text-center mt-3'>
                        <b><a href="forgot" target="blanket" class="text-dark contacts">Forgot your password ?</a></b>
                    </div>
                    <p id="result"></p>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $("#exampleCheck2").click(function(){
            if($("#exampleCheck2").is(':checked')){
                $('#exampleInputPassword1').get(0).type = 'text';
            }else{
                $('#exampleInputPassword1').get(0).type = 'password';
            }
        })
        $('.btn-send').click(function(e){ 
            email = $('#exampleInputEmail1').val();
            password = $('#exampleInputPassword1').val();
            envoyer = $('.btn-send').val();
            e.preventDefault();
            if(!errorMsg()){
                $.ajax({
                    type: "POST",
                    url: "index",
                    data: {"email": email, "password":password, "login":envoyer},
                    success: function (result) {
                        console.log(result);
                        window.location.href="timeline";
                    }
                });
            }
        });
        function errorMsg(){
            email = $("#exampleInputEmail1").val();
            password = $("#exampleInputPassword1").val();
            vide = false;
            regex_email = /[a-zA-Z0-9.%_-]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,10}$/;
            if(email === ""){
                $("#error-2").hide();
                $("#error-1").show();
                $("#error-1").html("<b>Please insert your email</b>").css("padding-top","5px").css("color", "red");
                vide = true;
            }else if(!regex_email.test(email)){
                $("#error-1").hide();
                $("#error-2").show();
                $("#error-2").html("<b>Please insert a valid email</b>").css("padding-top","5px").css("color", "red");
                vide = true;
            }else{
                $("#error-1").hide();
                $("#error-2").hide();
            }if(password === ""){
                $("#error-3").show();
                $("#error-3").html("<b>Please insert your password</b>").css("padding-top","5px").css("color", "red");
                vide = true;
            }else{
                $("#error-3").hide();
            }
            return vide;
        }
    });
</script>