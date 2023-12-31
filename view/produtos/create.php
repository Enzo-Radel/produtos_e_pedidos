<div class="card">
    <div class="d-flex justify-content-between align-items-center card-header">
    <h1 class="h2"><?php echo $layout["title"] ?></h1>
    </div>
    <form action="/produtos/store" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="number" class="form-control" name="id" id="id" required>
                </div>

                <div class="col-9">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control" name="descricao" id="descricao" required>
                </div>

                <div class="col-6">
                    <label for="valorVenda" class="form-label">Valor Venda</label>
                    <input type="number" step="0.01" class="form-control" name="valorVenda" id="valorVenda" required>
                </div>

                <div class="col-6">
                    <label for="estoque" class="form-label">Estoque</label>
                    <input type="number" class="form-control" name="estoque" id="estoque" required>
                </div>

                <div class="mt-3 col-12">
                    <label for="imagens" class="form-label">Imagens</label>
                    <input type="file" class="form-control" name="imagens[]" id="imagens" multiple>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Cadastrar</button>
            <a href="/produtos" class="ms-2 btn btn-danger">Voltar para Listagem</a>
        </div>
    </form>
</div>