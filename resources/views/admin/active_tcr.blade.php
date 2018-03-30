@extends('index')
@section('page_content')
@section('title', 'Active Student Lists')

<style>
  table tr th{text-align: center !important;}
  table tr td{text-align: center !important;}
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
            <!-- BEGIN EDITABLE TABLE widget-->
             <div class="row-fluid">
                 <div class="span12">
                     <!-- BEGIN EXAMPLE TABLE widget-->
                     <div class="widget green">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> @yield('title')</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                         </div>
                         <div class="widget-body">
                             <div>
                                 <div class="clearfix">
                                     <div class="btn-group pull-right">
                                         <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
                                         </button>
                                         <ul class="dropdown-menu pull-right">
                                             <li><a href="#">Print</a></li>
                                             <li><a href="#">Save as PDF</a></li>
                                             <li><a href="#">Export to Excel</a></li>
                                         </ul>
                                     </div>
                                 </div>
                                 <div class="space15"></div>
                                 <?php
                                    $message = Session::get('message');
                                  ?>
                                @if ($message)
                                  <div class="text-center alert alert-success">
                                    {{ $message }}
                                    {{ Session::put('message', null) }}
                                 </div>
                                @endif
                                 <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                     <thead>
                                     <tr style="text-align: center;">
                                         <th>SL.</th>
                                         <th>Name</th>
                                         <th>School Code</th>
                                         <th>Email</th>
                                         <th>Phone</th>
                                         <th>Address</th>
                                         <th>Rank</th>
                                         <th>Power</th>
                                         <th>Action</th>
                                     </tr>
                                     </thead>
                                     <tbody>
                                      <?php
                                        $i = 1;
                                      ?>
                                      @if (count($active_tcr) > 0)
                                        @foreach ($active_tcr as $user)
                                       <tr class="">
                                           <td>{{ $i++ }}</td>
                                           <td>{{ $user->name }}</td>
                                           <td>{{ $user->scl_code }}</td>
                                           <td>{{ $user->email }}</td>
                                           <td>{{ $user->phone }}</td>
                                           <td>{{ $user->district_name.', '.$user->thana_name.', '.$user->address }}</td>
                                           <td>{{ $user->rank }}</td>
                                           <td><span class="label label-success">{{ $user->power }}</span></td>
                                           <td>
                                          @if ($user->power == 'admin')
                                            <a class="btn btn-danger" href="{{ url('/remove-admin') }}/{{ $user->id }}">Admin Remove</a>
                                          @elseif($user->power == 'block')
                                          <a class="btn btn-danger" href="{{ url('/tcr-unblock') }}/{{ $user->id }}">Unblock</a> ||
                                          @else
                                          <a class="btn btn-primary" href="{{ url('/make-admin') }}/{{ $user->id }}">Make Admin</a> || 

                                            <a class="btn btn-danger" href="{{ url('/tcr-deactivation') }}/{{ $user->id }}">Dective</a> ||
                                          <a class="btn btn-danger" href="{{ url('/tcr-delete') }}/{{ $user->id }}">Delete</a></td>
                                          @endif
                                       </tr>
                                       @endforeach
                                      @elseif(count($active_tcr) == 0)
                                         <tr class="aler alert-danger">
                                             <td colspan="7" style="text-align: center;">There is no active student now</td>
                                         </tr>
                                      @endif
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                     <!-- END EXAMPLE TABLE widget-->
                 </div>
             </div>

            <!-- END EDITABLE TABLE widget-->
@endsection