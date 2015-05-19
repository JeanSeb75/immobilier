<?php

/*--------------------- DEBUG --------------- ---------------------*/

function debug($arg)
{
    echo "<pre>";
    print_r($arg);
    echo "</pre>";
}

/* --------------------- Calcul date -------------------- */
if (isset($_POST['reelle'])) {
    $dated = strtotime($_POST['entree']);
    $datef = strtotime($_POST['sortie']);
    $a = explode("-", $_POST['sortie']);

    $annee = $a[0];
    $jour = ($datef - $dated) / 86400 + 1;

    /*$jan = date_create(''.$annee.'-01-01');
    $dec = date_create(''.$annee.'-12-31');*/
    $jan = date_create('2015-01-01');
    $dec = date_create('2015-12-31');

    $j = date_diff($jan, $dec);
    $jouran = $j->days + 1;
}


/* --------------------- Calcul Prorata charges Réelles -------------------- */
if (isset($_POST['reelle'])) {
    $loc = round(($_POST['montant_loc'] / $jouran) * $jour, 2);
    $pro = round(($_POST['montant_pro'] / $jouran) * $jour, 2);
}

/* --------------------- Calcul date -------------------- */
if (isset($_POST['tom'])) {
    $dated = strtotime($_POST['entree']);
    $datef = strtotime($_POST['sortie']);
    $a = explode("-", $_POST['sortie']);

    $annee = $a[0];
    $jour = ($datef - $dated) / 86400 + 1;

    /*$jan = date_create(''.$annee.'-01-01');
    $dec = date_create(''.$annee.'-12-31');*/
    $jan = date_create('2015-01-01');
    $dec = date_create('2015-12-31');

    $j = date_diff($jan, $dec);
    $jouran = $j->days + 1;
}

/* --------------------- Calcul Prorata TOM -------------------- */
if (isset($_POST['tom'])) {
    $tom = round(($_POST['montant_pro'] / $jouran) * $jour, 2);
}



?>
<!DOCTYPE html>
<html>
<head lang="fr">
    <meta charset="UTF-8">
    <title>Calcul charges - TOM</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="/assets/style.css">
    <script src="/assets/js/jquery-1.11.3.min.js"></script>
    <script src="/assets/js/jqueryui.js"></script>

</head>
<body>
<div class="main">
    <h1>Charges locatives</h1>

    <h2>Calcul des charges réelles</h2>

    <form action="#" method="post">
        <label for="entree">Date d'entrée</label><input class="datepicker" type="text" name="entree"
                                                        placeholder="jj/mm/aaaa"
                                                        value="<?php if (isset($_POST['reelle']) && !empty($_POST['entree'])) {
                                                            echo $_POST['entree'];
                                                        } ?>">
        <label for="sortie">Date de sortie</label><input class="datepicker" type="text" name="sortie"
                                                         placeholder="jj/mm/aaaa"
                                                         value="<?php if (isset($_POST['reelle']) && !empty($_POST['sortie'])) {
                                                             echo $_POST['sortie'];
                                                         } ?>"><br/>
        <label for="montant_loc">Montant avancé par le locataire:</label><input name="montant_loc" type="text"
                                                                                value="<?php if (isset($_POST['reelle']) && !empty($_POST['montant_loc'])) {
                                                                                    echo $_POST['montant_loc'];
                                                                                } ?>">€<br/>
        <label for="montant_pro">Charges réelles:</label><input name="montant_pro" type="text"
                                                                value="<?php if (isset($_POST['reelle']) && !empty($_POST['montant_pro'])) {
                                                                    echo $_POST['montant_pro'];
                                                                } ?>">€<br/>
        <input name="reelle" type="submit" value="Valider"/>
    </form>
    <?php if (isset($_POST['reelle']) && !empty($_POST['reelle'])) { ?>
        <strong>Prorata Locataire:</strong> <?php echo $loc; ?>   € <br/>
        <strong>Prorata propriétaire:</strong><?php echo $pro; ?>   € <br/>

    <?php } ?>

    <h2>T.O.M</h2>

    <form action="#" method="post">
        <label for="entree">Date d'entrée</label><input class="datepicker" type="text" name="entree"
                                                        placeholder="jj/mm/aaaa"
                                                        value="<?php if (isset($_POST['tom']) && !empty($_POST['entree'])) {
                                                            echo $_POST['entree'];
                                                        } ?>">
        <label for="sortie">Date de sortie</label><input class="datepicker" type="text" name="sortie"
                                                         placeholder="jj/mm/aaaa"
                                                         value="<?php if (isset($_POST['tom']) && !empty($_POST['sortie'])) {
                                                             echo $_POST['sortie'];
                                                         } ?>"><br/>
        <label for="montant_pro">Charges réelles de la fiche d'impôts:</label><input name="montant_pro" type="text"
                                                                                     value="<?php if (isset($_POST['tom']) && !empty($_POST['montant_pro'])) {
                                                                                         echo $_POST['montant_pro'];
                                                                                     } ?>">€<br/>
        <input name="tom" type="submit" value="Valider"/>
    </form>
    <?php if (isset($_POST['tom']) && !empty($_POST['tom'])) { ?>
        <strong>Montant du par le Locataire:</strong> <?php echo $tom; ?>   € <br/>


    <?php } ?>



    <script>
        $(".datepicker").datepicker();
    </script>
</div>
</body>
</html>