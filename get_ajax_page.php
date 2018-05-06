<?
/****************************************************************
*                           get_ajax_page.php		 								*
*                          -------------------			  					*
*     begin                : 01.01.2010 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/

define('ARM_IN', true);
include("includes/all_includes.php");
switch ($_GET['case'])
{
	case "sb_fields":

		$query = "select vcolumns from bcms_views where tablename = '".$_GET['table']."'";
		$sql->query($query);
		$View = $sql->fetchAssoc();

		$Options = "";
		if ($View['vcolumns'] != "")
		{
			$row = explode(",",$View['vcolumns']);
			foreach ($row as $id => $val)
			{
				$Options .= "<option value='".$val."'>".$val."</option>";
			}
		}
		else
		{
			$query = "SHOW COLUMNS FROM ".$_GET['table'];
			$sql->query($query);
			$row = $sql->fetchAll();

			foreach ($row as $id => $val)
			{
				$Options .= "<option value='".$val['Field']."'>".$val['Field']."</option>";
			}
			#team
		}
		$ReturnRow = $Options;
		break;

	case "dynamicSB":
		$query = "SELECT * FROM bcms_fields where id = ".$_GET['id'];
		$sql->query($query);
		$Rows = $sql->fetchAssoc();
		$Couple = "";

		if ($Rows['coupleoptions'] != "")
		{
			$query = "SELECT * FROM bcms_fields where coupleoptions = ".$Rows['coupleoptions']." and form_id = ".$Rows['form_id']." and id != ".$Rows['id']." order by id";
			$sql->query($query);
			$cRows = $sql->fetchAll();
			foreach ($cRows as $cId => $cVal)
			{
				if ($cVal['InputType'] == 'select')
				{
					//echo
					$SelectBox1 = "<select name=".$cVal['fieldname']."[] class=free12>";

					$queryv = "select vquery from bcms_views where tablename = '".$cVal['stable']."'";
					$sql->query($queryv);
					$View1 = $sql->fetchAssoc();

					if ($View1['vquery'] != "")
					{
						$query1 = $View1['vquery'];
					}
					else
					{
						$query1 = "Select ".$cVal['idField'].",".$cVal['idValue']." from ".$cVal['stable']." WHERE 0=0 ";
					}

					if ($cVal['idParent']!="")
					{
						$query1 .= " AND ".$cVal['idParent']." = ".$_GET['parid'];
					}
					if ($cVal['idOrder']!="")
					{
						$query1 .= " Order by ".$cVal['idOrder'];
					}
					//echo $query1;
					$sql->query($query1);
					$SelBoxVal1 = $sql->fetchAll();
					$SelectBox1 .= "<option value=0>Выберите</option>";

					foreach ($SelBoxVal1 as $SbID => $SbVal)
					{
						$SelectBox1 .= "<option value=".$SbVal[$cVal['idField']].">".$SbVal[$cVal['idValue']]."</option>";
					}
					$SelectBox1 .= "</select>";
					$Couple .= $SelectBox1;
				}
				else
				{
					$Couple .= "<input type=text name=".$cVal['fieldname']."[] value=0 class=flat12 style='width:30px;'>";
				}
			}
		}
		/*		if ($Rows['coupleoptions'] != "")
		{
		$query = "SELECT * FROM bcms_fields where coupleoptions = ".$Rows['coupleoptions']." and id != ".$_GET['id'];
		$sql->query($query);
		$cRows = $sql->fetchAssoc();
		$Couple .= "<input type=text name=".$cRows['fieldname']."[] class=flatFields style='width:30px;'>";
		}*/

		$SelectBox = "<select name=".$Rows['fieldname']."[] class=free12>";

		$query = "select vquery from bcms_views where tablename = '".$Rows['stable']."'";
		$sql->query($query);
		$View = $sql->fetchAssoc();

		if ($View['vquery'] != "")
		{
			$query = $View['vquery'];
		}
		else
		{
			$query = "Select ".$Rows['idField'].",".$Rows['idValue']." from ".$Rows['stable']." WHERE 0=0 ";
		}

		if ($Rows['idParent']!="")
		{
			$query .= " AND ".$Rows['idParent']." = ".$_GET['parid'];
		}
		if ($Rows['idOrder']!="")
		{
			$query .= " Order by ".$Rows['idOrder'];
		}
		//echo $query;
		$sql->query($query);
		$SelBoxVal = $sql->fetchAll();
		$SelectBox .= "<option value=0>Выберите</option>";

		foreach ($SelBoxVal as $SbID => $SbVal)
		{
			$SelectBox .= "<option value=".$SbVal[$Rows['idField']].">".$SbVal[$Rows['idValue']]."</option>";
		}
		$SelectBox .= "</select>";
		#$SelectBox .= "<input type=text name=pnumber[] class=flatFields>";
		//$SelectBox .= "<input type=text name=".$cRows['fieldname']."[] value=".$cRows['fieldname']." class=flatFields>";
		$DC = $_GET['dc']+1;
		if ($_GET['type'] == 'add')
		$ReturnRow = $Rows['fieldname']."<&sep&>".$_GET['dc']."<&sep&>"."<span id='".$Rows['fieldname'].$_GET['dc']."dc'>".$SelectBox.$Couple."&nbsp;".$DC."</span>";
		if ($_GET['type'] == 'edit')
		$ReturnRow = $Rows['fieldname']."e<&sep&>".$_GET['dc']."<&sep&>"."<span id='".$Rows['fieldname'].$_GET['dc']."dc'>".$SelectBox.$Couple."&nbsp;".$DC."</span>";

		break;

	case "set_dyn_vals":
		$Fields = explode('<s>',$_GET['fields']);
		$FieldsCheck = $Fields;
		$Values = explode('<s>',$_GET['values']);
		//print_r($Values);
		$RowId  = $_GET['rowid'];
		$Table  = $_GET['table'];
		foreach ($Fields as $fId => $fVal)
		{
			$dynForm = array();
			if (!isset($CouplesArr[$fVal]))
			{
				$query = "SELECT * FROM bcms_fields where fieldname = '".$fVal."'";
				$sql->query($query);
				$Rows = $sql->fetchAssoc();

				$queryv = "select vquery from bcms_views where tablename = '".$Rows['stable']."'";
				$sql->query($queryv);
				$View1 = $sql->fetchAssoc();

				if ($View1['vquery'] != "")
				{
					$query = $View1['vquery'];
				}
				else
				{
					$query = "Select ".$Rows['idField'].",".$Rows['idValue']." from ".$Rows['stable']." WHERE 0=0 ";
				}

				if ($Rows['idParent']!="")
				{
					$query .= " AND ".$Rows['idParent']." = (select ".$Rows['idParent']." from ".$Rows['stable']." where ".$Rows['idField']." in (".$Values[$fId].") limit 1)";
				}
				if ($Rows['idOrder']!="")
				{
					$query .= " Order by ".$Rows['idOrder'];
				}
				$sql->query($query);
				$SelBoxVal = $sql->fetchAll();
				//print_r($Rows);
				if ($Rows['coupleoptions'] != "")
				{
					$query = "SELECT * FROM bcms_fields where coupleoptions = ".$Rows['coupleoptions']." and form_id = ".$Rows['form_id']." and id != ".$Rows['id']." order by id";
					$sql->query($query);
					$cRows = $sql->fetchAll();

					foreach ($cRows as $cId => $cVal)
					{
						$CouplesArr[$cVal['fieldname']] = $cVal['fieldname'];
						$Thiskey = array_search($cVal['fieldname'],$Fields);
						$CoupleArr = explode(",",$Values[$Thiskey]);
						if ($cVal['InputType'] == 'select')
						{
							$queryv = "select vquery from bcms_views where tablename = '".$cVal['stable']."'";
							$sql->query($queryv);
							$View1 = $sql->fetchAssoc();

							if ($View1['vquery'] != "")
							{
								$query1 = $View1['vquery'];
							}
							else
							{
								$query1 = "Select ".$cVal['idField'].",".$cVal['idValue']." from ".$cVal['stable']." WHERE 0=0 ";
							}

							if ($cVal['idParent']!="")
							{
								//echo " AND ".$cVal['idParent']." = ".$cVal['fieldname']."<br>";

								$query1 .= " AND ".$cVal['idParent']." = (select ".$cVal['idParent']." from ".$cVal['stable']." where ".$cVal['idField']." in (".$Values[$fId].") limit 1)";
								//$query1 .= " AND ".$cVal['idParent']." = ".$_GET['parid'];
							}
							if ($cVal['idOrder']!="")
							{
								$query1 .= " Order by ".$cVal['idOrder'];
							}
							$sql->query($query1);
							$SelBoxVal1 = $sql->fetchAll();
							/*if ($cVal['fieldname'] == 'subst_out2')
							{
							echo $fId;
							//print_r($CoupleArr);
							echo "<br>";
							echo "<br>";
							}*/
							foreach ($CoupleArr as $cpId => $cpVal)
							{

								$SelectBox1 = "<select name=".$cVal['fieldname']."[] class=free12>";
								$SelectBox1 .= "<option value=0>Выберите</option>";

								foreach ($SelBoxVal1 as $SbID => $SbVal)
								{
									/*if ($cVal['fieldname'] == 'subst_out2')
									{
									echo $SbVal[$cVal['idField']]." == ".$cpVal;
									echo "<br>";
									echo "<br>";
									}*/
									if ($SbVal[$cVal['idField']] == $cpVal)
									{
										$SelectBox1 .= "<option value=".$SbVal[$cVal['idField']]." selected>".$SbVal[$cVal['idValue']]."</option>";
									}
									/*else
									{
									$SelectBox1 .= "<option value=".$SbVal[$cVal['idField']].">".$SbVal[$cVal['idValue']]."</option>";
									}*/
								}
								$SelectBox1 .= "</select>";
								$dynForm[$cId][] = $SelectBox1;
							}
						}
						else
						{
							//print_r($CoupleArr);
							//echo "<br>";
							foreach ($CoupleArr as $cpId => $cpVal)
							{
								$thisVal = ($cpVal!="") ? $cpVal : 0;
								$dynForm[$cId][] = "<input type=text name=".$cVal['fieldname']."[] value=".$thisVal." class=flatFields style='width:60px;'>";
							}
						}

					}
				}
				//print_r($dynForm);
				$newMass = array();
				foreach ($dynForm as $dId => $dVal)
				{
					foreach ($CoupleArr as $cpId => $cpVal)
					{
						$newMass[$cpId] = (isset($newMass[$cpId])) ? $newMass[$cpId].$dVal[$cpId] : $dVal[$cpId];
					}
				}
				$ValuesArr = explode(",",$Values[$fId]);
				$CycleVals = "";
				$ReturnRows= "";
				$RowCount = 0;
				foreach ($ValuesArr as $vId => $vVal)
				{
					$RowCount++;

					$SelectBox = "<select name=".$Rows['fieldname']."[] class=free12 style=width:200px;>";
					$SelectBox .= "<option value=0>Выберите</option>";

					foreach ($SelBoxVal as $SbID => $SbVal)
					{
						if ($vVal == $SbVal[$Rows['idField']])
						{
							$SelectBox .= "<option value=".$SbVal[$Rows['idField']]." selected>".$SbVal[$Rows['idValue']]."</option>";
						}
						/*						else
						{
						$SelectBox .= "<option value=".$SbVal[$Rows['idField']].">".$SbVal[$Rows['idValue']]."</option>";
						}
						*/					}
						$SelectBox  .= "</select>";
						$CycleVals  = "<span id='".$Rows['fieldname'].$RowCount."dc'>".$SelectBox.(isset($newMass[$vId]) ? $newMass[$vId] : "")."&nbsp;".$RowCount."</span>";
						$ReturnRows .= "<div id=ThisDyn".$Rows['fieldname']."e_".$RowCount."><input type=button value='x' style='width:25px; height=25px;'  ondblclick=DelDynSB('".$Rows['fieldname']."e',".$RowCount.");>".$CycleVals."</div>";
				}
				$ReturnRow[] = $Rows['fieldname']."e<&sep&>".$ReturnRows."<&sep&>".$RowCount;
			}
		}
		$ReturnRow = implode('<&ArrSep&>',$ReturnRow);
		//die();
		break;

	case "childsb":

		$query = "SELECT * FROM bcms_fields where id = ".$_GET['rowid'];
		$sql->query($query);
		$Parent = $sql->fetchAssoc();

		$query = "SELECT * FROM bcms_fields where ChildField = ".$_GET['rowid'];
		$sql->query($query);
		$subRows = $sql->fetchAll();

		/*		foreach ($subRows as $sRid => $sRval)
		{
		echo $query = "Select ".$sRval['idField'].",".$sRval['idValue']." from ".$sRval['stable']." WHERE ".$sRval['idParent']." = ".$_GET['parid'];
		$sql->query($query);
		$SelBoxVal = $sql->fetchAll();
		}
		print_r($SelBoxVal);
		die();*/

		//print_r($subRows);

		foreach ($subRows as $vid => $val)
		{
			if ($val['addoptions'] != 'dynamic')
			{
				switch ($val['InputType'])
				{
					case "select":

						$query = "select vquery from bcms_views where tablename = '".$val['stable']."'";
						$sql->query($query);
						$View = $sql->fetchAssoc();

						if ($View['vquery'] != "")
						{
							$query = $View['vquery'];
						}
						else
						{
							if ($_GET['type'] == 'edit')
							{
								$TableName = getPareTVs($val['stable']);
							}
							else
							{
								$TableName = $val['stable'];
							}
							$query = "Select ".$val['idField'].",".$val['idValue']." from ".$TableName." WHERE 0=0";
						}
						//$query = "Select ".$val['idField'].",".$val['idValue']." from ".$val['stable']." WHERE 0=0 ";


						if ($val['idParent']!="")
						{
							$query .= " AND ".$val['idParent']." = ".$_GET['parid'];
						}
						if ($val['idOrder']!="")
						{
							$query .= " Order by ".$val['idOrder'];
						}

						$sql->query($query);
						$SelBoxVal = $sql->fetchAll();

						if ($_GET['type'] == 'add')
						{
							if ($val['addoptions'] == 'multiple')
							{
								$SelectBox = "<select name=".$val['fieldname']."[] class=free multiple style='width:".$val['width']."; height:".$val['height'].";' id='".$val['fieldname']."fc'>";
							}
							else
							{
								if ($val['addoptions'] == 'parent' || $val['addoptions'] == 'parent & child')
								{
									$SelectBox = "<select name=".$val['fieldname']." class=free onchange=getChildBoxVal(".$val['id'].",this.value,'".$val['fieldname']."','add') id='".$val['fieldname']."fc'>";
								}
								else
								{
									$SelectBox = "<select name=".$val['fieldname']." class=free id='".$val['fieldname']."fc'>";
								}
							}
							/*if (count($SelBoxVal) == 1)
							{*/
								$SelectBox .= "<option value=0>--------------</option>";
							/*}*/
							foreach ($SelBoxVal as $SbID => $SbVal)
							{
								$SelectBox .= "<option value=".$SbVal[$val['idField']].">".$SbVal[$val['idValue']]."</option>";
							}
							$SelectBox .= "</select>";
							$ReturnRow[] = $val['fieldname']."<&sep&>"."<span id='".$val['fieldname']."'>".$SelectBox."</span>";

						}
						else if ($_GET['type'] == 'del')
						{
							#for edit
							if ($val['addoptions'] == 'multiple')
							{
								$SelectBoxE = "<select name=".$val['fieldname']." class=free m id='".$val['fieldname']."fd'>";
							}
							else
							{
								if ($val['addoptions'] == 'parent' || $val['addoptions'] == 'parent & child')
								{
									$SelectBoxE = "<select name=".$val['fieldname']."[] class=free multiple style='width:".$val['width']."; height:".$val['height'].";' id='".$val['fieldname']."fd'>";
								}
								else
								{
									$SelectBoxE = "<select name=".$val['fieldname']." class=free id='".$val['fieldname']."fd'>";
								}
							}
							foreach ($SelBoxVal as $SbID => $SbVal)
							{
								$SelectBoxE .= "<option value=".$SbVal[$val['idField']].">".$SbVal[$val['idValue']]."</option>";
							}
							$SelectBoxE .= "</select>";
							$ReturnRow[] = $val['fieldname']."d<&sep&>"."<span id='".$val['fieldname']."d'>".$SelectBoxE."</span>";
						}
						else
						{
							#for edit
							if ($val['addoptions'] == 'multiple')
							{
								$SelectBoxE = "<select name=".$val['fieldname']." class=free id='".$val['fieldname']."fe'>";
							}
							else
							{
								if ($val['addoptions'] == 'parent' || $val['addoptions'] == 'parent & child')
								{
									$SelectBoxE = "<select name=".$val['fieldname']." class=free onchange=getChildBoxVal(".$val['id'].",this.value,'edit','test') id='".$val['fieldname']."fe'>";
								}
								else
								{
									$SelectBoxE = "<select name=".$val['fieldname']." class=free id='".$val['fieldname']."fe'>";
								}
							}
							foreach ($SelBoxVal as $SbID => $SbVal)
							{
								$SelectBoxE .= "<option value=".$SbVal[$val['idField']].">".$SbVal[$val['idValue']]."</option>";
							}
							$SelectBoxE .= "</select>";
							$ReturnRow[] = $val['fieldname']."e<&sep&>"."<span id='".$val['fieldname']."e'>".$SelectBoxE."</span>";
						}
						break;
					case "checkbox":
						$query = "Select ".$val['idField'].",".$val['idValue']." from ".$val['stable']." WHERE ".$val['idParent']." = ".$_GET['parid'];
						$sql->query($query);
						$SelBoxVal = $sql->fetchAll();

						$RadioBox = "";
						foreach ($SelBoxVal as $SbID => $SbVal)
						{
							$RadioBox .= "<input type=checkbox name=".$val['fieldname']."[] value=".$SbVal[$val['idField']]." id='".$val['fieldname']."'> <span class=FlatVal>".$SbVal[$val['idValue']]."</span>\n";
							#						$RadioBoxE .= "<input type=checkbox name=".$val['fieldname']."[] value=".$SbVal[$val['idField']]." id='".$val['fieldname'].$SbVal[$val['idField']]."'> <span class=FlatVal>".$SbVal[$val['idValue']]."</span>";
							#						$RadioBoxD .= "<input type=checkbox name=".$val['fieldname']."[] value=".$SbVal[$val['idField']]." id='".$val['fieldname'].$SbVal[$val['idField']]."'> <span class=FlatVal>".$SbVal[$val['idValue']]."</span>";
						}
						//$TheField = "<span id='".$val['fieldname']."Chbx'>".$RadioBox."</span>";
						#					$TheFielde[$id] = "<span id='".$val['fieldname']."Chbxe'>".$RadioBoxE."</span>";
						#					$TheFieldd[$id] = "<span id='".$val['fieldname']."Chbxd'>".$RadioBoxD."</span>";
						$ReturnRow[] = $val['fieldname']."Chbx<&sep&>"."<span id='".$val['fieldname']."e'>".$RadioBox."</span>";

						break;
				}
			}
			else
			{
				$ReturnRow[] = 0;
			}

		}


		$ReturnRow = implode('<&ArrSep&>',$ReturnRow);
		break;

	case "sb_values":
		$query = "SelecT * FROM bcms_fields where id = ".$_GET['pid'];
		$sql->query($query);
		$Parent = $sql->fetchAssoc();

		$query = "SelecT * FROM bcms_fields where id = ".$_GET['chid'];
		$sql->query($query);
		$Child = $sql->fetchAssoc();

		break;
	case "list_by_sort":
		$query = "Select * from bcms_fields where form_id = ".$_GET['menuid']." order by id";
		$sql->query($query);
		$Fields = $sql->fetchAll();

		$query = "Select tablename,name1 name from bcms_forms where id = ".$_GET['menuid'];
		$sql->query($query);
		$FormType = $sql->fetchAssoc();

		foreach ($Fields as $id => $val)
		{
			if ($val['ListMember'])
			{
				if ($val['InputType'] == 'select')
				{
					$query = "select selquery from bcms_views where tablename = '".$val['stable']."'";
					$sql->query($query);
					$View = $sql->fetchAssoc();

					if ($View['selquery'] != "")
					{

						$SelQuery = str_replace('@var@',"t.".$val['fieldname'],$View['selquery']);
						$ListMembersQuery[] = str_replace('@fieldname@',$val['fieldname'],$SelQuery);
					}
					else
					{
						$ListMembersQuery[] = "(select ".$val['idValue']." from ".$val['stable']." s where s.".$val['idField']." = t.".$val['fieldname'].") ".$val['fieldname'];
					}

					$ListMembers[] = $val['fieldname'];
					$ListMemberNames[] = $val['name_e'];
				}
				else
				{
					$ListMembers[] = $val['fieldname'];
					$ListMembersQuery[] = $val['fieldname'];
					$ListMemberNames[] = $val['name_e'];
				}
				$ListMemberTypes[] =  $val['InputType'];
				$ListMemberOptions[] =  $val['addoptions'];
			}
			if ($val['fieldname'] == 'lang')
			{
				$UseLang = 1;
			}
		}
		$query = "Select id,".implode($ListMembersQuery,",")." from ".$FormType['tablename']." t";
		if ($_GET['sortid'] != 0)
		{
			$query .= " where ".$_GET['field']." = ".$_GET['sortid'];
			if (isset($UseLang))
			{
				$query .= " and lang = ".$_GET['lang'];
			}
		}
		else
		{
			if (isset($UseLang))
			{
				$query .= " WHERE lang = ".$_GET['lang'];
			}
		}
		$query .= " ORDER BY id DESC limit 100";

		$iCount = 0;
		if (strpos($_GET['field'],","))
		{
			$LimitArr = explode(",",$_GET['field']);
			$query .= " limit ".$LimitArr[0].",".$LimitArr[1];
			$iCount = $LimitArr[0];
		}
		$sql->query($query);
		$Rows = $sql->fetchAll();

		$ValRows = "<br><table cellpadding=5 cellspacing=1 border=0 width=100% align=center bgcolor=BCC7DD>";
		$ValRows .= "<tr class=titleth>";
		$ValRows .= "<td></td>";

		$ParamArr = explode(",",$FormType['name']);

		foreach ($ListMembers as $id => $val)
		{
			$ValRows .= "<td class=LittleHat align=center height=25>";
			$ValRows .= $ListMemberNames[$id];
			$ValRows .= "</td>";
		}
		if (!in_array('noactions',$ParamArr))
		{
			if (in_array('addactions',$ParamArr))
			{
				$ValRows .= "";
			}
			elseif (in_array('addedactions',$ParamArr))
			{
				$ValRows .= "<td></td>";
			}
			elseif (in_array('adddellactions',$ParamArr))
			{
				$ValRows .= "<td></td>";
			}			
			else
			{
				$ValRows .= "<td colspan=2></td>";
			}			
		}
		$ValRows .= "</tr>";

		foreach ($Rows as $rowid => $rowal)
		{
			$iCount++;
			//$ValRows .= "<tr><td colspan=10 height=1 bgcolor=888888></td></tr>";
			if ($rowid&1)
			{
				$ValRows .= "<tr bgcolor=E4EAF2>";
			}
			else
			{
				$ValRows .= "<tr bgcolor=FFFFFF>";
			}
			$ValRows .= "<td class=LittleRows align=center><b>".$iCount."</b></td>";

			foreach ($ListMembers as $id => $val)
			{
				if ($ListMemberOptions[$id] == "Money")
				{
					$ValRows .= "<td class=LittleRows align=right>";
					$ValRows .= number_format($rowal[$val]);
					$ValRows .= "</td>";
				}
				elseif ($ListMemberOptions[$id] == "SysDate" && $ListMemberTypes[$id] == "hidden")
				{
					$ValRows .= "<td class=LittleRows align=center>";
					$ValRows .= date('d.m.Y H:i:s',$rowal[$val]);
					$ValRows .= "</td>";
				}
				else
				{
					$ValRows .= "<td class=LittleRows>";
					$ValRows .= $rowal[$val];
					$ValRows .= "</td>";
				}
			}
			if (!in_array('noactions',$ParamArr))
			{
				if (in_array('addactions',$ParamArr))
				{
				$ValRows .= "";
				}
				elseif (in_array('addedactions',$ParamArr))
				{
				$ValRows .= "<td align=center><a href='#' onclick='TabRightSwitch4(3); GetAjaxInfoEdit(".$rowal['id'].");'><img src=images/edit.gif border=0 width=26></a></td>";
				}
				elseif (in_array('adddellactions',$ParamArr))
				{
				$ValRows .= "<td align=center height=25><a href='#' onclick='TabRightSwitch4(2); GetAjaxInfo(".$rowal['id'].");'><img src=images/insert.gif border=0 width=26></a></td>";
				$ValRows .= "<td align=center><a href='#' onclick='TabRightSwitch4(4); GetAjaxInfoDel(".$rowal['id'].");'><img src=images/del.gif border=0 width=26></a></td>";
				}			
				else
				{
				$ValRows .= "<td align=center><a href='#' onclick='TabRightSwitch4(3); GetAjaxInfoEdit(".$rowal['id'].");'><img src=images/edit.gif border=0 width=26></a></td>";
				$ValRows .= "<td align=center><a href='#' onclick='TabRightSwitch4(4); GetAjaxInfoDel(".$rowal['id'].");'><img src=images/del.gif border=0 width=26></a></td>";
				}			
			}
			$ValRows .= "</tr>";
		}
		$ValRows .= "</table>";
		$ReturnRow = $ValRows;

		break;
	default:
		$ReturnRow = "Error!";
		break;
}
echo $ReturnRow;
//echo iconv("cp1251", "UTF-8", $ReturnRow);
?>