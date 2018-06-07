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
    <div class="col-md-push-2 col-md-8">
        <div class="box box-solid">

            <div class="box-body">
                <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    State of the art prediction of HIV-1 protease cleavage sites. Rögnvaldsson et al.
                                    Bioinformat- ics, 2015, 1-7. doi: 10.1093/bioinformatics/btu810
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="box-body">
                                <strong>Motivation</strong>
                                <p>Understanding the substrate specificity of human immunodeficiency virus (HIV)-1
                                    protease is important when designing effective HIV-1 protease inhibitors.
                                    Furthermore, characterizing and predicting the cleavage profile of HIV-1 protease is
                                    essential to generate and test hypotheses of how HIV-1 affects proteins of the human
                                    host. Currently available tools for predicting cleavage by HIV-1 protease can be
                                    improved.</p>

                                <strong>Results</strong>
                                <p>The linear support vector machine with orthogonal encoding is shown to be the best
                                    predictor for HIV-1 protease cleavage. It is considerably better than current
                                    publicly available predictor services. It is also found that schemes using
                                    physicochemical properties do not improve over the standard orthogonal encoding
                                    scheme. Some issues with the currently available data are discussed.
                                <p>

                                    <strong>Availability and implementation</strong>
                                <p> The datasets used, which are the most important part, are available at the UCI
                                    Machine Learning Repository. The tools used are all standard and easily available.
                                <p>
                                <p>More information about this research can be found
                                    <a href="https://academic.oup.com/bioinformatics/article/31/8/1204/212810" target="_blank">here</a>.
                                </p>
                                <p>Please
                                    <a href="{{ asset('storage/data/hiv/hiv_predictions_manual _analysis.pdf') }}" target="_blank">click
                                        here</a> for a detailed manual analysis process for this dataset. </p>

                                <p>This dataset contains 160 predictors and two classes, being <strong>Cleaved</strong>
                                    the positive class. It uses quite a large amount to processing time and
                                    may not work with all the machine learning algorithms because of the nature of the
                                    data itself. This dataset has been found to work very well with the kNN and
                                    neural algorithms among others.</p>
                                <ul>
                                    <li><a href="{{ asset('storage/data/hiv/hiv_predictions.csv') }}">HIV prediction
                                            dataset</a></li>
                                    <li><a href="{{ asset('storage/data/hiv/hiv_training.csv') }}">HIV training
                                            dataset</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel box box-danger">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    D Ayres de Campos et al. (2000) SisPorto 2.0 A Program for Automated Analysis of
                                    Car- diotocograms. J Matern Fetal Med 5:311-318
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="box-body">
                                <strong>Objective</strong>
                                <p>To describe the latest version of SisPorto, a program for automated analysis of
                                    cardiotocograms that closely follows the FIGO guidelines, analyses ante‐ and
                                    intrapartum tracings, performs no signal reduction, and has the possibility of
                                    simultaneously recording twins.</p>

                                <strong>Methods</strong>
                                <p>A detailed description of the program's processing algorithms and operation is
                                    provided, as well as the main results of the studies performed to‐date with this
                                    system.</p>

                                <strong>Results</strong>
                                <p>Considering both current and previous versions of the program, SisPorto has been
                                    tested in over 6000 pregnancies. The system's FHR baseline was compared with an
                                    average of three experts' estimates, and the difference was under 8 bpm in all
                                    cases. A fair to good agreement was found with experts' identification of
                                    accelerations, decelerations, contractions, and normal/reduced variability
                                    (proportions of agreement 0.64–0.89). In a preliminary validity study (n = 85),
                                    a sensitivity of 100% and a specificity of 99% were obtained in prediction of
                                    poor neonatal outcome. The system is currently undergoing an international
                                    multicentre validation study.</p>

                                <strong>Conclusions</strong>
                                <p>Although still at the research level, a considerable experience has now been
                                    gathered with this system. Promising results have been achieved in studies
                                    comparing SisPorto with experts' analysis and in those evaluating the
                                    validity of the system. J. Matern.‐Fetal Med. 2000;9:311–318. © 2000
                                    Wiley‐Liss, Inc.</p>
                                <p>More information about this research can be found
                                    <a href="https://onlinelibrary.wiley.com/doi/abs/10.1002/1520-6661%28200009/10%299%3A5%3C311%3A%3AAID-MFM12%3E3.0.CO%3B2-9" target="_blank">here</a>.
                                </p>

                                <p>Please
                                    <a href="{{ asset('storage/data/cancer/cancer_predictions_manual _analysis.pdf') }}" target="_blank">click
                                        here</a> for a detailed manual analysis process for this dataset. </p>
                                <strong>Numerical Data</strong>

                                <p>There are two different data version for this study. The first data group is raw
                                    numerical data, while the the second has been transformed into factors for a more
                                    simple analysis process.</p>

                                <p>The numerical, and unprocessed, version of the data may fail with some algorithms
                                    because of the multiple zero values found in the samples. This is normal, as we do
                                    not expect LabRat to be successful with all the possible dataset and algorithm
                                    combinations.</p>

                                <p>On the other hand, the factorial version of the data works very well with all the
                                    algorithms and it is ideal to optimistically test the system.</p>
                                <ul>
                                    <li>
                                        <a href="{{ asset('storage/data/cancer/cancer_data_numerical_predict.csv') }}">Cancer
                                            numeric prediction dataset</a></li>
                                    <li>
                                        <a href="{{ asset('storage/data/cancer/cancer_data_numerical_training.csv') }}">Cancer
                                            numeric training dataset</a></li>
                                </ul>
                                <strong>Factor Data</strong>
                                <ul>
                                    <li><a href="{{ asset('storage/data/cancer/cancer_data_factors_predict.csv') }}">Cancer
                                            factor prediction dataset</a></li>
                                    <li><a href="{{ asset('storage/data/cancer/cancer_data_factors_training.csv') }}">Cancer
                                            factor training dataset</a></li>
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
