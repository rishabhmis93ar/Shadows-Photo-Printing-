<?php
$page_title = "Blog";
include_once "../includes/header.php"; ?>

<section class="blog-new">
    <div class="container">
        <div class="blog-new-wrapper">
            <div class="blog-heading">
                <h2>Shadows Photo Printing Blogs </h2>
            </div>

            <div class="kadence-posts">

                <?php
                include_once "../config/config.php";
                include_once "../config/functions.php";
                $result = getAll($conn, 'blogs');
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <article>
                            <a href="single-blog.php?id=<?php echo $row['id']; ?>">
                                <div class="post-thumbnail-inner">
                                    <img src="<?php echo ADMIN_URL; ?>assets/img/<?php echo $row['image']; ?>" alt="jon-tyson">
                                </div>
                            </a>
                            <div class="kadence-posts-content">
                                <div class="kadence-street">
                                    <div class="entry-taxonomies">
                                        <span>
                                            <a href="<?php echo BASE_URL; ?>pages/single-blog.php?id=<?php echo $row['id']; ?>"><?php echo $row['category']; ?></a>
                                        </span>
                                    </div>
                                
                                    <h2><a href="<?php echo BASE_URL; ?>pages/single-blog.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
                                    </h2>
                                    <div class="divider-dot">
                                        <span>By <?php echo $row['author']; ?></span>
                                        <span class=""></span>
                                        <span><?php echo date("F j, Y", strtotime($row['date'])); ?></span>
                                    </div>
                                </div>
                                <div class="entry-summary">
                                    <p><?php echo $row['description']; ?></p>
                                    <div class="read-printing">
                                        <a href="<?php echo BASE_URL; ?>pages/single-blog.php?id=<?php echo $row['id']; ?>"> Read More <i class="fa-solid fa-arrow-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                        </article>
                <?php }
                } ?>
            </div>
        </div>
    </div>
</section>

<?php include_once "../includes/footer.php"; ?>