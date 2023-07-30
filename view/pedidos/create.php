<div class="card">
    <div class="d-flex justify-content-between align-items-center card-header">
    <h1 class="h2"><?php echo $layout["title"] ?></h1>
    </div>
    <form action="/pedidos/store" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-8">
                    <label for="cliente" class="form-label">cliente</label>
                    <input type="text" class="form-control" name="cliente" id="cliente">
                </div>

                <div class="col-4">
                    <label for="data" class="form-label">Data</label>
                    <input type="number" class="form-control" name="data" id="data">
                </div>
                
                <div class="col-12">
                    <hr>
                    <label for="produtos" class="form-label h4">Produtos</label>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Cadastrar</button>
            <a href="/pedidos" class="ms-2 btn btn-danger">Voltar para Listagem</a>
        </div>
    </form>
</div>