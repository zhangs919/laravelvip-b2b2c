<div id="{{ $uuid }}">
    <form class="form-horizontal" action="/user/user/card-search?id={{ $info['id'] }}" method="post">
        @csrf
        <div class="table-content m-t-10 clearfix">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        <span class="ng-binding">身份证号码：</span>
                    </label>
                    <div class="col-sm-9">
                        <label class="control-label">{{ $info['id'] }}</label>
                    </div>
                </div>
            </div>

            @if($info['status'])
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <span class="ng-binding">性别：</span>
                        </label>
                        <div class="col-sm-9">
                            <label class="control-label">{{ $info['sex'] }}</label>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <span class="ng-binding">出生日期：</span>
                        </label>
                        <div class="col-sm-9">
                            <label class="control-label">{{ $info['birthday'] }}</label>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <span class="ng-binding">户籍所在地：</span>
                        </label>
                        <div class="col-sm-9">
                            <label class="control-label">{{ $info['address'] }}</label>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-c m-t-10 m-b-10">{{ $info['error'] }}</div>
            @endif

        </div>
    </form>

</div>
