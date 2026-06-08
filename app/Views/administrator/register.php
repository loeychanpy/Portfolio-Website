<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Janisha Jaya Admin</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;600;700&family=Inter:wght@400;500&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/admin-auth.css') ?>" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="fixed inset-0 opacity-[0.03]"
         style="background-image:linear-gradient(rgba(56,222,187,1) 1px,transparent 1px),linear-gradient(90deg,rgba(56,222,187,1) 1px,transparent 1px);background-size:48px 48px;"></div>

    <div class="relative w-full max-w-sm">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white tracking-tight" style="font-family:'Hanken Grotesk',sans-serif;">Janisha Jaya</h1>
            <p class="text-xs text-[#bacac3] opacity-60 mt-1" style="font-family:'JetBrains Mono',monospace;letter-spacing:0.05em;">PORTFOLIO MANAGER</p>
        </div>

        <div class="bg-[#151f37] border border-white/5 rounded-xl p-8 shadow-2xl">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-white" style="font-family:'Hanken Grotesk',sans-serif;">Create Account</h2>
                <p class="text-xs text-[#bacac3] mt-1">Register a new admin account</p>
            </div>

            <?php if (!empty($error)): ?>
            <div class="mb-5 flex items-center gap-3 p-3 rounded-lg bg-red-900/20 border border-red-500/20 text-[#ffb4ab] text-sm">
                <span class="material-symbols-outlined text-[18px]">error</span>
                <?= esc($error) ?>
            </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
            <div class="mb-5 flex items-center gap-3 p-3 rounded-lg bg-[#38debb]/10 border border-[#38debb]/20 text-[#38debb] text-sm">
                <span class="material-symbols-outlined text-[18px]">check_circle</span>
                <?= $success ?>
            </div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('administrator/register') ?>" class="space-y-4">
                <div>
                    <label class="block text-xs text-[#bacac3] uppercase tracking-widest mb-2" style="font-family:'JetBrains Mono',monospace;">Full Name</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#bacac3] text-[18px]">badge</span>
                        <input type="text" name="full_name"
                               class="w-full rounded-lg pl-10 pr-4 py-3 text-sm border"
                               placeholder="Your full name"
                               value="<?= old('full_name') ?>" required>
                    </div>
                </div>
                <div>
                    <label class="block text-xs text-[#bacac3] uppercase tracking-widest mb-2" style="font-family:'JetBrains Mono',monospace;">Username</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#bacac3] text-[18px]">person</span>
                        <input type="text" name="username"
                               class="w-full rounded-lg pl-10 pr-4 py-3 text-sm border"
                               placeholder="Choose a username"
                               value="<?= old('username') ?>" required>
                    </div>
                </div>
                <div>
                    <label class="block text-xs text-[#bacac3] uppercase tracking-widest mb-2" style="font-family:'JetBrains Mono',monospace;">Password</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#bacac3] text-[18px]">lock</span>
                        <input type="password" name="password"
                               class="w-full rounded-lg pl-10 pr-4 py-3 text-sm border"
                               placeholder="Min. 6 characters" required>
                    </div>
                </div>
                <button type="submit"
                        class="w-full py-3 mt-2 rounded-lg bg-[#38debb]/10 border border-[#38debb]/30 text-[#38debb] hover:bg-[#38debb]/20 transition-colors font-semibold text-sm flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">person_add</span>
                    Create Account
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-white/5 text-center">
                <p class="text-xs text-[#bacac3]">
                    Already have an account?
                    <a href="<?= base_url('administrator/login') ?>" class="text-[#38debb] hover:underline">Sign in</a>
                </p>
            </div>
        </div>

    </div>
</body>
</html>
