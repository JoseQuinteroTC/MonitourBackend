<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
  <title>Recuperar contraseña</title>
  <style type="text/css" >
    .content{
      font-size: 24px;
      font-family: 'Lato', sans-serif;
      display: grid;
      width: 40rem;
      padding: 1rem 3rem;
      margin: 0 auto;
    }

    .text-center {
      text-align: center;
    }
    .code {
      letter-spacing: 5px;
    }
    .topbar {
        text-align: center;
    }
  </style>
</head>
<body>

  <div >
    <div class="content" >
        <div class="topbar">
      <h2 >Reestablecer tu contraseña</h2>
      <img
        src="https://monitour.online/cover1.png"
        alt="monitour logo"
        height="70px"


      >
    </div>
    <div class="text-center">
      <h4>Hola {{$name}} {{$lastName}}!</h4>
      <div>
        Te estamos enviando este correo porque hemos recibido una solicitud
        para reestablecer tu contraseña. Para continuar porfavor ingresa en la página
        el codigo que esta a continuación.
      </div>
    </div>
    <h2 class="text-center code">
      {{$pin}}
    </h2>
    <div class="text-center">
      Si no has solicitado cambiar tu contraseña, porfavor ignora este correo.
      Tu contraseña no se vera afectada.
    </div>
    <div class="text-center">
      <h5>
        Equipo de Soporte Monitour
        <br> 2023 &copy;
      </h5>
    </div>
    </div>

  </div>
</body>
</html>

