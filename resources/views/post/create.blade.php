@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>
            Post Page
        </h1>
    </div>
    @if (strlen($aAlert['type']) > 0)
        <div class="alert alert-block alert-{{ $aAlert['type'] }}">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>

            <i class="ace-icon fa fa-{{ $aAlert['type'] === 'success' ? 'check' : 'close' }} green"></i>
            {{ $aAlert['msg'] }}
        </div>
    @endif
    <div class="col-sm-12">
        <form class="form-horizontal" role="form" action="{{ route('post') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label class="col-sm-3 control-label no-padding-right" for="title"> Title </label>

                <div class="col-sm-9">
                    <input type="text" id="title" name="title" placeholder="Title"
                           class="col-xs-10 col-sm-5" value="{{ old('title') }}" required>
                    @if ($errors->has('title'))
                        <span class="help-inline col-xs-12 col-sm-12">
                        <span class="middle"><i>{{ json_decode($errors)->title[0] }}</i></span>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label class="col-sm-3 control-label no-padding-right" for="description"> Description </label>

                <div class="col-sm-9">
                    <input type="text" id="description" name="description" placeholder="Description"
                           class="col-sm-12 col-xs-12" value="{{ old('description') }}" required>
                    @if ($errors->has('description'))
                        <span class="help-inline col-xs-12 col-sm-12">
                        <span class="middle"><i>{{ json_decode($errors)->description[0] }}</i></span>
                    </span>
                    @endif
                </div>

            </div>

            <div class="form-group {{ $errors->has('seq') ? 'has-error' : '' }}">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="food">Recipient/s</label>
                <input type="hidden" id="seq" name="seq" value=""/>
                <div class="col-xs-12 col-sm-9">
                    <select id="recipient" name="recipient[]" class="multiselect" multiple="">
                        @foreach ($aRecipient as $oRecipient)
                            <option value="{{ $oRecipient->id }}">{{ $oRecipient->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('seq'))
                        <span class="help-inline col-xs-12 col-sm-12">
                        <span class="middle"><i>Please select at least 1 recipient.</i></span>
                    </span>
                    @endif
                </div>
            </div>

            <div class="hr hr-16 hr-dotted"></div>

            <div id="fuelux-wizard-container">
                <div>
                    <ul class="steps">

                    </ul>
                </div>
            </div>

            <div class="clearfix form-actions">
                <div class="col-md-offset-5 col-md-7">
                    <button class="btn btn-info" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>

                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
                </div>
            </div>

        </form>
    </div>

@endsection

@section('page-level-script')
    <script src="{{ asset('assets/js/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.raty.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-multiselect.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-typeahead.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            function generateStep(aStep, aName) {
                var iRecipients = 0;
                var sStepLi = '';
                var oStep = $('.steps');

                aStep.map(function (value, index) {
                    var iCounter = index + 1;
                    var sName = aName[index];
                    sStepLi += '<li data-step="' + iCounter + '">' +
                        '<span class="step">' + iCounter + '</span>' +
                        '<span class="title">' + sName + '</span>' +
                        '</li>';
                    iRecipients++;
                });

                if (iRecipients > 1) {
                    oStep.empty();
                    oStep.append(sStepLi);
                } else {
                    oStep.empty();
                }
            }

            $('#duallist').change(function () {

            });

            var aRecipient = [];
            var aName = [];
            $('.recipient input[type="checkbox"]').on('change', function (e) {
                var oSelectedRecipient = $('#recipient').find('option[value="' + this.value + '"]');
                var oSeq = $('#seq');
                var iRecipientId = oSelectedRecipient.val();
                var sRecipientName = oSelectedRecipient.html();
                var bRecipientExists = (aRecipient.indexOf(iRecipientId) !== -1);
                var iRecipientIndex = (aRecipient.indexOf(iRecipientId));

                if (this.checked === true && bRecipientExists === false) {
                    aRecipient.push(iRecipientId);
                    aName.push(sRecipientName);
                } else if (bRecipientExists === true && iRecipientIndex !== -1) {
                    aRecipient.splice(iRecipientIndex, 1);
                    aName.splice(iRecipientIndex, 1);
                }

                if (aRecipient.length > 0 && aName.length > 0) {
                    oSeq.val(aRecipient.toString());
                } else {
                    oSeq.val('');
                }
                generateStep(aRecipient, aName);
            });
        });

        $('.multiselect').multiselect({
            enableFiltering: true,
            enableHTML: true,
            buttonClass: 'btn btn-white btn-primary',
            templates: {
                button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"><span class="multiselect-selected-text"></span> &nbsp;<b class="fa fa-caret-down"></b></button>',
                ul: '<ul class="multiselect-container dropdown-menu"></ul>',
                filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
                filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default btn-white btn-grey multiselect-clear-filter" type="button"><i class="fa fa-times-circle red2"></i></button></span>',
                li: '<li><a tabindex="0" class="recipient"><label></label></a></li>',
                divider: '<li class="multiselect-item divider"></li>',
                liGroup: '<li class="multiselect-item multiselect-group"><label></label></li>'
            }
        });

        $(document).one('ajaxloadstart.page', function (e) {
            $('.multiselect').multiselect('destroy');
        });
    </script>
@endsection

@section('page-level-style')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-duallistbox.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-multiselect.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}"/>
@endsection
