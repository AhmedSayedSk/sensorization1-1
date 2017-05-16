<?php

/* Translation */
$TR = "admin_panel.AN";

?>

<nav id="navbar-1" class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">
        <img alt="Brand" src="./assets/icons/logo-icon.png" width="24px" title='{{ trans("$TR.T23") }}'>
        <b>{{ $global_setting->site_name }}</b>
      </a>
    </div>

    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/products">{{ trans("$TR.T4") }}</a></li>
        <li><a href="/documentations">{{ trans("$TR.T2") }}</a></li>
      </ul>
      <div class="navbar-right">
        <ul class="nav navbar-nav">
          <li><a onclick="return false;">{{ trans("$TR.T1", ["name"=>Auth::user()->name]) }}</a></li>
          <li><a href="/logout">{{ trans("$TR.T22") }}</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              {{ trans("$TR.T24") }} ({{ config('app.locales')[config('app.locale')] }})
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