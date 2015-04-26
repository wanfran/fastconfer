$(document).ready(function(){
    $(function() {
        $(document.body).on('appear', '.conference-card', function(e, $affected) {
            // add class called “appeared” for each appeared element
            $(this).addClass('appeared');
        });
        $('.conference-card').appear({force_process: true});
    });

    $('select').select2();
});