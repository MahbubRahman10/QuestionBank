<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="post" action="/*/admin/question/bcs/addquestion" enctype="multipart/form-data">
		{{ csrf_field()  }}
		<input type="file" name="file">

		<button type="submit" >OK</button>

	</form>

</body>
</html>