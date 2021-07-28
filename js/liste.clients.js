  $(document).ready(function () {
        var url = '/my_json_url';
        $('#mytype').inputpicker({
            width: '100%',
            height: 300,
            headShow: true,
            url: 'example-json.php',
            fields:['id','name','hasc'],
            fieldText:'name',
            fieldValue:'id',
            // responsive: true,
            autoOpen: true
        });
    });

    $("#mytype").parent().bind('resize', function(){
        console.log('resized');
    });;