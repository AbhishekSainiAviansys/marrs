<?php include('header.php');//echo $flag;exit;//echo"<pre>";echo $schools[0]['school_code'];
//print_r($schools);die;//echo"<pre>"; echo $flag;exit;?>

<style>/* ===== SHARED TOGGLE STYLES ===== */
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

/* ===== ACTIVATE MODAL STYLES ===== */
#checkAll { cursor: pointer; }
#activateModal {
  display: none;
  align-items: center;
  justify-content: center;
}
#activateModal > div {
  font-family: Arial, sans-serif;\
  width: 60% !important;
  max-width: 70%;
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
.toggle input {
  pointer-events: none;   /* disables click */
}

.toggle {
  cursor: not-allowed;
  position: relative;
}

/* Tooltip message */
.toggle::after {
  content: "Contact Admin to change this setting";
  position: absolute;
  bottom: 120%;
  left: 50%;
  transform: translateX(-50%);
  background: #000;
  color: #fff;
  font-size: 12px;
  padding: 5px 8px;
  border-radius: 4px;
  white-space: nowrap;
  opacity: 0;
  pointer-events: none;
  transition: 0.2s;
}

/* Show message on hover */
.toggle:hover::after {
  opacity: 1;
}
</style>

<!-- ===== COMPETITION MODE MODAL ===== -->
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
<?php echo $this->notifications->display_html();?> 
	<div>
		<ul class="breadcrumb">
		   <li><a href="<?php echo SITE_URL?>school/">School</a> <span class="divider">/</span></li>
		   <li>School List</li>
		</ul>
	</div>
<form method="POST">
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
	 
