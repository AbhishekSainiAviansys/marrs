<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('header.php');
// Restrict and allow classes for registration
$allowed_classes = ['Nursery', 'LKG', 'UKG'];
$is_allowed_class = in_array($student['class'], $allowed_classes);

// ============= INITIALIZE VARIABLES =============
$cin = $this->session->userdata('cin');
$period_id = isset($period_id) ? $period_id : 0;
$comp_id = isset($comp_id) ? $comp_id : 0;
$clevel = isset($clevel) ? $clevel : 0;
$product_name = isset($product_name) ? $product_name : '';
$new_id = isset($new_id) ? $new_id : 0;

// Redirect if no CIN
if(empty($cin)) {
    redirect('Cin_login/index');
}

// Get student data
$student_all_data = $this->db->get_where('cin_list', array('cin' => $cin))->row();

// Get level info
$level_info = $this->db->get_where('competition_level_byproduct', 
    array('medal_no' => 4, 'product_name' => $product_name))->row();
$nlev = isset($level_info->level_name) ? $level_info->level_name : 'Championship';
$level_id = isset($level_info->level_id) ? $level_info->level_id : 0;

// Get current result
$current_result = $this->db->where('cin', $cin)->order_by('id', 'DESC')->limit(1)->get('cin_result')->row_array();
if(empty($current_result)) {
    $current_result = array('grade' => '-', 'rank' => '', 'speller' => '-', 'performer' => '-', 'status' => '-', 'clevel' => 0);
}

// Get current competition level
$current_complevel = $this->db->get_where('competition_level_byproduct', 
    array('level_id' => $current_result['clevel']))->row();

// Calculate dates
$close_date_obj = $this->db->get_where('new_cart', 
    array('period_id' => $period_id, 'cin' => $cin, 'comp_date !=' => ''))->row();
$close_date = (!empty($close_date_obj->comp_date)) ? $close_date_obj->comp_date : 
    (isset($activate[0]['close_date']) ? $activate[0]['close_date'] : date('Y-m-d'));

$today = date('Y-m-d');
$one_day_before = date('Y-m-d', strtotime($close_date . ' -1 day'));
$three_days_before = date('Y-m-d', strtotime($close_date . ' -3 days'));

// Check if can purchase
$can_purchase = ($one_day_before >= $today);

// Get all active competitions
$competitions = isset($activate) ? $activate : array();

// Get purchased products from new_cart (PAID PRODUCTS)
$purchased_products = $this->db->where('cin', $cin)
    ->where('status', 'Paid')
    ->get('new_cart')->result_array();

// Helper function to check if product is purchased
$is_product_purchased = function($search_name) use ($purchased_products) {
    foreach($purchased_products as $purchased) {
        if(isset($purchased['product_name']) && $purchased['product_name'] === $search_name) {
            return true;
        }
    }
    return false;
};

// Get result status
$result = isset($result) ? $result : array('status' => 'Q');

// ============= DEFINE HELPER FUNCTION =============
if (!function_exists('getMock')) {
    function getMock($type, $pay_status, $product_name, $period_id, $student, $db){
        $db->select('mock_papers.paper_id, assigned_mock.period_id');
        $db->from('mock_papers');
        $db->join('assigned_mock', 'assigned_mock.mat_id=mock_papers.paper_id');
        $db->where('mock_papers.clevel', 13);
        $db->where('mock_papers.pay_status', $pay_status);
        $db->where('mock_papers.type', $type);
        $db->where('mock_papers.product_name', $product_name);
        $db->where('mock_papers.class', $student['class']);
        $db->where('assigned_mock.period_id', $period_id);
        $result = $db->get()->row();
        $db->reset_query(); // Reset query builder
        return $result;
    }
}

// Get cart items and calculate total
$this->db->where('cin', $cin);
$this->db->where_in('comp_id', ['512','515','516','517']);
$this->db->like('product_name', 'Primary');
$cart_items = $this->db->get('amount_cart')->result_array();

$cart_total = 0;
foreach($cart_items as $item) {
    $cart_total += $item['amount'];
}

?>

