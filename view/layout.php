<?php $currentRoute = explode('/', $_SERVER['PATH_INFO']?? '/')[1] ?? '' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $layout["title"]; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <span class="navbar-brand">Meu Sistema</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentRoute == "produtos") echo "active";?>"  href="/produtos/">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentRoute == "pedidos") echo "active";?>" href="/pedidos/">Pedidos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="p-2">

        <?php if(isset($_REQUEST["alert"])) { ?>
            <div class="alert alert-<?php echo $_REQUEST["alert"]["type"] ?> alert-dismissible fade show" role="alert" id="alert">
            <?php echo $_REQUEST["alert"]["message"] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <?php include($layout["childView"]); ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>