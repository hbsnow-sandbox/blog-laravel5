@extends('contents.master')

@section('content')
<ol id="work-list" class="contents-list">
	<li class="contents-item">
		<a href="https://github.com/hbsnow/flash-game-cropper" class="contents-item-header layout horizontal center">
			<div class="contents-item-icon flex-none">
				<img src="{{ asset('assets/images/work/icons/flash-game-cropper.png') }}">
			</div>

			<div class="flex">
				<div class="contents-item-meta">
					<span>Google Chrome Extension</span>
				</div>

				<div class="contents-item-title">
					<h2>Flash Game Cropper</h2>
				</div>
			</div>
		</a>

		<div class="contents-item-description">
			<p>SQUARE ENIXとDMMで配信されているいくつかのFLASHゲームをリサイズ可能なウィンドウ化します。</p>
		</div>
	</li>
</ol>
@stop
