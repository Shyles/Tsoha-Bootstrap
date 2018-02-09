<?php

class ReaderController extends BaseController{
    public static function index() {
        $readers = Reader::all();
        View::make('index.html', array('readers' => $readers));
    }
    
    public static function show($id) {
        $reader = Reader::find($id);
        View::make('reader.html', array('reader' => $reader));
    }
}

