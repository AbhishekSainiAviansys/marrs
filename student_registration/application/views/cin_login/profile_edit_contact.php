<?php
/* ---------- Data ---------- */
$s = (isset($student[0]) && is_array($student[0])) ? $student[0] : [];
$val = function ($key) use ($s) {
    return isset($s[$key]) ? html_escape($s[$key]) : '';
};

// Initials for the avatar (first letter of the first two words)
$student_name = isset($s['student_name']) ? trim($s['student_name']) : '';
$initials = '';
foreach (array_slice(preg_split('/\s+/', $student_name, -1, PREG_SPLIT_NO_EMPTY), 0, 2) as $part) {
    $initials .= function_exists('mb_substr')
        ? mb_strtoupper(mb_substr($part, 0, 1, 'UTF-8'), 'UTF-8')
        : strtoupper(substr($part, 0, 1));
}

$flash = $this->session->flashdata('message');
?>
<div class="page-container">

    <?php include('header.php'); ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        .page-container {
            --ink: #0e5695;          /* brand blue */
            --ink-dark: #0b4677;
            --accent: #fd4105;       /* brand orange */
            --text: #16283b;
            --muted: #5b6b7c;
            --rule: #dbe4ee;
            --field-border: #c9d5e2;
            --green: #1c7a4a;
            --green-soft: #e3f4ea;
            --backdrop: #e9f0f7;

            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'DM Sans', system-ui, -apple-system, 'Segoe UI', sans-serif;
            color: var(--text);
        }

        .page-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px 16px 56px;
            background: var(--backdrop);
        }

        /* ---------- Card ---------- */
        .cd-card {
            position: relative;
            width: 100%;
            max-width: 780px;
            padding: 44px 36px 34px;
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(14, 86, 149, .14);
        }
        .cd-card::before {          /* top band, same as the participation slip */
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 8px;
            background: var(--ink);
        }
        .cd-card::after {           /* orange segment on the band */
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 96px; height: 8px;
            background: var(--accent);
        }

        /* ---------- Success message ---------- */
        .cd-alert {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 0 24px;
            padding: 12px 16px;
            border-radius: 10px;
            background: var(--green-soft);
            color: var(--green);
            font-size: 15px;
            font-weight: 600;
        }

        /* ---------- Identity header ---------- */
        .cd-head {
            display: flex;
            align-items: center;
            gap: 16px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--rule);
        }
        .cd-avatar {
            flex: none;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 64px; height: 64px;
            border-radius: 50%;
            background: var(--ink);
            color: #fff;
            border: 3px solid var(--accent);
            font-family: 'Bricolage Grotesque', 'DM Sans', system-ui, sans-serif;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: .02em;
        }
        .cd-name {
            margin: 0 0 2px;
            font-size: 15px;
            font-weight: 500;
            color: var(--muted);
        }
        .cd-title {
            margin: 0;
            font-family: 'Bricolage Grotesque', 'DM Sans', system-ui, sans-serif;
            font-size: 28px;
            line-height: 1.15;
            font-weight: 700;
            letter-spacing: -.01em;
            color: var(--ink);
        }

        /* ---------- Sections and fields ---------- */
        .cd-section { margin: 0; padding: 26px 0 6px; border: 0; min-width: 0; }
        .cd-section + .cd-section { border-top: 1px solid var(--rule); margin-top: 20px; }
        .cd-legend {
            float: none;
            width: auto;
            margin: 0 0 16px;
            padding: 0;
            font-family: 'Bricolage Grotesque', 'DM Sans', system-ui, sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--ink);
        }

        .cd-label {
            display: block;
            margin: 0 0 6px;
            font-size: 14px;
            font-weight: 500;
            color: var(--muted);
        }
        .cd-field { position: relative; }
        .cd-field > i {
            position: absolute;
            top: 50%; left: 15px;
            transform: translateY(-50%);
            font-size: 15px;
            color: var(--muted);
            pointer-events: none;
        }
        .cd-input {
            display: block;
            width: 100%;
            height: 48px;
            padding: 0 14px 0 42px;
            border: 1.5px solid var(--field-border);
            border-radius: 10px;
            background: #fff;
            color: var(--text);
            font: 500 16px/1.2 'DM Sans', system-ui, sans-serif;
            transition: border-color .15s, box-shadow .15s;
        }
        .cd-input:hover { border-color: #9db2c8; }
        .cd-input:focus {
            outline: 0;
            border-color: var(--ink);
            box-shadow: 0 0 0 4px rgba(253, 65, 5, .22);
        }
        .cd-field:focus-within > i { color: var(--ink); }

        /* ---------- Actions ---------- */
        .cd-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
            padding-top: 24px;
            border-top: 1px solid var(--rule);
        }
        .cd-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px 26px;
            border: 2px solid var(--ink);
            border-radius: 10px;
            font: 600 15px/1.2 'DM Sans', system-ui, sans-serif;
            cursor: pointer;
            transition: background-color .15s;
        }
        .cd-btn-primary { background: var(--ink); color: #fff; }
        .cd-btn-primary:hover { background: var(--ink-dark); border-color: var(--ink-dark); }
        .cd-btn-secondary { background: transparent; color: var(--ink); }
        .cd-btn-secondary:hover { background: rgba(14, 86, 149, .08); }
        .cd-btn:focus-visible { outline: 3px solid var(--accent); outline-offset: 2px; }

        /* ---------- Small screens ---------- */
        @media (max-width: 600px) {
            .page-content { padding: 20px 10px 40px; }
            .cd-card { padding: 36px 20px 24px; }
            .cd-title { font-size: 24px; }
            .cd-avatar { width: 54px; height: 54px; font-size: 19px; }
            .cd-actions { flex-direction: column-reverse; }
            .cd-btn { width: 100%; }
        }
    </style>

    <div class="page-content">

        <div class="cd-card">

            <?php if (!empty($flash)) { ?>
                <div class="cd-alert" role="status">
                    <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                    <span><?php echo html_escape($flash); ?></span>
                </div>
            <?php } ?>

            <header class="cd-head">
                <?php if ($initials !== '') { ?>
                    <div class="cd-avatar" aria-hidden="true"><?php echo html_escape($initials); ?></div>
                <?php } ?>
                <div>
                    <p class="cd-name"><?php echo html_escape($student_name); ?></p>
                    <h1 class="cd-title">Contact details</h1>
                </div>
            </header>

            <form method="POST">

                <fieldset class="cd-section">
                    <legend class="cd-legend">Student</legend>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="cd-label" for="stud_email">Student email</label>
                            <div class="cd-field">
                                <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                                <input type="email" class="cd-input" id="stud_email" name="stud_email"
                                       value="<?php echo $val('stud_email'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="cd-label" for="stud_phone">Student phone</label>
                            <div class="cd-field">
                                <i class="fa-solid fa-phone" aria-hidden="true"></i>
                                <input type="tel" inputmode="tel" class="cd-input" id="stud_phone" name="stud_phone"
                                       value="<?php echo $val('stud_phone'); ?>">
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="cd-section">
                    <legend class="cd-legend">Parents</legend>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="cd-label" for="mother_name">Mother name</label>
                            <div class="cd-field">
                                <i class="fa-solid fa-user" aria-hidden="true"></i>
                                <input type="text" class="cd-input" id="mother_name" name="mother_name"
                                       value="<?php echo $val('mother_name'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="cd-label" for="father_name">Father name</label>
                            <div class="cd-field">
                                <i class="fa-solid fa-user" aria-hidden="true"></i>
                                <input type="text" class="cd-input" id="father_name" name="father_name"
                                       value="<?php echo $val('father_name'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="cd-label" for="father_email">Father email</label>
                            <div class="cd-field">
                                <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                                <input type="email" class="cd-input" id="father_email" name="father_email"
                                       value="<?php echo $val('father_email'); ?>">
                            </div>
                        </div>
                    </div>
                </fieldset>

                <div class="cd-actions">
                    <!-- formnovalidate: "To Profile" should work even if an email field is half-typed -->
                    <button type="submit" name="back" formnovalidate class="cd-btn cd-btn-secondary">
                        <i class="fa-solid fa-arrow-left" aria-hidden="true"></i> To Profile
                    </button>
                    <button type="submit" name="submit" class="cd-btn cd-btn-primary">
                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i> Save
                    </button>
                </div>

            </form>

        </div>

    </div>

    <?php include("footer.php"); ?>

</div>