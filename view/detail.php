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
                <div class="size">
                    <button type="button" class="btn btn-outline-dark">39cm</button>
                    <button type="button" class="btn btn-outline-dark">39cm</button>
                    <button type="button" class="btn btn-outline-dark">39cm</button>
                </div>
                <div class="price">
                    <h3><?=$price?></h3>
                </div>
                <!-- <div class="original_price">
                    <h4><s>45.000.000</s></h4>
                </div> -->

                <div class="button">
                    <button type="button" class="btn btn-dark">Buy now</button>
                    <button type="button" class="btn btn-outline-dark">Add cart</button>
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