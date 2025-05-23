<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "baza";


$conn = new mysqli($server,$username,$password,$database);
if ($conn->connect_error) {
  die("Bląd połączenia: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wędkowanie</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <div class="baner">
        <h1>Portal dla wędkarzy</h1>
    </div>
    <div class="prawy">
        <img src="ryba1.jpg" alt="sum">
        <a href="kwerendy.txt">Pobierz kwerendy</a>
    </div>
    <div class="lewy1">
        <h3>Ryby zamieszkujące rzeki</h3>
        <ol>
            <?php
            $result = mysqli_query($conn, "SELECT ryby.nazwa, lowisko.akwen,lowisko.wojewodztwo FROM ryby JOIN lowisko on ryby.id = lowisko.Ryby_id WHERE lowisko.rodzaj = 3 ");
            while($item = mysqli_fetch_array($result)){
                echo "<li>",$item[0], "plywa w rzece", $item[1], "</li>";
            }
            ?>
        </ol>
    </div>
    <div class="lewy2">
        <h3>Ryby drapieżne naszych wód</h3>
        <table>
            <thead>
                <tr>
                    <th>L.p</th>
                    <th>Gatunek</th>
                    <th>Występowanie</th>
                </tr>
            </thead>
            <tbody>
           <?php
           $query = mysqli_query($conn, "SELECT `nazwa`, wystepowanie FROM `ryby` WHERE `styl_zycia` = 1");
           $lp = 1;
           while($item = mysqli_fetch_array($query)){
            $query = mysqli_query($conn, "SELECT nazwa, wystepowanie FROM ryby WHERE styl_zycia = 1");
            $lp = 1;
            while ($item = mysqli_fetch_assoc($query)) {
                echo "<tr>
                        <td>{$lp}</td>
                        <td>{$item['nazwa']}</td>
                        <td>{$item['wystepowanie']}</td>
                      </tr>";
                $lp++;
            }
        }
            ?>
            </tbody>
        </table>
    </div>
    <div class="stopka">vika</div>

</body>


</html>
