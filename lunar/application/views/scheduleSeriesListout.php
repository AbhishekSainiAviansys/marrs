<style>/* Container */
#scheduleTable {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    border: none;
}

/* Table Header */
#scheduleTable thead {
    background: linear-gradient(135deg, #4A5BF5, #7B68EE);
    color: #fff;
}

#scheduleTable th {
    padding: 15px;
    font-weight: 600;
    text-align: center;
    border: none;
    font-size: 14px;
}

/* Table Body */
#scheduleTable td {
    padding: 14px;
    text-align: center;
    border-bottom: 1px solid #f1f1f1;
    font-size: 14px;
}

/* Hover Effect */
#scheduleTable tbody tr {
    transition: all 0.3s ease;
}

#scheduleTable tbody tr:hover {
    background: #f8f9ff;
    transform: scale(1.01);
}

/* Radio Button Styling */
#scheduleTable input[type="radio"] {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: #4A5BF5;
}

/* Title Styling */
.container h3 {
    font-weight: 600;
    margin-bottom: 15px;
}

/* Submit Button */
.submit-btn {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(135deg, #4A5BF5, #7B68EE);
    color: #fff;
    font-weight: 600;
    font-size: 16px;
    margin-top: 15px;
    transition: all 0.3s ease;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(74,91,245,0.4);
}

/* Empty State */
.container.mt-5 h3 {
    text-align: center;
    color: #888;
    font-size: 16px;
    line-height: 1.6;
}

/* Responsive */
@media (max-width: 768px) {
    #scheduleTable th,
    #scheduleTable td {
        font-size: 12px;
        padding: 10px;
    }

    .submit-btn {
        font-size: 14px;
    }
}</style>
  <?php if(!empty($eligible_schedules)){ ?>
            <div class="container mt-4">
                <h3 style="font-size: 1.2rem; color: var(--text-light);text-align:center">You are ELIGIBLE to participate in "Lunar Skill Test"</h3>
                
                <!--<form id="scheduleForm">-->
               
                    <table class="table table-bordered mt-3" id="scheduleTable">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Subject</th>
                                <th>Series</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($eligible_schedules as $schedule){ ?>
                                
                                <tr>
                                    <td>
                                        <input type="radio" 
                                               name="lunar_schedule_id" 
                                               value="<?php echo $schedule->lunar_schedule_id ?>" 
                                               required>
                                    </td>
                                    <td><?php echo $schedule->subject; ?></td>
                                    <td><?php echo $schedule->series; ?></td>
                                    <td><?php echo $schedule->type; ?></td>
                                </tr>
                            
                            <?php } ?>
                        </tbody>
                    </table>
                
                    


            </div>
            <?php }else{ ?>
            <!--<div class="container mt-5" id="noScheduleContainer" style="display:none;">-->
            <div class="container mt-5">
                <h3>“We don’t have any classes for this grade yet. Don’t worry—we’re adding new ones soon! Please check back in a few days or try choosing a different class. Thanks for visiting!”</h3>
            </div>
            <?php } ?>