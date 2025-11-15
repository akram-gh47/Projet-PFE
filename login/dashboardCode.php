<?php
// Démarrer la session pour vérifier l'utilisateur connecté
session_start();

// 1. Vérification de la session utilisateur
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de login si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}

// 2. Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "pfe");
if (!$conn) {
    // Arrêter le script si la connexion échoue
    die("Database connection failed: " . mysqli_connect_error());
}

// 3. Récupération de l'ID utilisateur
$user_id = (int)$_SESSION['user_id'];

// 4. Récupération des informations utilisateur
$user_query = "SELECT * FROM users WHERE id_user = $user_id";
$user_result = mysqli_query($conn, $user_query);

if (!$user_result || mysqli_num_rows($user_result) === 0) {
    // Arrêter le script si l'utilisateur n'est pas trouvé
    die("Utilisateur non trouvé");
}

$user = mysqli_fetch_assoc($user_result);

// 5. Calcul des dépenses totales de l'utilisateur
$expenses_query = "SELECT SUM(montant) as total_expenses FROM depenses WHERE id_user = $user_id";
$expenses_result = mysqli_query($conn, $expenses_query);
$expenses_data = mysqli_fetch_assoc($expenses_result);
$total_expenses = (float)($expenses_data['total_expenses'] ?? 0);

if ($total_expenses === null) {
    $total_expenses = 0.00;
}

// 6. Calcul des indicateurs financiers (salaire, épargne, taux d'épargne)
$salaire = isset($user['salaire_user']) ? (float)$user['salaire_user'] : 0.00;
$savings = $salaire - $total_expenses;
$savings_rate = ($salaire > 0 && $total_expenses >= 0) ? ($savings / $salaire) * 100 : 0;

// 7. Récupération des 5 dernières dépenses avec pourcentage du salaire
// Vérification que le salaire n'est pas nul pour éviter la division par zéro
$salaire_value = isset($user['salaire_user']) && $user['salaire_user'] > 0 ? (float)$user['salaire_user'] : 1;
$recent_expenses_query = "SELECT 
    categorie, 
    montant, 
    date_transaction, 
    (montant / GREATEST(?, 1)) * 100 as percentage
    FROM depenses 
    WHERE id_user = ?
    ORDER BY date_transaction DESC 
    LIMIT 5";

// Préparation de la requête avec des paramètres pour éviter les injections SQL
$stmt = $conn->prepare($recent_expenses_query);
$stmt->bind_param("di", $salaire_value, $user_id);
$stmt->execute();
$recent_expenses_result = $stmt->get_result();

if (!$recent_expenses_result) {
    // Arrêter le script en cas d'erreur SQL
    die("Erreur dans la requête des dépenses: " . mysqli_error($conn));
}

// Stocker les dépenses récentes dans un tableau
$recent_expenses = [];
while ($row = mysqli_fetch_assoc($recent_expenses_result)) {
    $recent_expenses[] = $row;
}

// 8. Gestion de la mise à jour du salaire
if (isset($_POST['update_salary'])) {
    $new_salary = (float)$_POST['salaire'];
    $new_bank = mysqli_real_escape_string($conn, $_POST['bank']);
    
    $update_query = "UPDATE users SET 
                    salaire_user = $new_salary, 
                    bank_user = '$new_bank' 
                    WHERE id_user = $user_id";
    
    if (!mysqli_query($conn, $update_query)) {
        // Afficher une erreur si la mise à jour échoue
        $error = "Erreur de mise à jour: " . mysqli_error($conn);
    } else {
        // Rediriger vers le dashboard après la mise à jour
        header("Location: dashboard.php?updated=1");
        exit();
    }
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>