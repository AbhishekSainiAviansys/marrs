<?php $this->load->view('headernew.php'); ?>

<style>
* { box-sizing: border-box; }

.cin-page {
    min-height: 85vh;
    /*background: linear-gradient(135deg, #fff8f3 0%, #f7f8fc 100%);*/
    padding: 60px 16px;
}

/* ── Hero heading ── */
.cin-hero {
    text-align: center;
    margin-bottom: 40px;
}
.cin-hero h1 {
    font-size: 32px;
    font-weight: 800;
    color: #1a1a2e;
    margin: 0 0 10px;
}
.cin-hero p {
    color: #777;
    font-size: 16px;
    margin: 0;
}
.cin-hero span {
    color: #e87722;
}

/* ── Search card ── */
.search-card {
    background: #fff;
    border-radius: 20px;
    padding: 36px 40px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.09);
    max-width: 860px;
    margin: 0 auto 32px;
}
.search-row {
    display: flex;
    gap: 14px;
    align-items: center;
    flex-wrap: wrap;
}
.search-input {
    flex: 2;
    min-width: 220px;
    padding: 13px 18px;
    border: 2px solid #eee;
    border-radius: 12px;
    font-size: 15px;
    color: #1a1a2e;
    outline: none;
    transition: border-color 0.2s;
}
.search-input:focus {
    border-color: #e87722;
    box-shadow: 0 0 0 3px rgba(232,119,34,0.12);
}
.search-select {
    flex: 1;
    min-width: 120px;
    padding: 13px 18px;
    border: 2px solid #eee;
    border-radius: 12px;
    font-size: 15px;
    color: #1a1a2e;
    outline: none;
    background: #fff;
    cursor: pointer;
    transition: border-color 0.2s;
}
.search-select:focus {
    border-color: #e87722;
    box-shadow: 0 0 0 3px rgba(232,119,34,0.12);
}
.search-btn {
    flex: 0 0 auto;
    padding: 13px 36px;
    background: #e87722;
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
    display: flex;
    align-items: center;
    gap: 8px;
}
.search-btn:hover  { background: #cf6610; transform: translateY(-1px); }
.search-btn:active { transform: translateY(0); }

/* ── Info chips ── */
.info-chips {
    display: flex;
    justify-content: center;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 32px;
}
.chip {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #fff;
    border: 1px solid #f0e8e0;
    border-radius: 50px;
    padding: 8px 18px;
    font-size: 13px;
    color: #555;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
.chip svg { color: #e87722; }

/* ── Flash messages ── */
.alert-box {
    max-width: 860px;
    margin: 0 auto 24px;
    padding: 14px 18px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 14px;
}
.alert-error   { background: #fff0f0; border: 1px solid #ffcccc; color: #c62828; }
.alert-success { background: #f0fff4; border: 1px solid #b2dfdb; color: #1b5e20; }

/* ── Result card ── */
.result-card {
    background: #fff;
    border-radius: 20px;
    padding: 32px 36px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.09);
    max-width: 860px;
    margin: 0 auto;
}
.result-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 12px;
}
.result-title {
    font-size: 18px;
    font-weight: 700;
    color: #1a1a2e;
    display: flex;
    align-items: center;
    gap: 8px;
}
.result-badge {
    background: #fff4e5;
    color: #e87722;
    border: 1px solid #f5d9b8;
    border-radius: 50px;
    padding: 4px 14px;
    font-size: 13px;
    font-weight: 600;
}

/* ── Table ── */
.cin-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 4px;
}
.cin-table thead tr {
    background: linear-gradient(90deg, #e87722, #f5a05a);
    color: #fff;
}
.cin-table thead th {
    padding: 13px 16px;
    text-align: left;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.4px;
    text-transform: uppercase;
}
.cin-table thead th:first-child { border-radius: 10px 0 0 10px; }
.cin-table thead th:last-child  { border-radius: 0 10px 10px 0; }
.cin-table tbody tr {
    border-bottom: 1px solid #f5f5f5;
    transition: background 0.15s;
}
.cin-table tbody tr:last-child { border-bottom: none; }
.cin-table tbody tr:hover { background: #fff8f3; }
.cin-table td {
    padding: 13px 16px;
    font-size: 14px;
    color: #333;
    vertical-align: middle;
}
.cin-badge {
    display: inline-block;
    background: #fff4e5;
    color: #e87722;
    border: 1px solid #f5d9b8;
    border-radius: 8px;
    padding: 5px 12px;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.5px;
}

/* ── Empty / default state ── */
.empty-state {
    text-align: center;
    padding: 60px 20px;
}
.empty-icon {
    width: 80px;
    height: 80px;
    background: #fff4e5;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}
.empty-state h3 { font-size: 20px; color: #1a1a2e; margin: 0 0 8px; }
.empty-state p  { color: #999; font-size: 14px; margin: 0 0 24px; }

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 24px;
    border: 2px solid #e87722;
    border-radius: 10px;
    color: #e87722;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
}
.back-btn:hover {
    background: #e87722;
    color: #fff;
}

/* ── OTP sent notice ── */
.otp-notice {
    background: linear-gradient(135deg, #fff4e5, #fff8f0);
    border: 1px solid #f5d9b8;
    border-radius: 12px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    font-size: 14px;
    color: #7a4210;
}

@media (max-width: 600px) {
    .search-card  { padding: 24px 18px; }
    .result-card  { padding: 20px 14px; }
    .search-row   { flex-direction: column; }
    .search-btn   { width: 100%; justify-content: center; }
    .cin-hero h1  { font-size: 24px; }
}
</style>

<div class="cin-page">

    <!-- Hero -->
    <div class="cin-hero">
        <h1>Find Your <span>CIN</span></h1>
        <p>Enter your registered email or mobile number to retrieve your Candidate Identification Number</p>
    </div>

    <!-- Info chips -->
    <div class="info-chips">
        <div class="chip">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#e87722" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l10 7 10-7"/>
            </svg>
            Search by Email
        </div>
        <div class="chip">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#e87722" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.13 1.22 2 2 0 012.11 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.09a16 16 0 006 6l.45-.45a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
            </svg>
            Search by Mobile
        </div>
        <div class="chip">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#e87722" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>
            OTP Verified & Secure
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert-box alert-error" style="max-width:860px;margin:0 auto 24px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#e53935" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert-box alert-success" style="max-width:860px;margin:0 auto 24px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2e7d32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0">
                <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- Search Card -->
    <div class="search-card">
        <form class="search-row" method="POST">
            <input
                type="text"
                class="search-input"
                name="value"
                placeholder="✉ Email or 📱 Mobile (without +91)"
                value="<?php echo isset($result['value']) ? htmlspecialchars($result['value']) : ''; ?>"
            >
            <select name="year" class="search-select" required>
                <?php
                $years = ['26'=>'2026','25'=>'2025','24'=>'2024','23'=>'2023','22'=>'2022'];
                
                
                foreach ($years as $val => $label):
                    $sel = (isset($result['year']) && $result['year'] == $val) ? 'selected' : '';
                ?>
                    <option value="<?= $val ?>" <?= $sel ?>><?= $label ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="submit" class="search-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                Search
            </button>
        </form>
    </div>

    <!-- Result Card -->
   
</div>

<?php include("footernew.php"); ?>