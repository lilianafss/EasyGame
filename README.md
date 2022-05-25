# EasyGame :video_game:

## Documentation technique

### 1. Description

EasyGame est un site de vente de jeux vidéo. Il permet aux utilisateurs d'acheter des jeux d'en rechercher à l'aide de divers filtres tels que l'âge, la plateforme et le genre du jeu. On peut aussi noter les jeux et y laisser des commentaires. Tous les utilisateurs ont un profils où ils peuvent modifier leur information personnelle quand il le souhaite ils peuvent aussi y trouver l'historique des jeux qu'ils ont acheté et leur wishlist.


### 2. Architecture du site
Les pages du site sont séparées en MVC. Chaque fichier a une fonction et une classe particulière qui nous est utile dans le routeur pour faire les liens du site, les models contiennent toutes les requêtes liées a la base de données stockée dans des fonctions qu'on va par la suite appeler dans les contrôleurs, on affiche ensuite les résultats dans les vues à l'aide d'instructions.


### 3. Base de données

Les information des utilisateur sont stocker dans une table nommé *users*.Les informations concernant les jeux sont quant a eux stocker dans une table nommée *jeux*
