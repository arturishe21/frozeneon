
<h2>Описание</h2>

<p>Задание сделано на Laravel версия 9, так как я не сильно силен в CodeIgniter, на изучение пошло бы много времени, да и не нравится он мне:)</p>
<p>Немного

<h3>Установка<h3>

<p>Склонировать с гита, создать файл .env с файла .env.example, развернуть бд с sql файл в корне сайта, заменить доступы к бд, запустить команды composer update, npm i, npm run dev</p>  

<h3>Доступы<h3>

<p>Login : admin@admin.pl</p>
<p>Password : 123456</p>

<h3>Системные требования<h3>

<p>Php8, mysql 5.7+</p>

<h3>Что сделано</h3>

<p>БД : модификация бд под стандарты ларавеля(поменял названия полей и таблиц), простановка внешних ключей и индексов<br>
   так и не понял для чего таблица boosterpack_inf, как пустая была так и осталась
    </p>
<p>Front: Полностью переписал фронт с использованием VueJs2 и Vuex, базовую верстку не менял. Сделал отдельно бек и js отдельно, поделил на компоненты все приложение, сделал более читабельно, а то читать код когда все в одном файле еще и в перемешку с php кодом это очень сложно </p>
<p>Back: Транзакции использовал для работы с балансом, остальное все стандартное, по best practices ларавеля. 

<h3>Sql запросы<h3>

<p>1. select sum(amount) as sum, object_id, HOUR(created_at) AS hours, action from analytics where
       (action = 'buy_boosterpack' or action = 'add_likes')
       and created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY)
         group by HOUR(created_at) , object_id, action </p>
<p>2. select likes_balance, wallet_balance, wallet_total_withdrawn, sum(analytics.amount) from users 
    left join analytics on users.id = analytics.user_id  
    where users.id = 1 and action = 'add_likes' group by analytics.user_id</>