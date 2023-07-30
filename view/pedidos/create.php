<div class="card">
    <div class="d-flex justify-content-between align-items-center card-header">
    <h1 class="h2"><?php echo $layout["title"] ?></h1>
    </div>
    <form action="/pedidos/store" method="post">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-8">
                    <label for="cliente" class="form-label">cliente</label>
                    <input type="text" class="form-control" name="cliente" id="cliente">
                </div>

                <div class="col-4">
                    <label for="data" class="form-label">Data</label>
                    <input type="date" class="form-control" name="data" id="data">
                </div>
                
                <div class="col-12">
                    <hr>
                    <label for="produtos" class="form-label h4">Produtos</label>
                    <br>
                    <br>

                    <div class="d-flex flex-column">
                        <?php foreach ($_REQUEST["produtos"] as $produto) { ?>
                            <div class="d-flex align-items-end">
                                <div class="me-5">
                                    <input type="checkbox" class="btn-check" id="btncheck<?php echo $produto->id ?>" name="produtos[<?php echo $produto->id ?>]">
                                    <label class="btn btn-outline-primary" for="btncheck<?php echo $produto->id ?>"><?php echo $produto->descricao ?></label>
                                </div>
                                <div>
                                    <label for="quantidade[<?php echo $produto->id ?>]" class="form-label">Quantidade</label>
                                    <input type="text" name="quantidade[<?php echo $produto->id ?>]" class="form-control" id="quantidade[<?php echo $produto->id ?>]">
                                </div>
                            </div>
                            <br>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Cadastrar</button>
            <a href="/pedidos" class="ms-2 btn btn-danger">Voltar para Listagem</a>
        </div>
    </form>
</div>