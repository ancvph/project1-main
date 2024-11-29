<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="view/imgs/banner8.jpg" class="d-block w-100 " alt="...">
        </div>
        <div class="carousel-item">
            <img src="view/imgs/banner11.jpg" class="d-block w-100 " alt="...">
        </div>
        <div class="carousel-item">
            <img src="view/imgs/banner9.jpg" class="d-block w-100 " alt="...">

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


<div class="row mt-3">
    <div class="col mx-2">
        <div class="card" style="width: 22rem;">
            <img src="view/imgs/category1" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><a href="">BABY-G</a></p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card" style="width: 22rem;">
            <img src="view/imgs/category2" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><a href="">EDIFICE</a></p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card" style="width: 22rem;">
            <img src="view/imgs/category3" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><a href="">G-SHOCK</a></p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card" style="width: 22rem;">
            <img src="view/imgs/category4" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><a href="">SHEEN</a></p>
            </div>
        </div>
    </div>
</div>




<div class="future_product">
    <h2>FUTURE PRODUCT</h2>
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
            if($count >=5) break;
            extract($product);
            $img = $path_url.$image_url;
            echo '<div class="col product mt-3 ">
                    <div class="card" style="width: 16rem;">
                        <img src="'.$img.'" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="index.php?act=detail&product_id='.$product_id.'">
                                <h5 class="card-title text-decoration-none" >'.$product_name.'</h5>
                            </a>

                            <h6 class="card-title text-danger">'.number_format($price,0,',','.').' VNĐ</h6>
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
<div class="container">
    <div class="banner_bottom">
        <img src="view/imgs/banner_casio.webp" class="img-fluid" alt="...">
    </div>
</div>