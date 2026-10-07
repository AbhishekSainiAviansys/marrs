<?php include('header.php'); ?>
<link
    href="<?php echo base_url(); ?>public/library/select2.min.css"
    rel="stylesheet"
>

<script
    src="<?php echo base_url(); ?>public/library/select2.min.js"
    type="text/javascript">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<link
    href="<?php echo base_url(); ?>public/library/select2.min.css"
    rel="stylesheet"
>

<script
    src="<?php echo base_url(); ?>public/library/select2.min.js"
    type="text/javascript">
</script>

<style>
/* ===== SHARED TOGGLE STYLES ===== */
.toggle { position: relative; width: 42px; height: 22px; display: inline-block; }
.toggle input { opacity: 0; width: 0; height: 0; position: absolute; }
.slider { position: absolute; inset: 0; background: #D3D1C7; border-radius: 11px; cursor: pointer; transition: background .2s; }
.slider:before { content: ''; position: absolute; width: 16px; height: 16px; left: 3px; top: 3px; background: #fff; border-radius: 50%; transition: transform .2s; }
.toggle input:checked + .slider { background: #1D9E75; }
.toggle input:checked + .slider:before { transform: translateX(20px); }
.sw-wrap { display: flex; align-items: center; gap: 6px; }
.sw-lbl { font-size: 11px; color: #888; min-width: 38px; }
.cin-wrap { display: flex; align-items: center; gap: 6px; }
.cbtn { display: inline-flex; align-items: center; gap: 4px; font-size: 11px; padding: 4px 9px; border-radius: 6px; border: 1px solid transparent; text-decoration: none; white-space: nowrap; cursor: pointer; }
.cbtn-green { background: #E1F5EE; border-color: #5DCAA5; color: #0F6E56; }
.cbtn-blue  { background: #E6F1FB; border-color: #85B7EB; color: #185FA5; }
.cbtn-amber { background: #FAEEDA; border-color: #FAC775; color: #854F0B; }
.cbtn-gray  { background: #F1EFE8; border-color: #D3D1C7; color: #888; opacity: .5; pointer-events: none; }

/* ===== SHARED MODAL STYLES ===== */
#compModeModal,
#cinModeModal,
#cinOfflineDateModal {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,.45);
  z-index: 9999;
  align-items: center;
  justify-content: center;
}
#compModeModal.show,
#cinModeModal.show,
#cinOfflineDateModal.show {
  display: flex;
}
.cm-modal-box {
  background: #fff;
  border-radius: 10px;
  padding: 28px 32px;
  width: 380px;
  box-shadow: 0 8px 32px rgba(0,0,0,.18);
}
.cm-modal-box h4 { margin: 0 0 6px; font-size: 16px; color: #1a1a1a; }
.cm-modal-box p.cm-subtitle { margin: 0 0 20px; font-size: 12px; color: #888; }
.cm-field { margin-bottom: 14px; }
.cm-field label { display: block; font-size: 12px; color: #555; margin-bottom: 4px; font-weight: 600; }
.cm-field input {
  width: 100%; padding: 8px 10px; border: 1px solid #ccc;
  border-radius: 6px; font-size: 13px; box-sizing: border-box; transition: border-color .15s;
}
.cm-field input:focus { outline: none; border-color: #1D9E75; }
.cm-error { color: #c0392b; font-size: 12px; margin-bottom: 12px; display: none; padding: 6px 10px; background: #fdecea; border-radius: 5px; }
.cm-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }
.cm-btn-cancel { padding: 8px 20px; border-radius: 6px; border: 1px solid #ccc; background: #f1efe8; cursor: pointer; font-size: 13px; }
.cm-btn-save   { padding: 8px 20px; border-radius: 6px; border: none; background: #1D9E75; color: #fff; cursor: pointer; font-size: 13px; font-weight: 600; }
.cm-btn-save:hover   { background: #178a64; }
.cm-btn-cancel:hover { background: #e4e2db; }

/* ===== BULK DELETE STYLES ===== */
#bulkDeleteBtn { font-size: 12px; }
#bulkDeleteBtn:disabled { opacity: .5; cursor: not-allowed; }
.school-checkbox, #checkAllSchools { cursor: pointer; width: 16px; height: 16px; }

/* ===== ACTIVATE MODAL STYLES ===== */
#checkAll { cursor: pointer; }
#activateModal {
  display: none;
  align-items: center;
  justify-content: center;
}
#activateModal > div {
  font-family: Arial, sans-serif;
  width: 85% !important;
  max-width: 97%;
  max-height: 90vh;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}
#activateModal h4 { font-size: 18px; font-weight: 600; margin-bottom: 12px; }

/* Product list row columns */
#productList .product-row{
    display:flex;
    align-items:center;
    gap:10px;
    border-bottom:1px solid #f1f1f1;
    padding:10px 0;
}

#productList .col-check{
    flex:1;
    display:flex;
    align-items:center;   /* vertical align */
    gap:10px;
    margin:0;
    cursor:pointer;
    min-height:42px;
}

#productList .col-check input[type="checkbox"]{
    margin:0;
    vertical-align:middle;
    flex-shrink:0;
}

#productList .product-name{
    display:flex;
    align-items:center;
    line-height:1.3;
    margin:0;
}
#productList .col-check input{
    height:25px;
    width:auto !important;
}
#productList .col-price{
    width:220px;
    flex-shrink:0;
}

#productList .col-level{
    width:220px;
    flex-shrink:0;
}

#productList .product-name{
    font-size:13px;
    color:#333;
    line-height:1.4;
}
#productList select.chk {
  margin-top: 0 !important;
  margin-left: 0 !important;
  width: 100%;
  padding: 2px 6px;
  border-radius: 6px;
  border: 1px solid #ccc;
  font-size: 12px;
}
#productList::-webkit-scrollbar { width: 6px; }
#productList::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }

/* Selected products summary panel */
#selectedSummary {
  background: #f7f9f7;
  border: 1px solid #c8e6d8;
  border-radius: 8px;
  padding: 10px 14px;
  margin-top: 12px;
  min-height: 48px;
}
#selectedSummary .sum-title {
  font-size: 11px;
  font-weight: 700;
  color: #1D9E75;
  text-transform: uppercase;
  letter-spacing: .04em;
  margin-bottom: 6px;
}
#selectedSummary .sum-empty { font-size: 12px; color: #aaa; font-style: italic; }
#selectedSummary .sum-list  { display: flex; flex-wrap: wrap; gap: 6px; }
#selectedSummary .sum-tag   {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  background: #E1F5EE;
  border: 1px solid #5DCAA5;
  border-radius: 20px;
  padding: 3px 10px 3px 8px;
  font-size: 11px;
  color: #0F6E56;
  white-space: nowrap;
}
#selectedSummary .sum-tag .sum-meta { color: #4a9e80; font-size: 10px; }
#scrollToggleBtn {
  position: fixed;
  right: 20px;
  bottom: 80px;
  z-index: 9999;
  background: #f7941d;
  color: #fff;
  border: none;
  border-radius: 50%;
  padding: 12px 14px;
  font-size: 20px;
  cursor: pointer;
  box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

#scrollToggleBtn:hover {
  background: #e67e00;
}

#global-loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(255, 255, 255, 0.75);
    z-index: 99999;
    display: none;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }

  .spinner-border-custom {
    width: 3rem;
    height: 3rem;
    border: 0.3em solid #f3f3f3;
    border-top: 0.3em solid #007bff;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  #example_filter{
          display: flex;
    justify-content: flex-end;
  }
</style>
<button id="scrollToggleBtn">
<img id="scrollIcon" width="20" height="20" src="https://img.icons8.com/liquid-glass/48/sorting-arrows.png" alt="sorting-arrows"/>
</button>
<!-- ===== COMPETITION MODE MODAL ===== -->


<div id="global-loader">
  <div class="spinner-border-custom"></div>
  <p style="margin-top: 12px; font-weight: 600; color: #333;">Processing, please wait...</p>
</div>

