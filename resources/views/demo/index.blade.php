@extends('adminlte::page')

@section('title', __('Demo Data'))

@section('content_header')
    <h1>
        <i class="fa fa-database"></i> @lang('Demo Data')
        <small>@lang('Download demo data')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li class="active"><i class="fa fa-database"></i> @lang('Download Demo Data')</li>
    </ol>
@stop

@section('content')
    <div class="col-md-push-3 col-md-6">
        <div class="box box-solid">

            <div class="box-body">
                <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    HIV DNA Orthogonal Data
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="box-body">
                               This dataset contains 120 predictors and only teo single classes (cleaved/uncleaved)
                                <ul>
                                    <li><a href="{{ asset('storage/data/hiv/hiv_predictions.csv') }}">HIV prediction dataset</a> </li>
                                    <li><a href="{{ asset('storage/data/hiv/hiv_training.csv') }}">HIV training dataset</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel box box-danger">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    Cancer Numerical Data
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="box-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                labore sustainable VHS.
                                <ul>
                                    <li><a href="{{ asset('storage/data/cancer/cancer_data_numerical_predict.csv') }}">Cancer numeric prediction dataset</a> </li>
                                    <li><a href="{{ asset('storage/data/cancer/cancer_data_numerical_training.csv') }}">Cancer numeric training dataset</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                    Cancer Factor Data
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="box-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                labore sustainable VHS.
                                <ul>
                                    <li><a href="{{ asset('storage/data/cancer/cancer_data_factors_predict.csv') }}">Cancer factor prediction dataset</a> </li>
                                    <li><a href="{{ asset('storage/data/cancer/cancer_data_factors_training.csv') }}">Cancer factor training dataset</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@stop
