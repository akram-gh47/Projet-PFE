<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
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
            <li class="nav-item"><a class="nav-link" href="#Login">Connexion</a></li>
            <li class="nav-item"><a class="nav-link" href="../login/register.php">Inscription</a></li>
            <li class="nav-item"><a class="nav-link" href="../help.php">Aide & FAQ</a></li>
        </ul>
    </div>
 </nav>
 <div class="Welcome">
    <h1>Bienvenue sur GH Cash</h1>
 </div>
 <div class="lgn">
 <h2>Connexion</h2>
 <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">Inscription réussie, veuillez vous connecter.</div>
 <?php endif; ?>
 <?php
 session_start();
 if (isset($_SESSION['login_error'])) {
     echo '<div class="alert alert-danger">'.htmlspecialchars($_SESSION['login_error']).'</div>';
     unset($_SESSION['login_error']);
 }
 ?>
 <form action="dataEntry.php" method="POST">
    <label for="username">Nom d'utilisateur</label><br>
    <input type="text" name="username" placeholder="Nom d'utilisateur" required><br><br>
    <label for="password">Mot de passe</label><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br><br>
    <button type="submit" name="login" href="../login/dashboard.php">se connecter</button>
 </form>
</div>
</body>
</html>