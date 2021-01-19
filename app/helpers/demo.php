<?php

use Cube\Http\Session;

function hello()
{
    return 'Hello world';
}

function is_email($data)
{
    return filter_var($data, FILTER_VALIDATE_EMAIL);
}

function notification()
{
    $data = Session::getAndRemove('msgs');
    return $data ? : '';
}

function get_notification($val)
{
    $data = Session::get('msg')[$val][0]?? "";
    return $data;
}

function remove_notification()
{
    $data = Session::remove('msg');
    return '';
}