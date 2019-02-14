@extends('layouts.main',['body_class' => 'landing'])
@section('content')
<div id="background-video" class="background-video">
		<img src="{{asset('img/placeholder.jpg')}}" alt="" class="placeholder-image">
</div>
@endsection
@section('scripts')
<script>

// $('.background-video').YTPlayer({
// 	fitToBackground: false,
// 	videoId: 'V2fpgpanZAw',
// 	pauseOnScroll: false,
// 	playerVars: {
// 		modestbranding: 0,
// 		autoplay: 1,
// 		controls: 0,
// 		showinfo: 0,
// 		branding: 0,
// 		rel: 0,
// 		autohide: 0
// 	}
// });
</script>
@endsection