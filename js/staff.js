function CheckFormBeforeSend()
{
	if ($('#lastname').val() == "")
	{
		alert("XATO!: Xodimning familiyasi kiritilmagan");
		$('#staftab1').click();
		$('#lastname').focus();
		return 1;
	}
	if ($('#firstname').val() == "")
	{
		alert("XATO!: Xodimning ismi kiritilmagan");
		$('#staftab1').click();
		$('#firstname').focus();
		return 1;
	}
	if ($('#surname').val() == "")
	{
		alert("XATO!: Xodimning otasining ismi kiritilmagan");
		$('#staftab1').click();
		$('#surname').focus();
		return 1;
	}
	if ($('#birthdate').val() == "" || $('#birthdate').val() == "__.__.____")
	{
		alert("XATO!: Xodimning tug'ilgan sanasi kiritilmagan");
		$('#staftab1').click();
		$(this).focus();
		return 1;
	}	
	if ($('#nation').val() == 0)
	{
		alert("XATO!: Xodimning millati kiritilmagan");
		$('#staftab1').click();
		$('#nation').focus();
		return 1;
	}

	if ($('#gender').val() == 0)
	{
		alert("XATO!: Xodimning jinsi kiritilmagan");
		$('#staftab1').click();
		$('#gender').focus();
		return 1;
	}
	if ($('#passport_cer').val() == "")
	{
		alert("XATO!: Xodimning passport seriyasi kiritilmagan");
		$('#staftab1').click();
		$('#passport_cer').focus();
		return 1;
	}
	if ($('#passport_num').val() == "")
	{
		alert("XATO!: Xodimning passport raqami kiritilmagan");
		$('#staftab1').click();
		$('#passport_num').focus();
		return 1;
	}
	if ($('#region').val() == 0)
	{
		alert("XATO!: Xodimning yashash xudui tanlanmagan");
		$('#staftab1').click();
		$('#region').focus();
		return 1;
	}
	if ($('#distcity').val() == 0)
	{
		alert("XATO!: Xodimning yashash tumani yoki shaxari tanlanmagan");
		$('#staftab1').click();
		$('#distcity').focus();
		return 1;
	}
	
	if ($('#phone').val() == "" || $('#phone').val() == "+(_____)-_______")
	{
		alert("XATO!: Telefon raqami kiritilmagan");
		$('#staftab1').click();
		$('#phone').focus();
		return 1;
	}

	if ($('#grad_univer').val() == 0)
	{
		alert("XATO!: Xodimning tugatgan OTM tanlanmagan");
		$('#staftab2').click();
		$('#grad_univer').focus();
		return 1;
	}
	if ($('#grad_univer_year').val() == 0)
	{
		alert("XATO!: Xodimning OTM ni tugatgan yili tanlanmagan");
		$('#staftab2').click();
		$('#grad_univer_year').focus();
		return 1;
	}

	if ($('#dip_expertise').val() == "" && $('#dip_speciality').val() == "")
	{
		alert("XATO!: Diplom bo'yicha mutaxassislik yoki ixtisosligi kiritilmagan");
		$('#staftab2').click();
		$('#dip_expertise').focus();
		return 1;
	}
	
	if ($('#dip_series').val() == "")
	{
		alert("XATO!: Diplom seriyasi kiritilmagan");
		$('#staftab2').click();
		$('#dip_series').focus();
		return 1;
	}
	
	if ($('#dip_number').val() == "")
	{
		alert("XATO!: Diplom raqami kiritilmagan");
		$('#staftab2').click();
		$('#dip_number').focus();
		return 1;
	}
	
	if ($('#work_place_school').val() == 0)
	{
		alert("XATO!: Ish joyi tanlanmagan");
		$('#staftab2').click();
		$('#work_place_school').focus();
		return 1;
	}
	
	if ($('#position').val() == 0)
	{
		alert("XATO!: Xodimning lavozimi tanlanmagan");
		$('#staftab2').click();
		$('#position').focus();
		return 1;
	}
	
	if ($('#position_year').val() == "")
	{
		alert("XATO!: Xodimning lavozimga tayinlangan yili kiritilmagan");
		$('#staftab2').click();
		$('#position_year').focus();
		return 1;
	}
	
	if ($('#last_qual_place').val() != 0)
	{
		if ($('#last_qual_year').val() == "")
		{
			alert("XATO!: Oxirgi marta malaka oshirgan yili kiritilmagan");
			$('#staftab3').click();
			$('#last_qual_year').focus();
			return 1;
		}
		if ($('#mo_certificat_no').val() == "")
		{
			alert("XATO!: Malaka oshirgan xaqidagi sertifikat raqami kiritilmagan");
			$('#staftab3').click();
			$('#mo_certificat_no').focus();
			return 1;
		}
	}
	
	if ($('#attestation_year').val() != "")
	{
		if ($('#attestation_category').val() == "")
		{
			alert("XATO!: Attestasiyadan keyingi toifasi tanlanmagan");
			$('#staftab3').click();
			$('#attestation_category').focus();
			return 1;
		}

		/*if ($('#attestation_result').val() == "")
		{
			alert("XATO!: Attestasiya natijasi kiritilmagan");
			$('#staftab3').click();
			$('#attestation_result').focus();
			return 1;
		}*/
		
	}

	if ($('#retraining_vuz').val() != 0)
	{
		if ($('#retraining_year').val() == "")
		{
			alert("XATO!: Qayta tayyorlov yili kiritilmagan");
			$('#staftab3').click();
			$('#retraining_year').focus();
			return 1;
		}
		if ($('#retraining_dip_no').val() == "")
		{
			alert("XATO!: Qayta tayyorlov diplomi raqami kiritilmagan");
			$('#staftab3').click();
			$('#retraining_dip_no').focus();
			return 1;
		}
		
	}

	return 0;
}

