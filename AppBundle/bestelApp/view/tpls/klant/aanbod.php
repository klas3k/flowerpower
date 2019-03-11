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
        <?php foreach ($aanbod as $artikel): ?>
        <li><?= $artikel->getOmschrijving() ?>   &nbsp; &nbsp; Prijs: &euro;
            <?= $artikel->getPrijs() ?> <a href="?control=klant&action=bestellen&id=<?=$artikel->getId(); ?>"><img src="img\winkelwagen.png" height="25px" /></a></li>
        <?php endforeach; ?>
    </ul>


</section>
<?php
include "include/foot.php";
?>