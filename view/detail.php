<div class="container">
    <div class="card mb-3" style="max-width: 1200px; max-height:700px;">
        <div class="row g-0">
            <div class="col-md-5">
                <?php
                    extract($detail);
                    $img = $path_url.$image_url;
                    echo'<img src="'.$img.'" class="img_detail img-fluid rounded-start" alt="...">'
                ?>

            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h3 class="card-title"><?=$product_name?></h3>
                    <p class="card-text"><?=$description?></p>

                </div>

                <div class="price">
                    <h3 class="text-danger mx-3"><?=number_format($price,0,',','.') ?>VNĐ</h3>
                </div>


                <div class="button">
                    <button type="button" class="btn btn-dark m-3">Buy now</button>
                    <form action="index.php?act=cart" method="post">
                        <input type="hidden" name="product_id" value="<?=$product_id?>">
                        <input type="hidden" name="product_name" value="<?=$product_name?>">
                        <input type="hidden" name="image_url" value="<?=$image_url?>">
                        <input type="hidden" name="price" value="<?=$price?>">


                        <input type="submit" name="addtocart" value="Add cart" class="btn btn-outline-dark mx-3">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- comments -->
    <div class="form-floating">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
            style="height: 100px"></textarea>
        <label for="floatingTextarea2">Comments</label>
    </div>

</div>