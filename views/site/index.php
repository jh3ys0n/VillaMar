<?php
use yii\helpers\Html;
use yii\helpers\Url;
/** @var yii\web\View $this */

$this->title = 'Mallku Villa Mar';

// Registrar las fuentes de Google
$this->registerLinkTag([
    'rel' => 'preconnect',
    'href' => 'https://fonts.googleapis.com'
]);

$this->registerLinkTag([
    'rel' => 'preconnect',
    'href' => 'https://fonts.gstatic.com',
    'crossorigin' => true
]);

$this->registerCssFile('https://fonts.googleapis.com/css2?family=Major+Mono+Display&family=Neonderthaw&display=swap');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

$this->registerCssFile('@web/css/carousel.css');
$this->registerCssFile('@web/css/history.css');
$this->registerCssFile('@web/css/paralax.css');
$this->registerCssFile('@web/css/tourPlaces.css');
$this->registerCssFile('@web/css/activities.css');
$historyBgImage = Url::to('@web/assets/img/history-bg.jpg');

$images = [
    [
        'src' => '@web/assets/img/home/portada1.jpeg',
        'alt' => 'Imagen 1',
        'title' => 'Bienvenidos a Mallku Villa Mar',
        'subTitle' => 'Descubre un lugar único',
    ],
    [
        'src' => '@web/assets/img/home/portada.png',
        'alt' => 'Imagen 2',
        'title' => 'Disfruta de la Naturaleza',
        'subTitle' => 'Conecta con el Entorno',
    ],
    [
        'src' => '@web/assets/img/home/portada2.jpg',
        'alt' => 'Imagen 3',
        'title' => 'Experiencias Inolvidables',
        'subTitle' => 'Vive momentos únicos',
    ],
];

// Datos de la línea de tiempo
$timelineEvents = [
    [
        'year' => 'Antes de 1949',
        'title' => 'Origen del Nombre',
        'content' => 'La comunidad de Mallcu Cueva, ahora conocida como Mallcu Villa Mar, debe su nombre a una cueva cercana que era utilizada para cabildos por las autoridades autóctonas llamadas "mallcus". Los habitantes vivían dispersos en viviendas rústicas y precarias, dedicándose principalmente a la cría de ganado camélido, ovino y caprino para su alimentación, y utilizaban jumentos como medio de transporte. Practicaban también la agricultura en menor escala, cultivando quinua orgánica.'
    ],
    [
        'year' => '9 de Julio de 1949',
        'title' => 'Fundación de Mallcu Cueva',
        'content' => 'La comunidad fue fundada oficialmente con la creación de la escuela y la Junta de Auxilio Escolar. Los fundadores de la comunidad fueron:
        <ul class="list-disc pl-5 mt-2">
            <li>Sr. Remigio Berna</li>
            <li>Sra. Eulogia Salvatierra</li>
            <li>Sr. Apolinar Berna</li>
            <li>Sr. Simón Vaca</li>
            <li>Sr. Baltazar Villca</li>
            <li>Sr. Eugenio Berna</li>
            <li>Sra. Trinidad Salvatierra</li>
        </ul>
        <p class="mt-2">Posteriormente consiguieron el ÍTEM de una escuela fiscal.</p>'
    ],
    [
        'year' => '1963',
        'title' => 'Cambio de Nombre a Mallcu Villa Mar',
        'content' => 'En la década de 1960, específicamente en 1963, durante un jatun cabildo (reunión general), se debatió el nombre de la comunidad. Tras varios intercambios, se adoptó el nombre de Mallcu Villa Mar. Este nombre refleja su posición como la última comunidad hacia la frontera con la República de Chile y su proximidad al océano Pacífico.'
    ],
    [
        'year' => '1967',
        'title' => 'Administración Autónoma',
        'content' => 'Desde el año 1967, la comunidad cuenta con sus propias autoridades, como el Corregidor, Agente Municipal y Junta Escolar, decidiendo tomar su propio destino mediante una administración autónoma basada en sus usos y costumbres.'
    ],
    [
        'year' => 'Actualidad',
        'title' => 'Desarrollo Actual',
        'content' => 'Hoy, Mallcu Villa Mar ha experimentado un desarrollo constante y cuenta con servicios básicos como electricidad, agua potable, alcantarillado, planta de relleno sanitario, hoteles, caminos regulares, pista de aterrizaje y comunicación celular.'
    ]
];

?>

