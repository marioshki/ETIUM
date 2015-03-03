<head>


</head>


<body>


</br>



	<form action="/api.php" method="POST" enctype="multipart/form-data">
		
		<p>Select an image and params to config the edit</p>
		<input type="file" name="image">
		</br>
		</br>
		</br>
		<p>Select kind of action</p>
		<select name="action">
			<option value="resize">Resize</option>
		</select>
		</br>
		</br>

		<input type="number" name="options['height']" placeholder="height"></input>
		<input type="number" name="options['width']" placeholder="width"></input>
		<input type="text" name="options['blur']" placeholder="blur"></input>
		<input type="text" name="options['bestfit']" placeholder="bestfit"></input>



		<button>Edit!</button>
	</form>


</body>