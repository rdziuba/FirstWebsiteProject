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
 session_start();
$polaczenie = mysqli_connect("localhost", "root", "");
mysqli_select_db( $polaczenie, "stronka") or die('Błąd wyboru bazy danych, albo baza nie istnieje.'); ;

function filtruj($zmienna)
{
	$polaczenie = mysqli_connect("localhost", "root", "");
    if(get_magic_quotes_gpc())
        $zmienna = stripslashes($zmienna); // usuwamy slashe

    // usuwamy spacje, tagi html oraz niebezpieczne znaki
    return mysqli_real_escape_string($polaczenie ,htmlspecialchars(trim($zmienna)));
}

if (isset($_POST['rejestruj']))
{
    $imie = filtruj($_POST['Imie']);
    $nazwisko = filtruj($_POST['Nazwisko']);
    $login = filtruj($_POST['Login']);
    $haslo = filtruj($_POST['Haslo']);
    $miejscowosc = filtruj($_POST['Miejscowosc']);
    $ulica = filtruj($_POST['Ulica']);
    $nrMieszkania = filtruj($_POST['NrMieszkania']);
    $kodPocztowy = filtruj($_POST['KodPocztowy']);
    $nrTel = filtruj($_POST['NrTel']);
	
	 
	

    // sprawdzamy czy login jest już w bazie
    if (mysqli_num_rows(mysqli_query($polaczenie ,"SELECT login FROM konta WHERE login = '".$login."';")) == 0)	
    {   
		//sprawdzamy czy haslo się zgadza ze standardami znakowymi
	
		
        //sprawdzamy poprawność adresu e-mail
            
			
            mysqli_query($polaczenie ,"INSERT INTO `konta` (`Imie`, `Nazwisko`, `Login`, `Haslo`, `Miejscowosc`,`Kod pocztowy` ,`Ulica`,`Nr mieszkania`,`Nr telefonu`)
                VALUES ('".$imie."', '".$nazwisko."', '".$login."','".md5($haslo)."', '".$miejscowosc."','".$kodPocztowy."', '".$ulica."', '".$nrMieszkania."', '".$nrTel."' ");


	}
    else echo "<br><br><br><br>Typed login is already taken!";
}

if (isset($_POST['loguj']))
{  
    $login = filtruj($_POST['Login']);
    $haslo = filtruj($_POST['Haslo']);
   

    // sprawdzamy czy login i hasło są dobre
    if (mysqli_num_rows(mysqli_query($polaczenie, "SELECT login, haslo FROM konta WHERE Login = '".$login."' AND Haslo = '".md5($haslo)."';")) > 0)
    {
        
        $_SESSION['zalogowany'] = true;
        $_SESSION['login'] = $login;
         echo '<br><br><br><br><br><p>Logged in!</p>';
        // zalogowany

    }
    else echo "<br><br><br><br><br><br>Wrong login or password";
}

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
    
        <table class= "tabelaR">
         <form method="POST" action="rejestracja.php">
           <tr><td colspan="2" class="tdR"> <center>REJESTRACJA</td> </center>  </tr> 
           <tr><td class="tdR">Imie:</td> <td class="tdR"><input type="text" name="Imie"></td>    </tr>
           <tr><td class="tdR">Nazwisko:</td> <td class="tdR"><input type="text" name="Nazwisko"></td>    </tr>
           <tr><td class="tdR">Login:</td> <td class="tdR"><input type="text" name="Login"></td>    </tr>
           <tr><td class="tdR">Hasło:</td> <td class="tdR"><input type="text" name="Haslo"></td>    </tr>
           <tr><td class="tdR">Miejscowość</td> <td class="tdR"><input type="text" name="Miejscowosc"></td>    </tr>
           <tr><td class="tdR">Ulica:</td> <td class="tdR"><input type="text" name="Ulica"></td>    </tr>
           <tr><td class="tdR">Nr mieszkania:</td> <td class="tdR"><input type="text" name="NrMieszkania"></td>    </tr>
           <tr><td class="tdR">Kod pocztowy:</td> <td class="tdR"><input type="text" name="KodPocztowy"></td>    </tr>
           <tr><td class="tdR">Nr.tel</td> <td class="tdR"><input type="text" name="NrTel"></td>    </tr>
           <tr>	<td class="tdR" rowspan="2"><input class="inputCenter" type="submit" value="Zarejestruj!" name="rejestruj"></td>
            </form>
            
            
        </table>
        
                <table class= "tabelaR">
         <form method="POST" action="rejestracja.php">
           <tr><td class="tdR" colspan="2"> <center>LOGOWANIE</center></td> </center>  </tr> 
           
           <tr><td class="tdR">Login:</td> <td class="tdR"><input type="text" name="Login"></td>    </tr>
           <tr><td class="tdR">Hasło:</td> <td class="tdR"> <input type="text" name="Haslo"></td>    </tr>
           
           <tr>	<td rowspan="2"><input class="inputCenter" type="submit" value="Zaloguj się!" name="loguj"></td>
            </form>
            
            
        </table>
    
    </section>


    <footer class="stopka">© Rafał Dziuba, IiE</footer>

</body>

</html>
