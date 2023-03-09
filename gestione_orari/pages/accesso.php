<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../style/stileAccesso.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans:wght@500&display=swap" rel="stylesheet">  
</head>
<body>
    <header>
        <h1><b>I.I.S ITALO CALVINO</b></h1>
    </header>
<div class="container">
  <form action="listaProf.php">
    <h3>ACCEDI</h3>
    <div class="row">
    <div class="col-25">
      <label for="fname">Username:</label>
    </div>
    <div class="col-75">
      <input type="text" id="email" name="name" placeholder="Email">
      <p id="errorEmail" class="errorText"></p>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="lname">Password:</label>
    </div>
    <div class="col-75">
      <input type="password" id="password" name="password" placeholder="*****">
      <p id="errorPassword" class="errorText"></p>   
    </div>
  </div>
  <div class="row">
    <br><input type="submit">
  </div>
  </div>
  </form>
</div>


    
</body>
</html>