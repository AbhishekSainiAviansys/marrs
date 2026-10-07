<?php
/*
 * MaRRS Lunar — Program Management
 * Controller: Lunar::schedule_lunar
 * Supplies: $message, $periodload, $result
 *
 * AJAX base: manage/lunar/
 *  ajax_programs_list / ajax_programs_save / ajax_programs_delete
 *  ajax_components_list / ajax_components_save / ajax_components_delete
 *  ajax_plans_list / ajax_plans_save / ajax_plans_delete / ajax_plans_toggle
 *  ajax_modules_upload
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Lunar Admin — Program Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap 5.3 (latest) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
:root{
  --brand:#4f46e5; --brand-2:#7c3aed; --ink:#1e293b; --muted:#64748b;
  --line:#e6e9f2; --bg:#f3f5fb; --radius:14px;
  --shadow:0 1px 2px rgba(16,24,40,.05),0 6px 20px rgba(16,24,40,.06);
  --bs-primary:#4f46e5; --bs-primary-rgb:79,70,229; --bs-link-color:#4f46e5;
}
body{margin:0;background:var(--bg);color:var(--ink);
  font-family:Inter,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;-webkit-font-smoothing:antialiased}

/* ── Sidebar (CSS only, HTML unchanged) ── */
.app-sidebar{
  width:250px;min-height:100vh;
  display:flex;flex-direction:column;
  background:
    radial-gradient(420px 260px at 0% 0%, rgba(124,58,237,.35), transparent 60%),
    radial-gradient(360px 260px at 100% 100%, rgba(79,70,229,.30), transparent 60%),
    linear-gradient(180deg,#1e1b4b 0%,#0f172a 100%)!important;
  border-right:1px solid rgba(255,255,255,.06);
  box-shadow:4px 0 24px rgba(15,23,42,.18);
}

/* Logo area */
.app-sidebar > div{
  padding:1rem!important;
  border-bottom:1px solid rgba(255,255,255,.08)!important;
}
.app-sidebar > div img{
  width:100%;height:auto;border-radius:12px!important;
  border:1px solid rgba(255,255,255,.12);
  box-shadow:0 6px 18px rgba(0,0,0,.35);
}

/* "Main Menu" label (generated, no HTML needed) */
.app-sidebar .nav::before{
  content:"MAIN MENU";
  display:block;padding:.6rem .5rem .5rem;
  font-size:.68rem;font-weight:700;letter-spacing:.14em;
  color:#fff;
}
.app-sidebar .nav{padding:.75rem!important;gap:.25rem}

/* Links */
.app-sidebar .nav-link{
  position:relative;color:rgba(255,255,255,.75);
  font-weight:500;font-size:.92rem;
  border-radius:12px;padding:.7rem .85rem;
  transition:all .2s ease;
}
.app-sidebar .nav-link i{
  width:32px;height:32px;flex-shrink:0;
  display:inline-flex;align-items:center;justify-content:center;
  border-radius:9px;background:rgba(255,255,255,.08);
  font-size:1rem;transition:.2s;
}
.app-sidebar .nav-link:hover{
  background:rgba(255,255,255,.08);color:#fff;transform:translateX(3px);
}
.app-sidebar .nav-link:hover i{background:rgba(255,255,255,.15)}

/* Active link */
.app-sidebar .nav-link.active{
  color:#fff;
  background:linear-gradient(135deg,var(--brand),var(--brand-2));
  box-shadow:0 8px 20px rgba(79,70,229,.45);
}
.app-sidebar .nav-link.active i{background:rgba(255,255,255,.22)}
.app-sidebar .nav-link.active::before{
  content:"";position:absolute;left:-.5rem;top:22%;bottom:22%;width:4px;
  border-radius:0 4px 4px 0;background:#fff;
  box-shadow:0 0 12px rgba(255,255,255,.7);
}

/* Footer card (generated) */
.app-sidebar::after{
  content:"● Lunar Console";
  margin:auto .75rem .75rem;padding:.75rem 1rem;
  border-radius:14px;
  background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.08);
  color:rgba(255,255,255,.6);
  font-size:.78rem;font-weight:600;letter-spacing:.04em;
}

.avatar-circle{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;
  background:linear-gradient(135deg,var(--brand),var(--brand-2))!important;box-shadow:0 4px 10px rgba(79,70,229,.35)}
/* ── Header / cards ── */
.bg-white.border-bottom{box-shadow:0 1px 0 var(--line),0 4px 14px rgba(16,24,40,.04);position:sticky;top:0;z-index:100}
.card{border:1px solid var(--line);border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden}
.card-header{border-bottom:1px solid var(--line);padding:1rem 1.25rem}
.card-body{padding:1.25rem}

