<?php
require_once 'dashboardCode.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestion des Dépenses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-header {
            border-radius: 15px 15px 0 0 !important;
            background-color: #f8f9fa;
        }
        .progress {
            height: 20px;
            border-radius: 10px;
        }
    </style>
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
                <li class="nav-item"><a class="nav-link" href="depenses.php">Dépenses</a></li>
                <li class="nav-item"><a class="nav-link" href="stats.php">Statistiques des dépenses</a></li>
                <li class="nav-item"><a class="nav-link" href="help.php">Aide & FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Deconnexion</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Salary Information -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Information de salaire</h5>
                <a href="dashboard.php?action=edit_salary" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> Update
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                    <p><strong>Salaire mensuel:</strong> <?php 
                          $salaire = isset($user['salaire_user']) ? (float)$user['salaire_user'] : 0.00;
                          echo number_format($salaire, 2); 
                    ?> MAD</p>

                    </div>
                    <div class="col-md-6">
                        <p><strong>Compte bancaire:</strong> <?php echo htmlspecialchars($user['bank_user']); ?></p>
                    </div>
                </div>
            </div>
        </div>
               
        <!-- Financial Overview -->
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Dépenses totales</h5>
                        <h3 class="card-text"><?php echo number_format($total_expenses, 2); ?> MAD</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Epargne</h5>
                        <h3 class="card-text"><?php echo number_format($savings, 2); ?> MAD</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Taux d'épargne</h5>
                        <h3 class="card-text"><?php $salaire = isset($user['salaire_user']) ? (float)$user['salaire_user'] : 1;
                    echo ($salaire > 0) ? number_format(($savings / $salaire) * 100, 1) : '0.0'; ?>%</h3>
                    </div>
                </div>
            </div>
        </div>

       <!-- Recent Expenses -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Dépenses récentes</h5>
    </div>
    <div class="card-body">
        <?php if (empty($recent_expenses)): ?>
            <p class="text-muted">Aucune dépense enregistrée pour le moment.</p>
        <?php else: ?>
            <?php foreach ($recent_expenses as $expense): ?>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span><?php echo htmlspecialchars($expense['categorie']); ?></span>
                        <span><?php echo number_format($expense['montant'], 2); ?> MAD</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" 
                             style="width: <?php echo $expense['percentage']; ?>%"
                             aria-valuenow="<?php echo $expense['percentage']; ?>" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                            <?php echo number_format($expense['percentage'], 1); ?>%
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<!-- Ajout du bouton d'impression du rapport -->
<div class="text-center my-4">
    <p style='color: gold;'>Est-ce que vous voulez le rapport des dépenses&nbsp;?</p>
    <a href="stats.php?print=1" class="btn btn-warning" target="_blank">
        <i class="fas fa-print"></i> Imprimer
    </a>
</div>
        <?php if (isset($_GET['action']) && $_GET['action'] == 'edit_salary'): ?>
        <!-- Salary Update Form -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Mettre à jour les informations de salaire</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="salaire" class="form-label">Salaire mensuel (MAD)</label>
                        <input type="number" class="form-control" id="salaire" name="salaire" 
                        value="<?php echo isset($user['salaire_user']) ? htmlspecialchars($user['salaire_user']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="bank" class="form-label">Compte bancaire</label>
                        <input type="text" class="form-control" id="bank" name="bank" 
                           value="<?php echo htmlspecialchars($user['bank_user']); ?>" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="dashboard.php" class="btn btn-secondary me-2">Annuler</a>
                        <button type="submit" name="update_salary" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 