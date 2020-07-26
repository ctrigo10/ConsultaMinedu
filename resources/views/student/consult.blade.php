@extends('template')

@section('title', 'Buscar Estudiante')

@section('content')
<div id="app" class="content"><!--La equita id debe ser app, como hemos visto en app.js-->
    <example-component></example-component><!--Añadimos nuestro componente vuejs-->
</div>
@endsection

@section('script')
<script>
     new Vue({
      el: '#app',
      vuetify: new Vuetify(),
    })

</script>
@endsection