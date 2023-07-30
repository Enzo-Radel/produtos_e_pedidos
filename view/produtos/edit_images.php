<div class="card">
    <div class="d-flex justify-content-between align-items-center card-header">
        <h1 class="h2"><?php echo $layout["title"] ?></h1>
    </div>
    <form action="/imagens/store/<?php echo $_REQUEST["product_id"] ?>" method="post" enctype="multipart/form-data" id="form">
        
        <div class="card-body">
            <div class="row mb-3">
                <div class="mt-3 col-12">
                    <label for="imagens" class="form-label h4 mb-4">Imagens</label>
                    <div class="d-flex flex-wrap">
                        <?php foreach ($_REQUEST["imagens"] as $key => $imagem) { ?>
                            <div class="d-flex flex-column m-2 border" id="product-image-<?php echo $key ?>">
                                <div class="d-flex justify-content-between">
                                    <label for="" class="form-label text-bold">Imagem <?php echo $key ?></label>
                                    <span img-id="<?php echo $imagem->id ?>" role="button" class="remove-img-btn border border-dark rounded-circle d-flex justify-content-center align-items-center" style="width: 20px; height: 20px; transform: translate(50%, -50%);">x</span>
                                </div>
                                <img src="<?php echo "/".$imagem->nome; ?>" alt="" width="300" height="300" class="m-1">
                            </div>
                        <?php } ?>
                    </div>
                    <input type="file" class="form-control" name="imagens[]" id="imagens" multiple>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="/produtos/edit/<?php echo $_REQUEST["product_id"] ?>" class="ms-2 btn btn-danger">Voltar para edição de produto</a>
        </div>
    </form>
</div>

<script defer>
    form = document.getElementById("form");
    imagesBtn = document.querySelectorAll(".remove-img-btn");

    formData = new FormData(form);

    imagesBtn.forEach(imageBtn => {
        imageBtn.addEventListener("click", (event) => {
            id = imageBtn.getAttribute("img-id");
            fetch(`/imagens/delete/${id}`, {
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                method: "delete",
            }).then(() => {
                window.location.reload();
            });
        });
    });


    // form.addEventListener("submit", (event) => {
    //     event.preventDefault();
    //     const data = {
    //         descricao: formData.get("descricao"),
    //         valorVenda: formData.get("valorVenda"),
    //         estoque: formData.get("estoque"),
    //         imagens: form["imagens"].files[0],
    //         // imagens: formData.get("imagens"),
    //     }
    //     fetch(form.getAttribute("action"), {
    //         headers: {
    //             "Content-Type": "application/x-www-form-urlencoded",
    //         },
    //         body: JSON.stringify(data),
    //         method: "put",
    //     }).then(() => {
    //         window.location.reload();
    //     });
    // });
</script>