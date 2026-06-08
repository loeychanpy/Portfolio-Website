<section class="article-detail py-5">
    <div class="container-lg">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('news') ?>">News</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($article['title']) ?></li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-lg-12 ">
                <h1 class="display-5 fw-bold mb-3 article-title"><?= esc($article['title']) ?></h1>
                
                <div class="article-meta mb-4 d-flex align-items-center gap-3">
                    <span class="text-secondary small"><i class="bi bi-calendar-event me-1"></i> <?= date('d F Y', strtotime(esc($article['created_at']))) ?></span>
                    <span class="text-secondary small"><i class="bi bi-person me-1"></i> Admin</span>
                </div>

                <div class="article-body mb-5">
                    <?= nl2br(esc($article['content'])) ?>
                </div>

                <hr class="border-secondary my-5">
                <a href="<?= base_url('news') ?>" class="btn btn-outline-primary"><i class="bi bi-arrow-left me-2"></i>Kembali ke News</a>
            </div>
        </div>
    </div>
</section>
