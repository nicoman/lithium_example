<?php
//Enable session support
use lithium\storage\Session;
//Enable auth support
use lithium\security\Auth;

//Configure sessions
Session::config(array(
    'default' => array('adapter' => 'Php')
));

//Configure auth
Auth::config(array(
    'member' => array(
        'adapter' => 'Form', //Specify we're usign form authentication method
        'model' => 'Users', //Specify what model is used for auth
        'fields' => array('username', 'password') //Specify wich fields are used
    )
));
?>
