<?php

class DiscussionController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $topics = Topic::all_for_reader(self::get_user_logged_in()->id);
        $remaining_topics = Topic::all_remaining_for_reader(self::get_user_logged_in()->id);
        View::make('discussion/index.html', array('topics' => $topics, 'remaining_topics' => $remaining_topics));
    }

    public static function show($id) {
        self::check_logged_in();
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
        $discussion_attributes = array(
            'reader_id' => $params['reader_id'],
            'topic' => $params['topic'],
            'topic_id' => $params['topic_id']);
        $discussion = new Discussion($discussion_attributes);
        $discussion->save();
        
        $comment_attributes = array(
            'reader_id' => $params['reader_id'],
            'discussion_id' => $discussion->id,
            'comment' => $params['comment']
        );
        $comment = new Comment($comment_attributes);
        $comment->save();

        Redirect::to('/discussion/' . $discussion->id, array('message' => 'Keskustelu ' . $discussion->topic . ' on lisätty kantaan'));
    }

}