/* ── Forms ── */
.form-label{font-weight:600;font-size:.85rem;color:#334155;margin-bottom:.35rem}
.form-control,.form-select{border:1px solid #d8dcea;border-radius:10px;padding:.55rem .8rem;background-color:#fff;transition:border-color .15s,box-shadow .15s}
.form-control-sm,.form-select-sm{padding:.35rem .6rem;border-radius:8px}
.form-control:focus,.form-select:focus{border-color:var(--brand);box-shadow:0 0 0 .22rem rgba(79,70,229,.15)}
.input-group>.form-control,.input-group>.form-select{border-radius:10px 0 0 10px}
.input-group>.btn{border-radius:0 10px 10px 0}
.form-check-input:checked{background-color:var(--brand);border-color:var(--brand)}
.form-check-input:focus{box-shadow:0 0 0 .22rem rgba(79,70,229,.15);border-color:var(--brand)}

/* ── Buttons ── */
.btn{border-radius:10px;font-weight:600;transition:all .15s}
.btn-primary{background:linear-gradient(135deg,var(--brand),var(--brand-2));border:0;box-shadow:0 4px 12px rgba(79,70,229,.3)}
.btn-primary:hover,.btn-primary:focus{background:linear-gradient(135deg,#4338ca,#6d28d9);transform:translateY(-1px);box-shadow:0 8px 18px rgba(79,70,229,.35)}
.btn-outline-primary{color:var(--brand);border-color:var(--brand)}
.btn-outline-primary:hover{background:var(--brand);border-color:var(--brand)}
.btn-outline-secondary{border-color: #F44336;
    color: #F44336; font-weight:800 !important}
.btn-outline-secondary:hover{border-color: #F44336 !important;
    color: #F44336 !important;background:#fff !important;}
.btn-sm{border-radius:8px}

/* ── Tables ── */
.table{--bs-table-hover-bg:#f5f6ff}
.table thead th,.table-light{background: #683fea !important;
    color: #ffffff;
    font-size: .80rem;
    text-transform: uppercase;
    letter-spacing: .05em;
    font-weight: 700;
    border-bottom: 1px solid var(--line);
    font-weight: 700;}
.table td,.table th{padding:.8rem 1rem;border-color:#eef0f7}
#prog-tbody tr{transition:background .12s}
.badge{font-weight:600;padding:.4em .75em}
.badge.text-bg-success{background:#dcfce7!important;color:#15803d!important}
.badge.text-bg-secondary{background:#e9ecf3!important;color:#64748b!important}

/* ── Flash messages ── */
#flash-ok,#flash-err{position:fixed!important;top:20px!important;right:20px!important;left:auto!important;
  z-index:2147483647!important;max-width:420px!important;border:0;border-radius:12px;
  box-shadow:0 12px 32px rgba(0,0,0,.2)!important;font-weight:500}

/* ═════════ MODALS ═════════ */
.modal-backdrop{--bs-backdrop-bg:#0f172a;--bs-backdrop-opacity:.55;backdrop-filter:blur(3px)}
.modal-content{border:0;border-radius:18px;box-shadow:0 30px 70px rgba(15,23,42,.35);overflow:hidden}
.modal-header{background:linear-gradient(135deg,#f8f9ff,#eef0ff);border-bottom:1px solid var(--line);padding:1.1rem 1.5rem}
.modal-title{font-weight:700;color:var(--ink)}
.modal-body{padding:1.5rem;background:#fff}
.modal-footer{background:#f8f9fd;border-top:1px solid var(--line);padding:.9rem 1.5rem}
.btn-close{background-color:#fff;border-radius:50%;padding:.55rem;opacity:.7;box-shadow:0 1px 3px rgba(0,0,0,.12)}
.btn-close:hover{opacity:1}

/* Nested modals: stack in proper order (later opened = higher) */
#modal-add-program{z-index:1055}
#modal-manage{z-index:1055}
#modal-component,#modal-plan{z-index:1065}
#modal-master-data{z-index:1075}

/* Dim + lock whichever modal sits underneath so they never blend */
body:has(#modal-component.show) #modal-manage .modal-content,
body:has(#modal-plan.show) #modal-manage .modal-content,
body:has(#modal-master-data.show) #modal-add-program .modal-content,
body:has(#modal-master-data.show) #modal-component .modal-content{
  filter:brightness(.55) blur(1.5px);pointer-events:none;transform:scale(.985);transition:.2s}
#modal-component .modal-content,#modal-plan .modal-content,#modal-master-data .modal-content{
  box-shadow:0 0 0 1px rgba(79,70,229,.25),0 40px 90px rgba(15,23,42,.55)}

/* ── App-specific toggles (unchanged behaviour) ── */
.prog-section,.upload-tab-panel,.test-details-section,.md-section{display:none}
.prog-section.active,.upload-tab-panel.active,.md-section.active{display:block}

/* Tabs & pills */
.nav-tabs{border-bottom:1px solid var(--line)}
.nav-tabs .nav-link{border:0;color:var(--muted);font-weight:600;border-bottom:2px solid transparent;border-radius:0}
.nav-tabs .nav-link:hover{color:var(--brand)}
.nav-tabs .nav-link.active{color:var(--brand);border-bottom-color:var(--brand);background:transparent}
.nav-pills .nav-link{border-radius:10px;font-weight:600;color:var(--muted)}
.nav-pills .nav-link.active{background:linear-gradient(135deg,var(--brand),var(--brand-2));color:#fff}

/* Dashed drop zones, progress, misc */
/*.border-dashed{border-style:dashed!important}*/
.progress{border-radius:99px;background:#e9ecf6}
.progress-bar{background:linear-gradient(90deg,var(--brand),var(--brand-2))!important}
.bg-light{background:#f8f9fd!important}
.table-responsive{scrollbar-width:thin}
::-webkit-scrollbar{width:9px;height:9px}
::-webkit-scrollbar-thumb{background:#cfd4e6;border-radius:99px}
</style>
</head>
<body>
<div class="d-flex">

  <!-- ── Sidebar ── -->
  <nav class="app-sidebar bg-dark flex-shrink-0 sticky-top" data-bs-theme="dark" style="height:100vh">
    <div class="px-2 py-2 text-white fw-bold border-bottom border-secondary-subtle">
     <a class="navbar-brand" href="#">
              <img src="https://marrs.in/student_registration/certificate_logo/flunar.jpg" class="img-fluid d-inline-block align-text-top rounded-2" alt="image" width="220">
                </a>
    </div>
    <ul class="nav nav-pills flex-column p-2">
      <li class="nav-item">
        <a href="#" class="nav-link active d-flex align-items-center gap-2" id="nav-program-management" onclick="showMasterTab('program'); return false;">
          <i class="bi bi-grid-fill"></i> Program Management
        </a>
      </li>
    </ul>
  </nav>

  <!-- ── Body ── -->
  <div class="flex-grow-1 min-vw-0">

    <!-- Page header -->
    <div class="bg-white border-bottom d-flex align-items-center justify-content-between px-4 py-3">
      <div class="d-flex align-items-center gap-3">
        <button class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center border-1 gap-1" onclick="history.back()">
          <i class="bi bi-arrow-left"></i> Back
        </button>
        <div>
          <h1 class="h4 fw-bold mb-0">Program Management</h1>
         
        </div>
      </div>
      <div class="d-flex align-items-center gap-2">
        <span class="fw-semibold small">Admin</span>
        <div class="avatar-circle bg-primary text-white">A</div>
      </div>
    </div>

    <!-- Page content -->
    <div class="p-4" id="program-management-panel">

      <!-- Flash -->
      <style>
        #flash-ok,
        #flash-err {
          position: fixed !important;
          top: 20px !important;
          right: 20px !important;
          left: auto !important;
          z-index: 2147483647 !important;
          max-width: 420px !important;
          box-shadow: 0 8px 24px rgba(0,0,0,0.18) !important;
        }
      </style>
      <div class="alert alert-success d-none" id="flash-ok" role="alert"></div>
      <div class="alert alert-danger d-none" id="flash-err" role="alert"></div>

      <!-- Row: Add button -->
      <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary d-inline-flex align-items-center gap-2" onclick="openAddProgram()">
          <i class="bi bi-plus-lg"></i> Add Program
        </button>
      </div>

      <!-- ── Filter card ── -->
      <div class="card mb-3">
        <div class="card-header bg-white d-flex align-items-center justify-content-between">
          <div>
            <h2 class="h6 fw-bold mb-0">Search Programs</h2>
            <div class="text-muted small">Use the filters below to find a program.</div>
          </div>
          <button class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1" onclick="resetFilters()">
            <i class="bi bi-arrow-clockwise"></i> Reset
          </button>
        </div>
        <div class="card-body">
          <div class="row g-3 mb-3">
            <div class="col-6 col-md-4 col-lg-2">
              <label class="form-label small text-uppercase text-muted fw-semibold">Subject</label>
              <select class="form-select" id="f-subject1">
                <option value="">All Subjects</option>
                <?php foreach ($subjects as $s): ?>
                  <option value="<?= html_escape($s->sub_name) ?>"><?= html_escape($s->sub_name) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
              <label class="form-label small text-uppercase text-muted fw-semibold">Domain</label>
              <select class="form-select" id="f-domain1" >
                <option value="">All Domains</option>
                <?php //foreach ($domains as $d): ?>
                  <!--<option value="<?= html_escape($d->category_name) ?>"><?= html_escape($d->category_name) ?></option>-->
                <?php //endforeach; ?>
              </select>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
              <label class="form-label small text-uppercase text-muted fw-semibold">Applicable For</label>
              <select class="form-select" id="f-grade">
                <option value="">All</option>
                <option>Preschool</option><option>Grades 1-12</option><option>Adults</option>
              </select>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
              <label class="form-label small text-uppercase text-muted fw-semibold">Season</label>
              <select class="form-select" id="f-season">
                <option value="">All Seasons</option>
              </select>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
              <label class="form-label small text-uppercase text-muted fw-semibold">Status</label>
              <select class="form-select" id="f-status">
                <option value="">All Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
              <label class="form-label small text-uppercase text-muted fw-semibold">Academic Year</label>
              <select class="form-select" id="f-year">
                <option value="">All Academic Years</option>
                <?php foreach ($academic_years as $ay): ?>
                  <option value="<?= html_escape($ay->academic_year) ?>"><?= html_escape($ay->academic_year) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="row g-3 align-items-end">
            <div class="col-md-10">
              <label class="form-label small text-uppercase text-muted fw-semibold">Search</label>
              <input type="text" class="form-control" id="f-search" placeholder="Program name..." onkeydown="if(event.key==='Enter'){event.preventDefault();doSearch();}">
            </div>
            <div class="col-md-2">
              <button class="btn btn-primary w-100 d-inline-flex align-items-center justify-content-center gap-2" onclick="doSearch()">
                <i class="bi bi-search"></i> Search
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- ── Program list table (entire card hidden until a search is run) ── -->
      <div class="card d-none" id="program-list-card">
        <div class="card-header bg-white d-flex align-items-center justify-content-between">
          <div>
            <h2 class="h6 fw-bold mb-0">Program List</h2>
            <div class="text-muted small">Click a program to manage its components, plans and learning materials.</div>
          </div>
          <span class="badge text-bg-light border" id="prog-count">0 Programs</span>
        </div>
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>Program Name</th><th>Subject</th><th>Domain</th>
                <th>Applicable For</th><th>Season</th><th>Academic Year</th>
                <th>Status</th><th>Actions</th>
              </tr>
            </thead>
            <tbody id="prog-tbody">
            </tbody>
          </table>
        </div>
      </div>

    </div><!-- /page content -->

    <div class="p-4 d-none" id="product-management-panel">
      <div class="card">
        <div class="card-header bg-white">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item"><a href="#" class="nav-link active" id="product-tab-link" onclick="showProductTab('products'); return false;">Add Subject</a></li>
            <li class="nav-item"><a href="#" class="nav-link" id="category-tab-link" onclick="showProductTab('categories'); return false;">Subject Category</a></li>
          </ul>
        </div>
        <div class="card-body">
          <div id="product-tab-panel">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h2 class="h6 fw-bold mb-0">Subjects</h2>
              <button class="btn btn-primary btn-sm" onclick="openProductForm()"><i class="bi bi-plus-lg"></i> Add Subject</button>
            </div>
            <form id="product-form" class="row g-3 border rounded p-3 mb-4 d-none" onsubmit="saveProduct(event)">
              <input type="hidden" id="product-id">
              <div class="col-md-8"><label class="form-label">Subject Name <span class="text-danger">*</span></label><input class="form-control" id="product-name" required></div>
              <div class="col-md-2"><label class="form-label">Status</label><select class="form-select" id="product-status"><option>Active</option><option>Inactive</option></select></div>
              <div class="col-md-2 d-flex align-items-end gap-2"><button class="btn btn-primary" type="submit">Save</button><button class="btn btn-outline-secondary" type="button" onclick="closeProductForm()">Cancel</button></div>
            </form>
            <div class="table-responsive"><table class="table table-hover align-middle"><thead class="table-light"><tr><th>Subject</th><th>Status</th><th>Actions</th></tr></thead><tbody id="product-tbody"></tbody></table></div>
          </div>
          <div id="category-tab-panel" class="d-none">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h2 class="h6 fw-bold mb-0">Subject Categories</h2>
              <button class="btn btn-primary btn-sm" onclick="openCategoryForm()"><i class="bi bi-plus-lg"></i> Add Category</button>
            </div>
            <form id="category-form" class="row g-3 border rounded p-3 mb-4 d-none" onsubmit="saveProductCategory(event)">
              <input type="hidden" id="category-id">
              <div class="col-md-5"><label class="form-label">Subject <span class="text-danger">*</span></label><select class="form-select" id="category-subject" required></select></div>
              <div class="col-md-4"><label class="form-label">Category Name <span class="text-danger">*</span></label><input class="form-control" id="category-name" required></div>
              <div class="col-md-2"><label class="form-label">Status</label><select class="form-select" id="category-status"><option>Active</option><option>Inactive</option></select></div>
              <div class="col-md-2 d-flex align-items-end gap-2"><button class="btn btn-primary" type="submit">Save</button><button class="btn btn-outline-secondary" type="button" onclick="closeCategoryForm()">Cancel</button></div>
            </form>
            <div class="table-responsive"><table class="table table-hover align-middle"><thead class="table-light"><tr><th>Subject / Category</th><th>Status</th><th>Actions</th></tr></thead><tbody id="category-tbody"></tbody></table></div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /body -->
</div><!-- /d-flex -->


<!-- ══════════════════════════════════════════
     MODAL: Add / Edit Program
══════════════════════════════════════════ -->
<div class="modal fade" id="modal-add-program" tabindex="-1">
   <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div>
          <h5 class="modal-title" id="add-prog-title">Add Program</h5>
          <div class="text-muted small" id="add-prog-sub">&nbsp;</div>
        </div>
        <button type="button" class="btn-close" onclick="closeModal('modal-add-program')"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="ap-id">
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label">Program Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="ap-name" placeholder="e.g. Mathematics Mastery">
          </div>
          <div class="col-12">
          <label class="form-label">Description</label>
          <textarea
            class="form-control"
            id="ap-description"
            rows="4"
            placeholder="Enter a brief description of the program..."
          ></textarea>
        </div>
          <div class="col-md-6">
            <label class="form-label">Subject <span class="text-danger">*</span></label>
            <div class="input-group">
              <select class="form-select" id="ap-subject" onchange="onProgramSubjectChange()">
                <option value="">-- Select Subject --</option>
                <?php foreach ($subjects as $s): ?>
                  <option value="<?= html_escape($s->sub_name) ?>"><?= html_escape($s->sub_name) ?></option>
                <?php endforeach; ?>
              </select>
              <button class="btn btn-outline-primary" type="button" title="Add new subject" onclick="openMasterData('subjects')"><i class="bi bi-plus-lg"></i></button>
            </div>
          </div>
          <div class="col-md-6">
            <label class="form-label">Domain</label>
            <div class="input-group">
              <select class="form-select" id="ap-domain">
                <option value="">-- Select Subject first --</option>
              </select>
              <button class="btn btn-outline-primary" type="button" title="Add new domain" onclick="openMasterData('domains')"><i class="bi bi-plus-lg"></i></button>
            </div>
          </div>
          <div class="col-md-6">
  <label class="form-label">Applicable For <span class="text-danger">*</span></label>
  <div class="border rounded-3 px-3 py-2 d-flex flex-wrap gap-3" id="ap-applicable-group">
    <div class="form-check mb-0">
      <input class="form-check-input ap-applicable-opt" type="checkbox" value="Preschool" id="ap-app-preschool" onchange="toggleProgramGradeFields()">
      <label class="form-check-label" for="ap-app-preschool">Preschool</label>
    </div>
    <div class="form-check mb-0">
      <input class="form-check-input ap-applicable-opt" type="checkbox" value="Grades" id="ap-app-grades" onchange="toggleProgramGradeFields()">
      <label class="form-check-label" for="ap-app-grades">Grade Range</label>
    </div>
    <div class="form-check mb-0">
      <input class="form-check-input ap-applicable-opt" type="checkbox" value="Adults" id="ap-app-adults" onchange="toggleProgramGradeFields()">
      <label class="form-check-label" for="ap-app-adults">Adults</label>
    </div>
  </div>
</div>
          <div class="col-md-6">
            <label class="form-label">Grade From</label>
            <select class="form-select" id="ap-grade-from" disabled></select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Grade To</label>
            <select class="form-select" id="ap-grade-to" disabled></select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Season</label>
            <select class="form-select" id="ap-season">
              <option value="">-- Select Season --</option>
              <?php for($s=1;$s<=12;$s++) echo "<option value='$s'>Season $s</option>"; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Academic Year</label>
            <select class="form-select" id="ap-year">
              <option value="">-- Select Academic Year --</option>
              <?php foreach ($academic_years as $ay): ?>
                <option value="<?= html_escape($ay->academic_year) ?>"><?= html_escape($ay->academic_year) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6 d-flex align-items-end">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="ap-status" checked>
              <label class="form-check-label" for="ap-status">Activate Program</label>
            </div>
          </div>
          <div class="col-12">
            <div class="form-section-label fw-semibold text-uppercase small text-muted mt-2 mb-1">Revenue split</div>
          </div>
          <div class="col-md-3">
            <label class="form-label">Management % </label>
            <select class="form-select" id="ap-management-percentage">
              <option value="">-- select --</option>
              <?php foreach ([5,6,7,8,9,10,12,14,15,16,18,20,22] as $p): ?>
                <option value="<?= $p ?>"><?= $p ?>%</option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-3">
            <label class="form-label">Aviansys % </label>
            <select class="form-select" id="ap-aviansys-percentage">
              <option value="">-- select --</option>
              <?php foreach ([5,6,7,8,9,10,12,14,15,16,18,20,22] as $p): ?>
                <option value="<?= $p ?>"><?= $p ?>%</option>
              <?php endforeach; ?>
            </select>
          </div>
           <div class="col-md-3">
            <label class="form-label">Maker % </label>
            <select class="form-select" id="ap-maker-percentage">
              <option value="">-- select --</option>
              <?php foreach ([5,6,7,8,9,10,12,14,15,16,18,20,22] as $p): ?>
                <option value="<?= $p ?>"><?= $p ?>%</option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-3">
          <label class="form-label">IT %</label>
          <select class="form-select" id="ap-it-percentage">
            <option value="">-- select --</option>
            <?php foreach ([5,6,7,8,9,10,12,14,15,16,18,20,22] as $p): ?>
              <option value="<?= $p ?>"><?= $p ?>%</option>
            <?php endforeach; ?>
          </select>
        </div>
          <div class="col-12">
            <label class="form-label">Upload Syllabus</label>
            <input type="file" class="form-control" id="ap-syllabus" accept=".pdf,.doc,.docx,.xls,.xlsx">
            <div id="ap-syllabus-current" class="small mt-2 d-none"></div>
            <div class="form-text">Supported: PDF, Word and Excel files.</div>
          </div>
          <div class="col-12">
            <label class="form-label">Upload Test Schedule</label>
            <input type="file" class="form-control" id="ap-test-schedule" accept=".pdf,.doc,.docx,.xls,.xlsx">
            <div id="ap-test-schedule-current" class="small mt-2 d-none"></div>
            <div class="form-text">Supported: PDF, Word and Excel files.</div>
          </div>
          <div class="col-12">
            <label class="form-label">Upload What You Get</label>
            <input type="file" class="form-control" id="ap-what-you-get" accept=".pdf">
            <div id="ap-what-you-get-current" class="small mt-2 d-none"></div>
            <div class="form-text">Supported: PDF only.</div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary" onclick="closeModal('modal-add-program')">Cancel</button>
        <button class="btn btn-primary d-inline-flex align-items-center gap-2" onclick="saveProgram()">
          <i class="bi bi-save"></i> Save Program
        </button>
      </div>
    </div>
  </div>
</div>


<!-- ══════════════════════════════════════════
     MODAL: Program Management (components/plans/materials)
══════════════════════════════════════════ -->
<div class="modal fade" id="modal-manage" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div>
          <h5 class="modal-title mb-0">Program Management</h5>
          <div class="text-muted small">Manage components, plans and learning materials.</div>
        </div>
        <button type="button" class="btn-close" onclick="closeModal('modal-manage')"></button>
      </div>
      <div class="modal-body">

        <!-- Program info row -->
        <div class="d-flex justify-content-between align-items-start pb-3 mb-3 border-bottom">
          <div>
            <div class="h5 fw-bold mb-1" id="mg-prog-name">—</div>
            <div class="text-muted small">
              <span id="mg-prog-subject"></span>
              <span id="mg-prog-domain"></span>
              <span id="mg-prog-grade"></span>
              <span id="mg-prog-season"></span>
              <span id="mg-prog-year"></span>
            </div>
          </div>
          <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1" onclick="editCurrentProgram()">
              <i class="bi bi-pencil"></i> Edit Program
            </button>
            <button class="btn btn-outline-danger btn-sm d-inline-flex align-items-center gap-1" onclick="deleteCurrentProgram()">
              <i class="bi bi-trash"></i> Delete
            </button>
          </div>
        </div>

        <!-- Function selector -->
        <div class="row g-3 align-items-end mb-4">
          <div class="col-md-8">
            <label class="form-label small text-uppercase text-muted fw-semibold">Program Function</label>
            <select class="form-select" id="prog-func-select" onchange="onFuncChange()">
              <option value="">-- Select Program Function --</option>
              <option value="components">Add Components</option>
              <option value="plans">Add Plans</option>
              <option value="materials">Upload Learning Materials</option>
              <option value="material_types">Add Material Type</option>
            </select>
          </div>
          <div class="col-md-4 text-muted small d-flex align-items-center gap-2">
            <i class="bi bi-info-circle"></i>
            Selected: <strong id="mg-func-label">-</strong>
          </div>
        </div>

        <!-- ── Section: Components ── -->
        <div class="prog-section" id="sec-components">
          <div class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">
            <div>
              <h3 class="h6 fw-bold mb-0">Components</h3>
              <div class="text-muted small">Add, edit and delete components for this program.</div>
            </div>
            <button class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1" onclick="openAddComponent()">
              <i class="bi bi-plus-lg"></i> Add Component
            </button>
          </div>
          <div class="table-responsive">
            <table class="table table-sm table-hover align-middle">
              <thead class="table-light"><tr><th>Component</th><th>Domain</th><th>Price</th><th>Status</th><th>Actions</th></tr></thead>
              <tbody id="comp-tbody">
                <tr><td colspan="5" class="text-center text-muted py-4">No components yet.</td></tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- ── Section: Plans ── -->
        <div class="prog-section" id="sec-plans">
          <div class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">
            <div>
              <h3 class="h6 fw-bold mb-0">Plans</h3>
              <div class="text-muted small">Manage plans for the selected program.</div>
            </div>
            <button class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1" onclick="openAddPlan()">
              <i class="bi bi-plus-lg"></i> Add Plan
            </button>
          </div>
          <div class="table-responsive">
            <table class="table table-sm table-hover align-middle">
              <thead class="table-light"><tr><th>Plan Name</th><th>Plan Type</th><th>Price</th><th>Duration</th><th>Status</th><th>Actions</th></tr></thead>
              <tbody id="plan-tbody">
                <tr><td colspan="6" class="text-center text-muted py-4">No plans yet.</td></tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- ── Section: Learning Materials ── -->
        <div class="prog-section" id="sec-materials">
          <div class="pb-2 mb-3 border-bottom">
            <h3 class="h6 fw-bold mb-0">Upload Learning Materials</h3>
            <div class="text-muted small">Select a unit range and upload individual files for each selected unit.</div>
          </div>

          <!-- Upload tabs -->
          <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
              <a class="nav-link upload-tab active" href="#" onclick="event.preventDefault();setUploadTab('individual',this)">Individual Upload</a>
            </li>
            <li class="nav-item">
              <a class="nav-link upload-tab" href="#" onclick="event.preventDefault();setUploadTab('zip',this)">ZIP Upload</a>
            </li>
            <li class="nav-item">
              <a class="nav-link upload-tab" href="#" onclick="event.preventDefault();setUploadTab('view',this)">View Upload</a>
            </li>
          </ul>

          <!-- Tab: Individual -->
          <div class="upload-tab-panel active" id="utab-individual">
            <div class="row g-3 mb-3">
              <div class="col-md-3">
                <label class="form-label small text-uppercase text-muted fw-semibold">From Unit</label>
                <input type="number" class="form-control" id="ul-from" min="1" max="365" placeholder="1 - 365" oninput="renderUnitFields()">
              </div>
              <div class="col-md-3">
                <label class="form-label small text-uppercase text-muted fw-semibold">To Unit</label>
                <input type="number" class="form-control" id="ul-to" min="1" max="365" placeholder="1 - 365" oninput="renderUnitFields()">
              </div>
              <div class="col-md-3">
                <label class="form-label small text-uppercase text-muted fw-semibold">Class</label>
                <select class="form-select" id="ul-class-number">
                  <option value="0">All</option>
                  <option value="-3">Nursery</option>
                  <option value="-2">LKG</option>
                  <option value="-1">UKG</option>
                  <?php for ($g = 1; $g <= 12; $g++): ?>
                    <option value="<?= $g ?>">Class-<?= $g ?></option>
                  <?php endfor; ?>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label small text-uppercase text-muted fw-semibold">Component</label>
                <select class="form-select" id="ul-component">
                  <option value="">Select Component</option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label small text-uppercase text-muted fw-semibold">Material Maker</label>
                <select class="form-select" id="ul-material-maker">
                  <option value="">-- Select Material Maker --</option>
                </select>
              </div>
            </div>
            <div id="unit-fields-wrap">
              <div class="border border-2 border-dashed rounded-3 p-4 text-center text-muted bg-light">
                <div class="fw-semibold text-secondary mb-1">Select From Unit and To Unit</div>
                Unit-wise upload fields will appear here.
              </div>
            </div>
            <div class="mt-3 text-end">
              <button class="btn btn-primary d-inline-flex align-items-center gap-2" onclick="uploadSelectedUnitFiles()">
                <i class="bi bi-upload"></i> Upload Selected Files
              </button>
            </div>
          </div>

          <!-- Tab: ZIP -->
          <div class="upload-tab-panel" id="utab-zip">
            <div class="row g-3 mb-3">
              <div class="col-md-3">
                <label class="form-label small text-uppercase text-muted fw-semibold">From Unit</label>
                <input type="number" class="form-control" id="ul-zip-from" min="1" max="365" placeholder="1 - 365" oninput="renderZipFields()">
              </div>
              <div class="col-md-3">
                <label class="form-label small text-uppercase text-muted fw-semibold">To Unit</label>
                <input type="number" class="form-control" id="ul-zip-to" min="1" max="365" placeholder="1 - 365" oninput="renderZipFields()">
              </div>
             
              <div class="col-md-3">
                <label class="form-label small text-uppercase text-muted fw-semibold">Component</label>
                <select class="form-select" id="ul-zip-component">
                  <option value="">Select Component</option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label small text-uppercase text-muted fw-semibold">Material Maker</label>
                <select class="form-select" id="ul-zip-material-maker">
                  <option value="">-- Select Material Maker --</option>
                </select>
              </div>
            </div>
            <div id="zip-fields-wrap">
              <div class="border border-2 border-dashed rounded-3 p-4 text-center text-muted bg-light">
                <div class="fw-semibold text-secondary mb-1">Select From Unit and To Unit</div>
                ZIP upload fields will appear here — each unit gets its own Class dropdown.
              </div>
            </div>
            <!-- NEW: progress bar -->
              <div id="zip-upload-progress-wrap" class="mt-3 d-none">
                <div class="d-flex justify-content-between small text-muted mb-1">
                  <span id="zip-upload-progress-label">Uploading…</span>
                  <span id="zip-upload-progress-pct">0%</span>
                </div>
                <div class="progress" style="height:8px;">
                  <div id="zip-upload-progress-bar"
                       class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                       role="progressbar" style="width:0%"></div>
                </div>
              </div>
            <div class="mt-3 text-end">
              <button class="btn btn-primary d-inline-flex align-items-center gap-2" onclick="uploadSelectedZipFiles()">
                <i class="bi bi-upload"></i> Upload ZIP Files
              </button>
            </div>
          </div>

          <div class="upload-tab-panel" id="utab-view">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-3">
              <div>
                <h6 class="fw-bold mb-0">Uploaded Files</h6>
                <div class="text-muted small">View uploaded material program-wise.</div>
              </div>
              <div class="d-flex align-items-end gap-2">
                <div>
                  <label class="form-label small text-uppercase text-muted fw-semibold mb-1">Program</label>
                  <select class="form-select form-select-sm" id="upl-view-program" style="min-width:240px;"
                          onchange="onUploadViewProgramChange(this.value)"></select>
                </div>
                <button class="btn btn-outline-secondary btn-sm" onclick="loadComponentUploads();">
                  Refresh
                </button>
              </div>
            </div>
            <!-- Upload filters -->
<div class="row g-2 align-items-end mb-3" id="upl-filter-row">
  <div class="col-6 col-md-2">
    <label class="form-label small text-uppercase text-muted fw-semibold mb-1">Component</label>
    <select class="form-select form-select-sm" id="upl-f-component" onchange="renderUploadView()">
      <option value="">All</option>
    </select>
  </div>
  <div class="col-6 col-md-2">
    <label class="form-label small text-uppercase text-muted fw-semibold mb-1">Class</label>
    <select class="form-select form-select-sm" id="upl-f-class" onchange="renderUploadView()">
      <option value="">All</option>
    </select>
  </div>
  <div class="col-6 col-md-2">
    <label class="form-label small text-uppercase text-muted fw-semibold mb-1">Unit</label>
    <input type="number" class="form-control form-control-sm" id="upl-f-unit" min="1" max="365"
           placeholder="e.g. 5" oninput="renderUploadView()">
  </div>
  <div class="col-6 col-md-2">
    <label class="form-label small text-uppercase text-muted fw-semibold mb-1">Type</label>
    <select class="form-select form-select-sm" id="upl-f-type" onchange="renderUploadView()">
      <option value="">All</option>
    </select>
  </div>
  <div class="col-8 col-md-3">
    <label class="form-label small text-uppercase text-muted fw-semibold mb-1">File Name</label>
    <input type="text" class="form-control form-control-sm" id="upl-f-file"
           placeholder="Search file name..." oninput="renderUploadView()">
  </div>
  <div class="col-4 col-md-1">
    <button class="btn btn-outline-secondary btn-sm w-100" onclick="resetUploadFilters()">Reset</button>
  </div>
</div>
            <div id="upload-view-table-wrap"></div>
          </div>

        </div><!-- /sec-materials -->

        <!-- ── Section: Material Types ── -->
<div class="prog-section" id="sec-material_types">
  <div class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">
    <div>
      <h3 class="h6 fw-bold mb-0">Material Types</h3>
      <div class="text-muted small">Manage the Material Type options used on programs.</div>
    </div>
    <button class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1" onclick="openLookupForm('material_types')">
      <i class="bi bi-plus-lg"></i> Add Material Type
    </button>
  </div>
  <div id="lookup-form-material_types" class="d-none border rounded-3 p-3 mb-3 bg-light">
    <input type="hidden" id="lk-material_types-id">
    <div class="row g-2 align-items-end">
      <div class="col-md-6">
        <label class="form-label small text-uppercase text-muted fw-semibold">Name</label>
        <input type="text" class="form-control" id="lk-material_types-name" placeholder="e.g. Printed Booklet">
      </div>
      <div class="col-md-3">
        <label class="form-label small text-uppercase text-muted fw-semibold">Status</label>
        <select class="form-select" id="lk-material_types-status">
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
      </div>
      <div class="col-md-3 d-flex gap-2">
        <button class="btn btn-primary" onclick="saveLookup('material_types')">Save</button>
        <button class="btn btn-outline-secondary" onclick="closeLookupForm('material_types')">Cancel</button>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-sm table-hover align-middle">
      <thead class="table-light"><tr><th>Name</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody id="lookup-tbody-material_types">
        <tr><td colspan="3" class="text-center text-muted py-4">No material types yet.</td></tr>
      </tbody>
    </table>
  </div>
</div>
      </div><!-- /modal-body -->
    </div>
  </div>
</div>


<!-- ══════════════════════════════════════════
     MODAL: Master Data — Subjects & Domains
     (Independent of any single program)
══════════════════════════════════════════ -->
<div class="modal fade" id="modal-master-data" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div>
          <h5 class="modal-title mb-0">Subjects &amp; Domains</h5>
          <div class="text-muted small">Manage Subject and Domain (category) options used across all programs.</div>
        </div>
        <button type="button" class="btn-close" onclick="closeModal('modal-master-data')"></button>
      </div>
      <div class="modal-body">

        <ul class="nav nav-pills mb-4">
          <li class="nav-item">
            <a href="#" class="nav-link active" id="md-tab-subjects" onclick="event.preventDefault(); showMasterDataTab('subjects')">Subjects</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" id="md-tab-domains" onclick="event.preventDefault(); showMasterDataTab('domains')">Domains</a>
          </li>
        </ul>

        <!-- ── Section: Subjects ── -->
        <div class="md-section active" id="sec-subjects">
          <div class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">
            <div>
              <h3 class="h6 fw-bold mb-0">Subjects</h3>
              <div class="text-muted small">Manage the Subject options used on programs.</div>
            </div>
            <button class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1" onclick="openLookupForm('subjects')">
              <i class="bi bi-plus-lg"></i> Add Subject
            </button>
          </div>
          <div id="lookup-form-subjects" class="d-none border rounded-3 p-3 mb-3 bg-light">
            <input type="hidden" id="lk-subjects-id">
            <div class="row g-2 align-items-end">
              <div class="col-md-6">
                <label class="form-label small text-uppercase text-muted fw-semibold">Name</label>
                <input type="text" class="form-control" id="lk-subjects-name" placeholder="e.g. Mathematics">
              </div>
              <div class="col-md-3">
                <label class="form-label small text-uppercase text-muted fw-semibold">Status</label>
                <select class="form-select" id="lk-subjects-status">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>
              <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-primary" onclick="saveLookup('subjects')">Save</button>
                <button class="btn btn-outline-secondary" onclick="closeLookupForm('subjects')">Cancel</button>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-sm table-hover align-middle">
              <thead class="table-light"><tr><th>Name</th><th>Status</th><th>Actions</th></tr></thead>
              <tbody id="lookup-tbody-subjects">
                <tr><td colspan="3" class="text-center text-muted py-4">No subjects yet.</td></tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- ── Section: Domains ── -->
        <div class="md-section" id="sec-domains">
          <div class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">
            <div>
              <h3 class="h6 fw-bold mb-0">Domains</h3>
              <div class="text-muted small">Manage the Domain (category) options used on programs.</div>
            </div>
            <button class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1" onclick="openLookupForm('domains')">
              <i class="bi bi-plus-lg"></i> Add Domain
            </button>
          </div>
          <div id="lookup-form-domains" class="d-none border rounded-3 p-3 mb-3 bg-light">
            <input type="hidden" id="lk-domains-id">
            <div class="row g-2 align-items-end">
              <div class="col-md-4">
                <label class="form-label small text-uppercase text-muted fw-semibold">Name</label>
                <input type="text" class="form-control" id="lk-domains-name" placeholder="e.g. Olympiad">
              </div>
              <div class="col-md-3">
                <label class="form-label small text-uppercase text-muted fw-semibold">Subject</label>
                <select class="form-select" id="lk-domains-subject">
                  <option value="">-- Select Subject --</option>
                  <?php foreach ($subjects as $s): ?>
                    <option value="<?= (int) $s->sub_id ?>"><?= html_escape($s->sub_name) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-2">
                <label class="form-label small text-uppercase text-muted fw-semibold">Status</label>
                <select class="form-select" id="lk-domains-status">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>
              <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-primary" onclick="saveLookup('domains')">Save</button>
                <button class="btn btn-outline-secondary" onclick="closeLookupForm('domains')">Cancel</button>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-sm table-hover align-middle">
              <thead class="table-light"><tr><th>Name</th><th>Status</th><th>Actions</th></tr></thead>
              <tbody id="lookup-tbody-domains">
                <tr><td colspan="3" class="text-center text-muted py-4">No domains yet.</td></tr>
              </tbody>
            </table>
          </div>
        </div>

      </div><!-- /modal-body -->
    </div>
  </div>
</div>


<!-- ══════════════════════════════════════════
     MODAL: Add / Edit Component
══════════════════════════════════════════ -->
<div class="modal fade" id="modal-component" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="comp-modal-title">Add Component</h5>
        <button type="button" class="btn-close" onclick="closeModal('modal-component')"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="cf-id">
        <input type="hidden" id="cf-prog-id">
        <div class="row g-3">
          <div class="col-md-8">
              <label class="form-label">Component Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="cf-name" placeholder="Component name">
            </div>
            <div class="col-md-4">
              <label class="form-label">Component Code</label>
              <input type="text" class="form-control" id="cf-code" maxlength="50" placeholder="Auto (e.g. study_pack)"
                     oninput="this.value=this.value.toLowerCase().replace(/[^a-z0-9_]/g,'')">
              <!--<div class="form-text">Blank chhodo to name se auto ban jayega.</div>-->
            </div>
          <div class="col-md-6">
            <label class="form-label">Price <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="cf-price" min="0" step="0.01" placeholder="0.00">
          </div>
          <div class="col-md-6">
            <label class="form-label">Type</label>
            <select class="form-select" id="cf-type" onchange="onCompTypeChange()">
              <option value="">-- Select Type --</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Domain</label>
            <div class="input-group">
              <select class="form-select" id="cf-domain">
                <option value="">-- Select Domain --</option>
                <?php foreach ($domains as $d): ?>
                  <option value="<?= html_escape($d->category_name) ?>"><?= html_escape($d->category_name) ?></option>
                <?php endforeach; ?>
              </select>
              <button class="btn btn-outline-primary" type="button" title="Add new domain" onclick="openMasterData('domains')"><i class="bi bi-plus-lg"></i></button>
            </div>
          </div>
          <div class="col-md-6">
            <label class="form-label">Mode</label>
            <select class="form-select" id="cf-mode">
              <option value="">-- Select Mode --</option>
              <option value="Online">Online</option>
              <option value="Offline">Offline</option>
               <option value="Download">Download</option>
            </select>
          </div>
         <div class="col-md-6">
            <label class="form-label">Status</label>
            <select class="form-select" id="cf-status">
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </div>
          <div class="col-md-6" id="cf-start-date-wrap" style="display:none;">
            <label class="form-label">Start Date <span class="text-danger">*</span></label>
            <input type="date" class="form-control" id="cf-start-date">
          </div>
          <div class="col-md-6" id="cf-end-date-wrap" style="display:none;">
            <label class="form-label">End Date <span class="text-danger">*</span></label>
            <input type="date" class="form-control" id="cf-end-date">
          </div>

        </div>
        <!-- Optional component documents -->
        <div class="test-details-section mt-3 pt-3 border-top border-dashed" id="test-details">
          <h6 class="fw-bold mb-3">Component Documents</h6>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" id="cf-circular-label">Circular Upload</label>
              <input type="file" class="form-control" id="cf-circular" accept=".pdf,.doc,.docx">
            </div>
            <div class="col-md-6">
              <label class="form-label" id="cf-admit-label">Admit Upload</label>
              <input type="file" class="form-control" id="cf-admit" accept=".pdf,.doc,.docx">
            </div>
            <div class="col-12" id="cf-venue-wrap">
              <label class="form-label" id="cf-venue-label">Venues</label>
              <div class="table-responsive" style="max-width:100%;">
                <table class="table table-sm table-bordered mb-2" style="min-width:640px;">
                  <thead>
                    <tr>
                      <th style="min-width:110px;">Country</th>
                      <th style="min-width:110px;">State</th>
                      <th style="min-width:100px;">City</th>
                      <th style="min-width:120px;">Date</th>
                      <th style="min-width:160px;">Venue Name / Address</th>
                      <th style="width:36px;"></th>
                    </tr>
                  </thead>
                  <tbody id="cf-venues-tbody"></tbody>
                </table>
              </div>
              <button type="button" class="btn btn-sm btn-outline-primary" onclick="addVenueRow(null)">+ Add Venue</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary" onclick="closeModal('modal-component')">Cancel</button>
        <button class="btn btn-primary" onclick="saveComponent()">Save Component</button>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════
     MODAL: Add / Edit Plan
══════════════════════════════════════════ -->
<div class="modal fade" id="modal-plan" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="plan-modal-title">Add Plan</h5>
        <button type="button" class="btn-close" onclick="closeModal('modal-plan')"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="plf-id">
        <input type="hidden" id="plf-prog-id">
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label">Plan Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="plf-name" placeholder="Plan name">
          </div>

<div class="col-12">
  <label class="form-label">
    Components <span class="text-danger">*</span>
  </label>

  <div class="border rounded-3 p-3" id="plf-components-list">
    <div class="text-muted small">
      No components available.
    </div>
  </div>
</div>

<!-- Auto-calculated pricing summary -->
<div class="col-12">
  <div class="border rounded-3 p-3 bg-light">

    <div class="row g-3">

      <!-- Base Amount -->
      <div class="col-6 col-md-3">
        <div class="text-uppercase text-muted fw-semibold small">
          Base Amount
        </div>

        <div class="fw-bold fs-5" id="plf-base-amount">
          ₹0
        </div>

        <!-- Purchase List -->
        <div class="mt-2">
          <button
            type="button"
            class="btn btn-sm btn-outline-primary"
            id="plf-purchase-list-btn"
            onclick="togglePurchaseList()"
          >
            <i class="bi bi-cart3 me-1"></i>
            Purchase List
          </button>

          <div
            id="plf-purchase-list"
            class="mt-2 d-none"
          ></div>
        </div>
      </div>

      <!-- Discount -->
      <div class="col-6 col-md-3">
        <div class="text-uppercase text-muted fw-semibold small">
          Discount %
        </div>

        <div class="fw-bold" id="plf-discount-percent-display">
          0%
        </div>

        <input
          type="number"
          class="form-control form-control-sm mt-1"
          id="plf-discount-percent-input"
          min="0"
          max="100"
          step="0.01"
          placeholder="Discount %"
          oninput="onPlanPricingInputChange()"
        >
      </div>

      <!-- Discount Amount -->
      <div class="col-6 col-md-3">
        <div class="text-uppercase text-muted fw-semibold small">
          Discount Amount
        </div>

        <div class="fw-bold" id="plf-discount-amount">
          ₹0
        </div>
      </div>

      <!-- Final Amount -->
      <div class="col-6 col-md-3">
        <div class="text-uppercase text-muted fw-semibold small">
          Final Amount
        </div>

        <div class="fw-bold text-primary fs-5" id="plf-final-amount">
          ₹0
        </div>
      </div>

    </div>

    <div
      class="small text-muted mt-3"
      id="plf-tier-note"
    >
      Select components and enter units to calculate.
    </div>

  </div>

  <input type="hidden" id="plf-price">
</div>

          <div class="col-md-4">
            <label class="form-label">Plan Type <span class="text-danger">*</span></label>
            <select class="form-select" id="plf-plan-type">
              <option value="">-- Select Option --</option>
              <option value="Learning Material">Learning Material</option>
              <option value="Test">Test</option>
              <option value="Learning Material + Test">Learning Material + Test</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Duration</label>
            <select class="form-select" id="plf-duration">
              <option value="Daily">Daily</option>
               <option value="Weekly">Weekly</option>
                <option value="Monthly">Monthly</option>
              <option value="Quarterly">Quarterly</option>
              <option value="Annual">Annual</option>
              <option value="Lifetime">Lifetime</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Status</label>
            <select class="form-select" id="plf-status">
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary" onclick="closeModal('modal-plan')">Cancel</button>
        <button class="btn btn-primary" onclick="savePlan()">Save Plan</button>
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script src="<?= base_url('public/library/select2.min.js'); ?>"></script>
<link href="<?= base_url('public/library/select2.min.css'); ?>" rel="stylesheet">


<script>
$(document).ready(function(){

    console.log("jQuery loaded:", typeof $);
    console.log("Subject element:", $("#f-subject1").length);


    $("#f-subject1").on("change", function(){

        var subject = $(this).val();

        console.log("Subject changed:", subject);

        $.ajax({

            url: "<?= base_url('manage/ajax/lunarsubject'); ?>",

            type: "POST",

            data: {
                subject: subject
            },

            beforeSend: function(){

                $("#f-domain1").html(
                    '<option value="">Loading...</option>'
                );

            },

            success: function(result){

                console.log("Domain response:", result);

                $("#f-domain1").html(result);

            },

            error: function(xhr){

                console.log("AJAX Error:", xhr.status);
                console.log(xhr.responseText);

                $("#f-domain1").html(
                    '<option value="">Unable to load domains</option>'
                );

            }

        });

    });

});
</script>

<!-- Bootstrap 5.3 JS bundle (Popper included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>


/* ═══════════════════════════════════════════════════
   SETUP
═══════════════════════════════════════════════════ */
const API = <?php echo json_encode(rtrim(base_url(),'/').'/manage/lunar/'); ?>;
const APP_BASE = <?php echo json_encode(rtrim(base_url(),'/').'/'); ?>;
/* =====================================================
   PROGRAM DESCRIPTION EDITOR
===================================================== */

let programDescriptionEditor = null;

function initProgramDescriptionEditor() {

    const textarea = document.getElementById('ap-description');

    if (!textarea) {
        return;
    }

    // Prevent creating the editor more than once
    if (programDescriptionEditor) {
        return;
    }

    ClassicEditor
        .create(textarea, {

            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                'underline',
                'strikethrough',
                '|',
                'bulletedList',
                'numberedList',
                '|',
                'link',
                'blockQuote',
                'insertTable',
                '|',
                'undo',
                'redo'
            ]

        })

        .then(editor => {

            programDescriptionEditor = editor;

            console.log('Program Description Editor Loaded');

        })

        .catch(error => {

            console.error(
                'Program Description Editor Error:',
                error
            );

        });

}
let allPrograms  = [];   // full cache from server
let selectedProg = null; // currently managed program
let filteredProgs = [];  // after filter applied
let hasSearched  = false; // becomes true once the admin runs a search

/* ── API wrapper ── */
async function req(path, opts = {}) {
  const r   = await fetch(API + path, opts);
  const txt = await r.text();
  let  obj;
  try { obj = txt ? JSON.parse(txt) : {}; } catch(e) { throw new Error('Bad JSON: ' + path); }
  if (!r.ok) throw new Error(obj.error || 'Error ' + r.status);
  return obj;
}

/* ── Flash messages ── */
function flash(msg, isErr = false) {
  const ok  = document.getElementById('flash-ok');
  const err = document.getElementById('flash-err');
  ok.classList.add('d-none');
  err.classList.add('d-none');
  const el = isErr ? err : ok;
  el.textContent = msg;
  el.classList.remove('d-none');
  setTimeout(() => el.classList.add('d-none'), 4000);
}

/* ── Modals (Bootstrap 5 under the hood; same call signature as before) ── */
function openModal(id) {
  const el = document.getElementById(id);
  if (!el) return;
  bootstrap.Modal.getOrCreateInstance(el).show();
}
function closeModal(id) {
  const el = document.getElementById(id);
  if (!el) return;
  bootstrap.Modal.getOrCreateInstance(el).hide();
}

/* ── Escape HTML ── */
function h(s) { return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }
function money(n) { return '₹' + Number(n||0).toLocaleString('en-IN'); }
function getComponentContentKey(component) {
  const name = String(component?.component_name || '').toLowerCase();
  if (!name) return '';
  if (name.includes('video')) return 'video';
  if (name.includes('learning') || name.includes('material') || name.includes('study')) return 'study_pack';
  if (name.includes('mock')) return 'mock_test';
  if (name.includes('starter') || name.includes('skill')) return 'starter_test';
  if (name.includes('mover')) return 'mover_test';
  if (name.includes('flyer')) return 'flyer_test';
  if (name.includes('national')) return 'national_test';
  if (name.includes('daily') || name.includes('test')) return 'daily_test';
  return '';
}

/* Maps the class_number values used across upload dropdowns / table
   (Nursery=-3, LKG=-2, UKG=-1, Class-1..Class-12 = 1..12, 0 = All) to
   a readable label. */
function classNumberLabel(n) {
  const num = Number(n);
  if (num === -3) return 'Nursery';
  if (num === -2) return 'LKG';
  if (num === -1) return 'UKG';
  if (num > 0)    return 'Class-' + num;
  return 'All Classes';
}

const gradeOptions = ['Nursery','LKG','UKG','Class-1','Class-2','Class-3','Class-4','Class-5','Class-6','Class-7','Class-8','Class-9','Class-10','Class-11','Class-12','Adults'];

/* The stored value stays "Class-N" (used for filtering/matching),
   but it displays to the user as "Grade N". Nursery/LKG/UKG/Adults
   pass through unchanged. */
function gradeLabel(v) {
  const m = /^Class-(\d+)$/.exec(v || '');
  return m ? 'Grade ' + m[1] : v;
}

function populateProgramGradeOptions() {
  ['ap-grade-from', 'ap-grade-to'].forEach(id => {
    const sel = document.getElementById(id);
    if (!sel) return;
    sel.innerHTML = '<option value="">-- Select --</option>' + gradeOptions.map(g => `<option value="${g}">${gradeLabel(g)}</option>`).join('');
  });
}

function toggleProgramGradeFields() {
  const applicable = getSelectedApplicable(); // array
  const from = document.getElementById('ap-grade-from');
  const to = document.getElementById('ap-grade-to');
  if (!from || !to) return;

  // Nothing checked yet — lock the fields and clear them out.
  if (!applicable.length) {
    from.disabled = true;
    to.disabled = true;
    from.innerHTML = '<option value="">-- Select --</option>';
    to.innerHTML   = '<option value="">-- Select --</option>';
    from.value = '';
    to.value = '';
    return;
  }

  let options = [];
  if (applicable.includes('Preschool')) options.push('Nursery', 'LKG', 'UKG');
  if (applicable.includes('Grades'))   options.push(...gradeOptions.filter(g => g.startsWith('Class')));
  if (applicable.includes('Adults'))   options.push('Adults');

  const buildOptions = (selectEl, currentValue) => {
    let opts = options.slice();
    if (currentValue && !opts.includes(currentValue)) opts.push(currentValue); // preserve legacy values
    selectEl.innerHTML = '<option value="">-- Select --</option>' +
      opts.map(g => `<option value="${g}">${gradeLabel(g)}</option>`).join('');
    selectEl.value = opts.includes(currentValue) ? currentValue : '';
  };

  const prevFrom = from.value;
  const prevTo   = to.value;

  from.disabled = false;
  to.disabled = false;

  buildOptions(from, prevFrom);
  buildOptions(to, prevTo);

  // Auto-fill sensible defaults only when exactly one category is picked.
  if (applicable.length === 1) {
    if (applicable[0] === 'Preschool') {
      if (!from.value) from.value = 'Nursery';
      if (!to.value)   to.value   = 'UKG';
    } else if (applicable[0] === 'Adults') {
      from.value = 'Adults';
      to.value   = 'Adults';
    } else if (applicable[0] === 'Grades') {
      if (!from.value) from.value = 'Class-1';
      if (!to.value)   to.value   = 'Class-2';
    }
  }
}
function getSelectedApplicable() {
  return Array.from(document.querySelectorAll('.ap-applicable-opt:checked')).map(cb => cb.value);
}

function setSelectedApplicable(values) {
  const arr = Array.isArray(values) ? values : (values ? [values] : []);
  document.querySelectorAll('.ap-applicable-opt').forEach(cb => {
    cb.checked = arr.includes(cb.value);
  });
}

// Infers which checkboxes should be checked when editing an existing
// program that only has a single stored grade_from/grade_to range.
function inferApplicableFromGrades(gradeFrom, gradeTo) {
  const preschoolSet = ['Nursery', 'LKG', 'UKG', 'Preschool'];
  const gradeSet = gradeOptions.filter(g => g.startsWith('Class'));
  const result = new Set();
  [gradeFrom, gradeTo].forEach(v => {
    if (!v) return;
    if (preschoolSet.includes(v)) result.add('Preschool');
    else if (gradeSet.includes(v)) result.add('Grades');
    else if (v === 'Adults') result.add('Adults');
  });
  return result.size ? Array.from(result) : ['Grades'];
}
/* ── Safely set a <select>'s value even if the stored value isn't one
   of the hardcoded <option>s (e.g. legacy/manually-entered data).
   Without this, select.value silently no-ops and the field looks
   empty when editing. ── */
function setSelectValue(id, value) {
  const el = document.getElementById(id);
  if (!el) return;
  const val = (value === null || value === undefined) ? '' : String(value);
  if (val === '') { el.value = ''; return; }
  const hasOption = Array.from(el.options).some(o => o.value === val);
  if (!hasOption) {
    const opt = document.createElement('option');
    opt.value = val;
    opt.textContent = val;
    el.appendChild(opt);
  }
  el.value = val;
}

/* ═══════════════════════════════════════════════════
   PROGRAMS — list
═══════════════════════════════════════════════════ */
async function loadPrograms() {
  try {
    const data = await req('ajax_programs_list');
    allPrograms = Array.isArray(data) ? data : [];
    populateSeasonFilter();
    renderProgramTable(); // stays hidden behind the "search to begin" placeholder
  } catch(e) { flash(e.message, true); }
}

function populateSeasonFilter() {
  const seasons = [...new Set(allPrograms.map(p => p.season).filter(Boolean))].sort((a,b)=>a-b);
  const sel = document.getElementById('f-season');
  sel.innerHTML = '<option value="">All Seasons</option>' +
    seasons.map(s => `<option value="${s}">Season ${s}</option>`).join('');
}

/* Triggered only by the Search button (or Enter in the search box).
   Filter dropdowns/inputs no longer auto-search on change. */
function doSearch() {
  hasSearched = true;
  applyFilters();
}

function applyFilters() {
  const subject = document.getElementById('f-subject1').value;
  const domain  = document.getElementById('f-domain1').value;
  const grade   = document.getElementById('f-grade').value;
  const season  = document.getElementById('f-season').value;
  const status  = document.getElementById('f-status').value;
  const year    = document.getElementById('f-year').value;
  const search  = document.getElementById('f-search').value.toLowerCase();

  filteredProgs = allPrograms.filter(p => {
    if (subject && p.subject   !== subject)  return false;
    if (domain  && p.domain    !== domain)   return false;
    if (grade   && p.grade     !== grade)    return false;
    if (season  && String(p.season) !== String(season)) return false;
    if (status  && p.status    !== status)   return false;
    if (year    && p.academic_year !== year) return false;
    if (search  && !p.program_name.toLowerCase().includes(search)) return false;
    return true;
  });

  renderProgramTable();
}

function resetFilters() {
  ['f-subject1','f-domain1','f-grade','f-season','f-status','f-year'].forEach(id => {
    document.getElementById(id).value = '';
  });
  document.getElementById('f-search').value = '';
  hasSearched = false;
  filteredProgs = [];
  renderProgramTable();
}

function renderProgramTable() {
  const card  = document.getElementById('program-list-card');
  const tbody = document.getElementById('prog-tbody');

  // Before the admin has searched, keep the whole card hidden.
  if (!hasSearched) {
    card.classList.add('d-none');
    tbody.innerHTML = '';
    return;
  }

  card.classList.remove('d-none');
  document.getElementById('prog-count').textContent = filteredProgs.length + ' Program' + (filteredProgs.length !== 1 ? 's' : '');

  if (!filteredProgs.length) {
    tbody.innerHTML = `<tr><td colspan="8" class="text-center text-muted py-5">No programs found.</td></tr>`;
    return;
  }

  tbody.innerHTML = filteredProgs.map(p => `
    <tr data-program-id="${p.id}" style="cursor:pointer">
      <td class="fw-bold">${h(p.program_name)}</td>
      <td class="text-muted">${h(p.subject)}</td>
      <td class="text-muted">${h(p.domain)}</td>
      <td class="text-muted">${h(p.grade)}</td>
      <td class="text-muted">${p.season ? 'Season '+p.season : '—'}</td>
      <td class="text-muted">${h(p.academic_year||'—')}</td>
      <td><span class="badge rounded-pill ${p.status==='Active'?'text-bg-success':'text-bg-secondary'}">${h(p.status)}</span></td>
      <td>
        <button class="btn btn-sm btn-outline-secondary" title="Edit" onclick="event.stopPropagation(); openEditProgram(${p.id})">
          <i class="bi bi-pencil"></i>
        </button>
        <button class="btn btn-sm btn-outline-danger" title="Delete" onclick="event.stopPropagation(); deleteProgram(${p.id})">
          <i class="bi bi-trash"></i>
        </button>
      </td>
    </tr>
  `).join('');

  tbody.querySelectorAll('tr[data-program-id]').forEach(tr => {
    tr.addEventListener('click', (event) => {
      if (event.target.closest('button')) return;
      openManage(Number(tr.dataset.programId));
    });
  });
}



/* ═══════════════════════════════════════════════════
   PROGRAMS — add / edit
═══════════════════════════════════════════════════ */
function openAddProgram() {
  document.getElementById('add-prog-title').textContent = 'Add Program';
  document.getElementById('add-prog-sub').textContent = '';
  document.getElementById('ap-id').value    = '';
  document.getElementById('ap-name').value  = '';
  document.getElementById('ap-subject').value = '';
  document.getElementById('ap-domain').value  = '';
  populateProgramDomainOptions('');
  setSelectedApplicable([]);
  toggleProgramGradeFields();
  document.getElementById('ap-grade-from').value = '';
  document.getElementById('ap-grade-to').value = '';
  document.getElementById('ap-season').value  = '';
  document.getElementById('ap-year').value    = '';
  document.getElementById('ap-status').checked = true;
  document.getElementById('ap-management-percentage').value = '';
  document.getElementById('ap-aviansys-percentage').value = '';
  document.getElementById('ap-it-percentage').value = '';
  document.getElementById('ap-maker-percentage').value = '';
 if (programDescriptionEditor) {

    programDescriptionEditor.setData('');

} else {

    document.getElementById('ap-description').value = '';

}
  document.getElementById('ap-syllabus').value = '';
  document.getElementById('ap-syllabus-current').classList.add('d-none');
  document.getElementById('ap-syllabus-current').innerHTML = '';
  document.getElementById('ap-test-schedule').value = '';
  document.getElementById('ap-test-schedule-current').classList.add('d-none');
  document.getElementById('ap-test-schedule-current').innerHTML = '';
  document.getElementById('ap-what-you-get').value = '';
  document.getElementById('ap-what-you-get-current').classList.add('d-none');
  document.getElementById('ap-what-you-get-current').innerHTML = '';
  populateProgramGradeOptions();
  openModal('modal-add-program');
}

function openEditProgram(id) {
  const p = allPrograms.find(x => x.id == id);
  if (!p) return;
  populateProgramGradeOptions();
  document.getElementById('add-prog-title').textContent = 'Edit Program';
  document.getElementById('add-prog-sub').textContent   = p.program_name;
  document.getElementById('ap-id').value      = p.id;
  document.getElementById('ap-name').value    = p.program_name;
  setSelectValue('ap-subject', p.subject);
  populateProgramDomainOptions(p.domain);
  setSelectedApplicable(inferApplicableFromGrades(p.grade_from, p.grade_to));
  setSelectValue('ap-grade-from', p.grade_from || '');
  setSelectValue('ap-grade-to', p.grade_to || '');
  setSelectValue('ap-season',  p.season);
  setSelectValue('ap-year',    p.academic_year);
  setSelectValue('ap-management-percentage', p.management_percentage || '');
  setSelectValue('ap-aviansys-percentage', p.aviansys_percentage || '');
  setSelectValue('ap-maker-percentage', p.maker_percentage || '');
  setSelectValue('ap-it-percentage', p.it_percentage || '');
 if (programDescriptionEditor) {

    programDescriptionEditor.setData(
        p.description || ''
    );

} else {

    document.getElementById('ap-description').value =
        p.description || '';

}
  document.getElementById('ap-syllabus').value = '';
  const syllabusLink = document.getElementById('ap-syllabus-current');
  if (p.syllabus_path) {
    const syllabusUrl = APP_BASE + String(p.syllabus_path).replace(/^\/+/, '');
    syllabusLink.innerHTML = '<a href="' + h(syllabusUrl) + '" target="_blank" rel="noopener">View current syllabus</a>';
    syllabusLink.classList.remove('d-none');
  } else {
    syllabusLink.innerHTML = '';
    syllabusLink.classList.add('d-none');
  }
  document.getElementById('ap-test-schedule').value = '';
  const testScheduleLink = document.getElementById('ap-test-schedule-current');
  if (p.test_schedule_path) {
    const testScheduleUrl = APP_BASE + String(p.test_schedule_path).replace(/^\/+/, '');
    testScheduleLink.innerHTML = '<a href="' + h(testScheduleUrl) + '" target="_blank" rel="noopener">View current test schedule</a>';
    testScheduleLink.classList.remove('d-none');
  } else {
    testScheduleLink.innerHTML = '';
    testScheduleLink.classList.add('d-none');
  }
  document.getElementById('ap-what-you-get').value = '';
  const whatYouGetLink = document.getElementById('ap-what-you-get-current');
  if (p.what_you_get_path) {
    const whatYouGetUrl = APP_BASE + String(p.what_you_get_path).replace(/^\/+/, '');
    whatYouGetLink.innerHTML = '<a href="' + h(whatYouGetUrl) + '" target="_blank" rel="noopener">View current What You Get PDF</a>';
    whatYouGetLink.classList.remove('d-none');
  } else {
    whatYouGetLink.innerHTML = '';
    whatYouGetLink.classList.add('d-none');
  }
  document.getElementById('ap-status').checked = p.status === 'Active';
  toggleProgramGradeFields();
  openModal('modal-add-program');
}

async function saveProgram() {
  const name = document.getElementById('ap-name').value.trim();
  const subj = document.getElementById('ap-subject').value;
  const applicableArr = getSelectedApplicable();
  const gradeFrom = document.getElementById('ap-grade-from').value;
  const gradeTo = document.getElementById('ap-grade-to').value;

  if (!name || !subj || !applicableArr.length) { alert('Program Name, Subject and Applicable For are required.'); return; }
  if (!gradeFrom || !gradeTo) { alert('Please choose both Grade From and Grade To.'); return; }

  const fd = new FormData();
  fd.append('id',            document.getElementById('ap-id').value);
  fd.append('program_name',  name);
  fd.append('subject',       subj);
  fd.append('domain',        document.getElementById('ap-domain').value);
  fd.append('applicable_for', applicableArr.join(', '));
  fd.append('grade_from',   gradeFrom);
  fd.append('grade_to',     gradeTo);
  fd.append('grade',        gradeFrom + ' - ' + gradeTo);
  fd.append('season',        document.getElementById('ap-season').value);
  fd.append('academic_year', document.getElementById('ap-year').value);
let description = '';

if (programDescriptionEditor) {

    description = programDescriptionEditor.getData();

} else {

    description =
        document.getElementById('ap-description').value;

}

fd.append('description', description);
  fd.append('management_percentage',  document.getElementById('ap-management-percentage').value);
  fd.append('aviansys_percentage',    document.getElementById('ap-aviansys-percentage').value);
  fd.append('it_percentage', document.getElementById('ap-it-percentage').value);
  fd.append('maker_percentage',       document.getElementById('ap-maker-percentage').value);
  fd.append('status',        document.getElementById('ap-status').checked ? 'Active' : 'Inactive');
  const syl = document.getElementById('ap-syllabus').files[0];
  if (syl) fd.append('syllabus', syl);
  const testSchedule = document.getElementById('ap-test-schedule').files[0];
  if (testSchedule) fd.append('test_schedule', testSchedule);
  const whatYouGet = document.getElementById('ap-what-you-get').files[0];
  if (whatYouGet) fd.append('what_you_get', whatYouGet);

  try {
    await req('ajax_programs_save', { method:'POST', body: fd });
    closeModal('modal-add-program');
    flash('Program saved.');
    await loadPrograms();
    if (hasSearched) applyFilters();
  } catch(e) { flash(e.message, true); }
}
async function deleteProgram(id) {
  if (!confirm('Delete this program? This cannot be undone.')) return;
  try {
    await req('ajax_programs_delete/' + id, { method:'POST' });
    flash('Program deleted.');
    await loadPrograms();
    if (hasSearched) applyFilters();
  } catch(e) { flash(e.message, true); }
}

/* ═══════════════════════════════════════════════════
   MANAGE MODAL (components / plans / materials)
═══════════════════════════════════════════════════ */
function openManage(id) {
  const p = allPrograms.find(x => x.id == id);
  if (!p) return;
  selectedProg = p;
  uploadViewProgram = null;   // View Upload dropdown follows the newly opened program
  uploadViewCache = [];
  selectedUploadIds = new Set();

  document.getElementById('mg-prog-name').textContent    = p.program_name;
  document.getElementById('mg-prog-subject').textContent = p.subject  || '';
  document.getElementById('mg-prog-domain').textContent  = p.domain   || '';
  document.getElementById('mg-prog-grade').textContent   = p.grade    || '';
  document.getElementById('mg-prog-season').textContent  = p.season   ? 'Season ' + p.season : '';
  document.getElementById('mg-prog-year').textContent    = p.academic_year || '';
  const cmProgram = document.getElementById('cm-program');
  if (cmProgram) cmProgram.value = p.program_name;

  // Reset function selector
  document.getElementById('prog-func-select').value = '';
  document.getElementById('mg-func-label').textContent  = '-';
  document.querySelectorAll('.prog-section').forEach(s => s.classList.remove('active'));

  openModal('modal-manage');
}

function editCurrentProgram() {
  if (!selectedProg) return;
  closeModal('modal-manage');
  openEditProgram(selectedProg.id);
}

async function deleteCurrentProgram() {
  if (!selectedProg) return;
  if (!confirm('Delete "' + selectedProg.program_name + '"?')) return;
  try {
    await req('ajax_programs_delete/' + selectedProg.id, { method:'POST' });
    closeModal('modal-manage');
    flash('Program deleted.');
    selectedProg = null;
    await loadPrograms();
    if (hasSearched) applyFilters();
  } catch(e) { flash(e.message, true); }
}

const FUNC_LABELS = {
  components:     'Add Components',
  plans:          'Add Plans',
  materials:      'Upload Learning Materials',
  material_types: 'Add Material Type'
};

function onFuncChange() {
  const val = document.getElementById('prog-func-select').value;
  document.getElementById('mg-func-label').textContent = FUNC_LABELS[val] || '-';

  document.querySelectorAll('#modal-manage .prog-section').forEach(s => s.classList.remove('active'));
  if (val === 'components') {
    document.getElementById('sec-components').classList.add('active');
    loadComponents();
  } else if (val === 'plans') {
    document.getElementById('sec-plans').classList.add('active');
    loadPlans();
  } else if (val === 'materials') {
    document.getElementById('sec-materials').classList.add('active');
    loadComponents();
  } else if (val === 'material_types') {
    document.getElementById('sec-material_types').classList.add('active');
    loadLookup(val);
  }
}

/* ═══════════════════════════════════════════════════
   MASTER DATA MODAL (Subjects / Domains) — standalone,
   not tied to any individual program.
═══════════════════════════════════════════════════ */
function openMasterData(type) {
  showMasterDataTab(type || 'subjects');
  openModal('modal-master-data');
}

function showMasterDataTab(type) {
  document.querySelectorAll('#modal-master-data .md-section').forEach(s => s.classList.remove('active'));
  document.getElementById('sec-' + type).classList.add('active');

  document.getElementById('md-tab-subjects').classList.toggle('active', type === 'subjects');
  document.getElementById('md-tab-domains').classList.toggle('active', type === 'domains');

  loadLookup(type);
}
/* ═══════════════════════════════════════════════════
   COMPONENTS
═══════════════════════════════════════════════════ */
let compsCache = [];
let compsCacheProgramId = null;
let componentUploadsCache = [];

function isTestComponentType(type) {
  return String(type || '').trim().toLowerCase() === 'test';
}

async function loadComponents() {
  if (!selectedProg) return;
  try {
    const data = await req('ajax_components_list?program_id=' + selectedProg.id);
    compsCache = Array.isArray(data) ? data : [];
    compsCacheProgramId = selectedProg.id;
    await loadComponentUploads();
    renderComponents();
    populateUploadComponentOptions();
  } catch(e) { flash(e.message, true); }
}

/* View Upload can look at the selected program (default), any other
   program, or "all" programs. componentUploadsCache always stays scoped
   to the selected program (the Components table depends on that);
   uploadViewCache is what the View Upload table actually shows. */
let uploadViewProgram = null;   // null = selected program | 'all' | program id
let uploadViewCache   = [];

function uploadViewProgramValue() {
  if (uploadViewProgram !== null) return String(uploadViewProgram);
  return selectedProg ? String(selectedProg.id) : 'all';
}

function populateUploadViewPrograms() {
  const sel = document.getElementById('upl-view-program');
  if (!sel) return;
  const current = uploadViewProgramValue();
  sel.innerHTML = '<option value="all">All Programs</option>' +
    allPrograms.map(p =>
      `<option value="${p.id}">${h(p.program_name)}${selectedProg && String(selectedProg.id) === String(p.id) ? ' (current)' : ''}</option>`
    ).join('');
  sel.value = current;
  if (sel.value !== current) sel.value = 'all';
}

async function onUploadViewProgramChange(val) {
  uploadViewProgram = val;
  selectedUploadIds = new Set();
  await loadUploadViewRows();
  renderUploadView();
}

async function loadUploadViewRows() {
  const val = uploadViewProgramValue();
  if (selectedProg && val === String(selectedProg.id)) {
    uploadViewCache = componentUploadsCache;
    return;
  }
  try {
    const q = val === 'all' ? '' : '?program_id=' + encodeURIComponent(val);
    const data = await req('ajax_content_list' + q);
    uploadViewCache = Array.isArray(data) ? data : [];
  } catch (e) {
    uploadViewCache = [];
    flash(e.message, true);
  }
}

async function loadComponentUploads() {
  if (!selectedProg) {
    componentUploadsCache = [];
    uploadViewCache = [];
    renderUploadView();
    return;
  }
  try {
    const data = await req('ajax_content_list?program_id=' + selectedProg.id);
    componentUploadsCache = Array.isArray(data) ? data : [];
  } catch (e) {
    componentUploadsCache = [];
  }
  populateUploadViewPrograms();
  await loadUploadViewRows();
  renderUploadView();
}

/* Which program does an upload row belong to? Uses program_id, and falls
   back to the folder in file_path (uploads/lm_content/<program_id>/...). */
function uploadProgramId(u) {
  if (u.program_id && Number(u.program_id) > 0) return String(u.program_id);
  const m = /lm_content\/(\d+)\//.exec(String(u.file_path || ''));
  return m ? m[1] : '';
}

function uploadProgramName(u) {
  if (u.program_name) return u.program_name;
  const pid = uploadProgramId(u);
  const p = pid ? allPrograms.find(x => String(x.id) === pid) : null;
  if (p) return p.program_name;
  return pid ? ('Program #' + pid) : 'Unassigned';
}

/* ── Upload type labels ──────────────────────────────────────────
   lm_content.content_type stores internal codes (starter_test, mock_test…).
   Show a readable label instead. NOTE: the ZIP importer saves "Skill Test"
   files under the code `starter_test`, so that code is shown as "Skill Test". */
const CONTENT_TYPE_LABELS = {
  study_pack:    'Study Pack',
  mock_test:     'Mock Test',
  starter_test:  'Skill Test',
  mover_test:    'Mover Test',
  flyer_test:    'Flyer Test',
  national_test: 'National Test',
  daily_test:    'Daily Test',
  video:         'Video',
  audio:         'Audio'
};

function contentTypeLabel(u) {
  const key = String(u.content_type || '').trim().toLowerCase();
  if (CONTENT_TYPE_LABELS[key]) return CONTENT_TYPE_LABELS[key];
  if (!key) return 'File';
  return key.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
}



/* ── Bulk-delete selection state ── */
let selectedUploadIds = new Set();

/* ── View Upload filters ── */
function uploadFileName(u) {
  return String(u.original_filename || u.file_name || u.file_path || '').split('/').pop();
}

function uploadComponentName(u) {
  const matched = u.component_id
    ? compsCache.find(c => String(c.id) === String(u.component_id))
    : null;
  return u.component_name
    || (matched ? matched.component_name : null)
    || (u.component_id ? ('Component #' + u.component_id) : 'General');
}

/* Fill Component / Class / Type dropdowns from the rows currently loaded
   (so "All Programs" shows every option, a single program shows only its own). */
function populateUploadFilterOptions() {
  const fill = (id, entries, allLabel) => {
    const sel = document.getElementById(id);
    if (!sel) return;
    const current = sel.value;
    sel.innerHTML = '<option value="">' + allLabel + '</option>' +
      entries.map(([val, label]) => `<option value="${h(val)}">${h(label)}</option>`).join('');
    sel.value = entries.some(([val]) => String(val) === current) ? current : '';
  };

  // Components (by name)
  const comps = [...new Set(uploadViewCache.map(uploadComponentName))].sort((a, b) => a.localeCompare(b));
  fill('upl-f-component', comps.map(c => [c, c]), 'All');

  // Classes (by class_number)
  const classes = [...new Set(uploadViewCache.map(u => String(Number(u.class_number) || 0)))]
    .sort((a, b) => Number(a) - Number(b));
  fill('upl-f-class', classes.map(c => [c, classNumberLabel(c)]), 'All');

  // Types (by readable label)
  const types = [...new Set(uploadViewCache.map(contentTypeLabel))].sort((a, b) => a.localeCompare(b));
  fill('upl-f-type', types.map(t => [t, t]), 'All');
}

function getFilteredUploads() {
  const fComp  = document.getElementById('upl-f-component')?.value || '';
  const fClass = document.getElementById('upl-f-class')?.value || '';
  const fUnit  = parseInt(document.getElementById('upl-f-unit')?.value, 10);
  const fType  = document.getElementById('upl-f-type')?.value || '';
  const fFile  = (document.getElementById('upl-f-file')?.value || '').trim().toLowerCase();

  return uploadViewCache.filter(u => {
    if (fComp  && uploadComponentName(u) !== fComp) return false;
    if (fClass && String(Number(u.class_number) || 0) !== fClass) return false;
    if (fType  && contentTypeLabel(u) !== fType) return false;
    if (fFile  && !uploadFileName(u).toLowerCase().includes(fFile)) return false;
    if (!isNaN(fUnit)) {
      const start = Number(u.week_number) || 1;
      const end   = Number(u.end_unit) || start;
      if (fUnit < Math.min(start, end) || fUnit > Math.max(start, end)) return false;
    }
    return true;
  });
}

function resetUploadFilters() {
  ['upl-f-component', 'upl-f-class', 'upl-f-type'].forEach(id => {
    const el = document.getElementById(id); if (el) el.value = '';
  });
  ['upl-f-unit', 'upl-f-file'].forEach(id => {
    const el = document.getElementById(id); if (el) el.value = '';
  });
  renderUploadView();
}

function renderUploadView() {
  const wrap = document.getElementById('upload-view-table-wrap');
  if (!wrap) return;

//   const data = uploadViewCache;

//   // Drop selections whose rows no longer exist (deleted / program changed)
//   const validIds = new Set(data.map(u => String(u.id)));
//   selectedUploadIds = new Set([...selectedUploadIds].filter(id => validIds.has(id)));

//   if (!data.length) {
//     wrap.innerHTML = '<div class="border rounded-3 p-4 text-center text-muted bg-light">No uploaded files yet for this selection.</div>';
//     return;
//   }

  populateUploadFilterOptions();
  const data = getFilteredUploads();

  // Drop selections whose rows are gone OR currently hidden by a filter,
  // so "Delete Selected" can never remove files you can't see.
  const validIds = new Set(data.map(u => String(u.id)));
  selectedUploadIds = new Set([...selectedUploadIds].filter(id => validIds.has(id)));

  if (!data.length) {
    wrap.innerHTML = uploadViewCache.length
      ? '<div class="border rounded-3 p-4 text-center text-muted bg-light">No files match the selected filters.</div>'
      : '<div class="border rounded-3 p-4 text-center text-muted bg-light">No uploaded files yet for this selection.</div>';
    updateBulkDeleteUi();
    return;
  }
  
  // Group rows program-wise (keeps the server's order inside each program)
  const groups = new Map();
  data.forEach(u => {
    const pid = uploadProgramId(u);
    if (!groups.has(pid)) groups.set(pid, { pid, name: uploadProgramName(u), rows: [] });
    groups.get(pid).rows.push(u);
  });
  const groupList = [...groups.values()].sort((a, b) => a.name.localeCompare(b.name));
  const showGroupHeaders = uploadViewProgramValue() === 'all' || groupList.length > 1;

  const rowHtml = u => {
    const matchedComp = u.component_id
      ? compsCache.find(c => String(c.id) === String(u.component_id))
      : null;
    const compName = u.component_name
      || (matchedComp ? matchedComp.component_name : null)
      || (u.component_id ? ('Component #' + u.component_id) : 'General');
    const classLabel = classNumberLabel(u.class_number);
    const unitRange = Number(u.end_unit) && Number(u.end_unit) !== Number(u.week_number)
      ? 'Unit ' + u.week_number + ' - ' + u.end_unit
      : 'Unit ' + (u.week_number || 1);
    const fileName = (u.original_filename || u.file_name || u.file_path || 'Uploaded file').split('/').pop();
    const fileLink = u.file_path
      ? (`<a href="/admin/${String(u.file_path).replace(/^\/+/, '')}" target="_blank" rel="noopener" class="text-primary text-decoration-none">${h(fileName)}</a>`)
      : h(fileName);
    const solutionBadge = /solution/i.test(fileName)
      ? ' <span class="badge bg-success ms-1">Solution</span>'
      : '';
    const checked = selectedUploadIds.has(String(u.id)) ? 'checked' : '';
    return `
      <tr class="${checked ? 'table-active' : ''}">
        <td class="text-center" style="width:40px;">
          <input type="checkbox" class="form-check-input upl-row-chk" value="${u.id}" data-pid="${h(uploadProgramId(u))}" ${checked}
                 onchange="toggleUploadSelection(this)">
        </td>
        <td>${h(compName)}</td>
        <td>${h(classLabel)}</td>
        <td>${h(unitRange)}</td>
        <td>${h(contentTypeLabel(u))}${solutionBadge}</td>
        <td>${fileLink}</td>
        <td><button class="btn btn-outline-danger btn-sm d-inline-flex align-items-center gap-1" title="Delete upload" onclick="deleteUploadedContent(${u.id})">
              <i class="bi bi-trash"></i>
            </button></td>
      </tr>
    `;
  };

  const body = groupList.map(g => {
    const header = showGroupHeaders ? `
      <tr class="table-secondary">
        <td class="text-center">
          <input type="checkbox" class="form-check-input upl-group-chk" data-pid="${h(g.pid)}"
                 title="Select all files of this program" onchange="toggleUploadGroup(this)">
        </td>
        <td colspan="6">
          <span class="fw-bold">${h(g.name)}</span>
          <span class="badge bg-secondary ms-2">${g.rows.length} file${g.rows.length === 1 ? '' : 's'}</span>
        </td>
      </tr>` : '';
    return header + g.rows.map(rowHtml).join('');
  }).join('');

  wrap.innerHTML = `
    <div class="d-flex align-items-center gap-2 mb-2">
      <button type="button" id="upl-bulk-delete-btn" class="btn btn-danger btn-sm d-inline-flex align-items-center gap-1"
              onclick="deleteSelectedUploads()" disabled>
        <i class="bi bi-trash"></i> <span id="upl-bulk-delete-label">Delete Selected</span>
      </button>
      <span class="text-muted small" id="upl-selected-hint">Tick the files you want to delete.</span>
    </div>
    <div class="table-responsive">
      <table class="table table-sm table-bordered align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th class="text-center" style="width:40px;">
              <input type="checkbox" class="form-check-input" id="upl-select-all"
                     title="Select all" onchange="toggleAllUploads(this)">
            </th>
            <th>Component</th>
            <th>Class</th>
            <th>Unit</th>
            <th>Type</th>
            <th>File</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>${body}</tbody>
      </table>
    </div>
  `;
  updateBulkDeleteUi();
}

function toggleUploadGroup(groupCb) {
  const pid = groupCb.getAttribute('data-pid');
  document.querySelectorAll('#upload-view-table-wrap .upl-row-chk').forEach(cb => {
    if (cb.getAttribute('data-pid') !== pid) return;
    cb.checked = groupCb.checked;
    if (groupCb.checked) selectedUploadIds.add(String(cb.value)); else selectedUploadIds.delete(String(cb.value));
    const tr = cb.closest('tr');
    if (tr) tr.classList.toggle('table-active', cb.checked);
  });
  updateBulkDeleteUi();
}

function toggleUploadSelection(cb) {
  const id = String(cb.value);
  if (cb.checked) selectedUploadIds.add(id); else selectedUploadIds.delete(id);
  const tr = cb.closest('tr');
  if (tr) tr.classList.toggle('table-active', cb.checked);
  updateBulkDeleteUi();
}

function toggleAllUploads(masterCb) {
  document.querySelectorAll('#upload-view-table-wrap .upl-row-chk').forEach(cb => {
    cb.checked = masterCb.checked;
    if (masterCb.checked) selectedUploadIds.add(String(cb.value)); else selectedUploadIds.delete(String(cb.value));
    const tr = cb.closest('tr');
    if (tr) tr.classList.toggle('table-active', cb.checked);
  });
  updateBulkDeleteUi();
}

function updateBulkDeleteUi() {
  const rowCbs = document.querySelectorAll('#upload-view-table-wrap .upl-row-chk');
  const total = rowCbs.length;
  const n = selectedUploadIds.size;
  const btn = document.getElementById('upl-bulk-delete-btn');
  const lbl = document.getElementById('upl-bulk-delete-label');
  const hint = document.getElementById('upl-selected-hint');
  const master = document.getElementById('upl-select-all');
  if (btn) btn.disabled = n === 0;
  if (lbl) lbl.textContent = n ? 'Delete Selected (' + n + ')' : 'Delete Selected';
  if (hint) hint.textContent = n ? (n + ' of ' + total + ' selected') : 'Tick the files you want to delete.';
  if (master) {
    master.checked = total > 0 && n === total;
    master.indeterminate = n > 0 && n < total;
  }
  document.querySelectorAll('#upload-view-table-wrap .upl-group-chk').forEach(g => {
    const pid = g.getAttribute('data-pid');
    const mine = [...rowCbs].filter(cb => cb.getAttribute('data-pid') === pid);
    const sel  = mine.filter(cb => cb.checked).length;
    g.checked = mine.length > 0 && sel === mine.length;
    g.indeterminate = sel > 0 && sel < mine.length;
  });
}

async function deleteSelectedUploads() {
  const ids = [...selectedUploadIds];
  if (!ids.length) return;
  if (!confirm('Delete ' + ids.length + ' selected file' + (ids.length > 1 ? 's' : '') + '? This cannot be undone.')) return;

  const btn = document.getElementById('upl-bulk-delete-btn');
  if (btn) btn.disabled = true;
  try {
    const fd = new FormData();
    ids.forEach(id => fd.append('ids[]', id));
    const result = await req('ajax_content_delete_multiple', { method: 'POST', body: fd });
    if (!result.success) throw new Error(result.error || 'Selected files could not be deleted.');
    selectedUploadIds.clear();
    flash(result.deleted + ' file' + (result.deleted === 1 ? '' : 's') + ' deleted.');
    await loadComponentUploads();
  } catch (e) {
    flash(e.message, true);
    updateBulkDeleteUi();
  }
}

async function deleteUploadedContent(id) {
  if (!id || !confirm('Delete this uploaded file?')) return;
  try {
    const result = await req('ajax_content_delete/' + id, { method: 'POST' });
    if (!result.success) throw new Error(result.error || 'Upload could not be deleted.');
    selectedUploadIds.delete(String(id));
    flash('Uploaded file deleted.');
    await loadComponentUploads();
  } catch (e) {
    flash(e.message, true);
  }
}

function populateUploadComponentOptions() {
  const selectors = [
    document.getElementById('ul-component'),
    document.getElementById('ul-zip-component')
  ].filter(Boolean);

  selectors.forEach(sel => {
    sel.innerHTML = '<option value="">Select Component</option>' +
      compsCache.map(c => `<option value="${c.id}">${h(c.component_name)}</option>`).join('');
    if (compsCache.length && !sel.value) {
      sel.value = String(compsCache[0].id);
    }
  });
}

function renderComponents() {
  const tbody = document.getElementById('comp-tbody');
  if (!compsCache.length) {
    tbody.innerHTML = '<tr><td colspan="5" class="text-center text-muted py-4">No components yet.</td></tr>';
    return;
  }
  tbody.innerHTML = compsCache.map(c => {
    const componentType = String(c.component_type || '').trim();
    const isTestComponent = isTestComponentType(componentType);
    const preferredContentKey = getComponentContentKey(c);
    const matches = componentUploadsCache.filter(u => {
      const exactMatch = !!u && String((u.component_id ?? '') || '') === String(c.id);
      if (exactMatch) return true;
      if (!preferredContentKey) return false;
      if (!u || !u.content_type) return false;
      return String(u.content_type) === preferredContentKey && (!u.component_id || String(u.component_id) === '0' || String(u.component_id) === '');
    });

    const docEntries = [];
    if ((c.circular_path || '').trim()) {
      const fileName = (c.circular_path || '').split('/').pop();
      docEntries.push({ label: 'Circular', path: c.circular_path, fileName });
    }
    if ((c.admit_path || '').trim()) {
      const fileName = (c.admit_path || '').split('/').pop();
      docEntries.push({ label: 'Admit', path: c.admit_path, fileName });
    }
    if (!docEntries.length && matches.length) {
      matches.slice(0, 4).forEach(u => {
        const fileName = (u.original_filename || u.file_name || u.file_path || 'Uploaded').split('/').pop();
        if (fileName && fileName !== 'Uploaded') {
          docEntries.push({ label: 'Uploaded', path: u.file_path || '#', fileName });
        }
      });
    }

    const badges = docEntries.length
  ? docEntries.map(doc => {
      const url = (doc.path || '').startsWith('http')
        ? doc.path
        : '/admin/' + String(doc.path || '')
            .replace(/^\/+/, '')
            .replace(/^admin\//i, '');

      const display = doc.label === 'Circular'
        ? 'Circular'
        : doc.label === 'Admit'
          ? 'Admit Card'
          : 'Uploaded File';

      return `
        <div class="d-flex align-items-center border-bottom py-2">

          
          <div class="me-2">
            <i class="bi bi-file-earmark-pdf text-danger fs-3"></i>
          </div>

          <div class="flex-grow-1 overflow-hidden">
            <div class="fw-semibold text-dark text-truncate">
              ${h(doc.fileName || display)}
            </div>
            <div class="text-muted small">
              ${h(display)}
            </div>
          </div>

          <div class="ms-3">
            <a href="${h(url)}"
               target="_blank"
               rel="noopener"
               class="text-primary fw-semibold text-decoration-none">
              <i class="bi bi-eye me-1"></i>View
            </a>
          </div>

        </div>`;
    }).join('')
  : '<span class="text-muted small">No uploaded material</span>';
    const venueNames = Array.isArray(c.venues) ? c.venues.map(v => (v.venue_name || '').trim()).filter(Boolean) : [];
    const venueText = isTestComponent && String(c.component_mode || '').toLowerCase() === 'offline' && venueNames.length
      ? ` · Venues: ${h(venueNames.join(', '))}`
      : (isTestComponent && String(c.component_mode || '').toLowerCase() === 'offline' && (c.venue || '').trim()
          ? ` · Venue: ${h(c.venue)}`
          : '');
    const modeLower = String(c.component_mode || '').toLowerCase();
    const dateText = modeLower === 'online' && (c.start_date || c.end_date)
      ? ` · ${h(c.start_date || '—')} to ${h(c.end_date || '—')}`
      : '';

    return `
    <tr>
      <td class="fw-bold">
        ${h(c.component_name)}
        <div class="d-flex flex-wrap gap-2 mt-2">${badges}</div>
      <div class="text-muted small mt-2">${c.component_code ? '<code>' + h(c.component_code) + '</code> · ' : ''}${h(componentType || '')} ${c.component_mode ? '· ' + h(c.component_mode) : ''}${venueText}${dateText}</div>
      </td>
      <td>${h(c.domain || '—')}</td>
      <td>${money(c.price||c.unit_price)}</td>
      <td><span class="badge rounded-pill ${c.status==='Active'?'text-bg-success':'text-bg-secondary'}">${h(c.status)}</span></td>
      <td>
        <button class="btn btn-sm btn-outline-secondary" onclick='editComponent(${JSON.stringify(c)})'>
          <i class="bi bi-pencil"></i>
        </button>
        <button class="btn btn-sm btn-outline-danger" onclick="deleteComponent(${c.id})">
          <i class="bi bi-trash"></i>
        </button>
      </td>
    </tr>
  `;
  }).join('');
}

function openUploadForComponent(component) {
  if (!selectedProg) return;
  const select = document.getElementById('prog-func-select');
  if (select) {
    select.value = 'materials';
    onFuncChange();
  }
  const compSelect = document.getElementById('ul-component');
  if (compSelect) {
    compSelect.value = String(component.id);
  }
  const panel = document.getElementById('sec-materials');
  if (panel) {
    panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }
}

function updateComponentDocumentFields() {
  const type = document.getElementById('cf-type').value;
  const mode = document.getElementById('cf-mode').value;
  const isTest = isTestComponentType(type);
  const showTestDetails = isTest;
  const venueWrap = document.getElementById('cf-venue-wrap');
  const venueLabel = document.getElementById('cf-venue-label');
  const circularLabel = document.getElementById('cf-circular-label');
  const admitLabel = document.getElementById('cf-admit-label');

  document.getElementById('test-details').style.display = showTestDetails ? 'block' : 'none';
  venueWrap.style.display = isTest && mode === 'Offline' ? 'block' : 'none';

  if (isTest) {
    circularLabel.textContent = 'Circular Upload';
    admitLabel.textContent = 'Admit Upload';
    venueLabel.textContent = mode === 'Offline' ? 'Venues *' : 'Venues';
  } else {
    circularLabel.textContent = 'Circular Upload';
    admitLabel.textContent = 'Admit Upload';
    venueLabel.textContent = 'Venues';
  }

  updateComponentModeDateFields();
}

function updateComponentModeDateFields() {
  const mode = document.getElementById('cf-mode').value;
  const startWrap = document.getElementById('cf-start-date-wrap');
  const endWrap   = document.getElementById('cf-end-date-wrap');
  if (!startWrap || !endWrap) return;

  startWrap.style.display = mode === 'Online' ? 'block' : 'none';
  endWrap.style.display   = mode === 'Online' ? 'block' : 'none';
}

/* ── Offline component: multiple venue rows ── */
let venueRowSeq = 0;
let venueCountriesCache = null;

function venueRowTemplate(rowId) {
  return `
    <tr data-row="${rowId}" data-venue-id="">
      <td><select class="form-select form-select-sm venue-country" onchange="onVenueCountryChange(this)"><option value="">Country</option></select></td>
      <td><select class="form-select form-select-sm venue-state" disabled onchange="onVenueStateChange(this)"><option value="">Select country first</option></select></td>
      <td><select class="form-select form-select-sm venue-city" disabled><option value="">Select state first</option></select></td>
      <td><input type="date" class="form-control form-control-sm venue-date"></td>
      <td><input type="text" class="form-control form-control-sm venue-name" placeholder="Venue name / address"></td>
      <td class="text-center"><button type="button" class="btn btn-sm btn-outline-danger" onclick="removeVenueRow(this)">&times;</button></td>
    </tr>`;
}

async function loadVenueCountries() {
  if (venueCountriesCache) return venueCountriesCache;
  try {
    const list = await req('ajax_component_countries_list');
    venueCountriesCache = Array.isArray(list) ? list : [];
  } catch (e) {
    venueCountriesCache = [];
  }
  return venueCountriesCache;
}

async function populateVenueCountrySelect(select) {
  const countries = await loadVenueCountries();
  countries.forEach(c => {
    const opt = document.createElement('option');
    opt.value = c.country_id;
    opt.textContent = c.country_name;
    select.appendChild(opt);
  });
}

async function loadVenueStates(select, countryId, presetStateId) {
  select.disabled = true;
  select.innerHTML = '<option value="">Loading…</option>';
  if (!countryId) {
    select.innerHTML = '<option value="">Select country first</option>';
    return;
  }
  try {
    const states = await req('ajax_component_states_list?country_id=' + encodeURIComponent(countryId));
    select.disabled = false;
    select.innerHTML = '<option value="">Select state</option>';
    (states || []).forEach(s => {
      const opt = document.createElement('option');
      opt.value = s.state_subdivision_id;
      opt.textContent = s.state_subdivision_name;
      select.appendChild(opt);
    });
    if (presetStateId) select.value = presetStateId;
  } catch (e) {
    select.disabled = false;
    select.innerHTML = '<option value="">Select state</option>';
  }
}

async function loadVenueCities(select, stateId, presetCityId) {
  select.disabled = true;
  select.innerHTML = '<option value="">Loading…</option>';
  if (!stateId) {
    select.innerHTML = '<option value="">Select state first</option>';
    return;
  }
  try {
    const cities = await req('ajax_component_cities_list?state_id=' + encodeURIComponent(stateId));
    select.disabled = false;
    select.innerHTML = '<option value="">Select city</option>';
    (cities || []).forEach(c => {
      const opt = document.createElement('option');
      opt.value = c.id;
      opt.textContent = c.district_name;
      select.appendChild(opt);
    });
    if (presetCityId) select.value = presetCityId;
  } catch (e) {
    select.disabled = false;
    select.innerHTML = '<option value="">Select city</option>';
  }
}

function onVenueCountryChange(select) {
  const row = select.closest('tr');
  loadVenueStates(row.querySelector('.venue-state'), select.value, null);
  const citySelect = row.querySelector('.venue-city');
  citySelect.disabled = true;
  citySelect.innerHTML = '<option value="">Select state first</option>';
}

function onVenueStateChange(select) {
  const row = select.closest('tr');
  loadVenueCities(row.querySelector('.venue-city'), select.value, null);
}

function addVenueRow(prefill) {
  venueRowSeq++;
  const tbody = document.getElementById('cf-venues-tbody');
  tbody.insertAdjacentHTML('beforeend', venueRowTemplate(venueRowSeq));
  const row = tbody.lastElementChild;
  const countrySelect = row.querySelector('.venue-country');
  populateVenueCountrySelect(countrySelect).then(async () => {
    if (prefill && prefill.country_id) {
      countrySelect.value = prefill.country_id;
      const stateSelect = row.querySelector('.venue-state');
      await loadVenueStates(stateSelect, prefill.country_id, prefill.state_id);
      if (prefill.state_id) {
        await loadVenueCities(row.querySelector('.venue-city'), prefill.state_id, prefill.city_id);
      }
    }
  });
  if (prefill) {
    row.setAttribute('data-venue-id', prefill.id || '');
    row.querySelector('.venue-date').value = prefill.venue_date || '';
    row.querySelector('.venue-name').value = prefill.venue_name || '';
  }
}

function removeVenueRow(btn) {
  const row = btn.closest('tr');
  const venueId = row.getAttribute('data-venue-id');
  row.remove();
  if (venueId) {
    const fd = new FormData();
    fd.append('id', venueId);
    req('ajax_component_venue_delete', { method: 'POST', body: fd }).catch(() => {});
  }
}

function resetVenueRows(prefillList) {
  const tbody = document.getElementById('cf-venues-tbody');
  tbody.innerHTML = '';
  if (prefillList && prefillList.length) {
    prefillList.forEach(v => addVenueRow(v));
  } else {
    addVenueRow(null);
  }
}

function collectVenueRows() {
  const rows = [];
  document.querySelectorAll('#cf-venues-tbody tr').forEach(row => {
    const countrySelect = row.querySelector('.venue-country');
    const stateSelect = row.querySelector('.venue-state');
    const citySelect = row.querySelector('.venue-city');
    const cityId = citySelect.value || '';
    const cityName = citySelect.options[citySelect.selectedIndex] ? citySelect.options[citySelect.selectedIndex].text : '';
    const date = row.querySelector('.venue-date').value;
    const name = row.querySelector('.venue-name').value.trim();
    if (!cityId && !date && !name && !countrySelect.value) return; // skip a fully blank row
    rows.push({
      id: row.getAttribute('data-venue-id') || null,
      country_id: countrySelect.value || '',
      country_name: countrySelect.options[countrySelect.selectedIndex] ? countrySelect.options[countrySelect.selectedIndex].text : '',
      state_id: stateSelect.value || '',
      state_name: stateSelect.options[stateSelect.selectedIndex] ? stateSelect.options[stateSelect.selectedIndex].text : '',
      city_id: cityId,
      city: cityId ? cityName : '',
      venue_date: date,
      venue_name: name
    });
  });
  return rows;
}

function openAddComponent() {
  document.getElementById('comp-modal-title').textContent = 'Add Component';
  document.getElementById('cf-id').value      = '';
  document.getElementById('cf-prog-id').value = selectedProg.id;
  document.getElementById('cf-name').value    = '';
  document.getElementById('cf-code').value    = '';
  document.getElementById('cf-price').value   = '';
  document.getElementById('cf-type').value    = '';
  document.getElementById('cf-domain').value  = '';
  document.getElementById('cf-mode').value    = '';
  document.getElementById('cf-status').value  = 'Active';
  resetVenueRows(null);
  document.getElementById('cf-circular').value = '';
  document.getElementById('cf-admit').value = '';
  document.getElementById('cf-start-date').value = '';
  document.getElementById('cf-end-date').value = '';
  updateComponentDocumentFields();
  openModal('modal-component');
}
function editComponent(c) {
  document.getElementById('comp-modal-title').textContent = 'Edit Component';
  document.getElementById('cf-id').value      = c.id;
  document.getElementById('cf-prog-id').value = c.program_id;
  document.getElementById('cf-name').value    = c.component_name;
  document.getElementById('cf-code').value    = c.component_code || '';
  document.getElementById('cf-price').value   = c.price || c.unit_price || '';
  setSelectValue('cf-type',   c.component_type);
  setSelectValue('cf-domain', c.domain);
  setSelectValue('cf-mode',   c.component_mode);
  setSelectValue('cf-status', c.status || 'Active');
  resetVenueRows(Array.isArray(c.venues) ? c.venues : []);
  document.getElementById('cf-circular').value = '';
  document.getElementById('cf-admit').value = '';
  document.getElementById('cf-start-date').value = c.start_date || '';
  document.getElementById('cf-end-date').value = c.end_date || '';
  updateComponentDocumentFields();
  openModal('modal-component');
}

function onCompTypeChange() {
  updateComponentDocumentFields();
}

document.getElementById('cf-mode').addEventListener('change', updateComponentDocumentFields);

async function saveComponent() {
  const name  = document.getElementById('cf-name').value.trim();
  const code  = document.getElementById('cf-code').value.trim();
  const price = document.getElementById('cf-price').value;
  const type  = document.getElementById('cf-type').value;
  const mode  = document.getElementById('cf-mode').value;

  if (!name || price === '') { alert('Component Name and Price are required.'); return; }
  if (code && !/^[a-z0-9_]{2,50}$/.test(code)) {
    alert('Component Code: only lowercase letters, numbers and underscore (2-50 characters).');
    return;
  }
  if (!type) { alert('Please select a component type.'); return; }
  if (!mode) { alert('Please select a Mode.'); return; }

  const startDate = document.getElementById('cf-start-date').value;
  const endDate   = document.getElementById('cf-end-date').value;

  if (mode === 'Online') {
    if (!startDate || !endDate) { alert('Start Date and End Date are required for Online mode.'); return; }
    if (startDate > endDate) { alert('Start Date cannot be after End Date.'); return; }
  }

  let venueRows = [];
  if (isTestComponentType(type) && mode === 'Offline') {
    venueRows = collectVenueRows();
    const hasValidRow = venueRows.some(v => v.venue_name && v.venue_date);
    if (!hasValidRow) { alert('Add at least one venue with a name and date for offline test components.'); return; }
  }

  const fd = new FormData();
  fd.append('id',             document.getElementById('cf-id').value);
  fd.append('program_id',     document.getElementById('cf-prog-id').value);
  fd.append('component_name', name);
  fd.append('component_code', code);               // blank = server auto-generate
  fd.append('unit_price',     price);
  fd.append('price',          price);
  fd.append('component_type', type);
  fd.append('domain',         document.getElementById('cf-domain').value);
  fd.append('component_mode', mode);
  fd.append('status',         document.getElementById('cf-status').value);
  fd.append('venue',          venueRows[0] ? (venueRows[0].venue_name || '') : '');
  fd.append('venues',         JSON.stringify(venueRows));
  fd.append('start_date',     mode === 'Online' ? startDate : '');
  fd.append('end_date',       mode === 'Online' ? endDate   : '');
  const circ = document.getElementById('cf-circular').files[0];
  const adm  = document.getElementById('cf-admit').files[0];
  if (circ) fd.append('circular', circ);
  if (adm)  fd.append('admit', adm);

  try {
    await req('ajax_components_save', { method:'POST', body: fd });
    closeModal('modal-component');
    flash('Component saved.');
    loadComponents();
  } catch(e) { flash(e.message, true); }
}
async function deleteComponent(id) {
  if (!confirm('Delete this component?')) return;
  try {
    await req('ajax_components_delete/' + id, { method:'POST' });
    flash('Component deleted.');
    loadComponents();
  } catch(e) { flash(e.message, true); }
}

/* ═══════════════════════════════════════════════════
   PLANS
═══════════════════════════════════════════════════ */
let plansCache = [];

async function loadPlans() {
  if (!selectedProg) return;
  try {
    const data = await req('ajax_plans_list?program_id=' + selectedProg.id);
    plansCache = Array.isArray(data) ? data : [];
    renderPlans();
  } catch(e) { flash(e.message, true); }
}

function renderPlans() {
  const tbody = document.getElementById('plan-tbody');
  if (!plansCache.length) {
    tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-4">No plans yet.</td></tr>';
    return;
  }
  tbody.innerHTML = plansCache.map(p => `
    <tr>
      <td class="fw-bold">${h(p.plan_name)}</td>
      <td class="text-muted">${h(p.plan_type||'—')}</td>
      <td>${money(p.price||p.final_price)}</td>
      <td class="text-muted">${h(p.duration||'—')}</td>
      <td><span class="badge rounded-pill ${p.status==='Active'?'text-bg-success':'text-bg-secondary'}">${h(p.status)}</span></td>
      <td>
        <button class="btn btn-sm btn-outline-secondary" onclick='editPlan(${JSON.stringify(p)})'>
          <i class="bi bi-pencil"></i>
        </button>
        <button class="btn btn-sm btn-outline-secondary" onclick="togglePlan(${p.id})" title="Toggle status">
          <i class="bi bi-toggle2-on"></i>
        </button>
        <button class="btn btn-sm btn-outline-danger" onclick="deletePlan(${p.id})">
          <i class="bi bi-trash"></i>
        </button>
      </td>
    </tr>
  `).join('');
}


/* ═══════════════════════════════════════════════════
   PLAN COMPONENT + INDIVIDUAL UNIT PRICING
═══════════════════════════════════════════════════ */

function planPricingTier(units) {
    if (!units || units < 1) return null;

    if (units <= 32) {
        return {
            tier: 'low',
            label: 'Unit 1–32'
        };
    }

    if (units <= 51) {
        return {
            tier: 'mid',
            label: 'Unit 33–51'
        };
    }

    return {
        tier: 'high',
        label: 'Unit 52'
    };
}


/*
 * Returns all selected components with their
 * individual unit values.
 */
function getSelectedPlanComponents() {

    const rows = document.querySelectorAll(
        '.plf-component-option:checked'
    );

    const result = [];

    rows.forEach(input => {

        const componentId = String(input.value);

        const component = compsCache.find(
            c => String(c.id) === componentId
        );

        if (!component) return;

        const unitInput = document.querySelector(
            `.plf-unit-input[data-component-id="${componentId}"]`
        );

        const units = unitInput
            ? parseInt(unitInput.value, 10) || 0
            : 0;

        const unitPrice = Number(
            component.price ||
            component.unit_price ||
            0
        );

        result.push({
            id: componentId,
            component: component,
            units: units,
            unitPrice: unitPrice,
            amount: Math.round(
                unitPrice * units * 100
            ) / 100
        });
    });

    return result;
}


/*
 * Get only selected component IDs.
 */
function getSelectedPlanComponentIds() {

    return getSelectedPlanComponents()
        .map(item => item.id);
}


/*
 * Render component checkboxes.
 *
 * IMPORTANT:
 * Each selected component gets its own
 * Unit input immediately below it.
 */
function renderPlanComponentOptions(selectedIds = [], unitMap = {}) {

    const selected = Array.isArray(selectedIds)
        ? selectedIds.map(String)
        : [];

    const wrap = document.getElementById(
        'plf-components-list'
    );

    if (!compsCache.length) {

        wrap.innerHTML = `
            <div class="text-muted small">
                No components available.
            </div>
        `;

        return;
    }

    wrap.innerHTML = compsCache.map(c => {

        const id = String(c.id);

        const unitPrice = Number(
            c.price ||
            c.unit_price ||
            0
        );

        const isSelected = selected.includes(id);

        const existingUnits =
            unitMap[id] !== undefined
                ? unitMap[id]
                : '';

        return `
            <div
                class="border rounded-3 p-3 mb-2 component-option-row"
                data-component-row="${id}"
            >

                <div class="d-flex align-items-start gap-3">

                    <div class="form-check pt-1">
                        <input
                            class="form-check-input plf-component-option"
                            type="checkbox"
                            value="${id}"
                            ${isSelected ? 'checked' : ''}
                            onchange="onPlanComponentSelectionChange('${id}')"
                        >
                    </div>

                    <div class="flex-grow-1 d-flex justify-content-between">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <label
                                    class="form-check-label fw-semibold"
                                    style="cursor:pointer"
                                >
                                    ${h(c.component_name)}
                                </label>

                                <div class="text-muted small">
                                    ₹${unitPrice.toLocaleString('en-IN')}/unit
                                </div>
                            </div>

                        </div>

                        <!-- Individual Unit -->
                        <div
                            class="mt-3 ${isSelected ? '' : 'd-none'}"
                            id="plf-unit-wrap-${id}"
                        >

                            <label class="form-label small fw-semibold mb-1">
                                Units
                            </label>

                            <div class="input-group input-group-sm"
                                 style="max-width:220px">

                                <input
                                    type="number"
                                    class="form-control plf-unit-input"
                                    data-component-id="${id}"
                                    min="1"
                                    max="365"
                                    step="1"
                                    value="${existingUnits}"
                                    placeholder="Enter units"
                                    oninput="onPlanPricingInputChange()"
                                >

                                <span class="input-group-text">
                                    unit(s)
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        `;

    }).join('');

    /*
     * Important:
     * Restore unit values after HTML is generated.
     */
    Object.entries(unitMap).forEach(([id, units]) => {

        const input = document.querySelector(
            `.plf-unit-input[data-component-id="${id}"]`
        );

        if (input) {
            input.value = units;
        }

    });

    onPlanPricingInputChange();
}


/*
 * Called when component checkbox is selected/unselected.
 */
function onPlanComponentSelectionChange(componentId) {

    const checkbox = document.querySelector(
        `.plf-component-option[value="${componentId}"]`
    );

    const wrap = document.getElementById(
        `plf-unit-wrap-${componentId}`
    );

    if (!checkbox || !wrap) return;

    if (checkbox.checked) {

        wrap.classList.remove('d-none');

        /*
         * If no value exists, default to 1.
         */
        const input = wrap.querySelector(
            '.plf-unit-input'
        );

        if (input && !input.value) {
            input.value = 1;
        }

    } else {

        wrap.classList.add('d-none');

        /*
         * Clear units when component is unselected.
         */
        const input = wrap.querySelector(
            '.plf-unit-input'
        );

        if (input) {
            input.value = '';
        }
    }

    onPlanPricingInputChange();
}


/*
 * Main pricing calculation.
 *
 * Example:
 *
 * Study Material ₹81 × 9 = ₹729
 * Mock Test     ₹50 × 3 = ₹150
 * Video         ₹30 × 5 = ₹150
 *
 * Base Amount = ₹1029
 */
function onPlanPricingInputChange() {

    const selectedComponents =
        getSelectedPlanComponents();

    const baseAmount =
        selectedComponents.reduce(
            (total, item) => total + item.amount,
            0
        );

    const pctInput =
        document.getElementById(
            'plf-discount-percent-input'
        );

    const pctDisplay =
        document.getElementById(
            'plf-discount-percent-display'
        );

    const purchaseList =
        document.getElementById(
            'plf-purchase-list'
        );

    const note =
        document.getElementById(
            'plf-tier-note'
        );

    /*
     * Discount
     */
    const discountPercent = Math.min(
        100,
        Math.max(
            0,
            Number(pctInput.value) || 0
        )
    );

    const discountAmount =
        Math.round(
            baseAmount *
            (discountPercent / 100) *
            100
        ) / 100;

    const finalAmount =
        Math.round(
            (baseAmount - discountAmount) *
            100
        ) / 100;


    /*
     * Display amounts
     */
    document.getElementById(
        'plf-base-amount'
    ).textContent = money(baseAmount);

    pctDisplay.textContent =
        discountPercent + '%';

    document.getElementById(
        'plf-discount-amount'
    ).textContent = money(discountAmount);

    document.getElementById(
        'plf-final-amount'
    ).textContent = money(finalAmount);

    /*
     * Hidden final price
     */
    document.getElementById(
        'plf-price'
    ).value = finalAmount;


    /*
     * Purchase List
     */
    if (!selectedComponents.length) {

        purchaseList.innerHTML = `
            <div class="small text-muted">
                No components selected.
            </div>
        `;

        note.textContent =
            'Select components and enter units to calculate.';

        return;
    }


    purchaseList.innerHTML =
        selectedComponents.map((item, index) => {

            return `
                <div class="small mb-1">
                    <span class="fw-semibold">
                        ${index + 1}.
                        ${h(item.component.component_name)}
                    </span>

                    <span class="text-muted">
                        (₹${Number(item.unitPrice).toLocaleString('en-IN')}/unit)
                        × ${item.units || 0}
                    </span>

                    <span class="fw-semibold">
                        = ${money(item.amount)}
                    </span>
                </div>
            `;

        }).join('');


    /*
     * Tier information
     */
    const unitValues = selectedComponents
        .map(item => item.units)
        .filter(Boolean);

    const maxUnits =
        unitValues.length
            ? Math.max(...unitValues)
            : 0;

    const tier =
        planPricingTier(maxUnits);

    note.textContent =
        tier
            ? `${tier.label} · Pricing calculated component-wise.`
            : 'Enter units for selected components.';
}


/*
 * Purchase List show/hide
 */
function togglePurchaseList() {

    const list =
        document.getElementById(
            'plf-purchase-list'
        );

    if (!list) return;

    list.classList.toggle('d-none');
}
async function ensurePlanComponentsLoaded() {
  if (!compsCache.length || compsCacheProgramId !== selectedProg.id) await loadComponents();
}


function openAddPlan() {

    document.getElementById(
        'plan-modal-title'
    ).textContent = 'Add Plan';

    document.getElementById('plf-id').value = '';

    document.getElementById(
        'plf-prog-id'
    ).value = selectedProg.id;

    document.getElementById(
        'plf-name'
    ).value = '';

    document.getElementById(
        'plf-price'
    ).value = '';

    document.getElementById(
        'plf-discount-percent-input'
    ).value = '';

    document.getElementById(
        'plf-plan-type'
    ).value = '';

    document.getElementById(
        'plf-duration'
    ).value = 'Monthly';

    document.getElementById(
        'plf-status'
    ).value = 'Active';

    document.getElementById(
        'plf-purchase-list'
    ).classList.add('d-none');

    ensurePlanComponentsLoaded().then(() => {

        renderPlanComponentOptions([]);

        onPlanPricingInputChange();

    });

    openModal('modal-plan');
}

async function editPlan(p) {

    document.getElementById(
        'plan-modal-title'
    ).textContent = 'Edit Plan';

    document.getElementById(
        'plf-id'
    ).value = p.id;

    document.getElementById(
        'plf-prog-id'
    ).value = p.program_id;

    document.getElementById(
        'plf-name'
    ).value = p.plan_name;

    document.getElementById(
        'plf-price'
    ).value =
        p.price ||
        p.final_price ||
        '';

    setSelectValue(
        'plf-plan-type',
        p.plan_type || ''
    );

    setSelectValue(
        'plf-duration',
        p.duration || 'Monthly'
    );

    setSelectValue(
        'plf-status',
        p.status || 'Active'
    );

    await ensurePlanComponentsLoaded();

    /*
     * Build:
     *
     * {
     *   componentId: units
     * }
     */
    const unitMap = {};

    const links =
        Array.isArray(p.components)
            ? p.components
            : [];

    links.forEach(c => {

        if (
            c.component_id !== undefined &&
            Number(c.units) > 0
        ) {
            unitMap[String(c.component_id)] =
                Number(c.units);
        }

    });

    /*
     * Selected component IDs
     */
    const selectedIds =
        links.map(c =>
            String(c.component_id)
        );

    renderPlanComponentOptions(
        selectedIds,
        unitMap
    );

    /*
     * Restore discount
     */
    document.getElementById(
        'plf-discount-percent-input'
    ).value =
        p.discount_percent !== undefined &&
        p.discount_percent !== null
            ? p.discount_percent
            : '';

    onPlanPricingInputChange();

    openModal('modal-plan');
}

async function savePlan() {

    const name =
        document.getElementById(
            'plf-name'
        ).value.trim();

    const planId =
        document.getElementById(
            'plf-id'
        ).value;

    const programId =
        document.getElementById(
            'plf-prog-id'
        ).value;

    const selectedComponents =
        getSelectedPlanComponents();


    /*
     * Basic validation
     */
    if (!name) {

        alert('Plan Name is required.');

        return;
    }

    const planType =
        document.getElementById(
            'plf-plan-type'
        ).value;

    if (!planType) {

        alert('Please select a Plan Type.');

        return;
    }


    if (!selectedComponents.length) {

        alert(
            'Please select at least one Component.'
        );

        return;
    }


    /*
     * Every selected component must have
     * its own unit value.
     */
    const invalidComponent =
        selectedComponents.find(
            item =>
                !item.units ||
                item.units < 1 ||
                item.units > 365
        );

    if (invalidComponent) {

        alert(
            'Please enter Units between 1 and 365 for ' +
            invalidComponent.component.component_name +
            '.'
        );

        return;
    }


    /*
     * Discount validation
     */
    const pct =
        document.getElementById(
            'plf-discount-percent-input'
        ).value;

    if (
        pct === '' ||
        Number(pct) < 0 ||
        Number(pct) > 100
    ) {

        alert(
            'Please enter a discount % (0–100).'
        );

        return;
    }


    /*
     * Build request
     */
    const fd = new URLSearchParams();

    fd.set('id', planId);

    fd.set(
        'program_id',
        programId
    );

    fd.set(
        'plan_name',
        name
    );

    fd.set(
        'plan_type',
        planType
    );

    fd.set(
        'duration',
        document.getElementById(
            'plf-duration'
        ).value
    );

    fd.set(
        'status',
        document.getElementById(
            'plf-status'
        ).value
    );

    fd.set(
        'discount_percent',
        pct
    );


    /*
     * Send each component + its own units.
     *
     * Example:
     *
     * component_ids[] = 1
     * component_units[1] = 9
     *
     * component_ids[] = 2
     * component_units[2] = 3
     *
     * component_ids[] = 3
     * component_units[3] = 5
     */
    selectedComponents.forEach(item => {

        fd.append(
            'component_ids[]',
            item.id
        );

        fd.set(
            `component_units[${item.id}]`,
            item.units
        );

    });


    /*
     * Keep first component for backward compatibility
     * with existing backend code.
     */
    fd.set(
        'component_id',
        selectedComponents[0].id
    );

    fd.set(
        'units',
        selectedComponents[0].units
    );


    /*
     * Final calculated price
     */
    const price =
        document.getElementById(
            'plf-price'
        ).value;

    if (
        price === '' ||
        Number(price) < 0
    ) {

        alert(
            'Could not calculate a valid amount.'
        );

        return;
    }

    fd.set('price', price);


    try {

        await req(
            'ajax_plans_save',
            {
                method: 'POST',
                body: fd
            }
        );

        closeModal('modal-plan');

        flash('Plan saved.');

        loadPlans();

    } catch (e) {

        flash(
            e.message,
            true
        );
    }
}
async function togglePlan(id) {
  try {
    await req('ajax_plans_toggle/' + id, { method:'POST' });
    loadPlans();
  } catch(e) { flash(e.message, true); }
}

async function deletePlan(id) {
  if (!confirm('Delete this plan?')) return;
  try {
    await req('ajax_plans_delete/' + id, { method:'POST' });
    flash('Plan deleted.');
    loadPlans();
  } catch(e) { flash(e.message, true); }
}

/* ═══════════════════════════════════════════════════
   UPLOAD TABS
═══════════════════════════════════════════════════ */
function setUploadTab(name, el) {
  document.querySelectorAll('.upload-tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.upload-tab-panel').forEach(p => p.classList.remove('active'));
  el.classList.add('active');
  document.getElementById('utab-' + name).classList.add('active');
  if (name === 'view') { populateUploadViewPrograms(); renderUploadView(); }
}

/* ═══════════════════════════════════════════════════
   INDIVIDUAL UPLOAD: allowed file types + helpers
═══════════════════════════════════════════════════ */
const IND_DOC_EXT   = ['pdf','doc','docx','ppt','pptx','xls','xlsx','jpg','jpeg','png','gif'];
const IND_VIDEO_EXT = ['mp4','mov','avi','mkv','webm'];
const IND_AUDIO_EXT = ['mp3','wav','m4a','aac','ogg'];
const INDIVIDUAL_ALLOWED_EXT = [...IND_DOC_EXT, ...IND_VIDEO_EXT, ...IND_AUDIO_EXT];
const INDIVIDUAL_ACCEPT = INDIVIDUAL_ALLOWED_EXT.map(e => '.' + e).join(',');

function getFileExt(name) {
  return String(name || '').split('.').pop().toLowerCase();
}

function detectIndividualContentType(file, component) {
  const ext = getFileExt(file.name);
  if (IND_VIDEO_EXT.includes(ext)) return 'video';
  if (IND_AUDIO_EXT.includes(ext)) return 'audio';
  return getComponentContentKey(component) || 'study_pack';
}

/* uploadSelectedUnitFiles() isi ko call karta hai (pehle defined hi nahi tha) */
function uploadWithProgress(path, formData, onPercent) {
  return xhrUploadWithProgress(API + path, formData, (loaded, total) => {
    if (onPercent) onPercent(total ? (loaded / total) * 100 : 0);
  });
}
function renderUnitFields() {
  const from = parseInt(document.getElementById('ul-from').value);
  const to   = parseInt(document.getElementById('ul-to').value);
  const wrap = document.getElementById('unit-fields-wrap');

  if (!from || !to || from > to || to > 365) {
    wrap.innerHTML = '<div class="border border-2 border-dashed rounded-3 p-4 text-center text-muted bg-light"><div class="fw-semibold text-secondary mb-1">Select From Unit and To Unit</div>Unit-wise upload fields will appear here.</div>';
    return;
  }

  let html = '<div class="d-flex flex-column gap-2">';
  for (let u = from; u <= to; u++) {
    html += `<div class="d-flex align-items-center gap-3 border rounded-3 p-2 px-3 bg-light">
      <span class="fw-bold text-secondary small" style="width:70px;flex-shrink:0">Unit ${u}</span>
      <input type="file" class="form-control form-control-sm" data-unit="${u}" multiple accept="${INDIVIDUAL_ACCEPT}">
    </div>`;
  }
  html += '</div>';
  html += '<div class="form-text mt-2">Allowed: PDF, DOC/DOCX, PPT/PPTX, XLS/XLSX, images, Video (MP4), Audio (MP3,)".</div>';
  wrap.innerHTML = html;

  // Galat file (ZIP bhi) select karte hi reject
  wrap.querySelectorAll('[data-unit]').forEach(input => {
    input.addEventListener('change', () => {
      const bad = Array.from(input.files || []).filter(f => !INDIVIDUAL_ALLOWED_EXT.includes(getFileExt(f.name)));
      if (bad.length) {
        alert('Allowed: PDF, DOC, PPT, XLS, images, video and audio.\nRejected: ' + bad.map(f => f.name).join(', '));
        input.value = '';
      }
    });
  });
}
/* Shared <option> list for the per-row Class dropdown in the ZIP
   upload tab. Mirrors the classes offered by #ul-zip-class. */
function zipClassOptionsHtml(selected) {
  const opts = [
    ['0', 'All'],
    ['-3', 'Nursery'],
    ['-2', 'LKG'],
    ['-1', 'UKG']
  ];
  for (let g = 1; g <= 12; g++) opts.push([String(g), 'Class-' + g]);
  return opts.map(([val, label]) =>
    `<option value="${val}"${String(selected) === val ? ' selected' : ''}>${label}</option>`
  ).join('');
}

function renderZipFields() {
  const from = parseInt(document.getElementById('ul-zip-from').value);
  const to   = parseInt(document.getElementById('ul-zip-to').value);
  const wrap = document.getElementById('zip-fields-wrap');

  if (!from || !to || from > to || to > 365) {
    wrap.innerHTML = '<div class="border border-2 border-dashed rounded-3 p-4 text-center text-muted bg-light"><div class="fw-semibold text-secondary mb-1">Select From Unit and To Unit</div>ZIP upload fields will appear here.</div>';
    return;
  }

  let html = '<div class="d-flex flex-column gap-2">';
  for (let u = from; u <= to; u++) {
    html += `<div class="d-flex align-items-center gap-3 border rounded-3 p-2 px-3 bg-light">
      <span class="fw-bold text-secondary small" style="width:70px;flex-shrink:0">Unit ${u}</span>
      <select class="form-select form-select-sm" data-zip-unit-class="${u}" style="max-width:160px">
        ${zipClassOptionsHtml('0')}
      </select>
      <input type="file" class="form-control form-control-sm" data-zip-unit="${u}" accept=".zip,application/zip,application/x-zip-compressed">
    </div>`;
  }
  html += '</div>';
  wrap.innerHTML = html;

  // Sirf .zip allowed
  wrap.querySelectorAll('[data-zip-unit]').forEach(input => {
    input.addEventListener('change', () => {
      const file = input.files && input.files[0];
      if (!file) return;
      if (!/\.zip$/i.test(file.name)) {
        alert('Only .zip files are allowed here. "' + file.name + '" was not accepted.');
        input.value = '';
      }
    });
  });
}

function isUnitAlreadyUploaded(unit, componentId, classNumber, contentType) {
  return componentUploadsCache.some(u => {
    if (!u) return false;

    const sameComponent = String(u.component_id ?? '') === String(componentId);
    const sameClass     = String(u.class_number ?? '0') === String(classNumber);
    if (!sameComponent || !sameClass) return false;

    // contentType diya ho to sirf same type ko duplicate maano
    // (taaki ek unit me PDF + video + mp3 alag upload ho sakein)
    if (contentType && u.content_type && String(u.content_type) !== String(contentType)) return false;

    const existingUnit = Number(u.week_number ?? 0);
    const existingEnd  = Number(u.end_unit ?? u.week_number ?? 0);
    const rangeStart   = Math.min(existingUnit, existingEnd);
    const rangeEnd     = Math.max(existingUnit, existingEnd);
    return unit >= rangeStart && unit <= rangeEnd;
  });
}

function ensureIndividualProgress() {
  let wrap = document.getElementById('individual-upload-progress');
  if (wrap) return wrap;

  const panel = document.getElementById('utab-individual');
  if (!panel) return null;

  wrap = document.createElement('div');
  wrap.id = 'individual-upload-progress';
  wrap.className = 'mt-3 d-none';
  wrap.innerHTML = `
    <div class="d-flex justify-content-between small text-muted mb-1">
      <span id="individual-upload-progress-text">Uploading…</span>
      <span id="individual-upload-progress-percent">0%</span>
    </div>
    <div class="progress" style="height:8px;">
      <div id="individual-upload-progress-bar"
           class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
           role="progressbar" style="width:0%"></div>
    </div>`;

  const btnRow = panel.querySelector('button[onclick="uploadSelectedUnitFiles()"]')?.parentNode;
  if (btnRow) panel.insertBefore(wrap, btnRow);
  else panel.appendChild(wrap);
  return wrap;
}

async function uploadSelectedUnitFiles() {

  if (!selectedProg) { alert('Please select a program first.'); return; }

  const componentSelect = document.getElementById('ul-component');
  if (!componentSelect) { alert('Component selector is unavailable in the current upload view.'); return; }

  const from        = parseInt(document.getElementById('ul-from').value);
  const to          = parseInt(document.getElementById('ul-to').value);
  const classNumber = parseInt(document.getElementById('ul-class-number').value || '0');
  const componentId = componentSelect.value;

  if (!from || !to || from > to) { alert('Please choose a valid From Unit and To Unit range.'); return; }
  if (isNaN(classNumber) || classNumber < -3 || classNumber > 12) { alert('Please select a valid class.'); return; }
  if (!componentId) { alert('Please select a component before uploading files.'); return; }

  const component = compsCache.find(c => String(c.id) === String(componentId));
  if (!component) { alert('Selected component could not be found. Please choose another component.'); return; }

  /* ── Files collect ── */
  const uploadTasks    = [];
  const duplicateUnits = [];
  const invalidFiles   = [];

  document.querySelectorAll('#unit-fields-wrap [data-unit]').forEach(input => {
    const files = input.files ? Array.from(input.files) : [];
    if (!files.length) return;

    const unit = Number(input.getAttribute('data-unit'));

    files.forEach(file => {
      const ext = getFileExt(file.name);

      if (!INDIVIDUAL_ALLOWED_EXT.includes(ext)) {
        invalidFiles.push('Unit ' + unit + ' (' + file.name + ')');
        return;
      }

      const ctype = detectIndividualContentType(file, component);

      if (isUnitAlreadyUploaded(unit, componentId, classNumber, ctype)) {
        duplicateUnits.push(unit + ' [' + ctype + ']');
        return;
      }

      uploadTasks.push({ unit: unit, file: file, contentType: ctype });
    });
  });

  if (invalidFiles.length) {
    flash('File type not allowed: ' + invalidFiles.join(', '), true);
  }
  if (duplicateUnits.length) {
    flash('Already uploaded for Unit ' + duplicateUnits.join(', ') + '.', true);
  }
  if (!uploadTasks.length) {
    if (!invalidFiles.length && !duplicateUnits.length) flash('Please choose at least one file.', true);
    return;
  }

  /* ── Progress UI ── */
  const progressWrap    = ensureIndividualProgress();
  const progressBar     = document.getElementById('individual-upload-progress-bar');
  const progressText    = document.getElementById('individual-upload-progress-text');
  const progressPercent = document.getElementById('individual-upload-progress-percent');

  const setProgress = (pct, label) => {
    pct = Math.max(0, Math.min(100, pct));
    if (progressBar)     progressBar.style.width = pct + '%';
    if (progressPercent) progressPercent.textContent = Math.round(pct) + '%';
    if (label && progressText) progressText.textContent = label;
  };

  const uploadButton = document.querySelector('button[onclick="uploadSelectedUnitFiles()"]');
  if (uploadButton) uploadButton.disabled = true;
  if (progressWrap) progressWrap.classList.remove('d-none');
  setProgress(0, 'Starting upload…');

  const totalBytes    = uploadTasks.reduce((sum, t) => sum + t.file.size, 0) || 1;
  let   bytesDone     = 0;
  let   totalUploaded = 0;
  const failedUploads = [];

  try {
    for (let i = 0; i < uploadTasks.length; i++) {
      const task = uploadTasks[i];
      const label = 'Uploading Unit ' + task.unit + ' – ' + task.file.name + ' (' + (i + 1) + ' of ' + uploadTasks.length + ')…';

      setProgress((bytesDone / totalBytes) * 100, label);

      const fd = new FormData();
      fd.append('program_id',    selectedProg.id);
      fd.append('component_id',  componentId);
      fd.append('material_maker_id', document.getElementById('ul-material-maker').value);
      fd.append('week_number',   task.unit);
      fd.append('end_unit',      task.unit);
      fd.append('class_number',  classNumber);
      fd.append('content_type',  task.contentType);
      fd.append('upload_source', 'individual');
      fd.append('file',          task.file);

      try {
        await uploadWithProgress('ajax_content_upload', fd, (filePct) => {
          const current = bytesDone + (task.file.size * filePct / 100);
          setProgress((current / totalBytes) * 100);
        });
        totalUploaded++;
      } catch (e) {
        failedUploads.push('Unit ' + task.unit + ' (' + task.file.name + '): ' + e.message);
      }

      bytesDone += task.file.size;
      setProgress((bytesDone / totalBytes) * 100);
    }

    setProgress(100, 'Upload complete.');

  } finally {
    if (uploadButton) uploadButton.disabled = false;
    setTimeout(() => {
      if (progressWrap) progressWrap.classList.add('d-none');
      setProgress(0);
    }, 1000);
  }

  if (failedUploads.length) {
    flash(failedUploads.join(' | '), true);
  }

  if (totalUploaded > 0) {
    await loadComponents();       // cache + "View Upload" table refresh
    renderUnitFields();           // file inputs reset
    if (!failedUploads.length) {
      flash(totalUploaded + ' file(s) uploaded successfully.');
    }
  }
}
async function uploadSelectedZipFiles() {
  if (!selectedProg) { alert('Please select a program first.'); return; }
  const componentSelect = document.getElementById('ul-zip-component');
  if (!componentSelect) {
    alert('ZIP component selector is unavailable in the current upload view.');
    return;
  }

  const from = parseInt(document.getElementById('ul-zip-from').value);
  const to   = parseInt(document.getElementById('ul-zip-to').value);
  const componentId = componentSelect.value;
  if (!from || !to || from > to) { alert('Please choose a valid From Unit and To Unit range.'); return; }
  if (!componentId) { alert('Please select a component before uploading ZIP files.'); return; }

  let totalExtracted = 0;
  let bundlesUploaded = 0;
  const duplicateUnits = [];
  const failedUnits = [];
  const typeBreakdown = {};
  const skippedItems = [];
  const zipInputs = document.querySelectorAll('[data-zip-unit]');
  const rejectedNonZip = [];
  const invalidClassUnits = [];

  /* ── Build the list of valid upload tasks first, so we know the
     total bytes to upload up front and can show accurate overall
     progress across the whole batch, not just per-file. ── */
  const tasks = [];
  for (const input of zipInputs) {
    const file = input.files && input.files[0] ? input.files[0] : null;
    if (!file) continue;
    const unit = Number(input.getAttribute('data-zip-unit'));

    const classSelect = document.querySelector(`[data-zip-unit-class="${unit}"]`);
    const classNumber = parseInt(classSelect ? classSelect.value : NaN);
    if (isNaN(classNumber) || classNumber < -3 || classNumber > 12) {
      invalidClassUnits.push(unit);
      continue;
    }

    if (!/\.zip$/i.test(file.name)) {
      rejectedNonZip.push('Unit ' + unit + ' (' + file.name + ')');
      input.value = '';
      continue;
    }
    if (isUnitAlreadyUploaded(unit, componentId, classNumber)) {
      duplicateUnits.push(unit);
      continue;
    }
    tasks.push({ unit, classNumber, file });
  }

  if (invalidClassUnits.length) {
    flash('Please select a valid class for Unit ' + invalidClassUnits.join(', ') + '.', true);
  }
  if (rejectedNonZip.length) {
    flash('Only .zip files are accepted here — rejected: ' + rejectedNonZip.join(', '), true);
  }
  if (duplicateUnits.length) {
    flash('Already uploaded for Unit ' + duplicateUnits.join(', ') + '.', true);
  }

  if (!tasks.length) return; // nothing left that actually needs uploading

  const totalBytes = tasks.reduce((sum, t) => sum + t.file.size, 0) || 1;
  let bytesDoneBeforeCurrent = 0;

  const btn = document.getElementById('zip-upload-btn');
  if (btn) btn.disabled = true;
  showZipProgress();

  try {
    for (let i = 0; i < tasks.length; i++) {
      const { unit, classNumber, file } = tasks[i];

      setZipProgress(
        (bytesDoneBeforeCurrent / totalBytes) * 100,
        `Uploading Unit ${unit} (${i + 1} of ${tasks.length})…`
      );

      const fd = new FormData();
      fd.append('program_id', selectedProg.id);
      fd.append('component_id', componentId);
      fd.append('material_maker_id', document.getElementById('ul-zip-material-maker').value);
      fd.append('week_number', unit);
      fd.append('end_unit', unit);
      fd.append('class_number', classNumber);
      fd.append('upload_source', 'zip');
      fd.append('file', file);

      try {
        const res = await xhrUploadWithProgress(API + 'ajax_content_upload', fd, (loaded) => {
          setZipProgress(
            ((bytesDoneBeforeCurrent + loaded) / totalBytes) * 100,
            `Uploading Unit ${unit} (${i + 1} of ${tasks.length})…`
          );
        });

        bundlesUploaded += 1;
        totalExtracted += (res && res.extracted_count) ? res.extracted_count : 0;
        if (res && res.breakdown) {
          Object.entries(res.breakdown).forEach(([type, count]) => {
            typeBreakdown[type] = (typeBreakdown[type] || 0) + Number(count);
          });
        }
        if (res && res.skipped && res.skipped.length) {
          skippedItems.push('Unit ' + unit + ': ' + res.skipped.join(', '));
        }
      } catch (e) {
        // One unit failing shouldn't abort the rest of the batch.
        failedUnits.push('Unit ' + unit + ': ' + e.message);
      }

      bytesDoneBeforeCurrent += file.size;
      setZipProgress((bytesDoneBeforeCurrent / totalBytes) * 100);
    }

    setZipProgress(100, 'Upload complete.');
  } finally {
    if (btn) btn.disabled = false;
    setTimeout(hideZipProgress, 800);
  }

  if (skippedItems.length) {
    flash('Some items already existed and were skipped — ' + skippedItems.join(' | '), true);
  }
  if (failedUnits.length) {
    flash(failedUnits.join(' | '), true);
  }

  if (bundlesUploaded > 0) {
    await loadComponents();
    const breakdownText = Object.entries(typeBreakdown)
      .map(([type, count]) => count + ' ' + type)
      .join(', ');
    flash(bundlesUploaded + ' ZIP bundle(s) processed — ' + totalExtracted + ' file(s) extracted' +
      (breakdownText ? ' (' + breakdownText + ')' : '') + '.');
  }
}
/* ── XHR upload with real progress events (fetch can't do this) ── */
function xhrUploadWithProgress(url, formData, onProgress) {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', url);
    xhr.upload.addEventListener('progress', (e) => {
      if (e.lengthComputable && onProgress) onProgress(e.loaded, e.total);
    });
    xhr.onload = () => {
      let obj;
      try { obj = xhr.responseText ? JSON.parse(xhr.responseText) : {}; }
      catch (err) { return reject(new Error('Bad JSON response from server.')); }
      if (xhr.status >= 200 && xhr.status < 300) resolve(obj);
      else reject(new Error(obj.error || 'Error ' + xhr.status));
    };
    xhr.onerror = () => reject(new Error('Network error during upload.'));
    xhr.send(formData);
  });
}

function showZipProgress() {
  document.getElementById('zip-upload-progress-wrap').classList.remove('d-none');
  setZipProgress(0, 'Starting upload…');
}
function hideZipProgress() {
  document.getElementById('zip-upload-progress-wrap').classList.add('d-none');
}
function setZipProgress(pct, label) {
  pct = Math.max(0, Math.min(100, pct));
  document.getElementById('zip-upload-progress-bar').style.width = pct + '%';
  document.getElementById('zip-upload-progress-pct').textContent = Math.round(pct) + '%';
  if (label) document.getElementById('zip-upload-progress-label').textContent = label;
}
/* ═══════════════════════════════════════════════════
  SUBJECTS AND SUBJECT CATEGORIES
═══════════════════════════════════════════════════ */
let productsCache = [];
let productCategoriesCache = [];

function showMasterTab(tab) {
  const programPanel = document.getElementById('program-management-panel');
  const productPanel = document.getElementById('product-management-panel');
  const programNav = document.getElementById('nav-program-management');
  const productNav = document.getElementById('nav-product-management');
  const isProducts = tab === 'products';
  programPanel.classList.toggle('d-none', isProducts);
  productPanel.classList.toggle('d-none', !isProducts);
  programNav.classList.toggle('active', !isProducts);
  productNav.classList.toggle('active', isProducts);
  if (isProducts) {
    showProductTab('products');
    loadProducts();
  }
}

function showProductTab(tab) {
  const isProducts = tab === 'products';
  document.getElementById('product-tab-panel').classList.toggle('d-none', !isProducts);
  document.getElementById('category-tab-panel').classList.toggle('d-none', isProducts);
  document.getElementById('product-tab-link').classList.toggle('active', isProducts);
  document.getElementById('category-tab-link').classList.toggle('active', !isProducts);
  if (isProducts) loadProducts();
  else { loadProducts(); loadProductCategories(); }
}

async function loadProducts() {
  try {
    const data = await req('ajax_products_list');
    productsCache = Array.isArray(data) ? data : [];
    const tbody = document.getElementById('product-tbody');
    tbody.innerHTML = productsCache.length ? productsCache.map(p => `
      <tr><td class="fw-bold">${h(p.sub_name)}</td>
      <td><span class="badge ${p.status === 'Active' ? 'text-bg-success' : 'text-bg-secondary'}">${h(p.status)}</span></td>
      <td><button class="btn btn-sm btn-outline-secondary" onclick='editProduct(${JSON.stringify(p)})'><i class="bi bi-pencil"></i></button>
      <button class="btn btn-sm btn-outline-danger" onclick="deleteProduct(${p.sub_id})"><i class="bi bi-trash"></i></button></td></tr>
    `).join('') : '<tr><td colspan="3" class="text-center text-muted py-4">No subjects yet.</td></tr>';
  } catch (e) { flash(e.message, true); }
}

function openProductForm(product = null) {
  document.getElementById('product-form').classList.remove('d-none');
  document.getElementById('product-id').value = product ? product.sub_id : '';
  document.getElementById('product-name').value = product ? product.sub_name : '';
  document.getElementById('product-status').value = product ? (product.status || 'Active') : 'Active';
  document.getElementById('product-name').focus();
}
function closeProductForm() { document.getElementById('product-form').classList.add('d-none'); }
function editProduct(product) { openProductForm(product); }
async function saveProduct(event) {
  event.preventDefault();
  const fd = new FormData();
  fd.append('id', document.getElementById('product-id').value);
  fd.append('product_name', document.getElementById('product-name').value.trim());
  fd.append('status', document.getElementById('product-status').value);
  try { await req('ajax_products_save', {method: 'POST', body: fd}); closeProductForm(); flash('Subject saved.'); loadProducts(); }
  catch (e) { flash(e.message, true); }
}
async function deleteProduct(id) {
  if (!confirm('Delete this subject?')) return;
  try { await req('ajax_products_delete/' + id, {method: 'POST'}); flash('Subject deleted.'); loadProducts(); }
  catch (e) { flash(e.message, true); }
}

async function loadProductCategories() {
  try {
    if (!productsCache.length) await loadProducts();
    const data = await req('ajax_product_categories_list');
    productCategoriesCache = Array.isArray(data) ? data : [];
    const subjectSelect = document.getElementById('category-subject');
    subjectSelect.innerHTML = '<option value="">Select Subject</option>' + productsCache
      .filter(s => s.status === 'Active')
      .map(s => `<option value="${s.sub_id}">${h(s.sub_name)}</option>`).join('');
    const tbody = document.getElementById('category-tbody');
    tbody.innerHTML = productCategoriesCache.length ? productCategoriesCache.map(c => `
      <tr><td class="fw-bold">${h(c.sub_name || 'Unknown subject')}<div class="text-muted small">${h(c.category_name)}</div></td>
      <td><span class="badge ${c.status === 'Active' ? 'text-bg-success' : 'text-bg-secondary'}">${h(c.status)}</span></td>
      <td><button class="btn btn-sm btn-outline-secondary" onclick='editProductCategory(${JSON.stringify(c)})'><i class="bi bi-pencil"></i></button>
      <button class="btn btn-sm btn-outline-danger" onclick="deleteProductCategory(${c.category_id})"><i class="bi bi-trash"></i></button></td></tr>
    `).join('') : '<tr><td colspan="3" class="text-center text-muted py-4">No subject categories yet.</td></tr>';
  } catch (e) { flash(e.message, true); }
}
function openCategoryForm(category = null) {
  document.getElementById('category-form').classList.remove('d-none');
  document.getElementById('category-id').value = category ? category.category_id : '';
  document.getElementById('category-subject').value = category ? category.sub_id : '';
  document.getElementById('category-name').value = category ? category.category_name : '';
  document.getElementById('category-status').value = category ? (category.status || 'Active') : 'Active';
  document.getElementById('category-name').focus();
}
function closeCategoryForm() { document.getElementById('category-form').classList.add('d-none'); }
function editProductCategory(category) { openCategoryForm(category); }
async function saveProductCategory(event) {
  event.preventDefault();
  const fd = new FormData();
  fd.append('id', document.getElementById('category-id').value);
  fd.append('sub_id', document.getElementById('category-subject').value);
  fd.append('category_name', document.getElementById('category-name').value.trim());
  fd.append('status', document.getElementById('category-status').value);
  try { await req('ajax_product_categories_save', {method: 'POST', body: fd}); closeCategoryForm(); flash('Subject category saved.'); loadProductCategories(); }
  catch (e) { flash(e.message, true); }
}
async function deleteProductCategory(id) {
  if (!confirm('Delete this subject category?')) return;
  try { await req('ajax_product_categories_delete/' + id, {method: 'POST'}); flash('Subject category deleted.'); loadProductCategories(); }
  catch (e) { flash(e.message, true); }
}
/* ═══════════════════════════════════════════════════
   PROGRAM LOOKUPS: Subjects / Domains / Material Types
═══════════════════════════════════════════════════ */
const LOOKUP_ENDPOINTS = {
  subjects:       'ajax_program_subjects',
  domains:        'ajax_program_domains',
  material_types: 'ajax_program_material_types'
};
const lookupCache = { subjects: [], domains: [], material_types: [] };

/* Material Maker: read-only list from the existing `material_maker`
   vendor table (managed elsewhere in the app) — just used here to
   populate the Individual/ZIP upload dropdowns. */
let materialMakerCache = [];
async function loadMaterialMakers() {
  try {
    const data = await req('ajax_material_makers_list');
    materialMakerCache = Array.isArray(data) ? data : [];
    populateMaterialMakerOptions();
  } catch (e) { flash(e.message, true); }
}
function populateMaterialMakerOptions() {
  const active = materialMakerCache.filter(r => String(r.status).toLowerCase() === 'active');
  const optionsHtml = '<option value="">-- Select Material Maker --</option>' +
    active.map(r => `<option value="${r.id}">${h(r.name)}</option>`).join('');
  ['ul-material-maker', 'ul-zip-material-maker'].forEach(id => {
    const sel = document.getElementById(id);
    if (!sel) return;
    const current = sel.value;
    sel.innerHTML = optionsHtml;
    setSelectValue(id, current);
  });
}

async function loadLookup(type) {
  try {
    const data = await req(LOOKUP_ENDPOINTS[type] + '_list');
    lookupCache[type] = Array.isArray(data) ? data : [];
    renderLookupTable(type);
    populateProgramFieldOptions(); // keep ap-subject/ap-domain in sync
    populateComponentDomainOptions();
    populateComponentTypeOptions();
    populateDomainSubjectOptions(); // keep the Subject picker inside the Add Domain form in sync
  } catch (e) { flash(e.message, true); }
}

function renderLookupTable(type) {
  const tbody = document.getElementById('lookup-tbody-' + type);
  const rows = lookupCache[type];
  if (!rows.length) {
    tbody.innerHTML = '<tr><td colspan="3" class="text-center text-muted py-4">No entries yet.</td></tr>';
    return;
  }
  tbody.innerHTML = rows.map(r => `
    <tr>
      <td class="fw-bold">${h(r.name)}</td>
      <td><span class="badge rounded-pill ${r.status==='Active'?'text-bg-success':'text-bg-secondary'}">${h(r.status)}</span></td>
      <td>
        <button class="btn btn-sm btn-outline-secondary" onclick='editLookup("${type}", ${JSON.stringify(r)})'>
          <i class="bi bi-pencil"></i>
        </button>
        <button class="btn btn-sm btn-outline-danger" onclick="deleteLookup('${type}', ${r.id})">
          <i class="bi bi-trash"></i>
        </button>
      </td>
    </tr>
  `).join('');
}

function openLookupForm(type, row = null) {
  document.getElementById('lk-' + type + '-id').value     = row ? row.id : '';
  document.getElementById('lk-' + type + '-name').value   = row ? row.name : '';
  document.getElementById('lk-' + type + '-status').value = row ? (row.status || 'Active') : 'Active';
  if (type === 'domains') {
    document.getElementById('lk-domains-subject').value = row ? (row.sub_id || '') : '';
  }
  document.getElementById('lookup-form-' + type).classList.remove('d-none');
  document.getElementById('lk-' + type + '-name').focus();
}
function closeLookupForm(type) {
  document.getElementById('lookup-form-' + type).classList.add('d-none');
}
function editLookup(type, row) { openLookupForm(type, row); }

async function saveLookup(type) {
  const name = document.getElementById('lk-' + type + '-name').value.trim();
  if (!name) { alert('Name is required.'); return; }

  const fd = new FormData();
  fd.append('id',     document.getElementById('lk-' + type + '-id').value);
  fd.append('name',   name);
  fd.append('status', document.getElementById('lk-' + type + '-status').value);
  if (type === 'domains') {
    fd.append('sub_id', document.getElementById('lk-domains-subject').value);
  }

  try {
    await req(LOOKUP_ENDPOINTS[type] + '_save', { method: 'POST', body: fd });
    closeLookupForm(type);
    flash('Saved.');
    await loadLookup(type);
  } catch (e) { flash(e.message, true); }
}

async function deleteLookup(type, id) {
  if (!confirm('Delete this entry?')) return;
  try {
    await req(LOOKUP_ENDPOINTS[type] + '_delete/' + id, { method: 'POST' });
    flash('Deleted.');
    await loadLookup(type);
  } catch (e) { flash(e.message, true); }
}

/* Repopulate the Add/Edit Program Subject select from live lookup data,
   preserving any legacy value already selected, then rebuild the
   Domain select so it only shows domains belonging to that Subject. */
function populateProgramFieldOptions() {
  const sel = document.getElementById('ap-subject');
  if (sel) {
    const current = sel.value;
    const active = lookupCache.subjects.filter(r => r.status === 'Active');
    sel.innerHTML = '<option value="">-- Select Subject --</option>' +
      active.map(r => `<option value="${h(r.name)}">${h(r.name)}</option>`).join('');
    setSelectValue('ap-subject', current);
  }
  populateProgramDomainOptions();
}

/* Add/Edit Program's Domain select — shows only the domains that
   belong to whichever Subject is currently selected. Pass a preset
   value (e.g. when opening Edit Program) to try and restore it. */
function populateProgramDomainOptions(preset) {
  const sel = document.getElementById('ap-domain');
  if (!sel) return;

  const current = (preset !== undefined && preset !== null) ? String(preset) : sel.value;
  const subjEl = document.getElementById('ap-subject');
  const subjName = subjEl ? subjEl.value : '';

  if (!subjName) {
    sel.innerHTML = '<option value="">-- Select Subject first --</option>';
    sel.value = '';
    return;
  }

  const subject = lookupCache.subjects.find(r => String(r.name) === String(subjName));
  const active  = lookupCache.domains.filter(r =>
    r.status === 'Active' && subject && String(r.sub_id) === String(subject.id)
  );

  sel.innerHTML = '<option value="">-- Select Domain --</option>' +
    active.map(r => `<option value="${h(r.name)}">${h(r.name)}</option>`).join('');

  if (active.some(r => String(r.name) === current)) {
    sel.value = current;
  } else if (current) {
    // legacy/mismatched value (older data saved before this subject link
    // existed) — keep it visible instead of silently blanking it out.
    setSelectValue('ap-domain', current);
  } else {
    sel.value = '';
  }
}

/* Subject changed inside Add/Edit Program — rebuild + reset Domain. */
function onProgramSubjectChange() {
  populateProgramDomainOptions('');
}

/* Keep the Subject picker inside the Add Domain form (lk-domains-subject)
   in sync with the live Subjects lookup, so a subject added moments ago
   is selectable right away without a page reload. */
function populateDomainSubjectOptions() {
  const sel = document.getElementById('lk-domains-subject');
  if (!sel) return;
  const current = sel.value;
  const active = lookupCache.subjects.filter(r => r.status === 'Active');
  sel.innerHTML = '<option value="">-- Select Subject --</option>' +
    active.map(r => `<option value="${r.id}">${h(r.name)}</option>`).join('');
  setSelectValue('lk-domains-subject', current);
}

function populateComponentDomainOptions() {
  const sel = document.getElementById('cf-domain');
  if (!sel || !lookupCache.domains.length) return;
  const current = sel.value;
  const subject = lookupCache.subjects.find(r => String(r.name) === String(selectedProg ? selectedProg.subject : ''));
  const active = lookupCache.domains.filter(r => r.status === 'Active' && (!subject || String(r.sub_id) === String(subject.id)));
  sel.innerHTML = '<option value="">-- Select Domain --</option>' +
    active.map(r => `<option value="${h(r.name)}">${h(r.name)}</option>`).join('');
  setSelectValue('cf-domain', current);
}

function populateComponentTypeOptions() {
  const sel = document.getElementById('cf-type');
  if (!sel) return;
  const current = sel.value;
  const active = lookupCache.material_types.filter(r => r.status === 'Active');
  sel.innerHTML = '<option value="">-- Select Type --</option>' +
    active.map(r => `<option value="${h(r.name)}">${h(r.name)}</option>`).join('');
  setSelectValue('cf-type', current);
}
/* ═══════════════════════════════════════════════════
   INIT
═══════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
  loadPrograms();
  loadLookup('subjects');
  loadLookup('domains');
  loadLookup('material_types');
  loadMaterialMakers();
});

document.addEventListener('DOMContentLoaded', function () {

    initProgramDescriptionEditor();

});
</script>
</body>
</html>