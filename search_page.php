<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" placeholder="search here..." maxlength="100" class="box" required>
      <button type="submit" class="fas fa-search" name="search_btn"></button>
   </form>
</section>

<section class="products" style="padding-top: 0; min-height:100vh;">

   <div class="box-container">

   <?php
     if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
     $search_box = $_POST['search_box'];
     $select_songs = $conn->prepare("SELECT * FROM `songs` WHERE name LIKE '%{$search_box}%'"); 
     $select_songs->execute();
     if($select_songs->rowCount() > 0){
      while($fetch_song = $select_songs->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_song['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_song['name']; ?>">
      <input type="hidden" name="description" value="<?= $fetch_song['description']; ?>">
      <input type="hidden" name="image_01" value="<?= $fetch_song['image_01']; ?>">
     
   
      <img src="uploaded_img/<?= $fetch_song['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_song['name']; ?></div>
      <div class="flex">
         <div class="price"><span></span><?= $fetch_song['description']; ?><span></span></div>
       
      </div>
     
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no song found!</p>';
      }
   }
   ?>

   </div>

</section>












<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>