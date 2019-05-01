@extends('admin.master')
@section('rootcontent')
    <section class="wrapper">
        <!-- //market-->

        <div class="market-updates">
            <a href="{{url('admin/section')}}">
            <div class="col-md-3 market-update-gd">
                <div class="market-update-block clr-block-2">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-database" style="font-size:48px"> </i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Section of University</h4>  
                        <p>Add or Remove sections</p>

                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            </a>

        <div class="market-updates">
            <a href="{{url('admin/section/teacher')}}">
            <div class="col-md-3 market-update-gd">
                <div class="market-update-block clr-block-2">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-institution" style="font-size:48px"> </i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Section teacher</h4>  
                        <p> Add or Remove Teachers</p>

                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            </a>
            <div class="market-updates">
            <a href="{{url('admin/section/student')}}">
            <div class="col-md-3 market-update-gd">
                <div class="market-update-block clr-block-2">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-group" style="font-size:48px"> </i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Section Student</h4>  
                        <p> Add or Remove Student</p>

                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            </a>

        <div class="market-updates">
            <a href="{{url('admin/subject')}}">
            <div class="col-md-3 market-update-gd">
                <div class="market-update-block clr-block-2">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-book" style="font-size:48px"> </i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Subject of University</h4>  
                        <p>Add or Remove Subjects</p>

                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            </a>
            <div class="clearfix"> </div>
            <div class="clearfix"> </div>
        </div>
        <div class="market-updates">
            <div class="clearfix"> </div>

        </div>
        <!-- //market-->
        <div class="row">
            <div class="panel-body">
            
            </div>
        </div>
        <div class="agil-info-calendar">
            <!-- calendar -->
            <div class="col-md-3"></div>
            <div class="col-md-6 agile-calendar">
                <div class="calendar-widget">
                    <div class="panel-heading ui-sortable-handle">
					<span class="panel-icon">
                      <i class="fa fa-calendar-o"></i>
                    </span>
                        <span class="panel-title"> Calendar Widget</span>
                    </div>
                    <!-- grids -->
                    <div class="agile-calendar-grid">
                        <div class="page">

                            <div class="w3l-calendar-left">
                                <div class="calendar-heading">

                                </div>
                                <div class="monthly" id="mycalendar"></div>
                            </div>

                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
            <!-- //calendar --> 
            <div class="clearfix"> </div>
        </div>
        <!-- tasks -->
    
        <!-- //tasks -->
    </section>
    @endsection
