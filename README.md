
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
[Link no gist](https://gist.github.com/willianmano/5323096)
