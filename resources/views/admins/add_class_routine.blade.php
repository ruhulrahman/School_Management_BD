@extends('admins.admins_dashboard')
@section('page_content')
@section('title', 'Create Class Routine')

<style>

input[type="radio"], input[type="checkbox"] {
    /* margin: 4px 0 0; */
    margin: 0px 0px 0px 15px !important;
    line-height: normal;
}
</style>

            <!-- BEGIN PAGE HEADER-->   
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
            <!-- BEGIN PAGE CONTENT-->

            <div id="page-wraper">
                <div class="row-fluid">
                    <div class="span9">
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget red">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> @yield('title')</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                              <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>
                              <form action="{{ url('/create-class-routine') }}" method="post" id="scl_form">
                                {{ csrf_field() }}
                                <table class="table table-bordered">
                                  <tr>
                                    <td>Class</td>
                                    <td>

                                        <div id="class_id">
                                      <?php $classes = DB::table('class')->get(); ?>
                                        @foreach ($classes as $cls)
                                        <input type="radio" value="{{ $cls->id }}" name="class_id" id="class_id">
                                          {{ $cls->class_name }}
                                        @endforeach
                                        
                                        </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>Class Time</td>
                                    <td>
                                        <div id="time_id">
                                      <?php $class_time = DB::table('class_time')->where('scl_code', Session::get('SCL_code'))->orderBy('id', 'asc')->get(); ?>
                                        @foreach ($class_time as $c_time)
                                        <input type="radio" value="{{ $c_time->id }}" name="time_id" id="time_id">
                                          {{ $c_time->time }}
                                        @endforeach
                                        </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>Saturday</td>
                                    <td>
                                      <select name="saturday" id="saturday"  class="input-xlarge">
                                        <option value="">Select Subject</option>
                                        <?php $subjects = DB::table('subject')->orderBy('subject_name_en', 'asc')->get(); ?>
                                        @foreach ($subjects as $sub)
                                          <option value="{{ $sub->subject_name_en }}">{{ $sub->subject_name_en }}</option>
                                        @endforeach                            
                                      </select>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>Sunday</td>
                                    <td>
                                      <select name="sunday" id="sunday"  class="input-xlarge">
                                        <option value="">Select Subject</option>
                                        <?php $subjects = DB::table('subject')->orderBy('subject_name_en', 'asc')->get(); ?>
                                        @foreach ($subjects as $sub)
                                          <option value="{{ $sub->subject_name_en }}">{{ $sub->subject_name_en }}</option>
                                        @endforeach                             
                                      </select>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>Monday</td>
                                    <td>
                                      <select name="monday" id="monday"  class="input-xlarge">
                                        <option value="">Select Subject</option>
                                        <?php $subjects = DB::table('subject')->orderBy('subject_name_en', 'asc')->get(); ?>
                                        @foreach ($subjects as $sub)
                                          <option value="{{ $sub->subject_name_en }}">{{ $sub->subject_name_en }}</option>
                                        @endforeach                            
                                      </select>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>Tuesday</td>
                                    <td>
                                      <select name="tuesday" id="tuesday"  class="input-xlarge">
                                        <option value="">Select Subject</option>
                                        <?php $subjects = DB::table('subject')->orderBy('subject_name_en', 'asc')->get(); ?>
                                        @foreach ($subjects as $sub)
                                          <option value="{{ $sub->subject_name_en }}">{{ $sub->subject_name_en }}</option>
                                        @endforeach                             
                                      </select>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>Wednesday</td>
                                    <td>
                                      <select name="wednesday" id="wednesday"  class="input-xlarge">
                                        <option value="">Select Subject</option>
                                        <?php $subjects = DB::table('subject')->orderBy('subject_name_en', 'asc')->get(); ?>
                                        @foreach ($subjects as $sub)
                                          <option value="{{ $sub->subject_name_en }}">{{ $sub->subject_name_en }}</option>
                                        @endforeach                             
                                      </select>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>Thursday</td>
                                    <td>
                                      <select name="thursday" id="thursday"  class="input-xlarge">
                                        <option value="">Select Subject</option>
                                        <?php $subjects = DB::table('subject')->orderBy('subject_name_en', 'asc')->get(); ?>
                                        @foreach ($subjects as $sub)
                                          <option value="{{ $sub->subject_name_en }}">{{ $sub->subject_name_en }}</option>
                                        @endforeach                           
                                      </select>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>Sumission</td>
                                    <td>
                                        <input type="submit" class="btn btn-primary" value="Add Routine">
                                </div>
                                    </td>
                                  </tr>
                                </table>

                                </form>
                            </div>
                        </div>
                        <!-- END BASIC PORTLET-->
                    </div>
                </div>

@endsection