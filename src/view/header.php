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
                        <p class="texte-icon">Accueil</p>
                    </li>
                ';

                if (!($_SESSION['connected']))
                {
                    echo '
                        <li class="nav-item nav-li">
                            <a class="nav-link" href="/connexion"><i class="fa-solid fa-2x fa-arrow-right-to-bracket icon"></i></a>
                            <p class="texte-icon">Connexion</p>
                        </li>
                        <li class="nav-item nav-li">
                            <a class="nav-link" href="/nouveau"><i class="fa-solid fa-2x fa-user-plus icon"></i></a>
                            <p class="texte-icon">S\'inscrire</p>
                        </li>
                    ';
                }
                else
                {
                    echo '
                        <li class="nav-item nav-li">
                            <a class="nav-link" href="/profil"><i class="fa-solid fa-2x fa-user icon"></i></a>
                            <p class="texte-icon">Profil</p>
                        </li>
                    
                        
                        <li class="nav-item nav-li">
                                 
                        <a class="nav-link" href="/panier">
                            <i class="fa-solid fa-2x fa-basket-shopping icon"></i>
                            <span class="badge rounded-pill badge-notification bg-danger"></span>
                        </a>
                        <p id="panier" class="texte-icon">Panier</p>
                       
                    </li>
                      
                        
                       <li class="nav-item nav-li">
                            <a class="nav-link" href="/deconnexion"><i class="fa-solid fa-2x fa-arrow-right-from-bracket icon"></i></a>
                            <p class="texte-icon">Déconnexion</p>
                        </li>
                        
                    ';

                    if($_SESSION['admin'])
                    {
                        echo '
                            <li class="nav-item nav-li">
                                <a class="nav-link" href="/admin"><i class="fa-solid fa-2x fa-screwdriver-wrench icon"></i></a>
                                <p class="texte-icon">Admin</p>
                            </li>
                        ';
                    }
                }
            ?>
        </ul>
    </nav>
</header>