<!--    -----------  ---------------    ---------------   ---------------   ---------------   ---------------   -->            
 

      <!-- <div align="right"> <button type="submit" class="btn btn-primary" id="Export" name="Export" >Export Excel</button></div>	-->
      
      <div>
          <h4 style='color:green;'>Request Admin for activate school status.</h4>
      </div>
	   <table class="table table-bordered" width="75%">
        <thead>
          <tr>
              <th>Slno</th>
              <th>School Code</th>
              
              <th>School Name</th>
              <th>School Address</th>
              <th>State</th>
               <th>City</th>
              <th>School Status</th>
              <th>View & Edit</th>
              <?php if($open == '1'){ ?>
              <th>Option</th>
              <?php } ?>
              <th>Delete</th>
              
              <th>School level activation</th>
              <th>Registration mode</th>
              <th>Competition mode</th>
          </tr>
          </thead>   
          <tbody>
           <?php  $i=1;foreach($schoolList as $value){ 
           
           
            $activeschool = $this->db->get_where('product_to_school', array(
              'school_id' => $value['id'],
              'period_id' => '16'
            ))->row();
            $isActive = !empty($activeschool);

            $pts = $this->db->get_where('product_to_school', array(
                'school_id' => $value['id'],
                'period_id' => '16'
            ))->row_array();

            $compMode  = !empty($pts['competition_mode'])   ? $pts['competition_mode']
                       : (isset($value['competition_mode']) ? $value['competition_mode'] : 'offline');

            $regMode   = !empty($pts['registration_mode'])  ? $pts['registration_mode']
                       : (isset($value['registration_mode'])? $value['registration_mode']: 'offline');

            $isOnline  = ($compMode === 'online');
            $regOnline = ($regMode  === 'online');
           
           ?>
            <tr id="school-row-<?php echo $value['id']; ?>">
                <td width="5%"><?php echo $i; ?></td>
                <td  width="10%" class="center"><?php echo $value['school_code']; ?></td>
                
                <td width="10%"><?php echo $value['school_name']; ?></td>
                <td  width="10%"><?php echo $value['school_address']."".$value['location']; ?></td>
                <td  width="10%"><?php  echo $this->db->get_where('states',array('state_subdivision_id' =>$value['state']))->row()->state_subdivision_name; ?></td>
                <td  width="10%"><?php echo $value['city']; ?></td>
                <td  width="10%"><?php echo $value['school_status']; ?></td>
                
                <?php if($open == '1'){ ?>
                    <td width="10%">
                        
                        <?php if($value['status_new'] != 'Active'){ ?>
                        
                            <a href="javascript:void(0);" class="btn btn-warning activate-btn" data-id="<?php echo $value['id']; ?>">
                                Activate For School Level
                            </a>
                        
                        <?php }else{echo 'Activated for school registration'; }?>
                        
                    </td>
                
                <?php } ?>
                
                <td><a href="<?php echo base_url();?>franchise/school/school_edit/<?php echo $value['id'];?>" class="btn btn-primary">View & Edit</a></td>
              
                <td>
                    <a onclick="return confirm('Are you sure you want to delete this school?');"  href="<?php echo base_url();?>franchise/school/schoolDelete/<?php echo $value['id'];?>" class="btn btn-danger">Delete</a>
                </td>
                <!-- ===== SCHOOL LEVEL ACTIVATION ===== -->
              <td id="activation-cell-<?php echo $value['id']; ?>">
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
              <!--<td>-->
              <!--  <div class="sw-wrap">-->
              <!--    <label class="toggle" aria-label="CIN mode for <?php //echo $value['school_name']; ?>">-->
              <!--      <input-->
              <!--          type="checkbox"-->
              <!--          <?php //echo $regOnline ? 'checked' : ''; ?>-->
              <!--          data-school-code="<?php //echo $value['school_code']; ?>"-->
              <!--          onchange="toggleCinMode(<?php //echo $value['id']; ?>, this)">-->
              <!--      <span class="slider"></span>-->
              <!--    </label>-->
              <!--    <span class="sw-lbl" id="cin-lbl-<?php //echo $value['id']; ?>">-->
              <!--      <?php //echo $regOnline ? 'Online' : 'Offline'; ?>-->
              <!--    </span>-->
              <!--  </div>-->
              <!--</td>-->

              <!-- ===== COMPETITION MODE TOGGLE ===== -->
              <!--<td>-->
              <!--  <div class="sw-wrap">-->
              <!--    <label class="toggle" aria-label="Competition mode for <?php echo $value['school_name']; ?>">-->
              <!--      <input-->
              <!--        type="checkbox"-->
              <!--        <?php //echo $isOnline ? 'checked' : ''; ?>-->
              <!--        data-school-code="<?php //echo $value['school_code']; ?>"-->
              <!--        onchange="toggleCompetitionMode(<?php //echo $value['id']; ?>, this)">-->
              <!--      <span class="slider"></span>-->
              <!--    </label>-->
              <!--    <span class="sw-lbl" id="comp-lbl-<?php //echo $value['id']; ?>">-->
              <!--      <?php //echo $isOnline ? 'Online' : 'Offline'; ?>-->
              <!--    </span>-->
              <!--  </div>-->
              <!--</td>-->
<!-- ===== CIN / REGISTRATION MODE TOGGLE ===== -->
<td>
  <div class="sw-wrap">
    <label class="toggle" aria-label="CIN mode for <?php echo $value['school_name']; ?>">
      <input
        type="checkbox"
        <?php echo $regOnline ? 'checked' : ''; ?>
        data-school-code="<?php echo $value['school_code']; ?>"
        onclick="showAdminAlert(); return false;">
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
        onclick="showAdminAlert(); return false;">
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
                
            </tr>
<?php $i++;} ?>	
</tbody>
</table>


 

 
					</div><!--End DIV for class="box-content"--> 
				</div><!--/span-->
			</div><!--/row-->
		</form>
		
		
		
	<div class="modal fade" id="bankDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="bankDetailsForm">
                    <div class="modal-header">
                      <h5 class="modal-title">Enter Bank Details</h5>
                      <!--<button type="button" class="btn-close" data-bs-dismiss="modal">X</button>-->
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="id" id="recordId">
                      <div class="mb-3">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label>Account Number</label>
                        <input type="text" name="account_number" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label>Bank Name</label>
                        <input type="text" name="bank_name" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label>IFSC Code</label>
                        <input type="text" name="ifsc_code" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label>PAN Number</label>
                        <input type="text" name="pan_number" class="form-control" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
	
		
		
<?php include('footer.php'); ?>
<?php 
	//$this->confirmation->confirm('delete');
