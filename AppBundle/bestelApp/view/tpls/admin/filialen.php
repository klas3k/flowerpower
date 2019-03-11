<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 4-1-2018
 * Time: 11:30
 */
include "include/head.php";
?>

<section>

    <ul>
        <?php foreach ($filialen as $winkel): ?>
        <li><b><?= $winkel->getVestiging() ?></b><br />
        adres: <?= $winkel->getAdres() ?>
            <?= $winkel->getPostcode() ?>
            <?= $winkel->getVestigingsplaats() ?><br />
         telefoonnummer:   <?= $winkel->getTelefoonnummer() ?> <a href="?control=admin&action=wijzigFiliaal&id=<?=$winkel->getId()?>">wijzig</a><br />
        </li>
        <?php endforeach; ?>
    </ul>


</section>
<?php
include "include/foot.php";
?>