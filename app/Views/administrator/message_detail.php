<!-- Page Header -->
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-[24px] font-bold text-primary" style="font-family:'Hanken Grotesk',sans-serif;">Message</h1>
        <p class="text-xs text-on-surface-variant mt-1" style="font-family:'JetBrains Mono',monospace;">Message detail</p>
    </div>
    <a href="<?= base_url('administrator/messages') ?>"
       class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-outline-variant/40 text-on-surface-variant hover:bg-surface-container hover:text-primary transition-colors text-sm">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span> Back to Inbox
    </a>
</div>

<!-- Message Detail Card -->
<div class="bg-surface-container rounded-xl border border-outline-variant/10 p-6">

    <!-- Sender Info -->
    <div class="flex items-start justify-between pb-5 mb-5 border-b border-outline-variant/10">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-secondary font-bold text-base flex-shrink-0"
                 style="font-family:'JetBrains Mono',monospace;">
                <?= strtoupper(substr($msg['name'], 0, 2)) ?>
            </div>
            <div>
                <p class="text-base font-semibold text-primary" style="font-family:'Hanken Grotesk',sans-serif;"><?= esc($msg['name']) ?></p>
                <p class="text-xs text-primary-fixed-dim mt-0.5" style="font-family:'JetBrains Mono',monospace;"><?= esc($msg['email']) ?></p>
            </div>
        </div>
        <div class="text-right">
            <p class="text-xs text-on-surface-variant" style="font-family:'JetBrains Mono',monospace;">
                <?= date('l, d F Y · H:i', strtotime($msg['sent_at'])) ?>
            </p>
            <p class="text-sm font-semibold text-primary mt-1"><?= esc($msg['subject']) ?></p>
        </div>
    </div>

    <!-- Message Body -->
    <div class="text-sm text-on-surface leading-relaxed whitespace-pre-line mb-8">
        <?= esc($msg['message']) ?>
    </div>

    <!-- Reply Button -->
    <a href="mailto:<?= esc($msg['email']) ?>?subject=Re:+<?= urlencode($msg['subject']) ?>"
       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary-fixed-dim/10 border border-primary-fixed-dim/30 text-primary-fixed-dim hover:bg-primary-fixed-dim/20 transition-colors font-semibold text-sm">
        <span class="material-symbols-outlined text-[18px]">reply</span>
        Reply via Email
    </a>
</div>