/*$('#SubDel').click(function()
{
	alert("asda");
	var r = confirm("Siz rostdan xam xodim xaqidagi ma'lumotni uchirmoqchimisiz?");
	if (r == true) {
	   $.post(action,
			{
				staffid:			$('#did').val()
			},
			function(data){
				alert(data);
				var NewArray = data.split("<&sep&>");
				if (NewArray[0] == 0)
				{
					location.reload();
				}
				else
				{
					alert(NewArray[1]);
				}

			});

			return false; 
	} else {
		return false;
	}
});*/

$('#SubStaff').click(function()
	{
		var action = $("#StaffForm").attr('action');
		if (CheckFormBeforeSend() == 0)
		{
			$.post(action,
			{
				staffid:			$('#staffid').val(),
				formaction:			$('#formaction').val(),
				lastname:			$('#lastname').val(),
				firstname: 			$('#firstname').val(),
				surname: 			$('#surname').val(),
				birthdate:			$('#birthdate').val(),
				nation:				$('#nation').val(),
				gender:				$('#gender').val(),
				passport_cer:		$('#passport_cer').val(),
				passport_num:		$('#passport_num').val(),
				region:				$('#region').val(),
				distcity:			$('#distcity').val(),
				email:				$('#email').val(),
				phone:				$('#phone').val(),
				grad_univer:		$('#grad_univer').val(),
				grad_univer_year:	$('#grad_univer_year').val(),
				dip_expertise:		$('#dip_expertise').val(),
				dip_speciality:		$('#dip_speciality').val(),
				dip_series:			$('#dip_series').val(),
				dip_number:			$('#dip_number').val(),
				work_place_school:	$('#work_place_school').val(),
				position:			$('#position').val(),
				position_year:		$('#position_year').val(),
				last_qual_place:	$('#last_qual_place').val(),
				last_qual_year:		$('#last_qual_year').val(),
				mo_certificat_no:	$('#mo_certificat_no').val(),
				attestation_year:		$('#attestation_year').val(),
				attestation_result:		$('#attestation_result').val(),
				attestation_category:	$('#attestation_category').val(),
				retraining_vuz:			$('#retraining_vuz').val(),
				retraining_year:		$('#retraining_year').val(),
				retraining_dip_no:		$('#retraining_dip_no').val(),

			},
			function(data){
				var NewArray = data.split("<&sep&>");
				if (NewArray[0] == "0")
				{
					location.reload();
				}
				else
				{
					alert(NewArray[1]);
				}

			});

			return false;
		}
	});