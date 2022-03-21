<title>WF3 chat register</title>
<?php
    require("style.php");
    require("db.php");
    if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lasttname = $_POST['lastname'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $password = md5($_POST['password']);
        $sexe = $_POST['sex'];
        $image = basename($_FILES['image']['name']);
        $pathfolder = 'images/';
        $time = time();
        $query = "SELECT * FROM `register` WHERE email = '$email'";
        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res)){
?>
<div class="div-popup w-50 text-center">
    <div id="div-result" class="py-5">
        <p id="result"><?php echo @$email ?>, Already exists.<br>Please try again.</p>
        <button type="button" class="btn btn-primary btn-close px-4" name="btn">OK</button>
    </div>
</div>
<?php
        }else{
            $sql = "INSERT INTO `register`(`email`, `firstname`, `lastname`, `telephone`, `password`, `sex`, status)
                    VALUES ('$email','$firstname','$lasttname','$telephone','$password','$sexe', $time)";
            $result = mysqli_query($conn, $sql);
            if($result){
                $userid = mysqli_insert_id($conn);
                $sql2 = "INSERT INTO `images`(`images`, `id_user`) VALUES ('$pathfolder$image','$userid')";
                mysqli_query($conn, $sql2);
                move_uploaded_file($_FILES['image']['tmp_name'], $pathfolder.$image);

?>
<div class="div-popup w-50 text-center">
    <div id="div-result" class="py-5">
        <p id="result">
            Thank you<?php echo " ".@$firstname ?>.<br>You have been registered successuflly.
            <br>Please check your email.
        </p>
        <button type="button" class="btn btn-primary btn-close px-4" name="btn">OK</button>
    </div>
</div>
<?php
            }
            $to = $email;
            $subject = "Registration confirmation";
            $headers = 'Content-type: text/html';
            $msg = "<center><h1>Registration confirmation</h1><br>
                    <p><b>We are glad that you chose our website for your social interaction.
                    Enjoy and have fun.<br>
                    Please click in the link below to confirm your registration.<br><br>
                    <a href='http://localhost/chat/'>Click here</a><b></p></center>";
            mail($to, $subject, $msg, $headers);
        }
    }
?>
<div class="container py-5">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="text-center pb-4">
            <h1>Registration</h1>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputFirstname4">First name</label>
                <input type="text" class="form-control" id="inputFirstname4" name="firstname">
                <p id="error-1"></p>
                <p id="error-8"></p>
            </div>
            <div class="form-group col-md-6">
                <label for="inputLastname4">Last name</label>
                <input type="text" class="form-control" id="inputLastname4" name="lastname">
                <p id="error-2"></p>
                <p id="error-9"></p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name="email">
                <p id="error-3"></p>
                <p id="error-10"></p>
            </div>
            <div class="form-group col-md-6">
                <label for="inputTelephone">Telephone</label>
                <input type="text" class="form-control" id="inputTelephone" name="telephone">
                <p id="error-5"></p>
                <p id="error-11"></p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" id="inputPassword4" name="password">
                <p id="error-4"></p>
                <p id="error-13"></p>
            </div>
            <div class="form-group col-md-5">
                <label for="inputPassword4">Confirm Password</label>
                <input type="password" class="form-control" id="inputPassword24" name="password2">
                <p id="error-12"></p>
            </div>
            <div class="form-group col-md-2 pt-4">
                <label for="inputButton4"></label>
                <input type="button" class="form-control btn btn-primary" id="inputButton4" name="input-btn" value="Check password">
            </div>
            <div class="form-group col-md-6">
                <label for="inputSexe">Gender</label>
                <select id="inputSexe" class="form-control" style="font-family: FontAwesome, sans-serif;" name="sex">
                    <option selected value="-- Choose your gendre --">-- Choose your gendre --</option>
                    <option value="Female">&#xf182; Female</option>
                    <option value="Male">&#xf183; Male</option>
                </select>
                <p id="error-6"></p>
            </div>
            <div class="form-group col-md-6">
                <label for="inputImage">Image</label><br>
                <input type="file" id="inputImage" name="image" class="pt-1 w-75">
                <i class="fa-solid fa-xmark"></i>
                <p id="error-14"></p>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-register" name="submit">Register</button>
    </form>
</div>
<script src="js/jquery-3.6.0.min.js"></script>
<script>
    document.querySelector(".btn-close").addEventListener("click", shut);
    function shut(){
        document.querySelector(".div-popup").classList.add("fade-out");
    }
