<!DOCTYPE html>
<html lang="en">
<head>
  <title>School Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/choices.js@10.2.0/public/assets/styles/choices.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/choices.js@10.2.0/public/assets/scripts/choices.min.js" defer></script>

  <style>
    :root {
      --ink: #1c2333;
      --ink-soft: #6b7280;
      --line: #e6e9f2;
      --panel: #ffffff;
      --bg: #eef1f8;
      --accent: #3454d1;
      --accent-dark: #263d9e;
      --accent-soft: #eaefff;
      --marrs-orange: #f59f00;
      --ok: #12b76a;
      --radius: 14px;
    }

    * { box-sizing: border-box; }

    body {
      background:
        radial-gradient(1100px 500px at 85% -10%, #dbe4ff 0%, transparent 60%),
        var(--bg);
      font-family: 'Inter', sans-serif;
      color: var(--ink);
      min-height: 100vh;
    }

    h1, h2, h3, .heading-font { font-family: 'Manrope', sans-serif; }

    label {
      font-size: 12px;
      font-weight: 600;
      letter-spacing: .02em;
      text-transform: uppercase;
      color: var(--ink-soft);
      margin-bottom: 4px;
      display: block;
    }

    .form-control, .form-select {
      border: 1.5px solid var(--line);
      border-radius: 9px !important;
      padding: 7px 12px;
      font-size: 14px;
      background: #fbfcff;
      transition: border-color .15s ease, box-shadow .15s ease, background .15s ease;
    }

    .form-control:focus, .form-select:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px var(--accent-soft);
      background: #fff;
    }

    .form-control[readonly], .form-select:disabled {
      background: #f1f3f9;
      color: var(--ink-soft);
      border-style: dashed;
    }

    /* ---------- Choices.js theming ---------- */
    .choices { margin-bottom: 0; font-size: 14px; }

    .choices__inner {
      border: 1.5px solid var(--line) !important;
      border-radius: 9px !important;
      background: #fbfcff !important;
      padding: 6px 8px 4px !important;
      min-height: 0 !important;
    }

    .choices.is-focused .choices__inner,
    .choices.is-open .choices__inner {
      border-color: var(--accent) !important;
      box-shadow: 0 0 0 3px var(--accent-soft);
    }

    .choices__list--dropdown, .choices__list[aria-expanded] {
      border-color: var(--line) !important;
      border-radius: 10px !important;
      box-shadow: 0 12px 30px -10px rgba(28,35,51,.2);
      overflow: hidden;
    }

    .choices__list--dropdown .choices__input {
      border-bottom: 1px solid var(--line) !important;
      background: #fff;
      font-size: 13.5px;
    }

    .choices__list--dropdown .choices__item--selectable.is-highlighted {
      background: var(--accent-soft) !important;
      color: var(--accent-dark) !important;
    }

    .choices__list--single {
      padding: 2px 16px 2px 2px !important;
    }

    .choices[data-type*="select-one"] .choices__inner {
      padding-bottom: 6px !important;
    }

    .choices.is-disabled .choices__inner,
    .choices.is-disabled .choices__list {
      background: #f1f3f9 !important;
      opacity: 1 !important;
    }

    /* ---------- Shell ---------- */
    .shell {
      max-width: 1040px;
      margin: 24px auto;
      display: flex;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 24px 60px -20px rgba(28, 35, 51, 0.25);
      background: var(--panel);
    }

    /* ---------- Left: form ---------- */
    .form-section {
      flex: 1;
      padding: 26px 36px 24px;
      min-width: 0;
    }

    .step-badge {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: .06em;
      background: var(--accent-soft);
      color: var(--accent);
      padding: 4px 10px;
      border-radius: 20px;
      display: inline-block;
    }

    .form-title {
      font-weight: 800;
      font-size: 21px;
      margin: 8px 0 2px;
      color: var(--ink);
    }

    .form-subtitle {
      color: var(--ink-soft);
      font-size: 13px;
      margin-bottom: 12px;
    }

    .progress-bar-custom {
      height: 4px;
      background: var(--line);
      border-radius: 10px;
      margin: 4px 0 18px;
      overflow: hidden;
    }

    .progress-fill {
      width: 25%;
      height: 100%;
      background: linear-gradient(90deg, var(--accent), #6c8bff);
      border-radius: 10px;
    }

    .field-group {
      margin-bottom: 12px;
    }

    .section-divider {
      border: none;
      border-top: 1px dashed var(--line);
      margin: 14px 0 12px;
    }

    .section-label {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: var(--accent);
      margin: 4px 0 10px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .section-label::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--line);
    }

    /* Search box */
    .search-wrap { position: relative; }

    .search-input-inner { position: relative; }

    .search-input-inner .form-control {
      padding-left: 38px;
    }

    .search-icon {
      position: absolute;
      left: 13px;
      top: 50%;
      transform: translateY(-50%);
      width: 16px;
      height: 16px;
      opacity: .45;
      pointer-events: none;
    }

    #searchResults {
      list-style: none;
      padding: 6px;
      margin-top: 6px;
      border: 1px solid var(--line);
      border-radius: 12px;
      max-height: 200px;
      overflow-y: auto;
      display: none;
      position: absolute;
      background: #fff;
      width: 100%;
      z-index: 1000;
      box-shadow: 0 12px 30px -10px rgba(28,35,51,.2);
    }

    #searchResults li {
      padding: 9px 10px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
    }

    #searchResults li:hover {
      background: var(--accent-soft);
      color: var(--accent-dark);
    }

    #selectedNote {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-top: 8px;
      font-size: 13px;
      font-weight: 600;
      color: var(--ok);
    }

    #selectedNote::before {
      content: '✓';
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      background: var(--ok);
      color: #fff;
      font-size: 11px;
    }

    #selectedNote a, #resetSearchBtn {
      color: var(--accent);
      text-decoration: none;
      font-weight: 700;
    }

    /* Manual toggle row */
    .toggle-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #f7f8fc;
      border: 1px solid var(--line);
      border-radius: 10px;
      padding: 8px 14px;
      margin: 10px 0 6px;
    }

    .toggle-row label {
      margin: 0;
      text-transform: none;
      font-size: 13.5px;
      font-weight: 600;
      color: var(--ink);
      letter-spacing: 0;
    }

    .form-check-input {
      width: 2.4em;
      height: 1.3em;
      cursor: pointer;
    }
    .form-check-input:checked {
      background-color: var(--accent);
      border-color: var(--accent);
    }

    .btn-reset {
      border: 1.5px solid var(--line);
      color: var(--ink-soft);
      background: #fff;
      font-weight: 600;
      border-radius: 9px;
      font-size: 13px;
      padding: 7px 14px;
      transition: all .15s ease;
    }
    .btn-reset:hover {
      border-color: #d33;
      color: #d33;
      background: #fff5f5;
    }

    .btn-continue {
      background: linear-gradient(135deg, var(--accent), var(--accent-dark));
      border: none;
      border-radius: 9px;
      color: #fff;
      font-weight: 700;
      font-size: 14px;
      padding: 9px 24px;
      box-shadow: 0 10px 24px -8px rgba(52, 84, 209, .55);
      transition: transform .12s ease, box-shadow .12s ease;
    }
    .btn-continue:hover {
      transform: translateY(-1px);
      box-shadow: 0 14px 28px -8px rgba(52, 84, 209, .6);
      color: #fff;
    }

    .footer-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 16px;
      padding-top: 14px;
      border-top: 1px solid var(--line);
    }

    /* ---------- Right: rail ---------- */
    .info-section {
      width: 300px;
      flex-shrink: 0;
      background:
        radial-gradient(600px 300px at 20% 0%, rgba(255,255,255,.14), transparent 60%),
        linear-gradient(160deg, #1a2559, var(--accent-dark) 65%, var(--accent));
      color: white;
      padding: 28px 26px;
      display: flex;
      flex-direction: column;
    }

    .logo-badge {
      background: #fff;
      border-radius: 16px;
      padding: 10px 14px;
      display: inline-flex;
      align-self: flex-start;
      box-shadow: 0 8px 20px -6px rgba(0,0,0,.35);
    }

    .logo-badge img { max-width: 110px; display: block; }

    .rail-heading {
      margin-top: 20px;
      font-weight: 800;
      font-size: 17px;
      line-height: 1.3;
    }

    .rail-sub {
      font-size: 13px;
      opacity: .78;
      margin-top: 6px;
      line-height: 1.45;
    }

    .steps {
      list-style: none;
      padding: 0;
      margin: 22px 0 0;
      flex: 1;
    }

    .steps li {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      padding: 8px 0;
      opacity: 0.55;
      font-size: 13.5px;
    }

    .steps li .num {
      width: 26px;
      height: 26px;
      border-radius: 50%;
      border: 1.5px solid rgba(255,255,255,.45);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: 700;
      flex-shrink: 0;
    }

    .steps li.active {
      opacity: 1;
      font-weight: 700;
    }

    .steps li.active .num {
      background: #fff;
      color: var(--accent-dark);
      border-color: #fff;
    }

    .steps li.done .num {
      background: rgba(255,255,255,.2);
      border-color: rgba(255,255,255,.6);
    }

    .rail-footer {
      font-size: 12px;
      opacity: .6;
      margin-top: 20px;
    }

    @media (max-width: 860px) {
      .shell { flex-direction: column; margin: 0; border-radius: 0; min-height: 100vh; }
      .info-section { width: 100%; order: -1; padding: 26px 24px; }
      .steps { display: none; }
      .form-section { padding: 28px 22px; }
    }
  </style>
</head>

<body>

<div class="shell">

  <!-- LEFT -->
  <div class="form-section">

    <span class="step-badge">STEP 1 OF 4</span>
    <h1 class="form-title">School details</h1>
    <p class="form-subtitle">Search for your school, or add it manually if it isn't listed yet.</p>

    <div class="progress-bar-custom">
      <div class="progress-fill"></div>
    </div>

    <form method="POST" action="<?php echo base_url('welcome/save'); ?>">
       
      <!-- SEARCH -->
      <div class="field-group search-wrap">
        <label for="schoolSearch">Search school</label>
        <div class="search-input-inner">
          <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
          </svg>
          <input type="text" id="schoolSearch" class="form-control" placeholder="Type school name...">
        </div>
        <ul id="searchResults"></ul>

        <small id="selectedNote" style="display:none;">
          Existing school selected
          <a href="#" id="resetSearchBtn">Reset</a>
        </small>
      </div>

      <div class="toggle-row" id="manuallyDetails">
        <label class="form-check-label" for="manualToggle">School not in the list — enter details manually</label>
        <div class="form-check form-switch mb-0">
          <input class="form-check-input" type="checkbox" id="manualToggle">
        </div>
      </div>

      <input type="hidden" name="school_id" id="school_id">
      <input type="hidden" name="student_id"
        value="<?php echo isset($student_id) ? htmlspecialchars($student_id) : ''; ?>">

      <hr class="section-divider">
      <div class="section-label">School identity</div>

      <div class="row">
        <div class="col-md-6 field-group">
          <label for="school_name">School name</label>
          <input type="text" class="form-control" id="school_name" name="school_name" required>
        </div>

        <div class="col-md-6 field-group">
            <div id="access_code_wrapper" >
          <label for="school_code">School code</label>
          <input type="text" id="school_code" name="school_code" class="form-control " readonly placeholder="Auto-filled" disabled>
          </div>
        </div>
      </div>

      <div class="field-group">
        <label for="school_address">Address</label>
        <input type="text" id="school_address" name="school_address" class="form-control" required>
      </div>

      <div class="section-label">Location</div>

      <div class="row">
        <div class="col-md-4 field-group">
          <label for="country">Country</label>
          <select id="country" name="country" class="form-select">
            <option value="">Select country</option>
            <?php foreach ($countries as $c): ?>
                <option value="<?php echo $c->country_id; ?>">
                    <?php echo htmlspecialchars($c->country_name); ?>
                </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-4 field-group">
          <label for="state">State</label>
          <select id="state" name="state" class="form-select" required>
            <option value="">Select state</option>
            <?php if (!empty($states)): ?>
              <?php foreach ($states as $s): ?>
                <option value="<?php echo $s->state_subdivision_id; ?>"><?php echo htmlspecialchars($s->state_subdivision_name); ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
          <input type="hidden" name="state" id="state_hidden">
        </div>

        <div class="col-md-4 field-group">
          <label for="city">District</label>
          <select id="city" name="city" class="form-select"  disabled>
            <option value="">Select state first</option>
             <?php foreach ($city as $ci): ?>
              <option value="<?php echo $ci->district_name; ?>">
                <?php echo htmlspecialchars($ci->district_name); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 field-group">
          <label for="district">City</label>
          <input type="text" id="district" name="district" class="form-control" readonly  placeholder="Auto-filled from city">
        </div>
        <!-- AFTER -->
        <div class="col-md-3 field-group" id="area_wrapper" style="display:none;">
          <label for="area">Area</label>
          <select id="area_code" name="area_code" class="form-select">
            <option value="">Select Area</option>
            <?php foreach ($area as $a): ?>
                <option value="<?= $a->area_code ?>">
                    <?= $a->city_name . ' (' . $a->area_code . ')' ?>
                </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-3 field-group">
          <label for="pin">Pin code</label>
          <input type="text" id="pin" name="pin" class="form-control" >
        </div>
        <div class="col-md-3 field-group">
          <label for="school_mobile">Mobile</label>
          <input type="text" id="school_mobile" name="school_mobile" class="form-control" required>
        </div>
      </div>

      <div class="section-label">Administration</div>

      <div class="row">
        <div class="col-md-4 field-group">
          <label for="school_principal_name">Principal name</label>
          <input type="text" id="school_principal_name" name="school_principal_name" class="form-control" required>
        </div>
        <div class="col-md-4 form-group">
        <label>Principal Email</label>
        <input type="email"
               name="principal_email"
               id="principal_email"
               class="form-control"
               placeholder="Enter Principal Email">
    </div>
        <div class="col-md-4 field-group">
          <label for="syllabus">Syllabus</label>
          <select id="syllabus" name="school_board" class="form-select" required>
            <option value="">Select syllabus</option>
            <option value="CBSE">CBSE</option>
            <option value="ICSE">ICSE</option>
            <option value="State Board">State Board</option>
            <option value="IB">IB</option>
            <option value="IGCSE">IGCSE</option>
            <option value="Other">Other</option>
          </select>
          <input type="hidden" name="syllabus" id="syllabus_hidden">
        </div>
      </div>

      <div class="footer-actions">
        <button type="button" id="fullResetBtn" class="btn-reset">Reset form</button>
        <button type="submit" class="btn-continue">Continue →</button>
      </div>

    </form>

  </div>

  <!-- RIGHT PANEL -->
  <div class="info-section">
    <div class="logo-badge">
      <img src="https://marrs.in/newassets/marrs_discover_logo.png" alt="logo"/>
    </div>

    <div class="rail-heading">Let's get your school set up</div>
    <div class="rail-sub">A few quick steps and you'll be ready to register students.</div>

    <ul class="steps">
      <li class="active"><span class="num">1</span> School details</li>
      <li><span class="num">2</span> Student information</li>
      <li><span class="num">3</span> Documents</li>
      <li><span class="num">4</span> Review &amp; submit</li>
    </ul>

    <div class="rail-footer">Need help? Contact your area coordinator.</div>
  </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

const baseUrl = '<?php echo base_url(); ?>';

// ---- shared element refs ----
const searchInput = document.getElementById('schoolSearch');
const resultsList = document.getElementById('searchResults');
const selectedNote = document.getElementById('selectedNote');
const resetSearchBtn = document.getElementById('resetSearchBtn');
const countrySelect = document.getElementById('country');
const stateSelect = document.getElementById('state');
const stateHidden = document.getElementById('state_hidden');
const citySelect = document.getElementById('city');
const districtInput = document.getElementById('district');
const syllabusSelect = document.getElementById('syllabus');
const syllabusHidden = document.getElementById('syllabus_hidden');
const toggle = document.getElementById('manualToggle');
const schoolNameWrapper = document.getElementById('schoolNameWrapper');
const schoolNameInput = document.getElementById('school_name');
const fullResetBtn = document.getElementById('fullResetBtn');
const accessCodeField = document.getElementById("access_code_wrapper");
const areaSelect = document.getElementById('area_code');
const areaWrapper = document.getElementById('area_wrapper');

const fillableIds = ['school_name', 'school_code', 'school_address', 'area_code', 'city', 'district', 'pin', 'school_mobile', 'school_principal_name','principal_email'];

// ---- Searchable dropdowns (Choices.js) ----
const countryChoices = new Choices(countrySelect, {
    searchEnabled: true,
    itemSelectText: '',
    shouldSort: false,
    searchPlaceholderValue: 'Search country...'
});

const stateChoices = new Choices(stateSelect, {
    searchEnabled: true,
    itemSelectText: '',
    shouldSort: false,
    searchPlaceholderValue: 'Search state...'
});

const cityChoices = new Choices(citySelect, {
    searchEnabled: true,
    itemSelectText: '',
    shouldSort: false,
    searchPlaceholderValue: 'Search city...'
});
cityChoices.disable();

// ---- Country -> State ----
countrySelect.addEventListener('change', function () {
    const countryId = this.value;

    stateChoices.clearStore();
    stateChoices.setChoices(
        [{ value: '', label: 'Select state', placeholder: true }],
        'value', 'label', true
    );

    cityChoices.clearStore();
    cityChoices.setChoices(
        [{ value: '', label: 'Select state first', placeholder: true }],
        'value', 'label', true
    );
    cityChoices.disable();
    districtInput.value = '';

    if (!countryId) return;

    fetch(baseUrl + 'welcome/get_states?country_id=' + encodeURIComponent(countryId))
        .then(res => res.json())
        .then(states => {
            const choices = [{ value: '', label: 'Select state', placeholder: true }].concat(
                states.map(s => ({ value: String(s.state_subdivision_id), label: s.state_subdivision_name }))
            );
            stateChoices.clearStore();
            stateChoices.setChoices(choices, 'value', 'label', true);
        });
});

// ---- State -> City ----
// stateSelect.addEventListener('change', function () {
//     const stateId = this.value;
//     stateHidden.value = stateId;

//     cityChoices.clearStore();
//     cityChoices.setChoices(
//         [{ value: '', label: 'Select city', placeholder: true }],
//         'value', 'label', true
//     );
//     districtInput.value = '';

//     if (!stateId) {
//         cityChoices.disable();
//         return;
//     }

//     fetch(baseUrl + 'welcome/get_cities?state_id=' + encodeURIComponent(stateId))
//         .then(res => res.json())
//         .then(cities => {
//             const choices = [{ value: '', label: 'Select city', placeholder: true }].concat(
//                 cities.map(c => ({
//                 value: c.district_name,
//                 label: c.district_name,
//                 customProperties: { districtId: c.id }
//             }))
//             );
//             cityChoices.clearStore();
//             cityChoices.setChoices(choices, 'value', 'label', true);
//             cityChoices.enable();
//         });
// });
stateSelect.addEventListener('change', function () {
    const stateId = this.value;
    stateHidden.value = stateId;

    cityChoices.clearStore();
    districtInput.value = '';

    if (!stateId) {
        cityChoices.disable();
        return;
    }

    fetch(baseUrl + 'welcome/get_cities?state_id=' + stateId)
        .then(res => res.json())
        .then(cities => {
            cityChoices.setChoices(
                cities.map(c => ({
                    value: c.district_name,
                    label: c.district_name
                })),
                'value',
                'label',
                true
            );
            cityChoices.enable();
        });
});

citySelect.addEventListener('change', function () {
    districtInput.value = this.value;
});
// ---- City -> District ----
citySelect.addEventListener('change', function () {
    districtInput.value = this.value;
});

// ---- School search ----
let debounceTimer;

searchInput.addEventListener('input', function () {
    const query = this.value.trim();

    // Search box cleared
    if (query === '') {
        schoolNameInput.value = '';
        toggle.checked = false;
        toggleAreaField(); // Hide manual fields
        resultsList.style.display = 'none';
        return;
    }

    clearTimeout(debounceTimer);

    // User is searching again, so turn off manual mode
    if (query.length >= 2) {
        toggle.checked = false;
        toggleAreaField();
    }

    if (query.length < 2) {
        resultsList.style.display = 'none';
        return;
    }

    debounceTimer = setTimeout(() => {
        const url = baseUrl + 'welcome/search?q=' + encodeURIComponent(query);

        fetch(url)
            .then(res => {
                if (!res.ok) {
                    throw new Error('HTTP ' + res.status + ' from ' + url);
                }
                return res.text(); // read as text first so bad JSON doesn't fail silently
            })
            .then(text => {
                let schools;
                try {
                    schools = JSON.parse(text);
                } catch (parseErr) {
                    console.error('Search endpoint did not return valid JSON. Raw response:', text);
                    resultsList.innerHTML = '<li style="cursor:default;color:#d33;">Search error — check console</li>';
                    resultsList.style.display = 'block';
                    return;
                }

                resultsList.innerHTML = '';

//                 if (!Array.isArray(schools) || schools.length === 0) {
//     resultsList.innerHTML = '';
//     resultsList.style.display = 'none';

//     // ✅ Show the "enter details manually" toggle row
//     document.getElementById('manuallyDetails').style.display = 'flex'; // or 'block', match your CSS

//     return;
// }
if (!Array.isArray(schools) || schools.length === 0) {

    resultsList.innerHTML = '';
    resultsList.style.display = 'none';

    // Turn ON manual toggle automatically
    toggle.checked = true;

    // Show manual fields
    toggleAreaField();

    // Fill searched text into School Name
    schoolNameInput.value = query;
    schoolNameInput.readOnly = false;

    // Clear selected school
    document.getElementById('school_id').value = '';

    toggleAccessCode();

    return;
}
                schools.forEach(school => {
                    const li = document.createElement('li');
                    li.textContent = school.school_name;
                    li.onclick = () => selectSchool(school);
                    resultsList.appendChild(li);
                });
                resultsList.style.display = 'block';
            })
            .catch(err => {
                console.error('School search request failed:', err);
                resultsList.innerHTML = '<li style="cursor:default;color:#d33;">Search failed — check console</li>';
                resultsList.style.display = 'block';
            });
    }, 300);
});
// Load areas when state OR city changes
function loadAreas() {

    let state_id    = stateSelect.value;
    let district_id = citySelect.value;

    if (!state_id || !district_id) return;

    fetch(baseUrl + 'welcome/get_areas', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `state_id=${state_id}&district_id=${district_id}`
    })
    .then(res => res.json())
    .then(data => {

        areaSelect.innerHTML = '<option value="">Select Area</option>';
        data.forEach(area => {
            let opt = document.createElement('option');
            opt.value = area.area_code;
            opt.text  = `${area.city_name} (${area.area_code})`;
            areaSelect.appendChild(opt);
        });

    });
}

