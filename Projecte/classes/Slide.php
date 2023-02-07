<?php
namespace Slide;
abstract class Slide {
    public $id;
    public function __construct($id){
        $this->id = $id;
       }
}