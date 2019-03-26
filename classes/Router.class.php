<?php

class Router extends MyObject
{
    const routes = array(
    //  'route_name' => 'Controller:action',
        'home' => ':',
        // USER
        'logout' => 'User:logout',
        'login' => 'User:login',
        'connect' => ':Connect',
        'profile' => 'User:profile',
        'user_edit' => 'User:edit',
        // ADMIN
        'admin' => 'Admin:',
        'admin_users' => 'Admin:users',
        // QUIZ
        'quiz' => 'Quiz:',
        'add_Quiz' => 'Quiz:add',
        'delete_Quiz' => 'Quiz:delete',
        
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
