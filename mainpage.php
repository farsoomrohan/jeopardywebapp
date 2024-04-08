<!DOCTYPE HTML>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Jeopardy GSU</title>
  <link href="styles.css" rel="stylesheet">
</head>

<body>

	<h1 id="title"> JEOPARDY </h1>
	
	<br>
	<div class="signlog">
	    <div>
        
			<form action="login.php" method="post">
				<fieldset>
					<legend>Returning User:</legend>
					<label> Name: </label>
					<input name="name" type="text" class="Input" value="">
					<p>
						<input type="submit" value="Login" class="Button">
					</p>
				</fieldset>
            </form>

        </div>
		<br>
		<div>
        
			<form action="signup.php" method="post">
				<fieldset>
					<legend>New User:</legend>
					<label> Name: </label>
					<input name="name" type="text" class="Input">
					<p>
						<input type="submit" value="Signup" class="Button">
					</p>
				</fieldset>
            </form>

        </div>
     </div>
</body>
</html>