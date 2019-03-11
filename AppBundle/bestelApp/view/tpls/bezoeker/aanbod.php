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
        <?= $artikel->getPrijs() ?></li>
        <?php endforeach; ?>
    </ul>


</section>
<?php
include "include/foot.php";
?>