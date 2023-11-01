<?php
require_once 'config/database.php';
require_once 'partials/header.php';

//recupérer les contacts dans la base
//chainage de méthodes -> -> ...
//fetchAll : retourne un tableau contenant toutes les lignes du jeu d'enregistrements. Le tableau représente chaque ligne comme soit un tableau de valeurs des colonnes, soit un objet avec des propriétés correspondant à chaque nom de colonne.

$contacts = $db->query('SELECT *  FROM contacts')->fetchAll();
// var_dump($contacts);

// Déclaration et initialisation de tableaux
//   // Déclaration d'un tableau vide
//   $fruits = array();
 
//   // Déclaration d'un tableau indexé numériquement
//   $legumes = array('carotte','poivron','aubergine','chou');
 

//   // Déclaration d'un tableau associatif
//   $identite = array(
//       'nom' => 'Hamon', 
//       'prenom' => 'Hugo', 
//       'age' => 19, 
//       'estEtudiant' => true
//   );
?>

<div class="text-3xl font-bold mb-4 text-[#E7EBC5] bg-[#493B2A] py-8 px-4">List of Contacts</div>

<a href="add.php" class="bg-[#2D936C] text-white px-4 py-2 rounded-lg hover:bg-[#84d1ae] duration-300">Add a contact</a>

<?php
    if(isset($_SESSION['success'])){?>
        <p class="bg-[#84d1ae] px-4 py-2 text-[#E7EBC5] rounded-lg m-12">
            <?=$_SESSION['success']; unset ($_SESSION['success']);?>
            <!-- unset permet de faire disparaitre le message au refresh -->
        </p>
<?php } ?>

<ul class="mt-8">
    <?php foreach($contacts as $contact) { ?>
        <li class="flex justify-between p-4 m-1 border-y-2 border-[#84d1ae]">
            <?= $contact['name'] . " : " .$contact['message']; ?> 
            <div><a href="delete.php?id=<?= $contact['id'];?>"><iconify-icon icon="mdi:delete-circle-outline" style="color: #3b0d11;" width="24" height="24"></iconify-icon></a><a href="update.php?id=<?= $contact['id'];?>"><iconify-icon icon="mdi:edit-circle-outline" style="color: #414288;" width="24" height="24"></iconify-icon></a></div>
        </li>
    <?php } ?>
</ul>
      
<?php
require_once 'partials/footer.php';
?>