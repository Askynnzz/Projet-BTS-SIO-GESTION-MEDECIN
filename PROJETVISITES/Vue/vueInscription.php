<!DOCTYPE html>
<html>

<head>
    <title>Inscription Visiteur</title>
</head>

<body>
    <h1>Inscription Visiteur</h1>
    <form method="post" action="../Contrôleur/VisiteurControleur.php?action=inscription">
        <label>Nom :</label>
        <input type="text" name="nom" required><br>
        
        <label>Prénom :</label>
        <input type="text" name="prenom" required><br>

        <label>Login :</label>
        <input type="text" name="login" required><br>

        <label>Mot de passe :</label>
        <input type="password" name="mdp" required><br>

        <label>Adresse :</label>
        <input type="text" name="adresse" required><br>

        <label>Code Postal :</label>
        <input type="text" name="cp" required><br>

        <label>Ville :</label>
        <input type="text" name="ville" required><br>

        <label>Date d'embauche :</label>
        <input type="date" name="dateEmbauche" required><br>

        <input type="submit" name="action" value="S'inscrire">
    </form>


 </body>


</html>