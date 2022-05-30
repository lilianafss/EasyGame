# EasyGame :video_game:

## Documentation technique

### 1. Description

EasyGame est un site de vente de jeux vidéo. Il permet aux utilisateurs d'acheter des jeux d'en rechercher à l'aide de divers filtres tels que l'âge, la plateforme et le genre du jeu. On peut aussi noter les jeux et y laisser des commentaires. Tous les utilisateurs ont un profils où ils peuvent modifier leur information personnelle quand il le souhaite ils peuvent aussi y trouver l'historique des jeux qu'ils ont acheté et leur wishlist.


### 2. Architecture du site
Les pages du site sont séparées en MVC. Chaque fichier a une fonction et une classe particulière qui nous est utile dans le routeur pour faire les liens du site, les models contiennent toutes les requêtes liées a la base de données stockée dans des fonctions qu'on va par la suite appeler dans les contrôleurs, on affiche ensuite les résultats dans les vues à l'aide d'instructions.


### 3. Base de données

Les informations des utilisateurs sont stockées dans une table nommée *user*.Les informations concernant les jeux sont quant à eux stocker dans une table nommée *jeux*
Si un utilisateur achète un jeu alors il aura un panier dans la table *panier* et son jeu sera ajouté dans la table *ajouter_panier* ses deux tables sont liés c'est le même schéma pour la wishlist si un utilisateur ajoute un jeu dans cette table il en aura une dans la table *wishlist* et son jeu sera ajouté dans la table *ajouter_wishlist* ses deux tables son elle aussi liée. Pour l'historique d'achat la logique est la même l'utilisateur paye un jeu alors il  un historique lié à son utilisateurs dans la table *historique* et ses jeux acheter son ajouter dans la table *voir_historique*.Les filtres son séparer dans trois tables les genres dans une table *genre*,les âges dans une table nommée pegis et les plateformes dans une table *plateforme* ses trois tables son lié à la table *jeux* a l'aide de deux tables de liaison *filtre_jeux*et*ou_jouer* pour les âges il sont liés à l'aide d'une clé étrangère dans la table *jeux*.Les notes et les commentaires sont stockés dans des tables appelées *notes* et *commentaires* ses notes et ses commentaires sont eux lier aux utilisateurs et aux jeux à l'aide de clé étrangère presente dans les tables *notes* et *commentaires*
![exemple base de donnée](https://github.com/lilianafss/EasyGame/blob/main/public/assets/image/CaptureBaseDonnee.PNG)
