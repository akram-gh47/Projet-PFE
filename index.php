<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gh Cash</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-warning bg-warning">
    <div class="container">
        <div class="logo">
        <img src="./img/btc.png" alt="Image">
        GH Cash
        </div>
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="#Login">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="login/login.php">Connexion</a></li>
            <li class="nav-item"><a class="nav-link" href="login/register.php">Inscription</a></li>
            <li class="nav-item"><a class="nav-link" href="help.php">Aide & FAQ</a></li>
        </ul>
    </div>
    
 </nav>

<div class="About">
  
        <h1>A Propos de Nous</h1> 
        <img src="./img/btc.png" alt="">  
        <p> 
        Gh Cash est votre outil simple et rapide pour suivre vos depenses, gerer votre budget et et mieux controler vos fiances au quotidien. Facile à utiliser,efficace,pensé pour vous aider à atteindre vos objectifs financiers.
        </p> 
        
</div>
<div class="services">
        <h1> Nos Services</h1>
        <div class="SubServices_grid"> 
            <div > 
                <img src="./img/1.jpg" alt="Photo de depenses"> 
                <h3>Suivi de depenses</h3> 
                <p>Enregistrer et categoriser vos depenses mensuelles pour une vison claire de votre finaces</p>  
            </div>  
            <div > 
                <img src="./img/2.jpg" alt="Photo de budget"> 
                <h3>Gestion des budgets</h3> 
                <p>Définisser des limites mensuelles et recever des alertes en cas de dépassement</p> 
                 
            </div> 
            <div > 
                <img src="./img/3.jpg" alt="Photo de rapports"> 
                <h3>Rapports Intelligents</h3> 
                <p>Visualiser vos depenses via un tableau bien detaillé</p> 
                
            </div> 
            <div > 
                <img src="./img/4.jpg" alt="Photo de categorie"> 
                <h3>Categorie personnalisée</h3> 
                <p>Organiser vos depenses par catégorie (alimentation, loisirs, transports, etc.)</p> 
                
            </div> 
        </div> 
</div>
        <div class="Infos-container">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="margin-left: 50px;color: yellow;">Pour d'infos ou questions contactez-nous</h2>
                    <form onsubmit="event.preventDefault(); alert('Message envoyé au support');">
                        <div class="form-group">
                            <label for="name" style="margin-left: 65px;color: yellow;">Name:</label>
                            <input style="margin-left: 65px; width: 200px;" type="text" class="form-control" id="name" placeholder="Saisir votre nom" size="20">
                        </div>
                        <div class="form-group">
                            <label for="email" style="margin-left: 65px;color: yellow;">Email:</label>
                            <input style="margin-left: 65px; width: 500px;" type="email" class="form-control" id="email" placeholder="Saisir votre email" size="20">
                        </div>
                        <div class="form-group">
                            <label for="message" style="margin-left: 65px;color: yellow;">Message:</label><br>
                            <textarea style="margin-left: 65px;" id="message" name="message" rows="6" cols="80" placeholder="Écrivez votre texte ici..."></textarea>
                        </div>
                       
                        <input type="submit" value="Envoyer" class="btn btn-primary" style="margin-left: 65px;">    
                    </form>
                </div>  
            </div>          
        </div>                    
</body>
</html>