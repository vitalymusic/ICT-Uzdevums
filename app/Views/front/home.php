<?php include("header.php")?>
<body class="bg-light">
    <header>
        <nav class="navbar" style="background-color: #373e98;color:white">
            <h1 class="text-center ms-5">Uzdevums ICT</h1>
        </nav>
       
    </header>
    <div class="container">
            <h1><?=$title?></h1>
            <?php var_dump($news)?>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?php include("filter.php")?>
        </div>
        <div class="col-md-10">
        <div class="container news">
        <div class="row">
            <?php foreach($news as $value):?>
            <div class="col-md-4">
              <div class="card mb-4 box-shadow p-3">
                <h3 class="text-center"><?=$value["news_name"]?></h3>
                <div class="card-body">
                  <p class="card-text"><?=$value["news_content"]?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      te būs pogas
                    </div>
                    <small class="text-muted">Kategorija: <?=$value["cat_name"]?></small>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
        </div>
    </div>
   
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    
    <script>
        $(document).ready(function(){
            
        })
    </script>
</body>
</html>