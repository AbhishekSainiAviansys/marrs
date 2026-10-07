<?php include('header.php'); ?>

<?php echo $this->notifications->display_html();?> 

<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">FaQs</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="<?php echo SITE_URL.'content/'; ?>">Matreial</a>
        </li>
    </ul>
</div>

<div>		
    <div class="box span12">

        <div class="box-header well">
            <h2><i class="icon-user">Material Price</i></h2>
        </div>
        
        <div class="container mt-4">
        
        <h3>Update Price Study material </h3>
        <hr>
        
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        
           <div id="faq-wrapper">
         <form method="post" action="<?= base_url('controller/update_material'); ?>">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Class</th>
                <th>Title</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($material as $row){ ?>
            <tr>
                <td><?php echo $row->class; ?></td>
                <td><?php echo $row->title; ?></td>
                <td>
                    <input type="hidden" name="id[]" value="<?php echo $row->id; ?>">
                    
                    <input type="text" 
                           class="form-control"
                           name="price[]" 
                           value="<?php echo $row->price; ?>">
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <button type="submit" class="btn btn-primary">Update</button>
</form>   
            </div>
        
        </div>

    </div>
</div>

<?php include('footer.php'); ?>


