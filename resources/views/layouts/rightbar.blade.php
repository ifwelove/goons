<div class="right-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="right-bar-toggle float-right">
            <i class="fe-x noti-icon"></i>
        </a>
        <h4 class="m-0 text-white">{{ __('backend.settings') }}</h4>
    </div>
    <div class="slimscroll-menu">
        <!-- User box -->
        <div class="user-box">
            <div class="user-img">
                <img src="{{ URL::asset('assets/images/users/user.jpg') }}" alt="user-img" title="Mat Helme" class="rounded-circle img-fluid">
                <a href="javascript:void(0);" class="user-edit">
                    <i class="mdi mdi-pencil"></i>
                </a>
            </div>

            <h5>
                <a href="javascript: void(0);">{{ Auth::user()->username }}</a>
            </h5>

            <p class="text-muted mb-0">
                <small>{{ Auth::user()->getRoleName() }}</small>
            </p>
        </div>
        <div class="pl-3 pr-3">
            <h5 class="mt-0">{{ __('backend.search') }}</h5>
            <div class="inbox-item">
                <div class="app-search">
                    <div class="app-search-box">
                        <div class="input-group">
                            <input type="text" id="clientSearch" class="form-control" placeholder="Search...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content pl-3 pr-3">
            <div class="tab-pane show active" id="messages2">
                <div>
                    <div class="inbox-widget">
                        @if (!empty($usingClient))
                            <h5 class="mt-0">{{ __('backend.using') }}</h5>
                            @if (empty($usingClient['senders']) || is_null(session('subCode')))
                            <div class="inbox-item">
                                <div class="inbox-item-img">
                                    <img src="assets/images/users/user.jpg" class="rounded-circle" alt="">
                                    <i class="online user-status"></i>
                                </div>
                                <p class="inbox-item-author">
                                    <a href="client/clear" class="text-dark">{{ $usingClient['company_name'] }}</a>
                                </p>
                                <p class="inbox-item-text">{{ $usingClient['person_mail'] }}</p>
                            </div>
                            @else
                                @foreach ($usingClient['senders'] as $sender)
                                    @if ($sender['subcode'] == session('subCode'))
                                    <div class="inbox-item">
                                        <div class="inbox-item-img">
                                            <img src="assets/images/users/user.jpg" class="rounded-circle" alt="">
                                            <i class="online user-status"></i>
                                        </div>
                                        <p class="inbox-item-author">
                                            <a href="client/clear" class="text-dark">{{ $sender['subcode'] }}</a>
                                        </p>
                                        <p class="inbox-item-text">{{ $usingClient['person_mail'] }}</p>
                                    </div>
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </div> <!-- end inbox-widget -->
                </div> <!-- end .p-3-->
            </div>
        </div>
        <div class="tab-content pl-3 pr-3" id="clientList">
            <div class="tab-pane show active" id="messages1">
                <div>
                    <div class="inbox-widget">
                        @if (!empty($clients))
                            <h5 class="mt-0">{{ __('backend.list') }}</h5>
                            @foreach ($clients as $client)
                                @if (!empty($client['senders']))
                                    <div class="inbox-item">
                                        <div class="inbox-item-text">
                                            <a href="client/{{ $client['id'] }}" class="text-dark">[{{ $client['company_name'] }}]</a>
                                        </div>
                                    </div>
                                    @foreach ($client['senders'] as $sender)
                                    <div class="inbox-item">
                                        <div class="inbox-item-img">
                                            <img src="assets/images/users/user.jpg" class="rounded-circle" alt="">
                                            <i class="off-line user-status"></i>
                                        </div>
                                        <p class="inbox-item-author">
                                            <a href="client/{{ $client['id'] }}/{{ $sender['subcode'] }}" class="text-dark">{{ $sender['subcode'] }}</a>
                                        </p>
                                        <p class="inbox-item-text">{{ $client['person_mail'] }}</p>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="inbox-item">
                                        <div class="inbox-item-img">
                                            <img src="assets/images/users/user.jpg" class="rounded-circle" alt="">
                                            <i class="off-line user-status"></i>
                                        </div>
                                        <p class="inbox-item-author">
                                            <a href="client/{{ $client['id'] }}" class="text-dark">{{ $client['company_name'] }}</a>
                                        </p>
                                        <p class="inbox-item-text">{{ $client['person_mail'] }}</p>
                                    </div>
                                @endif
                            @endforeach
                        @endif
{{--                                                        <div class="text-center mt-2">--}}
{{--                                                            <a href="javascript:void(0);" class="text-muted"><i class="mdi mdi-spin mdi-loading mr-1"></i> Load more </a>--}}
{{--                                                        </div>--}}
                    </div> <!-- end inbox-widget -->
                </div> <!-- end .p-3-->
            </div>
        </div>
    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
