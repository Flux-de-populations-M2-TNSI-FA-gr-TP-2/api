<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

  <!-- Styles -->
  <style>
  html, body {
    background-color: #fff;
    color: #636b6f;
    font-family: 'Nunito', sans-serif;
    font-weight: 200;
    height: 100vh;
    margin: 0;
  }


  .full-height {
    height: 100vh;
  }

  .flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
  }

  .position-ref {
    position: relative;
  }

  .top-right {
    position: absolute;
    right: 10px;
    top: 18px;
  }

  .content {
    text-align: center;
  }

  .title {
    font-size: 84px;
  }

  .links > a {
    color: #636b6f;
    padding: 0 25px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
  }

  .m-b-md {
    margin-bottom: 30px;
  }





  :root {
    --round-color-left: #2e84b7;
    --round-color-right: #2e84b7;
    --round-size: 3rem;
    --round-border-color: none;
    --border-color: #c8dce6;
  }

  .switch {
    user-select: none;
    margin: 4rem auto;
    width: 24rem;
    position: relative;
  }
  .switch input {
    position: absolute;
    top: 0;
    z-index: 2;
    opacity: 0;
    cursor: pointer;
  }
  .switch input:checked {
    z-index: 1;
  }
  .switch input:checked + label {
    opacity: 1;
    cursor: default;
  }
  .switch input:not(:checked) + label:hover {
    opacity: 0.5;
  }
  .switch label {
    color: #fff;
    opacity: 0.33;
    transition: opacity 0.25s ease;
    cursor: pointer;
  }
  .switch .toggle-outside {
    height: 100%;
    border-radius: 2rem;
    padding: 0.25rem;
    overflow: hidden;
    transition: 0.25s ease all;
    border: 1px solid var(--border-color);
  }

  .switch .toggle-inside {
    border-radius: 5rem;
    background: #4a4a4a;
    position: absolute;
    transition: 0.25s ease all;
  }
  .switch--horizontal {
    width: calc(var(--round-size) + 3rem);
    height: var(--round-size);
    margin: 0 auto;
    font-size: 0;
    margin-bottom: 1rem;
  }
  .switch--horizontal input {
    height: var(--round-size);
    width: calc(var(--round-size) + 3rem);
    left: 6rem;
    margin: 0;
  }
  .switch--horizontal label {
    font-size: 1.5rem;
    line-height: var(--round-size);
    display: inline-block;
    width: 6rem;
    height: 100%;
    margin: 0;
    text-align: center;
  }

  .switch--horizontal label:last-of-type {
    right: 0;
  }
  .switch--horizontal .toggle-outside {
    background: #fff;
    position: absolute;
    width: calc(var(--round-size) + 3rem);
    left: 6rem;
  }
  .switch--horizontal .toggle-inside {
    height: var(--round-size);
    width: var(--round-size);
  }

  .switch--horizontal input:checked ~ .toggle-outside .toggle-inside {
    left: 0.25rem;
  }
  .switch--horizontal input ~ input:checked ~ .toggle-outside .toggle-inside {
    left: 3.25rem;
  }

  .switch--round-label input:checked + label {
    color: white;
    font-size: calc(var(--round-size) / 2);
  }

  .switch--round-label label {
    color: var(--round-color-left);
    position: absolute;
    z-index: 1;
    width: var(--round-size);
    height: var(--round-size);
    padding: 0.3rem;
    left: 0;
  }
  .switch--round-label label:last-of-type {
    margin-left: 3rem;
  }
  .switch--round-label input:checked ~ .toggle-outside .toggle-inside {
    background: var(--round-color-left);
    border: 1px solid var(--round-border-color);
  }
  .switch--round-label input ~ input:checked ~ .toggle-outside {
    background: #fff;
  }
  .switch--round-label input ~ input:checked ~ .toggle-outside .toggle-inside {
    background: var(--round-color-right);
  }
  .switch--round-label.switch--vertical {
    width: 3rem;
  }
  .switch--round-label.switch--horizontal {
    width: 6rem;
  }
  .switch--round-label.switch--horizontal input,
  .switch--round-label.switch--horizontal .toggle-outside {
    left: 0;
  }

  @media screen and (min-width:0\0) and (min-resolution: +72dpi) {
    .switch .toggle-outside {
      border: 1px solid #c8dce6;
    }
    .switch--horizontal {
      width: calc(3rem + 3rem);
      height: 3rem;
    }
    .switch--horizontal input {
      height: 3rem;
      width: calc(3rem + 3rem);
    }
    .switch--horizontal label {
      line-height: 3rem;
    }
    .switch--horizontal .toggle-outside {
      width: calc(3rem + 3rem);
    }
    .switch--horizontal .toggle-inside {
      height: 3rem;
      width: 3rem;
    }
    .switch--round-label input:checked + label {
      font-size: calc(3rem / 2);
    }
    .switch--round-label label {
      color: #2e84b7;
      width: 3rem;
      height: 3rem;
    }
    .switch--round-label input:checked ~ .toggle-outside .toggle-inside {
      background: #2e84b7;
      border: 1px solid #c8dce6;
    }
    .switch--round-label input ~ input:checked ~ .toggle-outside .toggle-inside {
      background: #2e84b7;
    }
  }

  .switch--expanding-inner input:checked + label:hover ~ .toggle-outside .toggle-inside {
    height: 2.5rem;
    width: 2.5rem;
  }
  .switch--expanding-inner.switch--horizontal input:hover ~ .toggle-outside .toggle-inside {
    width: 3.5rem;
  }
  .switch--expanding-inner.switch--horizontal input:hover ~ input:checked ~ .toggle-outside .toggle-inside {
    left: 2.25rem;
  }
  .switch--expanding-inner.switch--vertical input:hover ~ .toggle-outside .toggle-inside {
    height: 3.5rem;
  }
  .switch--expanding-inner.switch--vertical input:hover ~ input:checked ~ .toggle-outside .toggle-inside {
    top: 2.25rem;
  }
  .switch--vertical {
    width: 12rem;
    height: 6rem;
  }
  .switch--vertical input {
    height: 100%;
    width: var(--round-size);
    right: 0;
    margin: 0;
  }
  .switch--vertical label {
    font-size: 1.5rem;
    line-height: 3rem;
    display: block;
    width: 8rem;
    height: 50%;
    margin: 0;
    text-align: center;
  }
  .switch--vertical .toggle-outside {
    background: #fff;
    position: absolute;
    width: var(--round-size);
    height: 100%;
    right: 0;
    top: 0;
  }
  .switch--vertical .toggle-inside {
    height: var(--round-size);
    left: 0.25rem;
    top: 0.25rem;
    width: var(--round-size);
  }
  .switch--vertical input:checked ~ .toggle-outside .toggle-inside {
    top: 0.25rem;
  }
  .switch--vertical input ~ input:checked ~ .toggle-outside .toggle-inside {
    top: 3.25rem;
  }
  </style>
