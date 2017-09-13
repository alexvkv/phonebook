<div class="page-header"><h1>Добро пожаловать!</h1></div>

<div class="container theme-showcase">

	<div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Редактирование</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal formphone">
					  <div class="form-group has-feedback">
					  	<label for="inputFamilya" class="col-sm-4 control-label">Фамилия</label>
					    <div class="col-sm-8">
					      <input type="hidden" class="form-control" id="inputId" name="id">	
					      <input type="text" class="form-control" id="inputFamilya" name="f" required pattern="[А-Яа-яЁё]{1}[А-Яа-яЁё\s\-]{1,}" placeholder="Фамилия">
					    </div>
					  </div>
					  <div class="form-group has-feedback">  
					    <label for="inputImya" class="col-sm-4 control-label">Имя</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="inputImya" name="i" required pattern="[А-Яа-яЁё]{1}[А-Яа-яЁё\s\-]{1,}" placeholder="Имя">
					    </div>
					   </div>
					  <div class="form-group has-feedback">
					    <label for="inputOtch" class="col-sm-4 control-label">Отчество</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="inputOtch" name="o" pattern="[А-Яа-яЁё]*[А-Яа-яЁё\s\-]*" placeholder="Отчество">
					    </div>
					  </div>
					  <div class="form-group has-feedback">
					    <label for="inputBirth" class="col-sm-4 control-label">Дата рождения</label>
					    <div class="col-sm-8">
					      <input type="date" class="form-control" id="inputBirth" name="birthday" min="1900-01-01" max="2010-01-01" required>
					    </div>
					  </div>
					  <div class="form-group has-feedback">
					    <label for="inputPhone" class="col-sm-4 control-label"><i class="glyphicon glyphicon-phone-alt"></i></label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="inputPhone" name="phone" required placeholder="Телефон">
					      
					    </div>
					  </div>
					  
					  <div class="form-group has-feedback">
					    <label for="inputStreet" class="col-sm-4 control-label">Адрес</label>
					    <div class="col-sm-8">
					      <select class="selectpicker" id="inputTown" required data-live-search="true" title="Город">
					      	<option value="Владивосток">Владивосток</option>
					      	<optgroup label="Приморский край">
    						<option>Владивосток</option>
    						</optgroup>
    					  </select>
  						  <select class="selectpicker" id="inputStreet" required data-live-search="true" title="Улица" name="address_id">
    						<option value="1">Нейбута</option>
    					  </select>
					    </div>
					  </div>
					  
					  
					  
					</form>
                </div>
                <div class="modal-footer">
                	<button class="btn btn-success" id="btnSave" type="button" data-success="modal">Ок</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Отмена</button>
                </div>
            </div>
        </div>
    </div>
    
	<h3><a href="#" data-toggle="modal" data-target="#modal-edit" data-idphone="0">Добавить запись</a></h3>
	
	<? if(!empty($phonebook)): ?>
			
			
			<h2>Телефонный справочник</h2>
			
			<table class="table table-striped phonebook"> 
				
				<thead>
					<tr>
					<th>ФИО &nbsp;<a href="/?sort=fio"><span class="glyphicon glyphicon-sort-by-attributes" ></span></a></th>
					<th>Дата рождения</th>
					<th>Адрес &nbsp;<a href="/?sort=addres"><span class="glyphicon glyphicon-sort-by-attributes" ></span></a></th>
					<th>Телефон &nbsp;<a href="/?sort=phone"><span class="glyphicon glyphicon-sort-by-attributes" ></span></a></th>
					<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				<? 
				$cnt = 0;
				foreach($phonebook as $fb):
					$cnt++; 
				?> 
					<tr class="rowphone" id = "id<?=$fb['id']?>">
					
					<td data-field="fio"><?=$fb['f']?> <?=$fb['i']?> <?=$fb['o']?></td>
					<td data-field="birthday"><?=$fb['birthday']?></td>
					
					<td data-field="address">г. <?=$fb['town'].", ".$fb['street']." (".$fb['subyect'] . ")" ?> </td>
					<td data-field="phone"><?=$fb['phone']?></td>
					<td><a href="#" data-toggle="modal" data-target="#modal-edit" data-idphone="<?=$fb['id']?>" data-addressid="<?=$fb['addressid']?>">
							<span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="редактировать"></span></a>
					    <a href="#">
					    	<span class="glyphicon glyphicon-remove-circle delphone" data-toggle="tooltip" title="удалить" data-idphone = "<?=$fb['id']?>" ></span></a></td>
					</tr>
				<? endforeach; ?>
				</tbody>
			</table>
			
			<? if($cnt >= 50): ?>
				<h3><a href="#" data-toggle="modal" data-target="#modal-edit" data-idphone="0">Добавить запись</a></h3>
			<? endif; ?>
			
	<? else: ?>
		<div class="alert alert-warning" role="alert">Телефонный справочник пустой</div>
	<? endif; ?>
			
		
	
	
</div>