<?php namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Work extends Model {

	protected $table = 'works';
	protected $fillable = ['slug', 'type', 'name', 'image', 'message', 'text', 'state'];

}
