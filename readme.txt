Projet : ColLABoraWEB

Auteurs :Bastien LEPESANT et Thomas LEFEBVRE

Critères d’installation : 
Les deux seules fichiers à modifier sont dans le dossier site/define
Ce sont les fichiers root_define.php et mysql_define.php

Dans root_dephine.php (Ce sont les informations utilisé par le site pour se déplacer) :
- HTTP_ROOT correpond à l'URl du dossier (pas "/" final) ou se trouve index.php (exemple : "HTTP://localhost/colaboraweb")
- SERV_ROOT correpond au chemin absolu (au niveau du serveur) du dossier (pas "/" final) ou se trouve index.php (exemple : "/home/user/colaboraweb");

Dans mysql_define.php (Ce sont les 4 paramètres du constructeur de Mysqli) :
- DTB_LINK correspond à l'host de la base de donnée (ex : "localhost")
- DTB_USER correpond au nom d'utilisateur pour accéder à cette base (ex : "root")
- DTB_PASS correpond au mot de passe pour accéder à cette base (ex : "mdp")
- DTB_NAME correspond au nom de la base voulu (ex : "colaboraweb")

URL du site sur le serveur louve.cp : …

Autres : …