<?php
require_once 'config/database.php';
require_once 'partials/header.php';

//traitement du formulaire

//1 - recupérer les données
$name = $_POST['name'] ?? null; //PHP7
//si jamais pas de name, ca prends la valeur nulle, sinon prendre la valeur post(ternaire).
// ou -> $name = isset($_POST['name']) ? $_POST['name'] : null; //PHP 5
$message = $_POST['message'] ?? null; 
//tableau d'erreurs
$errors =[];

// 2 - Verification des données (si le formulaire a été envoyé)
if(!empty($_POST)) { //formulaire non vide
    if(strlen($name) <= 0) {
        $errors['name']= 'Name is required.';
    }
    if(strlen($message)<15) {
        $errors['message']= 'The message must be 15 characters minimum.';
    }

    // erreur si la bdd contient 5 messages ou plus.
    //dans les vérifs il est possible de faire des requetes sql non préparées (car ici pas de concaténation).
    //fetch column prends la première valeur de la colonne qui ici sera la valeur de count.
    $messagesCount = $db->query('SELECT COUNT(id) FROM contacts')->fetchColumn();
    if($messagesCount>=20){
        $errors['count'] = 'Sorry, there are too many messages.';
    }

    if(empty($errors)){ //verif si le tableau d'erreurs contient qqch, si il est vide on fait la requête.

        //injections sql (concaténation avec ce que l'utilisateur tape dans le formulaire)
        // $db->query("INSERT INTO contacts (name, message) VALUES('$name', '$message')"); 
        // toujours préparer les requêtes.
        //on stocke la prépa de la requête dans la $query
        $query = $db->prepare('INSERT INTO contacts (name, message) VALUES(:name, :message)');
        $query->execute([
            //"htmlspecialchars" dont le rôle est de neutraliser certains caractères (&, ", <...) en les remplaçant par leurs codes (&amp;...) ou "htmlentities" dont le rôle est de modifier toutes les balises HTML.
            //Pour se protéger contre les failles XSS, nous avons deux solutions principales, selon le contexte :
            // Supprimer tout contenu HTML de la saisie dans le formulaire
            // Neutraliser les caractères formant les balises HTML
            'name' => htmlspecialchars($name), // < === va convertir les chevrons en caractères spéciaux.
            'message' => htmlspecialchars($message),
        ]);
        //avant redirection, on ajoute un message dans la session (qu'on affiche plus tard).
        $_SESSION['success'] = 'Your message has been sent successfully' .htmlspecialchars($name);

        //redirection vers une page
        header('Location: index.php');
    
    }
}
?>

<form  method="post" class="text-[#493B2A] border-2 border-[#8798d3] rounded-lg p-12 m-24">
        <h1 class="text-3xl font-bold mb-4 text-center">👋🏼 Add here !  </h1>
            <!-- afffichage des messages erreur s'il y a. -->
            <ul>
                <?php foreach($errors as $error){?>
                <li class="text-lg text-[#971F29] text-center mt-12 underline">
                    <?=$error ?>
                </li>
                <?php } ?>
            </ul>
    <div class="mb-4">
        <label for="name" class="block text-lg">Name :</label>
        <input type="text" name="name" id="name" class="w-full rounded-lg bg-inherit" value="<?= $name; ?>">
    </div>
    <div class="mb-4">
        <label for="message" class="block text-lg">Message :</label>
        <textarea name="message" id="message" class="w-full rounded-lg bg-inherit"><?= $message; ?></textarea>
    </div>
    <div class="flex justify-end">
        <button class="bg-[#414288] text-[#E7EBC5] rounded-lg px-4 py-2 hover:bg-[#8798d3] duration-300">Send !</button>
    </div>
</form>

<?php
require_once 'partials/footer.php';
?>