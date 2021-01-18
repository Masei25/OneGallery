<?php

function hello()
{
    return 'Hello world';
}

function is_email($data)
{
    return filter_var($data, FILTER_VALIDATE_EMAIL);
}