<style>
    /* ========== ROOT STYLES ========== */
    :root {
        --primary-color: #f26522;
        --primary-dark: #e05a1a;
        --primary-light: #ff8c42;
        --success-color: #4caf50;
        --danger-color: #dc3545;
        --warning-color: #ffc107;
        --info-color: #1e88e5;
        --light-bg: #fafafa;
        --border-color: #e0e0e0;
        --text-primary: #333;
        --text-secondary: #999;
    }

    * {
        box-sizing: border-box;
    }

    /* ========== HEADER SECTION ========== */
    .header-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 8px 24px rgba(242, 101, 34, 0.2);
        position: relative;
        overflow: hidden;
    }

    .header-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }

    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        position: relative;
        z-index: 1;
        max-width: 1400px;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .btn-back:hover {
        background: white;
        color: var(--primary-color);
        border-color: white;
        transform: translateX(-3px);
    }

    .academic-year {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 13px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .header-title {
        text-align: center;
        color: white;
        max-width: 1400px;
        margin-left: auto;
        margin-right: auto;
        position: relative;
        z-index: 1;
    }

    .header-title h1 {
        font-size: 42px;
        font-weight: 900;
        margin-bottom: 8px;
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        letter-spacing: -0.5px;
    }

    .header-title h2 {
        font-size: 22px;
        font-weight: 600;
        letter-spacing: 1px;
        opacity: 0.95;
    }

    .trophy-icon {
        margin-right: 12px;
        color: #ffd700;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }

    /* ========== RESULT CARDS ========== */
    .results-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 25px;
        max-width: 1400px;
        margin-left: auto;
        margin-right: auto;
    }

    .result-card {
        background: white;
        border-radius: 12px;
        padding: 22px 16px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border-top: 4px solid var(--primary-color);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .result-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.6s ease;
    }

    .result-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(242, 101, 34, 0.15);
    }

    .result-card:hover::after {
        left: 100%;
    }

    .result-card-label {
        font-size: 11px;
        font-weight: 800;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }

    .result-card-value {
        font-size: 20px;
        font-weight: 900;
        color: var(--primary-color);
        line-height: 1.2;
        word-break: break-word;
        position: relative;
        z-index: 1;
    }

    /* ========== MAIN CONTENT SECTION ========== */
    .main-content {
        max-width: 1400px;
        margin: 30px auto;
        padding: 0 20px;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 25px;
    }

    /* ========== SUBJECT TABS (HORIZONTAL) ========== */
    .subject-tabs-container {
        background: white;
        border-radius: 12px 12px 0 0;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .subject-tabs {
        display: flex;
        gap: 0;
        border-bottom: 3px solid var(--border-color);
        padding: 0;
        margin: 0;
        flex-wrap: wrap;
        background: var(--light-bg);
    }

    .subject-tab {
        flex: 1;
        min-width: 120px;
        background: transparent;
        border: none;
        padding: 14px 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        color: var(--text-primary);
        font-size: 15px;
        border-bottom: 3px solid transparent;
        margin-bottom: -3px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        position: relative;
    }

    .subject-tab:hover {
        background: rgba(242, 101, 34, 0.05);
        color: var(--primary-color);
    }

    .subject-tab.active {
        background: white;
        color: var(--primary-color);
        border-bottom-color: var(--primary-color);
        font-weight: 700;
        font-size: 16px;
    }

    .subject-tab i {
        font-size: 20px;
    }

    /* ========== MAIN LAYOUT (TAB + SIDEBAR) ========== */
    .subject-content {
        display: flex;
        background: white;
        border-radius: 0 0 12px 12px;
        overflow: hidden;
        min-height: 600px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    /* ========== PRODUCT SIDEBAR ========== */
    .product-sidebar {
        width: 200px;
        background: var(--light-bg);
        border-right: 2px solid var(--primary-color);
        overflow-y: auto;
        flex-shrink: 0;
    }

    .product-sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .product-sidebar::-webkit-scrollbar-track {
        background: transparent;
    }

    .product-sidebar::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 3px;
    }

    .product-tab {
        width: 100%;
        background: white;
        border: none;
        border-left: 4px solid transparent;
        padding: 12px 14px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s ease;
        color: var(--text-primary);
        font-weight: 500;
        text-align: left;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 0;
    }

    .product-tab:hover {
        background: #f0f0f0;
        border-left-color: var(--primary-color);
        color: var(--primary-color);
    }

    .product-tab.active {
        background: linear-gradient(90deg, #fff3e0 0%, white 100%);
        border-left-color: var(--primary-color);
        color: var(--primary-color);
        font-weight: 600;
    }

    .product-tab i {
        font-size: 14px;
        width: 16px;
    }

    /* ========== PRODUCTS CONTENT AREA ========== */
    .products-content {
        flex: 1;
        padding: 25px;
        overflow-y: auto;
        background: white;
    }

    .products-content::-webkit-scrollbar {
        width: 6px;
    }

    .products-content::-webkit-scrollbar-track {
        background: transparent;
    }

    .products-content::-webkit-scrollbar-thumb {
        background: var(--border-color);
        border-radius: 3px;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 18px;
    }

    /* ========== PRODUCT CARD ========== */
    .product-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        border: 1px solid var(--border-color);
    }

    .product-card:hover {
        box-shadow: 0 8px 20px rgba(242, 101, 34, 0.15);
        transform: translateY(-4px);
        border-color: var(--primary-color);
    }

    .product-card-img {
        height: 90px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f5f5f5 0%, #eeeeee 100%);
        border-bottom: 1px solid var(--border-color);
    }

    .product-card-img img {
        max-width: 60px;
        max-height: 60px;
    }

    .product-card-body {
        padding: 16px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-card-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 6px;
        line-height: 1.3;
        min-height: 28px;
    }

    .product-card-price {
        font-size: 18px;
        color: var(--primary-color);
        font-weight: 800;
        margin-bottom: 6px;
    }

    .product-card-status {
        font-size: 12px;
        color: var(--text-secondary);
        min-height: 16px;
    }

    .product-card-footer {
        display: flex;
        padding: 0.5rem;
        gap: 6px;
        margin-top: auto;
        padding-top: 12px;
        border-top: 1px solid var(--border-color);
    }

    .btn-action {
        flex: 1;
        border: none;
        padding: 9px 10px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 11px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        white-space: nowrap;
    }

    .btn-add {
        background: var(--primary-color);
        color: white;
    }

    .btn-add:hover {
        background: var(--primary-dark);
        transform: scale(1.02);
    }

    .btn-remove {
        background: var(--danger-color);
        color: white;
    }

    .btn-remove:hover {
        background: #c82333;
    }

    .btn-download {
        background: var(--info-color);
        color: white;
    }

    .btn-download:hover {
        background: #1565c0;
    }

    .btn-disabled {
        background: #ccc;
        color: white;
        cursor: not-allowed;
        opacity: 0.6;
    }

    .badge-closed {
        background: var(--danger-color);
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        color: var(--text-secondary);
        font-size: 15px;
    }

    .empty-state i {
        font-size: 48px;
        color: #ddd;
        margin-bottom: 12px;
        display: block;
    }

    /* ========== CART SECTION ========== */
    .cart-container {
        background: white;
        border: 2px solid var(--primary-color);
        border-radius: 12px;
        padding: 0;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        position: sticky;
        top: 20px;
        max-height: calc(100vh - 40px);
        display: flex;
        flex-direction: column;
    }

    .cart-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: white;
        padding: 14px 16px;
        font-weight: 700;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cart-items {
        flex: 1;
        overflow-y: auto;
        padding: 12px;
        min-height: 150px;
    }

    .cart-items::-webkit-scrollbar {
        width: 4px;
    }

    .cart-items::-webkit-scrollbar-track {
        background: transparent;
    }

    .cart-items::-webkit-scrollbar-thumb {
        background: var(--border-color);
        border-radius: 2px;
    }

    .cart-empty {
        text-align: center;
        color: var(--text-secondary);
        padding: 20px;
        font-size: 13px;
    }

    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid var(--border-color);
        font-size: 12px;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item-name {
        color: var(--text-primary);
        font-weight: 500;
        flex: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .cart-item-price {
        color: var(--primary-color);
        font-weight: 700;
        margin-left: 8px;
        white-space: nowrap;
    }

    .cart-summary {
        padding: 14px;
        border-top: 2px solid var(--border-color);
    }

    .cart-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .cart-total-label {
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 12px;
    }

    .cart-total-amount {
        color: var(--primary-color);
        font-size: 22px;
        font-weight: 900;
    }

    .btn-checkout {
        width: 100%;
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        font-size: 13px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-checkout:hover:not(:disabled) {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(242, 101, 34, 0.3);
    }

    .btn-checkout:disabled {
        background: #ccc;
        cursor: not-allowed;
        opacity: 0.7;
    }

    /* ========== ALERTS ========== */
    .custom-alert {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        border-left: 5px solid var(--primary-color);
        padding: 24px;
        border-radius: 10px;
        z-index: 1000;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        min-width: 320px;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translate(-50%, -60%);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%);
        }
    }

    .custom-alert p {
        margin: 0;
        color: var(--text-primary);
        font-weight: 500;
        font-size: 14px;
    }

    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
        backdrop-filter: blur(2px);
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 1024px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        }

        .product-sidebar {
            width: 160px;
        }

        .content-grid {
            grid-template-columns: 1fr;
        }

        .cart-container {
            position: static;
            max-height: none;
            margin-top: 20px;
        }
    }

    @media (max-width: 768px) {
        .header-title h1 {
            font-size: 28px;
        }

        .header-title h2 {
            font-size: 16px;
        }

        .subject-content {
            flex-direction: column;
            min-height: auto;
        }

        .product-sidebar {
            width: 100%;
            border-right: none;
            border-bottom: 2px solid var(--primary-color);
            display: flex;
            overflow-x: auto;
            overflow-y: visible;
            max-height: 70px;
        }

        .product-tab {
            border-left: none;
            border-bottom: 4px solid transparent;
            padding: 10px 14px;
            min-width: 100px;
        }

        .product-tab.active {
            border-left: none;
            border-bottom-color: var(--primary-color);
        }

        .products-content {
            padding: 16px;
        }

        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 12px;
        }

        .results-container {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 480px) {
        .header-section {
            padding: 25px 15px;
        }

        .header-top {
            flex-direction: column;
            gap: 10px;
        }

        .btn-back,
        .academic-year {
            width: 100%;
            text-align: center;
        }

        .header-title h1 {
            font-size: 22px;
            margin-bottom: 6px;
        }

        .header-title h2 {
            font-size: 14px;
        }

        .products-grid {
            grid-template-columns: 1fr;
        }

        .results-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .result-card {
            padding: 14px 10px;
            font-size: 12px;
        }

        .result-card-value {
            font-size: 16px;
        }

        .subject-tab {
            min-width: 80px;
            padding: 10px 12px;
            font-size: 12px;
        }

        .cart-container {
            margin-top: 15px;
        }
    }
