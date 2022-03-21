<title>WF3 Chat Chatroom</title>
<?php
    session_start();
    require("db.php");
    require("style.php");
    require("navbar.php");
    if(isset($_SESSION['email']) && isset($_SESSION['password'])){
        $idsession = $_SESSION['id'];
        $time= time();
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 bg-dark">
            <center><h2 class="text-white pt-3 pb-3">Contacts</h2></center>
            <div id="result"></div>
        </div>
    <div class="col-md-8 div-chat">
        <center><h2 class="pt-3">Chatbox</h2></center>
<?php
    if(isset($_POST['send'])){
        @$id = $_GET['Id'];
        $message = $_POST['message'];
        $files = basename($_FILES['file']['name']);
        $pathfile = 'files/';
        $query = "INSERT INTO `chatmessage`(`chatmsg`, `id_user`, `id_receive`, `date`, `files`) 
                VALUES ('$message','$idsession','$id',NOW(),'$files')";
        move_uploaded_file($_FILES['file']['tmp_name'], $pathfile.$files);
        mysqli_query($conn,$query);
    }
    @$id = $_GET['Id'];
    $sql = "SELECT * FROM `register` WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    while($rows = mysqli_fetch_assoc($result)){
        $queryimages= "SELECT * FROM `images`";
        $rst = mysqli_query($conn, $queryimages);
        while($row =mysqli_fetch_assoc($rst)){
            if($row['id_user'] == $id){
                $images = $row['images'];
            }elseif($row['id_user'] == $idsession){
                $images2 = $row['images'];
            }
        }
?>
        <center>
            <h5 class="pb-3">
                Chating with <?php echo $rows['firstname'] ?> <?php echo $rows['lastname'] ?>
            </h5>
        </center> 
        <div style="overflow-y: scroll !important; height:400px !important;">
<?php
            $query = "SELECT * FROM `chatmessage`";
            $rslt = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($rslt)){
                if($row['id_user'] == $id && $row['id_receive'] == $idsession){
                    $text1 = $row['chatmsg']."<br>";
                    $file1 = $row['files'];
?>
            <hr class="pb-3">
            <img src="<?php echo $images?>" class="img-chat">
            <?php echo $text1?>
            <span style="font-size:12px; color:grey" class="ml-2"><?php echo date("H:i", strtotime($row['date']))?></span><br>
            <a download="<?php echo $file1?>" href="files/<?php echo $file1?>"><?php echo $file1?></a>
<?php
                }elseif($row['id_user'] == $idsession && $row['id_receive'] == $id){
                    $text2 = $row['chatmsg']."<br>";
                    $file2 = $row['files'];
?>
            <hr class="pt-3">
            <img src="<?php echo $images2?>" class="img-chat">
            <?php echo $text2?>
            <span style="font-size:12px; color:grey" class="ml-2"><?php echo date("H:i", strtotime($row['date']))?></span><br>
            <a download="<?php echo $file2?>" href="files/<?php echo $file2?>"><?php echo $file2?></a>
<?php
                }
            }
?>
            </div>
            <div class="div-margin">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="publisher bt-1 border-light pt-2" id="fixed">
                        <input class="publisher-input" type="text" placeholder="Write something" name="message"> 
                        <span class="publisher-btn file-group"> 
                            <i class="fa fa-paperclip file-browser"></i> 
                            <input type="file" name="file"> 
                        </span> 
                        <input type ="submit" class="btn btn-primary" value="Send" id="btn-send" name="send">
                    </div>
                </form>
            </div>
<?php
        }
?>
        </div>
    </div>
</div>
<?php
    }
?>
<script src="js/jquery-3.6.0.min.js"></script>
<script>
    $(".file-browser").click(function () {
        $("input[type='file']").trigger('click');
    });
    $('input[type="file"]').on('change', function() {
        var val = $(this).val();
        $(this).siblings('span').text(val);
    })
    $(document).ready(function(){
        function updateUserStatus(){
			$.ajax({
				url:'status',
				success:function(result){
                    console.log(result);		
				}
			});
		}
		function getUserStatus(){
			$.ajax({
				url:'status',
				success:function(result){
					$('#result').html(result);
				}
			});
		}
        /*$('a').click(function(e) {
            id =$(this).attr("data-userId"),
            e.preventDefault();
            $.ajax({
                url: "chatroom?=" + id,
                success: function(result){
                    $("#result").html(result);            
                }
            })    
        })*/
        /*$("#btn-send").click(function(){
            var text = $("#messages-text").val();
            var file = $("#file").val();
            var send = $("#btn-send").val();
            $.ajax({
                url:"chatroomId=",
                type:"POST",
                data: {"message": text, "file": file, "send":send},
                success: function(rsult){
                    $(".text").html(rsult);
                    console.log(rsult);
                }
            })
        })*/
		setInterval(function(){
			updateUserStatus();
		},
        3000
            );
		
		setInterval(function(){
			getUserStatus();
		},
        1000
        );
    });
</script>