{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=2.0"/>
    <link rel="stylesheet" href="/css/mj-style.css?v=2.0"/>
@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix limit-discount-goods">
        <form id="LimitDiscountModel" class="form-horizontal" name="LimitDiscountModel" action="/dashboard/limit-discount/add" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
			<!-- 隐藏域 -->
            <input type="hidden" id="limitdiscountmodel-act_id" class="form-control" name="LimitDiscountModel[act_id]" value="{{ $model['act_id'] ?? '' }}">
            <!-- 套餐名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="limitdiscountmodel-act_name" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">活动名称：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="limitdiscountmodel-act_name" class="form-control" name="LimitDiscountModel[act_name]" value="{{ $model['act_name'] ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">活动名称必须在 1~20 个字内</div></div>
                    </div>
                </div>
            </div>
            <!--套餐有效期  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="limitdiscountmodel-start_time" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">活动有效期：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <input type="text" id="limitdiscountmodel-start_time" class="form-control form_datetime large" name="LimitDiscountModel[start_time]" value="{{ $start_time }}">
                            <span class="ctime">至</span>
                            <input type="text" id="limitdiscountmodel-end_time" class="form-control form_datetime large" name="LimitDiscountModel[end_time]" value="{{ $end_time }}">
                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 按周期重复 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="limitdiscountmodel-act_repeat" class="col-sm-3 control-label">

                        <span class="ng-binding">周期重复：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="LimitDiscountModel[act_repeat]" value="0">
                                    <label><input type="checkbox" id="limitdiscountmodel-act_repeat" class="switch-on-off"
                                                  name="LimitDiscountModel[act_repeat]" value="1"
                                                  @if(isset($model['ext_info']['act_repeat']) && $model['ext_info']['act_repeat'] == 1){{ 'checked' }}@endif
                                                  data-on-text="允许" data-off-text="禁止"> </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field act_repeat_item @if(empty($model['ext_info']['act_repeat'])){{ 'hide' }}@endif" style="margin-top: -10px">
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        <span class="ng-binding"></span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div class="model-box">
                                <label class="control-label pull-left cur-p">
                                    <input type="radio" class="icheck" name="timepicker" @if(isset($model['ext_info']['timepicker']) && $model['ext_info']['timepicker'] == 0)checked="checked"@endif  value='0'>
                                    每天
                                </label>
                                <div class="pull-left">
								<span class="time-select m-r-10">
									<select name="day_hour[begin_hour]" class="select form-control form-control-sm m-r-5">
										<!--   -->
										<option value="00" selected="selected">00</option>
                                        <!--   -->
										<option value="01" >01</option>
                                        <!--   -->
										<option value="02" >02</option>
                                        <!--   -->
										<option value="03" >03</option>
                                        <!--   -->
										<option value="04" >04</option>
                                        <!--   -->
										<option value="05" >05</option>
                                        <!--   -->
										<option value="06" >06</option>
                                        <!--   -->
										<option value="07" >07</option>
                                        <!--   -->
										<option value="08" >08</option>
                                        <!--   -->
										<option value="09" >09</option>
                                        <!--   -->
										<option value="10" >10</option>
                                        <!--   -->
										<option value="11" >11</option>
                                        <!--   -->
										<option value="12" >12</option>
                                        <!--   -->
										<option value="13" >13</option>
                                        <!--   -->
										<option value="14" >14</option>
                                        <!--   -->
										<option value="15" >15</option>
                                        <!--   -->
										<option value="16" >16</option>
                                        <!--   -->
										<option value="17" >17</option>
                                        <!--   -->
										<option value="18" >18</option>
                                        <!--   -->
										<option value="19" >19</option>
                                        <!--   -->
										<option value="20" >20</option>
                                        <!--   -->
										<option value="21" >21</option>
                                        <!--   -->
										<option value="22" >22</option>
                                        <!--   -->
										<option value="23" >23</option>

									</select>
									:
									<select name="day_hour[begin_minute]" class="select form-control form-control-sm m-l-5">
										<!--   -->

										<option value="00" selected="selected">00</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="05" >05</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="10" >10</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="15" >15</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="20" >20</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="25" >25</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="30" >30</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="35" >35</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="40" >40</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="45" >45</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="50" >50</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="55" >55</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="59" >59</option>


									</select>
								</span>
                                    至
                                    <span class="time-select m-l-10 m-r-10">
									<select name="day_hour[end_hour]" class="select form-control form-control-sm m-r-5">
										<!--   -->
										<option value="00" selected="selected">00</option>
                                        <!--   -->
										<option value="01" >01</option>
                                        <!--   -->
										<option value="02" >02</option>
                                        <!--   -->
										<option value="03" >03</option>
                                        <!--   -->
										<option value="04" >04</option>
                                        <!--   -->
										<option value="05" >05</option>
                                        <!--   -->
										<option value="06" >06</option>
                                        <!--   -->
										<option value="07" >07</option>
                                        <!--   -->
										<option value="08" >08</option>
                                        <!--   -->
										<option value="09" >09</option>
                                        <!--   -->
										<option value="10" >10</option>
                                        <!--   -->
										<option value="11" >11</option>
                                        <!--   -->
										<option value="12" >12</option>
                                        <!--   -->
										<option value="13" >13</option>
                                        <!--   -->
										<option value="14" >14</option>
                                        <!--   -->
										<option value="15" >15</option>
                                        <!--   -->
										<option value="16" >16</option>
                                        <!--   -->
										<option value="17" >17</option>
                                        <!--   -->
										<option value="18" >18</option>
                                        <!--   -->
										<option value="19" >19</option>
                                        <!--   -->
										<option value="20" >20</option>
                                        <!--   -->
										<option value="21" >21</option>
                                        <!--   -->
										<option value="22" >22</option>
                                        <!--   -->
										<option value="23" >23</option>

									</select>
									:
									<select name="day_hour[end_minute]" class="select form-control form-control-sm m-l-5">
										<!--   -->

										<option value="00" selected="selected">00</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="05" >05</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="10" >10</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="15" >15</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="20" >20</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="25" >25</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="30" >30</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="35" >35</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="40" >40</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="45" >45</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="50" >50</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="55" >55</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="59" >59</option>


									</select>
								</span>

                                </div>
                                <div class="clear m-b-5"></div>
                                <!---->
                                <label class="control-label pull-left cur-p">
                                    <input type="radio" class="icheck" name="timepicker" @if(isset($model['ext_info']['timepicker']) && $model['ext_info']['timepicker'] == 1)checked="checked"@endif value='1'>
                                    <input type="hidden" name="week" id="week" value=>
                                    每周
                                </label>
                                <div class="pull-left">
                                    <ul class="day-checked-box">
                                        <li data-val='1' >
                                            <a>周一</a>
                                            <i></i>
                                        </li>
                                        <li data-val='2' >
                                            <a>周二</a>
                                            <i></i>
                                        </li>
                                        <li data-val='3' >
                                            <a>周三</a>
                                            <i></i>
                                        </li>
                                        <li data-val='4' >
                                            <a>周四</a>
                                            <i></i>
                                        </li>
                                        <li data-val='5' >
                                            <a>周五</a>
                                            <i></i>
                                        </li>
                                        <li data-val='6' >
                                            <a>周六</a>
                                            <i></i>
                                        </li>
                                        <li data-val='7' >
                                            <a>周日</a>
                                            <i></i>
                                        </li>
                                    </ul>
                                    <span class="time-select m-l-10 m-r-10">
									<select name="week_hour[begin_hour]" class="select form-control form-control-sm m-r-5">
										<!--   -->
										<option value="00" selected="selected">00</option>
                                        <!--   -->
										<option value="01" >01</option>
                                        <!--   -->
										<option value="02" >02</option>
                                        <!--   -->
										<option value="03" >03</option>
                                        <!--   -->
										<option value="04" >04</option>
                                        <!--   -->
										<option value="05" >05</option>
                                        <!--   -->
										<option value="06" >06</option>
                                        <!--   -->
										<option value="07" >07</option>
                                        <!--   -->
										<option value="08" >08</option>
                                        <!--   -->
										<option value="09" >09</option>
                                        <!--   -->
										<option value="10" >10</option>
                                        <!--   -->
										<option value="11" >11</option>
                                        <!--   -->
										<option value="12" >12</option>
                                        <!--   -->
										<option value="13" >13</option>
                                        <!--   -->
										<option value="14" >14</option>
                                        <!--   -->
										<option value="15" >15</option>
                                        <!--   -->
										<option value="16" >16</option>
                                        <!--   -->
										<option value="17" >17</option>
                                        <!--   -->
										<option value="18" >18</option>
                                        <!--   -->
										<option value="19" >19</option>
                                        <!--   -->
										<option value="20" >20</option>
                                        <!--   -->
										<option value="21" >21</option>
                                        <!--   -->
										<option value="22" >22</option>
                                        <!--   -->
										<option value="23" >23</option>

									</select>
									:
									<select name="week_hour[begin_minute]" class="select form-control form-control-sm m-l-5">
										<!--   -->

										<option value="00" selected="selected">00</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="05" >05</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="10" >10</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="15" >15</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="20" >20</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="25" >25</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="30" >30</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="35" >35</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="40" >40</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="45" >45</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="50" >50</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="55" >55</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="59" >59</option>


									</select>
								</span>
                                    至
                                    <span class="time-select m-l-10 m-r-10">
									<select name="week_hour[end_hour]" class="select form-control form-control-sm m-r-5">
										<!--   -->
										<option value="00" selected="selected">00</option>
                                        <!--   -->
										<option value="01" >01</option>
                                        <!--   -->
										<option value="02" >02</option>
                                        <!--   -->
										<option value="03" >03</option>
                                        <!--   -->
										<option value="04" >04</option>
                                        <!--   -->
										<option value="05" >05</option>
                                        <!--   -->
										<option value="06" >06</option>
                                        <!--   -->
										<option value="07" >07</option>
                                        <!--   -->
										<option value="08" >08</option>
                                        <!--   -->
										<option value="09" >09</option>
                                        <!--   -->
										<option value="10" >10</option>
                                        <!--   -->
										<option value="11" >11</option>
                                        <!--   -->
										<option value="12" >12</option>
                                        <!--   -->
										<option value="13" >13</option>
                                        <!--   -->
										<option value="14" >14</option>
                                        <!--   -->
										<option value="15" >15</option>
                                        <!--   -->
										<option value="16" >16</option>
                                        <!--   -->
										<option value="17" >17</option>
                                        <!--   -->
										<option value="18" >18</option>
                                        <!--   -->
										<option value="19" >19</option>
                                        <!--   -->
										<option value="20" >20</option>
                                        <!--   -->
										<option value="21" >21</option>
                                        <!--   -->
										<option value="22" >22</option>
                                        <!--   -->
										<option value="23" >23</option>

									</select>
									:
									<select name="week_hour[end_minute]" class="select form-control form-control-sm m-l-5">
										<!--   -->

										<option value="00" selected="selected">00</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="05" >05</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="10" >10</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="15" >15</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="20" >20</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="25" >25</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="30" >30</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="35" >35</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="40" >40</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="45" >45</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="50" >50</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="55" >55</option>

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

                                        <!--   -->

										<option value="59" >59</option>


									</select>
								</span>

                                </div>
                                <div class="clear m-b-5"></div>
                                <!---->
                                <label class="control-label pull-left cur-p">
                                    <input type="radio" class="icheck" name="timepicker" @if(isset($model['ext_info']['timepicker']) && $model['ext_info']['timepicker'] == 2)checked="checked"@endif value='2'>
                                    每月
                                </label>
                                <div class="pull-left">

                                    <div class="m-b-5 month_day">
                                        <select name="month_day[]" class="form-control form-control-sm w100 m-r-10">
                                            <!--   -->

                                            <!--   -->

                                            <option value="01">1</option>

                                            <!--   -->

                                            <option value="02">2</option>

                                            <!--   -->

                                            <option value="03">3</option>

                                            <!--   -->

                                            <option value="04">4</option>

                                            <!--   -->

                                            <option value="05">5</option>

                                            <!--   -->

                                            <option value="06">6</option>

                                            <!--   -->

                                            <option value="07">7</option>

                                            <!--   -->

                                            <option value="08">8</option>

                                            <!--   -->

                                            <option value="09">9</option>

                                            <!--   -->

                                            <option value="10">10</option>

                                            <!--   -->

                                            <option value="11">11</option>

                                            <!--   -->

                                            <option value="12">12</option>

                                            <!--   -->

                                            <option value="13">13</option>

                                            <!--   -->

                                            <option value="14">14</option>

                                            <!--   -->

                                            <option value="15">15</option>

                                            <!--   -->

                                            <option value="16">16</option>

                                            <!--   -->

                                            <option value="17">17</option>

                                            <!--   -->

                                            <option value="18">18</option>

                                            <!--   -->

                                            <option value="19">19</option>

                                            <!--   -->

                                            <option value="20">20</option>

                                            <!--   -->

                                            <option value="21">21</option>

                                            <!--   -->

                                            <option value="22">22</option>

                                            <!--   -->

                                            <option value="23">23</option>

                                            <!--   -->

                                            <option value="24">24</option>

                                            <!--   -->

                                            <option value="25">25</option>

                                            <!--   -->

                                            <option value="26">26</option>

                                            <!--   -->

                                            <option value="27">27</option>

                                            <!--   -->

                                            <option value="28">28</option>

                                            <!--   -->

                                            <option value="29">29</option>

                                            <!--   -->

                                            <option value="30">30</option>


                                        </select>
                                        日
                                        <span class="time-select m-l-10 m-r-10">
										<select name="month_hour[begin_hour][]" class="select form-control form-control-sm m-r-5">
											<!--   -->
											<option value="00">00</option>
                                            <!--   -->
											<option value="01">01</option>
                                            <!--   -->
											<option value="02">02</option>
                                            <!--   -->
											<option value="03">03</option>
                                            <!--   -->
											<option value="04">04</option>
                                            <!--   -->
											<option value="05">05</option>
                                            <!--   -->
											<option value="06">06</option>
                                            <!--   -->
											<option value="07">07</option>
                                            <!--   -->
											<option value="08">08</option>
                                            <!--   -->
											<option value="09">09</option>
                                            <!--   -->
											<option value="10">10</option>
                                            <!--   -->
											<option value="11">11</option>
                                            <!--   -->
											<option value="12">12</option>
                                            <!--   -->
											<option value="13">13</option>
                                            <!--   -->
											<option value="14">14</option>
                                            <!--   -->
											<option value="15">15</option>
                                            <!--   -->
											<option value="16">16</option>
                                            <!--   -->
											<option value="17">17</option>
                                            <!--   -->
											<option value="18">18</option>
                                            <!--   -->
											<option value="19">19</option>
                                            <!--   -->
											<option value="20">20</option>
                                            <!--   -->
											<option value="21">21</option>
                                            <!--   -->
											<option value="22">22</option>
                                            <!--   -->
											<option value="23">23</option>

										</select>
										:
										<select name="month_hour[begin_minute][]" class="select form-control form-control-sm m-l-5">
											<!--   -->

											<option value="00">00</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="05">05</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="10">10</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="15">15</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="20">20</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="25">25</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="30">30</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="35">35</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="40">40</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="45">45</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="50">50</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="55">55</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="59">59</option>


										</select>
									</span>
                                        至
                                        <span class="time-select m-l-10 m-r-10">
										<select name="month_hour[end_hour][]" class="select form-control form-control-sm m-r-5">
											<!--   -->
											<option value="00">00</option>
                                            <!--   -->
											<option value="01">01</option>
                                            <!--   -->
											<option value="02">02</option>
                                            <!--   -->
											<option value="03">03</option>
                                            <!--   -->
											<option value="04">04</option>
                                            <!--   -->
											<option value="05">05</option>
                                            <!--   -->
											<option value="06">06</option>
                                            <!--   -->
											<option value="07">07</option>
                                            <!--   -->
											<option value="08">08</option>
                                            <!--   -->
											<option value="09">09</option>
                                            <!--   -->
											<option value="10">10</option>
                                            <!--   -->
											<option value="11">11</option>
                                            <!--   -->
											<option value="12">12</option>
                                            <!--   -->
											<option value="13">13</option>
                                            <!--   -->
											<option value="14">14</option>
                                            <!--   -->
											<option value="15">15</option>
                                            <!--   -->
											<option value="16">16</option>
                                            <!--   -->
											<option value="17">17</option>
                                            <!--   -->
											<option value="18">18</option>
                                            <!--   -->
											<option value="19">19</option>
                                            <!--   -->
											<option value="20">20</option>
                                            <!--   -->
											<option value="21">21</option>
                                            <!--   -->
											<option value="22">22</option>
                                            <!--   -->
											<option value="23">23</option>

										</select>
										:
										<select name="month_hour[end_minute][]" class="select form-control form-control-sm m-l-5">
											<!--   -->

											<option value="00">00</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="05">05</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="10">10</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="15">15</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="20">20</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="25">25</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="30">30</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="35">35</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="40">40</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="45">45</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="50">50</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="55">55</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="59">59</option>


										</select>
									</span>
                                    </div>
                                    <!---->
                                    <div class="m-b-5 month_day">
                                        <select name="month_day[]" class="form-control form-control-sm w100 m-r-10">
                                            <!--   -->

                                            <!--   -->

                                            <option value="01">1</option>

                                            <!--   -->

                                            <option value="02">2</option>

                                            <!--   -->

                                            <option value="03">3</option>

                                            <!--   -->

                                            <option value="04">4</option>

                                            <!--   -->

                                            <option value="05">5</option>

                                            <!--   -->

                                            <option value="06">6</option>

                                            <!--   -->

                                            <option value="07">7</option>

                                            <!--   -->

                                            <option value="08">8</option>

                                            <!--   -->

                                            <option value="09">9</option>

                                            <!--   -->

                                            <option value="10">10</option>

                                            <!--   -->

                                            <option value="11">11</option>

                                            <!--   -->

                                            <option value="12">12</option>

                                            <!--   -->

                                            <option value="13">13</option>

                                            <!--   -->

                                            <option value="14">14</option>

                                            <!--   -->

                                            <option value="15">15</option>

                                            <!--   -->

                                            <option value="16">16</option>

                                            <!--   -->

                                            <option value="17">17</option>

                                            <!--   -->

                                            <option value="18">18</option>

                                            <!--   -->

                                            <option value="19">19</option>

                                            <!--   -->

                                            <option value="20">20</option>

                                            <!--   -->

                                            <option value="21">21</option>

                                            <!--   -->

                                            <option value="22">22</option>

                                            <!--   -->

                                            <option value="23">23</option>

                                            <!--   -->

                                            <option value="24">24</option>

                                            <!--   -->

                                            <option value="25">25</option>

                                            <!--   -->

                                            <option value="26">26</option>

                                            <!--   -->

                                            <option value="27">27</option>

                                            <!--   -->

                                            <option value="28">28</option>

                                            <!--   -->

                                            <option value="29">29</option>

                                            <!--   -->

                                            <option value="30">30</option>


                                        </select>
                                        日
                                        <span class="time-select m-l-10 m-r-10">
										<select name="month_hour[begin_hour][]" class="select form-control form-control-sm m-r-5">
											<!--   -->
											<option value="00">00</option>
                                            <!--   -->
											<option value="01">01</option>
                                            <!--   -->
											<option value="02">02</option>
                                            <!--   -->
											<option value="03">03</option>
                                            <!--   -->
											<option value="04">04</option>
                                            <!--   -->
											<option value="05">05</option>
                                            <!--   -->
											<option value="06">06</option>
                                            <!--   -->
											<option value="07">07</option>
                                            <!--   -->
											<option value="08">08</option>
                                            <!--   -->
											<option value="09">09</option>
                                            <!--   -->
											<option value="10">10</option>
                                            <!--   -->
											<option value="11">11</option>
                                            <!--   -->
											<option value="12">12</option>
                                            <!--   -->
											<option value="13">13</option>
                                            <!--   -->
											<option value="14">14</option>
                                            <!--   -->
											<option value="15">15</option>
                                            <!--   -->
											<option value="16">16</option>
                                            <!--   -->
											<option value="17">17</option>
                                            <!--   -->
											<option value="18">18</option>
                                            <!--   -->
											<option value="19">19</option>
                                            <!--   -->
											<option value="20">20</option>
                                            <!--   -->
											<option value="21">21</option>
                                            <!--   -->
											<option value="22">22</option>
                                            <!--   -->
											<option value="23">23</option>

										</select>
										:
										<select name="month_hour[begin_minute][]" class="select form-control form-control-sm m-l-5">
											<!--   -->

											<option value="00">00</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="05">05</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="10">10</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="15">15</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="20">20</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="25">25</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="30">30</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="35">35</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="40">40</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="45">45</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="50">50</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="55">55</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="59">59</option>


										</select>
									</span>
                                        至
                                        <span class="time-select m-l-10 m-r-10">
										<select name="month_hour[end_hour][]" class="select form-control form-control-sm m-r-5">
											<!--   -->
											<option value="00">00</option>
                                            <!--   -->
											<option value="01">01</option>
                                            <!--   -->
											<option value="02">02</option>
                                            <!--   -->
											<option value="03">03</option>
                                            <!--   -->
											<option value="04">04</option>
                                            <!--   -->
											<option value="05">05</option>
                                            <!--   -->
											<option value="06">06</option>
                                            <!--   -->
											<option value="07">07</option>
                                            <!--   -->
											<option value="08">08</option>
                                            <!--   -->
											<option value="09">09</option>
                                            <!--   -->
											<option value="10">10</option>
                                            <!--   -->
											<option value="11">11</option>
                                            <!--   -->
											<option value="12">12</option>
                                            <!--   -->
											<option value="13">13</option>
                                            <!--   -->
											<option value="14">14</option>
                                            <!--   -->
											<option value="15">15</option>
                                            <!--   -->
											<option value="16">16</option>
                                            <!--   -->
											<option value="17">17</option>
                                            <!--   -->
											<option value="18">18</option>
                                            <!--   -->
											<option value="19">19</option>
                                            <!--   -->
											<option value="20">20</option>
                                            <!--   -->
											<option value="21">21</option>
                                            <!--   -->
											<option value="22">22</option>
                                            <!--   -->
											<option value="23">23</option>

										</select>
										:
										<select name="month_hour[end_minute][]" class="select form-control form-control-sm m-l-5">
											<!--   -->

											<option value="00">00</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="05">05</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="10">10</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="15">15</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="20">20</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="25">25</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="30">30</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="35">35</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="40">40</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="45">45</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="50">50</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="55">55</option>

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

                                            <!--   -->

											<option value="59">59</option>


										</select>
									</span>
                                    </div>

                                    <!---->
                                    <p>
                                        <a class="btn btn-warning btn-sm" id='add_month'>添加按月条件</a>
                                        <span class="c-999 m-l-20">最多可增加5个条件</span>
                                    </p>
                                </div>
                                <div class="clear"></div>
                                <!---->
                            </div>
                        </div>
                        <div class="help-block help-block-t">
                            活动开始前，商品详情页商品名称下方将会预告活动开始时间和折扣
                            </br>
                            按周期重复是在有效期范围内循环
                        </div>
                    </div>
                </div>
            </div>

            <!-- 活动标签 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="limitdiscountmodel-act_label" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">活动标签：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="limitdiscountmodel-act_label" class="form-control" name="LimitDiscountModel[act_label]" value="{{ $model['ext_info']['act_label'] ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">活动期间展示于商品详情的活动标记处，建议最多8个字</div></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        <span class="ng-binding">限购设置：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <label class="control-label cur-p m-r-30">
                                <input type="radio" class="icheck"
                                       name="limit_type" @if(isset($model['ext_info']['limit_type']) && $model['ext_info']['limit_type'] == 0)checked="checked"@endif value='0'> 不限购
                            </label>
                            <label class="control-label cur-p">
                                <input type="radio" class="icheck"
                                       name="limit_type" @if(isset($model['ext_info']['limit_type']) && $model['ext_info']['limit_type'] == 1)checked="checked"@endif value='1'> 每人每种商品限购
                                <input class="form-control ipt m-l-10 m-r-10" type="text" name='limit_num_1' data-rule-min="1" data-rule-digits="true" value="{{ $model['ext_info']['limit_num_1'] ?? '' }}">
                                件
                            </label>
                            <!-- </br>
                            <label class="control-label cur-p">
                                <input type="radio" class="icheck" name="limit_type"  value='2'>
                                每人前
                                <input class="form-control ipt m-l-10 m-r-10" type="text" name='limit_num_2' data-rule-min="1" data-rule-digits="true" >
                                件享受折扣
                            </label> -->
                        </div>
                        <div class="help-block help-block-t">每人限购N件，超过后不可再下单购买</div>
                    </div>
                </div>
            </div>
            <!-- 活动图片 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="limitdiscountmodel-act_img" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">活动推广图：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <div id="act_img_container"></div>
                            <input type="hidden" id="limitdiscountmodel-act_img" class="form-control" name="LimitDiscountModel[act_img]" value="{{ $model['act_img'] ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">限时折扣活动页面的图片，请使用585*390像素，上传活动推广图，此活动才可在前台限时折扣活动页面展示，大小1M内的图片，支持jpg、jpeg、gif、png格式上传 </div></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">选择商品：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box m-r-10">
                            <!--请在这里调取选择商品选择器插件-->
                            <div id="widget_goods" class="p-l-15 p-r-15"></div>
                            <!---->
                            <div id="goods_list">
                                @if(!empty($goods_list))
                                    <div class="table-responsive m-t-10" style="max-height: 300px; overflow-y: auto;">
                                        <table id="table_list" class="table table-hover m-b-0 w800 limit-discount-list">
                                            <thead>
                                            <tr>
                                                <th class="w200">商品名称</th>
                                                <th class="w100 text-c">价格</th>
                                                <th class="w80 text-c">库存</th>
                                                <th class="w100 text-c">
                                                    折扣（折）
                                                    <div class="batch">
                                                        <a class="batch-edit" title="批量设置">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <div class="batch-input" style="display: none">
                                                            <h6>批量设置折扣：</h6>
                                                            <a class="batch-close">X</a>
                                                            <input class="form-control text small batch_set_discount" type="text">
                                                            <a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type=0>设置</a>
                                                            <span class="arrow"></span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="w100 text-c">
                                                    减价（元）
                                                    <div class="batch">
                                                        <a class="batch-edit" title="批量设置">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <div class="batch-input" style="display: none">
                                                            <h6>批量设置减价：</h6>
                                                            <a class="batch-close">X</a>
                                                            <input class="form-control text small batch_set_mark_down" type="text">
                                                            <a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type=1>设置</a>
                                                            <span class="arrow"></span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="w150">折扣/减价后价格（元）</th>
                                                <th class="handle w80">操作</th>
                                            </tr>
                                            </thead>
                                            <tbody id="goods_info">


                                            @foreach($goods_list as $goods_id=>$v)
                                            <tr data-limit-discount-sku-id="{{ $v['sku_id'] }}" data-limit-discount-goods-id="{{ $goods_id }}">
                                                <td>
                                                    {{ $v['goods_name'] }}
                                                    <input type="hidden" name="goods_spu[]" value="{{ $goods_id }}">
                                                    <input type="hidden" name="goods_spu_discount[]" value="" class="{{ $goods_id }}-discount calculation_price">
                                                    <input type="hidden" name="goods_spu_reduce[]" value="{{ $goods_id }}-{{ $v['discount_num'] }}" class="{{ $goods_id }}-reduce calculation_price">
                                                </td>
                                                <td class="text-c">￥{{ $v['goods_price'] }}</td>
                                                <td class="text-c">{{ $v['goods_number'] }}</td>
                                                <td class="limit-discount">
                                                    <input class="form-control form-control-sm w60 discount discount-{{ $goods_id }}" type="text" data-goods-id="{{ $goods_id }}" data-min_price="{{ $v['min_goods_price'] }}" data-max_price="{{ $v['max_goods_price'] }}" data-rule-callback='act_price_callback' >
                                                </td>
                                                <td class="limit-discount">
                                                    <input class="form-control form-control-sm w60 mark_down mark_down-{{ $goods_id }}" type="text" data-goods-id="{{ $goods_id }}" data-min_price="{{ $v['min_goods_price'] }}" data-max_price="{{ $v['max_goods_price'] }}" data-rule-callback='act_mark_down_callback' value='{{ $v['discount_num'] }}'>
                                                </td>
                                                <td class="after-price after-price-{{ $goods_id }}" data-goods-id="{{ $goods_id }}">{{ $v['format_goods_price'] }}</td>
                                                <td class="handle">
                                                    <a href="javascript:void(0);" data-sku-id="{{ $v['sku_id'] }}" data-goods-id="{{ $goods_id }}" data-goods-price="{{ $v['goods_price'] }}" class="del border-none">删除</a>
                                                </td>
                                            </tr>
                                            @endforeach

                                            {{--<tr data-limit-discount-sku-id="871" data-limit-discount-goods-id="178">
                                                <td>
                                                    古古怪怪
                                                    <input type="hidden" name="goods_spu[]" value="178">
                                                    <input type="hidden" name="goods_spu_discount[]" value="178-9" class="178-discount calculation_price">
                                                    <input type="hidden" name="goods_spu_reduce[]" value="" class="178-reduce calculation_price">
                                                </td>
                                                <td class="text-c">￥1.00-￥2.00</td>
                                                <td class="text-c">69</td>
                                                <td class="limit-discount">
                                                    <input class="form-control form-control-sm w60 discount discount-178" type="text" data-goods-id="178" data-min_price="1.00" data-max_price="2.00" data-rule-callback='act_price_callback' value='9'>
                                                </td>
                                                <td class="limit-discount">
                                                    <input class="form-control form-control-sm w60 mark_down mark_down-178" type="text" data-goods-id="178" data-min_price="1.00" data-max_price="2.00" data-rule-callback='act_mark_down_callback' >
                                                </td>
                                                <td class="after-price after-price-178" data-goods-id="178">￥0.9-￥1.8</td>
                                                <td class="handle">
                                                    <a href="javascript:void(0);" data-sku-id="871" data-goods-id="178" data-goods-price="￥1.00-￥2.00" class="del border-none">删除</a>
                                                </td>
                                            </tr>--}}


                                            </tbody>
                                        </table>
                                    </div>
                                    <!--错误提示模块 star-->
                                    <div class="member-handle-error"></div>
                                    <!--错误提示模块 end-->
                                    <script type="text/javascript">
                                        $().ready(function() {
                                            //删除商品
                                            $("body").on("click", ".del", function() {
                                                var target = $(this).parents("tr");
                                                var goods_id = $(this).data("goods-id");
                                                var sku_id = $(this).data("sku-id");
                                                var goods_price = $(this).data("goods-price");
                                                var container = $(this).parents(".limit-discount-goods").find("#widget_goods");
                                                var goodspicker = $.goodspicker(container);

                                                if (goodspicker) {
                                                    // 获取控件
                                                    goodspicker.remove(goods_id, sku_id);
                                                    var selected_number = goodspicker.goods_ids.length;
                                                    if (selected_number == 0) {
                                                        $(this).parents("table").remove();
                                                    }
                                                }
                                                $(target).remove();
                                            });

                                            $("body").on("click", ".after-price", function() {
                                                var goods_id = $(this).data("goods-id");
                                                var discount = $(".discount-" + goods_id).val();
                                                var mark_down = $(".mark_down-" + goods_id).val();
                                                $.loading.start();
                                                $.open({
                                                    title: '',
                                                    width: '650px',
                                                    ajax: {
                                                        url: '/dashboard/limit-discount/sku-info',
                                                        data: {
                                                            goods_id: goods_id,
                                                            discount: discount,
                                                            mark_down: mark_down
                                                        },
                                                        success: function(result) {
                                                            $.loading.stop();
                                                        },
                                                    }
                                                });

                                            });

                                        });
                                    </script>

                                    <script type="text/javascript">
                                        //自定义验证规则
                                        function act_price_callback(element, value) {

                                            var goods_id = $(element).data('goods-id');
                                            var min_price = $(element).data('min_price');
                                            var max_price = $(element).data('max_price');
                                            var regu = /^[0-9]+\.?[0-9]*$/;

                                            if (isNaN($(element).val())) {
                                                $(element).data("msg", "折扣必须是数字。");
                                                return false;
                                            }
                                            if ($(element).val() < 0) {
                                                $(element).data("msg", "折扣必须大于0。");
                                                return false;
                                            }
                                            if ($(element).val() > 10) {
                                                $(element).data("msg", "折扣必须小于10。");
                                                return false;
                                            }
                                            if ($(element).val().indexOf('.') > -1) {
                                                if ($(element).val().split('.')[1].length > 2) {
                                                    $(element).data("msg", "折扣只能保留2位小数。");
                                                    return false;
                                                }
                                            }
                                            if ($(element).val() * min_price * 100 < 1 && $(element).val() != '') {
                                                $(element).data("msg", "折后金额不能小于0.01。");
                                                return false;
                                            }
                                            if ($(element).val() * 100 <= 1 && $(element).val() != '') {
                                                $(element).data("msg", "折后金额不能小于0.01。");
                                                return false;
                                            }

                                            //设置折扣金额
                                            if ($(element).val() != '') {

                                                $("." + goods_id + "-reduce").val('');
                                                $("." + goods_id + "-discount").val(goods_id + '-' + $(element).val());

                                                $(".mark_down-" + goods_id).val('');
                                                if (min_price == max_price) {
                                                    min_price = min_price * $(element).val() * 100 / 1000;
                                                    $(".after-price-" + goods_id).html("￥" + min_price.toFixed(2));
                                                } else {
                                                    min_price = min_price * $(element).val() * 100 / 1000;
                                                    max_price = max_price * $(element).val() * 100 / 1000;
                                                    $(".after-price-" + goods_id).html("￥" + min_price.toFixed(2) + "-￥" + max_price.toFixed(2));
                                                }
                                            }

                                            return true;
                                        }
                                        function act_mark_down_callback(element, value) {

                                            var goods_id = $(element).data('goods-id');
                                            var min_price = $(element).data('min_price');
                                            var max_price = $(element).data('max_price');
                                            var regu = /^[0-9]+\.?[0-9]*$/;

                                            if (isNaN($(element).val())) {
                                                $(element).data("msg", "减价金额必须是数字。");
                                                return false;
                                            }
                                            if ($(element).val() < 0) {
                                                $(element).data("msg", "减价金额必须大于0。");
                                                return false;
                                            }
                                            if ($(element).val() * 100 > min_price * 100) {
                                                $(element).data("msg", "减价金额必须小于商品最低金额。");
                                                return false;
                                            }
                                            if ($(element).val().indexOf('.') > -1) {
                                                if ($(element).val().split('.')[1].length > 2) {
                                                    $(element).data("msg", "折扣只能保留2位小数。");
                                                    return false;
                                                }
                                            }
                                            if ($(element).val() != '') {
                                                $("." + goods_id + "-discount").val('');
                                                $("." + goods_id + "-reduce").val(goods_id + '-' + $(element).val());
                                                $(".discount-" + goods_id).val('');
                                                if (min_price == max_price) {
                                                    min_price = min_price - $(element).val();
                                                    $(".after-price-" + goods_id).html("￥" + min_price.toFixed(2));
                                                } else {
                                                    min_price = min_price - $(element).val();
                                                    max_price = max_price - $(element).val();
                                                    $(".after-price-" + goods_id).html("￥" + min_price.toFixed(2) + "-￥" + max_price.toFixed(2));
                                                }
                                            }

                                            return true;
                                        }

                                        $().ready(function() {
                                            /**
                                             * 初始化validator默认值自定义错误提示位置
                                             */
                                            var _errorPlacement = $.validator.defaults.errorPlacement;
                                            var _success = $.validator.defaults.success;

                                            /* $.validator.setDefaults({
                                                errorPlacement: function(error, element) {
                                                    var error_id = $(error).attr("id");
                                                    var error_msg = $(error).text();
                                                    var element_id = $(error).attr("for");
                                                    if (!error_msg && error_msg == "") {
                                                        return;
                                                    }

                                                // 	if (element.parents(".limit-discount-list").size() ==0) {
                                                //		return;
                                                //	}

                                                    if ($(element).parents(".member-container").find(".member-handle-error").find("div").size() == 0) {
                                                        $(".member-handle-error").html("<div class='form-control-warning error m-t-10'></div>");
                                                    }
                                                    var error_dom = $("<p id='"+error_id+"'><i class='fa fa-times-circle'></i><span class='error-msg'>" + error_msg + "</span></p>");
                                                    $(".member-handle-error").find("div").append(error_dom);
                                                },
                                                // 失去焦点验证
                                                onfocusout: function(element) {
                                                    $(element).valid();
                                                },
                                                // 成功后移除错误提示
                                                success: function(error, element) {
                                                    var error_id = $(error).attr("id");
                                                    var error_msg = $(error).text();
                                                    var element_id = $(error).attr("for");
                                                    var sku = $(this).data('sku_id');
                                                    var rank = $(this).data('rank_id');
                                                    if ($(element).parents(".member-container").size() > 0) {
                                                        $("[id='" + error_id + "']").remove();
                                                    }

                                                    if ($(element).find(".member-handle-error").find("p").size() == 0) {
                                                        $('.form-control-warning').remove();
                                                        //$(element).parents(".member-container").find(".member-handle-error").find("div").remove();
                                                    }
                                                    _success.call(this, error, element);
                                                }
                                            }); */
                                        })
                                    </script>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 排序 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="limitdiscountmodel-sort" class="col-sm-3 control-label">

                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="limitdiscountmodel-sort" class="form-control small" name="LimitDiscountModel[sort]" value="{{ $model['sort'] ?? 255 }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <div class="bottom-btn p-b-30">
                <a class="btn btn-primary btn-lg" id='btn_submit'>确认提交</a>
            </div>

        </form>
    </div>


@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <!--点击按钮为表格增加行-->
    <script id="opentime_template" type="text">
<div class="m-b-5 month_day">
<select name="month_day[]" class="form-control form-control-sm w100 m-r-10">
<!--   -->
<!--   -->
<option value="01">1</option>
<!--   -->
<option value="02">2</option>
<!--   -->
<option value="03">3</option>
<!--   -->
<option value="04">4</option>
<!--   -->
<option value="05">5</option>
<!--   -->
<option value="06">6</option>
<!--   -->
<option value="07">7</option>
<!--   -->
<option value="08">8</option>
<!--   -->
<option value="09">9</option>
<!--   -->
<option value="10">10</option>
<!--   -->
<option value="11">11</option>
<!--   -->
<option value="12">12</option>
<!--   -->
<option value="13">13</option>
<!--   -->
<option value="14">14</option>
<!--   -->
<option value="15">15</option>
<!--   -->
<option value="16">16</option>
<!--   -->
<option value="17">17</option>
<!--   -->
<option value="18">18</option>
<!--   -->
<option value="19">19</option>
<!--   -->
<option value="20">20</option>
<!--   -->
<option value="21">21</option>
<!--   -->
<option value="22">22</option>
<!--   -->
<option value="23">23</option>
<!--   -->
<option value="24">24</option>
<!--   -->
<option value="25">25</option>
<!--   -->
<option value="26">26</option>
<!--   -->
<option value="27">27</option>
<!--   -->
<option value="28">28</option>
<!--   -->
<option value="29">29</option>
<!--   -->
<option value="30">30</option>
</select>
日
<span class="time-select m-l-10 m-r-10">
<select name="month_hour[begin_hour][]" class="select form-control form-control-sm m-r-5">
<!--   -->
<option value="00">00</option>
<!--   -->
<option value="01">01</option>
<!--   -->
<option value="02">02</option>
<!--   -->
<option value="03">03</option>
<!--   -->
<option value="04">04</option>
<!--   -->
<option value="05">05</option>
<!--   -->
<option value="06">06</option>
<!--   -->
<option value="07">07</option>
<!--   -->
<option value="08">08</option>
<!--   -->
<option value="09">09</option>
<!--   -->
<option value="10">10</option>
<!--   -->
<option value="11">11</option>
<!--   -->
<option value="12">12</option>
<!--   -->
<option value="13">13</option>
<!--   -->
<option value="14">14</option>
<!--   -->
<option value="15">15</option>
<!--   -->
<option value="16">16</option>
<!--   -->
<option value="17">17</option>
<!--   -->
<option value="18">18</option>
<!--   -->
<option value="19">19</option>
<!--   -->
<option value="20">20</option>
<!--   -->
<option value="21">21</option>
<!--   -->
<option value="22">22</option>
<!--   -->
<option value="23">23</option>
</select>
:
<select name="month_hour[begin_minute][]" class="select form-control form-control-sm m-l-5">
<!--   -->
<option value="00">00</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="05">05</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="10">10</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="15">15</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="20">20</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="25">25</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="30">30</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="35">35</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="40">40</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="45">45</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="50">50</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="55">55</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="59">59</option>
</select>
</span>
至
<span class="time-select m-l-10 m-r-10">
<select name="month_hour[end_hour][]" class="select form-control form-control-sm m-r-5">
<!--   -->
<option value="00">00</option>
<!--   -->
<option value="01">01</option>
<!--   -->
<option value="02">02</option>
<!--   -->
<option value="03">03</option>
<!--   -->
<option value="04">04</option>
<!--   -->
<option value="05">05</option>
<!--   -->
<option value="06">06</option>
<!--   -->
<option value="07">07</option>
<!--   -->
<option value="08">08</option>
<!--   -->
<option value="09">09</option>
<!--   -->
<option value="10">10</option>
<!--   -->
<option value="11">11</option>
<!--   -->
<option value="12">12</option>
<!--   -->
<option value="13">13</option>
<!--   -->
<option value="14">14</option>
<!--   -->
<option value="15">15</option>
<!--   -->
<option value="16">16</option>
<!--   -->
<option value="17">17</option>
<!--   -->
<option value="18">18</option>
<!--   -->
<option value="19">19</option>
<!--   -->
<option value="20">20</option>
<!--   -->
<option value="21">21</option>
<!--   -->
<option value="22">22</option>
<!--   -->
<option value="23">23</option>
</select>
:
<select name="month_hour[end_minute][]" class="select form-control form-control-sm m-l-5">
<!--   -->
<option value="00">00</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="05">05</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="10">10</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="15">15</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="20">20</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="25">25</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="30">30</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="35">35</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="40">40</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="45">45</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="50">50</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="55">55</option>
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<option value="59">59</option>
</select>
</span>
<a class="c-blue va-middle remove_month">删除</a>
</div>
</script>
    <script id="goods" type="text">
<div class="table-responsive m-t-10" style="max-height: 300px; overflow-y: auto;">
	<table id="table_list" class="table table-hover m-b-0 w800 limit-discount-list">
		<thead>
			<tr>
				<th class="w200">商品名称</th>
				<th class="w100 text-c">价格</th>
				<th class="w80 text-c">库存</th>
				<th class="w100 text-c">
					折扣（折）
					<div class="batch">
						<a class="batch-edit" title="批量设置">
							<i class="fa fa-edit"></i>
						</a>
						<div class="batch-input" style="display: none">
							<h6>批量设置折扣：</h6>
							<a class="batch-close">X</a>
							<input class="form-control text small batch_set_discount" type="text">
							<a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type=0>设置</a>
							<span class="arrow"></span>
						</div>
					</div>
				</th>
				<th class="w100 text-c">
					减价（元）
					<div class="batch">
						<a class="batch-edit" title="批量设置">
							<i class="fa fa-edit"></i>
						</a>
						<div class="batch-input" style="display: none">
							<h6>批量设置减价：</h6>
							<a class="batch-close">X</a>
							<input class="form-control text small batch_set_mark_down" type="text">
							<a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type=1>设置</a>
							<span class="arrow"></span>
						</div>
					</div>
				</th>
				<th class="w150">折扣/减价后价格（元）</th>
				<th class="handle w80">操作</th>
			</tr>
		</thead>
		<tbody id="goods_info">

		</tbody>
	</table>
</div>
<!--错误提示模块 star-->
<div class="member-handle-error"></div>
<!--错误提示模块 end-->
<script type="text/javascript">
	$().ready(function() {
		//删除商品
		$("body").on("click", ".del", function() {
			var target = $(this).parents("tr");
			var goods_id = $(this).data("goods-id");
			var sku_id = $(this).data("sku-id");
			var goods_price = $(this).data("goods-price");
			var container = $(this).parents(".limit-discount-goods").find("#widget_goods");
			var goodspicker = $.goodspicker(container);

			if (goodspicker) {
				// 获取控件
				goodspicker.remove(goods_id, sku_id);
				var selected_number = goodspicker.goods_ids.length;
				if (selected_number == 0) {
					$(this).parents("table").remove();
				}
			}
			$(target).remove();
		});

		$("body").on("click", ".after-price", function() {
			var goods_id = $(this).data("goods-id");
			var discount = $(".discount-" + goods_id).val();
			var mark_down = $(".mark_down-" + goods_id).val();
			$.loading.start();
			$.open({
				title: '',
				width: '650px',
				ajax: {
					url: '/dashboard/limit-discount/sku-info',
					data: {
						goods_id: goods_id,
						discount: discount,
						mark_down: mark_down
					},
					success: function(result) {
						$.loading.stop();
					},
				}
			});

		});

	});
</script>

    <script type="text/javascript">
        //自定义验证规则
        function act_price_callback(element, value) {

            var goods_id = $(element).data('goods-id');
            var min_price = $(element).data('min_price');
            var max_price = $(element).data('max_price');
            var regu = /^[0-9]+\.?[0-9]*$/;

            if (isNaN($(element).val())) {
                $(element).data("msg", "折扣必须是数字。");
                return false;
            }
            if ($(element).val() < 0) {
                $(element).data("msg", "折扣必须大于0。");
                return false;
            }
            if ($(element).val() > 10) {
                $(element).data("msg", "折扣必须小于10。");
                return false;
            }
            if ($(element).val().indexOf('.') > -1) {
                if ($(element).val().split('.')[1].length > 2) {
                    $(element).data("msg", "折扣只能保留2位小数。");
                    return false;
                }
            }
            if ($(element).val() * min_price * 100 < 1 && $(element).val() != '') {
                $(element).data("msg", "折后金额不能小于0.01。");
                return false;
            }
            if ($(element).val() * 100 <= 1 && $(element).val() != '') {
                $(element).data("msg", "折后金额不能小于0.01。");
                return false;
            }

            //设置折扣金额
            if ($(element).val() != '') {

                $("." + goods_id + "-reduce").val('');
                $("." + goods_id + "-discount").val(goods_id + '-' + $(element).val());

                $(".mark_down-" + goods_id).val('');
                if (min_price == max_price) {
                    min_price = min_price * $(element).val() * 100 / 1000;
                    $(".after-price-" + goods_id).html("￥" + min_price.toFixed(2));
                } else {
                    min_price = min_price * $(element).val() * 100 / 1000;
                    max_price = max_price * $(element).val() * 100 / 1000;
                    $(".after-price-" + goods_id).html("￥" + min_price.toFixed(2) + "-￥" + max_price.toFixed(2));
                }
            }

            return true;
        }
        function act_mark_down_callback(element, value) {

            var goods_id = $(element).data('goods-id');
            var min_price = $(element).data('min_price');
            var max_price = $(element).data('max_price');
            var regu = /^[0-9]+\.?[0-9]*$/;

            if (isNaN($(element).val())) {
                $(element).data("msg", "减价金额必须是数字。");
                return false;
            }
            if ($(element).val() < 0) {
                $(element).data("msg", "减价金额必须大于0。");
                return false;
            }
            if ($(element).val() * 100 > min_price * 100) {
                $(element).data("msg", "减价金额必须小于商品最低金额。");
                return false;
            }
            if ($(element).val().indexOf('.') > -1) {
                if ($(element).val().split('.')[1].length > 2) {
                    $(element).data("msg", "折扣只能保留2位小数。");
                    return false;
                }
            }
            if ($(element).val() != '') {
                $("." + goods_id + "-discount").val('');
                $("." + goods_id + "-reduce").val(goods_id + '-' + $(element).val());
                $(".discount-" + goods_id).val('');
                if (min_price == max_price) {
                    min_price = min_price - $(element).val();
                    $(".after-price-" + goods_id).html("￥" + min_price.toFixed(2));
                } else {
                    min_price = min_price - $(element).val();
                    max_price = max_price - $(element).val();
                    $(".after-price-" + goods_id).html("￥" + min_price.toFixed(2) + "-￥" + max_price.toFixed(2));
                }
            }

            return true;
        }

        $().ready(function() {
            /**
             * 初始化validator默认值自定义错误提示位置
             */
            var _errorPlacement = $.validator.defaults.errorPlacement;
            var _success = $.validator.defaults.success;

            /* $.validator.setDefaults({
                errorPlacement: function(error, element) {
                    var error_id = $(error).attr("id");
                    var error_msg = $(error).text();
                    var element_id = $(error).attr("for");
                    if (!error_msg && error_msg == "") {
                        return;
                    }

                // 	if (element.parents(".limit-discount-list").size() ==0) {
                //		return;
                //	}

                    if ($(element).parents(".member-container").find(".member-handle-error").find("div").size() == 0) {
                        $(".member-handle-error").html("<div class='form-control-warning error m-t-10'></div>");
                    }
                    var error_dom = $("<p id='"+error_id+"'><i class='fa fa-times-circle'></i><span class='error-msg'>" + error_msg + "</span></p>");
                    $(".member-handle-error").find("div").append(error_dom);
                },
                // 失去焦点验证
                onfocusout: function(element) {
                    $(element).valid();
                },
                // 成功后移除错误提示
                success: function(error, element) {
                    var error_id = $(error).attr("id");
                    var error_msg = $(error).text();
                    var element_id = $(error).attr("for");
                    var sku = $(this).data('sku_id');
                    var rank = $(this).data('rank_id');
                    if ($(element).parents(".member-container").size() > 0) {
                        $("[id='" + error_id + "']").remove();
                    }

                    if ($(element).find(".member-handle-error").find("p").size() == 0) {
                        $('.form-control-warning').remove();
                        //$(element).parents(".member-container").find(".member-handle-error").find("div").remove();
                    }
                    _success.call(this, error, element);
                }
            }); */
        })
    </script>
    <!-- 时间插件引入 start -->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=2.0"/> <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20180919"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20180919"></script>
    <!-- 时间插件引入 end -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180919"></script>
    <!-- 商品选择器 -->
    <!-- AJAX上传 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180919"></script> <script src="/assets/d2eace91/js/jquery.widget.js?v=20180919"></script>
    <script type="text/javascript">
        $(".day-checked-box li").click(function() {
            var arr = new Array();
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                $(this).addClass('selected');
            }
            $(".day-checked-box li").each(function() {
                if ($(this).hasClass('selected')) {
                    arr.push($(this).data('val'));
                }
            });
            $("#week").val(arr.join(','));
        });
        // 批量设置
        // 批量设置价格、库存、预警值
        $("body").on('click', ".batch > .batch-edit", function() {
            $('.batch > .batch-input').hide();
            $(this).next().show();
        });
        $("body").on('click', ".batch-input > .batch-close", function() {
            $(this).parent().hide();
        });
        // 批量设置获取焦点
        $("body").on("click", ".batch-edit", function() {
            $(this).parents(".batch").find(".batch-input").find(":text").focus();
        });

        // 批量设置获取焦点
        $("body").on("click", ".btn_batch_set", function() {
            $(this).parents(".batch").find(".batch-input").find(":text").focus();
            var type = $(this).data('type');
            if (type == 0) {
                var batch_type = '.discount';
                var val = $(".batch_set_discount").val();
            } else {
                var batch_type = '.mark_down';
                var val = $(".batch_set_mark_down").val();
            }
            $(batch_type).each(function() {
                $(batch_type).val(val);
                $(this).blur();
            });
            $(this).parent().hide();
        });

        //周期重复选择

        $(".switch-on-off").on('switchChange.bootstrapSwitch', function(e, state) {
            if (!state) {
                $('.act_repeat_item').addClass('hide')
            } else {
                $('.act_repeat_item').removeClass('hide');
            }
        });

        //添加日期
        $("#add_month").click(function() {
            if ($(".month_day").length < 5) {
                var html = $("#opentime_template").html();
                var element = $($.parseHTML(html));
                element.insertBefore($("#add_month"));
                checkLength();
            }
        });
        //移除月
        $("body").on("click", ".remove_month", function() {
            var target = this;
            $(target).parent().remove();
            checkLength();
        });
        // 每月按月添加不能超过5条
        function checkLength() {
            if ($(".month_day").length >= 5) {
                $("#add_month").addClass("disabled");
            } else {
                $("#add_month").removeClass("disabled");
            }
        }
        $("#act_img_container").imagegroup({
            host: '{{ get_oss_host() }}',
            size: 1,
            values: ['{{ $model['act_img'] ?? '' }}'],
            callback: function(data) {
                $("#limitdiscountmodel-act_img").val(data.path);
            },
            remove: function(value, values) {
                $("#limitdiscountmodel-act_img").val('');
            }
        });
    </script>
    <script id="client_rules" type="text">
    {{--添加、编辑验证规则一样--}}
[{"id": "limitdiscountmodel-act_name", "name": "LimitDiscountModel[act_name]", "attribute": "act_name", "rules": {"required":true,"messages":{"required":"活动名称不能为空。"}}},{"id": "limitdiscountmodel-start_time", "name": "LimitDiscountModel[start_time]", "attribute": "start_time", "rules": {"required":true,"messages":{"required":"活动有效期不能为空。"}}},{"id": "limitdiscountmodel-end_time", "name": "LimitDiscountModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"套餐结束时间不能为空。"}}},{"id": "limitdiscountmodel-act_label", "name": "LimitDiscountModel[act_label]", "attribute": "act_label", "rules": {"required":true,"messages":{"required":"活动标签不能为空。"}}},{"id": "limitdiscountmodel-act_img", "name": "LimitDiscountModel[act_img]", "attribute": "act_img", "rules": {"required":true,"messages":{"required":"活动推广图不能为空。"}}},{"id": "limitdiscountmodel-purchase_num", "name": "LimitDiscountModel[purchase_num]", "attribute": "purchase_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"限购数量必须是整数。"}}},{"id": "limitdiscountmodel-shop_id", "name": "LimitDiscountModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "limitdiscountmodel-ext_info", "name": "LimitDiscountModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"扩展字段必须是一条字符串。"}}},{"id": "limitdiscountmodel-act_name", "name": "LimitDiscountModel[act_name]", "attribute": "act_name", "rules": {"string":true,"messages":{"string":"活动名称必须是一条字符串。","maxlength":"活动名称只能包含至多20个字符。"},"maxlength":20}},{"id": "limitdiscountmodel-act_label", "name": "LimitDiscountModel[act_label]", "attribute": "act_label", "rules": {"string":true,"messages":{"string":"活动标签必须是一条字符串。","minlength":"活动标签应该包含至少2个字符。","maxlength":"活动标签只能包含至多8个字符。"},"minlength":2,"maxlength":8}},{"id": "limitdiscountmodel-sort", "name": "LimitDiscountModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于1。","max":"排序必须不大于255。"},"min":1,"max":255}},{"id": "limitdiscountmodel-start_time", "name": "LimitDiscountModel[start_time]", "attribute": "start_time", "rules": {"compare":{"operator":"<","type":"date","compareAttribute":"limitdiscountmodel-end_time","skipOnEmpty":1},"messages":{"compare":"开始时间不能大于结束时间"}}},{"id": "limitdiscountmodel-end_time", "name": "LimitDiscountModel[end_time]", "attribute": "end_time", "rules": {"compare":{"operator":">=","type":"date","compareAttribute":"limitdiscountmodel-start_time","skipOnEmpty":1},"messages":{"compare":"结束时间不能小于开始时间"}}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            //悬浮显示上下步骤按钮
            window.onscroll = function() {
                $(window).scroll(function() {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".page").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".bottom-btn").removeClass("bottom-btn-fixed");
                    } else {
                        $(".bottom-btn").addClass("bottom-btn-fixed");
                    }
                });

            };
            var values = [];
            //商品选择器加载以选择的商品数据
            $("body").find(".limit-discount-list").find("#goods_info").find("tr").each(function() {
                var goods_id = $(this).data("limit-discount-goods-id");
                var sku_id = 0;
                values[goods_id] = {
                    goods_id: goods_id,
                    sku_id: sku_id,
                };
            });
            // 初始化组件，为容器绑定组件
            var goodspicker = $("#widget_goods").goodspicker({
                url: '/dashboard/activity-goods/picker?act_id={{ $model['act_id'] ?? '' }}',
                // 组件ajax提交的数据，主要设置分页的相关设置
                data: {
                    page: {
                        // 分页唯一标识
                        // page_id: page_id
                    },
                    //act_id: $('#goodsmixmodel-act_id').val(),
                    is_sku: 0
                    // 不能将自己作为赠品
                    //except_sku_ids: sku_id
                },
                // 已加载的数据
                values: values,
                // 选择商品和未选择商品的按钮单击事件
                // @param selected 点击是否选中
                // @param sku 选中的SKU对象
                // @return 返回false代表
                click: function(selected, sku) {
                    var goods_count = this.goods_ids.length;
                    var html = $("#goods").html();
                    if (selected == true) {
                        $.loading.start();
                        $.ajax({
                            type: "POST",
                            url: "goods-info",
                            dataType: "json",
                            data: {
                                goods_id: sku.goods_id
                            },
                            success: function(result) {
                                if (goods_count == 1) {
                                    $("#goods_list").html(html);
                                    $('#goods_info').html('');
                                }
                                $('#goods_info').append(result.data);
                                $.loading.stop();
                            }
                        });
                    } else {

                        $("body").find("[data-limit-discount-goods-id='" + sku.goods_id + "']").remove();
                        if (goods_count == 0) {
                            $(".limit-discount-list").remove();
                        }
                    }
                },
            });

            var validator = $("#LimitDiscountModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());

            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                /* 	if (!validator.form()) {
                        var html = "";

                        error_list = validator.errorList;

                        for (var i = 0; i < validator.errorList.length; i++) {
                            var element = validator.errorList[i].element;
                            var message = validator.errorList[i].message;

                            var element = $(error_list[i].element);

                            $(element).focus();
                            $(window).scrollTop($(element).offset().top - $(window).height() + 120);

                        }

                        return false;
                    } */
                $.loading.start();
                if ("" == "") {
                    $.post('/dashboard/limit-discount/add', $("#LimitDiscountModel").serializeJson(), function(result) {
                        // 停止加载
                        $.loading.stop();
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            // 加载
                            $.loading.start();
                            $.go('/dashboard/limit-discount/list');
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json');
                } else {
                    $.post('/dashboard/limit-discount/edit?id={{ $model['act_id'] ?? '' }}', $("#LimitDiscountModel").serializeJson(), function(result) {
                        // 停止加载
                        $.loading.stop();
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            // 加载
                            $.loading.start();
                            $.go('/dashboard/limit-discount/list');
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json');
                }
            });

            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd hh:ii:ss',
            }).on('changeDate', function(ev) {
                $(this).trigger("blur");
            });
        })
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop