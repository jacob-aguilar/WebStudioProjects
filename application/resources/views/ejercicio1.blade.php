<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Divisor</title>
</head>
<body>
<h1>Ingrese dos numero</h1>
        <form  method="post"> 
			@csrf
			<div>
			Numero 1:
			<input type="number" name="n1">
			</div>
			<div>
			Numero 2:
			<input type="number" name="n2" >
			</div>
			<input type="submit" value="Calcular"> 
		</form>
    
</body>
</html>