<?php
$servername = "mysql.hostinger.com";
$database = "u266072517_name"; 
$username = "u266072517_user";
$password = "buystuffpwd";
$sql = "mysql:host=$servername;dbname=$database;";
$dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
// Создаём новое соединение с базой данных MySQL с использованием PDO, $my_Db_Connection - это объект
try { 
  $my_Db_Connection = new PDO($sql, $username, $password, $dsn_Options);
  echo "Connected successfully";
} catch (PDOException $error) {
  echo 'Connection error: ' . $error->getMessage();
}
// Задаём переменные для человека, которого мы хотим добавить в базу данных
$first_Name = "Test";
$last_Name = "Testing";
// $email = "Testing@testing.com"; (ATTENTION!!! в случае ошибки расскоментировать)
// Здесь мы создаём переменную, которая вызывает метод prepare() объекта базы данных
// SQL-запрос, который вы хотите запустить, вводится как параметр, а плейсхолдеры записываются следующим образом - :placeholder_name
$my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO Students (name, lastname, email) VALUES (:first_name, :last_name, :email)");
// Теперь мы сообщаем скрипту, на какую переменную фактически ссылается каждый плейсхолдер, используя метод bindParam()
// Первый параметр - это плейсхолдер в приведённом выше выражении, второй параметр - это переменная, на которую он должен ссылаться
$my_Insert_Statement->bindParam(:first_name, $first_Name);
$my_Insert_Statement->bindParam(:last_name, $last_Name);
$my_Insert_Statement->bindParam(:email, $email);
// Выполните запрос, используя данные, которые мы только-что определили
// Метод execute() возвращает TRUE, если запрос был выполнен успешно и FALSE в противном случае, позволяя вам создавать собственные сообщения
if ($my_Insert_Statement->execute()) {
  echo "New record created successfully";
} else {
  echo "Unable to create record";
}
// На этом этапе вы можете изменить данные переменных и выполнить запрос снова, чтобы добавить больше данных в БД.
$first_Name = "John";
$last_Name = "Smith";
// $email = "example@email.com"; (ТОЖЕ САМОЕ ЧТО И В ПЕРВОМ СЛУЧАЕ)
$my_Insert_Statement->execute();
// Выполните снова с другими переменными 
if ($my_Insert_Statement->execute()) {
  echo "New record created successfully";
} else {
  echo "Unable to create record";
}