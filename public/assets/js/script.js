$(document).ready(function(){
    
    $(".chosen-select").chosen({width: '100%'});
    
    $('#registration_form').on('change', '#RegionSelect', function(){
        let terId = $(this).val();
        gethtmlOptionsforCityOrCityDistrictsSelect( terId );       
    });
    
    $('#registration_form').on('change', '#CitySelect', function(){
        let terId = $(this).val();
        gethtmlOptionsforCityDistrictsSelect( terId );
    }); 
    
    $('#registration_form').on('submit', function(e){
        e.preventDefault();

        if(formValidation()){
            let form = $(this);
            let data = form.serialize();
            
            $.ajax({
                url: 'user/create',
                method: 'POST',
                dataType: 'json',
                data: data,
                success: function(data){
                    if(data.status){
                        
                        alert('Регистрация прошла успешно.');
                        resetForm();
                    }else{
                        alert('Этот Email уже зарегистрирован.' );
                        location.href = data.url;
                    }
                }
            });
        }
    }); 
    
    function gethtmlOptionsforCityOrCityDistrictsSelect(terId){
        let status = false;
        $.ajax({
            url: 'register/cities',
            method: 'POST',
            dataType: 'json',
            data: {
                terId: terId
            },
            success: function(data){
                if(data.status){
                    $('#CityDistrictsSelect').closest('.form-group').addClass('d-none');
                    $('#CityDistrictsSelect').html('');
                    $('#CityDistrictsSelect').trigger("chosen:updated");
                    $('#CitySelect').html(data.htmlOptions);
                    $('#CitySelect').trigger("chosen:updated");
                    $('#CitySelect').closest('.form-group').removeClass('d-none');
                }else{
                    $('#CitySelect').closest('.form-group').addClass('d-none');                    
                    $('#CitySelect').html('');
                    $('#CitySelect').trigger("chosen:updated");
                    gethtmlOptionsforCityDistrictsSelect( terId );
                }
            }
        });      
    }
    
    function gethtmlOptionsforCityDistrictsSelect( terId ){
        $.ajax({
            url: 'register/citydistricts',
            method: 'POST',
            dataType: 'json',
            data: {
                terId: terId
            },
            success: function(data){
                if(data.status){
                    $('#CityDistrictsSelect').html(data.htmlOptions);
                    $('#CityDistrictsSelect').trigger("chosen:updated");
                    $('#CityDistrictsSelect').closest('.form-group').removeClass('d-none');
                }else{
                    $('#CityDistrictsSelect').closest('.form-group').addClass('d-none');
                    $('#CityDistrictsSelect').html('');
                    $('#CityDistrictsSelect').trigger("chosen:updated");
                }
            }
        });
    }
    
    function formValidation(){
        let reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        let errors = '';

        let name = $('#Name').val();
        let email = $('#Email').val();
        let region = $('#RegionSelect').val();
        let city = $('#CitySelect').val();
        let cityDistrict = $('#CityDistrictsSelect').val();
        
        if( 2 >= name.length ){
            errors += '\n - ФИО не может быть короче 2х символов';
        }else if ( 100 < name.length ){
            errors += '\n - ФИО не может быть короче 2х символов';
        }
        
        if( ! reg.test(email) ){
            errors += '\n - Введите корректный Email';
        }
        
        if( 0 == region ){
            errors += '\n - Необходимо выбрать область';            
        }
        if( 0 == city ){
            errors += '\n - Необходимо выбрать город';            
        }
        if( 0 == cityDistrict ){
            errors += '\n - Необходимо выбрать район города';            
        }
        
        if( '' == errors ){
            return true;
        }
        
        alert(errors);
        return false;        
    }
    
    function resetForm(){
        $('#RegionSelect').val(0);
        $('#RegionSelect').trigger("chosen:updated");
        $('#CitySelect').closest('.form-group').addClass('d-none');                    
        $('#CityDistrictsSelect').closest('.form-group').addClass('d-none');                    
        $('#btn_reset').trigger('click');
    }
});