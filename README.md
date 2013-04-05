
SOA Server
=========================

This project is based on [Coderockr SOA-Server] (https://github.com/Coderockr/SOA-Server)

This application depends on these projects:

- [Silex](http://silex.sensiolabs.org/)
- [Doctrine](http://www.doctrine-project.org/)
- [Symfony ClassLoader](https://github.com/symfony/ClassLoader)
- [Symfony Validator](https://github.com/symfony/Validator)
- [Symfony Console](https://github.com/symfony/Console)
- [Monolog](https://github.com/Seldaek/monolog)

Instalation
----------

- Clone this project
- Execute the composer
- Enable Headers module on apache


Authorization
-----------

The service expects an value to Authorization in the request header. The Authorization header will be validated with configs/clients.php contents in client aplications.

Apache Conf
-----------
<VirtualHost *:80>
        DocumentRoot "/var/www/soa-server/public"
        ServerName soa.dev
        SetEnv APPLICATION_ENV development
        Header set Access-Control-Allow-Origin *

        <Directory "/var/www/soa-server/public">
                Options Indexes Multiviews FollowSymLinks
                AllowOverride All
                Order allow,deny
                Allow from all

                <Limit GET HEAD POST PUT DELETE OPTIONS>
                        Order Allow,Deny
                        Allow from all
                </Limit>

                RewriteEngine On
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteRule !\.(js|ico|gif|jpg|png|css|htm|html|txt|mp3)$ index.php
                RewriteRule .? - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
        </Directory>
</VirtualHost>

<VirtualHost *:80>
        DocumentRoot "/var/www/soa-server/public"
        ServerName soatest.dev
        SetEnv APPLICATION_ENV testing
        Header set Access-Control-Allow-Origin *

        <Directory "/var/www/soa-server/public">
                Options Indexes Multiviews FollowSymLinks
                AllowOverride All
                Order allow,deny
                Allow from all

                <Limit GET HEAD POST PUT DELETE OPTIONS>
                        Order Allow,Deny
                        Allow from all
                </Limit>

                RewriteEngine On
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteRule !\.(js|ico|gif|jpg|png|css|htm|html|txt|mp3)$ index.php
                RewriteRule .? - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
        </Directory>
</VirtualHost>