?>



<!-- ===== ACTIVATE MODAL ===== -->
<div id="activateModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:9999; align-items:center; justify-content:center;">
  <div style="background:#fff; border-radius:10px; padding:28px 32px; box-shadow:0 8px 32px rgba(0,0,0,.18); overflow-y:auto;">
    <form id="activateForm">

      <h4 style="margin:0 0 12px; font-size:16px; color:#1a1a1a;">Select Products to Activate</h4>
      <input type="hidden" id="activate_school_id" name="school_id" value="">

      <!-- Column header row -->
      <div style="display:flex; align-items:center; margin-bottom:6px; padding:0 4px;">
        <div style="width:100%; display:flex;" class="align-items-center">
          <div style="width:50%; font-size:12px; font-weight:600; color:#555;" class="d-flex gap-2 align-items-center">
            <div><input type="checkbox" id="checkAll"></div> <div>Select All</div>
          </div>
          <div style="width:25%; font-size:12px; font-weight:600; color:#555; ">Price Code</div>
          <div style="width:25%; font-size:12px; font-weight:600; color:#555; ">Level</div>
          <div style="width:20%; font-size:12px; font-weight:600; color:#555;  margin-left:10px;display:none;">Split</div>
          <div style="width:20%; font-size:12px; font-weight:600; color:#555;  margin-left:10px;display:none;">Value</div>
        </div>
      </div>

      <div style="display:flex; align-items:flex-start; gap:10px;">

        <!-- Left: product list -->
        <div style="width:100%;">
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
        <div class="promo-right-col" style="width:25%; max-height:500px; overflow-y:auto; border-radius:6px; padding:8px; display:none; flex-direction:column; gap:4px;">
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
              <option value="">-- Select CRM % --</option>
               <?php foreach($crm_account as $val) { ?>
        	   <option value="<?php echo $val['id'] ?>" ><?php echo $val['desc']; ?></option>
        		<?php } ?>
              </select>
          <label style="font-size:11px; font-weight:600; color:#555;">CRM % <span style="color:red;">*</span></label>
          <select name="crm_per" class="chk" style="width:100%; border:1px solid #ccc; border-radius:5px; font-size:12px; color:#333;">
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
         <div style="margin-top:14px; width:25%;max-height:500px;overflow-y:auto; padding-top:10px; border-top:1px dashed #ccc;display:none;">
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
function showAdminAlert() {

}
</script>
<script>
/* ==============================================
   SCROLL TOGGLE BUTTON
   (guarded: element may not exist on every page)
   ============================================== */
