<title>WF3 Chat Forgot Passwords</title>
<?php
    require("db.php");
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $query = "SELECT `email` FROM `register` WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        while($rows = mysqli_fetch_assoc($result)){
            $sql = "UPDATE `register` SET `password`='$password' WHERE email = '$email'";
            mysqli_query($conn, $sql);
            header("location: index");
        }
        $error = "The email you inserted doesn't exist, Please try again";
    }
    require("navbar2.php");
    require("style.php");
?>
<div class="div-background-password px-3 w-50 mx-auto mt-5">
    <form class="pt-lg-5 py-md-4" action="" method="POST">
        <div id="password">
            <div>
                <h1 class="text-center">Enter a new password</h1>
            </div>
            <div class="form-group w-75 mx-auto">
                <label for="exampleInputPassword1">Password</label>
                <div class="d-flex">
                    <i class="fa-solid fa-lock icon"></i>
                    <input type="password" class="form-control px-5" id="exampleInputPassword1" placeholder="Your Password" name="password" required>
                </div>
                <p id="error"></p>
                <div class="form-group form-check pt-2 px-4">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1" id="exampleCheck1">Display password</label>
                </div>
                <div class="pt-3 text-center">
                    <input type="button" class="btn btn-primary" value="OK" id="password-btn">
                </div>
            </div>
            <b><p class="text-center text-danger"><?php echo @$error ?></p></b>
        </div>
        <div id="email" style="display:none">
            <div class="d-flex">
                <i class="fa-solid fa-arrow-left"></i>
                <div class="w-50 mx-auto">
                    <h1>Enter your email</h1>
                </div>
            </div>
            <div class="form-group w-75 mx-auto">
                <label for="exampleInputEmail1">Email address</label>
                <div class="d-flex">
                    <i class="fa-solid fa-envelope icon"></i>
                    <input type="email" class="form-control px-5" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" name="email" required>
                </div>
            </div>
            <div class="pt-3 text-center">
                <input type="submit" class="btn btn-primary" value="Submit" id="id-submit" name="submit">
            </div>
        </div>
    </form>
</div>
<script src="js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $("#exampleCheck1").click(function(){
            if($("#exampleCheck1").is(':checked')){
                $('#exampleInputPassword1').get(0).type = 'text';
            }else{
                $('#exampleInputPassword1').get(0).type = 'password';
            }
        })
        $("#password-btn").click(function(){
            var password = $("#exampleInputPassword1").val();
            if(password === ""){
                $("#error").html("<b>* Please insert a new password</b>").css("padding-top","5px").css("color", "#DC3545");
            }else{
                $("#error").hide();
                $("#password").hide();
                $("#email").fadeIn(1000);
            }
        })
        $(".fa-arrow-left").click(function(){
            $("#email").hide();
            $("#password").fadeIn(1000);
            $("#exampleInputPassword1").val("");
        })
    });
</script>