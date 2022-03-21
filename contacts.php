<title>WF3 Chat Contacts</title>
<?php
    session_start();
    require("style.php");
    require("navbar.php");
    require("db.php");
    if(isset($_SESSION['email']) && isset($_SESSION['password'])){
        $idsesion = $_SESSION['id'];
?>
<div class="container mt-4">
    <h3 class="mb-4">Contacts you may know</h3>
    <div class="row">
<?php
        $sql ="SELECT * FROM `register` WHERE id != '$idsesion'";
        $result = mysqli_query($conn, $sql);
        while($rows = mysqli_fetch_assoc($result)){
            $userid = $rows['id'];
            $query="SELECT * FROM `images` WHERE id_user = '$userid'";
            $rslt = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($rslt)){
?>
        <div class="text-center col-md-4">
            <div class="card pl-3" style="width: 18rem;">
                <img src="<?php echo $row['images']?>" class="card-img-top img-fluid img-thumbnail" alt="profile-image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $rows['firstname']?> <?php echo $rows['lastname']?></h5>
                    <p class="card-text">
                        Téléphone: <?php echo $rows['telephone']?><br>
                        Email: <?php echo $rows['email']?><br>
                        gender: <?php echo $rows['sex']?>
                    </p>
                    <form action="" method="POST">
                        <input type="submit" class="btn btn-primary btnfollow" name="follow" value="Follow" style="display:none;">
                        <input type="hidden" value="<?php echo $rows['id']?>" name="hidden">
                    </form>
                </div>
            </div>
        </div>
<?php
        }
    }
?>     
    </div>
</div>
<?php
        /*if(isset($_POST['follow'])){
            $someid = $_POST['hidden'];
            $queryfloowing ="SELECT * FROM `following` WHERE follower = '$idsesion' AND isfollowing = '$someid' LIMIT 1";
            $resultquery = mysqli_query($conn, $queryfloowing);
            if(mysqli_num_rows($resultquery)>0){
                $table = mysqli_fetch_assoc($resultquery);
                $idfollower = $table['id'];
                mysqli_query($conn, "DELETE FROM `following` WHERE id = '$idfollower' LIMIT 1") ;
                $follow = '<input type="submit" class="btn btn-primary" name="follow" value="Follow">';
            }else{
                mysqli_query($conn, "INSERT INTO `following`(`follower`, `isfollowing`) VALUES ('$idsesion','$someid')");
                $unfollow = '<input type="submit" class="btn btn-primary" name="follow" value="Unfollow">';
            }
        }*/
    }
?>