// Trigger when city changes
citySelect.addEventListener('change', function () {
    document.getElementById('district').value = this.value;
    loadAreas();
});
// function selectSchool(school) {
//     document.getElementById('school_id').value = school.id;
//     searchInput.value = school.school_name;

//     fillableIds.forEach(id => {
//         const el = document.getElementById(id);
//         if (el) {
//             el.value = school[id] || '';
//             el.readOnly = true;
//         }
//     });

//     if (school.state) {
//         stateChoices.setChoiceByValue(String(school.state));
//     }
//     stateChoices.disable();
//     stateHidden.value = school.state || '';

//     syllabusSelect.value = school.syllabus || '';
//     syllabusSelect.disabled = true;
//     syllabusHidden.value = school.syllabus || '';

//     selectedNote.style.display = 'flex';
//     resultsList.style.display = 'none';
// }
function toggleAreaField() {
    if (toggle.checked) {
        areaWrapper.style.display = 'block';
        areaSelect.setAttribute('required', 'required');
    } else {
        areaWrapper.style.display = 'none';
        areaSelect.removeAttribute('required');
        areaSelect.value = '';
    }
}
// ---- School select ----
async function selectSchool(school) {

      // Turn OFF manual mode
    toggle.checked = false;
    toggleAreaField();

  
    document.getElementById('school_id').value = school.id;
    toggleAccessCode();
    searchInput.value = school.school_name;

    fillableIds.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.value = school[id] || '';
            el.readOnly = true;
        }
    });

    // ✅ STEP 1: COUNTRY
    if (school.country) {
        countryChoices.setChoiceByValue(String(school.country));
    }

    // wait for states
    await fetch(baseUrl + 'welcome/get_states?country_id=' + school.country)
        .then(res => res.json())
        .then(states => {
            const choices = [{ value: '', label: 'Select state', placeholder: true }]
                .concat(states.map(s => ({
                    value: String(s.state_subdivision_id),
                    label: s.state_subdivision_name
                })));

            stateChoices.clearStore();
            stateChoices.setChoices(choices, 'value', 'label', true);
        });

    // ✅ STEP 2: STATE
    if (school.state) {
        stateChoices.setChoiceByValue(String(school.state));
    }

    // wait for cities
    await fetch(baseUrl + 'welcome/get_cities?state_id=' + school.state)
        .then(res => res.json())
        .then(cities => {
            const choices = [{ value: '', label: 'Select city', placeholder: true }]
                .concat(cities.map(c => ({
                    value: c.district_name,
                    label: c.district_name,
                    customProperties: { districtId: c.id }
                })));

            cityChoices.clearStore();
            cityChoices.setChoices(choices, 'value', 'label', true);
            cityChoices.enable();
        });

    // ✅ STEP 3: CITY
