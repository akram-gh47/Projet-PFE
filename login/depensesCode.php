<?php
// Démarrer la session pour vérifier l'utilisateur connecté
session_start();
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de login si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}

// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "pfe");
if (!$conn) {
    // Arrêter le script si la connexion échoue
    die("Connection failed: " . mysqli_connect_error());
}

// Récupérer l'identifiant de l'utilisateur connecté
$user_id = $_SESSION['user_id'];

// Récupérer les informations de l'utilisateur pour les calculs de pourcentage
$user_query = "SELECT * FROM users WHERE id_user = $user_id";
$user_result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($user_result);

if (!$user) {
    // Arrêter le script si l'utilisateur n'est pas trouvé
    die("User not found");
}

// Gestion de l'enregistrement d'une dépense (ajout ou modification)
if (isset($_POST['save_expense'])) {
    $id_depense = isset($_POST['id_depense']) ? (int)$_POST['id_depense'] : null;
    $categorie = mysqli_real_escape_string($conn, $_POST['categorie']);
    $montant = (float)$_POST['montant'];
    $date = mysqli_real_escape_string($conn, $_POST['date_transaction']);
    
    if ($id_depense) {
        // Mise à jour d'une dépense existante
        $sql = "UPDATE depenses SET 
                categorie = '$categorie',
                montant = $montant,
                date_transaction = '$date'
                WHERE id_depense = $id_depense AND id_user = $user_id";
        $success = "Expense updated successfully";
    } else {
        // Ajout d'une nouvelle dépense
        $sql = "INSERT INTO depenses (id_user, categorie, montant, date_transaction) 
                VALUES ($user_id, '$categorie', $montant, '$date')";
        $success = "Expense added successfully";
    }
    
    if (mysqli_query($conn, $sql)) {
        // Succès : message en session et redirection
        $_SESSION['success'] = $success;
        header("Location: depenses.php");
        exit();
    } else {
        // Erreur : message en session et redirection
        $_SESSION['error'] = "Error saving expense: " . mysqli_error($conn);
        header("Location: depenses.php");
        exit();
    }
}

// Gestion de la suppression d'une dépense
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM depenses WHERE id_depense = $id AND id_user = $user_id";
    
    if (mysqli_query($conn, $sql)) {
        // Succès : message en session et redirection
        $_SESSION['success'] = "Expense deleted successfully";
        header("Location: depenses.php");
        exit();
    } else {
        // Erreur : message en session et redirection
        $_SESSION['error'] = "Error deleting expense: " . mysqli_error($conn);
        header("Location: depenses.php");
        exit();
    }
}

// Récupérer une dépense pour édition si demandé
$edit_expense = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM depenses WHERE id_depense = $id AND id_user = $user_id";
    $result = mysqli_query($conn, $sql);
    $edit_expense = mysqli_fetch_assoc($result);
    
    if (!$edit_expense) {
        // Erreur : dépense non trouvée
        $_SESSION['error'] = "Expense not found";
        header("Location: depenses.php");
        exit();
    }
}

// Récupérer toutes les dépenses de l'utilisateur avec le pourcentage du salaire
$expenses_query = "SELECT *, (montant / {$user['salaire_user']}) * 100 as percentage 
                  FROM depenses 
                  WHERE id_user = $user_id 
                  ORDER BY date_transaction DESC";
$expenses_result = mysqli_query($conn, $expenses_query);
$expenses = [];
while ($row = mysqli_fetch_assoc($expenses_result)) {
    $expenses[] = $row;
}

// Récupérer les messages de session (erreur ou succès)
$error = $_SESSION['error'] ?? null;
$success = $_SESSION['success'] ?? null;

// Nettoyer les messages de session
unset($_SESSION['error']);
unset($_SESSION['success']);

// Fermer la connexion à la base de données
mysqli_close($conn);
?>