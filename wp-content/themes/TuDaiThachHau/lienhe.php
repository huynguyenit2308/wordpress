<?php get_header(); 
/* Template Name: lienhe */
?>
<!-- ------------------------------ CONTENT ------------------------------ -->
<div class="header">
    <div class="header">
        <div class="inspiration_pd">
            <ul class="nav-first">
                <div class="sidebar">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>

                            <?php get_template_part('content/formlienhe'); ?>

                            <!-- Bình luận -->
                            <div class="comment-section">
                                <!-- Form nhập bình luận mới -->
                                <div class="comment-form">
                                    <input id="nameInput" type="text" placeholder="Tên của bạn" required>
                                    <textarea id="commentInput" rows="4" placeholder="Viết bình luận của bạn..." required></textarea>
                                    <!-- Gửi bình luận -->
                                    <button onclick="submitComment()">Gửi bình luận</button>
                                </div>
                                <div id="comments-list">
                                    <div class="comment">
                                        <span class="user-info"></span>
                                        <span class="date"></span>
                                        <p class="text"></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>

            </ul>
        </div>
    </div>
</div>
</main>
<!-- ------------------------------ FOOTER ------------------------------ -->

<?php get_footer(); ?>