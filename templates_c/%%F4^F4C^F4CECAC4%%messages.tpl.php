<?php /* Smarty version 2.6.5-dev, created on 2018-03-23 21:42:10
         compiled from messages.tpl */ ?>
		<?php if ($this->_tpl_vars['MESSAGE_TYPE'] == 1): ?>
		<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
		<tr>
			<td height="1" bgcolor="98D23F"></td>
		</tr>
		<tr>
			<td align="center" bgcolor="E9FAD0" height="30">
				<table cellpadding="2" cellspacing="2" border="0">
					<tr>
						<td width="50"><img src="images/info1.gif"></td><td class="WelcomeText"><?php echo $this->_tpl_vars['MESSAGE']; ?>
</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="1" bgcolor="7FD7F7"></td>
		</tr>
		</table>
		<?php endif; ?>		
		
		<?php if ($this->_tpl_vars['MESSAGE_TYPE'] == 2): ?>
		<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
		<tr>
			<td height="1" bgcolor="98D23F"></td>
		</tr>
		<tr>
			<td align="center" bgcolor="E5F6FD" height="30">
				<table cellpadding="2" cellspacing="2" border="0">
					<tr>
						<td width="50"><img src="images/info2.gif"></td><td class="WelcomeText"><?php echo $this->_tpl_vars['MESSAGE']; ?>
</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="1" bgcolor="98D23F"></td>
		</tr>
		</table>
		<?php endif; ?>		
		
		<?php if ($this->_tpl_vars['MESSAGE_TYPE'] == 3): ?>
		<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
		<tr>
			<td height="1" bgcolor="F77F7F"></td>
		</tr>
		<tr>
			<td align="center" bgcolor="FDE1E1" height="30">
				<table cellpadding="2" cellspacing="2" border="0">
					<tr>
						<td width="50"><img src="images/info3.gif" height="25"></td><td class="WelcomeText"><?php echo $this->_tpl_vars['MESSAGE']; ?>
</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="1" bgcolor="F77F7F"></td>
		</tr>
		</table>
		<?php endif; ?>		
		
		<?php if ($this->_tpl_vars['MESSAGE_TYPE'] == ""): ?>
		<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
		<tr>
			<td height="1" bgcolor="98D23F"></td>
		</tr>
		<tr>
			<td align="center" bgcolor="E9FAD0" height="30">
				<table cellpadding="2" cellspacing="2" border="0">
					<tr>
						<td width="50"><img src="images/info.gif"></td><td class="WelcomeText"><?php echo $this->_tpl_vars['MESSAGE']; ?>
</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="1" bgcolor="98D23F"></td>
		</tr>
		</table>
		<?php endif; ?>