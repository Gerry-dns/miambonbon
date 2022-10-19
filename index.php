<?php
// on démarre une session 
session_start();

//on inclut la connexion à la base, le header et le footer
require_once('connect.php');
include('header.php');
include('footer.php');


// écrire la requête qu'on met dans une variable

$sql = 'SELECT * FROM `produit`';

// préparer la requête et l'exectuer

$query = $db->prepare($sql);
$query->execute();


// On stock le résultat dans un tableau associatif
// et FETCH_ASSOC constante de PDO pour avoir que les infos avec les titres des colonnes
$result = $query->fetchAll(PDO::FETCH_ASSOC);


// commande pour voir ce qu'il y a dans les tableaux
// var_dump($result);


// fermer la connexion
require_once('close.php');



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Liste des produits</title>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class='col-12'>
                <?php
                // Si la session contient une erreur on affiche le message
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-warning" role="alert">
                        '. $_SESSION['erreur'].' 
                        </div>';
                        // effacer le message quand on recharge la page
                      $_SESSION['erreur'] = "";
                    }
                ?>
                <h1>Liste des produits</h1>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>IDMARQUE</th>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Détail du produit</th>
                        <th>Ajouter au panier</th>
                    </thead>
                    <tbody>
                        <?php 
                        // boucle la variable result pour chercher les données, on donne un alias à la variable $result
                        foreach($result as $produit) {
                        ?>
                            <tr>
                                <td><?= $produit['IDPRODUIT'] ?></td>
                                <td><?= $produit['IDMARQUE'] ?></td>
                                <td><?= $produit['NOMPRODUIT'] ?></td>
                                <td><?= $produit['PRIX'] ?></td>
                                <td><a href="details.php?id=<?= $produit['IDPRODUIT'] ?>">voir</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="add.php" class='btn btn-primary'>Ajouter un produit</a>
            </section>
        </div>
    </main>
</body>
   
</html>
