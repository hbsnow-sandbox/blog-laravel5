<?php namespace App\Eloquent\Blog;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model {

	protected $table = 'icons';
	protected $fillable = ['name', 'url'];
    protected $hidden = ['id', 'created_at', 'updated_at', 'pivot'];

	public function articles()
	{
		return $this->hasMany('App\Eloquent\Blog\Article');
	}

}
