<?php
// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "pfe");

if (!$conn) {
    // Arrêter le script si la connexion échoue
    die("Connection failed: " . mysqli_connect_error());
}

// Gestion de l'inscription d'un nouvel utilisateur
if (isset($_POST['register'])) {
    // Récupérer et sécuriser les données du formulaire
    var_dump($_POST); // Pour le debug, à retirer en production
    $nom = mysqli_real_escape_string($conn, $_POST['name']);
    $prenom = mysqli_real_escape_string($conn, $_POST['lastname']);
    $login = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hachage du mot de passe
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $bank = mysqli_real_escape_string($conn, $_POST['bank']);
    $salaire = isset($_POST['salaire']) ? (float)$_POST['salaire'] : 0.00;

    // Vérifier si le nom d'utilisateur ou l'email existe déjà
    $check_query = "SELECT * FROM users WHERE username_user = '$login' OR email_user = '$email'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // Afficher un message si l'utilisateur existe déjà
        $error = "Username ou email existe deja!";
    } else {
        // Insérer le nouvel utilisateur dans la base
        $sql = "INSERT INTO users (nom_user, prenom_user, username_user, email_user, password_user, city_user, bank_user, salaire_user) 
                VALUES ('$nom', '$prenom', '$login', '$email', '$password', '$city', '$bank', $salaire)";
                
        if (mysqli_query($conn, $sql)) {
            // Rediriger vers la page de login après inscription
            header("Location: login.php?success=1");
            exit();
        } else {
            // Afficher une erreur si l'insertion échoue
            $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
// Gestion de la connexion utilisateur
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Requête pour trouver l'utilisateur par nom d'utilisateur ou email
    $sql = "SELECT * FROM users WHERE username_user = '$username' OR email_user = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password_user'])) {
            // Démarrer la session et stocker les infos utilisateur
            session_start();
            $_SESSION['user_id'] = $row['id_user'];
            $_SESSION['username'] = $row['username_user'];
            header("Location: dashboard.php");
            exit();
        } else {
            // Mot de passe invalide
            $error = "Mot de passe ou email incorrect!";
        }
    } else {
        // Utilisateur non trouvé
        $error = "User introuvable!";
    }
}
// Affichage des erreurs via session et redirection
if (isset($error)) {
    session_start();
    $_SESSION['login_error'] = $error;
    header("Location: login.php");
    exit();
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>

