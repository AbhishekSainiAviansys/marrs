<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Payment Split Dashboard
 *
 * One dashboard for:
 *   - MaRRS
 *   - Lunar
 *   - ZoomZoom
 *
 * Role comes from dashboard_accounts.
 *
 * URLs:
 *   /payment_dashboard
 *   /payment_dashboard/get_marrs_split
 *   /payment_dashboard/get_lunar_split
 *   /payment_dashboard/get_zoomzoom_split
 */
class Payment_dashboard extends CI_Controller
{
    const MAX_ROWS = 500;

    private $account;

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');

        /*
         * Get logged-in dashboard account.
         */
        $id = (int) $this->session->userdata('dash_account_id');

        $this->account = $id
            ? $this->db->get_where('dashboard_accounts', [
                'id'         => $id,
                'is_active'  => 1,
                'deleted_at' => NULL,
            ])->row()
            : NULL;

        /*
         * Session/account not valid.
         */
        if (!$this->account) {

            /*
             * All three data APIs are JSON endpoints.
             */
            $json_methods = [
                'get_marrs_split',
                'get_lunar_split',
                'get_zoomzoom_split',
            ];

            if (in_array(
                $this->router->fetch_method(),
                $json_methods,
                TRUE
            )) {
                $this->send([
                    'error' => 'Session expired'
                ], 401);

                $this->output->_display();
                exit;
            }

            redirect('/dash_login');
            exit;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Dashboard page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['account'] = $this->account;

        $this->load->view(
            'payment_dashboard.php',
            $data
        );
    }


    /*
    |--------------------------------------------------------------------------
    | MARRS
    |--------------------------------------------------------------------------
    |
    | MaRRS has its own database logic.
    |
    */

    public function get_marrs_split()
    {
        return $this->marrs_data();
    }


