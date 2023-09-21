##Run server
<code>
docker-compose up
</code>

##Настройки первого запуска Laravel
<ol>
<li> Запустить web контейнер с проектом <code> docker-compose exec web bash </code></li>
<li> Проверить версию php: <code>php -v</code> (должна быть не меньше 8.1.14)</li>
<li> Запустить  <code>php composer.phar install</code> (загрузит все зависимости)</li>
<li> Убедиться, что выполнились post-install-cmd скрипты из composer.json файла
и появился в корне файл .env </li>
<li> Если post-install скрипты не выполнились, то:<ul>
<li> создать .env файл копией от .env.example </li>
<li> сгенерировать ключ: <code>php artisan key:generate</code></li>
<li> выполнить все зависимости npm</li>
<li> загрузить npm run dev</li>
<li> выполнить все миграции и сидеры</li>
</ul></li>
<li> Указали доступ к базе в файле .env:
<pre>
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=chat
DB_USERNAME=root
DB_PASSWORD=root
</pre>

Для работы вебсокет необходимо указать данные pusher:
<pre>
PUSHER_APP_ID=1674191
PUSHER_APP_KEY=5c12d3818ac790a8ad1e
PUSHER_APP_SECRET=fca53233b90033edb48b
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=eu
</pre>
</li>
</ol>


##Вход в контейнер докера
<ol>
<li> Запустить web контейнер с проектом <code> docker-compose exec web bash </code></li>
</ol>

## Update classes list to be included
<code>
php composer.phar dump-autoload
</code>


## Clear config cache if it was built while deploy process
<code>
php artisan config:clear
</code>  
<p>Важно при создании новый файлов конфигов в папке config/</p>

##Run simple php server without docker

<code>
php artisan serve --port=8099
</code>

## Update classes list to be included
<code>
php composer.phar dump-autoload
</code>


## Clear config cache if it was built while deploy process
<code>
php artisan config:clear
</code>  
<p>Важно при создании новый файлов конфигов в папке config/</p>

Есть два тестовых юзера 
email: test1@test.test
password: test

email: test2@test.test
password: test
