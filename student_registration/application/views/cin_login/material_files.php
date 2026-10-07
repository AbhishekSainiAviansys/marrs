
<style>
/* Full page layout */
.page-container {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* Content area */
.page-content {
    flex: 1;
    display: flex;
    justify-content: center;   /* horizontal center */
    align-items: center;       /* vertical center when small */
    padding: 30px 15px;
}

/* Card */
.card-box {
    background: #fff;
    border-radius: 12px;
    padding: 25px;
    width: 100%;
    max-width: 900px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
}

/* Title */
.page-title {
    text-align: center;
    font-weight: 700;
    color: #006699;
    margin-bottom: 20px;
}

/* Table */
.table th {
    background: #006699;
    color: #006699;
    text-align: center;
}

.table td {
    text-align: center;
    vertical-align: middle;
}

/* Download Button */
.btn-download {
    border: 1px solid #dc3545;
    color: #dc3545;
}

.btn-download:hover {
    background: #dc3545;
    color: #fff;
}

/* Back Button */
.back-btn {
    margin-top: 20px;
    text-align: center;
}

/* IMPORTANT: When content grows, disable vertical centering */
@media (min-height: 700px) {
    .page-content.has-data {
        align-items: flex-start;
    }
}
</style>

<div class="page-container">

    <?php include('header.php'); ?>

    <div class="page-content <?php echo !empty($material) ? 'has-data' : ''; ?>">

        <div class="card-box">

            <h2 class="page-title">Study Materials</h2>

            <?php if(!empty($material)){ ?>

                <div class="table-responsive">
                    <form method="post">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Class</th>
                                    <th>Download</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($material as $row){ ?>
                                <tr>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['class']; ?></td>
                                    <td>
                                        <button type="submit" 
                                            name="download" 
                                            value="<?php echo $row['folder']; ?>" 
                                            class="btn btn-download btn-outline-danger btn-sm">
                                            <i class="fa-solid fa-download"></i> Download
                                        </button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </form>
                </div>

            <?php } else { ?>
                <p class="text-center">No materials available.</p>
            <?php } ?>

            <div class="back-btn">
                <a href="javascript:window.history.go(-1);" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-circle-chevron-left"></i> Back
                </a>
            </div>

        </div>

    </div>

    <?php include('footer.php'); ?>

</div>