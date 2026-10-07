<?php include('header.php'); ?>

<?php echo $this->notifications->display_html();?> 

<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">FaQs</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="<?php echo SITE_URL.'content/'; ?>">FaQ</a>
        </li>
    </ul>
</div>

<div>		
    <div class="box span12">

        <div class="box-header well">
            <h2><i class="icon-user">FaQ</i></h2>
        </div>
        
        <div class="container mt-4">
        
        <h3>Update FaQs for Schedule ID: <?php echo $comp_id; ?></h3>
        <hr>
        
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        
            <form method="POST">
        
                <div id="faq-wrapper">
                
                <?php if (!empty($faq)) : ?>
                
                    <?php foreach ($faq as $fa): ?>
                
                        <div class="faq-row border p-3 mb-3">
                
                            <input type="hidden" name="faq_id[]" value="<?php echo $fa['id']; ?>">
                
                            <label>Question</label>
                            <input type="text" 
                                   class="form-control mb-2"
                                   name="question[]"
                                   value="<?php echo htmlspecialchars($fa['question'], ENT_QUOTES); ?>">
                
                            <label>Answer</label>
                            <textarea class="form-control"
                                      name="answer[]"><?php echo htmlspecialchars($fa['answer'], ENT_QUOTES); ?></textarea>
                
                        </div>
                
                    <?php endforeach; ?>
                
                <?php endif; ?>
                
                </div>
        
                <button type="button" class="btn btn-success" onclick="addFaqRow()">
                    + Add New FAQ
                </button>
                
                <hr>
                
                <button type="submit" name="submit" class="btn btn-primary">
                    Save FAQs
                </button>
        
            </form>
        
        </div>

    </div>
</div>

<?php include('footer.php'); ?>

<?php $this->confirmation->confirm('delete'); ?>

<script>
function addFaqRow() {

    let html = `
        <div class="faq-row border p-3 mb-3">

            <input type="hidden" name="faq_id[]" value="">

            <label>Question</label>
            <input type="text" class="form-control mb-2" name="question[]">

            <label>Answer</label>
            <textarea class="form-control" name="answer[]"></textarea>

        </div>
    `;

    document.getElementById('faq-wrapper')
        .insertAdjacentHTML('beforeend', html);
}
</script>
