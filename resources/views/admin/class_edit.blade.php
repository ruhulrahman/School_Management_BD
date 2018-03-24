@extends('index')
@section('page_content')
@section('title', 'Classes List')

            <div class="row-fluid">
               <div class="span12">
                   <!-- BEGIN THEME CUSTOMIZER-->
                   <div id="theme-change" class="hidden-phone">
                       <i class="icon-cogs"></i>
                        <span class="settings">
                            <span class="text">Theme Color:</span>
                            <span class="colors">
                                <span class="color-default" data-style="default"></span>
                                <span class="color-green" data-style="green"></span>
                                <span class="color-gray" data-style="gray"></span>
                                <span class="color-purple" data-style="purple"></span>
                                <span class="color-red" data-style="red"></span>
                            </span>
                        </span>
                   </div>
                   <!-- END THEME CUSTOMIZER-->
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                     @yield('title')
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="#">Home</a>
                           <span class="divider">/</span>
                       </li>
                       <li class="active">
                           @yield('title')
                       </li>
                       <li class="pull-right search-wrap">
                           <form action="http://thevectorlab.net/metrolab/search_result.html" class="hidden-phone">
                               <div class="input-append search-input-area">
                                   <input class="" id="appendedInputButton" type="text">
                                   <button class="btn" type="button"><i class="icon-search"></i> </button>
                               </div>
                           </form>
                       </li>
                   </ul>
                   <!-- END PAGE TITLE & BREADCRUMB-->
               </div>
            </div>
            <!-- END PAGE HEADER-->

              <a href="{{ url('/classes_list') }}" class="btn btn-danger">Add Class</a><hr/>
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <div class="span5">
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> @yield('title')</h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>
                            <!-- BEGIN FORM-->
                            <form action="{{ url('/class-update') }}" method="post" id="scl_form" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="control-group">
                                    <label for="class_name" class="control-label">Class Name</label>
                                    <div class="controls">
                                      @foreach ($class as $cls)
                                        <input type="hidden" name="class_id" value="{{ $cls->id }}">             
                                        <input type="text" name="class_name" id="class_name" value="{{ $cls->class_name }}" placeholder="Enter class name" class="input-medium" />
                                      @endforeach
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="submit" class="btn btn-primary" value="Update Class">
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>

                <div class="span7">
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                    <div class="widget red">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> @yield('title')</h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                             <?php
                                $message = Session::get('message');
                              ?>
                            @if ($message)
                              <div class="text-center alert alert-success">
                                {{ $message }}
                                {{ Session::put('message', null) }}
                             </div>
                            @endif
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>SL. No.</th>
                                    <th>Class Name</th>
                                    <th>Actiion</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i= 1; ?>
                                @foreach ($classes as $class)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $class->class_name }}</td>
                                    <td><a class="btn btn-primary" href="{{ url('/class_edit') }}/{{ $class->id }}">Edit</a> 
                                        || <a href="{{ url('/class_delete') }}/{{ $class->id }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                                </table>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>
@endsection