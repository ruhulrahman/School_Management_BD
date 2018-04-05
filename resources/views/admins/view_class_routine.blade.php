@extends('index')
@section('page_content')

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
                     Class Routine
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="#">Home</a>
                           <span class="divider">/</span>
                       </li>
                       <li>
                           <a href="#">Class Routin</a>
                           <span class="divider">/</span>
                       </li>
                       <li class="active">
                           View Class Routine
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
                    <div class="span12">
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget red">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Class VI</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <table class="table table-bordered">
                                  <tr>
                                    <td>Select Your Class Name to view routine</td>
                                    <td>
                                      <form action="{{ url('/view-class-routine') }}" method="post">
                                        {{ csrf_field() }}
                                        <select name="class_id" id="">
                                          <option value="">Class Select</option>
                                          <?php $classes = DB::table('class')->get(); ?>
                                          @foreach ($classes as $cls)
                                            <option value="{{ $cls->id }}">{{ $cls->class_name }}</option>
                                          @endforeach                                        
                                        </select>
                                        <input type="submit" value="Sumit" class="btn btn-primary">
                                      </form>
                                    </td>
                                  </tr>
                                </table>
                                <br>
                                <h3>Class: Two Routine</h3>
                                <table class="table table-bordered">
                                    <thead>

                                      
                                    <tr>
                                      <th>Time/Day</th>
                                      <th>Saturday</th>
                                      <th>Sunday</th>
                                      <th>Monday</th>
                                      <th>Tuesday</th>
                                      <th>Wednesday</th>
                                      <th>Thursday</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($routine as $rtn)         
                                      <tr>
                                          <td>{{ $rtn->time }}</td>
                                          <td>{{ $rtn->saturday }}</td>
                                          <td>{{ $rtn->sunday }}</td>
                                          <td>{{ $rtn->monday }}</td>
                                          <td>{{ $rtn->tuesday }}</td>
                                          <td>{{ $rtn->wednesday }}</td>
                                          <td>{{ $rtn->thursday }}</td>
                                      </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END BASIC PORTLET-->
                    </div>
                </div>

@endsection