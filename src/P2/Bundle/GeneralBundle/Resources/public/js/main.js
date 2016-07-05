//Initializing tooltips | This has a direct impact on website performance
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

//Initializing datepicker
  $(function() {
    $('.datepicker' ).datepicker({
        dateFormat: "yy-MM-dd",
        maxDate: "-18y",
        minDate: "-140y"
        });
  });

// AJAX for commpletting the addresses writting
  $(function() {

    $( "#p2_bundle_userbundle_administrator_address" ).autocomplete(
    {
      source:Routing.generate('addresses_autocomplete_ajax'),
      minLength: 2
    }
    );

  });

//Activating datatables
$(document).ready(function() {
    $('.p2datatable').DataTable( {
        createdRow: function ( row ) {
            $('td', row).attr('tabindex', 0);
        }
    } );
} );