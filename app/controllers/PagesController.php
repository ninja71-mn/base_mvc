<?php


class PagesController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {


            $data = [
                'title' => 'Welcome',
            ];
            $this->view('pages/index', $data);

    }

}