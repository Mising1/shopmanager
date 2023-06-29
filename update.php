<?php 
    require_once("conf.php");

    if(!empty($_POST['editP']) && !empty($_POST['editI']))
    {
        $id = $_POST['id'];
        $editP = $_POST['editP'];
        $editI = $_POST['editI'];
        
        $conn = new mysqli($servername, $username, $password, $db);
    
        if($conn->connect_error){
            die("Connection failed");
        } else {
            $sql = "UPDATE produkty SET produkt='$editP', ilosc='$editI' WHERE id='$id';";
            $conn->query($sql);
        }
    
        $conn->close();
    } 
   
?>