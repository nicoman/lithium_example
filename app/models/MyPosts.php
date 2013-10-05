<?php

//Use the app\models namespace at the beginning of all model files
namespace app\models;

//All new models must extend the \lithium\data\Model class
class MyPosts extends \lithium\data\Model {

    public $validates = array(
        'title' => array(
            array('notEmpty', 'message'=>'You must include a title.')
        )
    );
}
?>
