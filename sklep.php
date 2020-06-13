<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Koronawirus - poradnik postępowania</title>
 <link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
  
  <?php

$polaczenie = mysqli_connect("localhost", "root", "");
mysqli_select_db( $polaczenie, "stronka") or die('Błąd wyboru bazy danych, albo baza nie istnieje.'); ;
$i =0;
$j = '"';

 
$wynik = mysqli_query($polaczenie,"SELECT * FROM produkty ORDER BY ID_Produktu");


echo "<script> 
";



while($row = mysqli_fetch_array($wynik))
{

$id = $row['ID_Produktu'];
$nazwa= $row['Nazwa_produktu'];
$cena = $row['Cena'];

echo "

   document.getElementById('produkt".($i+1)."').innerHTML = ".$j.$nazwa.$cena."<br><input type='button' value='Add to cart!!' onClick='buyProduktId(".$id.")'>".$j.";

";

$i+=1;

}
echo "
 </script>";

mysqli_close($polaczenie);

?> 
  
</head>

<body>
    <nav class="menu off">
        <h1>☣Koronawirus - poradnik postępowania</h1>
        <div class="links">
            <ul>
                <li><a href="index.html">Strona główna</a></li>
                <li><a href="poradnik.html">Jak postępować?</a></li>
                <li><a href="aktualnosci.html">Aktualności</a></li>
                <li><a href="sklep.php">Sklep</a></li>
                <li><a href="rejestracja.php">Logowanie</a></li>
            </ul>
        </div>
        <div class="burger">
            <i class="fas fa-bars"></i>
            <i class="fas fa-chevron-down off"></i>
        </div>
    </nav>

    <section class="content">
    <br><br><br><br><br><br>
    <table class="S">
       
        <tr> <td class="tdS" id="produkt1">Mydlo antybakteryjne 5.8 PLN<br><input type='button' value='KUPUJĘ' onClick='buyProduktId(2)'></td> <td class="tdS"  id="produkt2">Rekawiczki nitrylowe 10par 10 PLN<br><input type='button' value='KUPUJĘ' onClick='buyProduktId(4)'></td> <td id="produkt3" class="tdS" >Maseczka 2.99 PLN <br><input type='button' value='KUPUJĘ' onClick='buyProduktId(1)'></td> <td id="produkt4" class="tdS" >Zel antybakteryjny 9.9 PLN<br><input type='button' value='KUPUJĘ' onClick='buyProduktId(3)'></td> </tr>
        
    </table>
    
    </section>



  <footer class="stopka">© Rafał Dziuba, IiE</footer>

</body>

</html>