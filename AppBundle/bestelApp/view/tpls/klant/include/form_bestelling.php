<?php
/**
 * Created by PhpStorm.
 * User: Hanneke
 * Date: 3/4/2018
 * Time: 9:12 PM
 */


foreach ($bestelling as $artikel): ?>
    <li><?= $artikel->getOmschrijving() ?>   &nbsp; &nbsp; Prijs: &euro; <?=$artikel->getPrijs() ?>  Aantal:  <?= $artikel->getAantal() ?> </li>
<?php endforeach; ?>



<form method ="POST">

    <div><label for="datum">Selecteer een datum: </label> <input type="date" name="datum" /></div>
    <div><label for="winkel">Selecteer winkel:</label><select name="winkel">
            <?php foreach($winkels as $winkel):?>
                <option value="<?= $winkel->getId(); ?>" ><?= $winkel->getVestiging(); ?> </option>
            <?php endforeach; ?>
        </select></div>
    <input type="submit" value="bestelling verwerken" />
</form>