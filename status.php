<?php
    session_start();
    include('db.php');
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
        $status = "<span id='offline'></span>";
        if($rows['status']>$time){
            $status = "<span id='online'></span>";
        }
?>
<div>
    <p class="pl-3 text-white">
        <img src="<?php echo $images ?>" class="img-contact"><?php echo $status ?>
        <a href="chatroom?Id=<?php echo $rows['id']?>" class="contacts text-white" data-userId="<?php echo $rows['id']?>">
            <?php echo $rows['firstname']?> 
            <?php echo $rows['lastname']?>
        </a>
    </p>
</div>
<?php
    }
?>
<?php
    $idsession = $_SESSION['id'];
    $time=time()+10;
    mysqli_query($conn,"update register set status=$time where id=$idsession");
?>