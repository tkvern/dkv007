<!DOCTYPE HTML>
<html lang="en">
<head>
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<meta charset="utf-8">
<title>{{ !empty($title) ? $title . '-' : '' }}{{ config('app.name', '量子视觉云') }}</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/vendor/css/blueimp-gallery.css">
<link rel="stylesheet" href="/vendor/css/blueimp-gallery-indicator.css">
<link rel="stylesheet" href="/vendor/css/demo.css">
</head>
<body>
<h2>{{ $title }}</h2>
<!-- The container for the list of example images -->
<div id="links" class="links">
    @foreach($images as $image)
        <a href="http://visiondk.oss-cn-shenzhen.aliyuncs.com/{{ $image->link }}" title="{{ $image->title }}" data-gallery="">
            <img src="http://visiondk.oss-cn-shenzhen.aliyuncs.com/{{ $image->link }}?x-oss-process=style/360x270">
        </a>
    @endforeach
</div>
<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<div class="back-to-top back-to-top-on">
    <a href="{{ $activity->link }}">查看全景</a>
</div>
<script src="/vendor/js/blueimp-helper.js"></script>
<script src="/vendor/js/blueimp-gallery.js"></script>
<script src="/vendor/js/blueimp-gallery-fullscreen.js"></script>
<script src="/vendor/js/blueimp-gallery-indicator.js"></script>
<script src="/vendor/js/jquery.js"></script>
<script src="/vendor/js/jquery.blueimp-gallery.js"></script>
</body>
</html>
