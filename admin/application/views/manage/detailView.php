                <td>Period:<br />
				 <span class="help-inline"><?php  //echo $this->validation->show_error('period_id',"Period required."); ?></span>
                                      <select name="period_id" id="period_id" >
                                            <option value="">select period</option>
                                            <?php 	foreach($periods as $val): ?>
                                            <option value="<?php echo $val['period_id']; ?>"
                                            <?php if( isset( $period_id ) )
											         { if($period_id == $val['period_id']) {  ?> 
                                            selected="selected" 
											<?php }} ?>>
											<?php echo $val['period_name']; ?></option>
                                            <?php  endforeach;  ?>
                                        </select>
								</td>

                                <td>Competition Level:<br />
				 <span class="help-inline"><?php // echo $this->validation->show_error('competition_level_id',"Competition Level required."); ?></span>

                                      <select name="competition_level_id" id="competition_level_id">
                                            <option value="">select</option>
                                            <?php 	foreach($levels as $val): ?>
                                            <option value="<?php echo $val['competition_level_id']; ?>"
                                            <?php if( isset( $competition_level_id ) )
											         { if($competition_level_id == $val['competition_level_id']) {  ?> 
                                            selected="selected" 
											<?php }} ?>>
											<?php echo $val['competition_level_name']; ?></option>
                                            <?php  endforeach;  ?>
                                        </select>
                                
                                </td>

                                <td>Category:<br />
                                      <select name="category_id" id="category_id">
                                            <option value="">select</option>
                                            <?php 	foreach($category as $val): ?>
                                            <option value="<?php echo $val['category_id']; ?>"
                                            <?php if( isset( $category_id ) )
											         { if($category_id == $val['category_id']) {  ?> 
                                            selected="selected" 
											<?php }} ?>>
											<?php echo $val['categoryKey']; ?></option>
                                            <?php  endforeach;  ?>
                                        </select>
                                
                                </td>
                                <td>Franchise:<br />
                                      <select name="franchise_id" id="franchise_id">
                                            <option value="">select</option>
                                            <?php 	foreach($franchise as $val): ?>
                                            <option value="<?php echo $val['franchise_id']; ?>"
                                            <?php if( isset( $franchise_id ) )
											         { if($franchise_id == $val['franchise_id']) {  ?> 
                                            selected="selected" 
											<?php }} ?>>
											<?php echo $val['place']."(".$val['franchise_code'].")"; ?></option>
                                            <?php  endforeach;  ?>
                                        </select>
                                </td>
                                
                                <td>School:<br />
                                      <select name="school_id" id="school_id">
                                            <option value="">select school</option>
                                            <?php 	foreach($school as $val): ?>
                                            <option value="<?php echo $val['school_id']; ?>"
                                            <?php if( isset( $school_id ) )
											         { if($school_id == $val['school_id']) {  ?> 
                                            selected="selected" 
											<?php }} ?>>
                                            <?php echo $val['school_name']; ?></option>
                                            <?php  endforeach;  ?>
                                     </select>
                                </td>
