

<option value="" title="Click for Test Details">-- select schedule --</option>

<?php
if (empty($schedule)) { ?>
    <option value="">Error: no schedule</option>
<?php
} else {

    foreach ($schedule as $row) {

        $res = $this->db->get_where('new_cart', [
            'cin'     => $_SESSION['cin'],
            'status'  => 'Paid',
            'subject' => $row->subject,
            'series'  => $row->series,
            'type'    => $row->type
        ])->row();

        // Show ONLY red data (when not purchased)
        if (!empty($res)) {
            continue; // skip green ones
        }

        $status_indicator = '🔴';
?>
        <option value="<?php echo $row->lunar_schedule_id; ?>"
                data-id="<?php echo $row->series; ?>" data-scdid="<?php echo $row->lunar_schedule_id; ?>" title="Click for Test Details">
            <?php echo $status_indicator . ' ' . $row->season . ' - ' . $row->subject . ' - ' . $row->series . ' - ' . $row->type . ' - ' . $row->season; ?>
        </option>
<?php
    }
}
?>
