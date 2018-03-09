<?php

class ReaderTopicController extends BaseController {
    public static function destroy($id) {
        self::check_logged_in();
        $reader_topic = new ReaderTopic(array('id' => $id));
        $result = $reader_topic->destroy($id);
        Redirect::to('/discussion', array('message' => 'Aiheen tilaus on poistettu onnistuneesti!'));
    }
    
    public static function store() {
        $params = $_POST;
        $attributes = array(
            'reader_id' => $params['reader_id'],
            'topic_id' => $params['topic_id']);
        $reader_topic = new ReaderTopic($attributes);
        
        $reader_topic->save();

        Redirect::to('/discussion', array('message' => 'Aihe on tilattu onnistuneesti'));
    }

}

