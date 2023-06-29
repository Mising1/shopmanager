<?php
    
    require_once("conf.php");

    $conn = new mysqli($servername, $username, $password, $db);

    $szukaj = '';
    if(isset($_POST['szukaj']))
        $szukaj = $_POST['szukaj'];

    if($conn->connect_error){
        die("Connection failed");
    } else {
        $sql = "SELECT * FROM produkty WHERE produkt LIKE '$szukaj%'";

        $result = $conn->query($sql);
        
        $records = array();

        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
               
        $json = json_encode($records, JSON_UNESCAPED_UNICODE);
        
        
        echo $json;

    } 
    $conn->close();
?>

