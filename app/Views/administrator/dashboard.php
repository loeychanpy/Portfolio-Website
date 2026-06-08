<!-- Stats Bento Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="card-lift bg-surface-container p-6 rounded-xl border border-outline-variant/10 hover:border-primary-fixed-dim/30 transition-all">
        <div class="flex justify-between items-start mb-4">
            <div class="w-10 h-10 rounded-lg bg-primary-fixed-dim/10 flex items-center justify-center text-primary-fixed-dim">
                <span class="material-symbols-outlined">article</span>
            </div>
            <span class="text-xs text-primary-fixed-dim bg-primary-fixed-dim/10 px-2 py-1 rounded" style="font-family:'JetBrains Mono',monospace;">ARTICLES</span>
        </div>
        <h3 class="text-xs text-on-surface-variant uppercase tracking-widest mb-1" style="font-family:'JetBrains Mono',monospace;">Total Articles</h3>
        <p class="text-[32px] font-bold text-primary leading-none" style="font-family:'Hanken Grotesk',sans-serif;"><?= $article_count ?></p>
        <a href="<?= base_url('administrator/articles') ?>" class="inline-flex items-center gap-1 mt-4 text-xs text-primary-fixed-dim hover:underline" style="font-family:'JetBrains Mono',monospace;">
            Manage <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
        </a>
    </div>

    <div class="card-lift bg-surface-container p-6 rounded-xl border border-outline-variant/10 hover:border-primary-fixed-dim/30 transition-all">
        <div class="flex justify-between items-start mb-4">
            <div class="w-10 h-10 rounded-lg bg-secondary-container flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined">photo_library</span>
            </div>
            <span class="text-xs text-on-surface-variant" style="font-family:'JetBrains Mono',monospace;">GALLERY</span>
        </div>
        <h3 class="text-xs text-on-surface-variant uppercase tracking-widest mb-1" style="font-family:'JetBrains Mono',monospace;">Total Photos</h3>
        <p class="text-[32px] font-bold text-primary leading-none" style="font-family:'Hanken Grotesk',sans-serif;"><?= $gallery_count ?></p>
        <a href="<?= base_url('administrator/gallery') ?>" class="inline-flex items-center gap-1 mt-4 text-xs text-secondary hover:underline" style="font-family:'JetBrains Mono',monospace;">
            Manage <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
        </a>
    </div>

    <div class="card-lift bg-surface-container p-6 rounded-xl border border-outline-variant/10 hover:border-primary-fixed-dim/30 transition-all">
        <div class="flex justify-between items-start mb-4">
            <div class="w-10 h-10 rounded-lg bg-tertiary-container/30 flex items-center justify-center text-tertiary-fixed-dim">
                <span class="material-symbols-outlined">mail</span>
            </div>
            <span class="text-xs text-on-surface-variant" style="font-family:'JetBrains Mono',monospace;">INBOX</span>
        </div>
        <h3 class="text-xs text-on-surface-variant uppercase tracking-widest mb-1" style="font-family:'JetBrains Mono',monospace;">Messages</h3>
        <p class="text-[32px] font-bold text-primary leading-none" style="font-family:'Hanken Grotesk',sans-serif;"><?= $message_count ?></p>
        <a href="<?= base_url('administrator/messages') ?>" class="inline-flex items-center gap-1 mt-4 text-xs text-tertiary-fixed-dim hover:underline" style="font-family:'JetBrains Mono',monospace;">
            View All <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
        </a>
    </div>

</div>

<!-- Main Workspace Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Recent Messages Table -->
    <div class="lg:col-span-2 bg-surface-container rounded-xl border border-outline-variant/10 overflow-hidden">
        <div class="p-6 border-b border-outline-variant/10 flex justify-between items-center">
            <h2 class="text-[20px] font-semibold text-primary" style="font-family:'Hanken Grotesk',sans-serif;">Recent Messages</h2>
            <a href="<?= base_url('administrator/messages') ?>" class="text-xs text-primary-fixed-dim flex items-center gap-1 hover:underline" style="font-family:'JetBrains Mono',monospace;">
                View all <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-high/30">
                        <th class="p-4 text-xs text-on-surface-variant uppercase tracking-widest" style="font-family:'JetBrains Mono',monospace;">Name</th>
                        <th class="p-4 text-xs text-on-surface-variant uppercase tracking-widest" style="font-family:'JetBrains Mono',monospace;">Email</th>
                        <th class="p-4 text-xs text-on-surface-variant uppercase tracking-widest" style="font-family:'JetBrains Mono',monospace;">Date</th>
                        <th class="p-4 text-xs text-on-surface-variant uppercase tracking-widest text-right" style="font-family:'JetBrains Mono',monospace;">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10">
                    <?php foreach ($recent_messages as $row): ?>
                    <tr class="hover:bg-surface-variant/20 transition-colors">
                        <td class="p-4 text-sm font-medium text-primary"><?= esc($row['name']) ?></td>
                        <td class="p-4 text-xs text-on-surface-variant" style="font-family:'JetBrains Mono',monospace;"><?= esc($row['email']) ?></td>
                        <td class="p-4 text-xs text-on-surface-variant"><?= date('d M Y', strtotime($row['sent_at'])) ?></td>
                        <td class="p-4 text-right">
                            <a href="<?= base_url('administrator/messages/' . $row['id']) ?>"
                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary-fixed-dim/10 text-primary-fixed-dim hover:bg-primary-fixed-dim/20 transition-colors">
                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($recent_messages)): ?>
                    <tr>
                        <td colspan="4" class="p-8 text-center text-xs text-on-surface-variant" style="font-family:'JetBrains Mono',monospace;">No messages yet.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-surface-container rounded-xl border border-outline-variant/10 p-6">
        <h2 class="text-xs text-on-surface-variant uppercase tracking-widest mb-4" style="font-family:'JetBrains Mono',monospace;">Quick Actions</h2>
        <div class="grid grid-cols-1 gap-3">
            <a href="<?= base_url('administrator/articles/new') ?>"
               class="flex items-center gap-3 p-3 rounded-lg border border-primary-fixed-dim/30 hover:bg-primary-fixed-dim/5 transition-all text-primary-fixed-dim group">
                <span class="material-symbols-outlined p-2 rounded-md bg-primary-fixed-dim/10 group-hover:bg-primary-fixed-dim/20">add_circle</span>
                <div>
                    <p class="font-bold text-sm">New Article</p>
                    <p class="text-[11px] opacity-60">Write &amp; publish content</p>
                </div>
            </a>
            <a href="<?= base_url('administrator/gallery/new') ?>"
               class="flex items-center gap-3 p-3 rounded-lg border border-outline-variant/30 hover:bg-surface-variant/30 transition-all text-on-surface group">
                <span class="material-symbols-outlined p-2 rounded-md bg-surface-container-high group-hover:bg-surface-container-highest">upload_file</span>
                <div>
                    <p class="font-bold text-sm">Upload Photo</p>
                    <p class="text-[11px] opacity-60">Add to gallery</p>
                </div>
            </a>
            <a href="<?= base_url('administrator/messages') ?>"
               class="flex items-center gap-3 p-3 rounded-lg border border-outline-variant/30 hover:bg-surface-variant/30 transition-all text-on-surface group">
                <span class="material-symbols-outlined p-2 rounded-md bg-surface-container-high group-hover:bg-surface-container-highest">inbox</span>
                <div>
                    <p class="font-bold text-sm">View Messages</p>
                    <p class="text-[11px] opacity-60">Check your inbox</p>
                </div>
            </a>
        </div>
    </div>

</div>
