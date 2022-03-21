<?php
    require("functions.php");
    date_default_timezone_set('Africa/Casablanca');
?>
<head>
    <title>WF3 Chat timeline</title>
</head>
<?php
    session_start();
    $_COOKIE['email'] = $_SESSION['email'];
    $_COOKIE['password'] = $_SESSION['password'];
    if(isset($_COOKIE['email']) && isset($_COOKIE['password'])){
        require("style.php");
        require("navbar.php");
        require("db.php");
        $useremail = $_SESSION['id'];
        $sql = "SELECT * FROM `images` WHERE id_user = '$useremail'";
        $result = mysqli_query($conn, $sql);
        while($rows = mysqli_fetch_assoc($result)){
            $images = $rows['images'];
        }
        if(isset($_POST['send'])){
            $message = $_POST['message'];
            $user = mysqli_real_escape_string($conn, $_SESSION['id']);
            $query = "INSERT INTO `messages`(`message`, `id_user`, `date`) VALUES ('$message','$user', NOW())";
            $result = mysqli_query($conn, $query);
        }
?>
<div class="mt-4 container">
    
        <div class="text-center">
            <p><img src="<?php echo $images ?>"class="img-profile img-thumbnail"></p>
        </div>
        <div class="text-center pb-3">
            <h5 id="h5">Welcome to your account <?php echo $_SESSION['name']?></h5>
        </div>
    
    <div class="row">
        <div class="col-lg-10">
            <h3>Recent messages</h3>
        </div>
        <div class="col-lg-2">
        <p class="bg-p w-75 text-center">WF3 Chat</p>
        </div>
    </div>
    <div class="mt-4">
            <div class="row">
                <div class="pb-2 col-md-4">
                    <div class="text-center">
                    <form action="timeline" method="POST">
                        <textarea class="w-100 pl-2" id="messages-text" name="message" placeholder="Your text here"></textarea>
                        <p id="error-1"></p>
                        <div class="pt-2">
                            <input type ="submit" class="btn btn-primary" value="Send" id="btn-send" name="send">
                        </div>
                    </form>
                    </div>
                    <div class="bg-dark">
                    <center><h5 class="text-white pt-3 pb-3">Online Contacts</h5></center>
                    
<?php
$idsession = $_SESSION['id'];
$time=time();
    $sql = "SELECT * FROM `register` WHERE id != '$idsession'";
    $result = mysqli_query($conn, $sql);
    while($rows = mysqli_fetch_assoc($result)){
        $userid = $rows['id'];
        $query= "SELECT * FROM `images` WHERE id_user = '$userid'";
        $rst = mysqli_query($conn, $query);
        while($row =mysqli_fetch_assoc($rst)){
            $images = $row['images'];
        }
?>
<div id="result" class="pb-1"></div>
<?php
    }
?>
    </div>
                </div>
                <div class="col-md-8 div-border">
<?php
    $sql="SELECT * FROM `messages` ORDER BY `date` DESC";
    $result = mysqli_query($conn, $sql);
    while ($rows = mysqli_fetch_assoc($result)){
        $user = mysqli_real_escape_string($conn, $rows['id_user']);
        $query = "SELECT * FROM `register` WHERE id = '$user' LIMIT 1";
        $rslt = mysqli_query($conn, $query);
        $userQuery = mysqli_fetch_assoc($rslt);
        if($user == $_SESSION['id']){
            $userQuery['firstname'] = "You";
            $deleteMsg = '<a onClick="return confirm("Are you sure you want to delete this message");" href="delete_message?Id='. $rows['id'].'" class="delet-link"><i class="fa-solid fa-x"></i></a>';
        }else{
            $userQuery['firstname'] = $userQuery['firstname'];
            $deleteMsg = "";
        }
?> 
                <div class="d-flex output">
                    <p class="w-100 pt-4 pb-3 px-4 para-style mx-auto">
                        <?php echo $userQuery['firstname']?>:
                        <?php echo $rows['message'] ?><br>
                        <span class="px-4 span-style">Posted: <?php echo time_since(time()- strtotime($rows['date']))?> ago</span>
                    </p>   
                    <p class="delete" data-userId="<?php echo $rows['id']?>"><?php echo $deleteMsg?></p>
                </div>
<?php
    }
?>
                </div>
            </div>
        
    </div>
</div>
<?php
    }else if(!isset($_COOKIE['email']) && !isset($_COOKIE['password'])){
        header("location:index");
    }
?>
<script src="js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#btn-send').click(function(e){ 
            message = $("#messages-text").val();
            envoyer = $('#btn-send').val();
            if(!errorMsg()){
                $.ajax({
                    type: "POST",
                    url: "timeline",
                    data: {"message": message, "send":envoyer},
                    success: function (result) {
                        console.log(result);
                        window.location.href="timeline";
                    }
                });
            }
            e.preventDefault();
        });
        function updateUserStatus(){
			$.ajax({
				url:'timeline_status',
				success:function(result){
                    console.log(result);		
				}
			});
		}
		function getUserStatus(){
			$.ajax({
				url:'timeline_status',
				success:function(result){
					$('#result').html(result);
				}
			});
		}
        function errorMsg(){
            message = $("#messages-text").val();
            vide = false;
            if(message === ""){
                $("#error-1").show();
                $("#error-1").html("<b>Please write your text</b>").css("padding-top","5px").css("color", "red");
                vide = true;
            }else{
                $("#error-1").hide();
            }
            return vide;
        }
        setInterval(function(){
			updateUserStatus();
		},
        2000
            );
		
		setInterval(function(){
			getUserStatus();
		},
        1000
        );
    })
</script>