<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System management</title>
    <link rel="stylesheet" href="strona.css">
    <script src="javascript.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body onload="">
    <div class="cont">

        <!-- Menu(dodawanie produktów)-->
        <div class="menu">
            <p>Panel do dodawania elementów</p>
            <form id='insert' action="insert.php" method="post">
                
                <input type="text" id="produkt" placeholder='Wpisz produkt' name="produkt"></input>
                        
                <input type="number" placeholder='Wpisz ilość' name="ilosc" id="ilosc"></input>
                        
                <input type="submit" value="Dodaj produkt"></input>
                        
            </form>
            <p>Wyszukiwarka</p>
            <div class="wyszukiwarka">
                <input type='text' placeholder='Wyszukaj' name='szukaj' id='szukaj'></input>
            </div>
           
        </div>

        <!-- Menu do edytowania -->
        <div class="menu-edit">
            <form id='update' action="update.php" method="post">
                <p>Edytuj element</p>
                <input type="text" name='edit-produkt' id='editP' placeholder='Edytuj produkt'></input>
                <input type="number" name='edit-ilosc' id='editI' placeholder='Edytuj ilość'></input>
                <input type="submit" value="Edytuj"></input>
            </form>
        </div>

        <!-- Tabela z produktami -->
        <table class='dane'></table>
        
    </div>

    
    <script>
        var id = '';
        $(document).ready(function(){
            $.get('select.php', function(data){
                cos(data);
            });
        
            $("#insert").submit(function(event){
                event.preventDefault();
                var produkt = $("#produkt").val();
                var ilosc = $("#ilosc").val();
                $("#produkt").val("");
                $("#ilosc").val("");
                $.ajax({
                    method: "POST",
                    url: 'insert.php',
                    data: {
                        produkt: produkt,
                        ilosc: ilosc
                    },
                    success:function(){
                        $.ajax({
                            method: 'GET',
                            url: 'select.php',
                            success:function(response){
                                cos(response);
                            },
                        });
                    }
                });
            });

            // Wyszukiwanie produktów
            $('#szukaj').on('keyup', function(){
                var fraza = $("#szukaj").val();
                $.ajax({
                    method: "POST",
                    url: 'select.php',
                    data:{szukaj:fraza},
                    success:function(response){
                        cos(response);
                    }
                });
            });

            
            $("table").delegate('tr', 'click', function(e) {
                if(e.target.localName == 'td'){
                    id = e.currentTarget.cells[0].innerText;
                    var edit_produkt = e.currentTarget.cells[1].innerText;
                    var edit_ilosc = e.currentTarget.cells[2].innerText;
    
                    $('#editP').val(edit_produkt);
                    $('#editI').val(edit_ilosc);

                }
            });
        });

            $("#update").submit(function(event){
                event.preventDefault();
                var editP = $("#editP").val();
                var editI = $("#editI").val();
                $("#editP").val("");
                $("#editI").val("");
                if(id != '')
                {
                    $.ajax({
                        method: "POST",
                        url: 'update.php',
                        data: {
                            id: id,
                            editP: editP,
                            editI: editI
                        },
                        success:function(){
                            $.ajax({
                                method: 'GET',
                                url: 'select.php',
                                success:function(response){
                                    cos(response);
                                    id = '';
                                    // alert('Pomyślnie edytowano pole');
                                },
                            });
                        }
                    });
                }
            });


        function cos(data){
            data = JSON.parse(data);
            let wynik = "<tr><th>ID</th><th>Produkt</th><th>Ilość</th></tr>";
            for(let i = 0; i < data.length; i++){
                wynik += '<tr><td>'+ data[i].id +'</td>' +'<td>' + data[i].produkt + '</td>'+'<td>' + data[i].ilosc + '</td></tr>';
            }
            $(".dane").html(wynik);
        }

    </script>
</body>
</html>