</head>
<body>
  <div class="flex-center position-ref full-height">
    @if (Route::has('login'))
      <div class="top-right links">
        @auth
          <a href="{{ url('/home') }}">Home</a>
        @else
          <a href="{{ route('login') }}">Login</a>

          @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
          @endif
        @endauth
      </div>
    @endif

    <div class="content">
      <div class="">

        <div class="switch switch--horizontal switch--round-label">
          <input id="euro" type="radio" name="currency" checked="checked"/>
          <label for="euro">€</label>
          <input id="radio-f" type="radio" name="currency"/>
          <label for="radio-f">Nb</label>
          <span class="toggle-outside">
            <span class="toggle-inside"></span>
          </span>
        </div>
      </div>
      {{-- <div class="title m-b-md">
      Laravel
    </div>

    <div class="links">
    <a href="https://laravel.com/docs">Docs</a>
    <a href="https://laracasts.com">Laracasts</a>
    <a href="https://laravel-news.com">News</a>
    <a href="https://blog.laravel.com">Blog</a>
    <a href="https://nova.laravel.com">Nova</a>
    <a href="https://forge.laravel.com">Forge</a>
    <a href="https://vapor.laravel.com">Vapor</a>
    <a href="https://github.com/laravel/laravel">GitHub</a>
  </div> --}}
</div>
</div>
</body>
</html>
