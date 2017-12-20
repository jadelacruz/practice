@extends('layouts.admin')

@section('content')



    <div class="row">

        <div class="col-xs-12 col-sm-3 center">
            <span class="profile-picture">
                <img id="avatar" class="editable img-responsive editable-click editable-empty" alt="Alex's Avatar"
                     src="/upload/avatar/{{ $aUser->avatar }}">
            </span>
            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                <div class="inline position-relative">
                    <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                        <span class="white">{{ strtoupper($aUser->name) }}</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="space-4"></div>

        <div class="col-xs-12 col-sm-9">
            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name"> Name</div>

                    <div class="profile-info-value">
                        <span class="editable editable-click"
                              id="name">{{ htmlspecialchars($aUser->name) }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> Email Address</div>

                    <div class="profile-info-value">
                        <span class="editable editable-click"
                              id="email">{{ htmlspecialchars($aUser->email) }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> Gender</div>

                    <div class="profile-info-value">
                        <span class="editable editable-click"
                              id="gender">{{ $aUser->gender === 'M' ? 'Male': 'Female'}}</span>
                    </div>
                </div>


            </div>
        </div>

    </div>
@endsection

