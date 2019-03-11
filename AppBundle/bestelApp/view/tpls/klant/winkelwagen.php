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
    <?php if(isset($bestelling) ){
        include("include/form_bestelling.php");
   }
   else
       {
           echo " <div>        <p>Er zijn geen artikelen in het winkelwagentje geplaatst</p>        </div>";
       }

   ?>
    </ul>

</section>
<?php
include "include/foot.php";
?>