<?php include 'header.php'; ?>

<?php

$file = 'szamok.txt';
// $numbers = range(1,200); nem random 1-200ig ad számokat

function fileCreate($file) {
    // 200 db random szám 1 és 200 közt elhelyezése egy tömbben
for ($i=0; $i < 200; $i++) { 
    $numbers[] = rand(1,200);
}

// Ha a fájl létezik a content kiíratása
if (file_exists($file)) {
    $handle = fopen($file, 'r');
    $content = fread($handle, filesize($file));
    echo $content;

    // Ha a fájl nem létezik, létrehozza és a számokat sortöréssel beleírja
} else {
    $handle = fopen($file, 'w');
    // Sortöréssel számok file-ba olvasása
    foreach ($numbers as $number) {
        $content = $number . PHP_EOL;
        fwrite($handle, $content);
    }
    fclose($handle);
}
}

if(isset( $_POST['fileDelete'])) {
    fileDelete($file);
}

function fileDelete($file) {
    unlink($file);
    header('Location: index.php');
}

if(isset( $_POST['fileCreate'])) {
    fileCreate($file);
    fileCreate($file);
}

?>

<br>
<form method="post">

    <button class="btn btn-dark w-10" name="fileDelete">Fájl törlése</button>
    <button class="btn btn-dark w-10" name="fileCreate">Fájl létrehozása</button>

</form>


<?php include 'footer.php'; ?>