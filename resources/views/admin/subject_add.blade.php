@extends('index')
@section('page_content')
@section('title', 'Add Subject')
<style>
  table tr th{text-align: center !important;}
  table tr td{text-align: center !important;}
</style>
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
                     @yield('title') Page
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
                            <form action="{{ url('/subject-create') }}" method="post" id="scl_form" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="control-group">
                                    <label for="subject_name_en" class="control-label">Add New Subject Name (English Version)</label>
                                    <div class="controls">
                                        <input type="text" name="subject_name_en" id="subject_name_en" placeholder="Enter subject name (English)" style="display: block;" class="input-large" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="subject_name_bn" class="control-label">Add New Subject Name (Bangla Version)</label>
                                    <div class="controls">
                                        <input type="text" name="subject_name_bn" id="subject_name_bn" placeholder="Enter subject name (Bangla)" style="display: block;" class="input-large" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="submit" class="btn btn-primary" value="Add Subject">
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
                                    <th>Subject Name (English Version)</th>
                                    <th>Subject Name (Bangla Version)</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i= 1; ?>
                                @if (count($subjects) > 0)
                                  @foreach ($subjects as $sub)
                                  <tr>
                                      <td>{{ $i++ }}</td>
                                      <td>{{ $sub->subject_name_en }}</td>
                                      <td>{{ $sub->subject_name_bn }}</td>
                                      <td><a class="btn btn-primary" href="{{ url('/subject-edit') }}/{{ $sub->id }}">Edit</a>
                                      </td>
                                  </tr>
                                  @endforeach
                                @else
                                  <tr>
                                    <td colspan="3"><span style="color: red">Subject Not created</span></td>
                                  </tr>
                                @endif
                                </tbody>
                                </table>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>
@endsection