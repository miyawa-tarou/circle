

```
mkdir -p /etc/letsencrypt/live/circle.dojin-music.info/

# @local
scp (旧サーバー):/etc/letsencrypt/live/circle.dojin-music.info/* .
scp ./* conoha2:/etc/letsencrypt/live/circle.dojin-music.info/.


cd /var/www/
git clone https://github.com/miyawa-tarou/circle.git

vim /etc/nginx/conf.d/circle.conf


server {
    listen 80;
    server_name circle.dojin-music.info;
    location ^~ /.well-known/acme-challenge/ {
        root /var/www/circle;
    }
    return 301 https://circle.dojin-music.info$request_uri;
}
server {
    listen 443 ssl http2;
    server_name circle.dojin-music.info;
    ssl_protocols TLSv1 TLSv1.1 TLSv1.2;

    access_log /var/log/nginx/circle.access.log;
    error_log /var/log/nginx/circle.error.log;

    root /var/www/circle;
    index index.html index.php;
    ssl_certificate /etc/letsencrypt/live/circle.dojin-music.info/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/circle.dojin-music.info/privkey.pem; # managed by Certbot

    ssl_ciphers  ECDHE+AESGCM:DHE+AESGCM:HIGH:!aNULL:!MD5;
    ssl_session_cache shared:SSL:1m;
    ssl_session_timeout 5m;
    ssl_prefer_server_ciphers on;

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_index  index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include   /etc/nginx/fastcgi_params;
    }

    location = /favicon.ico {
        log_not_found off;
    }

}


sudo nginx -t
sudo service nginx restart

```
