<?php

class Router extends MyObject
{
    const routes = array(
    //  'route_name' => 'Controller:action',
        'home' => ':',
        'about' => ':aPropos',
        // USER
        'logout' => 'User:disconnect',
        'aboutUser' => 'User:aPropos',
        'inscription' => ':validateInscription',
        'connect' => ':Connect',
        'profile' => 'User:profile',
        'edit' => 'User:edit',
        'edition' => 'User:edition',
        // ADMIN
        'admin' => 'Admin:',
        'admin_users' => 'Admin:users',
        // QUIZ  (Liens en construction)
        'quiz' => 'Questionnaire:',
        'add_Quiz' => 'Questionnaire:add',
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
            return __BASE_URL.'?'.http_build_query($params);
        }
        //throw new Error('Route Not Found', 404); Ils nous manque coder une classe des erreurs.
    }
}

?>