</style>
<style>
/* Blinking animation */
@keyframes borderBlink {
    0%, 100% { box-shadow: 0 0 0px blue; }
    50% { box-shadow: 0 0 15px blue; }
}

.blink-border {
    animation: borderBlink 1s infinite;
    transition: box-shadow 0.3s ease-in-out;
}
</style>
<style>
.marquee {
  overflow: hidden;
  white-space: nowrap;
  font-weight: bold;
  animation: move 15s linear infinite;
}

.marquee span {
  color: white;
}

@keyframes move {
  from { transform: translateX(100%); }
  to   { transform: translateX(-100%); }
}
</style>
<!-- STYLE -->
<style>
.custom-popup {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(4px);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}

.popup-box {
    background: #ffffff;
    padding: 30px 25px;
    border-radius: 16px;
    width: 320px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    animation: popupFade 0.3s ease;
}

.popup-icon {
    font-size: 40px;
    color: #ff9800;
    margin-bottom: 10px;
}

.popup-box h3 {
    margin: 10px 0;
    font-size: 20px;
    color: #333;
}

.popup-box p {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
    line-height: 1.5;
}

.popup-btn {
    background: linear-gradient(135deg, #ff9800, #ff5722);
    border: none;
    color: #fff;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
    transition: 0.3s;
}

.popup-btn:hover {
    transform: scale(1.05);
    opacity: 0.9;
}

@keyframes popupFade {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>
<!-- ========== HEADER SECTION ========== -->
<section class="header-section">
     <a href=""><div class="marquee">
  🚨 <span>Attention! MaRRS Primary Colors International Champtionship-Registration Going On. Closeing Date:</span> 26-04-2026 🚨
</div></a>
    <div class="header-top">
        <a href="<?php echo base_url();?>Cin_login/index" class="btn-back">
            <i class="fa-solid fa-chevron-left"></i>BACK
        </a>
        <div class="academic-year">
            <?php 
            $reos = $this->db->get_where('period', array('period_id' => $period_id))->row();
            echo isset($reos->academic_year) ? htmlspecialchars($reos->academic_year) : 'N/A'; 
            ?>
        </div>
    </div>
<div class="d-flex justify-content-end">
    <a href="https://marrs.in/franchiselogin/uploads/primary_colors_2024-25-circular-combined_1775121816.pdf" 
       target="_blank"
       class="btn blink-border btn-warning"
       style="position: relative; ">
        Download Circular
    </a>
</div>
    <div class="header-title">
        <h1>
            <i class="fa-solid fa-trophy trophy-icon"></i>MaRRS Primary Colours International
        </h1>
        <h2><?php echo isset($current_complevel->level_name) ? htmlspecialchars($current_complevel->level_name) : 'Championship'; ?></h2>
    </div>

    <div class="results-container">
        <div class="result-card">
            <div class="result-card-label">
                <i class="fa-solid fa-user"></i> Name
            </div>
            <div class="result-card-value">
                <?php echo htmlspecialchars($current_result['student_name'] ?? $student['student_name'] ?? '-'); ?>
            </div>
        </div>

        <div class="result-card">
            <div class="result-card-label">
                <i class="fa-solid fa-id-card"></i> CIN
            </div>
            <div class="result-card-value">
                <?php echo htmlspecialchars($cin); ?>
            </div>
        </div>

        <div class="result-card">
            <div class="result-card-label">
                <i class="fa-solid fa-star"></i> Grade
            </div>
            <div class="result-card-value">
                <?php echo htmlspecialchars($current_result['grade'] ?? '-'); ?>
            </div>
        </div>

        <div class="result-card">
            <div class="result-card-label">
                <i class="fa-solid fa-medal"></i> Rank
            </div>
            <div class="result-card-value">
                <?php echo ($current_result['rank'] ?? '') ? '#' . htmlspecialchars($current_result['rank']) : 'N/A'; ?>
            </div>
        </div>

        <div class="result-card">
            <div class="result-card-label">
                <i class="fa-solid fa-circle-info"></i> Status
            </div>
            <div class="result-card-value">
                <?php echo htmlspecialchars($current_result['status'] ?? '-'); ?>
            </div>
        </div>
    </div>
</section>

<!-- ========== MAIN CONTENT ========== -->
<div class="main-content">
    <?php if($current_result['status'] == 'Q' || $current_result['status'] == ''): ?>

    <div class="content-grid">
        <!-- LEFT: PRODUCTS -->
        <div>
            <!-- Subject Tabs Container -->
            <div class="subject-tabs-container">
                <div class="subject-tabs" id="subject-tabs">
                    <button class="subject-tab active" onclick="switchSubject(event, 0)">
                        <i class="fa-solid fa-book-open"></i>English
                    </button>
                    <button class="subject-tab" onclick="switchSubject(event, 1)">
                        <i class="fa-solid fa-calculator"></i>Mathematics
                    </button>
                    <button class="subject-tab" onclick="switchSubject(event, 2)">
                        <i class="fa-solid fa-flask"></i>Science
                    </button>
                    <button class="subject-tab" onclick="switchSubject(event, 3)">
                        <i class="fa-solid fa-globe"></i>Humanities
                    </button>
                </div>
            </div>

            <!-- Subject Contents -->
            <?php 
            $subjects = array(
                array('name' => 'English', 'filter' => 'English', 'icon' => 'fa-book-open'),
                array('name' => 'Mathematics', 'filter' => 'Math', 'icon' => 'fa-calculator'),
                array('name' => 'Science', 'filter' => 'Science', 'icon' => 'fa-flask'),
                array('name' => 'Humanities', 'filter' => 'Humanities', 'icon' => 'fa-globe')
            );
            $subjectIndex = 0;
            foreach($subjects as $subject):
            ?>
            <div class="subject-content" id="subject-<?php echo $subjectIndex; ?>" style="display: <?php echo $subjectIndex == 0 ? 'flex' : 'none'; ?>;">
                
                <!-- Vertical Sidebar -->
                <div class="product-sidebar">
                    <button class="product-tab active" onclick="switchProductType(event, <?php echo $subjectIndex; ?>, 'competition')">
                        <i class="fa-solid fa-trophy"></i>
                        <?php echo $subject['name']; ?> Competition
                    </button>
                
                    <button class="product-tab" onclick="switchProductType(event, <?php echo $subjectIndex; ?>, 'free-material')">
                        <i class="fa-solid fa-book"></i>
                        <?php echo $subject['name']; ?> Free Study Material
                    </button>
                
                    <button class="product-tab" onclick="switchProductType(event, <?php echo $subjectIndex; ?>, 'paid-material')">
                        <i class="fa-solid fa-book"></i>
                        <?php echo $subject['name']; ?> Paid Study Material
                    </button>
                
                    <button class="product-tab" onclick="switchProductType(event, <?php echo $subjectIndex; ?>, 'training')">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <?php echo $subject['name']; ?> Training
                    </button>
                
                    <button class="product-tab" onclick="switchProductType(event, <?php echo $subjectIndex; ?>, 'mock')">
                        <i class="fa-solid fa-file-lines"></i>
                        <?php echo $subject['name']; ?> Mock Test
                    </button>
                   
                </div>

                <!-- Products Content -->
                <div class="products-content">
                    
                    <!-- COMPETITION PRODUCTS -->
                    <div id="competition-<?php echo $subjectIndex; ?>" class="product-type-content">
                        <div class="products-grid">
                            <?php 
                            $competition_products = array_filter($competitions, function($prod) use ($subject) {
                                return isset($prod['product_name']) && strpos($prod['product_name'], $subject['filter']) !== false;
                            });

                            if(!empty($competition_products)):
                                foreach($competition_products as $product):
                                    $is_purchased = $is_product_purchased($product['product_name']);
                                    $comp_id = $product['comp_id'];  
                                    $center = $this->db->get_where('exam_centers',array('comp_id'=>$comp_id))->result_array();
                                    $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$comp_id))->result_array();
                                    $date_close='';
                                    
                                    if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                                        $date_close=$center[0]['exam_date'];
                                    }
                                    if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                                        $date_close=$center1[0]['exam_date'];
                                    }
                                    if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                                        $date_close=$activate[0]['close_date'];
                                    }
                                    
                                    $sevenDaysBefore = date("Y-m-d", strtotime($date_close . " -7 days")); 
                                    $one_days_before = date("Y-m-d", strtotime($date_close . " -1 days")); 
                                    $three_days_before = date("Y-m-d", strtotime($date_close . " -3 days"));
                                    $today = date("Y-m-d");
                                    ?>
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            <img src="https://img.icons8.com/bubbles/100/000000/trophy.png" alt="Competition" class="img-fluid d-block mx-auto w-50">
                                        </div>
                                        <div class="product-card-body">
                                            <div class="product-card-title"><?php echo htmlspecialchars($product['product_name']); ?></div>
                                            <div class="product-card-price">₹ <?php echo number_format($product['product_price']); ?></div>
                                            <div class="product-card-status">
                                                <?php
                                                $today_ts            = strtotime($today);
                                                $last_date_ts        = strtotime($one_days_before);
                                                $seven_days_ts       = strtotime($sevenDaysBefore);
                                                $exam_date_ts        = strtotime($date_close);
                                                $three_days_before_ts   = strtotime($three_days_before);
                                                
                                                if ($is_purchased == 1) {
                                                    echo '<span style="color: #26a69a; font-weight: 600;">✓ Purchased</span><br>';
                                                    echo '<span style="color: #2196f3;">Exam Date : ' . date('M d', $exam_date_ts) . '</span>';
                                                } elseif ($today_ts <= $last_date_ts) {
                                                    if ($today_ts >= $seven_days_ts) {
                                                        echo '<span style="color: #ff9800; font-weight: 600;">⚡ Hurry! Last days to register</span>';
                                                    } else {
                                                        echo '<span style="color: #26a69a;">Registration Open</span>';
                                                    }
                                                } else {
                                                    echo '<span style="color: #dc3545;">Registration Closed</span>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        
                                        <div class="product-card-footer">
                                        <?php 
                                        if ($is_purchased == 1) {
                                            if (!empty($date_close) && $today >= date('Y-m-d', strtotime($date_close . ' -3 days')) && $today <= $date_close) {
                                                
                                                
                                                ?>
                                                                                 <?php if ($student['class'] != 'Class-1') { ?>
                                        <form action="<?= base_url('cin_login/api_calladmit_card') ?>" method="POST">
                                            <input type="hidden" name="product_name" value="<?= $product['product_name']; ?>">
                                            <input type="hidden" name="level" value="<?= $clevel; ?>">
                                    
                                            <button type="submit" class="btn-action btn-download">
                                                <i class="fa-solid fa-download"></i> Admit Card
                                            </button>
                                        </form>
                                    <?php } ?>
                                                <?php
                                            } else {
                                                ?>
                                                <button class="btn-action btn-disabled">
                                                    <i class="fa-solid fa-clock"></i> Admit Card
                                                </button>
                                                <?php
                                            }
                                        } else {
                                            if ( $one_days_before >= $today) {
                                                ?>
                                                <?php if($is_allowed_class): ?>
                                                <button class="btn-action btn-add" onclick="addToCart('<?php echo $product['product_price']."+".htmlspecialchars($product['product_name'])."+".($product['comp_id'] ?? 0); ?>')">
                                                    <i class="fa-solid fa-cart-plus"></i> Add
                                                </button>
                                                <button class="btn-action btn-remove" onclick="removeFromCart('<?php echo $product['product_price']."+".htmlspecialchars($product['product_name'])."+".($product['comp_id'] ?? 0); ?>')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <?php else: ?>
                                                    <button class="btn-action btn-disabled" onclick="showClassRestrictionPopup()">
                                                        <i class="fa-solid fa-ban"></i> Not Allowed
                                                    </button>
                                                <?php endif; ?>
                                                
                                                <?php
                                            } else {
                                                ?>
                                                <div class="badge-closed">Registration Closed</div>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </div>
                                    </div>
                                    <?php 
                                endforeach;
                            else:
                                ?>
                                <div class="empty-state">
                                    <i class="fa-solid fa-inbox"></i>
                                    No competitions available
                                </div>
                                <?php 
                            endif; 
                            ?>
                        </div>
                    </div>

                    <!-- FREE MATERIALS -->
                    <div id="free-material-<?php echo $subjectIndex; ?>" class="product-type-content" style="display: none;">
                        <div class="products-grid">
                            <?php 
                            $competition_products = array_filter($competitions, function($prod) use ($subject) {
                                if (!isset($prod['product_name'])) return false;
                                $product = strtolower($prod['product_name']);
                                $subjectFilter = strtolower(trim($subject['filter']));
                                return preg_match('/\b'.preg_quote($subjectFilter, '/').'\b/', $product);
                            });
                        
                            foreach ($competition_products as $product){
                                $comp_id      = $product['comp_id'];
                                $product_name = $product['product_name'];
                                $period_id    = $product['period_id'];
                                $excluded_ids = ['511', '510', '509', '508'];
                                
                                // Get all material types
                                $materials = [];
                                for ($i = 0; $i < 6; $i++) {
                                    $type = chr(65 + $i); // A, B, C, D, E, F
                                    $this->db->select('study_material.*');
                                    $this->db->from('study_material');
                                    $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                                    $this->db->where(['study_material.clevel' => 13, 'study_material.status' => 'Free', 'study_material.type' => $type, 'study_material.product_name' => $product_name, 'class' => $student['class']]);
                                    if(!in_array($comp_id, $excluded_ids)) { $this->db->where('assigned_materials.period_id', $period_id); }
                                    $materials[$type] = $this->db->get()->row();
                                }
                                
                                if ($is_product_purchased($product_name)) {
                                    foreach ($materials as $type => $mat) {
                                        if($mat){
                                            ?>
                                            <div class="product-card">
                                                <div class="product-card-img">
                                                    <img src="https://img.icons8.com/bubbles/100/000000/book.png" alt="Material" class="img-fluid d-block mx-auto w-50">
                                                </div>
                                                <div class="product-card-body">
                                                    <div class="product-card-title">
                                                        Study Material <?php echo htmlspecialchars($product_name).'<br>Material - '.$type; ?> - Free
                                                    </div>
                                                    <div class="product-card-price">₹ 0</div>
                                                    <div class="product-card-status">
                                                        Available for Download
                                                    </div>
                                                </div>
                                                <div class="product-card-footer">
                                                    <a href="<?= base_url('cin_login/primary_colors_free_mat_download/'.$mat->id) ?>" 
                                                       class="btn-action btn-download">
                                                        <i class="fa-solid fa-download"></i> Download
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                } else {
                                    echo '<div class="empty-state">Purchase Competition To Access Free Material.</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- PAID MATERIALS - SIMPLIFIED -->
                    <div id="paid-material-<?php echo $subjectIndex; ?>" class="product-type-content" style="display: none;">
                        <div class="products-grid">
                            <?php 
                            $competition_products = array_filter($competitions, function($prod) use ($subject) {
                                return isset($prod['product_name']) && strpos($prod['product_name'], $subject['filter']) !== false;
                            });
                        
                            foreach ($competition_products as $product){
                                $comp_id      = $product['comp_id'];
                                $product_name = $product['product_name'];
                                $period_id    = $product['period_id'];
                                $excluded_ids = ['511', '510', '509', '508'];
                                $hasMaterial = false;
                                
                                for ($i = 0; $i < 6; $i++) {
                                    $type = chr(65 + $i); // A, B, C, D, E, F
                                    $mat_key = 'study_material_'.strtolower($type);
                                    $price_key = $mat_key.'_price';
                                    
                                    if(!isset($product[$mat_key]) || $product[$mat_key] != $mat_key) continue;
                                    
                                    $this->db->select('study_material.*');
                                    $this->db->from('study_material');
                                    $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                                    $this->db->where(['study_material.clevel' => 13, 'study_material.status' => 'Paid', 'study_material.type' => $type, 'study_material.product_name' => $product_name, 'class' => $student['class']]);
                                    if(!in_array($comp_id, $excluded_ids)) { $this->db->where('assigned_materials.period_id', $period_id); }
                                    $mat = $this->db->get()->row();
                                    
                                    if($mat){
                                        $hasMaterial = true;
                                        $res = $this->db->get_where('new_cart',[
                                            'comp_id'=> $comp_id,
                                            'clevel' =>13,
                                            $mat_key=>'Yes',
                                            'cin'=>$cin
                                        ])->row();
                                        ?>
                                        <div class="product-card">
                                            <div class="product-card-img">
                                                <img src="https://img.icons8.com/bubbles/100/000000/book.png" alt="Material" class="img-fluid d-block mx-auto w-50">
                                            </div>
                                            <div class="product-card-body">
                                                <div class="product-card-title">
                                                    Study Material <?php echo htmlspecialchars($product_name).'<br>Material - '.$type; ?> - Paid
                                                </div>
                                                <div class="product-card-price">₹ <?php echo isset($product[$price_key]) ? $product[$price_key] : '0'; ?></div>
                                                <div class="product-card-status">
                                                    Available for Download
                                                </div>
                                            </div>
                                            
                                            <?php if(empty($res)){ ?>
                                                <div class="product-card-footer">
                                                    <button class="btn-action btn-add" onclick="misb(this.id);">
                                                        <i class="fa-solid fa-cart-plus"></i> Add
                                                    </button>
                                                    <button class="btn-action btn-remove" onclick="remove_misb(this.id);">
                                                        <i class="fa-solid fa-trash-can"></i> Remove
                                                    </button>
                                                </div>
                                            <?php } else { ?>
                                                <div class="product-card-footer">
                                                    <button class="btn-action btn-download"
                                                        onclick="downloadFreeMaterial('<?php echo $mat->id; ?>')">
                                                        <i class="fa-solid fa-download"></i> Download
                                                    </button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php
                                    }
                                }
                                
                                if(!$hasMaterial){
                                    ?>
                                    <div class="empty-state">
                                        <i class="fa-solid fa-inbox"></i>
                                        Not Applicable Primary Colors International
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- TRAINING -->
                    <div id="training-<?php echo $subjectIndex; ?>" class="product-type-content" style="display: none;">
                        <div class="products-grid">
                            <?php 
                            if(isset($activate[0]['orientation_a_price']) && $activate[0]['orientation_a_price'] > 0):
                            ?>
                            <div class="product-card">
                                <div class="product-card-img">
                                    <img src="https://img.icons8.com/bubbles/100/000000/graduation-cap.png" alt="Training" class="img-fluid d-block mx-auto w-50">
                                </div>
                                <div class="product-card-body">
                                    <div class="product-card-title">Training A - Paid</div>
                                    <div class="product-card-price">₹ <?php echo number_format($activate[0]['orientation_a_price']); ?></div>
                                    <div class="product-card-status"><?php echo $can_purchase ? 'Available' : 'Closed'; ?></div>
                                </div>
                                <div class="product-card-footer">
                                    <?php if($can_purchase): ?>
                                    <button class="btn-action btn-add" onclick="addToCart('<?php echo $activate[0]['orientation_a_price']."+Orientation A"; ?>')">
                                        <i class="fa-solid fa-cart-plus"></i>Add
                                    </button>
                                    <button class="btn-action btn-remove" onclick="removeFromCart('<?php echo $activate[0]['orientation_a_price']."+Orientation A"; ?>')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <?php else: ?>
                                    <button class="btn-action btn-disabled" disabled>
                                        <i class="fa-solid fa-lock"></i>Closed
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php 
                            else:
                            ?>
                            <div class="empty-state">
                                <i class="fa-solid fa-inbox"></i>
                                Training registration will be available soon.
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- MOCK TESTS -->
                    <div id="mock-<?php echo $subjectIndex; ?>" class="product-type-content" style="display: none;">
                        <div class="products-grid">
                            <?php 
                            $competition_products = array_filter($competitions, function($prod) use ($subject) {
                                return isset($prod['product_name']) && strpos($prod['product_name'], $subject['filter']) !== false;
                            });

                            foreach ($competition_products as $product){
                                $product_name = $product['product_name'];
                                $period_id    = $product['period_id'];
                                $hasMaterial = false;

                                for ($i = 0; $i < 6; $i++) {
                                    $type = chr(65 + $i); // A, B, C, D, E, F
                                    $mock_key = 'mock_test_'.strtolower($type);
                                    
                                    if(!isset($product[$mock_key]) || $product[$mock_key] != $mock_key) continue;

                                    /* FREE MOCK */
                                    $mock_free = getMock($type, 'Free', $product_name, $period_id, $student, $this->db);
                                    if($mock_free){
                                        $hasMaterial = true;
                                        ?>
                                        <div class="product-card">
                                            <div class="product-card-img">
                                                <img src="https://img.icons8.com/bubbles/100/000000/book.png" alt="Mock" class="img-fluid d-block mx-auto w-50">
                                            </div>
                                            <div class="product-card-body">
                                                <div class="product-card-title">
                                                    Mock Test <?php echo htmlspecialchars($product_name).' - '.$type; ?> (Free)
                                                </div>
                                                <div class="product-card-price">₹ 0</div>
                                                <div class="product-card-status">Available</div>
                                            </div>
                                            <div class="product-card-footer">
                                                <button class="btn-action btn-download"
                                                    onclick="downloadFreeMaterial('<?php echo htmlspecialchars($mock_free->paper_id); ?>')">
                                                    <i class="fa-solid fa-download"></i> Download
                                                </button>
                                            </div>
                                        </div>
                                        <?php 
                                    }

                                    /* PAID MOCK */
                                    $mock_paid = getMock($type, 'Paid', $product_name, $period_id, $student, $this->db);
                                    if($mock_paid){
                                        $hasMaterial = true;
                                        $price_key = $mock_key.'_price';
                                        $res = $this->db->get_where('new_cart',[
                                            'comp_id'=> $product['comp_id'],
                                            'clevel'=>13,
                                            $mock_key => 'Yes',
                                            'cin'=>$cin
                                        ])->row();
                                        ?>
                                        <div class="product-card">
                                            <div class="product-card-img">
                                                <img src="https://img.icons8.com/bubbles/100/000000/book.png" alt="Mock" class="img-fluid d-block mx-auto w-50">
                                            </div>
                                            <div class="product-card-body">
                                                <div class="product-card-title">
                                                    Mock Test <?php echo htmlspecialchars($product_name).' - '.$type; ?> (Paid)
                                                </div>
                                                <div class="product-card-price">
                                                    ₹ <?php echo isset($product[$price_key]) ? number_format($product[$price_key]) : '0'; ?>
                                                </div>
                                                <div class="product-card-status">Available</div>
                                            </div>
                                            <?php if(empty($res)){ ?>
                                                <div class="product-card-footer">
                                                    <button class="btn-action btn-add" onclick="misb(this.id);">
                                                        <i class="fa-solid fa-cart-plus"></i> Add
                                                    </button>
                                                    <button class="btn-action btn-remove" onclick="remove_misb(this.id);">
                                                        <i class="fa-solid fa-trash-can"></i> Remove
                                                    </button>
                                                </div>
                                            <?php } else { ?>
                                                <div class="product-card-footer">
                                                    <button class="btn-action btn-download"
                                                        onclick="downloadFreeMaterial('<?php echo htmlspecialchars($mock_paid->paper_id); ?>')">
                                                        <i class="fa-solid fa-download"></i> Download
                                                    </button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php 
                                    }
                                }

                                if(!$hasMaterial){ ?>
                                    <div class="empty-state">
                                        <i class="fa-solid fa-inbox"></i>
                                        Mock Test registration will be available soon.
                                    </div>
                                <?php } 
                            } 
                            ?>
                        </div>
                    </div>

                    <!-- COMBO -->
                    <div id="combo-<?php echo $subjectIndex; ?>" class="product-type-content" style="display: none;">
                        <div class="products-grid">
                            <?php 
                            if(isset($activate[0]['combo_1_price']) && $activate[0]['combo_1_price'] > 0):
                            ?>
                            <div class="product-card">
                                <div class="product-card-img" style="background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);">
                                    <img src="https://img.icons8.com/external-dygo-kerismaker/48/000000/external-Discount-payment-dygo-kerismaker.png" alt="Combo" class="img-fluid d-block mx-auto w-50">
                                </div>
                                <div class="product-card-body">
                                    <div class="product-card-title">Combo Package 1</div>
                                    <div class="product-card-price">₹ <?php echo number_format($activate[0]['combo_1_price']); ?></div>
                                    <div class="product-card-status" style="color: #4caf50; font-weight: 600;">Save ₹ <?php echo number_format($activate[0]['combo_1_price'] / 2); ?></div>
                                </div>
                                <div class="product-card-footer">
                                    <?php if($can_purchase): ?>
                                    <button class="btn-action btn-add" onclick="addToCart('<?php echo $activate[0]['combo_1_price']."+Combo-1"; ?>')">
                                        <i class="fa-solid fa-cart-plus"></i>Add
                                    </button>
                                    <button class="btn-action btn-remove" onclick="removeFromCart('<?php echo $activate[0]['combo_1_price']."+Combo-1"; ?>')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <?php else: ?>
                                    <button class="btn-action btn-disabled" disabled>
                                        <i class="fa-solid fa-lock"></i>Closed
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php 
                            else:
                            ?>
                            <div class="empty-state">
                                <i class="fa-solid fa-inbox"></i>
                                No combos available
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            $subjectIndex++;
            endforeach;
            ?>
        </div>

        <!-- RIGHT: CART -->
        <div>
            <div class="cart-container">
                <div class="cart-header">
                    <i class="fa-solid fa-shopping-cart"></i>Your Cart
                </div>

                <div class="cart-items">
                    <?php 
                    if(empty($cart_items)): ?>
                    <div class="cart-empty">
                        <i class="fa-solid fa-inbox" style="font-size: 24px; color: #ddd; margin-bottom: 8px; display: block;"></i>
                        Nothing added yet
                    </div>
                    <?php else:
                        foreach($cart_items as $item):
                            $title = preg_replace('/Orientation/i', 'Training', $item['title']);
                            $product_name = $item['product_name'];
                    ?>
                    <div class="cart-item">
                        <span class="cart-item-name"><?php echo htmlspecialchars($product_name); ?></span>
                        <span class="cart-item-price">₹<?php echo number_format($item['amount']); ?></span>
                    </div>
                    <?php 
                        endforeach;
                    endif;
                    ?>
                </div>

                <div class="cart-summary">
                    <div class="cart-total">
                        <span class="cart-total-label">TOTAL AMOUNT</span>
                        <span class="cart-total-amount">₹<?php echo number_format($cart_total); ?></span>
                    </div>

                    <form method='post' action="<?php echo base_url(); ?>razorpay/pay2primary" id="payment-form">
                        <?php 
                        $out = $this->db->get_where('cin_result', array('cin' => $cin))->row();
                        $paid_idd = $this->db->get_where('cin_list', array('cin' => $cin))->row();
                        ?>
                        
                        <input type="hidden" name="cin" value="<?php echo htmlspecialchars($paid_idd->cin ?? ''); ?>">
                        <input type="hidden" name="name" value="<?php echo htmlspecialchars($paid_idd->student_name ?? ''); ?>">
                        <input type="hidden" name="contact" value="<?php echo htmlspecialchars($paid_idd->stud_phone ?? ''); ?>">
                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($paid_idd->stud_email ?? ''); ?>">
                        <input type="hidden" name="clevel" value="<?php echo htmlspecialchars($clevel); ?>">
                        <input type='hidden' name='product_name' value='<?php echo htmlspecialchars($out->product_name ?? ''); ?>'>
                        <input type='hidden' name='amount' value='<?php echo $cart_total; ?>'>

                        <button type="submit" class="btn-checkout" <?php echo empty($cart_total) ? 'disabled' : ''; ?>>
                            <i class="fa-solid fa-credit-card"></i>Proceed to Payment
                        </button>
                    </form>
                </div>
            </div>
            <div>
                

    <?php 
    // Get the MOST RECENT paid product for this CIN
    $paid_product = $this->db
        ->where('cin', $cin)
        ->where('status', 'Paid')
        ->order_by('Time', 'DESC')  // Most recent first
        ->limit(1)
        ->get('new_cart')
        ->row();

    if(!empty($paid_product)) {
        // Use clevel from the paid product itself
        $level_for_invoice = $paid_product->clevel;
    ?>
        <a href='<?php echo base_url('cin_login/api_callinvoice2/' . htmlspecialchars($level_for_invoice)); ?>' 
           class='btn btn-warning btn-lg w-100 my-2 '>
           <i class="fa-solid fa-file-invoice me-2"></i> DOWNLOAD INVOICE
        </a>
    <?php 
    } 
    ?>

            </div>
        </div>
    </div>

    <?php else: ?>
    <div style="text-align: center; padding: 60px 20px; background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
        <i class="fa-solid fa-circle-xmark" style="font-size: 48px; color: #dc3545; margin-bottom: 16px;"></i>
        <h3 style="color: var(--text-primary); margin-bottom: 8px;">Sorry, you are not qualified</h3>
        <p style="color: var(--text-secondary); font-size: 14px;">Better luck next time!</p>
    </div>
    <?php endif; ?>
</div>

<!-- ========== ALERTS ========== -->
<div class="overlay" id="overlay"></div>
<div class="custom-alert" id="custom-alert">
    <p id="alert-message"></p>
</div>
<!-- POPUP -->
<div id="classPopup" class="custom-popup">
    <div class="popup-box">
        <div class="popup-icon">
            <i class="fa-solid fa-circle-exclamation"></i>
        </div>
        
        <h3>Registration Restricted</h3>
        
        <p>
            Registration is currently available only for 
            <strong>Nursery, LKG, and UKG</strong> students.
        </p>

        <button onclick="closeClassPopup()" class="popup-btn">
            OK, Got it
        </button>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<!-- SCRIPT For Restrict classess for registration -->
<script>
function showClassRestrictionPopup() {
    document.getElementById('classPopup').style.display = 'flex';
}

function closeClassPopup() {
    document.getElementById('classPopup').style.display = 'none';
}
</script>
<script>

// ✅ SUBJECT SWITCH
function switchSubject(e, index) {
    if (e) e.preventDefault();

    const tabs = document.querySelectorAll('#subject-tabs .subject-tab');
    const contents = document.querySelectorAll('.subject-content');

    tabs.forEach((tab, i) => {
        tab.classList.toggle('active', i === index);
    });

    contents.forEach((content, i) => {
        content.style.display = (i === index) ? 'flex' : 'none';
    });
}

// ✅ PRODUCT TYPE SWITCH
function switchProductType(e, subjectIndex, type) {
    if (e) e.preventDefault();
    
    const button = e.currentTarget || e.target;
    const sidebar = button.closest('.product-sidebar');
    
    if (!sidebar) {
        console.error('Sidebar not found');
        return;
    }

    sidebar.querySelectorAll('.product-tab').forEach(tab => {
        tab.classList.remove('active');
    });

    button.classList.add('active');

    const subjectContainer = document.getElementById(`subject-${subjectIndex}`);
    if (!subjectContainer) {
        console.error(`Subject container not found: subject-${subjectIndex}`);
        return;
    }

    subjectContainer.querySelectorAll('.product-type-content').forEach(content => {
        content.style.display = 'none';
    });

    const targetId = `${type}-${subjectIndex}`;
    const targetElement = document.getElementById(targetId);
    
    if (targetElement) {
        targetElement.style.display = 'block';
    } else {
        console.error(`Target element not found: ${targetId}`);
    }
}

// ✅ CART FUNCTIONS
function addToCart(id) {
    $.post("<?= base_url('cin_login/net_abc___pri') ?>", { id: id }, function (res) {
        showAlert(res);
        setTimeout(() => location.reload(), 1500);
    }).fail(function(err) {
        showAlert('Error adding to cart');
    });
}

function removeFromCart(id) {
    $.post("<?= base_url('cin_login/cart_remove___pri') ?>", { id: id }, function (res) {
        showAlert(res);
        setTimeout(() => location.reload(), 1500);
    }).fail(function(err) {
        showAlert('Error removing from cart');
    });
}

function misb(id) {
    console.log('misb called');
}

function remove_misb(id) {
    console.log('remove_misb called');
}

function downloadAdmitCard(productName, clevel) {
    console.log(productName);
    console.log(clevel);
     //alert(clevel,"level");
    window.location.href = "<?= base_url('cin_login/api_calladmit_card/') ?>" + clevel + "/"+productName;
    
}

function downloadFreeMaterial(id) {
    window.location.href = "<?= base_url('cin_login/free_material_down/') ?>" + id;
}

function showAlert(message) {
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('custom-alert').style.display = 'block';
    document.getElementById('alert-message').textContent = message;
    setTimeout(closeAlert, 3000);
}

function closeAlert() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('custom-alert').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function () {
    const firstTab = document.querySelector('#subject-tabs .subject-tab');
    if (firstTab) {
        firstTab.classList.add('active');
    }
});

</script>

<?php include("footer.php"); ?>