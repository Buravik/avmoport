<?php /* Smarty version 2.6.5-dev, created on 2018-05-07 23:16:06
         compiled from reports.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'reports.tpl', 86, false),array('modifier', 'crypt', 'reports.tpl', 89, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "base.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <div id="ex1" style="display:none;">
    <form method="post" action="" name="FormParam">
		<div>
				<h2><?php echo $this->_tpl_vars['Dict']['change_report_params']; ?>
</h2>
				<div class="forms">
				<div>
						<?php echo $this->_tpl_vars['Dict']['begin']; ?>
: <input type=text value="<?php echo $this->_tpl_vars['ReportParams']['bdate2']; ?>
" name=bdate maxlength=10 size=10 id='bdate'>&nbsp;
						<?php echo '
						<script>new tcal ({\'formname\': \'FormParam\',\'controlname\': \'bdate\'});</script>
						'; ?>

						<?php echo $this->_tpl_vars['Dict']['begin']; ?>
: <input type=text value="<?php echo $this->_tpl_vars['ReportParams']['edate2']; ?>
" name=edate maxlength=10 size=10 id='edate'>&nbsp;
						<?php echo '
						<script>new tcal ({\'formname\': \'FormParam\',\'controlname\': \'edate\'});</script>
						'; ?>

				</div>
				<div>
						<?php echo $this->_tpl_vars['Dict']['subject']; ?>
 1:
						<select name="subject1">
								<option value=0><?php echo $this->_tpl_vars['Dict']['select']; ?>
</option>
								<?php if (count($_from = (array)$this->_tpl_vars['Subjects'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Subject']):
?>
								<option value="<?php echo $this->_tpl_vars['Subject']['id']; ?>
"<?php if ($this->_tpl_vars['ReportParams']['subject1'] == $this->_tpl_vars['Subject']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Subject']['sname']; ?>
</option>
								<?php endforeach; unset($_from); endif; ?>
						</select>
				</div>
				<div>
						<?php echo $this->_tpl_vars['Dict']['subject']; ?>
 2:
						<select name="subject2">
								<option value=0><?php echo $this->_tpl_vars['Dict']['select']; ?>
</option>
								<?php if (count($_from = (array)$this->_tpl_vars['Subjects'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Subject']):
?>
								<option value="<?php echo $this->_tpl_vars['Subject']['id']; ?>
"<?php if ($this->_tpl_vars['ReportParams']['subject2'] == $this->_tpl_vars['Subject']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Subject']['sname']; ?>
</option>
								<?php endforeach; unset($_from); endif; ?>
						</select>
				</div>
				<div>
						<?php echo $this->_tpl_vars['Dict']['subject']; ?>
 3:
						<select name="subject3">
								<option value=0><?php echo $this->_tpl_vars['Dict']['select']; ?>
</option>
								<?php if (count($_from = (array)$this->_tpl_vars['Subjects'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Subject']):
?>
								<option value="<?php echo $this->_tpl_vars['Subject']['id']; ?>
"<?php if ($this->_tpl_vars['ReportParams']['subject3'] == $this->_tpl_vars['Subject']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Subject']['sname']; ?>
</option>
								<?php endforeach; unset($_from); endif; ?>
						</select>
				</div>
				</div>
				<div class="btnbox">
					<input type="submit" name="SubForm" value="<?php echo $this->_tpl_vars['Dict']['save']; ?>
" class="myButton">
				</div>
		</div>
		</form>
  </div>

	<div class="actions_left" style="display: none">
	<a id="pbutton" class="myButton"><?php echo $this->_tpl_vars['Dict']['print']; ?>
</a>
	<a href="#ex1" rel="modal:open" class="myButton"><?php echo $this->_tpl_vars['Dict']['params']; ?>
</a>
	</div>
	<div id="printarea">

  <div class="headnamebox">
  <div class="headnames">Maktablar ma'lumoti</div>
  </div>
<?php if ($this->_tpl_vars['Action'] == 'rep1' || $this->_tpl_vars['Action'] == 'rep2'): ?>
<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
		<tr class="titleth"> 
			<td colspan="2">&nbsp;</td>
	      	<?php if (count($_from = (array)$this->_tpl_vars['SchoolTypes'])):
    foreach ($_from as $this->_tpl_vars['skey'] => $this->_tpl_vars['sType']):
?>
		      	<td align="center" colspan="8"><?php echo $this->_tpl_vars['sType']['sname']; ?>
</td>
	      	<?php endforeach; unset($_from); endif; ?>
			<td align="center" colspan="2">Jami</td>
      	</tr>
      	<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center" class="border-green">Xudud</td>
      		<?php if (count($_from = (array)$this->_tpl_vars['SchoolTypes'])):
    foreach ($_from as $this->_tpl_vars['skey'] => $this->_tpl_vars['sType']):
?>
	      	<?php if (count($_from = (array)$this->_tpl_vars['Positions'])):
    foreach ($_from as $this->_tpl_vars['pkey'] => $this->_tpl_vars['Position']):
?>
		      	<th class="rotate"><div><span><?php echo $this->_tpl_vars['Position']['sname']; ?>
</span></div></th>
	      	<?php endforeach; unset($_from); endif; ?>
	      	<th class="rotate border-purple"><div><span>Maktablar</span></div></th>
	      	<th class="rotate border-red"><div><span>Xodimlar</span></div></th>
	      	<?php endforeach; unset($_from); endif; ?>
	      	<th class="rotate"><div><span>Maktablar</span></div></th>
	      	<th class="rotate"><div><span>Xodimlar</span></div></th>
      	</tr>
      	<?php $this->assign('TotalSchools', 0); ?>	
      	<?php $this->assign('TotalStaff', 0); ?>	
      	<?php if (count($_from = (array)$this->_tpl_vars['Results1'])):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['Result1']):
?>
      	<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFFFF,#E4EAF2"), $this);?>
"> 
			<td><?php echo $this->_tpl_vars['key1']; ?>
</td>	
			<?php if ($this->_tpl_vars['Action'] == 'rep1'): ?>
			<td class="border-green"><a href="reports.php?act=rep2&rid=<?php echo ((is_array($_tmp=$this->_tpl_vars['key1'])) ? $this->_run_mod_handler('crypt', true, $_tmp) : smarty_modifier_crypt($_tmp)); ?>
&mid=HssItt"><?php echo $this->_tpl_vars['Result1']['0']; ?>
</a></td>
			<?php else: ?>
			<td class="border-green"><a href="reports.php?act=rep3&dcid=<?php echo ((is_array($_tmp=$this->_tpl_vars['key1'])) ? $this->_run_mod_handler('crypt', true, $_tmp) : smarty_modifier_crypt($_tmp)); ?>
"><?php echo $this->_tpl_vars['Result1']['0']; ?>
</a></td>
			<?php endif; ?>
			<?php if (count($_from = (array)$this->_tpl_vars['SchoolTypes'])):
    foreach ($_from as $this->_tpl_vars['skey'] => $this->_tpl_vars['sType']):
?>
				<?php $this->assign('stype', $this->_tpl_vars['sType']['id']); ?>
		      	<?php if (count($_from = (array)$this->_tpl_vars['Positions'])):
    foreach ($_from as $this->_tpl_vars['pkey'] => $this->_tpl_vars['Position']):
?>
					<?php $this->assign('ptype', $this->_tpl_vars['Position']['id']); ?>
			      	<td class="scounts">
			      		<?php echo $this->_tpl_vars['Results3'][$this->_tpl_vars['key1']][$this->_tpl_vars['stype']][$this->_tpl_vars['ptype']]; ?>

			      	</td>
		      	<?php endforeach; unset($_from); endif; ?>
		      	<td class="scounts black border-purple">
		      		<?php echo $this->_tpl_vars['Schools'][$this->_tpl_vars['key1']][$this->_tpl_vars['stype']]; ?>

		      	</td>
		      	<td class="scounts black  border-red">
		      		<?php echo $this->_tpl_vars['Results2'][$this->_tpl_vars['key1']][$this->_tpl_vars['stype']]; ?>

		      	</td>
			    <?php $this->assign('TotalSchools', $this->_tpl_vars['TotalSchools']+$this->_tpl_vars['Schools'][$this->_tpl_vars['key1']][$this->_tpl_vars['stype']]); ?>	
		      	<?php $this->assign('TotalStaff', $this->_tpl_vars['TotalStaff']+$this->_tpl_vars['Results2'][$this->_tpl_vars['key1']][$this->_tpl_vars['stype']]); ?>	
	      	<?php endforeach; unset($_from); endif; ?>	
	      	<td class="scounts black"><?php echo $this->_tpl_vars['Result1']['2']; ?>
</td>
	      	<td class="scounts black"><?php echo $this->_tpl_vars['Result1']['1']; ?>
</td>
      	</tr>

      	<?php endforeach; unset($_from); endif; ?>
      	<tr class="titleth"> 
			<td align="center" colspan="2" class="scounts black border-green">Jami:</td>
	      	<?php if (count($_from = (array)$this->_tpl_vars['SchoolTypes'])):
    foreach ($_from as $this->_tpl_vars['skey'] => $this->_tpl_vars['sType']):
?>
				<?php $this->assign('stype', $this->_tpl_vars['sType']['id']); ?>
		      	<?php if (count($_from = (array)$this->_tpl_vars['Positions'])):
    foreach ($_from as $this->_tpl_vars['pkey'] => $this->_tpl_vars['Position']):
?>
					<?php $this->assign('ptype', $this->_tpl_vars['Position']['id']); ?>
			      	<td class="scounts">
			      		<?php echo $this->_tpl_vars['StaffTotal'][$this->_tpl_vars['stype']][$this->_tpl_vars['ptype']]; ?>

			      	</td>
		      	<?php endforeach; unset($_from); endif; ?>
		      	<td class="scounts black border-purple">
		      		<?php echo $this->_tpl_vars['SchoolTotal'][$this->_tpl_vars['stype']]['0']; ?>

		      	</td>
		      	<td class="scounts black border-red">
		      		<?php echo $this->_tpl_vars['SchoolTotal'][$this->_tpl_vars['stype']]['1']; ?>

		      	</td>
	      	<?php endforeach; unset($_from); endif; ?>
			<td align="center" class="scounts"><?php echo $this->_tpl_vars['TotalSchools']; ?>
</td>
      		<td align="center" class="scounts"><?php echo $this->_tpl_vars['TotalStaff']; ?>
</td>
      	</tr>
</table>
<?php else: ?>
<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
      	<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center" class="border-green">Ta'lim muassasasi</td>
	      	<?php if (count($_from = (array)$this->_tpl_vars['Positions'])):
    foreach ($_from as $this->_tpl_vars['pkey'] => $this->_tpl_vars['Position']):
?>
		      	<th class="rotate"><div><span><?php echo $this->_tpl_vars['Position']['sname']; ?>
</span></div></th>
	      	<?php endforeach; unset($_from); endif; ?>
	      	<th class="rotate  border-purple"><div><span>Umumiy</span></div></th>
      	</tr>
      	<?php $this->assign('TotalStaff', 0); ?>	
      	<?php if (count($_from = (array)$this->_tpl_vars['Schools'])):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['School']):
?>
      	<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFFFF,#E4EAF2"), $this);?>
"> 
			<td><?php echo $this->_tpl_vars['key1']+1; ?>
</td>	
			<td class="border-green"><a href="staff.php?act=staff&did=<?php echo ((is_array($_tmp=$this->_tpl_vars['School']['id'])) ? $this->_run_mod_handler('crypt', true, $_tmp) : smarty_modifier_crypt($_tmp)); ?>
" class="names faculties"><?php echo $this->_tpl_vars['School']['school_number']; ?>
-<?php echo $this->_tpl_vars['School']['stype']; ?>
</a></td>
				<?php $this->assign('school', $this->_tpl_vars['School']['id']); ?>
		      	<?php if (count($_from = (array)$this->_tpl_vars['Positions'])):
    foreach ($_from as $this->_tpl_vars['pkey'] => $this->_tpl_vars['Position']):
?>
					<?php $this->assign('ptype', $this->_tpl_vars['Position']['id']); ?>
			      	<td class="scounts">
			      		<?php echo $this->_tpl_vars['StaffCounts'][$this->_tpl_vars['school']][$this->_tpl_vars['ptype']]; ?>

			      	</td>
		      	<?php endforeach; unset($_from); endif; ?>
		      	<td class="scounts black border-purple">
		      		<?php echo $this->_tpl_vars['School']['scount']; ?>

		      	</td>
		      	<?php $this->assign('TotalStaff', $this->_tpl_vars['TotalStaff']+$this->_tpl_vars['School']['scount']); ?>	
      	</tr>

      	<?php endforeach; unset($_from); endif; ?>
      	<tr class="titleth"> 
			<td align="center" colspan="2" class="scounts black border-green">Jami:</td>
				<?php $this->assign('stype', $this->_tpl_vars['sType']['id']); ?>
		      	<?php if (count($_from = (array)$this->_tpl_vars['Positions'])):
    foreach ($_from as $this->_tpl_vars['pkey'] => $this->_tpl_vars['Position']):
?>
					<?php $this->assign('ptype', $this->_tpl_vars['Position']['id']); ?>
			      	<td class="scounts">
			      		<?php echo $this->_tpl_vars['TotalByPositions'][$this->_tpl_vars['ptype']]; ?>

			      	</td>
		      	<?php endforeach; unset($_from); endif; ?>
      		<td align="center" class="scounts border-purple"><?php echo $this->_tpl_vars['TotalStaff']; ?>
</td>
      	</tr>
</table>
<?php endif; ?>
<br>
		
		
	</div>
	<script>
			<?php echo '
		$(\'#pbutton\').click(function(event) {
			
					$(\'#printarea\').printElement();
					
		});
		
		function ClickHereToPrint() {
			try {
				var oIframe = document.getElementById(\'printframe\');
				var oContent = document.getElementById(\'ex3\').innerHTML;
				var oDoc = (oIframe.contentWindow || oIframe.contentDocument);
				if (oDoc.document) oDoc = oDoc.document;
				oDoc.write("<html><head><title>';  echo $this->_tpl_vars['Dict']['students'];  echo '</title>");
				oDoc.write("</head><body onload=\'this.focus(); this.print();\'>");
				oDoc.write(oContent + "</body></html>");
				oDoc.close();
			} catch (e) {
				self.print();
			}
		}
		'; ?>

	</script>
	
<?php echo $this->_tpl_vars['bottom']; ?>


















