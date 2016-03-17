<?php

namespace DevLucid;

lucid::controller('navigation')->render('view.login');

$row = html::row();
list($left, $right) = $row->grid([[12,12,7,7,8],[12,12,5,5,4]]);

$left->add( lucid::view('form-registration'));
$right->add(lucid::view('form-authentication'));

lucid::$response->replace('#full-width',$row);
