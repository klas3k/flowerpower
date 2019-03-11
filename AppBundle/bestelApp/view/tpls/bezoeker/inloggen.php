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
    <p><?= $info; ?></p>
</section>
<section>
    <div class="row">
        <div class="col-md-4">
    <form method="POST" >
        <label for="gn">gebruikersnaam</label><br /> <input name="gn" type="text" /><br />
        <label for="pw">wachtwoord</label> <br /><input name="pw" type="password" /><br />
        <input type="submit" value="Verzenden" />

    </form>
        </div>
    </div>


</section>
<?php
include "include/foot.php";
?>