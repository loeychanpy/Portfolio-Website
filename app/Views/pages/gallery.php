<section class="gallery-section py-5">
    <div class="container-lg">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Photo Gallery</h2>
            <p class="section-subtitle">Moments from my journey in informatics.</p>
            <div class="section-divider mx-auto"></div>
        </div>
        
        <div class="row g-4">
            <?php if (!empty($gallery)): ?>
                <?php foreach ($gallery as $row): ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="gallery-item overflow-hidden rounded shadow-lg border border-secondary">
                            <img src="<?= base_url('assets/images/' . $row['image']) ?>" class="img-fluid w-100 gallery-img h-100 object-fit-cover" alt="<?= esc($row['title']) ?>" style="min-height: 250px;">
                            <div class="gallery-overlay p-3 text-center text-white d-flex flex-column justify-content-center">
                                <h5 class="fw-bold mb-1"><?= esc($row['title']) ?></h5>
                                <p class="small mb-0 opacity-75"><?= esc($row['description']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center"><p>No gallery items found.</p></div>
            <?php endif; ?>
        </div>
    </div>
</section>