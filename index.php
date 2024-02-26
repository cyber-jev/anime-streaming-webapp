<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>
<?php 

    
    $shows = $conn->query("SELECT * FROM shows LIMIT 3");
    $shows->execute();
    
    $allShows = $shows->fetchAll(PDO::FETCH_OBJ);


    // treding shows

    $trendingShows = $conn->query("SELECT shows.id AS id, shows.image AS image, shows.num_available AS num_available, shows.num_total AS num_total,
     shows.title AS title, shows.genre AS genre, shows.type AS type, 
    COUNT(views.show_id) AS count_views FROM `shows` JOIN views ON shows.id = views.show_id GROUP BY(shows.id) ORDER BY views.show_id ASC");

    $trendingShows->execute();

    $allTredingShows = $trendingShows->fetchAll(PDO::FETCH_OBJ);



    // adventure shows
    $adventureShows = $conn->query("SELECT shows.id AS id, shows.image AS image, shows.num_available AS num_available, shows.num_total AS num_total,
    shows.title AS title, shows.genre AS genre, shows.type AS type, 
   COUNT(views.show_id) AS count_views FROM `shows` JOIN views ON shows.id = views.show_id WHERE shows.genre = 'Adventure' GROUP BY(shows.id) ORDER BY views.show_id ASC");

   $adventureShows->execute();

   $allAdventureShows = $adventureShows->fetchAll(PDO::FETCH_OBJ);

   

    // recently added shows
    $recentlyAddedShows = $conn->query("SELECT shows.id AS id, shows.image AS image, shows.num_available AS num_available, shows.num_total AS num_total,
    shows.title AS title, shows.genre AS genre, shows.type AS type, 
   COUNT(views.show_id) AS count_views FROM shows JOIN views ON shows.id = views.show_id GROUP BY(shows.id) ORDER BY shows.created_at DESC");

   $recentlyAddedShows->execute();

   $allRecentlyAddedShows = $recentlyAddedShows->fetchAll(PDO::FETCH_OBJ);



    // actions shows
    $actionShows = $conn->query("SELECT shows.id AS id, shows.image AS image, shows.num_available AS num_available, shows.num_total AS num_total,
    shows.title AS title, shows.genre AS genre, shows.type AS type, 
   COUNT(views.show_id) AS count_views FROM shows JOIN views ON shows.id = views.show_id WHERE shows.genre = 'Action' GROUP BY(shows.id) ORDER BY views.show_id DESC");

   $actionShows->execute();

   $allActionShows = $actionShows->fetchAll(PDO::FETCH_OBJ);


    // for you shows
    $forYouShows = $conn->query("SELECT shows.id AS id, shows.image AS image, shows.num_available AS num_available, shows.num_total AS num_total,
    shows.title AS title, shows.genre AS genre, shows.type AS type, 
   COUNT(views.show_id) AS count_views FROM shows JOIN views ON shows.id = views.show_id WHERE shows.status = 'Airing'  GROUP BY(shows.id) ORDER BY views.show_id DESC LIMIT 4");

   $forYouShows->execute();

   $allForYouShows = $forYouShows->fetchAll(PDO::FETCH_OBJ);
?>


    <!-- Header End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
                <?php foreach($allShows as $show) : ?>
                    <div class="hero__items set-bg" data-setbg="img/<?php echo $show->image; ?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="hero__text">
                                    <div class="label"><?php echo $show->genre; ?></div>
                                    <h2><?php echo $show->title; ?></h2>
                                    <p><?php echo $show->description; ?></p>
                                    <a href="<?php echo APPURL?>/anime-watching.php?id=<?php echo $show->id; ?>&ep=1"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Trending Now</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <!-- <div class="btn__all">
                                    <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div> -->
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach($allTredingShows as $trendingShow) : ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="img/<?php echo $trendingShow->image; ?>">
                                            <div class="ep"><?php echo $trendingShow->num_available; ?> / <?php echo $trendingShow->num_total; ?></div>
                                            <div class="view"><i class="fa fa-eye"></i> <?php echo $trendingShow->count_views; ?></div>
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                <li><?php echo $trendingShow->genre; ?></li>
                                                <li><?php echo $trendingShow->type; ?></li>
                                            </ul>
                                            <h5><a href="anime-details.php?id=<?php echo $trendingShow->id; ?>"><?php echo $trendingShow->title; ?></a></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
 
                        </div>
                    </div>
                    <div class="popular__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Adventure Shows</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="<?php echo APPURL?>/categories.php?name=Adventure" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach($allAdventureShows as $adventureShow) : ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="img/<?php echo $adventureShow->image; ?>">
                                            <div class="ep"><?php echo $adventureShow->num_available; ?>/ <?php echo $adventureShow->num_total; ?></div>
                                            <div class="view"><i class="fa fa-eye"></i> <?php echo $adventureShow->count_views; ?></div>
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                <li><?php echo $adventureShow->genre; ?></li>
                                                <li><?php echo $adventureShow->type; ?></li>
                                            </ul>
                                            <h5><a href="<?php echo APPURL; ?>/anime-details.php?id=<?php echo $adventureShow->id; ?>"><?php echo $adventureShow->title; ?></a></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="recent__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Recently Added Shows</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <!-- <div class="btn__all">
                                    <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div> -->
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach($allRecentlyAddedShows as $recentlyAddedShow) : ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="img/<?php echo $recentlyAddedShow->image; ?>">
                                            <div class="ep"><?php echo $recentlyAddedShow->num_available?> / <?php echo $recentlyAddedShow->num_total?></div>
                                            <div class="view"><i class="fa fa-eye"></i> <?php echo $recentlyAddedShow->count_views; ?></div>
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                <li><?php echo $recentlyAddedShow->genre; ?></li>
                                                <li><?php echo $recentlyAddedShow->type; ?></li>
                                            </ul>
                                            <h5><a href="<?php echo APPURL; ?>/anime-details.php?id=<?php echo $recentlyAddedShow->id; ?>"><?php echo $recentlyAddedShow->title; ?></a></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="live__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Live Action</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="<?php echo APPURL?>/categories.php?name=Action" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach($allActionShows as $actionShow) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/<?php echo $actionShow->image ?>">
                                        <div class="ep"><?php echo $actionShow->num_available ?> / <?php echo $actionShow->num_total ?></div>
                                        <div class="view"><i class="fa fa-eye"></i> <?php echo $actionShow->count_views ?></div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li><?php echo $actionShow->genre ?></li>
                                            <li><?php echo $actionShow->type ?></li>
                                        </ul>
                                        <h5><a href="<?php echo APPURL ?>/anime-details.php?id=<?php echo $actionShow->id ?>"><?php echo $actionShow->title ?></a></h5>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="product__sidebar">
                        <div class="product__sidebar__view">
        </div>
    </div>
    <div class="product__sidebar__comment">
        <div class="section-title">
            <h5>For You</h5>
        </div>
        <?php foreach($allForYouShows as $forYouShow) : ?>
            <div class="product__sidebar__comment__item">
                <div class="product__sidebar__comment__item__pic">
                    <img style="width: 130px; height: 150px;" src="img/<?php echo $forYouShow->image ?>" alt="">
                </div>
                <div class="product__sidebar__comment__item__text">
                    <ul>
                        <li><?php echo $forYouShow->genre ?></li>
                        <li><?php echo $forYouShow->type ?></li>
                    </ul>
                    <h5><a href="<?php echo APPURL ?>/anime-details.php?id=<?php echo $forYouShow->id ?>"><?php echo $forYouShow->title ?></a></h5>
                    <span><i class="fa fa-eye"></i> <?php echo $forYouShow->count_views ?> Views</span>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
</div>
</div>
</div>
</section>
<!-- Product Section End -->

<!-- Footer Section Begin -->
<?php require "includes/footer.php"; ?>