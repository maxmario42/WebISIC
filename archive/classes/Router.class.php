<?php

class Router extends MyObject
{ //Construire automatiquement la route vers les pages
    const routes = array(
    //  'route_name' => 'Controller:action',
        'home' => ':',
        // USER
        'inscription' => 'User:inscription',
        'validate_inscription' => 'User:validateInscription',
        'logout' => 'User:logout',
        'login' => 'User:login',
        'profile' => 'User:profile',
        'user_edit' => 'User:edit',
        // TRAJETS
        'search_trip' => 'Trajet:',
        'trip' => 'Trajet:unique',
        'add_trip' => 'Trajet:add',
        'my_trips' => 'Trajet:myTrips',
        'trip_my_bookings' => 'Trajet:myBookings',
        'trip_signup' => 'Trajet:signup',
        'trip_signout' => 'Trajet:signout',
        'trip_remove_participant' => 'Trajet:removeParticipant',
        'trip_remove_moderator' => 'Trajet:removeModerator',
        'trip_lock' => 'Trajet:lock',
        'trip_unlock' => 'Trajet:unlock',
        // VEHICULES
        'my_vehicles' => 'Vehicule:',
        'add_vehicle' => 'Vehicule:add',
        'delete_vehicle' => 'Vehicule:delete',
        // ADMIN
        'admin' => 'Admin:',
        'admin_users' => 'Admin:users',
        'admin_trips' => 'Admin:trips',
        'admin_vehicles' => 'Admin:vehicles',
        'admin_ip' => 'Admin:ip',
        // ADMIN ACTIONS
        'admin_user_ban' => 'Admin:banUser',
        'admin_user_unban' => 'Admin:unbanUser',
        'admin_user_promote' => 'Admin:promoteUser',
        'admin_ip_ban' => 'Admin:banIp',
        'admin_ip_unban' => 'Admin:unbanIp',
        // LIEUX
        'lieu' => 'Lieu:',
        'add_lieu' => 'Lieu:add',
        'delete_lieu' => 'Lieu:delete',
        // GROUPES
        'groups' => 'Groupe:',
        'group_add' => 'Groupe:add',
        'group_delete' => 'Groupe:delete',
        'group_join' => 'Groupe:join',
        'group_leave' => 'Groupe:leave',
    );
    public static function path($route, $params = array(), $options = array())
    {
        if (array_key_exists($route, self::routes)) {
            $var = explode(':', self::routes[$route]);
            $params['controller'] = $var[0];
            $params['action'] = $var[1];
            return __BASE_URL.'?'.http_build_query($params);
        }
        throw new Error('Route Not Found', 404);
    }
}
