<?php
namespace App;

use App\ModelWithTouch;

class MyModel extends ModelWithTouch
{
  //...
  
    public function child(){
    	return $this->belongsTo('App\Child');
    }
}