if (school.city) {
    const cityValue = school.city.toLowerCase().trim();

   const match = cityChoices._store.choices.find(c =>
    c.value.replace(/\s+/g, '').toLowerCase() === 
    school.city.replace(/\s+/g, '').toLowerCase()
);

    if (match) {
        cityChoices.setChoiceByValue(match.value);
    }
}

    stateChoices.disable();
    stateHidden.value = school.state || '';

    syllabusSelect.value = school.syllabus || '';
    syllabusSelect.disabled = true;
    syllabusHidden.value = school.syllabus || '';

    selectedNote.style.display = 'flex';
    resultsList.style.display = 'none';
}
function resetSelection() {
    document.getElementById('school_id').value = '';
    toggleAccessCode();
    searchInput.value = '';

    fillableIds.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.value = '';
            el.readOnly = false;
        }
    });

    stateChoices.enable();
    stateChoices.setChoiceByValue('');
    stateHidden.value = '';

    syllabusSelect.value = '';
    syllabusSelect.disabled = false;
    syllabusHidden.value = '';

    selectedNote.style.display = 'none';
    resultsList.style.display = 'none';
}

resetSearchBtn.onclick = (e) => {
    e.preventDefault();
    resetSelection();
};

// ---- Manual entry toggle ----
// toggle.addEventListener('change', function () {
//     if (this.checked) {
//         resetSelection();
//         toggleAccessCode();
//         toggleAreaField();
//         schoolNameWrapper.style.display = 'block';
//         schoolNameInput.readOnly = false;
//         schoolNameInput.value = '';
//     } else {
//         schoolNameWrapper.style.display = 'none';
//         schoolNameInput.value = '';
//     }
// });
toggle.addEventListener('change', function () {

    if (this.checked) {

        resetSelection();
        toggleAccessCode();
        toggleAreaField();

        if (schoolNameWrapper) {
            schoolNameWrapper.style.display = 'block';
        }

        schoolNameInput.readOnly = false;

        // Fill school name from search box if empty
        if (!schoolNameInput.value.trim()) {
            schoolNameInput.value = searchInput.value.trim();
        }

    } else {

        if (schoolNameWrapper) {
            schoolNameWrapper.style.display = 'none';
        }

        schoolNameInput.value = '';
    }

});
schoolNameWrapper.style.display = 'none';

// ---- Full form reset ----
fullResetBtn.addEventListener('click', function () {
    document.querySelector('form').reset();
    resetSelection();
    toggle.checked = false;
    toggleAreaField();
    if (schoolNameWrapper) schoolNameWrapper.style.display = 'none';   // guarded
    countryChoices.setChoiceByValue('');
    cityChoices.clearStore();
    cityChoices.setChoices(
        [{ value: '', label: 'Select state first', placeholder: true }],
        'value', 'label', true
    );
    cityChoices.disable();
    districtInput.value = '';
});
// ✅ DEFAULT INDIA
setTimeout(() => {
    countryChoices.setChoiceByValue('105');
    countrySelect.dispatchEvent(new Event('change'));
}, 300);
function toggleAccessCode() {
    const schoolId = document.getElementById('school_id').value;
    const accessCodeField = document.getElementById('access_code_wrapper');

    if (schoolId && schoolId !== "") {
        accessCodeField.style.display = "block";
    } else {
        accessCodeField.style.display = "none";
    }
}
toggleAreaField();
});

// end DOMContentLoaded
</script>

</body>
</html>