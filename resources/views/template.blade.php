<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>
<body>
    <div id="app">
    <header>
            <img  style="float:letf; margin:15px 50px" width="35%" height="200%" src="{{asset('images/logo-minedu.png')}}">
            <img  style="float:right; margin:15px 50px" width="15%" height="100%"  src="{{asset('images/pacto-minedu.png')}}">
            <hr style="background-color: #644491; height: 5px;">
    </header>
    
    <div class="container">
        @yield('content')
    </div>  

    <footer>
        <div><span style="float:right">Ministerio de Educación © 2020</span>Ministerio de Educación, Deportes y Culturas. Avenida Arce Nro. 2147 - La Paz, Bolivia</div>
    </footer>
</div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>

    <script>
        new Vue({
          el: '#app',
          vuetify: new Vuetify(),
        })
      </script>
</body>
<style>
    footer {
  background-color: #644491;
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 40px;
  color: white;
  padding: 40px;
  font-family:'Helvetica','Verdana','Monaco',sans-serif;
  font-size:13px;
}
</style>
</html>
