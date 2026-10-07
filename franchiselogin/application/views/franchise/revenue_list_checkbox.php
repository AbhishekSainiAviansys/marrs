<?php if (!empty($level)) { ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Select</th>
                <th>Product Name</th>
                <th>Franchise %</th>
                <th>Management %</th>
                <th>Aviansys %</th>
                <th>Associate %</th>
                <th>CRM %</th>
                <th>Registration Price</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($level as $index => $res) { ?>
            <tr>
                <td>
                    <input 
                        type="radio" 
                        name="revenue_setting_id" 
                        value="<?php echo $res['id']; ?>" 
                        <?php echo $index === 0 ? 'required' : ''; ?>> 
                </td>
                <td><?php echo $res['product_name']; ?></td>
                <td><?php echo $res['com_per']; ?></td>
                <td><?php echo $res['manageper']; ?></td>
                <td><?php echo $res['com_peravian']; ?></td>
                <td><?php echo $res['associate_per']; ?></td>
                <td><?php echo $res['crm_fix']; ?></td>
                <td><?php echo $res['product_price']; ?></td>
            </tr>
            <tr>
                <td colspan="8">
                    <strong>Study Material Paid Price:</strong>
                    A: <?php echo $res['study_material_a_price']; ?> |
                    B: <?php echo $res['study_material_b_price']; ?> |
                    C: <?php echo $res['study_material_c_price']; ?> |
                    D: <?php echo $res['study_material_d_price']; ?> |
                    E: <?php echo $res['study_material_e_price']; ?> |
                    F: <?php echo $res['study_material_f_price']; ?>
                </td>
            </tr>
            <tr>
                <td colspan="8">
                    <strong>Mock Test Paid Price:</strong>
                    A: <?php echo $res['mock_test_a_price']; ?> |
                    B: <?php echo $res['mock_test_b_price']; ?> |
                    C: <?php echo $res['mock_test_c_price']; ?> |
                    D: <?php echo $res['mock_test_d_price']; ?> |
                    E: <?php echo $res['mock_test_e_price']; ?> |
                    F: <?php echo $res['mock_test_f_price']; ?>
                </td>
            </tr>
            <tr>
                <td colspan="8">
                    <strong>Orientation Paid Price:</strong>
                    A: <?php echo $res['orientation_a_price']; ?> |
                    B: <?php echo $res['orientation_b_price']; ?> |
                    C: <?php echo $res['orientation_c_price']; ?> |
                    D: <?php echo $res['orientation_d_price']; ?> |
                    E: <?php echo $res['orientation_e_price']; ?> |
                    F: <?php echo $res['orientation_f_price']; ?>
                </td>
            </tr>
            <tr>
                <td colspan="8">
                    <strong>Study Material Paid Royalty:</strong>
                    A: <?php echo $res['study_material_a_price_royalty']; ?> |
                    B: <?php echo $res['study_material_b_price_royalty']; ?> |
                    C: <?php echo $res['study_material_c_price_royalty']; ?> |
                    D: <?php echo $res['study_material_d_price_royalty']; ?> |
                    E: <?php echo $res['study_material_e_price_royalty']; ?> |
                    F: <?php echo $res['study_material_f_price_royalty']; ?> |
                    Study Material Free Royalty: <?php echo $res['study_material_free_royalty']; ?>
                </td>
            </tr>
            <tr>
                <td colspan="8">
                    <strong>Mock Test Royalty:</strong>
                    A: <?php echo $res['mock_test_a_price_royalty']; ?> |
                    B: <?php echo $res['mock_test_b_price_royalty']; ?> |
                    C: <?php echo $res['mock_test_c_price_royalty']; ?> |
                    D: <?php echo $res['mock_test_d_price_royalty']; ?> |
                    E: <?php echo $res['mock_test_e_price_royalty']; ?> |
                    F: <?php echo $res['mock_test_f_price_royalty']; ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <?php
    if (empty($result['clevel'])) echo 'Error: Competition Level Not Selected.<br>';
    if (empty($result['period_id'])) echo 'Error: Period Not Selected.<br>';
    if (empty($result['franchise_id'])) echo 'Error: Franchise Not Selected.<br>';
    if (empty($result['product_name'])) echo 'Error: Product Name Not Selected.<br>';
    ?>
<?php } ?>
