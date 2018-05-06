<?php /* Smarty version 2.6.5-dev, created on 2018-04-25 21:50:28
         compiled from staff.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'staff.tpl', 18, false),array('modifier', 'crypt', 'staff.tpl', 20, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "base.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div align="left">
		<?php echo $this->_tpl_vars['HeadLinks']; ?>

	</div> 
	<?php if ($this->_tpl_vars['Action'] == 'view'): ?>

	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD">
		<tr class="titleth"> 
			<td align="center" width="30" rowspan="2">#</td>
			<td align="center" rowspan="2"><?php echo $this->_tpl_vars['Dict']['xtb']; ?>
</td>
			<td align="center" colspan="2"><?php echo $this->_tpl_vars['Dict']['staff']; ?>
</td>
		</tr>
		<tr class="titleth">
			<td align="center"><?php echo $this->_tpl_vars['Dict']['today']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['total']; ?>
</td>
		</tr>
		<?php if (count($_from = (array)$this->_tpl_vars['Departments'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Department']):
?>
		<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFFFF,#E4EAF2"), $this);?>
"> 
			<td align="center"><?php echo $this->_tpl_vars['key']+1; ?>
</td>
			<td><a href="staff.php?act=departments&rid=<?php echo ((is_array($_tmp=$this->_tpl_vars['Department']['region'])) ? $this->_run_mod_handler('crypt', true, $_tmp) : smarty_modifier_crypt($_tmp)); ?>
" class="names faculties"><?php echo $this->_tpl_vars['Department']['name']; ?>
</a></td>
			<td align="right"><?php echo $this->_tpl_vars['Department']['scount']; ?>
</td>
			<td align="right"><?php echo $this->_tpl_vars['Department']['scount_all']; ?>
</td>
		</tr>
		<?php endforeach; unset($_from); endif; ?>
	</table>

	<?php endif; ?>

	<?php if ($this->_tpl_vars['Action'] == 'departments'): ?>
	<h2><?php echo $this->_tpl_vars['HeadDepartment']['dname']; ?>
</h2>
	<div class="actions">
		<a href="staff.php?act=stafflist&rid=<?php echo ((is_array($_tmp=$this->_tpl_vars['RegionId'])) ? $this->_run_mod_handler('crypt', true, $_tmp) : smarty_modifier_crypt($_tmp)); ?>
" target="studlist" class="myButton">Xudud bo'yicha ro'yxatni yuklab olish</a>
	</div>

	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD">
		<tr class="titleth"> 
			<td align="center" width="30" rowspan="2">#</td>
			<td align="center" rowspan="2"><?php echo $this->_tpl_vars['Dict']['xtb']; ?>
</td>
			<td align="center" colspan="2"><?php echo $this->_tpl_vars['Dict']['staff']; ?>
</td>
		</tr>
		<tr class="titleth">
			<td align="center"><?php echo $this->_tpl_vars['Dict']['today']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['total']; ?>
</td>
		</tr>
		<?php if (count($_from = (array)$this->_tpl_vars['Departments'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Department']):
?>
		<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFFFF,#E4EAF2"), $this);?>
"> 
			<td align="center"><?php echo $this->_tpl_vars['key']+1; ?>
</td>
			<td><a href="staff.php?act=schools&dcid=<?php echo ((is_array($_tmp=$this->_tpl_vars['Department']['distcity'])) ? $this->_run_mod_handler('crypt', true, $_tmp) : smarty_modifier_crypt($_tmp)); ?>
" class="names faculties"><?php echo $this->_tpl_vars['Department']['name']; ?>
 </a></td>
			<td align="right"><?php echo $this->_tpl_vars['Department']['scount']; ?>
</td>
			<td align="right"><?php echo $this->_tpl_vars['Department']['scount_all']; ?>
</td>
		</tr>
		<?php endforeach; unset($_from); endif; ?>
	</table>
	<iframe id="studlist" name="studlist" width="100" height="50" style="display: none;">
		
	</iframe>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['Action'] == 'schools'): ?>
	<h2><?php echo $this->_tpl_vars['HeadDepartment']['name']; ?>
</h2>
	<div class="actions">
		<a href="staff.php?act=stafflist&rid=<?php echo ((is_array($_tmp=$this->_tpl_vars['HeadDepartment']['region'])) ? $this->_run_mod_handler('crypt', true, $_tmp) : smarty_modifier_crypt($_tmp)); ?>
&dsid=<?php echo ((is_array($_tmp=$this->_tpl_vars['HeadDepartment']['id'])) ? $this->_run_mod_handler('crypt', true, $_tmp) : smarty_modifier_crypt($_tmp)); ?>
" target="studlist" class="myButton">XTB bo'yicha ro'yxatni yuklab olish</a>
	</div>
	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD">
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['school']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['staff']; ?>
</td>
		</tr>
		<?php if (count($_from = (array)$this->_tpl_vars['Schools'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['School']):
?>
		<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFFFF,#E4EAF2"), $this);?>
"> 
			<td align="center"><?php echo $this->_tpl_vars['key']+1; ?>
</td>
			<td><a href="staff.php?act=staff&did=<?php echo ((is_array($_tmp=$this->_tpl_vars['School']['id'])) ? $this->_run_mod_handler('crypt', true, $_tmp) : smarty_modifier_crypt($_tmp)); ?>
" class="names faculties"><?php echo $this->_tpl_vars['School']['school_number']; ?>
-<?php echo $this->_tpl_vars['School']['stype']; ?>
</a></td>
			<td align="right"><?php echo $this->_tpl_vars['School']['scount']; ?>
</td>
		</tr>
		<?php endforeach; unset($_from); endif; ?>
	</table>
	<iframe id="studlist" name="studlist" width="100" height="50" style="display: none;">
		
	</iframe>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['Action'] == 'staff'): ?>
	<h2><?php echo $this->_tpl_vars['HeadDepartment']['school_number']; ?>
-<?php echo $this->_tpl_vars['HeadDepartment']['stypename']; ?>
</h2>
	<div id="ex2" style="display:none;">
		<h2 id="form_title"><?php echo $this->_tpl_vars['Dict']['add_staff']; ?>
</h2>

    <form method="post" action="ajax.php?act=save_staff" name="StaffForm" id="StaffForm">
			<ul class="tabs-nav">
		    	<li class=""><a href="#tab-1" id="staftab1" rel="nofollow"><?php echo $this->_tpl_vars['Dict']['personal_info']; ?>
</a>
			    </li>
		    	<li class="tab-active"><a href="#tab-2" id="staftab2" rel="nofollow"><?php echo $this->_tpl_vars['Dict']['proffession_info']; ?>
</a>
		    	</li>
		    	<li class="tab-active"><a href="#tab-3"  id="staftab3" rel="nofollow"><?php echo $this->_tpl_vars['Dict']['mo_qt_info']; ?>
</a>
		    	</li>
			</ul>
			<div class="tabs-stage">
			    <div id="tab-1">
					<ul class="form-style-1">
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['s_lname']; ?>
:<span class="required">*</span></label>
					    	<input type="text" name="lastname" id="lastname" class="field-divided" />
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['s_fname']; ?>
: <span class="required">*</span></label>
					    	<input type="text" name="firstname" id="firstname" class="field-divided" />
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['s_sname']; ?>
: <span class="required">*</span></label>
					    	<input type="text" name="surname" id="surname" class="field-divided" />
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['birthdate']; ?>
: <span class="required">*</span></label>
					    	<input type="text" name="birthdate" id="birthdate" class="field-divided" />
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['nation']; ?>
: <span class="required">*</span></label>
					        <select name="nation" id="nation" class="field-divided">
						        <option value="0"><?php echo $this->_tpl_vars['Dict']['select']; ?>
</option>
						        <?php if (count($_from = (array)$this->_tpl_vars['Nations'])):
    foreach ($_from as $this->_tpl_vars['nkey'] => $this->_tpl_vars['Nation']):
?>
						        <option value="<?php echo $this->_tpl_vars['Nation']['id']; ?>
"><?php echo $this->_tpl_vars['Nation']['name']; ?>
</option>
					        <?php endforeach; unset($_from); endif; ?>
					        </select>
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['gender']; ?>
: <span class="required">*</span></label>
					        <select name="gender" id="gender" class="field-divided">
						        <option value="0"><?php echo $this->_tpl_vars['Dict']['select']; ?>
</option>
						        <?php if (count($_from = (array)$this->_tpl_vars['Genders'])):
    foreach ($_from as $this->_tpl_vars['nkey'] => $this->_tpl_vars['Gender']):
?>
						        <option value="<?php echo $this->_tpl_vars['Gender']['id']; ?>
"><?php echo $this->_tpl_vars['Gender']['name']; ?>
</option>
						        <?php endforeach; unset($_from); endif; ?>
					        </select>
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['passport_cer']; ?>
: <span class="required">*</span></label>
					    	<input type="text" name="passport_cer" id="passport_cer" class="field-divided" />
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['passport_num']; ?>
: <span class="required">*</span></label>
					    	<input type="text" name="passport_num" id="passport_num" class="field-divided" />
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['region']; ?>
: <span class="required">*</span></label>
					        <select name="region" id="region" class="field-divided">
						        <option value="0"><?php echo $this->_tpl_vars['Dict']['select']; ?>
</option>
						        <?php if (count($_from = (array)$this->_tpl_vars['Regions'])):
    foreach ($_from as $this->_tpl_vars['nkey'] => $this->_tpl_vars['Region']):
?>
						        <option value="<?php echo $this->_tpl_vars['Region']['id']; ?>
"><?php echo $this->_tpl_vars['Region']['name']; ?>
</option>
						        <?php endforeach; unset($_from); endif; ?>
					        </select>
					    </li>

					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['distcity']; ?>
: <span class="required">*</span></label>
					        <select name="distcity" id="distcity" class="field-divided">
						        <option value="0"><?php echo $this->_tpl_vars['Dict']['select']; ?>
</option>
					        </select>
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['email']; ?>
:</label>
					    	<input type="text" name="email" id="email" class="field-divided" />
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['phone']; ?>
: <span class="required">*</span></label>
					    	<input type="text" name="phone" id="phone" class="field-divided" />
					    </li>

					    <li>
					        <input type="button" class="myButton" id="SubNext1" value="<?php echo $this->_tpl_vars['Dict']['next']; ?>
" />
					    </li>
					</ul>
			    </div>
			    <div id="tab-2" style="display: block;">
			        <ul class="form-style-1">
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['grad_univer']; ?>
: <span class="required">*</span></label>
					        <select name="grad_univer" id="grad_univer" class="field-divided">
					        	<option value="0"><?php echo $this->_tpl_vars['Dict']['select']; ?>
</option>
						        <?php if (count($_from = (array)$this->_tpl_vars['Univers'])):
    foreach ($_from as $this->_tpl_vars['ukey'] => $this->_tpl_vars['Univer']):
?>
						        <option value="<?php echo $this->_tpl_vars['Univer']['id']; ?>
"><?php echo $this->_tpl_vars['Univer']['name']; ?>
</option>
						        <?php endforeach; unset($_from); endif; ?>
					        </select>
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['grad_univer_year']; ?>
: <span class="required">*</span></label>
					    	<input type="text" name="grad_univer_year" id="grad_univer_year" class="field-divided" />
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['dip_expertise']; ?>
: <span class="required">*</span></label>
					    	<input type="text" name="dip_expertise" id="dip_expertise" class="field-divided" />
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['dip_speciality']; ?>
: <span class="required">*</span></label>
					    	<input type="text" name="dip_speciality" id="dip_speciality" class="field-divided" />
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['dip_series']; ?>
: <span class="required">*</span></label>
					    	<input type="text" name="dip_series" id="dip_series" class="field-divided" />
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['dip_number']; ?>
: <span class="required">*</span></label>
					    	<input type="text" name="dip_number" id="dip_number" class="field-divided" />
					    </li>
					    					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['work_place_school']; ?>
: <span class="required">*</span></label>
					        <select name="work_place_school" id="work_place_school" class="field-divided">
					        <option value="0"><?php echo $this->_tpl_vars['Dict']['select']; ?>
</option>
						        <?php if (count($_from = (array)$this->_tpl_vars['Schools'])):
    foreach ($_from as $this->_tpl_vars['ukey'] => $this->_tpl_vars['TheSchool']):
?>
						        <option value="<?php echo $this->_tpl_vars['TheSchool']['id']; ?>
"<?php if ($this->_tpl_vars['TheSchool']['id'] == $this->_tpl_vars['HeadDepartment']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['TheSchool']['school_number']; ?>
-<?php echo $this->_tpl_vars['TheSchool']['school_type']; ?>
</option>
						        <?php endforeach; unset($_from); endif; ?>
					        </select>
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['position']; ?>
: <span class="required">*</span></label>
					        <select name="position" id="position" class="field-divided">
					        	<option value="0"><?php echo $this->_tpl_vars['Dict']['select']; ?>
</option>
						        <?php if (count($_from = (array)$this->_tpl_vars['Positions'])):
    foreach ($_from as $this->_tpl_vars['ukey'] => $this->_tpl_vars['Positions']):
?>
						        <option value="<?php echo $this->_tpl_vars['Positions']['id']; ?>
"><?php echo $this->_tpl_vars['Positions']['name']; ?>
</option>
						        <?php endforeach; unset($_from); endif; ?>
					        </select>
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['position_year']; ?>
: <span class="required">*</span></label>
					    	<input type="text" name="position_year" id="position_year" class="field-divided" />
					    </li>
					    <li>
					        <input type="button" class="myButton" id="SubNext2"  value="<?php echo $this->_tpl_vars['Dict']['next']; ?>
" />
					    </li>
					</ul>
			    </div>
			    <div id="tab-3" style="display: block;">
			        <ul class="form-style-1">
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['last_qual_place']; ?>
: </label>
					        <select name="last_qual_place" id="last_qual_place" class="field-divided">
					        	<option value="0"><?php echo $this->_tpl_vars['Dict']['select']; ?>
</option>
						        <?php if (count($_from = (array)$this->_tpl_vars['QualCenters'])):
    foreach ($_from as $this->_tpl_vars['ukey'] => $this->_tpl_vars['QualCenter']):
?>
						        <option value="<?php echo $this->_tpl_vars['QualCenter']['id']; ?>
"><?php echo $this->_tpl_vars['QualCenter']['name']; ?>
</option>
						        <?php endforeach; unset($_from); endif; ?>
					        </select>
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['last_qual_year']; ?>
: </label>
					    	<input type="text" name="last_qual_year" id="last_qual_year" class="field-divided" />
					    </li>

					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['mo_certificat_no']; ?>
: </label>
					    	<input type="text" name="mo_certificat_no" id="mo_certificat_no" class="field-divided" />
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['attestation_year']; ?>
: </label>
					    	<input type="text" name="attestation_year" id="attestation_year" class="field-divided" />
					    </li>

					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['attestation_result']; ?>
: </label>
					    	<input type="text" name="attestation_result" id="attestation_result" class="field-divided" />
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['attestation_category']; ?>
: </label>
					        <select name="attestation_category" id="attestation_category" class="field-divided">
					        	<option value="0"><?php echo $this->_tpl_vars['Dict']['select']; ?>
</option>
						        <?php if (count($_from = (array)$this->_tpl_vars['Classifications'])):
    foreach ($_from as $this->_tpl_vars['ckey'] => $this->_tpl_vars['Classification']):
?>
						        <option value="<?php echo $this->_tpl_vars['Classification']['id']; ?>
"><?php echo $this->_tpl_vars['Classification']['name']; ?>
</option>
						        <?php endforeach; unset($_from); endif; ?>
					        </select>
					    </li>

					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['retraining_vuz']; ?>
: </label>
					        <select name="retraining_vuz" id="retraining_vuz" class="field-divided">
					        	<option value="0"><?php echo $this->_tpl_vars['Dict']['select']; ?>
</option>
						        <?php if (count($_from = (array)$this->_tpl_vars['Univers'])):
    foreach ($_from as $this->_tpl_vars['ukey'] => $this->_tpl_vars['Univer']):
?>
						        <option value="<?php echo $this->_tpl_vars['Univer']['id']; ?>
"><?php echo $this->_tpl_vars['Univer']['name']; ?>
</option>
						        <?php endforeach; unset($_from); endif; ?>
					        </select>
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['retraining_year']; ?>
: </label>
					    	<input type="text" name="retraining_year" id="retraining_year" class="field-divided" />
					    </li>
					    <li>
					    	<label><?php echo $this->_tpl_vars['Dict']['retraining_dip_no']; ?>
:</label>
					    	<input type="text" name="retraining_dip_no" id="retraining_dip_no" class="field-divided" />
					    </li>
					    <li>
							<input type="hidden" value="" name="staffid" id="staffid">
							<input type="hidden" value="" name="formaction" id="formaction">
					        <input type="button" class="myButton" id="SubStaff"  value="<?php echo $this->_tpl_vars['Dict']['save']; ?>
" />
					        
					    </li>
					</ul>

			    </div>
			</div>
		</form>




  </div>
  <div id="ex4" style="display:none; background-color: red;">
    <form method="post" action="">
		<div>
				<h2><?php echo $this->_tpl_vars['Dict']['del_staff_info']; ?>
</h2>
				<div class="forms">
				<div><b><?php echo $this->_tpl_vars['Dict']['fullname']; ?>
:</b><input type="text" name="name" id="dname" value="" size="45"></div>
				</div>
				<div class="btnbox">
					<input type="hidden" value="" name="staffid" id="did">
					<input type="submit" name="SubDel" id="SubDel" value="<?php echo $this->_tpl_vars['Dict']['delete']; ?>
" class="myButton">
				</div>
		</div>
		</form>
  </div>

  <!-- Link to open the modal -->
	<?php if ($this->_tpl_vars['SysMessage'] != ""): ?>
	  <div class="alert-box <?php echo $this->_tpl_vars['MessType']; ?>
"><span><?php echo $this->_tpl_vars['SysMessage']; ?>
</span></div>
	<?php endif; ?>

  	<div class="actions">
		<a href="#ex2" rel="modal:open" class="myButton" id="AddButton"><?php echo $this->_tpl_vars['Dict']['add_staff']; ?>
</a>
	</div>

	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['thestaff']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['position']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['birthdate']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['grad_univer']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['dip_expertise']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['dip_speciality']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['last_qual_place']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['last_qual_year']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['mo_certificat_no']; ?>
</td>
			<td align="center"><img src="images/edit.png" width="24"></td>
			<td align="center"><img src="images/delete.png" width="24"></td>
		</tr>
		<?php if (count($_from = (array)$this->_tpl_vars['Students'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Student']):
?>
		<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFFFF,#E4EAF2"), $this);?>
"> 
			<td align="center"><?php echo $this->_tpl_vars['key']+1; ?>
</td>
			<td class="rank <?php echo $this->_tpl_vars['Student']['rank_class'];  if ($this->_tpl_vars['Student']['status'] == 2): ?> archived<?php endif; ?>">
				<?php echo $this->_tpl_vars['Student']['lastname']; ?>
 <?php echo $this->_tpl_vars['Student']['firstname']; ?>
 <?php echo $this->_tpl_vars['Student']['middlename']; ?>

			</td>
			<td><?php echo $this->_tpl_vars['Student']['position']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Student']['birthdate']; ?>
</td>
			<td><?php echo $this->_tpl_vars['Student']['grad_univer']; ?>
</td>
			<td><?php echo $this->_tpl_vars['Student']['dip_expertise']; ?>
</td>
			<td><?php echo $this->_tpl_vars['Student']['dip_speciality']; ?>
</td>
			<td><?php echo $this->_tpl_vars['Student']['qual_center']; ?>
</td>
			<td><?php echo $this->_tpl_vars['Student']['last_qual_year']; ?>
</td>
			<td><?php echo $this->_tpl_vars['Student']['mo_certificat_no']; ?>
</td>

			<td align="center">
				<?php if ($this->_tpl_vars['Access']['edit'] == '1'): ?>
				<a href="#ex2" rel="modal:open"><img rel="<?php echo ((is_array($_tmp=$this->_tpl_vars['Student']['id'])) ? $this->_run_mod_handler('crypt', true, $_tmp) : smarty_modifier_crypt($_tmp)); ?>
" class="editrow" src="images/edit.png" width="24"></a>
				<?php else: ?>
				<img src="images/edit.png" width="24" class="grayscale">
				<?php endif; ?>
			</td>

			<td align="center">
				<?php if ($this->_tpl_vars['Access']['del'] == '1'): ?>
				<a href="#ex4" rel="modal:open"><img rel="<?php echo ((is_array($_tmp=$this->_tpl_vars['Student']['id'])) ? $this->_run_mod_handler('crypt', true, $_tmp) : smarty_modifier_crypt($_tmp)); ?>
" class="deltrow" src="images/delete.png" width="24"></a>
				<?php else: ?>
				<img src="images/delete.png" width="24" class="grayscale">
				<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; unset($_from); endif; ?>
	</table>
	
	<div class="actions_left">

	</div>
	<?php if ($this->_tpl_vars['Access']['print'] == 1): ?>	
	<div id="printarea">
	</div>
	<?php endif; ?>
	
	<script src="js/staff.js"></script>
	<script>
		<?php echo '
		
		// From http://learn.shayhowe.com/advanced-html-css/jquery

		// Change tab class and display content
		$(\'.tabs-nav a\').on(\'click\', function (event) {
		    event.preventDefault();
		    
		    $(\'.tab-active\').removeClass(\'tab-active\');
		    $(this).parent().addClass(\'tab-active\');
		    $(\'.tabs-stage>div\').hide();
		    $($(this).attr(\'href\')).show();
		});

		$(\'#SubNext1\').on(\'click\', function (event) {
		   $(\'#staftab2\').click();
		});
		$(\'#SubNext2\').on(\'click\', function (event) {
		   $(\'#staftab3\').click();
		});

		/*function CheckNames(thisval)
		{
			return thisval.replace(/[^A-Z -\']/, "");
		}

		$(\'#lastname, #firstname, #surname\').bind(\'keyup\',function(){
			$(this).val(CheckNames($(this).val()));
		});

		$(\'#passport_cer\').bind(\'keyup\',function(){
			$(this).val($(this).val().replace(/[^A-Z]/, ""));
		});

		$(\'#passport_num\').bind(\'keyup\',function(){
			$(this).val($(this).val().replace(/[^0-9]/, ""));
		});*/


