<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Tech of World Shop</title>

  

</head>
<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    /* font-family: Arial, Helvetica, sans-serif;
     */
    
    max-width: 100%;
}
body{
    font-family: Roboto, sans-serif;
    

}
li{
    list-style: none;
    
}
a{
    text-decoration: none;
}




/* ________________________________________ */


</style>

<body>
    <?php
    session_start();
   
    include('../Sources/FE/top_header.php');
    include('../Sources/FE/header.php');
    include('../Sources/FE/iconnofi.php');
   
    include('../Sources/FE/slide.php');
    include('../Sources/FE/cart_count.php');
    
    include('../Sources/FE/menu.php');
    include('../Sources/FE/sale.php');
    include('../Sources/FE/content.php');
  
    include('../Sources/FE/footer_save.php');
    include('../Sources/FE/footer.php');
    

    
    ?>
</body>
    