<?php 
  use Hashids\Hashids;
  $hashids = new Hashids('', 2, '0123456789ABCDEF');
  
  /* Translation */
  $TR = "frontend.$frontendNumber.navbar";
?>

<nav id="navbar-1" class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/" onclick="{{ Request::path() == '/' ? 'return false;' : '' }}" title="{{ trans("$TR.T13") }}">
        <img alt="Brand" src="./assets/icons/logo-icon.png" width="24px">
        <b>{{ $global_setting->site_name }}</b>
      </a>
    </div>

    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/products">{{ trans("$TR.T1") }}</a></li>
        @include("front.$frontendNumber.add-ons.nested-categories-navbar-section")
        <li><a href="/documentations">{{ trans("$TR.T2") }}</a></li>
        <li><a href="/contact-us">{{ trans("$TR.T3") }}</a></li>
        <li><a href="/about-us">{{ trans("$TR.T4") }}</a></li>
      </ul>

      <div class="navbar-right">
        <ul class="nav navbar-nav">
          @if(!Auth::check())
            <li class="btn-style">
              <a href="/register">{{ trans("$TR.T5") }}</a>
            </li>
            <li class="btn-style"><a href="/login">
              <span class="glyphicon glyphicon-user"></span> 
              {{ trans("$TR.T6") }}
            </a></li>
          @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }} 
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                @if($personType == 'user')
                  <li><a href="/profile">{{ trans("$TR.T7") }}</a></li>
                @else
                  <li><a href="/admin">{{ trans("$TR.T8") }}</a></li>
                @endif
                <li><a href="/my-cart">{{ trans("$TR.T9") }} <span class="cart-value">({{ $cart_count }})</span></a></li>
                <li><a href="/logout">{{ trans("$TR.T10") }}</a></li>
              </ul>
            </li>
          @endif
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              {{ trans("$TR.T11") }} ({{ config('app.locales')[config('app.locale')] }})
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              @foreach(config('app.locales') as $key => $value)
                <li><a href="/locale/{{$key}}">{{$value}}</a></li>
              @endforeach
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>