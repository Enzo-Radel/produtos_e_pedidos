<div class="card">
    <div class="d-flex justify-content-between align-items-center card-header">
        <h1 class="h2"><?php echo $layout["title"] ?></h1>
        <a href="/produtos/images/<?php echo $_REQUEST["produto"]->id ?>" class="btn btn-info">Gerenciar imagens</a>
    </div>
    <form action="/produtos/update/<?php echo $_REQUEST["produto"]->id ?>" method="post" enctype="multipart/form-data" id="edit-form">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="number" class="form-control" name="id" id="id" value="<?php echo $_REQUEST["produto"]->id ?>" disabled>
                </div>

                <div class="col-9">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control" name="descricao" id="descricao" value="<?php echo $_REQUEST["produto"]->descricao ?>">
                </div>

                <div class="col-6">
                    <label for="valorVenda" class="form-label">Valor Venda</label>
                    <input type="number" class="form-control" name="valorVenda" id="valorVenda" value="<?php echo $_REQUEST["produto"]->valorVenda ?>">
                </div>

                <div class="col-6">
                    <label for="estoque" class="form-label">Estoque</label>
                    <input type="number" class="form-control" name="estoque" id="estoque" value="<?php echo $_REQUEST["produto"]->estoque ?>">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="/produtos" class="ms-2 btn btn-danger">Voltar para Listagem</a>
        </div>
    </form>
</div>

<script defer>
    form = document.getElementById("edit-form");

    form.addEventListener("submit", (event) => {
        event.preventDefault();

        const data = {
            descricao: form["descricao"].value,
            valorVenda: form["valorVenda"].value,
            estoque: form["estoque"].value,
        }
        fetch(form.getAttribute("action"), {
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: JSON.stringify(data),
            method: "put",
        }).then(() => {
            window.location.href = "/produtos";
        });
    });
</script>