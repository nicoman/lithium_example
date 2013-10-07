<?php

//Because this is a controller, use the app\controllers namespace
namespace app\controllers;

//Tell the controller about any models we may need
use app\models\MyPosts;

//Ensure our controller inherits the \lithium\action\Controller class
class MyPostsController extends \lithium\action\Controller {

    //Define a default 'index' for when a user accesses the /posts/ URL
    public function index() {
        //Fetch all blog posts from the my_post table
        $myPosts = MyPosts::all();
        //Send the $my_posts object to our view
        return compact('myPosts');
    }
    
    public function add() {
        //Check if user is authenticated, if not, redirect to login
        if (!Auth::check('member', $this->request)) {
            //User is not authenticated, redirect to login
            return $this->redirect('/users/login/');
        }
        //Assume save status is false
        $saved = false;
        //If we have any posted or querystring data...
        if($this->request->data) {
            //Use the MyPost model to create a new dataset
            $my_post = MyPosts::create($this->request->data);
            //Attempt to save the data, and update the $saved variable
            //with the outcome of the save attempt (bool)
            $saved = $my_post->save();
        }
        return compact('saved', 'my_post');
    }

    public function view() {
        //Dont run the query if no post id is provided
        if($this->request->args[0]) {
            //Get single record from the datbase where post id marches the URL
            $myPost = MyPosts::first($this->request->args[0]);
            //Send the retrieved post data to the view
            return compact('myPost');
        }
        //since no post id was specified, redirect to the index page
        $this->redirect(array('MyPosts::index'));
    }
    
    public function delete() {
        //Dont run the query if no post id is provided
        if($this->request->args[0]) {
            //Find matching posts, then delete them
            $myPost = MyPosts::find($this->request->args[0])->delete();
            //Send the retrieved post data to the view
            $this->redirect(array('MyPosts::index'));
        }
    }

    public function edit() {
    
        //Attempt to fech the specified post
        $myPost = MyPosts::find($this->request->args[0]);

        //if the post couldn't be fetched, redirect to index
        if (!$myPost) {
            $this->redirect('MyPosts::index');
        }

        //If we have post data, attempt to save
        if (($this->request->data) && $myPost->save($this->request->data)) {
            //If save was successfull, redirect to the new post
            $this->redirect( array(
                'MyPosts::view',
                'args' => array($myPost->id)
            ));
        }
        
        //If we haven't been redirected, then send the post info to the view
        return compact('myPost');
    }
}

?>
