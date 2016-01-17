# Bricks.Frameworks.Base

Фреймворк реализует базовый функционал для простого сайта со статичным 
контентом. Он использует некоторые [пакеты Bricks][] для backend, а так же 
библиотеки [JQuery][] и [Bootstrap][] для frontend.

## Установка и Автозагрузка

Этот фреймворк сопровождается файлом [composer.json][], что позволяет 
использовать [Composer][] для его инсталляции и автозагрузки. Используйте для 
этого следующую команду:

```bash
php -r "readfile('https://getcomposer.org/installer');" | php
php composer.phar create-project bashka/bricks_frameworks_base каталогПроекта
```

Так же можно установить его загрузив [исходные коды][] фреймворка в виде Zip 
архива.

## Запуск

После установки фреймворка и разрешения его зависимостей, можно запустить 
Web-сервер с Bash скрипта `server_start.sh`, расположенного в корневом каталоге 
фреймворка.

При использовании полноценного Web-сервера (на пример Apache или Nginx), 
необходимо настроить переадресацию всех запросов к сприпту `public/index.php`.

## Зависимости

Этот фреймворк зависит от:

* Интерпретатора PHP версии 5.5 или выше
* Пакета [Bricks.Autoload][]
* Пакета [Bricks.ServiceLocator][]
* Пакета [Bricks.Http.Routing][]
* Пакета [Bricks.Http.TemplateEngine.Php][]
* Библиотеки [JQuery][], которая подключается с помощью CDN
* Библиотеки [Bootstrap][], которая подключается с помощью CDN

## Поддержка

Если у вас возникли сложности или вопросы по использованию фреймворка, создайте 
[обсуждение][] в данном репозитории или напишите на электронную почту 
<Artur-Mamedbekov@yandex.ru>.

## Документация

Пользовательскую документацию можно получить по [ссылке](./docs/index.md).

[пакеты Bricks]: http://bricks-packages.org
[JQuery]: http://jquery.com
[Bootstrap]: https://getbootstrap.com
[composer.json]: ./composer.json
[исходные коды]: https://github.com/Bashka/bricks_frameworks_base/releases
[Bricks.Autoload]: https://github.com/Bashka/bricks_autoload
[Bricks.ServiceLocator]: https://github.com/Bashka/bricks_servicelocator
[Bricks.Http.Routing]: https://github.com/Bashka/bricks_http_routing
[Bricks.Http.TemplateEngine.Php]: https://github.com/Bashka/bricks_templateengine_php
[обсуждение]: https://github.com/Bashka/bricks_frameworks_base/issues
