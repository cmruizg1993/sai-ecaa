<?php

use Kreait\Firebase\Factory;


function setData($path, $data){
    $ref = getReference($path);
    $ref->set($data);
}
function getFactory(){
    return (new Factory)
        ->withServiceAccount(APPPATH  .'firebase_credentials.json')
        ->withDatabaseUri('https://sai-ecaa-default-rtdb.firebaseio.com/');
}
function getDatabase(){
    $factory = getFactory();
    return $factory->createDatabase();
}
function getReference($path){
    $db = getDatabase();
    return $db->getReference($path);
}