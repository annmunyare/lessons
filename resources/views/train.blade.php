@extends("layouts.master")
@section("content")

  <img id="cartoon" class="cartoon" width="100px" src="http://www.freepngimg.com/download/car/2-2-car-transparent.png">

  <script>
    cartoon.onclick = function() {
      var start = Date.now();

      var timer = setInterval(function() {
        var timePassed = Date.now() - start;

        cartoon.style.left = timePassed / 5 + 'px';

        if (timePassed > 5000) clearInterval(timer);

      },20 );
    }
  </script>


@endsection