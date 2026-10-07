<?php if (!empty($res)) { ?>

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
        
            <?php foreach ($res as $index => $row) { ?>
            
            <tr>
                <td>
                    <input type="radio"
                       name="sch_id"
                       value="<?= $row['sch_id']; ?>"
                       <?= $index === 0 ? 'required' : ''; ?>>
                </td>
                
                <td><?= $row['product_name']; ?></td>
                <td><?= $row['com_per']; ?></td>
                <td><?= $row['manageper']; ?></td>
                <td><?= $row['com_peravian']; ?></td>
                <td><?= $row['associate_per']; ?></td>
                <td><?= $row['crm_fix']; ?></td>
                <td><?= $row['product_price']; ?></td>
            </tr>
            
            <tr>
                <td colspan="8">
                    <strong>Study Material Paid Price:</strong>
                    A: <?= $row['study_material_a_price']; ?> |
                    B: <?= $row['study_material_b_price']; ?> |
                    C: <?= $row['study_material_c_price']; ?> |
                    D: <?= $row['study_material_d_price']; ?> |
                    E: <?= $row['study_material_e_price']; ?> |
                    F: <?= $row['study_material_f_price']; ?>
                </td>
            </tr>
            
            <?php } ?>
        
        </tbody>
    </table>

<?php 
} else { ?>
    No Revenue Settings Found.
<?php 
} ?>
