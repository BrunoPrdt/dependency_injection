<?php

namespace App;

class Logger{

    public function log(string $message){
        dump("LOGGER : $message");
    }

}