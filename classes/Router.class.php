<?php

class Router extends MyObject
{
    const routes = array(
    //  'route_name' => 'Controller:action',
        'home' => ':',
        'about' => ':aPropos',
        'inscription' => ':inscription',
        'validateInscription' => ':validateInscription',
        'login' => ':login',
        'connect' => ':Connect',
        // USER
        'homeUser' => 'User:',
        'logout' => 'User:disconnect',
        'aboutUser' => 'User:aPropos',
        'profile' => 'User:profile',
        'edit' => 'User:edit',
        'edition' => 'User:edition',
        // ADMIN
        'admin' => 'Admin:',
        'admin_users' => 'Admin:users',
        // QUIZ  (Liens en construction)
        'quiz' => 'Questionnaire:',
        'add_Quiz' => 'Questionnaire:newQuest',
        'my_Quiz' => 'Questionnaire:show',
        'delete_Quiz' => 'Questionnaire:delete',
        'my_EQuiz' => 'Questionnaire:etuQuiz',
        'my_EResults' => 'Questionnaire:etuResultats'
        
    );
    public static function path($route, $params = array())
    {
        if (array_key_exists($route, self::routes)) {
            $var = explode(':', self::routes[$route]);
            $params['controller'] = $var[0];
            $params['action'] = $var[1];
            return __BASE_URL.'/index.php?'.http_build_query($params);
        }
        //throw new Error('Route Not Found', 404); Ils nous manque coder une classe des erreurs.
    }
}

?>
