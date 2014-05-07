<?php

use Phalcon\Tag;

class IndexController extends ControllerBase {

    public function initialize() {
        Tag::setTitle('Index');
        parent::initialize();
    }

    public function indexAction() {
    }

    public function notFoundAction() {
    }
}