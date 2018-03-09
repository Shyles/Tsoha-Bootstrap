<?php

class TopicController extends BaseController {
    public static function index() {
        self::check_logged_in();
        $topics = Topic::all();
        View::make('topic/index.html', array('topics' => $topics));
    }
    
    public static function create() {
        View::make('topic/new.html');
    }
     
    public static function show($id) {
        self::check_logged_in();
        $topic = Topic::find($id);
        View::make('topic/show.html', array('topic' => $topic));
    }
    
    public static function show_update($id) {
        self::check_logged_in();
        $topic = Topic::find($id);
        View::make('topic/update.html', array('topic' => $topic));
    }
    
    public static function update($id) {
        self::check_logged_in();
        $original_topic = Topic::find($id);
        Kint::dump($_POST);
        $topic = new Topic(array(
            'id' => $id,
            'topic' => isset($_POST['topic']) ? $_POST['topic'] : $original_topic['topic']
        ));
        $topic->update();
        Redirect::to('/topic/' . $topic->id, array('message' => 'Aihe on päivitetty onnistuneesti'));
    }
    
    public static function store() {
        self::check_logged_in();
        $topic = new Topic(array('topic' => $_POST['topic']));
        $validator_errors = $topic->errors();
        if (count($validator_errors) == 0) {
            $topic->save();
            Redirect::to('/discussion', array('message' => 'Aihe ' . $topic->topic . ' on luotu onnistuneesti!'));
        } else {
            View::make('reader/new.html', array('validator_errors' => $validator_errors, 'attributes' => $attributes));
        }
    }
    
    

}
