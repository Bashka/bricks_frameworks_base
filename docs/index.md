# Возможности фреймворка

* Простая архитектура вида: страница - метод контроллера
* Использование статичных HTML страниц с предварительной шаблонизацией и 
  возможностью подключения контента

# Backend

Запрос пользователя обрабатывается согласно следующей схеме:

* Запросы клиента передаются скрипту `public/index.php`, отвечающему за передачу 
  запроса фреймворку через вызов класса `App`
* Класс `App` инициализирует фреймворк и выполняет маршрутизацию запроса вызывая 
  соответствующий метод контроллера
* Контроллер обрабатывает запрос клиента и выбирает подходящий шаблон для ответа
* Выбранный шаблон рендерится с помощью PHP шаблонизатора и возвращается клиенту 
  в качестве ответа

## Маршрутизация

Фреймворк использует следующую таблицу маршрутов:

* `/{контроллер}/{метод}` - управление передается указанному методу контроллера
* `/{контроллер}` - управление передается методу `index` указанного контроллера
* `/` - управление передается методу `index` контроллера `Index`

В случае отсутствия целевого контроллера или метода, будет возвращен шаблон 
`backend/template/404.html`. Ошибки и исключения заменяются шаблоном 
`backend/template/500.html`.

## Контроллеры

Контроллеры фреймворка являются подклассами класса 
`Bricks\Frameworks\Base\Controller\Controller`, который инициализируется 
локатором служб фреймворка, а так же содержит информацию об используемом 
контроллере и его методе. Контроллеры могут получить доступ к этим данным с 
помощью свойство `locator`, `controller` и `action` соответственно.

Метод `template()` контроллера позволяет получить связанный с ним шаблон. Этот 
шаблон может быть в дальнейшем инициализирован и возвращен из метода для 
передачи его клиенту.

## Шаблоны

Шаблоны обычно связаны с методами контроллеров благодаря общей структуре 
каталогов. Так, метод `index` контроллера `Index` использует шаблон 
`backend/template/Index/index.html` для формирования ответа клиенту.  
Рекомендуется придерживаться именно такого решения, но это не обязательно. Как 
было описано выше, получить шаблон, связанный с вызванным методом контроллера 
можно с помощью метода `template()`.

# Frontend

По умолчанию шаблоны фреймворка используют библиотеки JQuery и Bootstrap для 
frontend.