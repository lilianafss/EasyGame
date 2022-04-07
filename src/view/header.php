<header>
    <nav class="navbar">

        <div id="logoContainer">
            <a href="/">
                <img id="logo" alt="logo" src="assets/image/logo.png">
            </a>
        </div>

        <ul class="nav">
            <li class="nav-item nav-li">
                <a class="nav-link" href="/"><i class="fa-solid fa-2x fa-house icon"></i></a>
                <p class="icon-texte">Accueil</p>
            </li>
            <li class="nav-item nav-li">
                <a class="nav-link" href="/connexion"><i class="fa-solid fa-2x fa-user icon"></i></a>
                <p class="icon-texte">Connexion</p>
            </li>
            <li class="nav-item nav-li">
                <a class="nav-link" href="/"><i class="fa-solid fa-2x fa-heart icon"></i></a>
                <p class="icon-texte">Liste d'envie</p>
            </li>
            <li class="nav-item nav-li">
                <a class="nav-link" href="/panier"><i class="fa-solid fa-2x fa-basket-shopping icon"></i></a>
                <p class="icon-texte">Panier</p>
            </li>
            <?php
            if($_SESSION['admin'])
            {
                echo '
                <li class="nav-item nav-li">
                    <a class="nav-link" href="/admin"><i class="fa-solid fa-2x fa-screwdriver-wrench icon"></i></a>
                    <p class="icon-texte">Admin</p>
                </li>';
            }
            ?>
        </ul>
    </nav>
</header>