(function($)
{
	//$(\'#lastname, #firstname, #surname\').keyfilter(/[A-Za-z -]/);
	$(\'#lastname, #firstname, #surname\').keyfilter(/[A-Z` -]/);
	$(\'#passport_cer\').keyfilter(/[A-Z]/);
	$(\'#passport_num\').keyfilter(/[0-9]/);
})(jQuery);

		//var InputFields    = $(\':input\');
		/*$(\':input\').on(\'paste\', function() {
			alert($(this).val());
        },100);*/

		$(document).ready(function(){
		   $(\':input\').on("paste",function(e) {
		      e.preventDefault();
		   });
		});

		$("#birthdate").mask("99.99.9999");
		$("#phone").mask("+(99999)-9999999");
		$("#grad_univer_year").mask("9999");
		$("#position_year").mask("9999");
		$("#last_qual_year").mask("9999");
		$("#attestation_year").mask("9999");
		$("#retraining_year").mask("9999");

		$(\'.tabs-nav a:first\').trigger(\'click\'); // Default


		$("#region").change(function() {
			var RowId = $(this).val();
		    $.get("ajax.php?act=get_district&rid=" + RowId, function(html) {
		        $(\'#distcity\').html(html);
		    });
		});	

		var RowCount = 0;
		$(\'#ChekAll\').change(function() {
			var checkboxes = $(this).closest(\'table\').find(\'td\').find(\':checkbox\');
			if($(this).is(\':checked\')) {
					checkboxes.attr(\'checked\', \'checked\');
			} else {
					checkboxes.removeAttr(\'checked\');
			}
		});
	
		$(\'#AddButton\').click(function(event) {
			document.getElementById("StaffForm").reset();
			$(\'#SubStaff\').val("';  echo $this->_tpl_vars['Dict']['save'];  echo '");
			$(\'#form_title\').html("';  echo $this->_tpl_vars['Dict']['add_staff'];  echo '");
			$(\'#formaction\').val("add");
		});

		$(\'.editrow\').click(function(event) {
			var StudId = $(this).attr("rel");
			document.getElementById("StaffForm").reset();
			$(\'#SubStaff\').val("';  echo $this->_tpl_vars['Dict']['edit'];  echo '");
			$(\'#form_title\').html("';  echo $this->_tpl_vars['Dict']['edit_staff'];  echo '");
			$(\'#formaction\').val("edit");

			$.get("ajax.php?act=staff_info&sid=" + StudId, function(html) {
				var sInfo = html.split("<&sec&>");
				$(\'#staffid\').val(sInfo[30]);
				$(\'#lastname\').val(sInfo[1]);
				$(\'#firstname\').val(sInfo[2]);
				$(\'#surname\').val(sInfo[3]);
				$(\'#birthdate\').val(sInfo[4]);
				$(\'#nation\').val(sInfo[5]);
				$(\'#gender\').val(sInfo[6]);
				$(\'#passport_cer\').val(sInfo[7]);
				$(\'#passport_num\').val(sInfo[8]);
				$(\'#region\').val(sInfo[9]);
				$(\'#distcity\').html(sInfo[31]);

				$(\'#distcity\').val(sInfo[10]);
				$(\'#email\').val(sInfo[11]);
				$(\'#phone\').val(sInfo[12]);
				$(\'#grad_univer\').val(sInfo[13]);
				$(\'#grad_univer_year\').val(sInfo[14]);
				$(\'#dip_expertise\').val(sInfo[15]);
				$(\'#dip_speciality\').val(sInfo[16]);
				$(\'#dip_series\').val(sInfo[17]);
				$(\'#dip_number\').val(sInfo[18]);
				$(\'#work_place_school\').val(sInfo[19]);
				$(\'#position\').val(sInfo[20]);
				$(\'#position_year\').val(sInfo[21]);
				$(\'#last_qual_place\').val(sInfo[22]);
				$(\'#last_qual_year\').val(sInfo[23]);
				$(\'#mo_certificat_no\').val(sInfo[24]);
				if (sInfo[25] != 0)
				{
					$(\'#attestation_year\').val(sInfo[25]);
					$(\'#attestation_result\').val(sInfo[26]);
					$(\'#attestation_category\').val(sInfo[32]);
				}
				$(\'#retraining_vuz\').val(sInfo[27]);
				
				if (sInfo[28] != 0)
				{
					$(\'#retraining_year\').val(sInfo[28]);
					$(\'#retraining_dip_no\').val(sInfo[29]);
				}
			});
		});
		$(\'.deltrow\').click(function(event) {
			var StudId = $(this).attr("rel");
			$.get("ajax.php?act=staff_short_info&sid=" + StudId, function(html) {
				var sInfo = html.split("<&sec&>");

				$(\'#did\').val(sInfo[1]);
				$(\'#dname\').val($(\'<div/>\').html(sInfo[2]).text());
			});
		});		

		'; ?>

		</script>
	<?php endif; ?>

<?php if ($this->_tpl_vars['Action'] == 'student'): ?>
 <!-- Link to open the modal -->
  	<div align="left">
		<a href="groups.php?mid=DdFj" class="back">Sinflarga qaytish</a>
		<a href="students.php?act=students&gid=<?php echo $_GET['gid']; ?>
" class="back">O'quvchilar ro'yxati</a>
	</div> 
	<h4><?php echo $this->_tpl_vars['Group']['name']; ?>
</h4>
	<?php if ($this->_tpl_vars['SysMessage'] != ""): ?>
	  <div class="alert-box <?php echo $this->_tpl_vars['MessType']; ?>
"><span><?php echo $this->_tpl_vars['SysMessage']; ?>
</span></div>
	<?php endif; ?>

  	<div class="actions">
		<a href="" class="myButton">Yangilash</a>
	</div>

	<div align="center">
		<h2><?php echo $this->_tpl_vars['Student']; ?>
</h2>
	</div>

	<table width="100%">
		<tr>
			<td width="50%" valign="top">
				<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
					<tr class="titleth"> 
						<td align="center" width="30">#</td>
						<td align="center">O'tish vaqti</td>
						<td align="center">Kirish/chiqish</td>
						<td align="center">SMS</td>
					</tr>
					<?php if (count($_from = (array)$this->_tpl_vars['EnExArr'])):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['EnEx']):
?>
					<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFFFF,#E4EAF2"), $this);?>
"> 
						<td align="center"><?php echo $this->_tpl_vars['ekey']+1; ?>
</td>
						<td align="center"><?php echo $this->_tpl_vars['EnEx']['enex_date']; ?>
</td>
						<td align="center" width="30"><img src="images/enex<?php echo $this->_tpl_vars['EnEx']['enex_type']; ?>
.png" width="24"></td>
						<td><?php echo $this->_tpl_vars['EnEx']['status']; ?>
</td>
					</tr>
					<?php endforeach; unset($_from); endif; ?>
				</table>
			</td>
			<td width="50%" valign="top">
				<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
					<tr class="titleth"> 
						<td align="center" width="30">#</td>
						<td align="center">O'tish vaqti</td>
						<td align="center">Kirish/chiqish</td>
						<td align="center">SMS vaqti</td>
						<td align="center">Telefon</td>
						<td align="center">Status</td>
					</tr>
					<?php if (count($_from = (array)$this->_tpl_vars['SmsLog'])):
    foreach ($_from as $this->_tpl_vars['skey'] => $this->_tpl_vars['Log']):
?>
					<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFFFF,#E4EAF2"), $this);?>
"> 
						<td align="center"><?php echo $this->_tpl_vars['skey']+1; ?>
</td>
						<td align="center"><?php echo $this->_tpl_vars['Log']['enex_date']; ?>
</td>
						<td align="center" width="30"><img src="images/enex<?php echo $this->_tpl_vars['Log']['enex_type']; ?>
.png" width="24"></td>
						<td align="center"><?php echo $this->_tpl_vars['Log']['send_date']; ?>
</td>
						<td align="center"><?php echo $this->_tpl_vars['Log']['parent_phone']; ?>
</td>
						<td><?php echo $this->_tpl_vars['Log']['status']; ?>
</td>
					</tr>
					<?php endforeach; unset($_from); endif; ?>
				</table>
			</td>
		</tr>
	</table>
<?php endif; ?>

		
<?php if ($this->_tpl_vars['Action'] == 'search'): ?>
	<div id="ex2" style="display:none;">
    <form method="post" action="" name="addform">
		<div>
				<h2><?php echo $this->_tpl_vars['Dict']['search_staff']; ?>
</h2>
				<div class="forms">
				<label><?php echo $this->_tpl_vars['Dict']['lastname']; ?>
:</label><div><input type="text" name="lastname" id="lname" value="" size="20"></div>
				<label><?php echo $this->_tpl_vars['Dict']['firstname']; ?>
:</label><div><input type="text" name="firstname" id="fname" value="" size="20"></div>
				<label><?php echo $this->_tpl_vars['Dict']['surname']; ?>
:</label><div><input type="text" name="surname" id="sname" value="" size="20"></div>
				<label><?php echo $this->_tpl_vars['Dict']['passport_cer']; ?>
:</label><div><input type="text" name="passport_cer" maxlength="10" id="passport_cer" value="" size="20"></div>
				<label><?php echo $this->_tpl_vars['Dict']['passport_num']; ?>
:</label><div><input type="text" name="passport_num" id="passport_num" value="" size="20"></div>
				</div>
				<div class="btnbox">
					<input type="submit" name="SubSearch" value="Izla" class="myButton">
				</div>
		</div>
		</form>
  </div>
 
  <!-- Link to open the modal -->
  <?php if ($this->_tpl_vars['SysMessage'] != ""): ?>
  <div class="alert-box <?php echo $this->_tpl_vars['MessType']; ?>
"><span><?php echo $this->_tpl_vars['SysMessage']; ?>
</span></div>
  <?php endif; ?>

  <div class="actions">
		<a href="#ex2" rel="modal:open" class="myButton" id="AddButton">Izlash</a>
	</div>
	<!-- <div class="info_type">
		<?php $this->assign('keyword', "bybase".($this->_tpl_vars['StaffSett'])); ?>
		<?php echo $this->_tpl_vars['Dict'][$this->_tpl_vars['keyword']]; ?>

	</div> -->
	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['thestaff']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['position']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['birthdate']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['grad_univer']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['dip_expertise']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['dip_speciality']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['last_qual_place']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['last_qual_year']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Dict']['mo_certificat_no']; ?>
</td>
		</tr>
		<?php if (count($_from = (array)$this->_tpl_vars['Students'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Student']):
?>
		<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFFFF,#E4EAF2"), $this);?>
"> 
			<td align="center"><?php echo $this->_tpl_vars['key']+1; ?>
</td>
			<td class="rank <?php echo $this->_tpl_vars['Student']['rank_class'];  if ($this->_tpl_vars['Student']['status'] == 2): ?> archived<?php endif; ?>">
				<a href="staff.php?act=staff&did=<?php echo ((is_array($_tmp=$this->_tpl_vars['Student']['work_place_school'])) ? $this->_run_mod_handler('crypt', true, $_tmp) : smarty_modifier_crypt($_tmp)); ?>
"><?php echo $this->_tpl_vars['Student']['lastname']; ?>
 <?php echo $this->_tpl_vars['Student']['firstname']; ?>
 <?php echo $this->_tpl_vars['Student']['middlename']; ?>
</a>
			</td>
			<td><?php echo $this->_tpl_vars['Student']['position']; ?>
</td>
			<td align="center"><?php echo $this->_tpl_vars['Student']['birthdate']; ?>
</td>
			<td><?php echo $this->_tpl_vars['Student']['grad_univer']; ?>
</td>
			<td><?php echo $this->_tpl_vars['Student']['dip_expertise']; ?>
</td>
			<td><?php echo $this->_tpl_vars['Student']['dip_speciality']; ?>
</td>
			<td><?php echo $this->_tpl_vars['Student']['qual_center']; ?>
</td>
			<td><?php echo $this->_tpl_vars['Student']['last_qual_year']; ?>
</td>
			<td><?php echo $this->_tpl_vars['Student']['mo_certificat_no']; ?>
</td>
		</tr>
		<?php endforeach; unset($_from); endif; ?>
	</table>
	
	<?php endif; ?>	


	<?php if ($this->_tpl_vars['Action'] == 'import'): ?>
  <div align="left">
			<a href="tests.php?act=groups" class="back">Ñèíîâëàðãà êàéòèø</a>
			<a href="staff.php?act=students&gid=<?php echo $this->_tpl_vars['GroupId']; ?>
" class="back">Õîäèìëàð ðóéõàòè</a>
	</div> 
		<?php if ($_GET['step'] == ""): ?>
		<form action="staff.php?act=import&gid=<?php echo $this->_tpl_vars['GroupId']; ?>
&step=2" method="post">
			<table align="center" bgcolor="#f9f9f9" border="0" width="800" cellpadding="3" cellspacing="0">
				<tbody><tr>
					<td colspan="2" align="center" bgcolor="#f9f9f9"><b>Õîäèìëàðíè èìïîðò êèëèø</b></td>
				</tr>
				<tr>
					<td><br>
					</td>
				</tr>
				<tr>
					<td>
					<table cellpadding="2" cellspacing="1" border="0" width="100%" bgcolor="74BA08">
					<?php $this->assign('OddRow', 'D3E5B8'); ?>
					<?php $this->assign('EvnRow', 'FFFFFF'); ?>
					
					<?php $this->assign('MenName', 'erkak'); ?>
					<?php $this->assign('WomanName', 'ayol'); ?>
					
					<?php $this->assign('RowColor', ""); ?>
					<?php if (count($_from = (array)$this->_tpl_vars['FileContent'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Content']):
?>
							<?php if ($this->_tpl_vars['Content']['0'] == 'ID_MAP'): ?>
							<tr bgcolor="FFFFFF">
								<td width="15">
								<input type="hidden" name="" value="4">
								<input type="checkbox" name="">
								</td>
								<td width="30" align="right"><b>0.</b></td>
									<td>ID_MAP</td>
									<td>ID_ POSITION</td>
									<td>ID_ RANG</td>
									<td>ID_ NATION</td>
									<td>ID_ FAMILY</td>
									<td>ID_ EDUCATION</td>
									<td>ID_ STATUS</td>
									<td>YEAR BIRTH</td>
									<td>IN_ ORGAN</td>
									<td>Ô.È.Ø.</td>
									<td>Æèíñè</td>
								</tr>
							<?php else: ?>
							<tr bgcolor="<?php echo smarty_function_cycle(array('values' => ($this->_tpl_vars['EvnRow']).",".($this->_tpl_vars['OddRow'])), $this);?>
">
								<td width="15">
								<input type="hidden" name="id_map[<?php echo $this->_tpl_vars['key']; ?>
]" value="<?php echo $this->_tpl_vars['Content']['0']; ?>
">
								<input type="checkbox" name="ColCb[<?php echo $this->_tpl_vars['key']; ?>
]" checked>
								</td>

								<td width="30" align="right"><b><?php echo $this->_tpl_vars['key']; ?>
.</b></td>
								<td width="30" align="right"><b><?php echo $this->_tpl_vars['Content']['0']; ?>
</b></td>
								<td>
								<select name="position_id[<?php echo $this->_tpl_vars['key']; ?>
]" style="width: 130px;">
									<?php if (count($_from = (array)$this->_tpl_vars['Positions'])):
    foreach ($_from as $this->_tpl_vars['pkey'] => $this->_tpl_vars['Position']):
?>
										<option value="<?php echo $this->_tpl_vars['Position']['id']; ?>
"<?php if ($this->_tpl_vars['Content']['1'] == $this->_tpl_vars['Position']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Position']['name']; ?>
</option>
									<?php endforeach; unset($_from); endif; ?>
								</select>
								</td>
								<td>
								<select name="rang_id[<?php echo $this->_tpl_vars['key']; ?>
]" style="width: 80px;">
									<?php if (count($_from = (array)$this->_tpl_vars['Ranks'])):
    foreach ($_from as $this->_tpl_vars['rkey'] => $this->_tpl_vars['Rank']):
?>
										<option value="<?php echo $this->_tpl_vars['Rank']['id']; ?>
"<?php if ($this->_tpl_vars['Content']['2'] == $this->_tpl_vars['Rank']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Rank']['name']; ?>
</option>
									<?php endforeach; unset($_from); endif; ?>
								</select>
								</td>
								<td>
								<select name="nation_id[<?php echo $this->_tpl_vars['key']; ?>
]" style="width: 50px;">
									<?php if (count($_from = (array)$this->_tpl_vars['Nations'])):
    foreach ($_from as $this->_tpl_vars['rkey'] => $this->_tpl_vars['Nation']):
?>
										<option value="<?php echo $this->_tpl_vars['Nation']['id']; ?>
"<?php if ($this->_tpl_vars['Content']['3'] == $this->_tpl_vars['Nation']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Nation']['name']; ?>
</option>
									<?php endforeach; unset($_from); endif; ?>
								</select>
								</td>
								<td>
								<select name="family_status_id[<?php echo $this->_tpl_vars['key']; ?>
]" style="width: 80px;">
									<?php if (count($_from = (array)$this->_tpl_vars['FamilyStatuses'])):
    foreach ($_from as $this->_tpl_vars['rkey'] => $this->_tpl_vars['Fstatus']):
?>
										<option value="<?php echo $this->_tpl_vars['Fstatus']['id']; ?>
"<?php if ($this->_tpl_vars['Content']['4'] == $this->_tpl_vars['Fstatus']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Fstatus']['name']; ?>
</option>
									<?php endforeach; unset($_from); endif; ?>
								</select>
								</td>
								<td>
								<select name="education_id[<?php echo $this->_tpl_vars['key']; ?>
]" style="width: 80px;">
									<?php if (count($_from = (array)$this->_tpl_vars['Educations'])):
    foreach ($_from as $this->_tpl_vars['rkey'] => $this->_tpl_vars['Education']):
?>
										<option value="<?php echo $this->_tpl_vars['Education']['id']; ?>
"<?php if ($this->_tpl_vars['Content']['5'] == $this->_tpl_vars['Education']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Education']['name']; ?>
</option>
									<?php endforeach; unset($_from); endif; ?>
								</select>
								</td>
								<td>
								<select name="status_id[<?php echo $this->_tpl_vars['key']; ?>
]" style="width: 80px;">
									<?php if (count($_from = (array)$this->_tpl_vars['Statuses'])):
    foreach ($_from as $this->_tpl_vars['rkey'] => $this->_tpl_vars['Status']):
?>
										<option value="<?php echo $this->_tpl_vars['Status']['id']; ?>
"<?php if ($this->_tpl_vars['Content']['6'] == $this->_tpl_vars['Status']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Status']['name']; ?>
</option>
									<?php endforeach; unset($_from); endif; ?>
								</select>
								</td>
								<td>
								<textarea class="Area<?php echo $this->_tpl_vars['Content']['odd_even']; ?>
" rows="1" name="birth_year[<?php echo $this->_tpl_vars['key']; ?>
]" cols="4"><?php echo $this->_tpl_vars['Content']['7']; ?>
</textarea>
								</td>
								<td>
								<textarea class="Area<?php echo $this->_tpl_vars['Content']['odd_even']; ?>
" rows="1" name="in_year[<?php echo $this->_tpl_vars['key']; ?>
]" cols="4"><?php echo $this->_tpl_vars['Content']['8']; ?>
</textarea>
								</td>
								<td>
								<textarea class="Area<?php echo $this->_tpl_vars['Content']['odd_even']; ?>
" rows="1" name="name[<?php echo $this->_tpl_vars['key']; ?>
]" cols="25"><?php echo $this->_tpl_vars['Content']['9']; ?>
</textarea>
								</td>
								<td>
								<select name="gender[<?php echo $this->_tpl_vars['key']; ?>
]" style="width: 80px;">
									<?php if (count($_from = (array)$this->_tpl_vars['Genders'])):
    foreach ($_from as $this->_tpl_vars['rkey'] => $this->_tpl_vars['Gender']):
?>
										<option value="<?php echo $this->_tpl_vars['Gender']['id']; ?>
"<?php if ($this->_tpl_vars['Content']['10'] == $this->_tpl_vars['Gender']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Gender']['name']; ?>
</option>
									<?php endforeach; unset($_from); endif; ?>
								</select>
								</td>
							</tr>
							<?php endif; ?>
						<?php endforeach; unset($_from); endif; ?>
					</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input value="Êåéèíãè" name="insert_faculty" class="ButtonYellow" type="submit"><br><br></td>
				</tr>						
			</tbody>
		</table>
		</form>
		<?php else: ?>
		<table align="center" bgcolor="#f9f9f9" border="0" width="800" cellpadding="3" cellspacing="0">
						<tbody><tr>
							<td colspan="2" align="center" bgcolor="#f9f9f9"><b>KOLLEDJ XAQIDAGI MA"LUMOTLARNI IMPORT QILISH</b></td>
						</tr>
						<tr>
							<td><br>
							</td>
						</tr>
						<tr>
							<td>
							<table cellpadding="4" cellspacing="1" border="0" width="100%" bgcolor="74BA08">
							<?php $this->assign('OddRow', 'D3E5B8'); ?>
							<?php $this->assign('EvnRow', 'FFFFFF'); ?>
							<?php $this->assign('RowColor', ""); ?>
							<?php if (count($_from = (array)$this->_tpl_vars['ContentArr'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Content']):
?>
								<tr bgcolor="<?php echo smarty_function_cycle(array('values' => ($this->_tpl_vars['EvnRow']).",".($this->_tpl_vars['OddRow'])), $this);?>
">
									<td width="30" align="right"><b><?php echo $this->_tpl_vars['key']+1; ?>
.</b></td>
									<td>
									<?php echo $this->_tpl_vars['Content']['0']; ?>

									</td>
									<td width="15"><b><?php echo $this->_tpl_vars['Content']['2']; ?>
</b></td>
								</tr>
								<?php endforeach; unset($_from); endif; ?>
							</table>
							</td>
						</tr>
					</tbody></table>
		<?php endif; ?>				
	<?php endif; ?>

	<!-- ______________________IMPOST-STAFF______________________ -->
	<?php if ($this->_tpl_vars['Action'] == 'import_staff'): ?>
  <div align="left">
			<a href="tests.php?act=groups" class="back">Ñèíîâëàðãà êàéòèø</a>
			<a href="staff.php?act=students&gid=<?php echo $this->_tpl_vars['GroupId']; ?>
" class="back">Õîäèìëàð ðóéõàòè</a>
	</div> 
		<?php if ($_GET['step'] == ""): ?>
		<form action="staff.php?act=import_staff&gid=<?php echo $this->_tpl_vars['GroupId']; ?>
&step=2" method="post">
			<table align="center" bgcolor="#f9f9f9" border="0" width="800" cellpadding="3" cellspacing="0">
				<tbody><tr>
					<td colspan="2" align="center" bgcolor="#f9f9f9"><b>Õîäèìëàðíè òàõðèðëàø</b></td>
				</tr>
				<tr>
					<td><br>
					</td>
				</tr>
				<tr>
					<td>
					<table cellpadding="2" cellspacing="1" border="0" width="100%" bgcolor="74BA08">
					<?php $this->assign('OddRow', 'D3E5B8'); ?>
					<?php $this->assign('EvnRow', 'FFFFFF'); ?>
					
					<?php $this->assign('MenName', 'erkak'); ?>
					<?php $this->assign('WomanName', 'ayol'); ?>
					
					<?php $this->assign('RowColor', ""); ?>
					<?php if (count($_from = (array)$this->_tpl_vars['FileContent'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Content']):
?>
							<?php if ($this->_tpl_vars['Content']['0'] == 'ID_MAP'): ?>
							<tr bgcolor="FFFFFF">
								<td width="15">
								<input type="hidden" name="" value="4">
								<input type="checkbox" name="">
								</td>
								<td width="30" align="right"><b>0.</b></td>
									<td>ID_MAP</td>
									<td>ID_ POSITION</td>
									<td>ID_ RANG</td>
									<td>ID_ NATION</td>
									<td>ID_ FAMILY</td>
									<td>ID_ EDUCATION</td>
									<td>ID_ STATUS</td>
									<td>YEAR BIRTH</td>
									<td>IN_ ORGAN</td>
									<td>Ô.È.Ø.</td>
									<td>Æèíñè</td>
								</tr>
							<?php else: ?>
							<tr <?php if ($this->_tpl_vars['StaffExit'][$this->_tpl_vars['key']] != 1): ?>bgcolor="red"<?php else: ?>bgcolor="<?php echo smarty_function_cycle(array('values' => ($this->_tpl_vars['EvnRow']).",".($this->_tpl_vars['OddRow'])), $this);?>
"<?php endif; ?>>
								<td width="15">
								<input type="hidden" name="id_map[<?php echo $this->_tpl_vars['key']; ?>
]" value="<?php echo $this->_tpl_vars['Content']['0']; ?>
">
								<input type="checkbox" name="ColCb[<?php echo $this->_tpl_vars['key']; ?>
]" <?php if ($this->_tpl_vars['StaffExit'][$this->_tpl_vars['key']] == 1): ?> checked<?php endif; ?>>
								</td>

								<td width="30" align="right"><b><?php echo $this->_tpl_vars['key']; ?>
.</b></td>
								<td width="30" align="right"><b><?php echo $this->_tpl_vars['Content']['0']; ?>
</b></td>
								<td>
								<select name="position_id[<?php echo $this->_tpl_vars['key']; ?>
]" style="width: 130px;">
									<?php if (count($_from = (array)$this->_tpl_vars['Positions'])):
    foreach ($_from as $this->_tpl_vars['pkey'] => $this->_tpl_vars['Position']):
?>
										<option value="<?php echo $this->_tpl_vars['Position']['id']; ?>
"<?php if ($this->_tpl_vars['Content']['1'] == $this->_tpl_vars['Position']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Position']['name']; ?>
</option>
									<?php endforeach; unset($_from); endif; ?>
								</select>
								</td>
								<td>
								<select name="rang_id[<?php echo $this->_tpl_vars['key']; ?>
]" style="width: 80px;">
									<?php if (count($_from = (array)$this->_tpl_vars['Ranks'])):
    foreach ($_from as $this->_tpl_vars['rkey'] => $this->_tpl_vars['Rank']):
?>
										<option value="<?php echo $this->_tpl_vars['Rank']['id']; ?>
"<?php if ($this->_tpl_vars['Content']['2'] == $this->_tpl_vars['Rank']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Rank']['name']; ?>
</option>
									<?php endforeach; unset($_from); endif; ?>
								</select>
								</td>
								<td>
								<select name="nation_id[<?php echo $this->_tpl_vars['key']; ?>
]" style="width: 50px;">
									<?php if (count($_from = (array)$this->_tpl_vars['Nations'])):
    foreach ($_from as $this->_tpl_vars['rkey'] => $this->_tpl_vars['Nation']):
?>
										<option value="<?php echo $this->_tpl_vars['Nation']['id']; ?>
"<?php if ($this->_tpl_vars['Content']['3'] == $this->_tpl_vars['Nation']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Nation']['name']; ?>
</option>
									<?php endforeach; unset($_from); endif; ?>
								</select>
								</td>
								<td>
								<select name="family_status_id[<?php echo $this->_tpl_vars['key']; ?>
]" style="width: 80px;">
									<?php if (count($_from = (array)$this->_tpl_vars['FamilyStatuses'])):
    foreach ($_from as $this->_tpl_vars['rkey'] => $this->_tpl_vars['Fstatus']):
?>
										<option value="<?php echo $this->_tpl_vars['Fstatus']['id']; ?>
"<?php if ($this->_tpl_vars['Content']['4'] == $this->_tpl_vars['Fstatus']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Fstatus']['name']; ?>
</option>
									<?php endforeach; unset($_from); endif; ?>
								</select>
								</td>
								<td>
								<select name="education_id[<?php echo $this->_tpl_vars['key']; ?>
]" style="width: 80px;">
									<?php if (count($_from = (array)$this->_tpl_vars['Educations'])):
    foreach ($_from as $this->_tpl_vars['rkey'] => $this->_tpl_vars['Education']):
?>
										<option value="<?php echo $this->_tpl_vars['Education']['id']; ?>
"<?php if ($this->_tpl_vars['Content']['5'] == $this->_tpl_vars['Education']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Education']['name']; ?>
</option>
									<?php endforeach; unset($_from); endif; ?>
								</select>
								</td>
								<td>
								<select name="status_id[<?php echo $this->_tpl_vars['key']; ?>
]" style="width: 80px;">
									<?php if (count($_from = (array)$this->_tpl_vars['Statuses'])):
    foreach ($_from as $this->_tpl_vars['rkey'] => $this->_tpl_vars['Status']):
?>
										<option value="<?php echo $this->_tpl_vars['Status']['id']; ?>
"<?php if ($this->_tpl_vars['Content']['6'] == $this->_tpl_vars['Status']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Status']['name']; ?>
</option>
									<?php endforeach; unset($_from); endif; ?>
								</select>
								</td>
								<td>
								<textarea class="Area<?php echo $this->_tpl_vars['Content']['odd_even']; ?>
" rows="1" name="birth_year[<?php echo $this->_tpl_vars['key']; ?>
]" cols="4"><?php echo $this->_tpl_vars['Content']['7']; ?>
</textarea>
								</td>
								<td>
								<textarea class="Area<?php echo $this->_tpl_vars['Content']['odd_even']; ?>
" rows="1" name="in_year[<?php echo $this->_tpl_vars['key']; ?>
]" cols="4"><?php echo $this->_tpl_vars['Content']['8']; ?>
</textarea>
								</td>
								<td>&nbsp;<span style="font-size: 12px; padding-left: 1px;"><?php echo $this->_tpl_vars['Content']['9']; ?>
</span>
								<?php if ($this->_tpl_vars['StaffExit'][$this->_tpl_vars['key']] == 1): ?>
								<select name="staff[<?php echo $this->_tpl_vars['key']; ?>
]" style="width: 250px;">
									<?php if (count($_from = (array)$this->_tpl_vars['StaffOption'][$this->_tpl_vars['key']])):
    foreach ($_from as $this->_tpl_vars['fkey'] => $this->_tpl_vars['Sttff']):
?>
										<option value="<?php echo $this->_tpl_vars['Sttff']['id']; ?>
"><?php echo $this->_tpl_vars['Sttff']['name']; ?>
</option>
									<?php endforeach; unset($_from); endif; ?>
								</select>
								<?php else: ?>
								<select name="staff[<?php echo $this->_tpl_vars['key']; ?>
]" style="width: 250px;">
									<?php if (count($_from = (array)$this->_tpl_vars['StaffOptionLow'][$this->_tpl_vars['key']])):
    foreach ($_from as $this->_tpl_vars['fkey'] => $this->_tpl_vars['Sttff']):
?>
										<option value="<?php echo $this->_tpl_vars['Sttff']['id']; ?>
"><?php echo $this->_tpl_vars['Sttff']['name']; ?>
</option>
									<?php endforeach; unset($_from); endif; ?>
								</select>
								<?php endif; ?>
								<textarea class="Area<?php echo $this->_tpl_vars['Content']['odd_even']; ?>
" rows="1" name="staff_name[<?php echo $this->_tpl_vars['key']; ?>
]" cols="4"><?php echo $this->_tpl_vars['Content']['9']; ?>
</textarea>
								</td>
								<td>
								<select name="gender[<?php echo $this->_tpl_vars['key']; ?>
]" style="width: 80px;">
									<?php if (count($_from = (array)$this->_tpl_vars['Genders'])):
    foreach ($_from as $this->_tpl_vars['rkey'] => $this->_tpl_vars['Gender']):
?>
										<option value="<?php echo $this->_tpl_vars['Gender']['id']; ?>
"<?php if ($this->_tpl_vars['Content']['10'] == $this->_tpl_vars['Gender']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Gender']['name']; ?>
</option>
									<?php endforeach; unset($_from); endif; ?>
								</select>
								</td>
							</tr>
							<?php endif; ?>
						<?php endforeach; unset($_from); endif; ?>
					</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input value="Êåéèíãè" name="insert_faculty" class="ButtonYellow" type="submit"><br><br></td>
				</tr>						
			</tbody>
		</table>
		</form>
		<?php else: ?>
		<table align="center" bgcolor="#f9f9f9" border="0" width="800" cellpadding="3" cellspacing="0">
						<tbody><tr>
							<td colspan="2" align="center" bgcolor="#f9f9f9"><b>KOLLEDJ XAQIDAGI MA"LUMOTLARNI IMPORT QILISH</b></td>
						</tr>
						<tr>
							<td><br>
							</td>
						</tr>
						<tr>
							<td>
							<table cellpadding="4" cellspacing="1" border="0" width="100%" bgcolor="74BA08">
							<?php $this->assign('OddRow', 'D3E5B8'); ?>
							<?php $this->assign('EvnRow', 'FFFFFF'); ?>
							<?php $this->assign('RowColor', ""); ?>
							<?php if (count($_from = (array)$this->_tpl_vars['ContentArr'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Content']):
?>
								<tr bgcolor="<?php echo smarty_function_cycle(array('values' => ($this->_tpl_vars['EvnRow']).",".($this->_tpl_vars['OddRow'])), $this);?>
">
									<td width="30" align="right"><b><?php echo $this->_tpl_vars['key']+1; ?>
.</b></td>
									<td>
									<?php echo $this->_tpl_vars['Content']['0']; ?>

									</td>
									<td width="15"><b><?php echo $this->_tpl_vars['Content']['2']; ?>
</b></td>
								</tr>
								<?php endforeach; unset($_from); endif; ?>
							</table>
							</td>
						</tr>
					</tbody></table>
		<?php endif; ?>				
	<?php endif; ?>
	<!-- ______________________IMPOST-STAFF______________________ -->

<?php echo $this->_tpl_vars['bottom']; ?>