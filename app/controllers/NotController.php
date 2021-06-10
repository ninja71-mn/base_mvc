<?php


class NotController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $this->View('404');
    }
}