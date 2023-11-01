<?php
require 'config/database.php'; //uniquement la bdd
session_start(); //rappel de session start puisque pas de header ici.

//recup l'id qui est à supprimer
$id = $_GET['id'] ?? null;
// $id = (int) $id; //forcer l'id à être un entier (caster) pour evtier une faille modifiée dans l'url.

//verif affichage qu'on recup bien l'id à supprimer au click.
// echo "On supprime le contact $id";
//faire la requête
$query = $db->prepare('DELETE FROM contacts WHERE id = :id');
$query->execute(['id' => ($id)]);

$_SESSION['success'] = "The Contact $id has been deleted.";
header('Location: index.php');
?>