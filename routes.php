<?php

require_once __DIR__.'/router.php';

// Routes statiques
get('/', 'index.php');
get('/index.php', 'index.php');
any('/login.php', 'login.php');
any('/nouvelUsager.php', 'nouvelUsager.php');

// Routes de l'API (statiques et dynamique)
get('/api/postits', '/api/postits/getPostits.php');
get('/api/postits/$id', '/api/postits/getPostit.php');
post('/api/postits', '/api/postits/postPostit.php');
put('/api/postits/$id', '/api/postits/putPostits.php');
delete('/api/postits/$id', '/api/postits/deletePostit.php');


// Route introuvable
any('/404','404.php');
