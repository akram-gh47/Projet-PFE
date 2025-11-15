<?php
require_once 'depensesCode.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depenses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        h2 {
            color: yellow;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-header {
            border-radius: 15px 15px 0 0 !important;
            background-color: #f8f9fa;
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
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="stats.php">Statistiques des depenses</a></li>
                <li class="nav-item"><a class="nav-link" href="help.php">Aide & FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Deconnexion</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <!-- Add Expense Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestion des Depenses</h2>
            <a href="depenses.php?action=new" class="btn btn-primary">
                <i class="fas fa-plus"></i> Ajouter nouvelle depense
            </a>
        </div>

        <!-- Expenses List -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Vos Depenses</h5>
            </div>
            <div class="card-body">
                <?php if (empty($expenses)): ?>
                    <p class="text-muted">Accune depense enregistrée pour le moment.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Categorie</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th>% du salaire</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($expenses as $expense): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($expense['categorie']); ?></td>
                                        <td><?php echo number_format($expense['montant'], 2); ?> MAD</td>
                                        <td><?php echo date('M d, Y', strtotime($expense['date_transaction'])); ?></td>
                                        <td><?php echo number_format($expense['percentage'], 1); ?>%</td>
                                        <td>
                                            <a href="depenses.php?action=edit&id=<?php echo (int)$expense['id_depense']; ?>" 
                                               class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="depensesCode.php?action=delete&id=<?php echo (int)$expense['id_depense']; ?>" 
                                               class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (isset($_GET['action']) && ($_GET['action'] == 'new' || $_GET['action'] == 'edit')): ?>
        <!-- Expense Form -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0"><?php echo $_GET['action'] == 'edit' ? 'Edit' : 'Add New'; ?> Depenses</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="depensesCode.php">
                    <?php if (isset($edit_expense)): ?>
                        <input type="hidden" name="id_depense" value="<?php echo (int)$edit_expense['id_depense']; ?>">
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="categorie" class="form-label">Categorie</label>
                        <select class="form-control" id="categorie" name="categorie" required>
                            <?php $categories = [
                                "taxes",
                                "factures",
                                "voyage",
                                "alimentation",
                                "transport",
                                "shopping",
                                "santé",
                                "loisirs"
                            ]; ?>
                            <option value="">Choisissez une categorie</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo htmlspecialchars($cat); ?>" <?php if (isset($edit_expense) && $edit_expense['categorie'] == $cat) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($cat); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant (MAD)</label>
                        <input type="number" step="0.01" class="form-control" id="montant" name="montant" 
                               value="<?php echo isset($edit_expense) ? htmlspecialchars($edit_expense['montant']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_transaction" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date_transaction" name="date_transaction" 
                               value="<?php echo isset($edit_expense) ? htmlspecialchars($edit_expense['date_transaction']) : date('Y-m-d'); ?>" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="depenses.php" class="btn btn-secondary me-2">Annuler</a>
                        <button type="submit" name="save_expense" class="btn btn-primary">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>
</body>
</html> 