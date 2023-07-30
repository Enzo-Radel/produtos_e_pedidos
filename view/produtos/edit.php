<div class="card">
    <div class="d-flex justify-content-between align-items-center card-header">
        <h1 class="h2"><?php echo $layout["title"] ?></h1>
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

                <div class="mt-3 col-12">
                <hr>
                    <label for="imagens" class="form-label h4 mb-4">Imagens</label>
                    <div class="d-flex flex-wrap">
                        <?php foreach ($_REQUEST["imagens"] as $key => $imagem) { ?>
                            <div class="d-flex flex-column m-2 border" id="product-image-<?php echo $key ?>">
                                <div class="d-flex justify-content-between">
                                    <label for="" class="form-label text-bold">Imagem <?php echo $key ?></label>
                                    <span img-key="<?php echo $key ?>" role="button" class="remove-img-btn border border-dark rounded-circle d-flex justify-content-center align-items-center" style="width: 20px; height: 20px; transform: translate(50%, -50%);">x</span>
                                </div>
                                <img src="<?php echo "/".$imagem->nome; ?>" alt="" width="300" height="300" class="m-1">
                            </div>
                        <?php } ?>
                    </div>
                    <input type="file" class="form-control" name="imagens" id="imagens" multiple>
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
    // TODO Enviar requisição em modo put
    form = document.getElementById("edit-form");
    imagesBtn = document.querySelectorAll(".remove-img-btn");

    formData = new FormData(form);

    imagesBtn.forEach(imageBtn => {
        imageBtn.addEventListener("click", (event) => {
            id = imageBtn.getAttribute("img-key");
            formData.append(`remove_images[${id}]`, id);

            image = document.getElementById(`product-image-${id}`);
            image.remove();
        });
    });


    form.addEventListener("submit", (event) => {
        event.preventDefault();
        const data = {
            descricao: formData.get("descricao"),
            valorVenda: formData.get("valorVenda"),
            estoque: formData.get("estoque"),
            imagens: form["imagens"].files[0],
            // imagens: formData.get("imagens"),
        }
        fetch(form.getAttribute("action"), {
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: JSON.stringify(data),
            method: "put",
        }).then(() => {
            window.location.reload();
        });
    });
</script>