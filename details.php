<?php
// on démarre une session 
session_start();


include('header.php');
include('footer.php');

// isset = Est-ce que l'ID (dans l'adresse GET) existe (le lien) et est ce qu'il n'est pas vide
if(isset($_GET['id']) && !empty($_GET['id'])){
    // pour vérifier on se connecte à la BDD
    require_once('connect.php');

    // faire la requête sur un ID qui vient d'un URL de façon sécurisée.
    // On nettoie l'ID envoyé (enlever les balise HTML ou SCRIPT)
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `produit` WHERE `IDPRODUIT` = :id;';

    // on prépare la requête
    $query = $db->prepare($sql);
    
    // on accroche les paramètres IDPRODUIT et on s'assure que c'est bien un entier
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // on execute la requête
    $query->execute();

    // On récupère le produit FETCH car un seul produit à récupérer
    $produit = $query->fetch();

    // On vérifie si le produit existe
    if(!$produit) {
        $_SESSION['erreur'] = "Cet ID n'existe pas";
        header('Location: index.php');
    }


} else {
    // msg d'erreur
    $_SESSION['erreur'] = "URL invalide";
    // // sinon redirige à la page d'acceuil
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">


    <title>Détails produit</title>
    
</head>
<body>
    <main class="container containerDetail">
        <div class="row pt-5">
            <section class="col-12">
                <h1>Détails du produit <?= $produit['NOMPRODUIT'] ?></h1>
                
                <p class="pt-5">Nom du produit : <?= $produit['NOMPRODUIT'] ?></p>
                <p>Prix : <?= $produit['PRIX'] ?> euros</p>
            </section>
        </div>
    </main>
</body>
</html>

