<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  {{-- <link rel="stylesheet" type="text/css" href="css/base.css"> --}}
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
  {{-- <script src="https://d3js.org/d3.v5.min.js"></script> --}}
</head>

<body>
<header>
</header>
<nav class="ui large top menu transition visible inverted grey">
  <div class="container">
      <h2 class="header item">a</h2>
    {{-- <div class="right item">
      <a class="ui inverted button orange">login</a>
    </div> --}}
  </div>
</nav>

<div class="ui container">
  @yield('content')
</div>
<footer>
</footer>
</body>
</html>