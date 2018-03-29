@extends('index')
@section('page_content')
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
                     Teachers List
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="#">Home</a>
                           <span class="divider">/</span>
                       </li>
                       <li>
                           <a href="#">Teachers</a>
                           <span class="divider">/</span>
                       </li>
                       <li class="active">
                           View School Teachers
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
                        <div class="widget green">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Teacher's List</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                              <span style="" class="pull-right label label-success">
                                <?php $message = Session::get('message'); ?>
                                @if ($message)
                                  {{ $message }}
                                  <?php Session::put('message', null); ?>
                                @endif
                                </span>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>SL. No.</th>
                                        <th>Teacher's Name</th>
                                        <th>Rank</th>
                                        <th>Current Power</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                      <?php $i= 1; ?>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->rank }}</td>
                                        <td>{{ $user->power }}</td>
                                        <td>
                                          @if ($user->power == 'admin')
                                            <a class="btn btn-danger" href="{{ url('/remove-admin') }}/{{ $user->id }}">Admin Remove</a>
                                          @elseif($user->power == 'block')
                                          <a class="btn btn-danger" href="{{ url('/tcr-unblock') }}/{{ $user->id }}">Unblock</a> || 
                                          <a class="btn btn-danger" href="{{ url('/tcr-delete') }}/{{ $user->id }}">Delete</a>

                                          @else

                                          <a class="btn btn-primary" href="{{ url('/make-admin') }}/{{ $user->id }}">Make Admin</a> || 
                                          <a class="btn btn-danger" href="{{ url('/tcr-block') }}/{{ $user->id }}">Block</a> || 
                                          <a class="btn btn-danger" href="{{ url('/tcr-delete') }}/{{ $user->id }}">Delete</a>
                                          @endif
                                           </td>
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