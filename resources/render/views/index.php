<?php \core\rendering\View::title("index"); ?>

<h2>Новинки</h2>
<div class="row">
    <?php foreach ($books as $book): ?>
        <a href="<?php echo \core\routing\Router::route("book.show", ["id" => $book["id"]]) ?>" class="col-6 col-md-4 col-lg-3 p-2 hover">
            <img class="img-fluid cover" src="<?php echo $book["cover_url"] != null ? \core\helpers\Resource::get("img/Book/".$book["cover_url"]) : \core\helpers\Resource::get("img/system/base_img.jpg") ?>" alt="">
        </a>
    <?php endforeach; ?>
</div>
<div class="d-flex justify-content-center align-items-center gap-1 fs-4">
    <a class="text-decoration-none <?php echo $current_page > 1 ? "text-primary" : "text-secondary" ?>" href="<?php echo $current_page > 1 ? \core\routing\Router::route("index", ["page" => 1]) : "" ?>">⋘</a>
    <a class="text-decoration-none <?php echo $current_page - 1 >= 1 ? "text-primary" : "text-secondary" ?>" href="<?php echo $current_page - 1 >= 1 ? \core\routing\Router::route("index", ["page" => $current_page - 1]) : "" ?>"><</a>
    <a class="text-decoration-none"><?php echo $current_page ?></a>
    <a class="text-decoration-none <?php echo $current_page + 1 <= $page_count ? "text-primary" : "text-secondary" ?>" href="<?php echo $current_page + 1 <= $page_count ? \core\routing\Router::route("index", ["page" => $current_page + 1]) : ""?>">></a>
    <a class="text-decoration-none <?php echo $current_page < $page_count ? "text-primary" : "text-secondary" ?>" href="<?php echo $current_page < $page_count ? \core\routing\Router::route("index", ["page" => $page_count]) : "" ?>">⋙</a>
</div>

<h2>Лучшее за всё время</h2>
<div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php $isFirstSlide = true ?>
        <?php for ($i = 0; $i < count($tops); $i++): ?>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i ?>" class="<?php echo $isFirstSlide ? "active" : "" ?>" aria-current="true" aria-label="Slide <?php echo $i ?>"></button>
            <?php $isFirstSlide = false ?>
        <?php endfor; ?>
    </div>
    <div class="carousel-inner">
        <?php $isFirstSlide = true ?>
        <?php foreach ($tops as $key => $top): ?>
            <div class="bg-light carousel-item text-black p-4 pb-5 p-lg-5 <?php echo $isFirstSlide ? "active" : "" ?>">
                <?php $isFirstSlide = false ?>
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-primary col-12 text-center"><?php echo $top["title"] ?></h1>
                    </div>
                    <div class="col-12">
                        <img class="col-3 me-2 float-start" src="<?php echo $top["cover_url"] != null ? \core\helpers\Resource::get("img/Book/".$top["cover_url"]) : \core\helpers\Resource::get("img/system/base_img.jpg") ?>" alt="">
                        <p class="text-justify fs-5">
                            <?php echo $top["description"] ?>
                            <br><br>
                            <a href="<?php echo \core\routing\Router::route("book.show", ["id" => $top["id"]]) ?>">Подробнее</a>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev w-5" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next w-5" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>