@extends('index')
@section('page_content');
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
            Creating Location
        </h3>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
                <span class="divider">/</span>
            </li>
            <li class="active">
                Location
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
    <div class="span12">
        <h4 class="text-success">
            <?php
            $message = Session::get('message');
            if ($message) {
                echo $message;
                Session::put('message', null);
            }
            ?>
        </h4>
        <div class="widget box purple">
            <div class="widget-title">
                <h4>
                    <i class="icon-reorder"></i> Create New Location</span>
                </h4>

                <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                    <a href="javascript:;" class="icon-remove"></a>
                </span>
            </div>
            <div class="widget-body">
                <div id="tabsleft" class="tabbable tabs-left">
                    <ul>
                        <li><a href="#tabsleft-tab1" data-toggle="tab"><span class="strong">Create Thana</span> <span class="muted">District Wise</span></a></li>
                        <li><a href="#tabsleft-tab2" data-toggle="tab"><span class="strong">Create District</span> <span class="muted">Division Wise</span></a></li>
                        <li><a href="#tabsleft-tab3" data-toggle="tab"><span class="strong">Create Division</span> <span class="muted">District Wise</span></a></li>
                        <li><a href="#tabsleft-tab4" data-toggle="tab"><span class="strong">Create Country</span></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-success print-success-msg text-center" style="display: none;"></div>
                        <div class="tab-pane" id="tabsleft-tab1">
                            <h3>Create a Thana</h3>
                            <form action="{{ URL::to('/thana-create') }}" method="post" id="scl_form">
                                {{ csrf_field() }}

                                <div class="control-group">
                                    <label class="control-label">Select Country</label>
                                    <div class="controls">
                                        <?php
                                        $countries = DB::table('country')->get();
                                        ?>
                                        <select name="country_id" id="country_id" onchange="ajaxGET('create_thana_division_id','{{URL::to('/division/')}}/'+this.value)">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                            @if ($country->country_name == 'Bangladesh')
                                            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                            @else
                                            <option value="{{ $country->id }}" disabled="disabled">{{ $country->country_name }}</option>
                                            @endif

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Select Division</label>
                                    <div class="controls">
                                        <?php
//                                        $divisions = DB::table('division')->get();
                                        ?>
                                        <select name="create_thana_division_id" id="create_thana_division_id" onchange="ajaxGET('create_thana_dist_id','{{URL::to('/district/')}}/'+this.value)">
                                            <option value="">Select Country First</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Select District</label>
                                    <div class="controls">
                                        <select name="create_thana_dist_id" id="create_thana_dist_id">
                                            <option value="">Select Division First</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Enter Police Station (Thana)</label>
                                    <div class="controls">
                                        <input type="text" name="thana" id="thana" placeholder="Enter Police Station Name" class="span6">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="submit" class="btn btn-primary" value="Add Police Station">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="tabsleft-tab2">
                            <h3>Create a District</h3>
                            <form action="{{ url('/district-create') }}" method="post">
                                {{ csrf_field() }}

                                <div class="control-group">
                                    <label class="control-label">Select Country</label>
                                    <div class="controls">
                                        <?php
                                        $countries = DB::table('country')->get();
                                        ?>
                                        <select name="country_id" id="country_id" onchange="ajaxGET('create_dist_division_id','{{URL::to('/division/')}}/'+this.value)">
                                            <option value="">Select Country First</option>
                                            @foreach ($countries as $country)
                                            @if ($country->country_name == 'Bangladesh')
                                            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                            @else
                                            <option value="{{ $country->id }}" disabled="disabled">{{ $country->country_name }}</option>
                                            @endif

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Select Division</label>
                                    <div class="controls">
                                        <select name="division_id" id="create_dist_division_id">
                                            <option value="">Select Country First</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Enter District Name</label>
                                    <div class="controls">
                                        <input name="district_name" type="text" class="span6" required="required">
                                    </div>
                                </div>                                        
                                <div class="control-group">
                                    <input type="submit" class="form-control btn btn-primary" value="Create">
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="tabsleft-tab3">
                            <h3>Create a Division</h3>
                            <form action="{{ url('/division-create') }}" method="post">
                                {{ csrf_field() }}

                                <div class="control-group">
                                    <label class="control-label">Select Country</label>
                                    <div class="controls">
                                        <?php
                                        $countries = DB::table('country')->get();
                                        ?>
                                        <select name="country_id" id="">
                                            @foreach ($countries as $country)
                                            @if ($country->country_name == 'Bangladesh')
                                            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                            @else
                                            <option value="{{ $country->id }}" disabled="disabled">{{ $country->country_name }}</option>
                                            @endif

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Enter Division Name</label>
                                    <div class="controls">
                                        <input name="division_name" type="text" placeholder="Enter Division Name" class="span6" required="required" />
                                    </div>
                                </div>
                                <input type="submit" class="form-control btn btn-primary" value="Create">
                            </form>
                        </div>
                        <div class="tab-pane" id="tabsleft-tab4">
                            <h3>Create a Country</h3>

                            <form action="{{ url('/country-create') }}" method="post">
                                {{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Enter Country Name</label>
                                    <div class="controls">
                                        <input name="country" type="text" placeholder="Enter Country Name" class="span6" required="required" />
                                        <span class="help-inline"></span>

                                        <input type="submit" class="form-control btn btn-primary" value="Create">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->


<script type="text/javascript">
    function ajaxGET(div, url, data) {
        var xmlhttp;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function () {
            $('#' + div).html("").css('color', '#000');
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                $('#' + div).append(xmlhttp.responseText);
//                document.getElementById(div).innerHTML = xmlhttp.responseText;
            } else {
                if (div == 'create_dist_division_id' || div == 'create_thana_division_id') {
                    document.getElementById(div).innerHTML = '<option value="">Select Country First</option>';
                    $('#' + div).css('color', 'red');
                } else if (div == 'create_thana_dist_id') {
                    document.getElementById(div).innerHTML = '<option value="">Select Division/State First</option>';
                    $('#' + div).css('color', 'red');
                } else if (div == 'org_cty') {
                    document.getElementById(div).innerHTML = '<option value="">Select Division/State First</option>';
                    $('#' + div).css('color', 'red');
                }
            }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send(data);
    }
</script>

@endsection
