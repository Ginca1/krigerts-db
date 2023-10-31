<?php

$serveris = "localhost";
$lietotajvards = "lietotajs";
$parole = "parole";
$datubaze = "bloga_datubaze";

$savienojums = new mysqli($serveris, $lietotajvards, $parole, $datubaze);


if ($savienojums->connect_error) {
    die("Savienojuma kļūda: " . $savienojums->connect_error);
}


if (isset($_POST['pievienot'])) {
    $virsraksts = $_POST['virsraksts'];
    $teksts = $_POST['teksts'];

    $sql = "INSERT INTO ieraksti (virsraksts, teksts) VALUES ('$virsraksts', '$teksts')";
    $savienojums->query($sql);
}


$sql = "SELECT * FROM ieraksti";
$rezultats = $savienojums->query($sql);
?>

<html>
<head>
    <title>Mana bloga lietotne</title>
</head>
<body>
    <h1>Mana bloga lietotne</h1>

   
    <form method="post">
        Virsraksts: <input type="text" name="virsraksts"><br>
        Teksts: <textarea name="teksts"></textarea><br>
        <input type="submit" name="pievienot" value="Pievienot ierakstu">
    </form>

    <?php while ($rinda = $rezultats->fetch_assoc()): ?>
        <div>
            <h2><?php echo $rinda['virsraksts']; ?></h2>
            <p><?php echo $rinda['teksts']; ?></p>
        </div>
    <?php endwhile; ?>

</body>
</html>

<?php

$savienojums->close();
?>