<!-- Bulk Modal-->
<!-- ===== BULK ACTIVATE MODAL (NEW — separate copy, only used for multi-school activation) ===== -->
<div id="bulkActivateModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:9999; align-items:center; justify-content:center;">
  <div style="background:#fff; border-radius:10px; padding:28px 32px; box-shadow:0 8px 32px rgba(0,0,0,.18); overflow-y:auto; max-height:90vh; width:85%; max-width:97%; font-family:Arial, sans-serif;">
    <form id="bulkActivateForm">

      <h4 id="bulkActivateTitle" style="margin:0 0 12px; font-size:18px; font-weight:600; color:#1a1a1a;">Activate Selected Schools</h4>

      <!-- Column header row -->
      <div style="display:flex; align-items:center; margin-bottom:6px; padding:0 4px;">
        <div style="width:100%; display:flex;" class="align-items-center">
          <div style="width:20%; font-size:12px; font-weight:600; color:#555;" class="d-flex gap-2 align-items-center">
            <div><input type="checkbox" id="bulk_checkAll" style="cursor:pointer;"></div> <div>Select All</div>
          </div>
          <div style="width:20%; font-size:12px; font-weight:600; color:#555; ">Price Code</div>
          <div style="width:20%; font-size:12px; font-weight:600; color:#555; ">Level</div>
          <div style="width:20%; font-size:12px; font-weight:600; color:#555;  margin-left:10px;">Split</div>
          <div style="width:20%; font-size:12px; font-weight:600; color:#555;  margin-left:10px;">Value</div>
        </div>
      </div>

      <div style="display:flex; align-items:flex-start; gap:10px;">

        <!-- Left: product list (same source data as the single Activate modal) -->
        <div style="width:70%;">
          <div id="bulk_productList" style="max-height:420px; border:1px solid #eee; overflow-y:auto; border-radius:6px; padding:8px;">
            <?php if (!empty($result)) { foreach ($result as $val) { ?>
                <div class="product-row" id="bulk_prow-<?php echo $val['product_id']; ?>" style="display:flex; align-items:center; gap:10px; border-bottom:1px solid #f1f1f1; padding:10px 0;">

                  <label style="flex:1; display:flex; align-items:center; gap:10px; margin:0; cursor:pointer; min-height:42px;">
                    <input type="checkbox"
                           name="product_id[]"
                           value="<?php echo $val['product_id']; ?>"
                           data-product-name="<?php echo htmlspecialchars($val['product_name'], ENT_QUOTES); ?>"
                           style="height:25px; width:auto !important; margin:0;"
                           onchange="bulkRebuildLevelDropdown(<?php echo $val['product_id']; ?>); bulkRefreshSummary()">
                    <span style="font-size:13px; color:#333;"><?php echo $val['product_name']; ?></span>
                  </label>

                  <div style="width:220px; flex-shrink:0;">
                    <?php if (!empty($result2)) { ?>
                    <select name="product_price[<?php echo $val['product_id']; ?>]"
                            id="bulk_product_p_<?php echo $val['product_id']; ?>"
                            class="chk"
                            onchange="bulkHandlePriceCodeChange(); bulkRefreshSummary();">
                      <option value="">-- Price --</option>
                      <?php foreach ($result2 as $price) { ?>
                      <option value="<?php echo $price['price_code']; ?>"><?php echo $price['price_code']; ?></option>
                      <?php } ?>
                    </select>
                    <?php } ?>
                  </div>

                  <div style="width:220px; flex-shrink:0;">
                    <select name="product_level[<?php echo $val['product_id']; ?>]"
                            id="bulk_product_l_<?php echo $val['product_id']; ?>"
                            class="chk"
                            onchange="bulkRefreshSummary()">
                      <option value="">-- Level --</option>
                      <?php if (!empty($levelsByProduct[$val['product_id']])) { ?>
                        <option value="All">All Levels</option>
                        <?php foreach ($levelsByProduct[$val['product_id']] as $lv) { ?>
                        <option value="<?php echo $lv['level_id']; ?>"><?php echo htmlspecialchars($lv['level_name']); ?></option>
                        <?php } ?>
                      <?php } else { ?>
                        <option value="" disabled style="color:#bbb;">No levels</option>
                      <?php } ?>
                    </select>
                  </div>

                </div>
            <?php } } ?>
          </div><!-- /#bulk_productList -->

          <div style="background:#f7f9f7; border:1px solid #c8e6d8; border-radius:8px; padding:10px 14px; margin-top:12px; min-height:48px;">
            <div style="font-size:11px; font-weight:700; color:#1D9E75; text-transform:uppercase; letter-spacing:.04em; margin-bottom:6px;">Selected Products</div>
            <div id="bulk_sum_empty_msg" style="font-size:12px; color:#aaa; font-style:italic;">No products selected yet.</div>
            <div id="bulk_sum_list" style="display:flex; flex-wrap:wrap; gap:6px;"></div>
          </div>

        </div><!-- /left col -->

        <!-- Right: value fields (identical fields/names to the single Activate modal) -->
        <div style="width:25%; max-height:500px; overflow-y:auto; border-radius:6px; padding:8px; display:flex; flex-direction:column; gap:4px;">
             <label style="font-size:11px; font-weight:600; color:#555;">Competition Type <span style="color:red;">*</span></label>
              <select name="competition_type" class="chk" required style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
                <option value="">-- Select Competition --</option>
                <option value="school">School Level</option>
                <option value="open">Open</option>
              </select>
          <label style="font-size:11px; font-weight:600; color:#555;">School Amount Fixed <span style="color:red;">*</span></label>
          <input type="text" name="schoolper" class="chk" required style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">Management Percentage <span style="color:red;">*</span></label>
          <select name="manageper" class="chk" required style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
            <option value="">-- Select management % --</option>
            <option value="2">2%</option><option value="3">3%</option><option value="4">4%</option>
            <option value="5">5%</option><option value="8">8%</option><option value="10">10%</option>
            <option value="12">12%</option><option value="15">15%</option><option value="16">16%</option>
            <option value="18">18%</option><option value="20">20%</option><option value="22">22%</option>
          </select>

          <label style="font-size:11px; font-weight:600; color:#555;">Aviansys Percentage <span style="color:red;">*</span></label>
          <select name="com_peravian" class="chk" required style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
            <option value="">-- Select aviansys % --</option>
            <option value="2">2%</option><option value="3">3%</option><option value="4">4%</option>
            <option value="5">5%</option><option value="8">8%</option><option value="10">10%</option>
            <option value="12">12%</option><option value="15">15%</option><option value="16">16%</option>
            <option value="18">18%</option><option value="20">20%</option><option value="22">22%</option>
            <option value="25">25%</option><option value="30">30%</option>
          </select>

          <label style="font-size:11px; font-weight:600; color:#555;">Associate Percentage</label>
          <select name="associate_per" class="chk" style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
            <option value="">-- Select associate % --</option>
            <option value="5">5%</option><option value="10">10%</option><option value="15">15%</option>
            <option value="20">20%</option><option value="25">25%</option><option value="30">30%</option>
            <option value="35">35%</option><option value="40">40%</option><option value="45">45%</option>
            <option value="50">50%</option><option value="55">55%</option><option value="60">60%</option>
          </select>

          <label style="font-size:11px; font-weight:600; color:#555;">Franchise Percentage</label>
          <select name="com_per" class="chk" style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
            <option value="">-- Select franchise % --</option>
            <option value="5">5%</option><option value="10">10%</option><option value="15">15%</option>
            <option value="20">20%</option><option value="25">25%</option><option value="30">30%</option>
            <option value="35">35%</option><option value="40">40%</option><option value="45">45%</option>
            <option value="50">50%</option><option value="55">55%</option><option value="60">60%</option>
          </select>

           <label style="font-size:11px; font-weight:600; color:#555;"> CRM<span style="color:red;">*</span></label>
              <select name="crm" class="chk" style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
              <option value="">-- Select CRM --</option>
               <?php foreach($crm_account as $val) { ?>
                   <option value="<?php echo $val['id'] ?>" ><?php echo $val['desc']; ?></option>
                <?php } ?>
              </select>
              
              
          <label style="font-size:11px; font-weight:600; color:#555;">CRM % <span style="color:red;">*</span></label>
          <select name="crm_per" class="chk" style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;" required>
              <option value="">-- Select CRM % --</option>
            <option value="0" selected>0%</option>
            <option value="1">1%</option><option value="2">2%</option><option value="3">3%</option>
            <option value="4">4%</option><option value="5">5%</option><option value="6">6%</option>
            <option value="7">7%</option><option value="8">8%</option><option value="9">9%</option>
            <option value="10">10%</option>
          </select>

          <label style="font-size:11px; font-weight:600; color:#555;">IT %<span style="color:red;">*</span></label>
          <!--<input type="text" name="it_fix" placeholder="Enter Fix IT Amount" class="chk" style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">-->
            <select name="it_fix" class="it_fix" style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;" required>
                <option value="">-- Select CRM % --</option>
                <option value="0" selected>0%</option>
                <option value="1">1%</option><option value="2">2%</option><option value="3">3%</option>
                <option value="4">4%</option><option value="5">5%</option><option value="6">6%</option>
                <option value="7">7%</option><option value="8">8%</option><option value="9">9%</option>
                <option value="10">10%</option>
            </select>

          <label style="font-size:11px; font-weight:600; color:#555;">Free Material Royalty <span style="color:red;">*</span></label>
          <input type="text" name="free_mat_royalty" placeholder="Enter royalty" class="chk"
                 style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

           <label style="font-size:11px; font-weight:600; color:#555;">Study Material A + Training A</label>
            <input type="text" name="material_training_a" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

            <label style="font-size:11px; font-weight:600; color:#555;">Study Material A + Training A Royality</label>
            <input type="text" name="material_training_a_royalty" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

            <label style="font-size:11px; font-weight:600; color:#555;">Study Material B + Training B</label>
            <input type="text" name="material_training_b" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

            <label style="font-size:11px; font-weight:600; color:#555;">Study Material B + Training B Royality</label>
            <input type="text" name="material_training_b_royalty" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
        </div>
         <div style="margin-top:14px; width:25%;max-height:500px;overflow-y:auto; padding-top:10px; border-top:1px dashed #ccc;">
           <label style="font-size:11px; font-weight:600; color:#555;">Material-A Price</label>
          <input type="text" name="material_a_price" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">Material-A Royalty</label>
          <input type="text" name="material_a_royalty" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">Material-B Price</label>
          <input type="text" name="material_b_price" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">Material-B Royalty</label>
          <input type="text" name="material_b_royalty" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">Orientation-A Price</label>
          <input type="text" name="orientation_a_price" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">Orientation-B Price</label>
          <input type="text" name="orientation_b_price" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">MockTest-A Price</label>
          <input type="text" name="mocktest_a_price" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">MockTest-A Royalty</label>
          <input type="text" name="mocktest_a_royalty" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">MockTest-B Price</label>
          <input type="text" name="mocktest_b_price" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">MockTest-B Royalty</label>
          <input type="text" name="mocktest_b_royalty" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
        </div>

      </div><!-- /flex row -->

      <div id="bulk_activate_error" style="display:none; color:#c0392b; font-size:12px; margin-top:10px; padding:6px 10px; background:#fdecea; border-radius:5px;"></div>

      <div style="display:flex; gap:10px; justify-content:flex-end; margin-top:20px;">
        <button type="button" onclick="closeBulkActivateModal()"
                style="padding:8px 20px; border-radius:6px; border:1px solid #ccc; background:#f1efe8; cursor:pointer; font-size:13px;">
          Cancel
        </button>
        <button type="button" id="bulk_confirmActivateBtn" onclick="submitBulkActivateForm()"
                style="padding:8px 20px; border-radius:6px; border:none; background:#1D9E75; color:#fff; cursor:pointer; font-size:13px; font-weight:600;">
          Activate All Schools
        </button>
      </div>

    </form>
  </div>
</div>
<!-- ===== END BULK ACTIVATE MODAL ===== -->

<div id="compModeModal">
  <div class="cm-modal-box">
    <h4>Set Competition Mode Details</h4>
    <p class="cm-subtitle">Please fill in the dates before switching to Online mode.</p>
    <div class="cm-field">
      <label>Start Date <span style="color:#e00;">*</span></label>
      <input type="date" id="cm_start_date">
    </div>
    <div class="cm-field">
      <label>End Date <span style="color:#e00;">*</span></label>
      <input type="date" id="cm_end_date">
    </div>
    <div class="cm-error" id="cm_error"></div>
    <div class="cm-actions">
      <button class="cm-btn-cancel" onclick="cancelCompMode()">Cancel</button>
      <button class="cm-btn-save"   onclick="saveCompMode()">Save &amp; Activate</button>
    </div>
  </div>
</div>

<!-- ===== CIN ONLINE MODAL ===== -->
<div id="cinModeModal">
  <div class="cm-modal-box">
    <h4>Registration Active Date</h4>
    <p class="cm-subtitle">Please fill in the dates before switching to Online mode.</p>
    <div class="cm-field">
      <label>Start Date <span style="color:#e00;">*</span></label>
      <input type="date" id="cin_start_date">
    </div>
    <div class="cm-field">
      <label>End Date <span style="color:#e00;">*</span></label>
      <input type="date" id="cin_end_date">
    </div>
    <div class="cm-error" id="cin_error"></div>
    <div class="cm-actions">
      <button class="cm-btn-cancel" onclick="cancelCinMode()">Cancel</button>
      <button class="cm-btn-save"   onclick="saveCinMode()">Save &amp; Activate</button>
    </div>
  </div>
</div>

<!-- ===== CIN OFFLINE MODAL ===== -->
<div id="cinOfflineDateModal">
  <div class="cm-modal-box">
    <h4>Set Competition Date</h4>
    <p class="cm-subtitle">Enter the competition date for offline registration.</p>
    <div class="cm-field">
      <label>Competition Date <span style="color:#e00;">*</span></label>
      <input type="date" id="cin_comp_date">
    </div>
    <div class="cm-error" id="cin_offline_error"></div>
    <div class="cm-actions">
      <button class="cm-btn-cancel" onclick="cancelCinOfflineMode()">Cancel</button>
      <button class="cm-btn-save"   onclick="saveCinOfflineMode()">Save</button>
    </div>
  </div>
</div>

<!-- ===== BULK DELETE CONFIRM MODAL ===== -->
<div id="bulkDeleteModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:9999; align-items:center; justify-content:center;">
  <div class="cm-modal-box">
    <h4>Delete Selected Schools</h4>
    <p class="cm-subtitle">This will permanently delete <span id="bulkDeleteModalCount">0</span> selected school(s). This action cannot be undone.</p>
    <div class="cm-error" id="bulkDeleteError"></div>
    <div class="cm-actions">
      <button class="cm-btn-cancel" onclick="closeBulkDeleteModal()">Cancel</button>
      <button class="cm-btn-save" style="background:#d9534f;" id="confirmBulkDeleteBtn" onclick="confirmBulkDelete()">Delete</button>
    </div>
  </div>
</div>

<div class="container-fluid mx-3">
  <ul class="breadcrumb" id="top">
    <li><a href="<?php echo SITE_URL?>school/">School</a> <span class="divider">/</span></li>
    <li>School List</li>
  </ul>
</div>

