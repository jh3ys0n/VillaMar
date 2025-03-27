
<?php


?>
<section class="carousel-section">
    <div class="p-0 m-0 carousel-container">
        <div id="main-carousel" class="carousel slide h-100" data-bs-interval="4000">
            <div class="carousel-indicators">
                <?php foreach ($images as $index => $image): ?>
                    <button type="button" data-bs-target="#main-carousel" data-bs-slide-to="<?= $index ?>" 
                        <?= $index === 0 ? 'class="active" aria-current="true"' : '' ?>>
                    </button>
                <?php endforeach; ?>
            </div>

            <div class="carousel-inner h-100 m-0 p-0">
                <?php foreach ($images as $index => $image): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?> h-100">
                        <div class="h-100 w-100 position-relative">
                            <img src="<?= Url::to($image['src']) ?>" 
                                 class="w-100 h-100"
                                 style="object-fit: cover; object-position: center;"
                                 alt="<?= Html::encode($image['alt']) ?>">
                                 
                            <div class="position-absolute top-0 start-0 w-100 h-100" 
                                 style="background: radial-gradient(circle, rgba(0,0,0,0) 0%, rgba(0,0,0,0.2) 30%, rgba(0,0,0,0.4) 60%, rgba(0,0,0,0.6) 100%); pointer-events: none;">
                            </div>
                                 
                            <div class="carousel-caption-container">
                                <p class="animate__animated animate__fadeInUp carousel-subtitle">
                                    <?= Html::encode($image['subTitle']) ?>
                                </p>
                                <h1 class="animate__animated animate__fadeInUp carousel-title">
                                    <?= Html::encode($image['title']) ?>
                                </h1>
                                
                                <div class="d-flex justify-content-center animate__animated animate__fadeInUp">
                                    <button class="custom-button">
                                        <span class="position-relative font-bold">Conoce más</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <button class="carousel-control-prev" type="button" data-bs-target="#main-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#main-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>