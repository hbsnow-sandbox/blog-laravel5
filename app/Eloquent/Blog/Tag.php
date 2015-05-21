<?php namespace App\Eloquent\Blog;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	protected $table = 'tags';
	protected $fillable = ['name', 'slug'];
    protected $hidden = ['id', 'created_at', 'updated_at', 'pivot'];

	public function articles()
	{
		return $this->belongsToMany('App\Eloquent\Blog\Article');
	}

}
