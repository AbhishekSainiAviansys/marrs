							<div class="control-group">
                                 <label class="control-label" for="focusedInput">Title </label>
                                 <input type="hidden" name="hidden_titleId"  id="hidden_titleId" value="<?php echo $val['title_id']; ?>" />
                                        <div class="controls">
											<?php
                                            $options = array();
                                            $options['']='Select Title';
                                               foreach($title as $val):
                                                 $options[$val['title_id']]=$val['title'];
                                               endforeach;
                                                
                                              echo form_dropdown('title_id', $options);
                                            ?>
                                            <span class="help-inline">
                                            <?php  echo form_error('title_id'); ?></span>
                                        
                                            <span class="help-inline"><?php  echo form_error('title_id'); ?></span>
                                       </div>
							</div>
<!--    ##################################################################### Select Category based on Service	###################-->					  
							<div class="control-group">
                            
                                 <label class="control-label" for="focusedInput">Category </label>
                                  <div class="controls">
											<?php
                                            $options = array();
                                            $options['']='Select Category';
                                               foreach($category as $val):
                                                 $options[$val['category_id']]=$val['categoryKey'];
                                               endforeach;
                                                
                                              echo form_dropdown('category_id', $options);
                                            ?>
                                            <span class="help-inline">
                                            <?php  echo form_error('category_id'); ?></span>
                                        
                                            <span class="help-inline"><?php  echo form_error('category_id'); ?></span>
                                       </div>
                                       </div>
<!--    #####################################################################  Select Level based on Service ###################-->					  
							<div class="control-group">
                            
                                 <label class="control-label" for="focusedInput">Level </label>
                                  <div class="controls">
											<?php
                                            $options = array();
                                            $options['']='Select Level';
                                               foreach($levels as $val):
                                                 $options[$val['competition_level_id']]=$val['competition_level_name'];
                                               endforeach;
                                                
                                              echo form_dropdown('competition_level_id', $options);
                                            ?>
                                            <span class="help-inline">
                                            <?php  echo form_error('competition_level_id'); ?></span>
                                        
                                            <span class="help-inline"><?php  echo form_error('competition_level_id'); ?></span>
                                       </div>
							
                        </div>