<?php $this->load->view('headernew.php'); ?>

<div style="min-height:70vh;display:flex;align-items:center;justify-content:center;background:#f7f8fc;padding:40px 16px;">
    <div style="background:#fff;border-radius:16px;box-shadow:0 4px 24px rgba(0,0,0,0.10);padding:48px 40px;max-width:460px;width:100%;text-align:center;">

        <!-- Icon -->
        <div style="width:72px;height:72px;background:#fff4e5;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#e87722" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2"/>
                <path d="M2 7l10 7 10-7"/>
            </svg>
        </div>

        <!-- Title -->
        <h2 style="margin:0 0 8px;font-size:26px;font-weight:700;color:#1a1a2e;">Email Verification</h2>
        <p style="color:#666;font-size:15px;margin:0 0 6px;">A 6-digit OTP has been sent to</p>
        <p style="color:#e87722;font-weight:600;font-size:15px;margin:0 0 28px;word-break:break-all;">
            <?= htmlspecialchars($email_masked) ?>
        </p>

        <!-- Flash Error -->
        <?php if ($this->session->flashdata('error')): ?>
            <div style="background:#fff0f0;border:1px solid #ffcccc;border-radius:8px;padding:12px 16px;margin-bottom:20px;display:flex;align-items:center;gap:10px;text-align:left;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#e53935" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <span style="color:#c62828;font-size:14px;"><?= $this->session->flashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <!-- Inline Error -->
        <?php if (isset($error)): ?>
            <div style="background:#fff0f0;border:1px solid #ffcccc;border-radius:8px;padding:12px 16px;margin-bottom:20px;display:flex;align-items:center;gap:10px;text-align:left;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#e53935" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <span style="color:#c62828;font-size:14px;"><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <!-- OTP Form -->
        <form method="POST" action="<?= base_url('welcome/verify_otp') ?>" id="otp-form">

            <!-- 6 OTP boxes (also submitted as array fallback) -->
            <div style="display:flex;justify-content:center;gap:10px;margin-bottom:28px;" id="otp-boxes">
                <?php for ($i = 0; $i < 6; $i++): ?>
                <input
                    type="text"
                    name="otp_box[]"
                    maxlength="1"
                    inputmode="numeric"
                    pattern="[0-9]"
                    autocomplete="<?= $i === 0 ? 'one-time-code' : 'off' ?>"
                    class="otp-input"
                    style="width:48px;height:56px;text-align:center;font-size:24px;font-weight:700;border:2px solid #ddd;border-radius:10px;outline:none;color:#1a1a2e;"
                >
                <?php endfor; ?>
            </div>

            <!-- Hidden combined OTP field -->
            <input type="hidden" name="otp" id="otp-hidden">

            <!-- Timer -->
            <p style="color:#999;font-size:13px;margin:0 0 24px;">
                OTP expires in <span id="countdown" style="color:#e87722;font-weight:600;">10:00</span>
            </p>

            <!-- Submit -->
            <button
                type="submit"
                id="verify-btn"
                style="width:100%;padding:14px;background:#e87722;color:#fff;border:none;border-radius:10px;font-size:16px;font-weight:600;cursor:pointer;letter-spacing:0.5px;"
                onmouseover="this.style.background='#cf6610'"
                onmouseout="this.style.background='#e87722'"
            >
                Verify OTP
            </button>

        </form>

        <!-- Divider -->
        <div style="display:flex;align-items:center;gap:12px;margin:24px 0;">
            <div style="flex:1;height:1px;background:#eee;"></div>
            <span style="color:#bbb;font-size:13px;">or</span>
            <div style="flex:1;height:1px;background:#eee;"></div>
        </div>

        <!-- Back link -->
        <a href="<?= base_url('welcome/check_cin') ?>"
           style="display:inline-flex;align-items:center;gap:6px;color:#e87722;font-size:14px;font-weight:500;text-decoration:none;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#e87722" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Search again
        </a>

        <p style="color:#bbb;font-size:12px;margin:20px 0 0;">
            Didn't receive the OTP? Check your spam folder or search again.
        </p>

    </div>
</div>

<script>
const inputs  = document.querySelectorAll('.otp-input');
const hidden  = document.getElementById('otp-hidden');
const form    = document.getElementById('otp-form');

inputs[0].focus();

inputs.forEach((input, i) => {

    input.addEventListener('focus', () => {
        input.style.borderColor = '#e87722';
        input.style.boxShadow   = '0 0 0 3px rgba(232,119,34,0.15)';
    });

    input.addEventListener('blur', () => {
        input.style.borderColor = input.value ? '#e87722' : '#ddd';
        input.style.boxShadow   = 'none';
    });

    input.addEventListener('input', () => {
        input.value = input.value.replace(/\D/g, ''); // digits only
        if (input.value && i < inputs.length - 1) {
            inputs[i + 1].focus();
        }
    });

    input.addEventListener('keydown', e => {
        if (e.key === 'Backspace' && !input.value && i > 0) {
            inputs[i - 1].focus();
            inputs[i - 1].value = '';
        }
    });

    // Paste support
    input.addEventListener('paste', e => {
        e.preventDefault();
        const pasted = (e.clipboardData || window.clipboardData)
                        .getData('text').replace(/\D/g, '').slice(0, 6);
        pasted.split('').forEach((ch, j) => {
            if (inputs[j]) inputs[j].value = ch;
        });
        const next = inputs[Math.min(pasted.length, 5)];
        if (next) next.focus();
    });
});

// On submit — combine boxes into hidden field
form.addEventListener('submit', e => {
    const otp = Array.from(inputs).map(el => el.value.trim()).join('');
    hidden.value = otp;

    if (otp.length < 6) {
        e.preventDefault();
        const empty = Array.from(inputs).findIndex(el => !el.value);
        if (empty !== -1) inputs[empty].focus();
    }
});

// Countdown timer
let seconds = 600;
const cd    = document.getElementById('countdown');
const btn   = document.getElementById('verify-btn');

const timer = setInterval(() => {
    seconds--;
    const m = String(Math.floor(seconds / 60)).padStart(2, '0');
    const s = String(seconds % 60).padStart(2, '0');
    cd.textContent = m + ':' + s;

    if (seconds <= 60) cd.style.color = '#e53935';

    if (seconds <= 0) {
        clearInterval(timer);
        cd.textContent      = '00:00';
        cd.style.color      = '#e53935';
        btn.disabled        = true;
        btn.style.background = '#ccc';
        btn.style.cursor    = 'not-allowed';
        btn.textContent     = 'OTP Expired';
    }
}, 1000);
</script>

<?php include("footernew.php"); ?>