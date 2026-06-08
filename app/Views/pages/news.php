<section class="news-section py-5">
    <div class="container-lg">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Latest Articles</h2>
            <p class="section-subtitle">Read my latest thoughts and updates.</p>
            <div class="section-divider mx-auto"></div>
        </div>
        
        <div class="row">
            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $row): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card news-card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><?= esc($row['title']) ?></h5>
                                <p class="card-text text-secondary"><?= esc(substr($row['content'], 0, 150)) ?>...</p>
                                <a href="<?= base_url('article/' . $row['id']) ?>" class="btn btn-sm btn-outline-primary">Read More</a>
                            </div>
                            <div class="card-footer text-muted border-secondary small">
                                Posted on <?= date('d M Y', strtotime($row['created_at'])) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center"><p>No articles found.</p></div>
            <?php endif; ?>
        </div>
    </div>
</section>