<section class="gallery-section py-5">
    <div class="container-lg">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Photo Gallery</h2>
            <p class="section-subtitle">Moments from my journey in informatics.</p>
            <div class="section-divider mx-auto"></div>
        </div>

        <?php if (!empty($gallery)): ?>
            <div class="gallery-grid" id="galleryGrid">
                <?php foreach ($gallery as $i => $row): ?>
                    <div class="glb-card"
                         data-index="<?= $i ?>"
                         data-src="<?= base_url('assets/images/' . $row['image']) ?>"
                         data-title="<?= esc($row['title']) ?>"
                         data-desc="<?= esc($row['description']) ?>"
                         tabindex="0"
                         role="button"
                         aria-label="View <?= esc($row['title']) ?>">
                        <img src="<?= base_url('assets/images/' . $row['image']) ?>"
                             alt="<?= esc($row['title']) ?>"
                             loading="lazy">
                        <div class="glb-overlay">
                            <i class="bi bi-arrows-fullscreen glb-icon"></i>
                            <p class="glb-overlay-title"><?= esc($row['title']) ?></p>
                            <p class="glb-overlay-desc"><?= esc($row['description']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="gallery-empty">
                <i class="bi bi-images"></i>
                <p>No gallery items found.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- LIGHTBOX -->
<div id="glb-lightbox" role="dialog" aria-modal="true" aria-label="Image lightbox">

    <div class="glb-lb-topbar">
        <span class="glb-lb-counter" id="glbCounter"></span>
        <button class="glb-lb-close" id="glbClose" aria-label="Close lightbox">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <button class="glb-lb-arrow glb-lb-prev" id="glbPrev" aria-label="Previous image">
        <i class="bi bi-chevron-left"></i>
    </button>

    <div class="glb-lb-main">
        <div class="glb-lb-img-wrap">
            <img src="" alt="" id="glbImage">
        </div>
        <div class="glb-lb-caption" id="glbCaption">
            <h4 id="glbTitle"></h4>
            <p id="glbDesc"></p>
        </div>
    </div>

    <button class="glb-lb-arrow glb-lb-next" id="glbNext" aria-label="Next image">
        <i class="bi bi-chevron-right"></i>
    </button>

    <div class="glb-lb-dots" id="glbDots"></div>
</div>

