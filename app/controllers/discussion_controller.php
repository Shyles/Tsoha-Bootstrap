<?php

class DiscussionController extends BaseController {

    public static function index() {
        $topics = Topic::all();
        Kint::dump($topics);
        View::make('discussion/index.html', array('topics' => $topics));
    }

    public static function show($id) {
        $discussion = Discussion::find($id);
        $comments = $discussion->comments();
        View::make('discussion/show.html', array('discussion' => $discussion, 'comments' => $comments));
    }
    
    public static function create() {
        self::check_logged_in();
        $topics = Topic::all();
        View::make('discussion/new.html', array('topics' => $topics));
    }
    
    public static function store() {
        $params = $_POST;
        $attributes = array(
            'reader_id' => $params['reader_id'],
            'topic' => $params['topic'],
            'topic_id' => $params['topic_id']);
        
        $discussion = new Discussion($attributes);
        $discussion->save();
        Redirect::to('/discussion/' . $discussion->id, array('message' => 'Keskustelu ' . $discussion->topic . ' on lisätty kantaan'));
    }

}
