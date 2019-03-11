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

  Dit zijn uw bestellingen:
            <ul>

           <?php foreach($bestellingen as $bestelling):?>
               <li>
                   <a href="?action=toonBestelling&control=klant&id=<?= $bestelling->getId() ?>"><?php  echo  date('d-M-Y', strtotime($bestelling->getDatum())); ?> </a>

               </li>
            <?php endforeach; ?>
            </ul>


</section>
<?php
include "include/foot.php";
?><input type="hidden" value="<?=$artikel->getId(); ?>" name="id" />