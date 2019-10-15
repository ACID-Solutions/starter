<?php
return [
    // content *********************************************************************************************************
    'login'        => [
        'index'  => 'connexion',
        'login'  => 'connecter',
        'logout' => 'deconnecter',
    ],
    'password'     => [
        'index'     => 'mot-de-passe/reinitialisation',
        'email'     => 'mot-de-passe/e-mail',
        'update'    => 'mot-de-passe/reinitialisation/{token}',
        'reset'     => 'mot-de-passe/reinitialiser',
        'confirm'   => 'mot-de-passe/verification',
        'reconfirm' => 'mot-de-passe/confirmer',
    ],
    'registration' => [
        'index'    => 'inscription',
        'register' => 'inscrire',
    ],
    'verification' => [
        'notice' => 'email/verification',
        'verify' => 'email/verification/{id}',
        'resend' => 'email/renvoi',
    ],
    'admin'        => [
        'index' => '/',
    ],
    'dashboard'    => [
        'index' => 'tableau-de-bord',
    ],
    'home'         => [
        'page' => [
            'index' => '/',
        ],
    ],
    'news'         => [
        'categories' => [
            'index'   => 'news/categories',
            'create'  => 'news/categorie/creer',
            'store'   => 'news/categorie/enregistrer',
            'edit'    => 'news/categorie/editer/{category}',
            'update'  => 'news/categorie/mettre-a-jour/{category}',
            'destroy' => 'news/categorie/supprimer/{category}',
        ],
        'articles'   => [
            'index'   => 'news/articles',
            'create'  => 'news/article/creer',
            'store'   => 'news/article/enregistrer',
            'edit'    => 'news/article/editer/{article}',
            'update'  => 'news/article/mettre-a-jour/{article}',
            'destroy' => 'news/article/supprimer/{article}',
            'show'    => 'news/article/{url}',
        ],
    ],
    'simplePages'  => [
        'show'    => '{url}',
        'index'   => 'pages',
        'create'  => 'page/creer',
        'store'   => 'page/enregistrer',
        'edit'    => 'page/editer/{simplePage}',
        'update'  => 'page/mettre-a-jour/{simplePage}',
        'destroy' => 'page/supprimer/{simplePage}',
    ],
    // admin ***********************************************************************************************************
    'settings'     => [
        'index'  => 'parametres',
        'update' => 'parametres/mettre-a-jour',
    ],
    'users'        => [
        'index'   => 'utilisateurs',
        'create'  => 'utilisateur/creer',
        'store'   => 'utilisateur/enregistrer',
        'edit'    => 'utilisateur/editer/{user}',
        'update'  => 'utilisateur/mettre-a-jour/{user}',
        'destroy' => 'utilisateur/supprimer/{user}',
        'profile' => [
            'edit'   => 'mon-profil',
        ],
    ],
];
