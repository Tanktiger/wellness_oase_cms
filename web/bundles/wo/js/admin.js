$(document).on('ready', function() {
    $('.dropdown').dropdown({
    });

    $.datepicker.regional['de'] = {clearText: 'löschen', clearStatus: 'aktuelles Datum löschen',
        closeText: 'schließen', closeStatus: 'ohne Änderungen schließen',
        prevText: '<zurück', prevStatus: 'letzten Monat zeigen',
        nextText: 'Vor>', nextStatus: 'nächsten Monat zeigen',
        currentText: 'heute', currentStatus: '',
        monthNames: ['Januar','Februar','März','April','Mai','Juni', 'Juli','August','September','Oktober','November','Dezember'],
        monthNamesShort: ['Jan','Feb','Mär','Apr','Mai','Jun', 'Jul','Aug','Sep','Okt','Nov','Dez'],
        monthStatus: 'anderen Monat anzeigen', yearStatus: 'anderes Jahr anzeigen',
        weekHeader: 'Wo', weekStatus: 'Woche des Monats',
        dayNames: ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],
        dayNamesShort: ['So','Mo','Di','Mi','Do','Fr','Sa'],
        dayNamesMin: ['So','Mo','Di','Mi','Do','Fr','Sa'],
        dayStatus: 'Setze DD als ersten Wochentag', dateStatus: 'Wähle D, M d',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        initStatus: 'Wähle ein Datum', isRTL: false
    };
    $.datepicker.setDefaults($.datepicker.regional['de']);
    $( "#datepicker" ).datepicker({
        showWeek: true,
        firstDay: 1,
        //numberOfMonths: 2,
        changeMonth: true,
        changeYear: true,
        onSelect: function(date) {
            var domain = window.location.href.split('?')[0];
            document.location.href = domain + '?date=' + date;
        }
    });
    $( "#wo_mainbundle_offer_offerStart_date," +
    "#wo_mainbundle_offer_offerEnd_date").datepicker({
        showWeek: true,
        changeMonth: true,
        changeYear: true
    });
    if (typeof date_day != 'undefined' && typeof date_month != 'undefined' && typeof date_year != 'undefined') {
        $('#datepicker').datepicker("setDate", new Date(date_year,date_month-1,date_day) );
    }
    //Neues Event
    $(document).on('click', '.openModalButton', function() {
        toggleOverlay();
        $.ajax({
            type:'GET',
            url: $(this).data('href'),
            data: {'date' : $(this).data('date'),
                'employee': $(this).data('employee')
            },
            success: function(response) {
                $('#modal').html(response);
                toggleOverlay();
                $('#modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
        });

    });
    //editieren von events
    $(document).on('click', '.organizer-editable-cell', function() {
        toggleOverlay();
        $.ajax({
            type:'GET',
            url: $(this).data('href'),
            data: { 'startdate': $(this).parent('tr').data('time'),
                    'location_id': $(this).data('location-id')
                },
            success: function(response) {
                $('#modal').html(response);
                $("#wo_organizerbundle_event_day_date" ).datepicker({
                    showWeek: true,
                    changeMonth: true,
                    changeYear: true
                });
                toggleOverlay();
                $('#modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                //$('#modal').find('.modal-backdrop').remove();
            }
        });
    });
    //Löschen
    $(document).on('click', '.deleteButton', function() {
        toggleOverlay();
        $.ajax({
            type:'GET',
            url: $(this).data('href'),
            success: function(response) {
                $('#delete_modal').html(response);
                toggleOverlay();
                $('#delete_modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
        });
    });
    //Löschen von Arbeitszeiten und Events
    $(document).on('click', '.deleteWorktime, .deleteEvent', function(e) {
        e.stopPropagation();
        e.preventDefault();
        var form = $(this).closest('form');
        toggleOverlay();
        $.ajax({
            type:'POST',
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response) {
                if (response.success == true) {
                    location.reload();
                }
                toggleOverlay();
            }
        });
    });
    //$("#modal").draggable({
    //    handle: ".modal-header"
    //});
    //TODO: umbauen das Fenster aufgeht und gefragt wird ob der wirklich ersetzt werden soll
    $(document).on('click', '#wo_organizerbundle_event_submit', function(e) {
        e.stopPropagation();
        e.preventDefault();
        var form = $('form[name="wo_organizerbundle_event"]');
        toggleOverlay();
        $.ajax({
            type:'POST',
            url: form.data('check-url'),
            data: {
                    'dateStartHour': $('#wo_organizerbundle_event_dateStart_time_hour').val(),
                    'dateStartMinute': $('#wo_organizerbundle_event_dateStart_time_minute').val(),
                    'dateEndHour': $('#wo_organizerbundle_event_dateEnd_time_hour').val(),
                    'dateEndMinute': $('#wo_organizerbundle_event_dateEnd_time_minute').val(),
                    'date': $('#wo_organizerbundle_event_day_date').val(),
                    'locationId': $('#wo_organizerbundle_event_location').val()
            },
            success: function(response) {
                if (response.success == true) {
                    form.submit();
                } else {
                    $('#delete_modal').html(response.event.deleteForm);
                    toggleOverlay();
                    $('#delete_modal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                }
            }
        });
    });
    //überschreiben von events
    $(document).on('click', '.overwriteYesButton', function(e) {
        e.stopPropagation();
        e.preventDefault();
        var form = $(this).closest('form');
        toggleOverlay();
        $.ajax({
            type:'POST',
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response) {
                if (response.success == true) {
                    $('form[name="wo_organizerbundle_event"]').submit();
                } else {
                    toggleOverlay();
                    form.append('<div class="alert alert-danger" role="alert">Beim Speichern ist etwas schief gelaufen. Bitte probieren Sie es später erneut!</div>');
                }
            }
        });
    });
    //availableEvents = [];
    //Autocomplete von Anwendungen bei eventerstellung
    $(document).on('focusin', "#wo_organizerbundle_event_info", function() {
//        console.log(availableServices);
        $(this).autocomplete({
            source: availableServices,
            minLength: 1,
            appendTo: '#autocomplete-container'
        });
    });
});

function toggleOverlay() {
    $('.overlay').toggle();
}