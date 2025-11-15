<?php
// Démarrer la session pour vérifier l'utilisateur connecté
session_start();
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de login si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}

// Connexion à la base de données MySQL
$conn = mysqli_connect("localhost", "root", "", "pfe");
if (!$conn) {
    // Arrêter le script si la connexion échoue
    die("Database connection failed: " . mysqli_connect_error());
}

// Récupérer l'identifiant de l'utilisateur connecté depuis la session
$user_id = (int)$_SESSION['user_id'];

// Récupérer toutes les dépenses de l'utilisateur pour l'historique
$history_query = "SELECT categorie, montant, date_transaction FROM depenses WHERE id_user = $user_id ORDER BY date_transaction DESC";
$history_result = mysqli_query($conn, $history_query);
$history = [];
while ($row = mysqli_fetch_assoc($history_result)) {
    $history[] = $row;
}

// Requête SQL pour obtenir la somme des dépenses par catégorie pour cet utilisateur
$query = "SELECT categorie, SUM(montant) as total FROM depenses WHERE id_user = $user_id GROUP BY categorie";
$result = mysqli_query($conn, $query);

// Initialiser les tableaux pour stocker les catégories et les totaux
$categories = [];
$totals = [];
// Parcourir les résultats et remplir les tableaux
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row['categorie']; // Ajouter la catégorie
    $totals[] = (float)$row['total'];  // Ajouter le total de la catégorie
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Dépenses</title>
    <!-- Liens vers Bootstrap, FontAwesome et le CSS personnalisé -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        /* Style des cartes pour garder la cohérence avec le dashboard */
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-header {
            border-radius: 15px 15px 0 0 !important;
            background-color: #f8f9fa;
        }
        @media print {
            .container {
                margin-left: 10vw !important;
            }
        }
    </style>
</head>
<body>
    <!-- Barre de navigation identique au dashboard -->
    <nav class="navbar navbar-expand-lg navbar-warning bg-warning">
        <div class="container">
            <div class="logo">
                <img src="../img/btc.png" alt="Image">
                GH Cash
            </div>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="../index.php">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="depenses.php">Dépenses</a></li>
                <li class="nav-item"><a class="nav-link" href="stats.php">Statistiques des dépenses</a></li>
                <li class="nav-item"><a class="nav-link" href="help.php">Aide & FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Deconnexion</a></li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <!-- Historique des dépenses -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Historique des Dépenses</h5>
            </div>
            <div class="card-body">
                <?php if (empty($history)): ?>
                    <p class="text-muted">Aucune dépense enregistrée pour le moment.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Catégorie</th>
                                    <th>Montant (MAD)</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($history as $row): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['categorie']); ?></td>
                                        <td><?php echo number_format($row['montant'], 2); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($row['date_transaction'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- Graphique des dépenses -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Graphique des Dépenses par Catégorie</h5>
            </div>
            <div class="card-body">
                <!-- Canvas pour afficher le graphique -->
                <canvas id="depensesChart" height="120"></canvas>
            </div>
        </div>
    </div>
    <!-- Import de Chart.js depuis un CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Récupérer le contexte 2D du canvas pour dessiner le graphique
        const ctx = document.getElementById('depensesChart').getContext('2d');
        // Préparer les données pour le graphique
        const data = {
            labels: <?php echo json_encode($categories);?>,      // Les catégories sur l'axe X
            datasets: [{
                label: 'Dépenses (MAD)', // Légende de la série de données
                data: <?php echo json_encode($totals); ?>,   // Les montants sur l'axe Y
                backgroundColor: [
                    // Couleurs pour chaque barre
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FFD700', '#00C49A'
                ],
                borderWidth: 1 // Largeur de la bordure des barres
            }]
        };
        // Création du graphique de type "bar" (histogramme)
        
        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Montant (MAD)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Catégorie'
                        }
                    }
                },
                // Réduire la largeur des barres
                barPercentage: 0.5,
                categoryPercentage: 0.5
            }
        });

    </script>
    <?php if (isset($_GET['print']) && $_GET['print'] == '1'): ?>
    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
    <?php endif; ?>
</body>
</html>
