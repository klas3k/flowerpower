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

   <form method="POST">


       <div><label for="artikel"><?= $artikel->getOmschrijving() ?> </label>
      <label for="aantal">Aantal: </label> <input type="number" name="aantal" /></div>



       <input type="submit" value="in winkelwagentje" />
    </form>


</section>
<?php
include "include/foot.php";
?><input type="hidden" value="<?=$artikel->getId(); ?>" name="id" />