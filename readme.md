# Старт для Yii2 #

## стартовые таблицы ##

user - Пользователь

article - Статья

category - Категория

## Модели ##

User - Пользователь

LoginForm - Модель авторизации пользователя

Для вода данных пользователя можно в контроллер написать:

	public function actionStart()
    	{
	        $user = new \app\models\User();
	        $user->username = 'admin';
	        $user->password = \Yii::$app->getSecurity()->generatePasswordHash('admin');
	        $user->first_name = 'Александр';
	        $user->last_name = 'WebGoal';
	        $user->mail = 'alex@webgoal.ru';
	        $user->save();
	        return 'ОК';
    	}

и запустить http://ваш_домен/site/start

где:

- $user->username Ваш логин,
- $user->password Пароль,
- $user->first_name Имя,
- $user->last_name Фамилия,
- $user->mail Емаил.