<div>
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> School List</h2>
      <div class="box-icon">
        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
      </div>
    </div>

    <div class="box-content">

      <div id="flash-message" style="display:none; padding:10px; border-radius:5px; margin-bottom:10px;"></div>

      <?php if ($this->session->flashdata('success')) { ?>
        <div style="padding:10px; background:#d4edda; color:#155724; border-radius:5px; margin-bottom:10px;">
          <?php echo $this->session->flashdata('success'); ?>
        </div>
      <?php } ?>

      <!-- ===== FILTER FORM ===== -->
      <form method="POST" id="filterForm">
        <div style="display:flex; flex-wrap:wrap; gap:16px; align-items:flex-end; margin-bottom:16px;">
            
            
            <!--<div>-->
            <!--<label class="control-label">Country <span style="color:#F00;font-size:15px;"><b>*</b></span></label>-->
            <!--    <div class="controls">-->
            <!--        <select name="country_id" id="country_id" style="width:200px;">-->
                
            <!--            <option value="">-- Select Country --</option>-->
                
            <!--            <option value="105">India</option>-->
                
                        <?php //foreach($country_load as $value) { ?>
                
                            <!--<option value="<?php echo $value['country_id']; ?>" <?php if($result['country_id'] == $value['country_id']) echo 'selected="selected"'; ?>><?php echo $value['country_name']; ?></option>-->
                
                        <?php //} ?>
                
            <!--        </select>-->
            <!--    </div>-->
            <!--</div>  -->
            
            
            <!-- ============================================================
                 Country
            ============================================================ -->
            
            <div class="controls">
            <label class="control-label">Country <span style="color:#F00;font-size:15px;"><b>*</b></span></label><br>
                <select
                    name="country_id"
                    id="country_id"
                    style="width:200px;"
                >
            
                    <!-- Default option -->
                    <option value="">
                        -- Select Country --
                    </option>
            
            
                    <!-- India -->
                    <option
                        value="105"
                        <?php
                        if (!empty($result['country_id']) && $result['country_id'] == 105) {
                            echo 'selected="selected"';
                        }
                        ?>
                    >
                        India
                    </option>
            
            
                    <!-- Other Countries -->
                    <?php if (!empty($country_load)) { ?>
            
                        <?php foreach ($country_load as $value) { ?>
            
                            <?php
                            // Avoid duplicate India
                            if ($value['country_id'] == 105) {
                                continue;
                            }
                            ?>
            
                            <option
                                value="<?php echo html_escape($value['country_id']); ?>"
                                <?php
                                if (
                                    !empty($result['country_id']) &&
                                    $result['country_id'] == $value['country_id']
                                ) {
                                    echo 'selected="selected"';
                                }
                                ?>
                            >
                                <?php echo html_escape($value['country_name']); ?>
                            </option>
            
                        <?php } ?>
            
                    <?php } ?>
            
                </select>
            
            </div>


         
            
            
            <div>
                <label class="control-label">State <span style="color:#F00;font-size:15px;"><b>*</b></span></label>
                <div class="controls">
                  <select name="state_id" id="state_id" style="width:200px;">
                    <option value=''>Select State</option>
                    <option value="All"
                        <?php if(isset($result['state_id']) && $result['state_id']=='All') echo 'selected'; ?>>
                        All State
                    </option>
                    <?php
                    
                      foreach ($state_load as $row) { ?>
                      <option value="<?php echo $row['state_subdivision_id']; ?>"
                        <?php if($row['state_subdivision_id'] == $result['state_id']) echo 'selected="selected"'; ?>>
                        <?php echo $row['state_subdivision_name']; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
            </div>

          <div>
            <label class="control-label">Franchise <span style="color:#F00;font-size:15px;"><b>*</b></span></label>
            <div class="controls">
              <select name="franchise" id="franchise" style="width:200px;">
                <option value="All"
                    <?php if(isset($result['franchise']) && $result['franchise']=='All') echo 'selected'; ?>>
                    All Franchise
                </option>
                
                <option value=''>Select Franchise</option>
                <?php foreach($franchise_load as $value) { ?>
                  <option value="<?php echo $value['franchise_id']; ?>"
                    <?php if($result['franchise'] == $value['franchise_id']) echo 'selected="selected"'; ?>>
                    <?php echo $value['username']; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div>
            <label class="control-label">Area Code <span style="color:#F00;font-size:15px;"><b>*</b></span></label>
            <div class="controls">
              <select name="area_code" id="area" style="width:200px;">
                <option value="All"
                    <?php if(isset($result['area_code']) && $result['area_code']=='All') echo 'selected'; ?>>
                    All Area
                </option>
                
                <option value=''>-- Select Area --</option>
                <?php foreach($area_load as $servicelistval) { ?>
                  <option value="<?php echo $servicelistval['area_code']; ?>"
                    <?php if($result['area_code'] == $servicelistval['area_code']) echo 'selected="selected"'; ?>>
                    <?php echo $servicelistval['city_name']; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div>
            <label class="control-label">Status <span style="color:#F00;font-size:15px;"><b>*</b></span></label>
            <div class="controls">
              <select name="status" id="status" style="width:200px;">
                <option value="All"      <?php if($result['status']=='All')      echo 'selected'; ?>>All</option>
                <option value="Active"   <?php if($result['status']=='Active')   echo 'selected'; ?>>Active</option>
                <option value="Pending"  <?php if($result['status']=='Pending')  echo 'selected'; ?>>Pending</option>
                <option value="Inactive" <?php if($result['status']=='Inactive') echo 'selected'; ?>>Inactive</option>
                <option value="Deleted"  <?php if($result['status']=='Deleted')  echo 'selected'; ?>>Deleted</option>
                <option value="Deactive" <?php if($result['status']=='Deactive') echo 'selected'; ?>>Deactive</option>
              </select>
            </div>
          </div>
          
          <input type="text"
           class="form-control"
           name="search"
           placeholder="School Name/Code"
           value="<?= isset($result['search']) ? htmlspecialchars($result['search']) : '' ?>">

          <div class="form-actions" style="margin:0;">
            <input type="submit" class="btn btn-primary" value="Submit" name="submit">
          </div>

        </div>
      </form>
      <!-- ===== END FILTER FORM ===== -->

      <?php if(!empty($schoolList)) { ?>

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
          <h4>Total Schools: <?php echo count($schoolList); ?></h4>
          <div style="display:flex; gap:10px; align-items:center;">
            <button type="button" id="bulkDeleteBtn" class="btn btn-danger" disabled>
              <i class="fa fa-trash"></i> Delete Selected (<span id="bulkDeleteCount">0</span>)
            </button>
            <button type="button" id="bulkActivateBtn" class="btn btn-success" disabled>
                <i class="fa fa-check"></i> Activate Bulk (<span id="bulkActivateCount">0</span>)
            </button>
            <form method="POST" style="margin:0;">
              <input type="hidden" name="state_id" value="<?php echo $result['state_id']; ?>">
              <input type="hidden" name="franchise" value="<?php echo $result['franchise']; ?>">
              <input type="hidden" name="area_code" value="<?php echo $result['area_code']; ?>">
              <input type="hidden" name="status"    value="<?php echo $result['status']; ?>">
              <input type="submit" class="btn btn-warning" value="Export CSV" name="export">
            </form>
          </div>
        </div>

        <div class="mb-4" style="overflow-x:auto;">
            <table id="example" class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>
                                  <th style="width:30px;"><input type="checkbox" id="checkAllSchools" title="Select all"></th>
                                  <th>Sl no</th>
                                  <th>School code</th>
                                  <th>School name</th>
                                  <th>Address</th>
                                  <th>State</th>
                                  <th>City</th>
                                  <th>Franchise</th>
                                  <th>School Status</th>
                                  <th>School level activation</th>
                                  <th>Registration mode</th>
                                  <th>Competition mode</th>
                                  <th>Edit School Activation</th>
                                  <th>Edit School </th>
                                  <th>Delete</th>
                                </tr>
                            </thead>
                          
                            <tbody>
                              <?php $i = 1; foreach($schoolList as $value) {
                    
                                $period = $this->db->get_where('period',array('status'=>'Active'))->row();
                            
                    
                                $activeschool = $this->db->get_where('product_to_school', array(
                                  'school_id' => $value['id'],
                                  'period_id' => $period->period_id
                                ))->row();
                                $isActive = !empty($activeschool);
                    
                                $pts = $this->db->get_where('product_to_school', array(
                                    'school_id' => $value['id'],
                                    'period_id' => $period->period_id
                                ))->row_array();
                    
                                $compMode  = !empty($pts['competition_mode'])   ? $pts['competition_mode']
                                           : (isset($value['competition_mode']) ? $value['competition_mode'] : 'offline');
                    
                                $regMode   = !empty($pts['registration_mode'])  ? $pts['registration_mode']
                                           : (isset($value['registration_mode'])? $value['registration_mode']: 'offline');
                    
                                $isOnline  = ($compMode === 'online');
                                $regOnline = ($regMode  === 'online');
                              ?>
                                <tr id="school-row-<?php echo $value['id']; ?>" >
                    
                                  <td>
                                    <input type="checkbox" class="school-checkbox" value="<?php echo $value['id']; ?>">
                                  </td>
                                  <td><?php echo $i; ?></td>
                                  <td style="font-family:monospace; font-size:11px;"><?php echo $value['school_code']; ?></td>
                                  <td style="font-weight:500;"><?php echo $value['school_name']; ?></td>
                                  <td><?php echo $value['school_address'] . ' ' . $value['city']; ?></td>
                                  <td><?php echo $value['state_subdivision_name']; ?></td>
                                  <td><?php echo $value['city']; ?></td>
                                  <td style="font-size:11px;"><?php echo $value['franchise_code'] . ' ' . $value['franchise_first_name']; ?></td>
                                  <td><?php echo $value['school_status']; ?></td>
                    
                                  <!-- ===== SCHOOL LEVEL ACTIVATION ===== -->
                                  <td>
                                    <?php if($value['status_new'] == 'Inactive' || empty($value['status_new'])) { ?>
                                      <a href="javascript:void(0);"
                                         class="btn btn-warning btn-activate"
                                         style="font-size:11px;"
                                         data-id="<?php echo $value['id']; ?>">
                                        Activate
                                      </a>
                                    <?php } else { ?>
                                      <button type="button"
                                          class="btn btn-danger btn-deactivate"
                                          style="font-size:11px;"
                                          data-id="<?php echo $value['id']; ?>">
                                        Deactivate
                                      </button>
                                    <?php } ?>
                                  </td>
                    
                                  <!-- ===== CIN / REGISTRATION MODE TOGGLE ===== -->
                                  <td>
                                    <div class="sw-wrap">
                                      <label class="toggle" aria-label="CIN mode for <?php echo $value['school_name']; ?>">
                                        <input
                                            type="checkbox"
                                            <?php echo $regOnline ? 'checked' : ''; ?>
                                            data-school-code="<?php echo $value['school_code']; ?>"
                                            data-start-date="<?php echo !empty($pts['start_date']) ? date('Y-m-d', strtotime($pts['start_date'])) : ''; ?>"
                                            data-end-date="<?php echo !empty($pts['end_date']) ? date('Y-m-d', strtotime($pts['end_date'])) : ''; ?>"
                                            onchange="toggleCinMode(<?php echo $value['id']; ?>, this)">
                                        <span class="slider"></span>
                                      </label>
                                      <span class="sw-lbl" id="cin-lbl-<?php echo $value['id']; ?>">
                                        <?php echo $regOnline ? 'Online' : 'Offline'; ?>
                                      </span>
                                    </div>
                                  </td>
                    
                                  <!-- ===== COMPETITION MODE TOGGLE ===== -->
                                  <td>
                                    <div class="sw-wrap">
                                      <label class="toggle" aria-label="Competition mode for <?php echo $value['school_name']; ?>">
                                        <input
                                          type="checkbox"
                                          <?php echo $isOnline ? 'checked' : ''; ?>
                                          data-school-code="<?php echo $value['school_code']; ?>"
                                          data-start-date="<?php echo !empty($pts['competition_mode_start_date']) ? date('Y-m-d', strtotime($pts['competition_mode_start_date'])) : ''; ?>"
                                          data-end-date="<?php echo !empty($pts['competition_mode_end_date']) ? date('Y-m-d', strtotime($pts['competition_mode_end_date'])) : ''; ?>"
                                          onchange="toggleCompetitionMode(<?php echo $value['id']; ?>, this)">
                                        <span class="slider"></span>
                                      </label>
                                      <span class="sw-lbl" id="comp-lbl-<?php echo $value['id']; ?>">
                                        <?php echo $isOnline ? 'Online' : 'Offline'; ?>
                                      </span>
                                    </div>
                                  </td>
                    
                                  <!-- Details -->
                                  <td>
                                    <?php
                                      $editDisabled = ($value['status_new'] == 'Inactive' || empty($value['status_new']));
                                    ?>
                                    <a href="javascript:void(0);"
                                       class="btn btn-primary btn-edit<?php echo $editDisabled ? ' disabled' : ''; ?>"
                                       style="font-size:11px;<?php echo $editDisabled ? ' pointer-events:none; opacity:0.5;' : ''; ?>"
                                       data-id="<?php echo $value['id']; ?>">
                                      Edit
                                    </a>
                                  </td>
                                 <td>
                                   
                                    <a href="<?php echo SITE_URL();?>manage/school/edit/<?php echo $value['id']; ?>"
                                       class="btn btn-primary btn-edit-info"
                                       style="font-size:11px;"  >
                                      School Edit
                                    </a>
                                  </td>
                                     
                                  <!-- Delete -->
                                  <td>
                                    <!--<a class="btn btn-danger" style="font-size:11px;"-->
                                    <!--   onclick="return confirm('Are you sure you want to delete this school?');"-->
                                    <!--   href="<?php echo SITE_URL; ?>franchise/adminSchooldelete/<?php echo $value['id']; ?>">-->
                                    <!--  Delete-->
                                    <!--</a>-->
                                    
                                    <a href="javascript:void(0);"
                                       class="btn btn-danger btn-sm deleteSchool"
                                       data-id="<?php echo $value['id']; ?>">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                  </td>
                    
                                </tr>
                              <?php $i++; } ?>
                              
                            </tbody>
                        </table>

        </div>

      <?php } else { ?>
        <div style="text-align:center; my-2"><h3>No School Found ...</h3></div>
      <?php } ?>

    </div><!-- /.box-content -->
  </div><!-- /.box -->
</div>

<script>

// $(document).on('click', '#bulkActivateBtn', function () {
//     _bulkDeleteIds = $('.school-checkbox:checked').map(function () {
//         return $(this).val();
//     }).get();

//     if (_bulkDeleteIds.length === 0) return;

//     document.getElementById('bulkDeleteModalCount').textContent = _bulkDeleteIds.length;
//     document.getElementById('bulkDeleteError').style.display = 'none';
//     document.getElementById('bulkDeleteError').textContent   = '';
//     document.getElementById('bulkDeleteModal').style.display = 'flex';
// });


/* ==============================================
   FLASH HELPER (defined early so bulk-delete /
   single-delete handlers below can use it safely)
   ============================================== */
function showFlash(message, type) {
    var bg    = type === 'success' ? '#d4edda' : '#f8d7da';
    var color = type === 'success' ? '#155724' : '#721c24';
    var el    = document.getElementById('flash-message');
    if (!el) { alert(message); return; }
    el.style.background = bg;
    el.style.color      = color;
    el.textContent      = message;
    el.style.display    = 'block';
    setTimeout(function(){ el.style.display = 'none'; }, 4000);
}

/* ==============================================
   SINGLE SCHOOL DELETE
   ============================================== */
$(document).on('click', '.deleteSchool', function () {

    var id = $(this).data('id');

    if (!confirm('Are you sure you want to delete this school?')) {
        return;
    }

    $.ajax({
        url: "<?php echo site_url('manage/franchise/adminSchooldelete'); ?>",
        type: "POST",
        data: {
            id: id
        },
        dataType: "json",
       success:function(response){

            if(response.status == true){
        
                $("#school-row-" + id).fadeOut(500, function(){
                    $(this).remove();
                });
        
                showFlash(response.message || 'School deleted successfully.', 'success');
        
            } else {
        
                alert(response.message);
        
            }
        
        },
        error: function() {
            alert("Something went wrong.");
        }
    });

});

/* ==============================================
   BULK SELECT / BULK DELETE
   ============================================== */
function updateBulkDeleteBtn() {
    var checked = document.querySelectorAll('.school-checkbox:checked').length;
    var btn = document.getElementById('bulkDeleteBtn');
    if (!btn) return;
    document.getElementById('bulkDeleteCount').textContent = checked;
    btn.disabled = (checked === 0);
}

document.addEventListener('DOMContentLoaded', function () {
    var checkAllEl = document.getElementById('checkAllSchools');
    if (checkAllEl) {
        checkAllEl.addEventListener('change', function () {
            var isChecked = this.checked;
            document.querySelectorAll('.school-checkbox').forEach(function (cb) {
                cb.checked = isChecked;
            });
            updateBulkDeleteBtn();
        });
    }
    updateBulkDeleteBtn();
});

$(document).on('change', '.school-checkbox', function () {
    var all     = document.querySelectorAll('.school-checkbox');
    var checked = document.querySelectorAll('.school-checkbox:checked');
    var checkAllEl = document.getElementById('checkAllSchools');
    if (checkAllEl) {
        checkAllEl.checked = (all.length > 0 && all.length === checked.length);
    }
    updateBulkDeleteBtn();
});

var _bulkDeleteIds = [];

$(document).on('click', '#bulkDeleteBtn', function () {
    _bulkDeleteIds = $('.school-checkbox:checked').map(function () {
        return $(this).val();
    }).get();

    if (_bulkDeleteIds.length === 0) return;

    document.getElementById('bulkDeleteModalCount').textContent = _bulkDeleteIds.length;
    document.getElementById('bulkDeleteError').style.display = 'none';
    document.getElementById('bulkDeleteError').textContent   = '';
    document.getElementById('bulkDeleteModal').style.display = 'flex';
});

function closeBulkDeleteModal() {
    document.getElementById('bulkDeleteModal').style.display = 'none';
}

document.getElementById('bulkDeleteModal').addEventListener('click', function (e) {
    if (e.target === this) { closeBulkDeleteModal(); }
});

function confirmBulkDelete() {
    if (_bulkDeleteIds.length === 0) return;

    var btn = document.getElementById('confirmBulkDeleteBtn');
    var errEl = document.getElementById('bulkDeleteError');
    errEl.style.display = 'none';
    btn.disabled = true;
    btn.textContent = 'Deleting...';

    $.ajax({
        url: "<?php echo site_url('manage/franchise/adminSchoolBulkDelete'); ?>",
        type: "POST",
        data: { ids: _bulkDeleteIds },   // sent as ids[]=1&ids[]=2...
        dataType: "json",
        success: function (response) {
            btn.disabled = false;
            btn.textContent = 'Delete';

            if (response.status == true) {
                var deletedIds = response.deleted_ids || _bulkDeleteIds;
                deletedIds.forEach(function (id) {
                    $("#school-row-" + id).fadeOut(400, function () { $(this).remove(); });
                });

                closeBulkDeleteModal();
                document.getElementById('checkAllSchools').checked = false;
                updateBulkDeleteBtn();
                showFlash(response.message || (deletedIds.length + ' school(s) deleted.'), 'success');
            } else {
                errEl.textContent   = response.message || 'Bulk delete failed.';
                errEl.style.display = 'block';
            }
        },
        error: function () {
            btn.disabled = false;
            btn.textContent = 'Delete';
            errEl.textContent   = 'Something went wrong. Please try again.';
            errEl.style.display = 'block';
        }
    });
}
</script>


<!-- ===== ACTIVATE MODAL ===== -->
<div id="activateModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:9999; align-items:center; justify-content:center;">
  <div style="background:#fff; border-radius:10px; padding:28px 32px; box-shadow:0 8px 32px rgba(0,0,0,.18); overflow-y:auto;">
    <form id="activateForm">

      <h4 style="margin:0 0 12px; font-size:16px; color:#1a1a1a;">Select Products to Activate</h4>
      <input type="hidden" id="activate_school_id" name="school_id" value="">

      <!-- Column header row -->
      <div style="display:flex; align-items:center; margin-bottom:6px; padding:0 4px;">
        <div style="width:100%; display:flex;" class="align-items-center">
          <div style="width:20%; font-size:12px; font-weight:600; color:#555;" class="d-flex gap-2 align-items-center">
            <div><input type="checkbox" id="checkAll"></div> <div>Select All</div>
          </div>
          <div style="width:20%; font-size:12px; font-weight:600; color:#555; ">Price Code</div>
          <div style="width:20%; font-size:12px; font-weight:600; color:#555; ">Level</div>
          <div style="width:20%; font-size:12px; font-weight:600; color:#555;  margin-left:10px;">Split</div>
          <div style="width:20%; font-size:12px; font-weight:600; color:#555;  margin-left:10px;">Value</div>
        </div>
      </div>

      <div style="display:flex; align-items:flex-start; gap:10px;">

        <!-- Left: product list -->
        <div style="width:70%;">
          <div id="productList" style="max-height:420px; border:1px solid #eee; overflow-y:auto; border-radius:6px; padding:8px;">
            <?php
              $this->db->select('*');
              $this->db->from('products');
              $this->db->where('status', 'Active');
              $this->db->where('product_name !=', 'Lunar Skill Test');
              $res = $this->db->get();
              $result = $res->result_array();

              $this->db->select('*');
              $this->db->from('price_codegenration');
              $res2 = $this->db->get();
              $result2 = $res2->result_array();

              /* ── Fetch levels per product from competition_level_byproduct ── */
              $lvRes = $this->db
                            ->select('level_id, level_name, product_id')
                            ->order_by('medal_no', 'ASC')
                            ->get('competition_level_byproduct')
                            ->result_array();

              /* Build a map: product_id => [ [level_id, level_name], ... ] */
              $levelsByProduct = [];
              foreach ($lvRes as $lv) {
                  $levelsByProduct[$lv['product_id']][] = [
                      'level_id'   => $lv['level_id'],
                      'level_name' => $lv['level_name'],
                  ];
              }

              if (!empty($result)) {
                foreach ($result as $val) { ?>
                <div class="product-row" id="prow-<?php echo $val['product_id']; ?>">

                  <!-- Checkbox + product name -->
                  <label class="col-check" >
                    <input type="checkbox"
                           name="product_id[]"
                           value="<?php echo $val['product_id']; ?>"
                           data-product-name="<?php echo htmlspecialchars($val['product_name'], ENT_QUOTES); ?>"
                           onchange="rebuildLevelDropdown(<?php echo $val['product_id']; ?>); refreshSummary()">
                    <span style="font-size:13px; color:#333;"><?php echo $val['product_name']; ?></span>
                  </label>
                  <!-- Price Code -->
                  <div class="col-price">
                    <?php if (!empty($result2)) { ?>
                    <select name="product_price[<?php echo $val['product_id']; ?>]"
                            id="product_p_<?php echo $val['product_id']; ?>"
                            class="chk"
                            onchange="handlePriceCodeChange(); refreshSummary();">
                      <option value="">-- Price --</option>
                      <?php foreach ($result2 as $price) { ?>
                      <option value="<?php echo $price['price_code']; ?>"><?php echo $price['price_code']; ?></option>
                      <?php } ?>
                    </select>
                    <?php } ?>
                  </div>

                  <!-- Level — options come from competition_level_byproduct filtered by product_id -->
                  <div class="col-level">
                    <select name="product_level[<?php echo $val['product_id']; ?>]"
                            id="product_l_<?php echo $val['product_id']; ?>"
                            class="chk"
                            onchange="refreshSummary()">
                      <option value="">-- Level --</option>
                      <?php if (!empty($levelsByProduct[$val['product_id']])) { ?>
                        <option value="All">All Levels</option>
                        <?php foreach ($levelsByProduct[$val['product_id']] as $lv) { ?>
                        <option value="<?php echo $lv['level_id']; ?>"><?php echo htmlspecialchars($lv['level_name']); ?></option>
                        <?php } ?>
                      <?php } else { ?>
                        <option value="" disabled style="color:#bbb;">No levels</option>
                      <?php } ?>
                    </select>
                  </div>

                </div>
              <?php } } ?>
          </div><!-- /#productList -->

          <!-- ===== SELECTED PRODUCTS SUMMARY ===== -->
          <div id="selectedSummary">
            <div class="sum-title">Selected Products</div>
            <div class="sum-empty" id="sum-empty-msg">No products selected yet.</div>
            <div class="sum-list" id="sum-list"></div>
          </div>

        </div><!-- /left col -->

        <!-- Right: value fields -->
        <div class="promo-right-col" style="width:25%; max-height:500px; overflow-y:auto; border-radius:6px; padding:8px; display:flex; flex-direction:column; gap:4px;">
             <label style="font-size:11px; font-weight:600; color:#555;">Competition Type <span style="color:red;">*</span></label>
              <select name="competition_type" class="chk" required style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
                <option value="">-- Select Competition --</option>
                <option value="school">School Level</option>
                <option value="open">Open</option>
               
              </select>
          <label style="font-size:11px; font-weight:600; color:#555;">School Amount Fixed <span style="color:red;">*</span></label>
          <input type="text" name="schoolper" class="chk" required style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">Management Percentage <span style="color:red;">*</span></label>
          <select name="manageper" class="chk" required style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
            <option value="">-- Select management % --</option>
            <option value="2">2%</option><option value="3">3%</option><option value="4">4%</option>
            <option value="5">5%</option><option value="8">8%</option><option value="10">10%</option>
            <option value="12">12%</option><option value="15">15%</option><option value="16">16%</option>
            <option value="18">18%</option><option value="20">20%</option><option value="22">22%</option>
          </select>

          <label style="font-size:11px; font-weight:600; color:#555;">Aviansys Percentage <span style="color:red;">*</span></label>
          <select name="com_peravian" class="chk" required style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
            <option value="">-- Select aviansys % --</option>
            <option value="2">2%</option><option value="3">3%</option><option value="4">4%</option>
            <option value="5">5%</option><option value="8">8%</option><option value="10">10%</option>
            <option value="12">12%</option><option value="15">15%</option><option value="16">16%</option>
            <option value="18">18%</option><option value="20">20%</option><option value="22">22%</option>
            <option value="25">25%</option><option value="30">30%</option>
          </select>

          <label style="font-size:11px; font-weight:600; color:#555;">Associate Percentage</label>
          <select name="associate_per" class="chk" style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
            <option value="">-- Select associate % --</option>
            <option value="5">5%</option><option value="10">10%</option><option value="15">15%</option>
            <option value="20">20%</option><option value="25">25%</option><option value="30">30%</option>
            <option value="35">35%</option><option value="40">40%</option><option value="45">45%</option>
            <option value="50">50%</option><option value="55">55%</option><option value="60">60%</option>
          </select>

          <label style="font-size:11px; font-weight:600; color:#555;">Franchise Percentage</label>
          <select name="com_per" class="chk" style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
            <option value="">-- Select franchise % --</option>
            <option value="5">5%</option><option value="10">10%</option><option value="15">15%</option>
            <option value="20">20%</option><option value="25">25%</option><option value="30">30%</option>
            <option value="35">35%</option><option value="40">40%</option><option value="45">45%</option>
            <option value="50">50%</option><option value="55">55%</option><option value="60">60%</option>
          </select>
          
           <label style="font-size:11px; font-weight:600; color:#555;"> CRM<span style="color:red;">*</span></label>
              <select name="crm" class="chk" style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
              <option value="">-- Select CRM --</option>
               <?php foreach($crm_account as $val) { ?>
        	   <option value="<?php echo $val['id'] ?>" ><?php echo $val['desc']; ?></option>
        		<?php } ?>
              </select>
          <label style="font-size:11px; font-weight:600; color:#555;">CRM % <span style="color:red;">*</span></label>
          <select name="crm_per" class="chk" style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
            <option value="">-- Select CRM %--</option>
            <option value="0" selected>0%</option>
            <option value="1">1%</option><option value="2">2%</option><option value="3">3%</option>
            <option value="4">4%</option><option value="5">5%</option><option value="6">6%</option>
            <option value="7">7%</option><option value="8">8%</option><option value="9">9%</option>
            <option value="10">10%</option>
          </select>
          
          <label style="font-size:11px; font-weight:600; color:#555;">IT %<span style="color:red;">*</span></label>
          <!--<input type="text" name="it_fix" placeholder="Enter IT Fix Amount" class="chk"  style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">-->
            <select name="it_fix" class="it_fix" style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
                <option value="0" selected>0%</option>
                <option value="1">1%</option><option value="2">2%</option><option value="3">3%</option>
                <option value="4">4%</option><option value="5">5%</option><option value="6">6%</option>
                <option value="7">7%</option><option value="8">8%</option><option value="9">9%</option>
                <option value="10">10%</option>
            </select>

          <label style="font-size:11px; font-weight:600; color:#555;">Free Material Royalty <span style="color:red;">*</span></label>
          <input type="text" name="free_mat_royalty" placeholder="Enter royalty" class="chk"
                 style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

           <label style="font-size:11px; font-weight:600; color:#555;">Study Material A + Training A</label>
            <input type="text" name="material_training_a" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

            <label style="font-size:11px; font-weight:600; color:#555;">Study Material A + Training A Royality</label>
            <input type="text" name="material_training_a_royalty" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

            <label style="font-size:11px; font-weight:600; color:#555;">Study Material B + Training B</label>
            <input type="text" name="material_training_b" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

            <label style="font-size:11px; font-weight:600; color:#555;">Study Material B + Training B Royality</label>
            <input type="text" name="material_training_b_royalty" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
        </div>
         <div style="margin-top:14px; width:25%;max-height:500px;overflow-y:auto; padding-top:10px; border-top:1px dashed #ccc;">
           <label style="font-size:11px; font-weight:600; color:#555;">Material-A Price</label>
          <input type="text" name="material_a_price" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">Material-A Royalty</label>
          <input type="text" name="material_a_royalty" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">Material-B Price</label>
          <input type="text" name="material_b_price" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">Material-B Royalty</label>
          <input type="text" name="material_b_royalty" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">Orientation-A Price</label>
          <input type="text" name="orientation_a_price" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">Orientation-B Price</label>
          <input type="text" name="orientation_b_price" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">MockTest-A Price</label>
          <input type="text" name="mocktest_a_price" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">MockTest-A Royalty</label>
          <input type="text" name="mocktest_a_royalty" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">MockTest-B Price</label>
          <input type="text" name="mocktest_b_price" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">

          <label style="font-size:11px; font-weight:600; color:#555;">MockTest-B Royalty</label>
          <input type="text" name="mocktest_b_royalty" class="chk" style="width:96%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
        </div>

      </div><!-- /flex row -->

      <div id="activate_error" style="display:none; color:#c0392b; font-size:12px; margin-top:10px; padding:6px 10px; background:#fdecea; border-radius:5px;"></div>

      <div style="display:flex; gap:10px; justify-content:flex-end; margin-top:20px;">
        <button type="button" onclick="closeActivateModal()"
                style="padding:8px 20px; border-radius:6px; border:1px solid #ccc; background:#f1efe8; cursor:pointer; font-size:13px;">
          Cancel
        </button>
        <button type="button" id="confirmActivateBtn" onclick="submitActivateForm()"
                style="padding:8px 20px; border-radius:6px; border:none; background:#1D9E75; color:#fff; cursor:pointer; font-size:13px; font-weight:600;">
          Confirm Activate
        </button>
      </div>

    </form>
  </div>
</div>
<!-- ===== END ACTIVATE MODAL ===== -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
/* ==============================================
   SCROLL TOGGLE BUTTON
   ============================================== */
(function() {
    var btn  = document.getElementById("scrollToggleBtn");
    var icon = document.getElementById("scrollIcon");
    var goDown = true;

    btn.addEventListener("click", function () {
        if (goDown) {
            window.scrollTo({ top: document.documentElement.scrollHeight, behavior: "smooth" });
            icon.className = "bi bi-chevron-up";
            goDown = false;
        } else {
            window.scrollTo({ top: 0, behavior: "smooth" });
            icon.className = "bi bi-chevron-down";
            goDown = true;
        }
    });
})();

/* ==============================================
   LEVELS MAP  (product_id → array of {level_id, level_name})
   Built from competition_level_byproduct, ordered by medal_no
   ============================================== */
var levelsByProduct = <?php echo json_encode($levelsByProduct, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

/* ==============================================
   REBUILD LEVEL DROPDOWN FOR A PRODUCT
   Called whenever a product checkbox changes so
   the level <select> always reflects that product's
   entries from competition_level_byproduct.
   ============================================== */
function rebuildLevelDropdown(pid, savedValue) {
    var sel = document.getElementById('product_l_' + pid);
    if (!sel) return;

    var levels = levelsByProduct[pid] || [];

    sel.innerHTML = '<option value="">-- Level --</option>';

    if (levels.length === 0) {
        var noOpt = document.createElement('option');
        noOpt.value    = '';
        noOpt.disabled = true;
        noOpt.style.color = '#bbb';
        noOpt.textContent = 'No levels';
        sel.appendChild(noOpt);
        return;
    }

    var allOpt = document.createElement('option');
    allOpt.value       = 'All';
    allOpt.textContent = 'All Levels';
    sel.appendChild(allOpt);

    levels.forEach(function(lv) {
        var opt = document.createElement('option');
        opt.value       = lv.level_id;
        opt.textContent = lv.level_name;
        sel.appendChild(opt);
    });

    if (savedValue) sel.value = savedValue;
}

function refreshSummary() {
    var list    = document.getElementById('sum-list');
    var empty   = document.getElementById('sum-empty-msg');
    var checked = document.querySelectorAll('input[name="product_id[]"]:checked');

    list.innerHTML = '';

    if (checked.length === 0) {
        empty.style.display = '';
        return;
    }
    empty.style.display = 'none';

    checked.forEach(function(cb) {
        var pid   = cb.value;
        var name  = cb.dataset.productName || ('Product ' + pid);
        var price = '';
        var level = '';

        var priceEl = document.getElementById('product_p_' + pid);
        if (priceEl && priceEl.value) {
            price = priceEl.value;
        }

        var levelEl = document.getElementById('product_l_' + pid);
        if (levelEl && levelEl.value) {
            level = levelEl.options[levelEl.selectedIndex].text;
        }

        var tag = document.createElement('div');
        tag.className = 'sum-tag';

        var html = '<strong>' + name + '</strong>';
        if (price) html += ' <span class="sum-meta">· ' + price + '</span>';
        if (level) html += ' <span class="sum-meta">· ' + level + '</span>';
        tag.innerHTML = html;

        list.appendChild(tag);
    });
}

/* ==============================================
   COMPETITION MODE TOGGLE
   ============================================== */
var _cm_schoolId = null;
var _cm_checkbox = null;

function toggleCompetitionMode(schoolId, chk) {
    _cm_schoolId = schoolId;
    _cm_checkbox = chk;

    if (!chk.checked) {
        $.ajax({
            url:      "<?php echo base_url(); ?>manage/ajax/updateCompetitionMode",
            type:     'POST',
            dataType: 'json',
            data:     { school_id: schoolId, mode: 'offline' },
            success: function(res) {
                if (res.status === 'success') {
                    document.getElementById('comp-lbl-' + schoolId).textContent = 'Offline';
                    showFlash('Competition mode set to Offline.', 'success');
                } else {
                    alert('Failed to save. Please try again.');
                    chk.checked = true;
                }
            },
            error: function() {
                alert('Server error. Please try again.');
                chk.checked = true;
            }
        });
        return;
    }

    document.getElementById('cm_start_date').value = chk.dataset.startDate || '';
    document.getElementById('cm_end_date').value   = chk.dataset.endDate   || '';
    var errEl = document.getElementById('cm_error');
    errEl.style.display = 'none';
    errEl.textContent   = '';
    document.getElementById('compModeModal').classList.add('show');
}

function saveCompMode() {
    var errEl     = document.getElementById('cm_error');
    var startDate = document.getElementById('cm_start_date').value.trim();
    var endDate   = document.getElementById('cm_end_date').value.trim();
    errEl.style.display = 'none';

    if (!startDate || !endDate) {
        errEl.textContent   = 'Start date and end date are required.';
        errEl.style.display = 'block';
        return;
    }
    if (endDate < startDate) {
        errEl.textContent   = 'End date cannot be before start date.';
        errEl.style.display = 'block';
        return;
    }

    document.getElementById('compModeModal').classList.remove('show');

    $.ajax({
        url:      "<?php echo base_url(); ?>manage/ajax/updateCompetitionMode",
        type:     'POST',
        dataType: 'json',
        data:     { school_id: _cm_schoolId, mode: 'online', start_date: startDate, end_date: endDate },
        success: function(res) {
            if (res.status === 'success') {
                document.getElementById('comp-lbl-' + _cm_schoolId).textContent = 'Online';
                showFlash('Competition mode set to Online.', 'success');
                if (_cm_checkbox) {
                    _cm_checkbox.dataset.startDate = startDate;
                    _cm_checkbox.dataset.endDate   = endDate;
                }
            } else {
                alert('Failed to save. Please try again.');
                _cm_checkbox.checked = false;
            }
        },
        error: function() {
            alert('Server error. Please try again.');
            _cm_checkbox.checked = false;
        }
    });
}

function cancelCompMode() {
    _cm_checkbox.checked = false;
    document.getElementById('compModeModal').classList.remove('show');
}

document.getElementById('compModeModal').addEventListener('click', function(e) {
    if (e.target === this) { cancelCompMode(); }
});

/* ==============================================
   CIN MODE TOGGLE
   ============================================== */
var _cin_schoolId   = null;
var _cin_checkbox   = null;
var _cin_schoolCode = null;

function toggleCinMode(schoolId, chk) {
    _cin_schoolId   = schoolId;
    _cin_checkbox   = chk;
    _cin_schoolCode = chk.dataset.schoolCode;

    if (!chk.checked) {
        $.ajax({
            url:      "<?php echo base_url(); ?>manage/ajax/updateCinMode",
            type:     'POST',
            dataType: 'json',
            data:     { school_id: _cin_schoolId, mode: 'offline' },
            success: function(res) {
                if (res.status === 'success') {
                    document.getElementById('cin-lbl-' + _cin_schoolId).textContent = 'Offline';
                    showFlash('CIN mode set to Offline.', 'success');
                } else {
                    alert('Failed to save. Please try again.');
                    _cin_checkbox.checked = true;
                }
            },
            error: function() {
                alert('Server error. Please try again.');
                _cin_checkbox.checked = true;
            }
        });
        return;
    }

    document.getElementById('cin_start_date').value = chk.dataset.startDate || '';
    document.getElementById('cin_end_date').value   = chk.dataset.endDate   || '';
    var errEl = document.getElementById('cin_error');
    errEl.style.display = 'none';
    errEl.textContent   = '';
    document.getElementById('cinModeModal').classList.add('show');
}

function saveCinMode() {
    var errEl     = document.getElementById('cin_error');
    var startDate = document.getElementById('cin_start_date').value.trim();
    var endDate   = document.getElementById('cin_end_date').value.trim();
    errEl.style.display = 'none';

    if (!startDate || !endDate) {
        errEl.textContent   = 'Start date and end date are required.';
        errEl.style.display = 'block';
        return;
    }
    if (endDate < startDate) {
        errEl.textContent   = 'End date cannot be before start date.';
        errEl.style.display = 'block';
        return;
    }

    document.getElementById('cinModeModal').classList.remove('show');

    $.ajax({
        url:      "<?php echo base_url(); ?>manage/ajax/updateCinMode",
        type:     'POST',
        dataType: 'json',
        data:     { school_id: _cin_schoolId, mode: 'online', start_date: startDate, end_date: endDate },
        success: function(res) {
            if (res.status === 'success') {
                document.getElementById('cin-lbl-' + _cin_schoolId).textContent = 'Online';
                showFlash('CIN mode set to Online.', 'success');
                if (_cin_checkbox) {
                    _cin_checkbox.dataset.startDate = startDate;
                    _cin_checkbox.dataset.endDate   = endDate;
                }
            } else {
                alert('Failed to save. Please try again.');
                _cin_checkbox.checked = false;
            }
        },
        error: function() {
            alert('Server error. Please try again.');
            _cin_checkbox.checked = false;
        }
    });
}

function cancelCinMode() {
    _cin_checkbox.checked = false;
    document.getElementById('cinModeModal').classList.remove('show');
}

document.getElementById('cinModeModal').addEventListener('click', function(e) {
    if (e.target === this) { cancelCinMode(); }
});

/* ==============================================
   SET CIN MODE TO OFFLINE (reusable helper)
   ============================================== */
function setCinOffline(schoolId) {
    $.ajax({
        url:      "<?php echo base_url(); ?>manage/ajax/updateCinMode",
        type:     'POST',
        dataType: 'json',
        data:     { school_id: schoolId, mode: 'offline' },
        success: function(res) {
            if (res.status === 'success') {
                var row = document.getElementById('school-row-' + schoolId);
                if (row) {
                    var cinChk = row.querySelector('input[onchange*="toggleCinMode"]');
                    if (cinChk) cinChk.checked = false;
                }
                var lbl = document.getElementById('cin-lbl-' + schoolId);
                if (lbl) lbl.textContent = 'Offline';
            }
        }
    });
}

/* ==============================================
   SET COMPETITION MODE TO OFFLINE (reusable helper)
   ============================================== */
function setCompetitionOffline(schoolId) {
    $.ajax({
        url:      "<?php echo base_url(); ?>manage/ajax/updateCompetitionMode",
        type:     'POST',
        dataType: 'json',
        data:     { school_id: schoolId, mode: 'offline' },
        success: function(res) {
            if (res.status === 'success') {
                var row = document.getElementById('school-row-' + schoolId);
                if (row) {
                    var compChk = row.querySelector('input[onchange*="toggleCompetitionMode"]');
                    if (compChk) compChk.checked = false;
                }
                var lbl = document.getElementById('comp-lbl-' + schoolId);
                if (lbl) lbl.textContent = 'Offline';
            }
        }
    });
}

/* ==============================================
   SCHOOL DEACTIVATION
   ============================================== */
$(document).on('click', '.btn-deactivate', function() {
    if (!confirm('Are you sure you want to deactivate this school?')) return;

    var schoolId = $(this).data('id');
    var btn      = $(this);
    btn.prop('disabled', true).text('Saving...');

    $.ajax({
        url:      "<?php echo base_url(); ?>manage/franchise/schoollevelactive/" + schoolId,
        type:     'POST',
        dataType: 'json',
        success: function(res) {
            if (res && res.status === 'success') {
                swapActivationCell(schoolId, false);
                showFlash(res.message || 'School deactivated successfully.', 'success');
                setCinOffline(schoolId);
                setCompetitionOffline(schoolId);
            } else {
                btn.prop('disabled', false).text('Deactivate');
                showFlash((res && res.message) ? res.message : 'Failed to deactivate. Please try again.', 'error');
            }
        },
        error: function(xhr) {
            btn.prop('disabled', false).text('Deactivate');
            if (xhr.status === 200) {
                swapActivationCell(schoolId, false);
                showFlash('School deactivated successfully.', 'success');
                setCinOffline(schoolId);
                setCompetitionOffline(schoolId);
            } else {
                showFlash('Server error. Please try again.', 'error');
            }
        }
    });
});

function swapActivationCell(schoolId, activate) {
    var row  = document.getElementById('school-row-' + schoolId);
    if (!row) return;
    var cell = row.querySelector('td:nth-child(10)');
    if (!cell) return;

    if (activate) {
        cell.innerHTML = '<button type="button" class="btn btn-danger btn-deactivate" style="font-size:11px;" data-id="' + schoolId + '">Deactivate</button>';
    } else {
        cell.innerHTML = '<a href="javascript:void(0);" class="btn btn-warning btn-activate" style="font-size:11px;" data-id="' + schoolId + '">Activate</a>';
    }

    var editBtn = row.querySelector('.btn-edit');
    if (editBtn) {
        if (activate) {
            editBtn.classList.remove('disabled');
            editBtn.removeAttribute('aria-disabled');
            editBtn.style.pointerEvents = '';
            editBtn.style.opacity = '';
        } else {
            editBtn.classList.add('disabled');
            editBtn.setAttribute('aria-disabled', 'true');
            editBtn.style.pointerEvents = 'none';
            editBtn.style.opacity = '0.5';
        }
    }
}

/* ==============================================
   PRICE CODE → DISABLE FIELDS ON "promotional-0"
   ============================================== */
function handlePriceCodeChange() {
    var promoSelect = null;

    document.querySelectorAll('select[id^="product_p_"]').forEach(function(sel) {
        if (sel.value === 'promotional-0') promoSelect = sel;
    });

    var isPromo = !!promoSelect;

    document.querySelectorAll('select[id^="product_p_"]').forEach(function(sel) {
        // if (isPromo) {
        //     if (sel.value !== 'promotional-0') {
        //         sel.value = 'promotional-0';
        //     }
        //     // IMPORTANT: do NOT use sel.disabled = true here.
        //     // Disabled <select> fields are excluded from FormData entirely,
        //     // which caused non-clicked products to submit no product_price[id]
        //     // at all and get silently skipped server-side.
        //     sel.disabled = false;
        //     sel.style.pointerEvents   = (sel === promoSelect) ? '' : 'none';
        //     sel.style.backgroundColor = (sel === promoSelect) ? '' : '#f1efe8';
        // } else {
        //     sel.disabled = false;
        //     sel.style.pointerEvents   = '';
        //     sel.style.backgroundColor = '';
        // }
        if (isPromo) {
    if (sel.value !== 'promotional-0') {
        sel.value = 'promotional-0';
    }

    // Keep every dropdown editable
    sel.disabled = false;
    sel.style.pointerEvents = '';
    sel.style.backgroundColor = '';
} else {
    sel.disabled = false;
    sel.style.pointerEvents = '';
    sel.style.backgroundColor = '';
}
    });

    var fields = document.querySelectorAll(
        'select[name="manageper"], select[name="com_peravian"], select[name="associate_per"], ' +
        'select[name="com_per"], select[name="crm_per"], input[name="free_mat_royalty"], input[name="schoolper"],select[name="crm"]'
        
    );

    fields.forEach(function(field) {
        field.style.display = isPromo ? 'none' : '';
        field.value = isPromo ? '' : field.value;
        var lbl = field.previousElementSibling;
        if (lbl && lbl.tagName === 'LABEL') {
            lbl.style.display = isPromo ? 'none' : '';
        }
    });

    refreshSummary();
}
document.getElementById('productList').addEventListener('change', function(e) {
    if (e.target && e.target.id && e.target.id.startsWith('product_p_')) {
        handlePriceCodeChange();
    }
});

/* ==============================================
   ACTIVATE / EDIT MODAL
   ============================================== */
$(document).on('click', '.btn-activate', function() {
    document.querySelector('#activateModal h4').textContent = 'Select Products to Activate';
    document.getElementById('confirmActivateBtn').textContent = 'Confirm Activate';
    openActivateModal($(this).data('id'), false); // false = fresh, blank activation
});

$(document).on('click', '.btn-edit', function() {
    var schoolId = $(this).data('id');
    document.querySelector('#activateModal h4').textContent = 'Edit School Activation';
    document.getElementById('confirmActivateBtn').textContent = 'Save Changes';
    openActivateModal(schoolId, true); // true = fetch & prefill saved data
});

function openActivateModal(schoolId, prefill) {
    document.getElementById('activate_school_id').value = schoolId;
    document.getElementById('activate_error').style.display = 'none';
    document.getElementById('activate_error').textContent   = '';

    // Reset all fields
    document.getElementById('checkAll').checked = false;
    document.querySelectorAll('input[name="product_id[]"]').forEach(cb => cb.checked = false);
    document.querySelectorAll('#activateForm select').forEach(sel => sel.selectedIndex = 0);
    document.querySelectorAll('#activateForm input[type="text"]').forEach(inp => inp.value = '');

    // Clear any promo-mode lock styling left over from a previous session
    document.querySelectorAll('select[id^="product_p_"]').forEach(function(sel) {
        sel.disabled = false;
        sel.style.pointerEvents   = '';
        sel.style.backgroundColor = '';
    });

    document.querySelectorAll('select[id^="product_l_"]').forEach(function(sel) {
        var pid = sel.id.replace('product_l_', '');
        rebuildLevelDropdown(pid, '');
    });

    // document.querySelectorAll(
    //     'select[name="manageper"], select[name="com_peravian"], select[name="associate_per"], ' +
    //     'select[name="com_per"], select[name="crm_per"], input[name="free_mat_royalty"], input[name="schoolper"],select[name="crm"]'
    // ).forEach(function(f) {
    //     f.style.display = '';
    //     f.value = '';
    //     var lbl = f.previousElementSibling;
    //     if (lbl && lbl.tagName === 'LABEL') lbl.style.display = '';
    // });

     document.querySelectorAll(
    '#activateForm select[name="manageper"], #activateForm select[name="com_peravian"], #activateForm select[name="associate_per"], ' +
    '#activateForm select[name="com_per"], #activateForm select[name="crm_per"], #activateForm input[name="free_mat_royalty"], #activateForm input[name="schoolper"], #activateForm select[name="crm"]'
    ).forEach(function(f) {
        f.style.display = '';
        f.value = '';
        var lbl = f.previousElementSibling;
        if (lbl && lbl.tagName === 'LABEL') lbl.style.display = '';
    });
     
    refreshSummary();

    document.getElementById('activateModal').style.display = 'flex';

    // ── Only fetch & pre-fill saved data when this is an EDIT ──────────
    if (!prefill) {
        return;
    }

    $.ajax({
        url:      "<?php echo base_url(); ?>manage/franchise/getSchoolActivationData",
        type:     'POST',
        dataType: 'json',
        data:     { school_id: schoolId },
        success: function(res) {
            if (!res || res.status !== 'success') return;

            // var c = res.common;
          
            // document.querySelector('input[name="schoolper"]').value         = c.school_amount    || '';
            // document.querySelector('select[name="manageper"]').value        = c.manageper        || '';
            // document.querySelector('select[name="com_peravian"]').value     = c.com_peravian     || '';
            // document.querySelector('select[name="competition_type"]').value        = c.competition_type        || '';
            // document.querySelector('select[name="crm"]').value     = c.crm_id     || '';
            // document.querySelector('select[name="associate_per"]').value    = c.associate_per    || '';
            // document.querySelector('select[name="com_per"]').value          = c.franchise_per    || '';
            // document.querySelector('select[name="crm_per"]').value          = c.crm_per          || '';
            // document.querySelector('select[name="it_fix"]').value          = c.it_fix          || '';
            // document.querySelector('input[name="free_mat_royalty"]').value  = c.free_mat_royalty || '';

            // document.querySelector('input[name="material_training_a"]').value          = c.material_training_a          || '';
            // document.querySelector('input[name="material_training_a_royalty"]').value  = c.material_training_a_royalty  || '';
            // document.querySelector('input[name="material_training_b"]').value          = c.material_training_b          || '';
            // document.querySelector('input[name="material_training_b_royalty"]').value  = c.material_training_b_royalty  || '';

            // document.querySelector('input[name="material_a_price"]').value    = c.material_a_price    || '';
            // document.querySelector('input[name="material_a_royalty"]').value  = c.material_a_royalty  || '';
            // document.querySelector('input[name="material_b_price"]').value    = c.material_b_price    || '';
            // document.querySelector('input[name="material_b_royalty"]').value  = c.material_b_royalty  || '';

            // document.querySelector('input[name="orientation_a_price"]').value = c.orientation_a_price || '';
            // document.querySelector('input[name="orientation_b_price"]').value = c.orientation_b_price || '';

            // document.querySelector('input[name="mocktest_a_price"]').value    = c.mocktest_a_price    || '';
            // document.querySelector('input[name="mocktest_a_royalty"]').value  = c.mocktest_a_royalty  || '';
            // document.querySelector('input[name="mocktest_b_price"]').value    = c.mocktest_b_price    || '';
            // document.querySelector('input[name="mocktest_b_royalty"]').value  = c.mocktest_b_royalty  || '';
            
            var c = res.common;

document.querySelector('#activateForm input[name="schoolper"]').value         = c.school_amount    || '';
document.querySelector('#activateForm select[name="manageper"]').value        = c.manageper        || '';
document.querySelector('#activateForm select[name="com_peravian"]').value     = c.com_peravian     || '';
document.querySelector('#activateForm select[name="competition_type"]').value = c.competition_type || '';
document.querySelector('#activateForm select[name="crm"]').value              = c.crm_id           || '';
document.querySelector('#activateForm select[name="associate_per"]').value    = c.associate_per    || '';
document.querySelector('#activateForm select[name="com_per"]').value          = c.franchise_per    || '';
document.querySelector('#activateForm select[name="crm_per"]').value          = c.crm_per          || '';
document.querySelector('#activateForm select[name="it_fix"]').value           = c.it_fix           || '';
document.querySelector('#activateForm input[name="free_mat_royalty"]').value  = c.free_mat_royalty || '';

document.querySelector('#activateForm input[name="material_training_a"]').value          = c.material_training_a          || '';
document.querySelector('#activateForm input[name="material_training_a_royalty"]').value  = c.material_training_a_royalty  || '';
document.querySelector('#activateForm input[name="material_training_b"]').value          = c.material_training_b          || '';
document.querySelector('#activateForm input[name="material_training_b_royalty"]').value  = c.material_training_b_royalty  || '';

document.querySelector('#activateForm input[name="material_a_price"]').value    = c.material_a_price    || '';
document.querySelector('#activateForm input[name="material_a_royalty"]').value  = c.material_a_royalty  || '';
document.querySelector('#activateForm input[name="material_b_price"]').value    = c.material_b_price    || '';
document.querySelector('#activateForm input[name="material_b_royalty"]').value  = c.material_b_royalty  || '';

document.querySelector('#activateForm input[name="orientation_a_price"]').value = c.orientation_a_price || '';
document.querySelector('#activateForm input[name="orientation_b_price"]').value = c.orientation_b_price || '';

document.querySelector('#activateForm input[name="mocktest_a_price"]').value    = c.mocktest_a_price    || '';
document.querySelector('#activateForm input[name="mocktest_a_royalty"]').value  = c.mocktest_a_royalty  || '';
document.querySelector('#activateForm input[name="mocktest_b_price"]').value    = c.mocktest_b_price    || '';
document.querySelector('#activateForm input[name="mocktest_b_royalty"]').value  = c.mocktest_b_royalty  || '';

            res.product_ids.forEach(function(pid) {
                var cb = document.querySelector('input[name="product_id[]"][value="' + pid + '"]');
                if (cb) cb.checked = true;

                var priceCode = (res.pricecode_ids && res.pricecode_ids[pid]) ? res.pricecode_ids[pid] : '';
                var priceEl   = document.getElementById('product_p_' + pid);
                if (priceEl && priceCode) priceEl.value = priceCode;

                var savedLevel = (res.level_ids && res.level_ids[pid]) ? res.level_ids[pid] : '';
                rebuildLevelDropdown(pid, savedLevel);
            });

            var allBoxes   = document.querySelectorAll('input[name="product_id[]"]');
            var allChecked = document.querySelectorAll('input[name="product_id[]"]:checked');
            document.getElementById('checkAll').checked = (allBoxes.length === allChecked.length);

            refreshSummary();
        }
    });
}

/* ==============================================
   CLOSE ACTIVATE MODAL  (single source of truth — no patching)
   ============================================== */
function closeActivateModal() {
    document.getElementById('activateModal').style.display = 'none';
    document.querySelector('#activateModal h4').textContent = 'Select Products to Activate';
    document.getElementById('confirmActivateBtn').textContent = 'Confirm Activate';
}

document.getElementById('activateModal').addEventListener('click', function(e) {
    if (e.target === this) { closeActivateModal(); }
});

document.getElementById('checkAll').addEventListener('change', function() {
    document.querySelectorAll('input[name="product_id[]"]').forEach(function(cb) {
        cb.checked = document.getElementById('checkAll').checked;
    });
    refreshSummary();
});

function submitActivateForm() {
    var errEl   = document.getElementById('activate_error');
    var btnEl   = document.getElementById('confirmActivateBtn');
    var checked = document.querySelectorAll('input[name="product_id[]"]:checked');

    errEl.style.display = 'none';
    errEl.textContent   = '';

    if (checked.length === 0) {
        errEl.textContent   = 'Please select at least one product.';
        errEl.style.display = 'block';
        return;
    }

    var formData = new FormData(document.getElementById('activateForm'));

    btnEl.disabled    = true;
    btnEl.textContent = 'Saving...';

    $.ajax({
        url:         "<?php echo base_url(); ?>manage/franchise/newschoollevelactive",
        type:        'POST',
        dataType:    'json',
        data:        formData,
        processData: false,
        contentType: false,
        success: function(res) {
            btnEl.disabled    = false;
            btnEl.textContent = 'Confirm Activate';
          
            if (res && res.status === 'success') {
                var schoolId = document.getElementById('activate_school_id').value;
                closeActivateModal();
                swapActivationCell(schoolId, true);
                showFlash(res.message || 'School activated successfully.', 'success');
            } else {
                errEl.textContent   = (res && res.message) ? res.message : 'Something went wrong. Please try again.';
                errEl.style.display = 'block';
            }
        },
        error: function(xhr) {
            btnEl.disabled    = false;
            btnEl.textContent = 'Confirm Activate';

            if (xhr.status === 200) {
                var schoolId = document.getElementById('activate_school_id').value;
                closeActivateModal();
                swapActivationCell(schoolId, true);
                showFlash('School activated successfully.', 'success');
            } else {
                errEl.textContent   = 'Server error (' + xhr.status + '). Please try again.';
                errEl.style.display = 'block';
            }
        }
    });
}

/* ==============================================
   CASCADE DROPDOWNS
   ============================================== */

$(document).ready(function(){

    $("#country_id").select2({
        placeholder: "-- Select Country --",
        allowClear: true,
        width: "200px"
    });

});
 
$("#country_id").change(function(){
    $.ajax({
        url:  "<?php echo base_url(); ?>manage/ajax/getstateAjax",
        data: { country_id: this.value },
        type: 'post',
        success: function(result){ $("#state_id").html(result); }
    });
});


$("#state_id").change(function(){
    $.ajax({
        url:  "<?php echo base_url(); ?>manage/ajax/franchiseList",
        data: { state_id: this.value },
        type: 'post',
        success: function(result){ $("#franchise").html(result); }
    });
});

$("#franchise").change(function(){
    $.ajax({
        url:  "<?php echo base_url(); ?>manage/ajax/AreaCode/",
        data: { franchise_id: this.value },
        type: 'post',
        success: function(result){ $("#area").html(result); }
    });
});
$('#state_id').on('change', function() {
    let state = $(this).val();

    if(state === 'All') {
        $('#franchise').val('All');
        $('#area').val('All');
    } else {
        $('#franchise').val('All'); // default
        $('#area').val('All');      // default
    }
});

$('#franchise').on('change', function() {
    let franchise = $(this).val();

    if(franchise === 'All') {
        $('#area').val('All');
    }
});



    function showLoader() {
        document.getElementById('global-loader').style.display = 'flex';
    }

  function hideLoader() {
    document.getElementById('global-loader').style.display = 'none';
  }

  // Auto-Hook to standard AJAX requests (jQuery)
  if (window.jQuery) {
    $(document).ajaxStart(function() {
      showLoader();
    }).ajaxStop(function() {
      hideLoader();
    });
  }

  // Show loader on Form Submissions (e.g., Filter Form, Export CSV)
  document.querySelectorAll('form').forEach(function(form) {
    form.addEventListener('submit', function() {
      showLoader();
    });
  });

 /* =========================================================
   BULK ACTIVATE - SEPARATE SCRIPT, SEPARATE MODAL (#bulkActivateModal)
   Does NOT touch #activateModal / #activateForm / their functions.
   ========================================================= */

(function () {

    var bulkActivateSchoolIds = [];

    function updateBulkActivateBtn() {
        var checked = document.querySelectorAll('.school-checkbox:checked').length;
        var btn = document.getElementById('bulkActivateBtn');
        if (!btn) return;
        var countEl = document.getElementById('bulkActivateCount');
        if (countEl) countEl.textContent = checked;
        btn.disabled = (checked === 0);
    }
    document.addEventListener('DOMContentLoaded', updateBulkActivateBtn);
    $(document).on('change', '.school-checkbox, #checkAllSchools', updateBulkActivateBtn);

    window.bulkRebuildLevelDropdown = function (pid, savedValue) {
        var sel = document.getElementById('bulk_product_l_' + pid);
        if (!sel) return;

        var levels = (window.levelsByProduct && window.levelsByProduct[pid]) || [];
        sel.innerHTML = '<option value="">-- Level --</option>';

        if (levels.length === 0) {
            var noOpt = document.createElement('option');
            noOpt.value = '';
            noOpt.disabled = true;
            noOpt.style.color = '#bbb';
            noOpt.textContent = 'No levels';
            sel.appendChild(noOpt);
            return;
        }

        var allOpt = document.createElement('option');
        allOpt.value = 'All';
        allOpt.textContent = 'All Levels';
        sel.appendChild(allOpt);

        levels.forEach(function (lv) {
            var opt = document.createElement('option');
            opt.value = lv.level_id;
            opt.textContent = lv.level_name;
            sel.appendChild(opt);
        });

        if (savedValue) sel.value = savedValue;
    };

    window.bulkRefreshSummary = function () {
        var list  = document.getElementById('bulk_sum_list');
        var empty = document.getElementById('bulk_sum_empty_msg');
        var checked = document.querySelectorAll('#bulkActivateForm input[name="product_id[]"]:checked');

        list.innerHTML = '';

        if (checked.length === 0) {
            empty.style.display = '';
            return;
        }
        empty.style.display = 'none';

        checked.forEach(function (cb) {
            var pid   = cb.value;
            var name  = cb.dataset.productName || ('Product ' + pid);
            var price = '';
            var level = '';

            var priceEl = document.getElementById('bulk_product_p_' + pid);
            if (priceEl && priceEl.value) price = priceEl.value;

            var levelEl = document.getElementById('bulk_product_l_' + pid);
            if (levelEl && levelEl.value) level = levelEl.options[levelEl.selectedIndex].text;

            var tag = document.createElement('div');
            tag.className = 'sum-tag';
            var html = '<strong>' + name + '</strong>';
            if (price) html += ' <span class="sum-meta">· ' + price + '</span>';
            if (level) html += ' <span class="sum-meta">· ' + level + '</span>';
            tag.innerHTML = html;
            list.appendChild(tag);
        });
    };

    window.bulkHandlePriceCodeChange = function () {
        var promoSelect = null;

        document.querySelectorAll('#bulkActivateForm select[id^="bulk_product_p_"]').forEach(function (sel) {
            if (sel.value === 'promotional-0') promoSelect = sel;
        });

        var isPromo = !!promoSelect;

        document.querySelectorAll('#bulkActivateForm select[id^="bulk_product_p_"]').forEach(function (sel) {
            if (isPromo && sel.value !== 'promotional-0') {
                sel.value = 'promotional-0';
            }
            sel.disabled = false;
            sel.style.pointerEvents = '';
            sel.style.backgroundColor = '';
        });

        var fields = document.querySelectorAll(
            '#bulkActivateForm select[name="manageper"], #bulkActivateForm select[name="com_peravian"], ' +
            '#bulkActivateForm select[name="associate_per"], #bulkActivateForm select[name="com_per"], ' +
            '#bulkActivateForm select[name="crm_per"], #bulkActivateForm input[name="free_mat_royalty"], ' +
            '#bulkActivateForm input[name="schoolper"], #bulkActivateForm select[name="crm"]'
        );

        fields.forEach(function (field) {
            field.style.display = isPromo ? 'none' : '';
            field.value = isPromo ? '' : field.value;
            var lbl = field.previousElementSibling;
            if (lbl && lbl.tagName === 'LABEL') {
                lbl.style.display = isPromo ? 'none' : '';
            }
        });

        window.bulkRefreshSummary();
    };

    var bulkProductListEl = document.getElementById('bulk_productList');
    if (bulkProductListEl) {
        bulkProductListEl.addEventListener('change', function (e) {
            if (e.target && e.target.id && e.target.id.startsWith('bulk_product_p_')) {
                window.bulkHandlePriceCodeChange();
            }
        });
    }

    var bulkCheckAllEl = document.getElementById('bulk_checkAll');
    if (bulkCheckAllEl) {
        bulkCheckAllEl.addEventListener('change', function () {
            var isChecked = this.checked;
            document.querySelectorAll('#bulkActivateForm input[name="product_id[]"]').forEach(function (cb) {
                cb.checked = isChecked;
            });
            window.bulkRefreshSummary();
        });
    }

    function resetBulkActivateForm() {
        if (bulkCheckAllEl) bulkCheckAllEl.checked = false;

        document.querySelectorAll('#bulkActivateForm input[name="product_id[]"]').forEach(function (cb) { cb.checked = false; });
        document.querySelectorAll('#bulkActivateForm select').forEach(function (sel) { sel.selectedIndex = 0; });
        document.querySelectorAll('#bulkActivateForm input[type="text"]').forEach(function (inp) { inp.value = ''; });

        document.querySelectorAll('#bulkActivateForm select[id^="bulk_product_p_"]').forEach(function (sel) {
            sel.disabled = false;
            sel.style.pointerEvents = '';
            sel.style.backgroundColor = '';
        });

        document.querySelectorAll('#bulkActivateForm select[id^="bulk_product_l_"]').forEach(function (sel) {
            var pid = sel.id.replace('bulk_product_l_', '');
            window.bulkRebuildLevelDropdown(pid, '');
        });

        document.querySelectorAll(
            '#bulkActivateForm select[name="manageper"], #bulkActivateForm select[name="com_peravian"], ' +
            '#bulkActivateForm select[name="associate_per"], #bulkActivateForm select[name="com_per"], ' +
            '#bulkActivateForm select[name="crm_per"], #bulkActivateForm input[name="free_mat_royalty"], ' +
            '#bulkActivateForm input[name="schoolper"], #bulkActivateForm select[name="crm"]'
        ).forEach(function (f) {
            f.style.display = '';
            f.value = '';
            var lbl = f.previousElementSibling;
            if (lbl && lbl.tagName === 'LABEL') lbl.style.display = '';
        });

        var errEl = document.getElementById('bulk_activate_error');
        errEl.style.display = 'none';
        errEl.textContent = '';

        window.bulkRefreshSummary();
    }

    $(document).on('click', '#bulkActivateBtn', function () {

        bulkActivateSchoolIds = $('.school-checkbox:checked').map(function () {
            return $(this).val();
        }).get();

        if (bulkActivateSchoolIds.length === 0) {
            alert('Please select at least one school.');
            return;
        }

        resetBulkActivateForm();

        document.getElementById('bulkActivateTitle').textContent =
            'Activate Selected Schools (' + bulkActivateSchoolIds.length + ')';
        var confirmBtn = document.getElementById('bulk_confirmActivateBtn');
        confirmBtn.disabled = false;
        confirmBtn.textContent = 'Activate All Schools';

        document.getElementById('bulkActivateModal').style.display = 'flex';
    });

    window.closeBulkActivateModal = function () {
        document.getElementById('bulkActivateModal').style.display = 'none';
        bulkActivateSchoolIds = [];
    };

    document.getElementById('bulkActivateModal').addEventListener('click', function (e) {
        if (e.target === this) { window.closeBulkActivateModal(); }
    });

    window.submitBulkActivateForm = function () {
        var errEl = document.getElementById('bulk_activate_error');
        var btn   = document.getElementById('bulk_confirmActivateBtn');
        var checked = document.querySelectorAll('#bulkActivateForm input[name="product_id[]"]:checked');

        errEl.style.display = 'none';
        errEl.textContent = '';

        if (checked.length === 0) {
            errEl.textContent = 'Please select at least one product.';
            errEl.style.display = 'block';
            return;
        }
        if (bulkActivateSchoolIds.length === 0) {
            errEl.textContent = 'No schools selected.';
            errEl.style.display = 'block';
            return;
        }

        btn.disabled = true;

        var total = bulkActivateSchoolIds.length;
        var index = 0;
        var successCount = 0;
        var failedSchools = [];

        function activateNext() {

            if (index >= total) {
                btn.disabled = false;
                btn.textContent = 'Activate All Schools';

                window.closeBulkActivateModal();

                $('.school-checkbox').prop('checked', false);
                $('#checkAllSchools').prop('checked', false);
                if (typeof updateBulkDeleteBtn === 'function') updateBulkDeleteBtn();
                updateBulkActivateBtn();

                if (failedSchools.length === 0) {
                    showFlash(successCount + ' school(s) activated successfully.', 'success');
                } else {
                    showFlash(
                        successCount + ' school(s) activated successfully. ' +
                        failedSchools.length + ' school(s) failed.',
                        'error'
                    );
                }
                return;
            }

            var schoolId = bulkActivateSchoolIds[index];
            btn.textContent = 'Activating ' + (index + 1) + ' / ' + total + '...';

            var formData = new FormData(document.getElementById('bulkActivateForm'));
            formData.set('school_id', schoolId);

            $.ajax({
                url: "<?php echo base_url(); ?>manage/franchise/newschoollevelactive",
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    if (res && res.status === 'success') {
                        successCount++;
                        if (typeof swapActivationCell === 'function') swapActivationCell(schoolId, true);
                    } else {
                        failedSchools.push(schoolId);
                    }
                    index++;
                    activateNext();
                },
                error: function () {
                    failedSchools.push(schoolId);
                    index++;
                    activateNext();
                }
            });
        }

        activateNext();
    };

})();

</script>
 <script>
        $(document).ready(function(){
            
            $('#Btnsubmit').click(function(){
               // alert('sasasas');
        $('#loader').show(); 
         setTimeout(function() {
            $('#loader').hide(); // Hide loader after specified duration
        }, 60000);
    });
            
            var state_id =$('#state_id').val();
           
            $.ajax({
            url:"<?php echo base_url();?>manage/ajax/franchiseList",
            data:{state_id:state_id},
            type: 'post',
            success:function(result)
            {
            	//alert(result);
            	 $("#franchise_id").html(result);
            	 
            
            }});
            
           
            
            // Initialize select2
            $("#school").select2();
             var username = $('#school option:selected').text();
                var userid = $('#school').val();
           
        });<!-- ============================================================
     Select2 Initialization
============================================================ -->

<script type="text/javascript">

$(document).ready(function () {

    /*
    |--------------------------------------------------------------------------
    | Country Searchable Dropdown
    |--------------------------------------------------------------------------
    */

    $("#country_id").select2({

        placeholder: "-- Select Country --",

        allowClear: true,

        width: "200px",

        /*
        | Search box will appear automatically
        */
        minimumResultsForSearch: 0

    });

});

</script>
            
   
        </script><?php include('footer.php'); ?>
