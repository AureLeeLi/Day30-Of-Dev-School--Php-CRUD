<?php

require_once 'config/database.php';
require_once 'config/functions.php';
require_once 'partials/header.php';

// Récupérer le contact à modifier
$id = $_GET['id'] ?? null;
//$query = $db->prepare('SELECT * FROM contacts WHERE id = :modif');
//$query->execute(['modif' => $id]);
//$contact = $query->fetch();
$contact = getContact($id);

// Traitement du formulaire
// 1 - Récupérer les données
$name = $_POST['name'] ?? $contact['name']; // PHP 7 Null coalesce
// $name = isset($_POST['name']) ? $_POST['name'] : null; // PHP 5
$message = $_POST['message'] ?? $contact['message'];
$errors = [];

// 2 - Vérifier les données (si le formulaire a été envoyé)
if (! empty($_POST)) { // Formulaire NON vide
    if (strlen($name) <= 0) {
        $errors['name'] = 'Name is required.';
    }

    if (strlen($message) < 15) {
        $errors['message'] = 'The message must be 15 characters minimum.';
    }


    if (empty($errors)) { // Pas d'erreurs dans le formulaire
        // Attention aux Injections SQL... On doit toujours préparer les requêtes
        $query = $db->prepare('UPDATE contacts SET name = :name, message = :message WHERE id = '.$contact['id']);
        $query->execute([
            'name' => htmlspecialchars($name), // < === &lt; et permet d'éviter les failles XSS
            'message' => htmlspecialchars($message),
        ]);

        // Avant la redirection, on ajoute un message dans la session (qu'on affiche plus tard)
        $_SESSION['success'] = 'Your message has been updated '.htmlspecialchars($name);

        // Redirection vers une page
        header('Location: index.php');
    }
}
?>

<ul>
    <?php foreach ($errors as $error) { ?>
        <li class="text-lg text-[#971F29] text-center mt-12 underline">
            <?= $error; ?>
        </li>
    <?php } ?>
</ul>

<form action="" method="post" class="my-12">
    <h1 class="text-3xl font-bold mb-4 text-center text-[#493B2A]"><iconify-icon icon="fluent:emoji-edit-24-regular" style="color: #493b2a;" width="36" height="36"></iconify-icon> Update <?= $contact['name']; ?>
    </h1>
    <div class="mb-3">
        <label for="name" class="block">Name :</label>
        <input type="text" name="name" id="name" class="w-full" value="<?= $name; ?>">
    </div>

    <div class="mb-3">
        <label for="message" class="block">Message :</label>
        <textarea name="message" id="message" class="w-full"><?= $message; ?></textarea>
    </div>

    <div class="flex justify-end">
        <button class="bg-[#414288] text-[#E7EBC5] rounded-lg px-4 py-2 hover:bg-[#8798d3] duration-300 text">Send</iconify-icon></button>
    </div>
</form>

<?php require_once 'partials/footer.php'; ?>
