<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aide & FAQ - GH Cash</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .faq-section {
            padding: 20px;
            margin-bottom: 20px;
        }
        .faq-question {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .faq-answer {
            background-color: #fff;
            padding: 15px;
            border-left: 3px solid #ffc107;
            margin-bottom: 20px;
        }
        .help-card {
            background-color: #fff3cd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-warning bg-warning">
        <div class="container">
            <div class="logo">
                <img src="./img/btc.png" alt="Image">
                GH Cash
            </div>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="login/login.php">Connexion</a></li>
                <li class="nav-item"><a class="nav-link" href="login/register.php">Inscription</a></li>
                <li class="nav-item"><a class="nav-link" href="help.php">Aide & FAQ</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Aide & FAQ</h1>

        <!-- Guide de Démarrage -->
        <div class="help-card">
            <h2>Guide de Démarrage</h2>
            <div class="faq-section">
                <div class="faq-question">
                    <h4>Comment commencer avec GH Cash ?</h4>
                </div>
                <div class="faq-answer">
                    <p>Pour commencer à utiliser GH Cash :</p>
                    <ol>
                        <li>Créez un compte en cliquant sur "Inscription"</li>
                        <li>Connectez-vous à votre compte</li>
                        <li>Commencez à enregistrer vos dépenses</li>
                        <li>Définissez votre premier budget</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Questions Fréquentes -->
        <div class="help-card">
            <h2>Questions Fréquentes</h2>
            
            <div class="faq-section">
                <div class="faq-question">
                    <h4>Comment ajouter une dépense ?</h4>
                </div>
                <div class="faq-answer">
                    <p>Pour ajouter une dépense :</p>
                    <ul>
                        <li>Cliquez sur "Ajouter une dépense"</li>
                        <li>Entrez le montant</li>
                        <li>Sélectionnez la catégorie</li>
                        <li>Ajoutez une description (optionnel)</li>
                        <li>Cliquez sur "Enregistrer"</li>
                    </ul>
                </div>
            </div>

            <div class="faq-section">
                <div class="faq-question">
                    <h4>Comment définir un budget ?</h4>
                </div>
                <div class="faq-answer">
                    <p>Pour définir un budget :</p>
                    <ul>
                        <li>Accédez à la section "Budget"</li>
                        <li>Cliquez sur "Nouveau Budget"</li>
                        <li>Définissez le montant mensuel</li>
                        <li>Choisissez les catégories à inclure</li>
                        <li>Enregistrez votre budget</li>
                    </ul>
                </div>
            </div>

            <div class="faq-section">
                <div class="faq-question">
                    <h4>Comment voir mes rapports ?</h4>
                </div>
                <div class="faq-answer">
                    <p>Pour consulter vos rapports :</p>
                    <ul>
                        <li>Accédez à la section "Rapports"</li>
                        <li>Choisissez la période souhaitée</li>
                        <li>Sélectionnez le type de rapport</li>
                        <li>Visualisez les graphiques et statistiques</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Conseils Utiles -->
        <div class="help-card">
            <h2>Conseils Utiles</h2>
            <div class="faq-section">
                <div class="faq-question">
                    <h4>Comment mieux gérer mes finances ?</h4>
                </div>
                <div class="faq-answer">
                    <p>Voici quelques conseils pour une meilleure gestion :</p>
                    <ul>
                        <li>Enregistrez vos dépenses quotidiennement</li>
                        <li>Définissez des objectifs réalistes</li>
                        <li>Revoyez régulièrement vos budgets</li>
                        <li>Utilisez les catégories pour mieux organiser</li>
                        <li>Consultez régulièrement vos rapports</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        // Simple toggle for FAQ questions
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                answer.style.display = answer.style.display === 'none' ? 'block' : 'none';
            });
        });
    </script>
</body>
</html> 