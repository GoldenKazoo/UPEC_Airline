<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panneau d'admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body
    {
      padding-top: 70px;
    } 
    .hero {
      text-align: center;
      width: 100%;
      padding: 100px 20px;
      background-color: white;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      border-radius: 10px;
    }
    .navbar-nav {
      margin-left: auto;
      margin-right: auto;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav text-center">
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.flights.create') }}">Ajouter un vol</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.flights') }}">Informations sur les vols</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active " href="{{ route('admin.reservations') }}">Reservations effectuees</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<div>
@yield('content');
  </div>
</body>
</html>