(function() {
    var btn = document.getElementById("scrollToggleBtn");
    if (!btn) return;

    var icon = document.getElementById("scrollIcon");
    var goDown = true;

    btn.addEventListener("click", function () {
        if (goDown) {
            window.scrollTo({ top: document.documentElement.scrollHeight, behavior: "smooth" });
            if (icon) icon.className = "bi bi-chevron-up";
            goDown = false;
        } else {
            window.scrollTo({ top: 0, behavior: "smooth" });
            if (icon) icon.className = "bi bi-chevron-down";
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
   HELPERS
   ============================================== */
function showFlash(message, type) {
    var bg    = type === 'success' ? '#d4edda' : '#f8d7da';
    var color = type === 'success' ? '#155724' : '#721c24';
    var el    = document.getElementById('flash-message');
    if (!el) { return; }
    el.style.background = bg;
    el.style.color      = color;
    el.textContent      = message;
    el.style.display    = 'block';
    setTimeout(function(){ el.style.display = 'none'; }, 4000);
}

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
    var list  = document.getElementById('sum-list');
    var empty = document.getElementById('sum-empty-msg');
    if (!list || !empty) return;

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
            url:      "<?php echo base_url(); ?>franchise/ajax/updateCompetitionMode",
            type:     'POST',
            dataType: 'json',
            data:     { school_id: schoolId, mode: 'offline' },
            success: function(res) {
                if (res.status === 'success') {
                    var lbl = document.getElementById('comp-lbl-' + schoolId);
                    if (lbl) lbl.textContent = 'Offline';
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

    var startEl = document.getElementById('cm_start_date');
    var endEl   = document.getElementById('cm_end_date');
    if (startEl) startEl.value = '';
    if (endEl)   endEl.value   = '';

    var errEl = document.getElementById('cm_error');
    if (errEl) {
        errEl.style.display = 'none';
        errEl.textContent   = '';
    }

    var modal = document.getElementById('compModeModal');
    if (modal) modal.classList.add('show');
}

function saveCompMode() {
    var errEl     = document.getElementById('cm_error');
    var startDate = (document.getElementById('cm_start_date') || {}).value;
    var endDate   = (document.getElementById('cm_end_date') || {}).value;
    startDate = (startDate || '').trim();
    endDate   = (endDate || '').trim();

    if (errEl) errEl.style.display = 'none';

    if (!startDate || !endDate) {
        if (errEl) { errEl.textContent = 'Start date and end date are required.'; errEl.style.display = 'block'; }
        return;
    }
    if (endDate < startDate) {
        if (errEl) { errEl.textContent = 'End date cannot be before start date.'; errEl.style.display = 'block'; }
        return;
    }

    var modal = document.getElementById('compModeModal');
    if (modal) modal.classList.remove('show');

    $.ajax({
        url:      "<?php echo base_url(); ?>franchise/ajax/updateCompetitionMode",
        type:     'POST',
        dataType: 'json',
        data:     { school_id: _cm_schoolId, mode: 'online', start_date: startDate, end_date: endDate },
        success: function(res) {
            if (res.status === 'success') {
                var lbl = document.getElementById('comp-lbl-' + _cm_schoolId);
                if (lbl) lbl.textContent = 'Online';
                showFlash('Competition mode set to Online.', 'success');
            } else {
                alert('Failed to save. Please try again.');
                if (_cm_checkbox) _cm_checkbox.checked = false;
            }
        },
        error: function() {
            alert('Server error. Please try again.');
            if (_cm_checkbox) _cm_checkbox.checked = false;
        }
    });
}

function cancelCompMode() {
    if (_cm_checkbox) _cm_checkbox.checked = false;
    var modal = document.getElementById('compModeModal');
    if (modal) modal.classList.remove('show');
}

(function(){
    var el = document.getElementById('compModeModal');
    if (el) {
        el.addEventListener('click', function(e) {
            if (e.target === this) { cancelCompMode(); }
        });
    }
})();

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
            url:      "<?php echo base_url(); ?>franchise/ajax/updateCinMode",
            type:     'POST',
            dataType: 'json',
            data:     { school_id: _cin_schoolId, mode: 'offline' },
            success: function(res) {
                if (res.status === 'success') {
                    var lbl = document.getElementById('cin-lbl-' + _cin_schoolId);
                    if (lbl) lbl.textContent = 'Offline';
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

    var startEl = document.getElementById('cin_start_date');
    var endEl   = document.getElementById('cin_end_date');
    if (startEl) startEl.value = '';
    if (endEl)   endEl.value   = '';

    var errEl = document.getElementById('cin_error');
    if (errEl) {
        errEl.style.display = 'none';
        errEl.textContent   = '';
    }

    var modal = document.getElementById('cinModeModal');
    if (modal) modal.classList.add('show');
}

function saveCinMode() {
    var errEl     = document.getElementById('cin_error');
    var startDate = (document.getElementById('cin_start_date') || {}).value;
    var endDate   = (document.getElementById('cin_end_date') || {}).value;
    startDate = (startDate || '').trim();
    endDate   = (endDate || '').trim();

    if (errEl) errEl.style.display = 'none';

    if (!startDate || !endDate) {
        if (errEl) { errEl.textContent = 'Start date and end date are required.'; errEl.style.display = 'block'; }
        return;
    }
    if (endDate < startDate) {
        if (errEl) { errEl.textContent = 'End date cannot be before start date.'; errEl.style.display = 'block'; }
        return;
    }

    var modal = document.getElementById('cinModeModal');
    if (modal) modal.classList.remove('show');

    $.ajax({
        url:      "<?php echo base_url(); ?>franchise/ajax/updateCinMode",
        type:     'POST',
        dataType: 'json',
        data:     { school_id: _cin_schoolId, mode: 'online', start_date: startDate, end_date: endDate },
        success: function(res) {
            if (res.status === 'success') {
                var lbl = document.getElementById('cin-lbl-' + _cin_schoolId);
                if (lbl) lbl.textContent = 'Online';
                showFlash('CIN mode set to Online.', 'success');
            } else {
                alert('Failed to save. Please try again.');
                if (_cin_checkbox) _cin_checkbox.checked = false;
            }
        },
        error: function() {
            alert('Server error. Please try again.');
            if (_cin_checkbox) _cin_checkbox.checked = false;
        }
    });
}

function cancelCinMode() {
    if (_cin_checkbox) _cin_checkbox.checked = false;
    var modal = document.getElementById('cinModeModal');
    if (modal) modal.classList.remove('show');
}

(function(){
    var el = document.getElementById('cinModeModal');
    if (el) {
        el.addEventListener('click', function(e) {
            if (e.target === this) { cancelCinMode(); }
        });
    }
})();

/* ==============================================
   SET CIN MODE TO OFFLINE (reusable helper)
   ============================================== */
function setCinOffline(schoolId) {
    $.ajax({
        url:      "<?php echo base_url(); ?>franchise/ajax/updateCinMode",
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
        url:      "<?php echo base_url(); ?>franchise/ajax/updateCompetitionMode",
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
        url:      "<?php echo base_url(); ?>franchise/franchise/schoollevelactive/" + schoolId,
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
    var cell = document.getElementById('activation-cell-' + schoolId);
    if (!cell) return;

    if (activate) {
        cell.innerHTML = '<button type="button" class="btn btn-danger btn-deactivate" style="font-size:11px;" data-id="' + schoolId + '">Deactivate</button>';
    } else {
        cell.innerHTML = '<a href="javascript:void(0);" class="btn btn-warning btn-activate" style="font-size:11px;" data-id="' + schoolId + '">Activate</a>';
    }

    var row     = document.getElementById('school-row-' + schoolId);
    var editBtn = row ? row.querySelector('.btn-edit') : null;
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
        if (isPromo) {
            if (sel.value !== 'promotional-0') {
                sel.value = 'promotional-0';
            }
            sel.disabled = (sel !== promoSelect);
        } else {
            sel.disabled = false;
        }
    });

    var fields = document.querySelectorAll(
        'select[name="manageper"], select[name="com_peravian"], select[name="associate_per"], ' +
        'select[name="com_per"], select[name="crm_per"], input[name="free_mat_royalty"], input[name="schoolper"],select[name="competition_type"],select[name="crm"]'
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

(function(){
    var pl = document.getElementById('productList');
    if (pl) {
        pl.addEventListener('change', function(e) {
            if (e.target && e.target.id && e.target.id.startsWith('product_p_')) {
                handlePriceCodeChange();
            }
        });
    }
})();

/* ==============================================
   ACTIVATE / EDIT MODAL
   ============================================== */

// School-level "Activate" button (Option column) — fresh/blank activation
$(document).on('click', '.activate-btn', function() {
    document.querySelector('#activateModal h4').textContent = 'Select Products to Activate';
    document.getElementById('confirmActivateBtn').textContent = 'Confirm Activate';
    openActivateModal($(this).data('id'), false);
});

// "Activate" button (School level activation column) — fresh/blank activation
$(document).on('click', '.btn-activate', function() {
    document.querySelector('#activateModal h4').textContent = 'Select Products to Activate';
    document.getElementById('confirmActivateBtn').textContent = 'Confirm Activate';
    openActivateModal($(this).data('id'), false);
});

// "Edit" button — fetch & prefill saved activation data
$(document).on('click', '.btn-edit', function() {
    var schoolId = $(this).data('id');
    document.querySelector('#activateModal h4').textContent = 'Edit School Activation';
    document.getElementById('confirmActivateBtn').textContent = 'Save Changes';
    openActivateModal(schoolId, true);
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

    document.querySelectorAll('select[id^="product_l_"]').forEach(function(sel) {
        var pid = sel.id.replace('product_l_', '');
        rebuildLevelDropdown(pid, '');
    });

    document.querySelectorAll(
        'select[name="manageper"], select[name="com_peravian"], select[name="associate_per"], ' +
        'select[name="com_per"], select[name="crm_per"], input[name="free_mat_royalty"], input[name="schoolper"],select[name="competition_type"],select[name="crm"]'
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
        url:      "<?php echo base_url(); ?>franchise/franchise/getSchoolActivationData",
        type:     'POST',
        dataType: 'json',
        data:     { school_id: schoolId },
        success: function(res) {
            if (!res || res.status !== 'success') return;

            var c = res.common;

            document.querySelector('input[name="schoolper"]').value         = c.school_amount    || '';
            document.querySelector('select[name="manageper"]').value        = c.manageper        || '';
            document.querySelector('select[name="com_peravian"]').value     = c.com_peravian     || '';
            document.querySelector('select[name="competition_type"]').value = c.competition_type || '';
            document.querySelector('select[name="crm"]').value              = c.crm_id           || '';
            document.querySelector('select[name="associate_per"]').value    = c.associate_per    || '';
            document.querySelector('select[name="com_per"]').value          = c.franchise_per    || '';
            document.querySelector('select[name="crm_per"]').value          = c.crm_per          || '';
            document.querySelector('input[name="free_mat_royalty"]').value  = c.free_mat_royalty || '';

            document.querySelector('input[name="material_training_a"]').value          = c.material_training_a          || '';
            document.querySelector('input[name="material_training_a_royalty"]').value  = c.material_training_a_royalty  || '';
            document.querySelector('input[name="material_training_b"]').value          = c.material_training_b          || '';
            document.querySelector('input[name="material_training_b_royalty"]').value  = c.material_training_b_royalty  || '';

            document.querySelector('input[name="material_a_price"]').value    = c.material_a_price    || '';
            document.querySelector('input[name="material_a_royalty"]').value  = c.material_a_royalty  || '';
            document.querySelector('input[name="material_b_price"]').value    = c.material_b_price    || '';
            document.querySelector('input[name="material_b_royalty"]').value  = c.material_b_royalty  || '';

            document.querySelector('input[name="orientation_a_price"]').value = c.orientation_a_price || '';
            document.querySelector('input[name="orientation_b_price"]').value = c.orientation_b_price || '';

            document.querySelector('input[name="mocktest_a_price"]').value    = c.mocktest_a_price    || '';
            document.querySelector('input[name="mocktest_a_royalty"]').value  = c.mocktest_a_royalty  || '';
            document.querySelector('input[name="mocktest_b_price"]').value    = c.mocktest_b_price    || '';
            document.querySelector('input[name="mocktest_b_royalty"]').value  = c.mocktest_b_royalty  || '';

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

(function(){
    var el = document.getElementById('activateModal');
    if (el) {
        el.addEventListener('click', function(e) {
            if (e.target === this) { closeActivateModal(); }
        });
    }
})();

(function(){
    var checkAllEl = document.getElementById('checkAll');
    if (checkAllEl) {
        checkAllEl.addEventListener('change', function() {
            document.querySelectorAll('input[name="product_id[]"]').forEach(function(cb) {
                cb.checked = checkAllEl.checked;
            });
            refreshSummary();
        });
    }
})();

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
        url:         "<?php echo base_url(); ?>franchise/franchise/newschoollevelactive",
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
   (guarded: #state_id / #franchise may not exist on this page)
   ============================================== */
(function(){
    var stateEl = document.getElementById('state_id');
    if (stateEl) {
        $("#state_id").change(function(){
            $.ajax({
                url:  "<?php echo base_url(); ?>franchise/ajax/franchiseList",
                data: { state_id: this.value },
                type: 'post',
                success: function(result){ $("#franchise").html(result); }
            });
        });
    }

    var franchiseEl = document.getElementById('franchise');
    if (franchiseEl) {
        $("#franchise").change(function(){
            $.ajax({
                url:  "<?php echo base_url(); ?>franchise/ajax/AreaCode/",
                data: { franchise_id: this.value },
                type: 'post',
                success: function(result){ $("#area").html(result); }
            });
        });
    }
})();
</script>