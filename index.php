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


// ******************************** Alaptételek *****************************
// TODO: bekérés, adatbázis kezelés

//1. Összegzés alaptétel:
echo '<br><br> <h4>Összegzés alaptétele:</h4> <br>';

$szamokOsszegzes = [1,2,8,10];
$osszeg = null;

for ($i=0; $i < count($szamokOsszegzes) ; $i++) { 
    $osszeg += $szamokOsszegzes[$i];
}

echo 'Az összeg: ' . $osszeg . '<br>';

$osszeg = 0;
foreach ($szamokOsszegzes as $key => $value) {
    $osszeg += $value;
}
echo 'Foreachhel: ' . $osszeg;


//2. Megszámolás alaptétel:
echo '<br><br> <h4>Megszámolás alaptétele:</h4> <br>';
$szamok = [1,2,3,5,8,10,12,10,2,5,5,31];
$szamlalo = null;
$nagyobb_szamok = null;

for ($i=0; $i < count($szamok) ; $i++) { 
   if ($szamok[$i] > 5) {
    // $nagyobb_szamok[] = $szamok[$i];
    $szamlalo++;
   }
}
echo '5 nél nagyobb számok mennyisége: ' . $szamlalo . '<br>';
// print_r($nagyobb_szamok);

$szamlalo = 0;

foreach ($szamok as $key => $value) {
    if ($value > 5) {
        $szamlalo++;
    }
}
echo '5 nél nagyobb számok mennyisége: ' . $szamlalo . '<br>';


//3. Eldöntés alaptétel:
echo '<br><br> <h4>Eldöntés alaptétele:</h4> <br>';
$keresendo = 8;
$i = 0;

while ($i != count($szamok) && $szamok[$i] != $keresendo) {
    $i++;
}
if ($i < count($szamok)) {echo 'A keresett szám a ' . $keresendo . ' megtalálható a tömbben a '
    . $i+1 . '. szám az.';}


//4. Kiválasztás alaptétel:
echo '<br><br> <h4>Kiválasztás alaptétele:</h4> <br>';
$keresett_szam = 31;
$a = 0;
while ($a != count($szamok) && $szamok[$a] != $keresett_szam) {
    $a++;
}
echo 'A  keresett szám a ' . $a+1 . '. helyen áll, az indexe: '. $a;


//5. Keresés alaptétel:
echo '<br><br> <h4>Keresés alaptétele:</h4> <br>';
$keresendo_szam = 31;
$b = 0;

while ($b != count($szamok) && $szamok[$b] != $keresendo_szam) {
    $b++;
}
if ($b < count($szamok) ) { echo 'A keresett szám a ' . $b+1 . ' helyen áll.';}
else {echo 'A keresett szám nem található.';}

echo 'A tömb hossza: ' . count($szamok);
echo 'A $b: ' . $b; // 11 lesz a 12 nagyságú tömbnél az utolsó, mert az első vizsgálatnál a b az 0

//6. Kiválogatás tétele:   //TODO: páros, páratlan és prímszámokra is megcsinálni
echo '<br><br> <h4>Kiválogatás alaptétele:</h4> <br>';
$meret = count($szamok);
$tomb2=null;

for ($i=0; $i < $meret ; $i++) { 
   if ($szamok[$i] > 6) {
    $tomb2[]=$szamok[$i];
   }
}

print_r($tomb2);
echo '<br>';
var_dump($tomb2);

//7. Szétválogatás tétele:
echo '<br><br> <h4>Szétválogatás alaptétele:</h4> <br>';
$tombparos = null;
$tombparatlan = null;

for ($i=0; $i < $meret ; $i++) { 
    if ($szamok[$i] % 2 == 0) {
        $tombparos[] = $szamok[$i];
    } else {$tombparatlan[] = $szamok[$i];}
}
var_dump($tombparos);
echo '<br>';
var_dump($tombparatlan);

//8. Min/Max kiválasztás tétele:
echo '<br><br> <h4>Min/Max kiválasztás alaptétele:</h4> <br>';
$min = $szamok[0];
$max = $szamok[0];

for ($i=0; $i < $meret ; $i++) { 
    if ($min > $szamok[$i]) {
        $min = $szamok[$i];
    }
    if ($max < $szamok[$i]) {
        $max = $szamok[$i];
    }
}
echo 'A legnagyobb szám a tömbben: ' . $max;
echo '<br>';
echo 'A legkisebb szám a tömbben: ' . $min;

//9. Metszet tétele:
echo '<br><br> <h4>Metszet alaptétele:</h4> <br>';

$masikTomb = [1,11,15,16,2,5,21,35,67];
$metszet = null;

for ($j=0; $j < $meret; $j++) { 
    for ($i=0; $i < count($masikTomb); $i++) { 
        if ($szamok[$j] == $masikTomb[$i]) {
            $metszet[] = $szamok[$j];
        }
    }
}

var_dump($metszet);
echo '<br>';
var_dump(array_unique($metszet)); // olyan mint a c# set nincs duplikáció

//10. Únió tétele:
echo '<br><br> <h4>Únió alaptétele:</h4> <br>';
$unio = array_merge($szamok, $masikTomb);
var_dump($unio);

$unio2 = $szamok;
$a = 0;
echo '<br>';

for ($i=0; $i < count($masikTomb); $i++) { 
    while ($a < count($unio2) && $unio2[$a] != $masikTomb[$i] ) {
       $a++;
    }
    if ($a <= count($unio2)) {
        $unio2[] = $masikTomb[$i];
    }
}

var_dump($unio2);
?>

<br>
<form method="post">

    <button class="btn btn-dark w-10" name="fileDelete">Fájl törlése</button>
    <button class="btn btn-dark w-10" name="fileCreate">Fájl létrehozása</button>

</form>


<?php include 'footer.php'; ?>