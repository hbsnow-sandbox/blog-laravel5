<?php namespace App\Eloquent\Blog;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

	protected $table = 'articles';
	protected $fillable = ['title', 'slug', 'text', 'state', 'icon_id'];
	protected $hidden = ['id', 'state', 'icon_id', 'updated_at'];

	public function tags()
	{
		return $this->belongsToMany('App\Eloquent\Blog\Tag');
	}

	public function icon()
	{
		return $this->belongsTo('App\Eloquent\Blog\Icon');
	}

	public function scopeNewer($query)
	{
		return $query
			->where('state', 'public')
			->where('created_at', '>', $query->first()->created_at)
			->orderBy('created_at', 'asc');
	}

	public function scopeOlder($query)
	{
		return $query
			->where('state', 'public')
			->where('created_at', '<', $query->first()->created_at)
			->orderBy('created_at', 'desc');
	}

	public function scopeArchives($query, $year)
	{
		return $query
			->whereBetween('created_at', array($year . '-01-01', $year . '-12-31'))
			->orderBy('created_at', 'desc');
	}


}