    private function marrs_data()
    {
        $acc  = $this->account;
        $role = strtolower(trim((string) $acc->role));


        /*
         * Allowed dashboard roles.
         *
         * Every allowed role can open the dashboard.
         * The role determines which data is returned.
         */
        $allowed_roles = [
            'admin',
            'franchise',
            'crm',
            'it',
            'management',
            'aviansys',
            'maker'
        ];

        if (!in_array($role, $allowed_roles, TRUE)) {

            return $this->send([
                'error' => 'Data access is not enabled for your role.'
            ], 403);
        }


        /*
         * Franchise must have acc_id.
         */
        if ($role === 'franchise') {

            if (trim((string) $acc->acc_id) === '') {

                return $this->send([
                    'error' => 'Your account has no acc_id set.'
                ], 403);
            }
        }


        /*
         * Payment type.
         *
         * all
         * school
         * competition
         */
        $type = strtolower(
            trim((string) $this->input->get('type'))
        );


        /*
         * Date filters.
         */
        $start = $this->valid_date(
            $this->input->get('start_date')
        );

        $end = $this->valid_date(
            $this->input->get('end_date')
        );


        /*
         * Make end date inclusive.
         */
        if ($end) {

            $end = date(
                'Y-m-d',
                strtotime($end . ' +1 day')
            );
        }


        $rows = [];


        /*
         * ----------------------------------------------------------
         * Competition payments
         * ----------------------------------------------------------
         */
        if ($type !== 'school') {

            $rows = array_merge(
                $rows,
                $this->fetch_marrs(
                    'payment_split',
                    'competition',
                    $start,
                    $end
                )
            );
        }


        /*
         * ----------------------------------------------------------
         * School payments
         * ----------------------------------------------------------
         */
        if ($type !== 'competition') {

            $rows = array_merge(
                $rows,
                $this->fetch_marrs(
                    'payment_split_prid',
                    'school',
                    $start,
                    $end
                )
            );
        }


        /*
         * Latest payment first.
         */
        usort(
            $rows,
            function ($a, $b) {

                return strcmp(
                    (string) ($b['date_of_payment'] ?? ''),
                    (string) ($a['date_of_payment'] ?? '')
                );
            }
        );


        /*
         * Return maximum rows.
         */
        return $this->send(
            array_slice(
                $rows,
                0,
                self::MAX_ROWS
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | MaRRS fetch
    |--------------------------------------------------------------------------
    */

    private function fetch_marrs(
        $table,
        $type,
        $start,
        $end
    ) {

        $acc  = $this->account;
        $role = strtolower(trim((string) $acc->role));

       $isFranchise = ($role === 'franchise');


/*
 * ----------------------------------------------------------
 * Reset Query Builder
 * ----------------------------------------------------------
 *
 * Important:
 * This prevents a previous query from affecting
 * the current payment query.
 */
$this->db->reset_query();


/*
 * ----------------------------------------------------------
 * FROM table
 * ----------------------------------------------------------
 *
 * Explicitly set FROM before adding SELECT/JOIN.
 */
$this->db->from($table);


/*
 * Select all fields from the payment table.
 */
$this->db->select(
    $table . '.*',
    FALSE
);


/*
 * ----------------------------------------------------------
 * Competition payment
 * ----------------------------------------------------------
 *
 * payment_split
 *      |
 *      LEFT JOIN
 *      |
 * competition_product_state
 */
if ($type === 'competition') {

    $this->db->join(
        'competition_product_state',
        'competition_product_state.id = ' .
        $table . '.comp_id',
        'left',
        FALSE
    );


    /*
     * Add revenue_setting_id when available.
     */
    if (
        $this->db->field_exists(
            'revenue_setting_id',
            'competition_product_state'
        )
    ) {

        $this->db->select(
            'competition_product_state.revenue_setting_id AS rs_id',
            FALSE
        );
    }
}


        /*
         * ----------------------------------------------------------
         * Franchise filtering
         * ----------------------------------------------------------
         *
         * Only franchise users are restricted by acc_id.
         *
         * Admin / CRM / IT / Management / Aviansys / Maker
         * are handled according to their own dashboard role.
         */
        if ($isFranchise) {

            if (
                !$this->db->field_exists(
                    'franchise_id',
                    $table
                )
            ) {

                return [];
            }

            $this->db->where(
                $table . '.franchise_id',
                $acc->acc_id
            );
        }


        /*
         * ----------------------------------------------------------
         * Date filtering
         * ----------------------------------------------------------
         */
        if ($start) {

            $this->db->where(
                $table . '.date_of_payment >=',
                $start
            );
        }


        if ($end) {

            $this->db->where(
                $table . '.date_of_payment <',
                $end
            );
        }


        /*
         * ----------------------------------------------------------
         * Ordering
         * ----------------------------------------------------------
         *
         * Avoid assuming pay_id exists.
         */
        if (
            $this->db->field_exists(
                'pay_id',
                $table
            )
        ) {

            $this->db->order_by(
                $table . '.pay_id',
                'DESC'
            );

        } elseif (
            $this->db->field_exists(
                'id',
                $table
            )
        ) {

            $this->db->order_by(
                $table . '.id',
                'DESC'
            );

        } elseif (
            $this->db->field_exists(
                'date_of_payment',
                $table
            )
        ) {

            $this->db->order_by(
                $table . '.date_of_payment',
                'DESC'
            );
        }


        $this->db->limit(
            self::MAX_ROWS
        );


        /*
         * Execute query.
         */
        $query = $this->db->get();


        /*
         * Return DB error as JSON instead of HTML.
         *
         * This is especially useful while testing the API.
         */
        if (!$query) {

            $error = $this->db->error();

            log_message(
                'error',
                'MaRRS payment query failed: ' .
                json_encode($error)
            );

            return [];
        }


        $raw = $query->result_array();


        if (!$raw) {
            return [];
        }


        /*
         * ----------------------------------------------------------
         * Maker totals
         * ----------------------------------------------------------
         *
         * Maker amount is required for non-franchise
         * competition payments.
         */
        $makers = (
            !$isFranchise &&
            $type === 'competition'
        )
            ? $this->maker_totals($raw)
            : [];


        /*
         * ----------------------------------------------------------
         * CIN list
         * ----------------------------------------------------------
         */
        $cins = (
            $type === 'school'
        )
            ? $this->cin_lists($raw)
            : [];


        /*
         * ----------------------------------------------------------
         * Payment split fields
         * ----------------------------------------------------------
         */
        $fields = [
            'franchise_tranfer_id',
            'franchise_amount'
        ];


        /*
         * Internal split fields.
         *
         * Franchise users do not receive these values.
         */
        if (!$isFranchise) {

            $fields = array_merge(
                $fields,
                [
                    'crm_fix_tranfer_id',
                    'crm_fix',

                    'it_fix_tranfer_id',
                    'it_fix',

                    'management_tranfer_id',
                    'management_amount',

                    'aviansys_tranfer_id',
                    'aviansys_amount',

                    'gst_tranfer_id',
                    'gst_amount',

                    'razpay_service',
                    'MaRRS_bal',
                    'crm_aviansys',
                ]
            );
        }


        /*
         * ----------------------------------------------------------
         * Normalize MaRRS response
         * ----------------------------------------------------------
         */
        $out = [];


        foreach ($raw as $r) {

            $row = [

                'date_of_payment' =>
                    $r['date_of_payment'] ?? '',

                'cin' =>
                    $r['cin'] ?? '',

                'prid' =>
                    $r['prid'] ?? '',

                'cins' =>
                    $cins[
                        $r['prid'] ?? ''
                    ] ?? [],

                'type' =>
                    $type,

                'status' =>
                    $r['status'] ?? NULL,

                'total_amount' =>
                    $r['total_amount'] ?? 0,
            ];


            /*
             * Add payment split fields.
             */
            foreach ($fields as $field) {

                $row[$field] =
                    $r[$field] ?? NULL;
            }


            /*
             * Maker amount.
             */
            if (!$isFranchise) {

                $rs =
                    $r['rs_id']
                    ?? ($r['revenue_setting_id'] ?? '');

                $key =
                    ($r['comp_id'] ?? '') . '|' .
                    $rs . '|' .
                    ($r['payment_id'] ?? '');


                $row['maker'] =
                    $makers[$key] ?? 0;
            }


            $out[] = $row;
        }


        return $out;
    }


    /*
    |--------------------------------------------------------------------------
    | MaRRS Maker totals
    |--------------------------------------------------------------------------
    */

    private function maker_totals(array $raw)
    {
        $ids = array_values(
            array_unique(
                array_filter(
                    array_column(
                        $raw,
                        'payment_id'
                    )
                )
            )
        );


        if (!$ids) {
            return [];
        }


        $q = $this->db
            ->select(
                'comp_id, revenue_setting_id, order_id, SUM(price) AS total',
                FALSE
            )
            ->where_in(
                'order_id',
                $ids
            )
            ->where(
                'transaction_id IS NOT NULL',
                NULL,
                FALSE
            )
            ->group_by(
                'comp_id, revenue_setting_id, order_id'
            )
            ->get('makers_splits');


        if (!$q) {
            return [];
        }


        $map = [];


        foreach ($q->result_array() as $m) {

            $key =
                $m['comp_id'] . '|' .
                $m['revenue_setting_id'] . '|' .
                $m['order_id'];


            $map[$key] =
                (float) $m['total'];
        }


        return $map;
    }


    /*
    |--------------------------------------------------------------------------
    | MaRRS CIN list
    |--------------------------------------------------------------------------
    */

    private function cin_lists(array $raw)
    {
        $prids = array_values(
            array_unique(
                array_filter(
                    array_column(
                        $raw,
                        'prid'
                    )
                )
            )
        );


        if (!$prids) {
            return [];
        }


        $rows = $this->db
            ->select(
                'prid, cin'
            )
            ->where_in(
                'prid',
                $prids
            )
            ->get('cin_list');


        if (!$rows) {
            return [];
        }


        $map = [];


        foreach ($rows->result_array() as $c) {

            $map[
                $c['prid']
            ][] = $c['cin'];
        }


        return $map;
    }


    /*
    |--------------------------------------------------------------------------
    | LUNAR
    |--------------------------------------------------------------------------
    |
    | Lunar has completely separate tables/logic.
    |
    */

    // public function get_lunar_split()
    // {
    //     $acc  = $this->account;
    //     $role = strtolower(trim((string) $acc->role));


    //     $allowed_roles = [
    //         'admin',
    //         'franchise',
    //         'crm',
    //         'it',
    //         'management',
    //         'aviansys',
    //         'maker'
    //     ];


    //     if (!in_array($role, $allowed_roles, TRUE)) {

    //         return $this->send([
    //             'error' => 'Data access is not enabled for your role.'
    //         ], 403);
    //     }


    //     /*
    //      * ----------------------------------------------------------
    //      * PUT LUNAR DATABASE LOGIC HERE
    //      * ----------------------------------------------------------
    //      *
    //      * Example:
    //      *
    //      * $this->db->select(...);
    //      * $this->db->from('LUNAR_TABLE');
    //      *
    //      * if ($role === 'franchise') {
    //      *     $this->db->where(
    //      *         'franchise_id',
    //      *         $acc->acc_id
    //      *     );
    //      * }
    //      *
    //      * ...
    //      *
    //      * $rows = $this->db->get()->result_array();
    //      */


    //     $rows = [];


    //     return $this->send($rows);
    // }
public function get_lunar_split()
{
    $acc  = $this->account;
    $role = strtolower(trim((string) $acc->role));

    $allowed_roles = [
        'admin',
        'franchise',
        'crm',
        'it',
        'management',
        'aviansys',
        'maker'
    ];

    if (!in_array($role, $allowed_roles, TRUE)) {

        return $this->send([
            'error' => 'Data access is not enabled for your role.'
        ], 403);
    }


    /*
     * ----------------------------------------------------------
     * Franchise validation
     * ----------------------------------------------------------
     */
    if ($role === 'franchise') {

        if (trim((string) $acc->acc_id) === '') {

            return $this->send([
                'error' => 'Your account has no acc_id set.'
            ], 403);
        }
    }


    /*
     * ----------------------------------------------------------
     * Date filters
     * ----------------------------------------------------------
     */
    $start = $this->valid_date(
        $this->input->get('start_date')
    );

    $end = $this->valid_date(
        $this->input->get('end_date')
    );


    /*
     * Make end date inclusive.
     */
    if ($end) {

        $end = date(
            'Y-m-d',
            strtotime($end . ' +1 day')
        );
    }


    /*
     * ----------------------------------------------------------
     * Lunar Competition
     * ----------------------------------------------------------
     *
     * Lunar currently uses only:
     *
     * lunar_split_prid
     *
     * There is NO School / Competition switch here.
     *
     * Therefore this endpoint always returns
     * Competition data.
     */
    $table = 'lunar_split_prid';


    /*
     * ----------------------------------------------------------
     * Reset Query Builder
     * ----------------------------------------------------------
     */
    $this->db->reset_query();


    /*
     * ----------------------------------------------------------
     * Select Lunar split
     * ----------------------------------------------------------
     */
    $this->db->from($table);

    $this->db->select(
        $table . '.*',
        FALSE
    );


    /*
     * ----------------------------------------------------------
     * Join orders
     * ----------------------------------------------------------
     *
     * lunar_split_prid.payment_id
     *        =
     * orders.razorpay_order_id
     *
     * Orders contains:
     * - CIN
     * - Razorpay information
     * - payment status
     * - payment details
     */
    $this->db->join(
        'orders',
        'orders.razorpay_order_id = ' .
        $table . '.payment_id',
        'left',
        FALSE
    );


    /*
     * Get CIN from orders when available.
     */
    $this->db->select(
        'orders.cin AS order_cin',
        FALSE
    );


    /*
     * Get order status.
     */
    $this->db->select(
        'orders.status AS order_status',
        FALSE
    );


    /*
     * Get Razorpay payment ID.
     */
    $this->db->select(
        'orders.razorpay_payment_id',
        FALSE
    );


    /*
     * Get payment method.
     */
    $this->db->select(
        'orders.payment_method',
        FALSE
    );


    /*
     * ----------------------------------------------------------
     * Franchise filtering
     * ----------------------------------------------------------
     */
    if ($role === 'franchise') {

        $this->db->where(
            $table . '.franchise_id',
            $acc->acc_id
        );
    }


    /*
     * ----------------------------------------------------------
     * Date filtering
     * ----------------------------------------------------------
     */
    if ($start) {

        $this->db->where(
            $table . '.date_of_payment >=',
            $start
        );
    }


    if ($end) {

        $this->db->where(
            $table . '.date_of_payment <',
            $end
        );
    }


    /*
     * ----------------------------------------------------------
     * Ordering
     * ----------------------------------------------------------
     */
    $this->db->order_by(
        $table . '.pay_id',
        'DESC'
    );


    /*
     * ----------------------------------------------------------
     * Limit
     * ----------------------------------------------------------
     */
    $this->db->limit(
        self::MAX_ROWS
    );


    /*
     * ----------------------------------------------------------
     * Execute
     * ----------------------------------------------------------
     */
    $query = $this->db->get();


    if (!$query) {

        $error = $this->db->error();

        log_message(
            'error',
            'Lunar payment query failed: ' .
            json_encode($error)
        );

        return $this->send([
            'error' => 'Unable to load Lunar payment data.'
        ], 500);
    }


    $raw = $query->result_array();


    if (!$raw) {

        return $this->send([]);
    }


    /*
     * ----------------------------------------------------------
     * Normalize response
     * ----------------------------------------------------------
     */
    $out = [];


    foreach ($raw as $r) {

        $row = [

            /*
             * Payment information
             */
            'date_of_payment' =>
                $r['date_of_payment'] ?? '',

            'cin' =>
                $r['order_cin']
                ?? ($r['cin'] ?? ''),

            'prid' =>
                $r['prid'] ?? '',

            'type' =>
                'competition',

            'status' =>
                $r['order_status']
                ?? ($r['status'] ?? 1),

            'total_amount' =>
                $r['total_amount']
                ?? 0,


            /*
             * Lunar split fields
             */
            'franchise_tranfer_id' =>
                $r['franchise_transfer_id']
                ?? NULL,

            'franchise_amount' =>
                $r['franchise_amount']
                ?? 0,


            'crm_fix_tranfer_id' =>
                $r['crm_fix_tranfer_id']
                ?? NULL,

            'crm_fix' =>
                $r['crm_fix']
                ?? 0,


            'it_fix_tranfer_id' =>
                $r['it_transfer_id']
                ?? NULL,

            'it_fix' =>
                $r['it_amount']
                ?? 0,


            'management_tranfer_id' =>
                $r['management_tranfer_id']
                ?? NULL,

            'management_amount' =>
                $r['management_amount']
                ?? 0,


            'aviansys_tranfer_id' =>
                $r['aviansys_tranfer_id']
                ?? NULL,

            'aviansys_amount' =>
                $r['aviansys_amount']
                ?? 0,


            'gst_tranfer_id' =>
                $r['gst_tranfer_id']
                ?? NULL,

            'gst_amount' =>
                $r['gst_amount']
                ?? 0,


            /*
             * Payment service / balance
             */
            'razpay_service' =>
                $r['razpay_service']
                ?? 0,

            'MaRRS_bal' =>
                $r['MaRRS_bal']
                ?? 0,


            /*
             * Lunar uses maker_amount
             */
            'maker' =>
                $r['maker_amount']
                ?? 0,


            /*
             * Useful additional values
             */
            'payment_id' =>
                $r['payment_id']
                ?? '',

            'razorpay_payment_id' =>
                $r['razorpay_payment_id']
                ?? '',

            'payment_method' =>
                $r['payment_method']
                ?? '',

            'crm_aviansys' =>
                0,

            'cins' =>
                []
        ];


        $out[] = $row;
    }


    return $this->send($out);
}

    /*
    |--------------------------------------------------------------------------
    | ZOOMZOOM
    |--------------------------------------------------------------------------
    |
    | ZoomZoom has completely separate tables/logic.
    |
    */

    public function get_zoomzoom_split()
    {
        $acc  = $this->account;
        $role = strtolower(trim((string) $acc->role));


        $allowed_roles = [
            'admin',
            'franchise',
            'crm',
            'it',
            'management',
            'aviansys',
            'maker'
        ];


        if (!in_array($role, $allowed_roles, TRUE)) {

            return $this->send([
                'error' => 'Data access is not enabled for your role.'
            ], 403);
        }


        /*
         * ----------------------------------------------------------
         * PUT ZOOMZOOM DATABASE LOGIC HERE
         * ----------------------------------------------------------
         *
         * ZoomZoom will have its own:
         *
         * - tables
         * - joins
         * - franchise filtering
         * - CRM filtering
         * - IT filtering
         * - Management filtering
         * - Aviansys filtering
         * - Maker filtering
         *
         */


        $rows = [];


        return $this->send($rows);
    }


    /*
    |--------------------------------------------------------------------------
    | Date validation
    |--------------------------------------------------------------------------
    */

    private function valid_date($d)
    {
        return (
            is_string($d) &&
            preg_match(
                '/^\d{4}-\d{2}-\d{2}$/',
                $d
            )
        )
            ? $d
            : '';
    }


    /*
    |--------------------------------------------------------------------------
    | JSON response
    |--------------------------------------------------------------------------
    */

    private function send($data, $code = 200)
    {
        $this->output
            ->set_status_header($code)
            ->set_content_type('application/json')
            ->set_output(
                json_encode(
                    $data,
                    JSON_UNESCAPED_UNICODE
                )
            );
    }
}