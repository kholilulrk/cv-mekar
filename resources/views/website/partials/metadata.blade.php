<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="{{ $meta->keyword }}" />
<meta name="description" content="{{ $meta->short_description }}" />
<meta name="author" content="{{ $meta->author }}" />
<meta property="og:image" content="{{ ($meta->ogimage) ? asset($meta->ogimage):asset($meta->showLogo()) }}">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="icon" href="{{ asset($meta->showicon()) }}">
<title>{{ $menu }} | {{ $meta->title }}</title>
