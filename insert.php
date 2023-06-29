<?php 
    require_once("conf.php");

    if(!empty($_POST['produkt']) && !empty($_POST['ilosc']))
    {
        $produkt = $_POST['produkt'];
        $ilosc = $_POST['ilosc'];
        
        $conn = new mysqli($servername, $username, $password, $db);
    
        if($conn->connect_error){
            die("Connection failed");
        } else {
            $sql = "INSERT INTO produkty(produkt, ilosc) VALUES ('$produkt', '$ilosc');";
            $conn->query($sql);
        }
    
        $conn->close();
    } 
   
?>