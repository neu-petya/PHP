<?php
spl_autoload_register(function($class){
    include("src/".str_replace("\\","/",$class).".php");
});
use Modell\Konyv;
$conf = include("config.php");
//var_dump($conf);
$pdo = new \PDO($conf['db']['dsn'],$conf['db']['user'],$conf['db']['password']);
$sql = "SELECT * FROM konyv";
$statement = $pdo->prepare($sql);
$statement->execute();
//$rows = $statement -> fetchAll();
//var_dump($rows);
$fejlec = [ "Cím",
            "Szerző",
            "Kategória",
            "Kiadó",
            "Oldalak száma",
    ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Könyveim</title>
    <style>
        #myBooks{
            margin: auto;
        }
        #myBooks, #myBooks th, td{
            border: 1px green solid;
        }
        #myBooks td{
            padding: 6px;
        }
        #myBooks th{
            background-color: darkgreen;
            color: white;
        }
        #myBooks tr:nth-child(even){
            background-color: #b3e6b3;
        }
        #myBooks tr:nth-child(odd){
            background-color: #eff5ef;
        }
        #myBooks td{
            color: darkgreen;
        }
    </style>
    • A fejléc cellái legyenek sötétzöld hátterűek és fehér szöveggel írva!
    • Lássa el zebra csíkozással!
    o A páros sorok háttere legyen #b3e6b3 színű.
    o A páratlan sorok háttere legyen #eff5ef.
    o A szöveg színe legyen sötétzöld.
    • Legyen vízszintesen középre igazított!
</head>
<body>
    <table id="myBooks">
        <tr>
            <?php foreach($fejlec as $fejlecElem){
                echo "<th>".$fejlecElem."</th>";
            }?>

        </tr>
        <?php /** @var $konyv Konyv */?>
        <?php while($konyv = $statement->fetchObject(Konyv::class)):?>
            <tr>
                <td>
                    <?=$konyv->getCim()?>
                </td>
                <td>
                    <?=$konyv->getSzerzo()?>
                </td>
                <td>
                    <?=$konyv->getKategoria()?>
                </td>
                <td>
                    <?=$konyv->getKiado()?>
                </td>
                <td>
                    <?=$konyv->getOldalakSzama()?>
                </td>
            </tr>
        <?php endwhile;?>
    </table>
</body>
</html>