</script>
<script>
    document.getElementById("inputButton4").addEventListener("click", errorpwd);
    function errorpwd(){
        password = document.getElementById("inputPassword4").value;
        password2 = document.getElementById("inputPassword24").value;
        if(password === "" && password2 ===""){
            document.getElementById("error-12").style="display:block; color:#DC3545; padding-top:5px";
            document.getElementById("error-12").innerHTML = "<b>Please confirm your password<b>";
        }
        else if(password !== password2){
            document.getElementById("error-12").style="display:block; color:#DC3545; padding-top:5px";
            document.getElementById("error-12").innerHTML = "<b>Password not matching<b>";
        }else if(password == password2){
            document.getElementById("error-12").style="display:block; color:#28A745; padding-top:5px";
            document.getElementById("error-12").innerHTML = "<b>Password matching<b>";
        }
    }
    document.querySelector(".fa-xmark").addEventListener("click", clear);
    function clear(){
        document.getElementById("inputImage").value = "";
    }
    $(document).ready(function(){
        $('.btn-register').click(function(e){
            $("#error-12").hide();        
            if(!errorMsg()){
                firstname = $('#inputFirstname4').val();
                lastname = $('#inputLastname4').val();
                email = $('#inputEmail4').val();
                phone = $('#inputTelephone').val();
                password = $('#inputPassword4').val();
                sex = $('#inputSexe').val();
                envoyer = $('.btn-register').val();
                image = $('#inputImage').val();
                allowedextensions = /(\.jpg|\.jpeg|\.png)$/i;
                if($('#inputImage').val() == ""){
                    $("#error-14").hide();
                    $.ajax({
                        type: "POST",
                        url: "register",
                        data: { "firstname": firstname, "lastname": lastname, "email": email, "telephone":phone, "password":password, "sex":sex, "image":image, "submit":envoyer},
                        success: function (data) {
                            console.log(data);
                        }
                    });
                    $("form")[0].reset();
                }else if(!allowedextensions.test(image)){
                    $("#error-14").show();
                    $("#error-14").html("<b>File not supported, we support jpg, jpeg, png type files.<br>Please try again</b>").css("color", "#DC3545");
                }else{
                    $("#error-14").hide();
                    $.ajax({
                        type: "POST",
                        url: "register",
                        data: { "firstname": firstname, "lastname": lastname, "email": email, "telephone":phone, "password":password, "sex":sex, "image":image, "submit":envoyer},
                        success: function (data) {
                            $(".div-popup").html("hello world");
                        }
                    });
                    $("form")[0].reset();
                }
            }
            e.preventDefault();
        });
        function errorMsg(){
            firstname = $("#inputFirstname4").val(); 
            lastname = $("#inputLastname4").val();
            email = $("#inputEmail4").val();
            password = $("#inputPassword4").val();
            password2 = $("#inputPassword24").val();
            telephone = $("#inputTelephone").val();
            sexe = $("#inputSexe").val();
            vide = false;
            regex_name = /[a-zA-Zء-ي]{3,25}$/;
            regex_email = /[a-zA-Z0-9.%_-]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,10}$/;
            regex_phone = /[0-9]{10,14}$/;
            if(firstname === ""){
                $("#error-8").hide();
                $("#error-1").show();
                $("#error-1").html("<b>Please insert your frist name</b>").css("padding-top","5px").css("color", "#DC3545");
                vide = true;
            }else if(!regex_name.test(firstname)){
                $("#error-1").hide();
                $("#error-8").show();
                $("#error-8").html("<b>Please insert a valid first name</b>").css("padding-top","5px").css("color", "#DC3545");
                vide = true;
            }else{
                $("#error-1").hide();
                $("#error-8").hide();
            }if(lastname === ""){
                $("#error-9").hide();
                $("#error-2").show();
                $("#error-2").html("<b>Please insert your last name</b>").css("padding-top","5px").css("color", "#DC3545");
                vide = true;
            }else if(!regex_name.test(lastname)){
                $("#error-2").hide();
                $("#error-9").show();
                $("#error-9").html("<b>Please insert a valid last name</b>").css("padding-top","5px").css("color", "#DC3545");
                vide = true;
            }else{
                $("#error-2").hide();
                $("#error-9").hide();
            }if(email === ""){
                $("#error-10").hide();
                $("#error-3").show();
                $("#error-3").html("<b>Please insert your email</b>").css("padding-top","5px").css("color", "#DC3545");
                vide = true;
            }else if(!regex_email.test(email)){
                $("#error-3").hide();
                $("#error-10").show();
                $("#error-10").html("<b>Please insert a valid email</b>").css("padding-top","5px").css("color", "#DC3545");
                vide = true;
            }else{
                $("#error-3").hide();
                $("#error-10").hide();
            }if(password === ""){
                $("#error-4").show();
                $("#error-13").hide();
                $("#error-4").html("<b>Please insert your password</b>").css("padding-top","5px").css("color", "#DC3545");
                vide = true;
            }else if(password.length < 8){
                $("#error-4").hide();
                $("#error-13").show();
                $("#error-13").html("<b>At least 8 characters</b>").css("padding-top","5px").css("color", "#DC3545");
                vide = true;
            }else{
                $("#error-4").hide();
                $("#error-13").hide();
            }if(telephone === ""){
                $("#error-5").show();
                $("#error-11").hide();
                $("#error-5").html("<b>Please insert your phone number</b>").css("padding-top","5px").css("color", "#DC3545");
                vide = true;
            }else if(!regex_phone.test(telephone)){
                $("#error-5").hide();
                $("#error-11").show();
                $("#error-11").html("<b>Please insert a valid phone number</b>").css("padding-top","5px").css("color", "#DC3545");
                vide = true;
            }else{
                $("#error-5").hide();
            }if(sexe === "-- Choose your gendre --"){
                $("#error-6").html("<b>Please select your gender</b>").css("padding-top","5px").css("color", "#DC3545");
                vide = true;
            }else{
                $("#error-6").hide();
            }
            if(password !== password2){
                $("#error-12").show();
                $("#error-12").html("<b>Password not matching</b>").css("padding-top","5px").css("color", "#DC3545");
                vide = true
            }else if(password2 === ""){
                $("#error-12").show();
                $("#error-12").html("<b>Please confirm your password</b>").css("padding-top","5px").css("color", "#DC3545");
                vide = true
            }
            return vide;
        }
    });
</script>