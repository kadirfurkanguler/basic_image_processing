<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Image Process Form</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		.form-group {
			margin-bottom: 1.5rem;
		}

		form {
			width: 500px;
			margin: 0 auto;
			text-align: center;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 10px;
		}

		input[type="submit"] {
			padding: 10px;
			background-color: #4CAF50;
			color: white;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			margin-top: 10px;
		}

		label,
		input {
			display: block;
			margin: 10px 0;
		}
	</style>
</head>

<body>
	<form action="process.php" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="image">Resim yükle</label>
			<input name="image" required accept="image/*" type="file" class="form-control-file" id="image">
		</div>
		<div class="form-group">
			<label>Sadece birini seçin:</label>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="process_type" id="exampleRadios1" value="resize">
				<label class="form-check-label" for="exampleRadios1">
					Genişlik ve yükseklik ayarla
				</label>
			</div>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="process_type" id="exampleRadios2" value="rotate">
				<label class="form-check-label" for="exampleRadios2">
					Döndürme işlemi için ayarla
				</label>
			</div>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="process_type" id="exampleRadios3" value="crop">
				<label class="form-check-label" for="exampleRadios3">
					Kırpma işlemi için ayarla
				</label>
			</div>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="process_type" id="exampleRadios3" value="flip">
				<label class="form-check-label" for="exampleRadios3">
					Çevirme işlemi için ayarla
				</label>
			</div>
		</div>
		<div class="form-group">
			<label for="widthInput">Genişlik</label>
			<input name="widht" value="100" type="number" class="form-control" id="widthInput">
		</div>
		<div class="form-group">
			<label for="heightInput">Yükseklik</label>
			<input name="height" value="100" type="number" class="form-control" id="heightInput">
		</div>
		<div class="form-group">
			<label for="rotateSelect">Döndürme işlemi</label>
			<select name="rotate" class="form-control" id="rotateSelect">
				<option value="0">0</option>
				<option value="90">90</option>
				<option value="180">180</option>
				<option value="270">270</option>
			</select>
		</div>
		<div class="form-group">
			<label for="flipSelect">Çevirme işlemi</label>
			<select name="flip" class="form-control" id="flipSelect">
				<option value="0">Dikey</option>
				<option value="1">Yatay</option>
				<option value="-1">Hem Dikey Hem Yatay</option>
			</select>
		</div>
		<div class="form-group">
			<label for="cropInput">Kırpma işlemi için koordinatları girin(X,Y,WIDTH,HEIGHT)</label>
			<input name="crop" type="text" class="form-control" id="cropInput">
		</div>
		<input type="submit" value="Process">
	</form>

</body>


<!-- JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eWtkFJ4C4gZuyQkp7Cq8+q76nJz9A9pgssn7+JSk98NNQ5G5my5zZ

</html>