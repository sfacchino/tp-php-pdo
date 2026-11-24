<?php
/*
  TP 9 – BONUS : MINI-APPLICATION

  Réunir sur une seule page :
  1. Un titre avec le nombre de jeux : Ma ludothèque (10 jeux)
     (dans le <title> et dans le <h1>)
  2. Un tableau de tous les jeux, du mieux noté au moins bien noté.
  3. Un lien « Supprimer » sur chaque ligne :
     tp9_bonus_ludotheque.php?supprimer=ID
  4. Un formulaire d'ajout de jeu (comme au TP 7).

  Les titres et genres affichés doivent être protégés.
  Test : ajouter un jeu dont le titre est <b>Test</b>. Que voit-on ?
*/

require 'connexion.php';

if (isset($_GET['supprimer'])) {
    $req = $pdo->prepare('DELETE FROM jeu WHERE id = :id');
    $req->execute(array('id' => $_GET['supprimer']));
}

if (isset($_POST['titre'])) {
    $req = $pdo->prepare('INSERT INTO jeu (titre, genre, annee, note) VALUES (:titre, :genre, :annee, :note)');
    $req->execute(array(
        'titre' => $_POST['titre'],
        'genre' => $_POST['genre'],
        'annee' => $_POST['annee'],
        'note'  => $_POST['note']
    ));
}

$resultat = $pdo->query('SELECT id, titre, genre, annee, note FROM jeu ORDER BY note DESC');
$jeux = $resultat->fetchAll();

$nbJeux = count($jeux);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Ma ludothèque (<?= $nbJeux ?> jeux)</title>
</head>
<body>
    <h1>Ma ludothèque (<?= $nbJeux ?> jeux)</h1>

    <table border="1">
        <tr><th>Titre</th><th>Genre</th><th>Année</th><th>Note</th><th></th></tr>
        <?php
        foreach ($jeux as $jeu) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($jeu['titre']) . '</td>';
            echo '<td>' . htmlspecialchars($jeu['genre']) . '</td>';
            echo '<td>' . $jeu['annee'] . '</td>';
            echo '<td>' . $jeu['note'] . '/20</td>';
            echo '<td><a href="tp9_bonus_ludotheque.php?supprimer=' . $jeu['id'] . '">Supprimer</a></td>';
            echo '</tr>';
        }
        ?>
    </table>

    <h2>Ajouter un jeu</h2>
    <form method="post">
        <p>Titre : <input type="text" name="titre" required></p>
        <p>Genre : <input type="text" name="genre" required></p>
        <p>Année : <input type="number" name="annee" required></p>
        <p>Note : <input type="number" name="note" min="0" max="20" required></p>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>


