<nav class="navbar" id="nav-link">

    <div id="logoContainer">
        <a href="<?= url('accueil') ?>">
            <img id="logo" alt="logo" src="/assets/image/logo.png">
        </a>
        <ul class="nav filterNav" >
            <?php
            echo '
                <li class="nav-item nav-li" id="accueil">
                    <a class="nav-link" href="'.url('accueil').'"><i class="fa-solid fa-2x fa-house icon"></i></a>
                    <p class="texte-icon">Accueil</p>
                </li>
            ';

            if (!($_SESSION['connected']))
            {
                echo '
                    <li class="nav-item nav-li connexion">
                        <a class="nav-link" href="'.url('connexion').'"><i class="fa-solid fa-2x fa-arrow-right-to-bracket icon"></i></a>
                        <p class="texte-icon">Connexion</p>
                    </li>
                    
                    <li class="nav-item nav-li connexion">
                        <a class="nav-link" href="'.url('nouveau').'"><i class="fa-solid fa-2x fa-user-plus icon"></i></a>
                        <p class="texte-icon">S\'inscrire</p>
                    </li>
                ';
            }
            else
            {
                echo '
                    <li class="nav-item nav-li" id="profil">
                        <a class="nav-link" href="'.url('profil').'"><i class="fa-solid fa-2x fa-user icon"></i></a>
                        <p class="texte-icon">Profil</p>
                    </li> 
                    
                    <li class="nav-item nav-li connexion">
                        <a class="nav-link" href="'.url('deconnexion').'"><i class="fa-solid fa-2x fa-arrow-right-from-bracket icon"></i></a>
                        <p class="texte-icon">Déconnexion</p>
                    </li>';

                    if($_SESSION['admin'])
                    {
                        echo '
                            <li class="nav-item nav-li" id="admin">
                                <a class="nav-link" href="'.url('admin').'"><i class="fa-solid fa-2x fa-screwdriver-wrench icon"></i></a>
                                <p class="texte-icon">Admin</p>
                            </li>
                        ';
                    }

                    echo'
                    <li class="nav-item nav-li" id="panier-container">                            
                        <a class="nav-link" href="'.url('panier').'">
                            <i class="fa-solid fa-2x fa-basket-shopping icon"></i>
                            <span class="badge rounded-pill badge-notification bg-danger">'.$_SESSION['quantite'].'</span>
                        </a>
                        <p id="panier" class="texte-icon">Panier</p>
                    </li>       
                ';
            }
            ?>
        </ul>
    </div>
</nav>