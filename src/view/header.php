<header>
    <nav class="navbar">

        <div id="logoContainer">
            <a href="/">
                <img id="logo" alt="logo" src="assets/image/logo.png">
            </a>
        </div>

        <ul class="nav">
            <?php
                echo '
                    <li class="nav-item nav-li">
                        <a class="nav-link" href="/"><i class="fa-solid fa-2x fa-house icon"></i></a>
                        <p class="icon-texte">Accueil</p>
                    </li>
                ';

                if (!($_SESSION['connected']))
                {
                    echo '
                        <li class="nav-item nav-li">
                            <a class="nav-link" href="/connexion"><i class="fa-solid fa-2x fa-arrow-right-to-bracket icon"></i></a>
                            <p class="icon-texte">Connexion</p>
                        </li>
                    ';
                }
                else
                {
                    echo '
                        <li class="nav-item nav-li">
                            <a class="nav-link" href="/profil"><i class="fa-solid fa-2x fa-user icon"></i></a>
                            <p class="icon-texte">Profil</p>
                        </li>
                        
                        <li class="nav-item nav-li">
                            <a class="nav-link" href="/panier"><i class="fa-solid fa-2x fa-basket-shopping icon"></i></a>
                            <p class="icon-texte">Panier</p>
                        </li>
                        
                        <li class="nav-item nav-li">
                            <a class="nav-link" href="/"><i class="fa-solid fa-2x fa-heart icon"></i></a>
                            <p class="icon-texte">Wishlist</p>
                        </li>
                        
                        <li class="nav-item nav-li">
                            <a class="nav-link" href="/deconnexion"><i class="fa-solid fa-2x fa-arrow-right-from-bracket icon"></i></a>
                            <p class="icon-texte">Déconnexion</p>
                        </li>
                        
                    ';

                    if($_SESSION['admin'])
                    {
                        echo '
                            <li class="nav-item nav-li">
                                <a class="nav-link" href="/admin"><i class="fa-solid fa-2x fa-screwdriver-wrench icon"></i></a>
                                <p class="icon-texte">Admin</p>
                            </li>
                        ';
                    }
                }
            ?>
        </ul>
    </nav>
</header>