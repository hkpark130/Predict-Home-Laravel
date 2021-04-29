$(function() {
    $('#btn').bind('click', function(event) {
        // event.preventDefault();
        if(!$('#submit-form')[0].checkValidity()){
            alert("입력값을 확인해주세요.");
            return ;
        }
        
        $('#btn').prop('disabled', true);
        var address = $('select[name=address]').val();
        var dis_to_station = $('input[name=dis_to_station]').val();
        var year_of_cons = $('input[name=year_of_cons]').val();
        var floors = $('input[name=floors]').val();
        var area = $('input[name=area]').val();
        
        var form = new FormData();
        form.append("dis_to_station", dis_to_station);
        form.append("year_of_cons", year_of_cons);
        form.append("floors", floors);
        form.append("area", area);
        form.append("address", address);

        var settings = {
            "url": "/house",
            "method": "POST",
            "timeout": 0,
            "processData": false,
            "mimeType": "multipart/form-data",
            "contentType": false,
            "data": form,
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        };

        var modal = $('#myModal');
        modal.find('.modal-body span').text('통신중');
        modal.modal('show');

        $.ajax(settings).done(function (response) {
            modal.removeClass('modal-open');
            $('#myModal-overlay').remove();
            $('#myModal').modal('hide');
            
            alert(response);
            $('#btn').prop('disabled', false);
        });
    });

});
