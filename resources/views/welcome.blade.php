<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="fonts/fonts.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
</head>
<body>
  <div class="container">

    <div class="left-side">
      <img src="pics/rentigo-logo.png" alt="rentigo logo">
    </div>
    <div class="right-side">
      <h1 class="title">Connexion</h1>
      <form action="" >
        <div class="form-item">
          <label for="login">Login</label>
          <input type="text" name="login" id="login" placeholder="Entrer le login">
          <div class="error"></div>
        </div>
        <div class="form-item">
          <label for="motDePass">Mot de pass</label>
          <input type="password" name="motDePass" id="motDePass" placeholder="Entrer le mot de passe">
          <span class="material-icons-round" id="showPassword">
            visibility
          </span>
          <div class="error"></div>
        </div>
        <div class="form-check">
        <input type="checkbox" name="rememberMe" id="rememberMe">
        <label for="rememberMe">Se souvenir de moi ? </label>
        </div>
        <div class="form-item">
          <input type="submit" value="Se connecter" class="button">
        </div>
      </form>
    </div>

  </div>
  <script src="js/login.js"></script>
</body>
</html>