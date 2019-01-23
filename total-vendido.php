<?php
    include 'src/includes/head.php';
    include 'src/classes/DocumentoDao.php';
    $totalVendido = DocumentoDao::calcTotalVendido();
?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a class="active" href="#">Vizualizar Total Vendido</a></li>
        </ol>
        <div class="jumbotron">
            <h1>Vizualizar Total Vendido</h1>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default text-center">
                    <h1>Total Vendido: R$<?php echo $totalVendido?></h1>
                </div>
            </div>
        </div>
    </div>
<?php include 'src/includes/footer.php'?>