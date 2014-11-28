<IfModule mod_rewrite.c>
    RewriteEngine    on
    RewriteBase      /cake_sample/app/webroot
    RewriteCond      %{REQUEST_FILENAME} !-d
    RewriteCond      %{REQUEST_FILENAME} !-f
    RewriteRule      ^(.*)$ index.php?url=$1 [QSA,L]
</IfModule>
