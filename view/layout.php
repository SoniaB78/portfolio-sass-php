<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" lang="fr" content="cv portfolio sonia-bougamha php html css developpeur integrateur bootstrap fontawesome"><!--Mots clefs pour le site (référencement)-->
        <meta name="author" content="Sonia Bougamha">
		<meta name="description"  lang="fr" content="Ce site me présente, moi Sonia Bougamha, developpeuse full stacks débutante. Il contient mes réalisations et mes expériences professionnelles.">
		<meta name="distribution" content="global"> <!--global, intranet, local; définit la portée du site-->
        <meta name="revisit-after" content="15 day"><!--Demande aux bots de repasser dans 15jours pour réindexer la page (référencement)-->
        <meta name="owner" content="Sonia Bougamha">
        <meta name="author" lang="fr" content="Sonia Bougamha">
        <meta name="publisher" content="Sonia Bougamha"><!--Définit la personne qui gère le site-->

		<!-- FAVINCON -->
		<link rel="apple-touch-icon" sizes="180x180" href="public/inc/img/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="public/inc/img/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="public/inc/img/favicon/favicon-16x16.png">
		<link rel="manifest" href="public/inc/img/favicon/site.webmanifest">
		
		<!-- GOOGLEFONT -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:500" rel="stylesheet">
		
		<!-- CSS FANCYBOX -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css">
		
		<!-- FONTAWESOME -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

		<!-- BOOTSTRAP -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- BLK DESIGN SYSTEM extend BOOTSTRAP -->
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet">
        <!-- Theme CSS -->
        <link type="text/css" href="public/inc/blk-design-system-master/assets/css/blk-design-system.min.css" rel="stylesheet">

        <!-- PERSONNAL CSS -->
		<link rel="stylesheet" href="public/sass/style.css">

        <title>Sonia Bougamha Developpeuse Web</title>
    </head>

    <body>
        <header class="fixed-top">

            <nav class="navbar navbar px-5 bg-transparent">
                <a class="navbar-brand" href="view/homepage.php">
                    <img src="public/inc/img/logo-pas-ferme.png" alt="" height="100">
                </a>

                <ul class="nav nav-tabs flex-column align-items-end">				
                    <li class="nav-item" role="presentation">
                        <button class="nav-link py-1 active" id="portfolio-tab" data-bs-toggle="tab" data-bs-target="#portfolio" type="button" role="tab" aria-controls="portfolio" aria-selected="true">PORTFOLIO</button>
                    </li>
                    <li class="nav-item py-1" role="presentation">
                        <button class="nav-link py-1 active" id="parcours-tab" data-bs-toggle="tab" data-bs-target="#parcours" type="button" role="tab" aria-controls="parcours" aria-selected="true">PARCOURS</button>
                    </li>
                    <li class="nav-item py-1" role="presentation">
                        <button class="nav-link py-1 active" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="true">CONTACT</button>
                    </li>
                </ul>
            </nav>
        </header>

        <main class="container tab-content">
            <?= $content ?>
        </main>

        <footer class=" d-flex justify-content-between align-items-center bg-primary px-5">
            <span class="">
                <a href="public/inc/cv_sonia_bougamha.pdf" target="blank" title="voir/télécharger mon CV, 78KB, PDF"> <i class="fas fa-file-pdf"></i>CV</a>
            </span>

            <div class="">
                <span class="align-self-center" id="admin">
                    Image de fond de Pexels sur Pixabay.
                    <br />
                    <?php echo date("Y"); ?> - Tous dr<a href="?page=connection&table=profile">o</a>its reservés - Sonia Bougamha
                </span>
            </div>

            <span class="">
            <a href="https://www.linkedin.com/in/sonia-bougamha-50697a171/" target="blank" title="voir profil LinkedIn, s'ouvre dans un nouvel onglet"> <i class="fab fa-linkedin"></i></a>
            <a href="https://www.twitter.com/@soniabougamha/" target="blank" title="voir profil Twitter, s'ouvre dans un nouvel onglet"><i class="fab fa-twitter-square"></i></a>
            <a href="https://github.com/SoniaB78" target="blank" title="voir compte Git Hub, s'ouvre dans un nouvel onglet"><i class="fab fa-github-square"></i></a>
            </span>	
            
        </footer>

    	<!--script PERSO-->
		<script src="public/js/script.js"></script>
		
        <!-- BLK DESIGN SYSTEM SCRIPTS -->
        <!-- Core -->
        <script src="/assets/vendor/jquery/jquery.min.js"></script>
        <script src="/assets/vendor/popper/popper.min.js"></script>
        <script src="/assets/vendor/bootstrap/bootstrap.min.js"></script>
        <!-- Theme JS -->
        <script src="/assets/js/blk-design-system.min.js"></script>

		<!-- JQuery Library -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>


		<!-- Fancy Box Core JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
		<!-- Optionnel pour naviguer avec le scroll dans la fancybox -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.0.4/jquery.mousewheel.min.js"></script>

		<!-- SCRIPT BOOTSTRAP-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    </body>

</html>