<!-- Sección del Carrusel -->
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

<!-- Sección de Historia -->
<section class="history-section">
    <div class="history-container">
        <div class='container'>
            <div class="w-full mb-10">
                <h1 class="history-title">Historia</h1>
            </div>

            <div class="timeline">
                <?php foreach ($timelineEvents as $index => $event): ?>
                    <div class="timeline-event animate-element" id="timeline-event-<?= $index ?>">
                        <button class="timeline-header">
                            <div>
                                <time class="timeline-date"><?= $event['year'] ?></time>
                                <h3 class="timeline-event-title"><?= $event['title'] ?></h3>
                            </div>
                            <i class="fas fa-chevron-down timeline-chevron" id="chevron-<?= $index ?>"></i>
                        </button>
                        <div class="timeline-content" id="content-<?= $index ?>">
                            <?= $event['content'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="timeline-images">
            <img class="timeline-image" src="<?= Url::to('@web/assets/img/home/histori2.gif') ?>" alt="Imagen de Mallcu Villa Mar">
        </div>
    </div>
</section>

<section class="parallax-section" style="background-image: url('<?= Url::to('@web/assets/img/home/portada2.jpg') ?>');">
    <div class="parallax-container">
        <div class="parallax-content">
            <p class="parallax-tag">Pueblo indígena originario</p>
            <h2 class="parallax-title">❤️ Mallku Villa Mar</h2>
            <p class="parallax-description">La comunidad está ubicada en un entorno natural impresionante, rodeado de montañas, ríos y lagunas. Los visitantes pueden disfrutar de caminatas, atractivos turísticos y otros deportes al aire libre.</p>
        </div>
    </div>
</section>

<!-- Sección de Lugares Turísticos Mejorada -->
<section class="tourist-spots-section">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Explora Nuestros Lugares Turísticos</h1>
            <p class="section-subtitle">Descubre los tesoros naturales y culturales de Mallku Villa Mar</p>
        </div>
        
        <div class="spots-grid">
            <!-- Tarjeta 1 - Tomas Lak'a -->
            <div class="spot-card">
                <div class="card-image-container">
                    <img src="<?= Url::to('@web/assets/img/home/tomas_laka.jpg') ?>" 
                         alt="Pinturas Rupestres Tomas Lak'a en Mallku Villa Mar" 
                         class="card-image"
                         loading="lazy">
                    <div class="image-overlay"></div>
                    <button class="favorite-button" aria-label="Añadir a favoritos">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </button>
                </div>
                <div class="card-content">
                    <div class="card-header">
                        <h3 class="card-title">Tomas Lak'a</h3>
                    </div>
                    <p class="card-description">Sitio arqueológico con pinturas rupestres que muestran la vida y cosmovisión de los primeros habitantes de la región.</p>
                    <div class="card-features">
                        <div class="feature">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>A 2 km del pueblo</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-clock"></i>
                            <span>Todo el día</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-walking"></i>
                            <span>Acceso caminando</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= Url::to(['site/detalle', 'id' => 'tomas-laka']) ?>" class="view-all-button">
                    Conocer lugar
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="spot-card">
                <div class="card-image-container">
                    <img src="<?= Url::to('@web/assets/img/home/laguna_catal.jpg') ?>" 
                         alt="Pinturas Rupestres Tomas Lak'a en Mallku Villa Mar" 
                         class="card-image"
                         loading="lazy">
                    <div class="image-overlay"></div>
                    <button class="favorite-button" aria-label="Añadir a favoritos">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </button>
                </div>
                <div class="card-content">
                    <div class="card-header">
                        <h3 class="card-title">Laguna Catal</h3>
                    </div>
                    <p class="card-description"></p>
                    <div class="card-features">
                        <div class="feature">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>A  km del pueblo</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-clock"></i>
                            <span>Todo el día</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-walking"></i>
                            <span>Acceso caminando</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= Url::to(['site/detalle', 'id' => 'tomas-laka']) ?>" class="view-all-button">
                    Conocer lugar
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>          
            <!-- Tarjeta 2 - Laguna Vinto -->
            <div class="spot-card">
                <div class="card-image-container">
                    <img src="<?= Url::to('@web/assets/img/home/laguna_vinto.jpg') ?>" 
                         alt="Laguna Vinto en Mallku Villa Mar" 
                         class="card-image"
                         loading="lazy">
                    <div class="image-overlay"></div>
                    <button class="favorite-button" aria-label="Añadir a favoritos">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </button>
                </div>
                <div class="card-content">
                    <div class="card-header">
                        <h3 class="card-title">Laguna Vinto</h3>
                    </div>
                    <p class="card-description">Espejo de agua cristalina al pie de las montañas, hábitat de flamencos andinos y otras aves silvestres. Refleja el cielo en un espectáculo natural único.</p>
                    <div class="card-features">
                        <div class="feature">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>A 5 km del pueblo</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-clock"></i>
                            <span>Todo el día</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-car"></i>
                            <span>Acceso en vehículo</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= Url::to(['site/detalle', 'id' => 'laguna-vinto']) ?>" class="view-all-button">
                    Conocer lugar
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <!-- Tarjeta 3 - Italia Perdida -->
            <div class="spot-card">
                <div class="card-image-container">
                    <img src="<?= Url::to('@web/assets/img/home/italia_perdida.jpg') ?>" 
                         alt="Formaciones rocosas Italia Perdida en Mallku Villa Mar" 
                         class="card-image"
                         loading="lazy">
                    <div class="image-overlay"></div>
                    <button class="favorite-button" aria-label="Añadir a favoritos">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </button>
                </div>
                <div class="card-content">
                    <div class="card-header">
                        <h3 class="card-title">Italia Perdida</h3>
                    </div>
                    <p class="card-description">Laberinto de formaciones rocosas que evocan ruinas antiguas, ideal para fotografía y exploración de paisajes únicos.</p>
                    <div class="card-features">
                        <div class="feature">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>A 7 km del pueblo</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-clock"></i>
                            <span>Todo el día</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-hiking"></i>
                            <span>Trekking moderado</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= Url::to(['site/detalle', 'id' => 'italia-perdida']) ?>" class="view-all-button">
                    Conocer lugar
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <!-- Tarjeta 4 - Laguna Capina -->
            <div class="spot-card">
                <div class="card-image-container">
                    <img src="<?= Url::to('@web/assets/img/home/laguna_capina (2).jpeg') ?>" 
                         alt="Laguna Capina en Mallku Villa Mar" 
                         class="card-image"
                         loading="lazy">
                    <div class="image-overlay"></div>
                    <button class="favorite-button" aria-label="Añadir a favoritos">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </button>
                </div>
                <div class="card-content">
                    <div class="card-header">
                        <h3 class="card-title">Laguna Capina</h3>
                    </div>
                    <p class="card-description">Refugio de vida silvestre con aguas tranquilas, rodeada de vegetación nativa y frecuentada por aves migratorias.</p>
                    <div class="card-features">
                        <div class="feature">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>A km del pueblo</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-clock"></i>
                            <span>Todo el día</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-car"></i>
                            <span>Acceso en vehículo</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= Url::to(['site/detalle', 'id' => 'laguna-capina']) ?>" class="view-all-button">
                    Conocer lugar
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
                 <!-- Tarjeta 4 - Laguna Capina -->
                 <div class="spot-card">
                <div class="card-image-container">
                    <img src="<?= Url::to('@web/assets/img/home/laguna_pastos.jpeg') ?>" 
                         alt="Laguna Capina en Mallku Villa Mar" 
                         class="card-image"
                         loading="lazy">
                    <div class="image-overlay"></div>
                    <button class="favorite-button" aria-label="Añadir a favoritos">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </button>
                </div>
                <div class="card-content">
                    <div class="card-header">
                        <h3 class="card-title">Laguna Pastos Grandes</h3>
                    </div>
                    <p class="card-description"> La laguna y sus alrededores forman parte
 de un ecosistema salino, caracterizado
 por la presencia de salares y bofedales, lo
 que la convierte en un lugar atractivo
 tanto para el ecoturismo </p>
                    <div class="card-features">
                        <div class="feature">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>A 4 km del pueblo</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-clock"></i>
                            <span>Todo el día</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-car"></i>
                            <span>Acceso en vehículo</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= Url::to(['site/detalle', 'id' => 'laguna-capina']) ?>" class="view-all-button">
                    Conocer lugar
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>      
            <!-- Tarjeta 5 - Laguna Kachi -->
            <div class="spot-card">
                <div class="card-image-container">
                    <img src="<?= Url::to('@web/assets/img/home/laguna_kachi.jpeg') ?>" 
                         alt="Laguna Kachi en Mallku Villa Mar" 
                         class="card-image"
                         loading="lazy">
                    <div class="image-overlay"></div>
                    <button class="favorite-button" aria-label="Añadir a favoritos">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </button>
                </div>
                <div class="card-content">
                    <div class="card-header">
                        <h3 class="card-title">Laguna Kachi</h3>
                    </div>
                    <p class="card-description">Laguna salina con formaciones minerales únicas, conocida por sus colores cambiantes según la temporada.</p>
                    <div class="card-features">
                        <div class="feature">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>A 6 km del pueblo</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-clock"></i>
                            <span>Todo el día</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-car"></i>
                            <span>Acceso en vehículo</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= Url::to(['site/detalle', 'id' => 'laguna-kachi']) ?>" class="view-all-button">
                    Conocer lugar
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
    
    </div>
</section>

<!-- Sección de Actividades Económicas -->
<section class="economic-activities-section">
    <div class="container">
        <div class="section-header">
            <div class="title-decoration">
                <div class="decoration-line"></div>
            </div>
            <h1 class="section-title">Actividades Económicas</h1>
            <p class="section-subtitle">El pueblo indígena originario cuenta con diversas actividades económicas entre las que destacan:</p>
        </div>
        
        <div class="activities-grid">
            <!-- Actividad 1 - Ganadería -->
            <div class="activity-card">
                <div class="activity-image-container">
                    <img src="<?= Url::to('@web/assets/img/home/ganaderia.jpg') ?>" 
                         alt="Ganadería en Mallku Villa Mar" 
                         class="activity-image"
                         loading="lazy">
                </div>
                <div class="activity-content">
                    <h3 class="activity-title">Ganadería</h3>
                    <p class="activity-description">
                        La ganadería ha sido una actividad económica importante para el pueblo indígena originario a lo largo de su historia, proporcionando alimento, trabajo y recursos económicos. Se crían principalmente camélidos, ovinos y caprinos.
                    </p>
                </div>
            </div>
            
            <!-- Actividad 2 - Agricultura -->
            <div class="activity-card">
                <div class="activity-image-container">
                    <img src="<?= Url::to('@web/assets/img/home/quinua.jpg') ?>" 
                         alt="Agricultura en Mallku Villa Mar" 
                         class="activity-image"
                         loading="lazy">
                </div>
                <div class="activity-content">
                    <h3 class="activity-title">Agricultura</h3>
                    <p class="activity-description">
                        La quinua es un cultivo altamente sostenible y adaptable, capaz de crecer en suelos pobres y en condiciones climáticas extremas. Se cultiva de forma tradicional y orgánica, preservando los saberes ancestrales.
                    </p>
                </div>
            </div>
            
            <!-- Actividad 3 - Turismo -->
            <div class="activity-card">
                <div class="activity-image-container">
                    <img src="<?= Url::to('@web/assets/img/home/turismo.jpg') ?>" 
                         alt="Turismo en Mallku Villa Mar" 
                         class="activity-image"
                         loading="lazy">
                </div>
                <div class="activity-content">
                    <h3 class="activity-title">Turismo</h3>
                    <p class="activity-description">
                        El turismo en Mallku Villa Mar ha tenido un impacto positivo en la economía local, proporcionando empleo y oportunidades para el desarrollo de pequeños negocios y emprendimientos relacionados con la hospitalidad y artesanías.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Scripts para funcionalidad -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar el carrusel
    var myCarousel = new bootstrap.Carousel(document.getElementById('main-carousel'), {
        interval: 4000,
        wrap: true,
        pause: false
    });
    
    // Funcionalidad de acordeón para la línea de tiempo
    const timelineHeaders = document.querySelectorAll('.timeline-header');
    timelineHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const contentId = this.getAttribute('data-target') || 
                             this.nextElementSibling.id;
            const content = document.getElementById(contentId);
            const chevron = this.querySelector('.timeline-chevron');
            
            content.classList.toggle('show');
            
            if (content.classList.contains('show')) {
                chevron.classList.replace('fa-chevron-down', 'fa-chevron-up');
            } else {
                chevron.classList.replace('fa-chevron-up', 'fa-chevron-down');
            }
        });
    });
    
    // Animación al hacer scroll
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.animate-element');
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (elementPosition < windowHeight - 100) {
                element.classList.add('animate__animated', 'animate__fadeInUp');
            }
        });
    };
    
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Ejecutar al cargar la página
});
</script>