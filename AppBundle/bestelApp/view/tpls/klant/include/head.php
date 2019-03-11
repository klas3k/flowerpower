<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 4-1-2018
 * Time: 10:58
 */?>
<!doctype html>
<html>
<head><!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../../../favicon.ico">
        <title>FLOWER POWER </title>
        <link href="AppBundle/css/flowerpower.css" type="text/css" rel="stylesheet" />

        <!-- Bootstrap core CSS -->
        <link href="AppBundle/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="AppBundle/css/jumbotron.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

<body>
<div id="wrapper">
    <header>
        <figure><img src="img\flowerpower.jpg" /></figure>
        <div><h1>FLOWER POWER</h1>
            <p>welkom <?= $gebruiker->getVoornaam(). " ".$gebruiker->getTussenvoegsel(). " ".$gebruiker->getAchternaam() ?></p>
            <p> <?= isset($info)?$info:"" ?></p>
        </div>
        <img src="img/bg.jpg">




    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-faded ">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsFP" aria-controls="navbarsFP" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
               </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFP">
            <ul class="navbar-nav lg-auto">

                <li class="nav-item <?= ($link=="default")?" active": '';  ?>">
                    <a class="nav-link" href="?control=klant&action=default" <?= ($link=="default")?"class='active'": '';  ?> >home</a>
                </li>
                <li class="nav-item <?= ($link=="aanbod")?" active": '';  ?>" >
                    <a class="nav-link" href="?control=klant&action=aanbod" <?= ($link=="aanbod")?"class='active'": '';  ?> >aanbod</a>
                </li>
                <li class="nav-item <?= ($link=="bestellingen")?" active": '';  ?> ">
                    <a  class="nav-link" href="?control=klant&action=bestellingen" <?= ($link=="bestellingen")?"class='active'": '';  ?> >bestellingen</a>
                </li>
                <li class="nav-item <?= ($link=="winkelwagen")?" active": '';  ?> ">
                    <a class="nav-link" href="?control=klant&action=winkelwagen" <?= ($link=="winkelwagen")?"class='active'": '';  ?> >winkelwagentje</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" href="?control=klant&action=uitloggen" >uitloggen</a>
                </li>
            </ul>
        </div>
    </nav>

