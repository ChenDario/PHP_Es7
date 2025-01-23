<?php
session_start();

$color1 = $_POST['color1'] ?? null;
$color2 = $_POST['color2'] ?? null;
$color3 = $_POST['color3'] ?? null;
$color4 = $_POST['color4'] ?? null;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_SESSION['selected_color'] = [
        'color1' => $color1,
        'color2' => $color2,
        'color3' => $color3,
        'color4' => $color4 
    ];

    $selectedColors = $_SESSION['selected_color'];

    // Genera immagini casuali se non sono già memorizzate nella sessione
    if (!isset($_SESSION['randomImages'])) {
        $_SESSION['randomImages'] = getRandomImages("images/colors");
    }

    $randomImages = $_SESSION['randomImages']; // Recupera le immagini generate

    // Memorizza i tentativi e i risultati nella sessione
    if (!isset($_SESSION['attempts'])) {
        $_SESSION['attempts'] = [];
    }

    //dopo che ha pigiato il form
    // Aggiungi il tentativo e il feedback all'array delle sessioni 
    $_SESSION['attempts'][] = [
        'colors' => $selectedColors,
        'feedback' => checkColors($selectedColors, $randomImages)
    ];

}

// Funzione per ottenere 4 immagini casuali
function getRandomImages($directory, $count = 4) {
    // Ottieni tutti i file nella directory specificata
    $files = glob($directory . "/*.gif"); // Puoi cambiare il formato se necessario
    // Mescola i file e seleziona i primi 4
    shuffle($files);
    return array_slice($files, 0, $count);
}

function isWinner($selected_colosr, $generated_colors){
    $index = 0;
    foreach($selected_colosr as $color){
        if($color !== $generated_colors[$index])
            return false;
    }
    return true; 
}


function checkColors($selected, $generated) {
    $check = [];

    for ($i = 0; $i < 4; $i++) {
        if ($selected[$i] === $generated[$i]) {
            $check[] = "nero.gif"; // Black peg (correct color and position)
        } else if (in_array($selected[$i], $generated)) {
            $check[] = "bianco.gif"; // White peg (correct color, wrong position)
        } else {
            $check = ""; // No correct color
        }
    }

    return $check;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Link CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Script JavaScript -->
    <script src="js/script.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP_Es7 Gioco del Mastermind</title>
</head>
<body>
    <div class="title">
        <h1>Mastermind Game</h1>
    </div>

    <div class="game">
        <form action="index.php" method="POST">
            <table>
                <tr>
                    <td>
                        <select name="color1" onchange="updateImage(this, 'img1')">
                            <option value="images/colors/blu.gif"> Blu </option>
                            <option value="images/colors/giallo.gif"> Giallo </option>
                            <option value="images/colors/rosso.gif"> Rosso </option>
                            <option value="images/colors/verde.gif"> Verde </option>
                        </select>
                        <br>
                        <img id="img1" src="" alt="Nessuna immagine">
                    </td>
                    <td>
                        <select name="color2" onchange="updateImage(this, 'img2')">
                            <option value="images/colors/blu.gif"> Blu </option>
                            <option value="images/colors/giallo.gif"> Giallo </option>
                            <option value="images/colors/rosso.gif"> Rosso </option>
                            <option value="images/colors/verde.gif"> Verde </option>
                        </select>
                        <br>
                        <img id="img2" src="" alt="Nessuna immagine">
                    </td>
                    <td>
                        <select name="color3" onchange="updateImage(this, 'img3')">
                            <option value="images/colors/blu.gif"> Blu </option>
                            <option value="images/colors/giallo.gif"> Giallo </option>
                            <option value="images/colors/rosso.gif"> Rosso </option>
                            <option value="images/colors/verde.gif"> Verde </option>
                        </select>
                        <br>
                        <img id="img3" src="" alt="Nessuna immagine">
                    </td>
                    <td>
                        <select name="color4" onchange="updateImage(this, 'img4')">
                            <option value="images/colors/blu.gif"> Blu </option>
                            <option value="images/colors/giallo.gif"> Giallo </option>
                            <option value="images/colors/rosso.gif"> Rosso </option>
                            <option value="images/colors/verde.gif"> Verde </option>
                        </select>
                        <br>
                        <img id="img4" src="" alt="Nessuna immagine">
                    </td>
                    <td>
                        <button type="submit">
                            <img src="images/spunta.gif" alt="">
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div class="result">

    </div>

</body>
</html>
