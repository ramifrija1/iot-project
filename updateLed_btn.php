<?php
require 'database.php';

//---------------------------------------- Condition to check that POST value is not empty.
if (!empty($_POST)) {
    //........................................ keep track post values
    $id = $_POST['id'];       // ID de la ligne à mettre à jour
    $field = $_POST['field']; // Nom de la colonne (LED ou bouton)
    $state = $_POST['state']; // Nouvel état (on/off ou 0/1)
    //........................................
    
    // Vérification du champ (LED ou bouton)
    $allowedFields = ['led1', 'led2', 'Btn_01', 'Btn_02']; // Liste des champs autorisés
    if (!in_array($field, $allowedFields)) {
        die("Champ non valide !");
    }
    
    // Connexion à la base de données
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mise à jour de l'état de la LED ou du bouton
    $sql = "UPDATE esp32_update_sensor SET " . $field . " = ? WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($state, $id));

    // Déconnexion de la base de données
    Database::disconnect();
    //........................................
}
//----------------------------------------
?>
