<?php

class DiscussionController extends BaseController {

    public static function index() {
        $discussions = discussion::all();
        View::make('discussion/index.html', array('discussions' => $discussions));
    }

    public static function show($id) {
        $discussion = discussion::find($id);
        View::make('discussion/discussion.html', array('discussion' => $discussion));
    }

}
