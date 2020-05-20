<?php require_once dirname( __DIR__, 1 ) . '/views/layout/header.php'; ?>

<div class = "container">
    <h2><?= $title ?></h2>

    <form id="registration_form">
        <div class="form-group">
            <label for="Name">ФИО</label>
            <input type="test" class="form-control" name="name" id="Name">
        </div>
        <div class="form-group">
            <label for="Email">EMAIL</label>
            <input type="email" class="form-control" name="email" id="Email" aria-describedby="emailHelp">            
        </div>
        <div class="form-group">
            <label for="RegionSelect">Список областей</label>
            <select class="form-control chosen-select" name="territory[region]" data-placeholder="Выберите область" id="RegionSelect">
                    <option value="0"></option>
                <?php foreach ($regions as $region): ?>
                
                    <option value="<?= $region->ter_id ?>"><?= $region->ter_name ?></option>
                
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group d-none">
            <label for="CitySelect">Список городов</label>
            <select class="form-control chosen-select" name="territory[city]" data-placeholder="Выберите город" id="CitySelect">
                    
            </select>
        </div>
        <div class="form-group d-none">
            <label for="CityDistrictsSelect">Список районов</label>
            <select class="form-control chosen-select" name="territory[city_districts]" data-placeholder="Выберите район" id="CityDistrictsSelect" style="width: 690px">
                    
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        <button type="reset" id="btn_reset" class="btn btn-secondary">Очистить</button>
    </form>


</div>

<?php
require_once dirname(__DIR__, 1) . '/views/layout/footer.php';



