<?php echo $__env->make('_partials.header_content',['breadcrumb'=>['Calendar Engine','Bank Calendar']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header">
                    <h3 class="box-title">Bank Calendar</h3>
                </div>
                <form class="form-horizontal">

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>

                </form>
           </div>
        </div>
    </div>

</section>

<script>


    $(document).ready(function () {
        var id = '<?php echo e($service); ?>';
        var events_calendar = [];
        /* Initialize fullCalendar*/
        $('#calendar').fullCalendar({
            themeSystem:'bootstrap3',
            lazyFetching:false,
            navLinks: false,
            header:{
                left:   'prev,today,next',
                center: 'title',
                right:  'btn_addHoliday'
            },
            customButtons: {
                btn_addHoliday: {
                    text: 'Add Holiday',
                    click: function() {
                        var res = app.setView(id,'add');
                        if(res=='done'){
                            $('#type').val('add');
                            setForm('','');
                        }
                    }
                }
            },
            displayEventTime: false,
            eventLimit: true, // for all non-agenda views
            views: {
                month: {
                    eventLimit: 3 // adjust to 6 only for agendaWeek/agendaDay
                }
            },
            events: function(start, end, timezone, callback) {
                var date = new Date($('#calendar').fullCalendar('getDate'));
                var month_int = date.getMonth()+1;
                var year_int = date.getFullYear();
                var current_month = zeroPad(month_int,2);
                var current_year = year_int;
                var loginId = '<?php echo Session::get('userId') ?>';
                var value = {
                    month: current_month,
                    year: current_year,
                    loginId: loginId,
                    currentPage: "1",
                    pageSize: "20",
                    orderBy: {"holidayDate": "ASC"}
                };
                var url_action = 'search';
                var action = 'SEARCH';
                var result_key='result';

                jQuery.ajax({
                    url: 'getAPIData',
                    method: 'post',
                    cache:false,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        //start: start.format(),
                        //end: end.format(),
                        value : value,
                        menu : id,
                        url_action : url_action,
                        action : action,
                        result_key : result_key,

                        _token : '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(data) {
                        events_calendar = [];
                        if(!!data.result){

                            $.map( data.result, function( r ) {

                                var event_backColor = '#FFCFDB';
                                var event_textColor = '#FF0000';
                                if(r.type=='EVENT'){
                                    event_backColor = '#DAE3F3';
                                    event_textColor ='#0070C0';
                                } else if(r.type=='CURRENCY'){
                                    event_backColor = '#F3EADA';
                                    event_textColor = '#FCA000';
                                }
                                if(!!r.holidayDate) {
                                    events_calendar.push({
                                        title: r.holidayDscp,
                                        start: moment(r.holidayDate, 'DD/MM/YYYY').utc(7).format("YYYY-MM-DDTHH:mm:ss.SSS[Z]"),
                                        type: r.type,
                                        ccy: r.currencyCode,
                                        backgroundColor:event_backColor,
                                        textColor:event_textColor

                                    });
                                }
                            });
                        }
                        callback(events_calendar);
                        //Add custom hyperlink day
                        $('.fc-day-number').each(function(){
                            var day_number = $(this);
                            var data_date = day_number.parent().data('date');
                            $.each(events_calendar, function (key,val) {
                                var event_date = moment(val.start).format('YYYY-MM-DD');
                                if(data_date===event_date){
                                    day_number.css("text-decoration","underline");
                                    day_number.hover(function() {
                                        $(this).css('cursor','pointer');
                                    });
                                }
                            });


                        });


                    }
                });
            },
            dayClick: function(date, jsEvent, view) {

                var events = $('#calendar').fullCalendar('clientEvents');
                var today_date = moment(date.toDate()).utc(0).format("YYYY-MM-DDTHH:mm:ss.SSS[Z]");
                var today_event = [];
                for (var i = 0; i < events.length; i++) {
                    if (moment(date).isSame(moment(events[i].start))) {
                        //console.log(events_calendar);
                        if(!!events_calendar){

                            $.map( events_calendar, function( r ) {

                                var holidayDate = r.start;

                                if(holidayDate===today_date) {
                                    today_event.push({
                                        title: r.title,
                                        start: moment(holidayDate).format('DD/MM/YYYY'),
                                        type: (r.type != 'CURRENCY' ? r.type : (r.type + '  -  ' + r.ccy)) 
                                    });
                                }
                            });
                        }
                        //console.log(today_date);
                        var res = app.setView(id,'detail');
                        if(res=='done'){
                            getMatrix(moment(today_date).format('DD/MM/YYYY'),today_event);
                        }
                        break;
                    }
                    else if (i == events.length - 1) {
                        break;
                    }
                }
            }

        });
        /*fullCalendar Styling*/
        $("<style type='text/css'> " +
            ".fc-day-header{ background-color: #1f71b9 !important; } " +
            ".fc-day-header{ color: #ffffff !important; } " +
            ".fc-day{ background-color: #ffffff !important; } " +
            ".fc-day.fc-today{ background-color: rgb(221,235,247) !important; } " +
            ".alert-info{ background-color: rgb(221,235,247) !important; } " +
            ".fc-day-header.fc-sun{ background-color: #ff7e79 !important; } " +
            ".fc-day-header.fc-sat{ background-color: #ff7e79 !important; } " +
            ".fc-prev-button{ background-color: #ffffff !important;border-color: #1f71b9 !important;; color: #1f71b9 } " +
            ".fc-next-button{ background-color: #ffffff !important;border-color: #1f71b9 !important;; color: #1f71b9 } " +
            ".fc-today-button{ background-color: #ffffff !important;border-color: #1f71b9 !important;; color: #1f71b9 } " +

            "</style>").appendTo("head");

        $(".fc-btn_addHoliday-button").addClass('btn-info').removeClass('btn-default'); // Button 'Add Holiday' Styling


        $('#search').on('click', function () {

            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();
            var value = {
                code: $('#code').val(),
                name: $('#name').val(),
                currentPage: "1",
                pageSize: "20",
                orderBy: {"code": "ASC"}
            };

        });

    });

    function zeroPad(num, places) {
        var zero = places - num.toString().length + 1;
        return Array(+(zero > 0 && zero)).join("0") + num;
    }



</script><?php /**PATH D:\Downloads\Upgrade Laravel Framework\bank-line\resources\views/bank-line/MNU_GPCASH_MT_CALENDAR/landing.blade.php ENDPATH**/ ?>