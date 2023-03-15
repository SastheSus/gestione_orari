<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../style/stileAccesso.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="../script/login.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans:wght@500&display=swap" rel="stylesheet">  
</head>
<body>
    <header>
        <h1><b>I.I.S. ITALO CALVINO</b></h1>
    </header>
<div class="container">
  <form action="listaProf.php" >
    <h3>ACCEDI</h3>
    <div class="row" id="acc">
    <div class="col-25">
      <label for="fname">Username:</label>
    </div>
    <div class="col-75">
      <input type="text" id="email" name="name" placeholder="Email">
      <p id="errorEmail" class="errorText"></p>
    </div>
  </div>
  <div class="row" id="acc2">
    <div class="col-25">
      <label for="lname">Password:</label>
    </div>
    <div class="col-75">
      <input type="password" id="password" name="password" placeholder="*****">
      <p id="errorPassword" class="errorText"></p>   
    </div>
  </div>
  <div class="row" id="newPassword">
    <div class="col-25">
      <label for="lname">Nuova Password:</label>
    </div>
    <div class="col-75">
      <input type="password" id="newPasswordIn" name="password" placeholder="*****">
      <p id="errorNewPassword" class="errorText"></p>   
    </div>
  </div>
  <div class="row" id="confPassword">
    <div class="col-25">
      <label for="lname">Conferma Password:</label>
    </div>
    <div class="col-75">
      <input type="password" id="confPasswordIn" name="password" placeholder="*****">
      <p id="errorConPassword" class="errorText"></p>   
    </div>
  </div>
  <div class="row">
    <br><button type="submit" onclick="return tryLog()">ACCEDI</button>
  </div>
  </div>
  </form>
</div>


    
</body>
</html>