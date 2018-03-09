<?php

class CommentController extends BaseController {
    public static function create() {
        $comment = new Comment( array(
            'discussion_id' => $_POST['discussion_id'],
            'reader_id' => $_POST['reader_id'],
            'comment' => $_POST['comment']      
        ));
        $comment->save();
        Redirect::to('/discussion/' . $comment->discussion_id, array());
    }
}

