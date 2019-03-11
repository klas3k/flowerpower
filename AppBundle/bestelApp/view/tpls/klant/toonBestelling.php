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

  U heeft deze bestelling geplaatst en wilt deze op <?php  echo  date('d M Y', strtotime($bestelling->getDatum())); ?> ophalen.
            <ul>
Bestelling nummer: <?= $bestelling->getId() ?>


                    <?php foreach ($besteldeartikelen as $art): ?>
                        <li><?= $art->getOmschrijving() ?>, aantal: <?= $art->getAantal() ?>, prijs: &#8364; <?= $art->getPrijs() ?> </li>

                    <?php endforeach; ?>

               Status van de bestelling: <?= ($bestelling->getAfgehaald())?0:"nog niet afgehaald";"afgehaald" ?> </li>
            </ul>


</section>
<?php include "include/foot.php";?>