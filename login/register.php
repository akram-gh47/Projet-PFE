<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/loginCss.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-warning bg-warning">
    <div class="container">
        <div class="logo">
            <img src="../img/btc.png" alt="Image">
            GH Cash
        </div>
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="../index.php">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php">Connexion</a></li>
            <li class="nav-item"><a class="nav-link" href="register.php">Inscription</a></li>
            <li class="nav-item"><a class="nav-link" href="../help.php">Aide & FAQ</a></li>
        </ul>
    </div>
</nav>

<div class="Welcome">
    <h1>Bienvenue sur GH Cash</h1>
</div>

<div class="Register">
    <h2>Inscription</h2>
  
    <form action="dataEntry.php" method="POST">
        <label for="name">Nom</label><br>
        <input type="text" name="name" required><br>

        <label for="lastname">Prénom</label><br>
        <input type="text" name="lastname" required><br>

        <label for="city">Ville</label><br>
        <input type="text" name="city" required><br>

        <label for="bank">Banque utilisée</label><br>
        <select name="bank" required>
            <option value="" selected disabled>-- Choisissez Votre Banque --</option>
            <option value="AttijariWafa Bank">AttijariWafa Bank</option>
            <option value="CIH">CIH</option>
            <option value="Banque Populaire">Banque Populaire</option>
            <option value="BMCI">BMCI</option>
            <option value="BMCE">BMCE</option>
        </select><br>
        <label for="salary">Salaire</label><br>
        <input type="number" name="salaire" step="0.01" min="0"  required>
        <br>
        <label for="username">Nom d'utilisateur</label><br>
        <input type="text" name="username"  required><br>
        <label for="email">Email</label><br>
        <input type="email" name="email"  required><br>

        <label for="password">Mot de passe</label><br>
        <input type="password" name="password" required><br>
    
        <button type="submit" name="register">Créer un compte</button>
        <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
    </form>
</div>
</body>
</html>