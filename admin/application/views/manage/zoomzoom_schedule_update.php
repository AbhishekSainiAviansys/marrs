<?php include('header.php'); ?>

<div>
    <ul class="breadcrumb">
        <li><a href="<?php echo SITE_URL ?>school/">Schedule</a> <span class="divider">/</span></li>
        <li>Update Lunar Schedule</li>
    </ul>
</div>

<h3 style='color:green;'><?php echo !empty($message) ? $message : ''; ?></h3>

<form method="POST">

<table cellpadding="5px">
    <tr>
        <td>State:<br>
            <select name="state_id" required style="width:200px;">
                <option value="">-- Select State --</option>
                <?php foreach ($stateload as $row): ?>
                    <option value="<?= $row['state_subdivision_id'] ?>"
                        <?= ($result['state_id'] == $row['state_subdivision_id']) ? 'selected' : '' ?>>
                        <?= $row['state_subdivision_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </td>

        <td>Franchise:<br>
            <select name="franchise_id" required style="width:200px;">
                <option value="">-- Select Franchise --</option>
                <?php foreach ($franchiseload as $row): ?>
                    <option value="<?= $row['franchise_id'] ?>"
                        <?= ($result['franchise_id'] == $row['franchise_id']) ? 'selected' : '' ?>>
                        <?= $row['franchise_first_name'].' '.$row['franchise_last_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </td>

        <td>Area:<br>
            <select name="area" style="width:200px;">
                <option value="">-- Select Area --</option>
                <?php foreach ($areaload as $row): ?>
                    <option value="<?= $row['area_code'] ?>"
                        <?= ($result['area'] == $row['area_code']) ? 'selected' : '' ?>>
                        <?= $row['area_code'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>

    <tr>
        <td>Period:<br>
            <select name="period_id" required style="width:200px;">
                <?php foreach ($periodload as $p): ?>
                    <option value="<?= $p->period_id ?>"
                        <?= ($result['period_id'] == $p->period_id) ? 'selected' : '' ?>>
                        <?= $p->academic_year ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </td>

        
    </tr>

    <tr>
        <td>Associate:<br>
            <select name="associate_id" required style="width:200px;">
                <?php foreach ($associates as $a): ?>
                    <option value="<?= $a['associate_id'] ?>"
                        <?= ($result['associate_id'] == $a['associate_id']) ? 'selected' : '' ?>>
                        <?= $a['first_name'] . ' ' . $a['last_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </td>

        <td>Associate %:<br>
            <input type="text" name="franchise_cut" value="<?= $result['associate_cut'] ?>" required>
        </td>

        <td>School Fix:<br>
            <input type="text" name="school_amount" value="<?= $result['school_amount'] ?>">
        </td>
    </tr>

    <tr>
        <td>CRM Fix:<br>
            <input type="text" name="crm_fix" value="<?= $result['crm_fix'] ?>" required>
        </td>
        <td>Start Date:<br>
            <input type="date" name="start_date" value="<?= $result['start_date'] ?>" required>
        </td>
        <td>End Date:<br>
            <input type="date" name="end_date" value="<?= $result['end_date'] ?>" required>
        </td>
    </tr>

    <tr>
        <td>Amount:<br>
            <input type="text" name="amount" value="<?= $result['amount'] ?>" required>
        </td>

        <td>Management %:<br>
            <input type="text" name="management_percentage" value="<?= $result['management_percentage'] ?>" required>
        </td>

        <td>Aviansys %:<br>
            <input type="text" name="aviansys_percentage" value="<?= $result['aviansys_percentage'] ?>" required>
        </td>
    </tr>

    <tr>
        <td>Franchise %:<br>
            <input type="text" name="franchise_percentage" value="<?= $result['franchise_percentage'] ?>">
        </td>

        
    </tr>

    <!--<tr>-->
    <!--    <td>Season<br>-->
    <!--        <input type="text" name="season" value="<?= $result['season'] ?>">-->
    <!--    </td>-->
    <!--</tr>-->

    <tr>
        <td colspan="3" align="center">
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </td>
    </tr>
    
</table>

</form>

<?php include('footer.php'); ?>