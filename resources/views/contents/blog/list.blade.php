@if ($articles->isEmpty())
<p>該当の記事が見つかりませんでした。</p>
@else
<ol id="articles-list" class="contents-list">
	@foreach($articles as $article)
	<li class="contents-item">
		<a ui-sref="blog-single({slug: '{{ $article->slug }}'})" class="contents-item-header layout horizontal center">
			<div class="flex-none contents-item-icon">
				<img src="{{ $article->icon->url }}">
			</div>

			<div class="flex">
				<div class="contents-item-meta">
					<time>{{ date_format(date_create($article->created_at), 'Y-m-d') }}</time>
				</div>

				<div class="contents-item-title">
					<h2>{{ $article->title }}</h2>
				</div>
			</div>
		</a>
	</li>
	@endforeach
</ol>
@endif
