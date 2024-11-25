<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="view/imgs/banner10.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="view/imgs/banner8.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="view/imgs/banner7.jpg" class="d-block w-100" alt="...">

        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="future_product">

    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <h3>PRODUCT</h3>
        </button>
        <ul class="dropdown-menu">
            <?php
            foreach ($load_categories as $category) {
                # code...
                extract ($category);
                echo '
                        <li><button class="dropdown-item" type="button">'.$category_name.'</button></li>  
                ';
            }  
        ?>
        </ul>

    </div>
    <nav class="navbar ">
        <div class="container-fluid">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-dark" type="submit">Search</button>
            </form>
        </div>
    </nav>
</div>


<div class="row products">
    <style>
    .card-body a {
        text-decoration: none;
        color: black;
    }
    </style>
    <?php
        $count = 0;
        foreach($load_products as $product){
            if($count >=10) break;
            extract($product);
            $img = $path_url.$image_url;
            echo '<div class="col product mt-3 ">
                    <div class="card" style="width: 16rem;">
                        <img src="'.$img.'" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="index.php?act=detail&product_id='.$product_id.'">
                                <h5 class="card-title text-decoration-none" >'.$product_name.'</h5>
                            </a>

                            <h6 class="card-title text-danger">$ '.$price.'</h6>
                            

                            <form action="index.php?act=cart" method="post">
                                <input type="hidden" name="product_id" value="'.$product_id.'">
                                <input type="hidden" name="product_name" value="'.$product_name.'">
                                <input type="hidden" name="image_url" value="'.$image_url.'">
                                <input type="hidden" name="price" value="'.$price.'">

                                
                                <input type="submit" name="addtocart" value="Add cart" class="btn btn-outline-dark">
                            </form>
                        </div>
                    </div>
                </div>';
            $count++;
        }
    ?>

</div>

</div>
</div>