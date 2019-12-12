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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Könyveim</title>
</head>
<body>
    <table id="myBooks">
        <tr>
            <th>Cím</th>
            <th>Szerző</th>
            <th>Kiadó és oldalak száma</th>
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
                    <?=$konyv->getKiado()." ".$konyv->getOldalakSzama()?>
                </td>
            </tr>
        <?php endwhile;?>
    </table>
</body>
</html>
