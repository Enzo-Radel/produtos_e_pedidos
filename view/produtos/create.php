<div class="card">
    <div class="d-flex justify-content-between align-items-center card-header">
        <h1><?php echo $layout["title"] ?></h1>
    </div>
    <form action="/produtos/store" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="number" class="form-control" name="id">
                </div>

                <div class="col-9">
                    <label for="" class="form-label">Descrição</label>
                    <input type="text" class="form-control" name="descricao">
                </div>

                <div class="col-6">
                    <label for="" class="form-label">Valor Venda</label>
                    <input type="number" class="form-control" name="valorVenda">
                </div>

                <div class="col-6">
                    <label for="" class="form-label">Estoque</label>
                    <input type="number" class="form-control" name="estoque">
                </div>

                <div class="mt-3 col-12">
                    <label for="" class="form-label">Imagens</label>
                    <input type="file" class="form-control" name="imagens" multiple>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Cadastrar</button>
            <a href="/produtos" class="ms-2 btn btn-danger">Voltar para Listagem</a>
        </div>
    </form>
</div>