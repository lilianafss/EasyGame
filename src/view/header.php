<header>
    <nav class="navbar">

        <div id="logoContainer">
            <a href="/">
                <img id="logo" alt="logo" src="assets/image/logo.png">
            </a>
        </div>

        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Accueil</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <?php
                if($_SESSION['admin']){
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='http://easygame.ch/admin'>Admin</a>
                    </li>";
                }
            
            ?>
        </ul>
    </nav>
</header>