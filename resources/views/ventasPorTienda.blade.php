<!DOCTYPE html>
<html>
<body>

<h1>Tiendas</h1>
<p>.</p>

<u1>
	@foreach ($tiendas as $tienda)
	<li>{{ $tienda -> nombre}}</li>
	@endforeach
</u1>
</body>
</html> 