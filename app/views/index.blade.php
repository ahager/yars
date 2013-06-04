<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>turnos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <style type="text/css">
      @import url(http://fonts.googleapis.com/css?family=Montserrat+Alternates:400,700|Carter+One);
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .hero-unit h1
      {
        font-family: 'Carter One', cursive;
        color: #fff!important;
        text-shadow: 2px 2px #555;
      }
      .hero-unit h2
      {
        font-family: 'Montserrat Alternates', sans-serif;
        color: #eee!important;
        text-shadow: 2px 2px #666;
        font-weight: bold;
      }
      .hero-unit p
      {
        font-family: 'Montserrat Alternates', sans-serif;
        color: #ddd;
        font-weight: bold;
      }
      .hero-unit label
      {
        font-size: 1.4em;
        color: #fff;
        font-weight: bold;
      }
      .hero-unit input, .btn
      {
        margin: 12px 0px;
        font-size: 1.1em;
        color: #fff;
        font-weight: bold;
      }
    </style>
    

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="/assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="/assets/ico/favicon.png">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">turnos por internet. hecho fácil.</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">{{ trans('site.nav.home') }}</a></li>
              <li><a href="#about">{{ trans('site.nav.about') }}</a></li>
              <li><a href="#contact">{{ trans('site.nav.contact') }}</a></li>
            </ul>
            {{ Former::open('user/login')->class('navbar-form pull-right') }}
            {{ Former::hidden('_token', csrf_token()) }}
              <input name="email" class="span2" type="text" placeholder="{{ trans('site.login.email') }}">
              <input name="password" class="span2" type="password" placeholder="{{ trans('site.login.password') }}">
              <button type="submit" class="btn">{{ trans('site.login.signin') }}</button>
            {{ Former::close() }}
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      @include('notifications')

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit" style="background: url('{{ URL::to('/') }}/assets/img/bg1.png') #4261BC repeat">
        <h1>turnos por internet.</h1>
        <h2>hecho fácil.</h2>
        <p>ahora dar y pedir turnos por Internet es tener un turnazo</p>
        <p>{{ Button::success_large_link('user/create', trans('button.start').'!') }}</p>
      </div>

      <!-- Example row of columns -->
      <div class="row">
       <div class="span4">
          <h2>¿ Qué es ?</h2>
          <p>YARS es una agenda por Internet para que puedas <strong>pedir y dar turnos turnos</strong> fácilmente desde tu <em>PC</em> o <em>smartphone</em>.  Ahora podés pedir o dar turnos por Internet muy fácilmente. Registrarte. Toma sólo 1 minuto.</p>
          <p>{{ Former::text('search', trans('button.search'))->class('typeahead span3')->placeholder(trans('button.search'))->inlineHelper('dinos el nombre de un comercio') }}</p>
          <p>{{ Button::primary_large_link('search', trans('button.search')) }}</p>
        </div>  
      <ul class="thumbnails">
      <li class="span4">
        <div class="thumbnail">
          {{ HTML::image("/assets/img/landing-clients.png") }}
          <div class="caption">
            <h3>ellos piden turnos</h3>
            <p><strong>475</strong> usuarios ya piden turnos por Internet</p>
            <p align="center"><a href="#" class="btn btn-primary btn-block">Quiero pedir turnos</a></p>
          </div>
        </div>
      </li>
        <li class="span4">
        <div class="thumbnail">
          {{ HTML::image("/assets/img/landing-providers.png") }}
          <div class="caption">
            <h3>ellos dan turnos</h3>
            <p><strong>56</strong> prestadores ya dan turnos por Internet</p>
            <p align="center"><a href="#" class="btn btn-primary btn-block">Quiero dar turnos</a></p>
          </div>
        </div>
      </li>
      </ul>
      </div>

<hr>

<div class="container">
  @include('site/business/list')
</div>
      <footer>
        <p>&copy; <a href="http://alariva.com">alariva.com</a> 2013</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {{ basset_stylesheets('public-css') }}
    {{ basset_javascripts('public-js') }}

<script>
$(document).ready(function(){
  // use this hash to cache search results
  window.query_cache = {};
  $('.typeahead').typeahead({
      source:function(query,process){
          // if in cache use cached value, if don't wanto use cache remove this if statement
          if(query_cache[query]){
              process(query_cache[query]);
              return;
          }
          if( typeof searching != "undefined") {
              clearTimeout(searching);
              process([]);
          }
          searching = setTimeout(function() {
              return $.getJSON(
                  '{{ URL::to('/') }}'+"/api/businesses",
                  { q:query },
                  function(data){
                      // save result to cache, remove next line if you don't want to use cache
                      var newData = [];
                      $.each(data, function(){
                          newData.push(this.name);
                      });
                      query_cache[query] = newData;
                      
                      return process(newData);
                  }
              );
          }, 300); // 300 ms
      }
  });
});
</script>

  </body>
</html>
