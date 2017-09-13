
//после полной загрузки страницы
jQuery(function($) {
	"use strict";
	
	//активируем тултипы
	$('[data-toggle="tooltip"]').tooltip()
	
	// перевод на русский bootstrap.select
	$.fn.selectpicker.defaults = {
		noneSelectedText : 'Ничего не выбрано',
		noneResultsText : 'Совпадений не найдено {0}',
		countSelectedText : 'Выбрано {0} из {1}',
		maxOptionsText : [ 'Достигнут предел ({n} {var} максимум)',
				'Достигнут предел в группе ({n} {var} максимум)',
				[ 'шт.', 'шт.' ] ],
		doneButtonText : 'Закрыть',
		selectAllText : 'Выбрать все',
		deselectAllText : 'Отменить все',
		multipleSeparator : ', '
	};
	
	//запомним основные элементы DOM с которыми будем работать
	var inputId= $("#inputId");
	var inputPhone= $("#inputPhone");
	var inputFamilya= $("#inputFamilya");
	var inputImya= $("#inputImya");
	var inputOtch= $("#inputOtch");
	var inputBirth= $("#inputBirth");
	var inputTown= $("#inputTown");
	var inputStreet= $("#inputStreet");
	var modal = $('#modal-edit');
	
	function selectStreetByTown(town, addressid) {
		//теперь надо заполнить поле улица
		
		$.ajax({
			type: "POST",	
			url: "/address/street",	
			dataType: "json",	
			data: "town=" + town + "&ajax=1",	
			error: function ( jqXHR, textStatus, errorThrown) {	
				//alert( "При выполнении запроса address/street произошла ошибка" );	
				console.log(errorThrown);
				console.log(jqXHR.responseText);
				modal.modal('hide');
			},
			success: function ( data ) { 
				//console.log(data[0]);
				
				if (data) {
					for ( var i = 0; i < data.length; i++ ) {
						// Каждое полученное значение вставим в список улиц
						inputStreet.append( '<option value="' + data[i].id + '">' + data[i].street + '</option>' );
					}
					inputStreet.prop( 'disabled',false );
					inputStreet.selectpicker('refresh');
					
					//если улица указана, выберем ее
					if (addressid != null)	{
						inputStreet.selectpicker('val', addressid);
						inputTown.selectpicker('val', town);
					}
					
				} else alert ("Ошибка данных. Обновите страницу");
			}
		}); //ajax 
	}
	
	//маски для полей формы
	inputPhone.mask("+7(999) 999-9999", {
					placeholder : "-"
					});
	/*
	//inputFamilya.mask("Rr?rrrrrrrrrrrrrrrrrrrrrrrrrrrr", {
	//	placeholder : " "
	//});
	inputImya.mask("Rr?rrrrrrrrrrrrrrrrrrrrrrrrrrrr", {
		placeholder : " "
	});
	inputOtch.mask("?Rrrrrrrrrrrrrrrrrrrrrrrrrrrrr", {
		placeholder : " "
	});*/

	
	
	//очистим списки городов и улиц и в дизабле
	inputTown.empty();
	inputTown.prop( 'disabled',true );
	inputTown.selectpicker('refresh');
	
	inputStreet.empty();
	inputStreet.prop( 'disabled',true );
	inputStreet.selectpicker('refresh');
	
	
	
	//пока юзер разглядывает страничку, подгрузим в фоне список городов для select
	$.ajax({
		type: "POST",	
		url: "/address/town",	
		dataType: "json",	
		data: "ajax=1",	
		error: function ( jqXHR, textStatus, errorThrown) {	
			//alert( "При выполнении запроса address/town произошла ошибка " );	
			console.log(errorThrown);
			console.log(jqXHR.responseText);
		},
		success: function ( data ) { 
			//console.log(data[0]);
			
			if (data) {
				
				var currSub = "00";
				
				for ( var i = 0; i < data.length; i++ ) {
					// Каждое полученное значение вставим в список городов
					//причем сгруппируем с помощью тэга optgroup по субъектам рф
					if (currSub != data[i].subyect_id) {
						
						if (currSub != "00") inputTown.append(optgroup);
						
						var optgroup = $('<optgroup>');
			        	optgroup.attr('label',data[i].subyect);
			        	
			        	
			        	currSub = data[i].subyect_id;
					}
					
					var option = $("<option></option>");
		            option.val(data[i].town);
		            option.text(data[i].town);
		
		            optgroup.append(option);
					
		            //и последняя группа
		            if (i == (data.length+1)) inputTown.append(optgroup);
		            
		            
					//inputTown.append( '<option value="' + data[i].town + '">' + data[i].town + '</option>' );
				}
				
				inputTown.prop( 'disabled', false );	// Включаем поле
				inputTown.selectpicker('refresh');
				
				inputStreet.prop( 'disabled',true );
				inputStreet.selectpicker('refresh');
				
			} else alert ("Ошибка данных. Обновите страницу");
		}
	}); //ajax
	
	
	
	//при открытии модального окна
	modal.on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget) // "кнопка" вызвавшая событие
		var idphone = button.data('idphone') // значение аттрибута data-*
		var addressid = button.data('addressid');
		var town = null;
		
		//очистим все сообщения о ошибках
		modal.find('.alert').remove();
		
		modal.find('.form-group').each(function(){
			$(this).removeClass('has-error');
			$(this).removeClass('has-success');
		})
		
		inputId.val(idphone);
		
		
		inputStreet.selectpicker('val', null);
		
		inputStreet.prop( 'disabled',true );
		inputStreet.selectpicker('refresh');
		
		if (idphone <= 0) {
			modal.find('.modal-title').text('Добавление')
			
			//очистим поля
			inputTown.selectpicker('val', null);
			
			inputFamilya.val(null);
			inputImya.val(null);
			inputOtch.val(null);
			inputBirth.val(null);
			inputPhone.val(null);
			
			
			inputStreet.empty();
			
			
			
		} else {
			modal.find('.modal-title').text('Редактирование')
		 
			modal.find('.modal-content').hide();
			
			
			//пока прикроем
			inputTown.prop( 'disabled',true );
			inputTown.selectpicker('refresh');
			
			
			//получим свежие данные по записи которую собрались редактировать
			$.ajax({
				type: "POST",	
				url: "/index",	
				dataType: "json",	
				data: "id=" + idphone + "&ajax=1",	
				error: function ( jqXHR, textStatus, errorThrown) {	
					//alert( "При выполнении запроса index произошла ошибка" );	
					console.log(errorThrown);
					console.log(jqXHR.responseText);
					modal.modal('hide');
				},
				success: function ( data ) { 
					//console.log(data);
					
					if (data) {
						//заполним поля формы
						inputFamilya.val(data.f);
						inputImya.val(data.i);
						inputOtch.val(data.o);
						inputBirth.val(data.birthday);
						inputPhone.val(data.phone);
						
						//тек. город надо сделать "выбранным" в селекте 
						town = data.town;
						
						if ($("#inputTown option:selected").val() != town) {
							//если город не выбран, то надо прочесть улицы
							inputTown.selectpicker('val', town);
							//и откроем
							inputTown.prop( 'disabled',false );
							inputTown.selectpicker('refresh');
							
							
							//теперь список улиц
							selectStreetByTown(town, data.addressid);
						} else {
							//просто откроем
							inputStreet.selectpicker('val', data.addressid);
							
							inputTown.prop( 'disabled',false );
							inputTown.selectpicker('refresh');
							
							inputStreet.prop( 'disabled',false );
							inputStreet.selectpicker('refresh');
							
						}
												
						modal.find('.modal-content').fadeIn();
						
						
					} else alert ("Ошибка данных. Обновите страницу");
				}
			}); //ajax
		}//end else idphone == 0
		
		
		
		
	}) // on modal show
	
	
	//при изменении города обновим список улиц
	inputTown.on('changed.bs.select', function(e) {
		inputStreet.empty();
		inputStreet.prop( 'disabled',true );
		inputStreet.selectpicker('refresh');
		
		var town = inputTown.val();

		//console.log(town);
		selectStreetByTown(town, null);
		
	});
	
	
	//добавление, сохранение записи
	$('#btnSave').click( function (event) {
		var ok = true;
		var idphone =inputId.val();
		
		$('.form-group').each(function(){
			$(this).removeClass('has-error');
			$(this).removeClass('has-success');
		})
		
		$(".form-control").each(function(ind){
			if ( !this.checkValidity() ) {
				$(this).parents('.form-group').addClass('has-error').removeClass('has-success');
				//console.log("bad-"+$(this).attr("id"));
				ok = false;
				return false;
				
			} else {
				$(this).parents('.form-group').addClass('has-success').removeClass('has-error');
				//console.log("good-"+$(this).attr("id"));
			}	
		})
		
		if (!ok) return;
		
		
		$(".selectpicker").each(function(ind){
			if ( !this.checkValidity() || $(this).prop( 'disabled')) {
				$(this).parents('.form-group').addClass('has-error').removeClass('has-success');
				//console.log($(this).attr("id"));
				ok = false;
				return false;
				
			} else
				$(this).parents('.form-group').addClass('has-success').removeClass('has-error');
			
			
		})
		
		if (!ok) return;
		
		//готовим к отправке
		var str = modal.find('.formphone').serialize();
		//console.log(str);
		
		//return;
		
		
		$.ajax({
			type: "POST",	
			url: "/index/insupd",	
			dataType: "json",	
			data: str+"&ajax=1",	
			error: function ( jqXHR, textStatus, errorThrown) {	
				//alert( "При выполнении запроса index/insupd произошла ошибка" );	
				console.log(errorThrown);
				console.log(jqXHR.responseText);
				modal.modal('hide');
			},
			success: function ( data ) { 
				if (data) {
					//console.log(idphone);
					//console.log(data);
					
					if (idphone<=0) {
						//добавить строку в таблицу
						var newrow = $('.rowphone').first().clone(true);
						
						newrow.appendTo($("table.phonebook"));
						
						newrow.attr("id","id"+data.id);
					} 
					
					//обновить строку в таблице
					//console.log($('.rowphone#id'+idphone+" td ").data('field'));
					
					$('.rowphone#id'+data.id+" td ").each(function(index){
						
						switch ( $( this ).data('field') ) {
							case "fio" : $( this ).text(data.f+ " "+ data.i + " "+ data.o); break;
							case "birthday" : $( this ).text(data.birthday); break;
							case "phone" : $( this ).text(data.phone); break;
							case "address" : $( this ).text( "г. " + 
									  $("#inputTown option:selected").text() + ", " + 
									  $("#inputStreet option:selected").text() + 
									  " (" + $("#inputTown option:selected").closest('optgroup').attr('label') + ")");
							
							break;
						}
						
					});
					
						
					
					
					
				} else alert ("Ошибка данных. Обновите страницу");
				
				modal.modal('hide');
			}
		}); //ajax
		
		
	})
	
	
	//удалить запись
	 $('.delphone').click(function(event) {
		 var idphone = $(event.target).data('idphone');
		 
		 //console.log(idphone);
		 
		 if (confirm("Удалить телефон?")) {
			 
			 $.ajax({
					type: "POST",	
					url: "/index/del",	
					dataType: "json",	
					data: "id=" + idphone + "&ajax=1",	
					error: function ( jqXHR, textStatus, errorThrown) {	
						//alert( "При выполнении запроса index/del произошла ошибка" );	
						console.log(errorThrown);
						console.log(jqXHR.responseText);
					},
					success: function ( data ) { 
						
						if (data) {
							//console.log($('.rowphone#id'+idphone));
							$('.rowphone#id'+idphone).remove();
							
							//console.log(idphone);
							
						} else alert ("Ошибка данных. Обновите страницу");
					}
				}); //ajax
		 }
		 
		 return false;
    });
	
	
	
}(jQuery)); //$===jQuery

