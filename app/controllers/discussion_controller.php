<?php

class DiscussionController extends BaseController {

    public static function index() {
        $discussions = Discussion::all();
        View::make('discussion/index.html', array('discussions' => $discussions));
    }

    public static function show($id) {
        $discussion = Discussion::find($id);
        $comments = $discussion->comments();
        Kint::dump($comments);
        View::make('discussion/show.html', array('discussion' => $discussion, 'comments' => $comments));
    }

}
