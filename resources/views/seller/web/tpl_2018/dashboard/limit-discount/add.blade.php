{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')

@stop

{{--header 内 css文件--}}
@section('header_css_2')

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix limit-discount-goods">
        <form id="LimitDiscountModel" class="form-horizontal" name="LimitDiscountModel"
              action="/dashboard/limit-discount/add" method="post" enctype="multipart/form-data">
        @csrf
        <!-- 隐藏域 -->
            <input type="hidden" id="limitdiscountmodel-act_id" class="form-control" name="LimitDiscountModel[act_id]"
                   value="{{ $model['act_id'] ?? '' }}">
            <!-- 套餐名称 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="limitdiscountmodel-act_name" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">活动名称：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <input type="text" id="limitdiscountmodel-act_name" class="form-control"
                                   name="LimitDiscountModel[act_name]" value="{{ $model['act_name'] ?? '' }}">
                        </div>
                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">活动名称必须在 1~20 个字内</div>
                        </div>
                    </div>
                </div>
            </div>
            <!--套餐有效期  -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="limitdiscountmodel-start_time" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">活动有效期：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <input type="text" id="limitdiscountmodel-start_time"
                                   class="form-control form_datetime large" name="LimitDiscountModel[start_time]"
                                   value="{{ $start_time }}">
                            <span class="ctime">至</span>
                            <input type="text" id="limitdiscountmodel-end_time" class="form-control form_datetime large"
                                   name="LimitDiscountModel[end_time]" value="{{ $end_time }}">
                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 按周期重复 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="limitdiscountmodel-act_repeat" class="col-sm-3 control-label">

                        <span class="ng-binding">周期重复：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="LimitDiscountModel[act_repeat]" value="0">
                                    <label><input type="checkbox" id="limitdiscountmodel-act_repeat"
                                                  class="switch-on-off"
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
            <div class="simple-form-field act_repeat_item @if(empty($model['ext_info']['act_repeat'])){{ 'hide' }}@endif"
                 style="margin-top: -10px">
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        <span class="ng-binding"></span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div class="model-box">
                                <label class="control-label pull-left cur-p">
                                    <input type="radio" class="icheck" name="timepicker"
                                           @if(isset($model['ext_info']['timepicker']) && $model['ext_info']['timepicker'] == 0)checked="checked"
                                           @endif  value='0'>
                                    每天
                                </label>
                                <div class="pull-left">
								<span class="time-select m-r-10">
									<select name="day_hour[begin_hour]"
                                            class="select form-control form-control-sm m-r-5">
										<!--   -->
										<option value="00" selected="selected">00</option>
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
									<select name="day_hour[begin_minute]"
                                            class="select form-control form-control-sm m-l-5">
										<!--   -->

										<option value="00" selected="selected">00</option>

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
									<select name="day_hour[end_hour]" class="select form-control form-control-sm m-r-5">
										<!--   -->
										<option value="00" selected="selected">00</option>
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
									<select name="day_hour[end_minute]"
                                            class="select form-control form-control-sm m-l-5">
										<!--   -->

										<option value="00" selected="selected">00</option>

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
                                <div class="clear m-b-5"></div>
                                <!---->
                                <label class="control-label pull-left cur-p">
                                    <input type="radio" class="icheck" name="timepicker"
                                           @if(isset($model['ext_info']['timepicker']) && $model['ext_info']['timepicker'] == 1)checked="checked"
                                           @endif value='1'>
                                    <input type="hidden" name="week" id="week" value=>
                                    每周
                                </label>
                                <div class="pull-left">
                                    <ul class="day-checked-box">
                                        <li data-val='1'>
                                            <a>周一</a>
                                            <i></i>
                                        </li>
                                        <li data-val='2'>
                                            <a>周二</a>
                                            <i></i>
                                        </li>
                                        <li data-val='3'>
                                            <a>周三</a>
                                            <i></i>
                                        </li>
                                        <li data-val='4'>
                                            <a>周四</a>
                                            <i></i>
                                        </li>
                                        <li data-val='5'>
                                            <a>周五</a>
                                            <i></i>
                                        </li>
                                        <li data-val='6'>
                                            <a>周六</a>
                                            <i></i>
                                        </li>
                                        <li data-val='7'>
                                            <a>周日</a>
                                            <i></i>
                                        </li>
                                    </ul>
                                    <span class="time-select m-l-10 m-r-10">
									<select name="week_hour[begin_hour]"
                                            class="select form-control form-control-sm m-r-5">
										<!--   -->
										<option value="00" selected="selected">00</option>
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
									<select name="week_hour[begin_minute]"
                                            class="select form-control form-control-sm m-l-5">
										<!--   -->

										<option value="00" selected="selected">00</option>

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
									<select name="week_hour[end_hour]"
                                            class="select form-control form-control-sm m-r-5">
										<!--   -->
										<option value="00" selected="selected">00</option>
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
									<select name="week_hour[end_minute]"
                                            class="select form-control form-control-sm m-l-5">
										<!--   -->

										<option value="00" selected="selected">00</option>

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
                                <div class="clear m-b-5"></div>
                                <!---->
                                <label class="control-label pull-left cur-p">
                                    <input type="radio" class="icheck" name="timepicker"
                                           @if(isset($model['ext_info']['timepicker']) && $model['ext_info']['timepicker'] == 2)checked="checked"
                                           @endif value='2'>
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
										<select name="month_hour[begin_hour][]"
                                                class="select form-control form-control-sm m-r-5">
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
										<select name="month_hour[begin_minute][]"
                                                class="select form-control form-control-sm m-l-5">
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
										<select name="month_hour[end_hour][]"
                                                class="select form-control form-control-sm m-r-5">
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
										<select name="month_hour[end_minute][]"
                                                class="select form-control form-control-sm m-l-5">
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
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="limitdiscountmodel-act_label" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">活动标签：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <input type="text" id="limitdiscountmodel-act_label" class="form-control"
                                   name="LimitDiscountModel[act_label]"
                                   value="{{ $model['ext_info']['act_label'] ?? '' }}">
                        </div>
                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">活动期间展示于商品详情的活动标记处，建议最多8个字，如果未设置，默认是“限时折扣”文字</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        <span class="ng-binding">限购设置：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box limit-type">
                            <div class="clearfix limit-type-item">
                                <label class="control-label cur-p m-r-30" style="float: left;">
                                    <input type="radio" class="icheck" name="limit_type"
                                           @if(isset($model['ext_info']['limit_type']) && $model['ext_info']['limit_type'] == 0)checked="checked"
                                           @endif value='0'>
                                    不限购
                                </label>
                            </div>
                            <div class="clearfix limit-type-item">
                                <label class="control-label cur-p" style="float: left;">
                                    <input type="radio" class="icheck" name="limit_type"
                                           @if(isset($model['ext_info']['limit_type']) && $model['ext_info']['limit_type'] == 1)checked="checked"
                                           @endif value='1'>
                                    每人每种商品限购
                                    <input class="form-control ipt m-l-10 m-r-10" type="text"
                                           name='limit_num_1' data-rule-min="1" data-rule-digits="true"
                                           value='{{ $model['ext_info']['limit_num_1'] ?? '' }}'>
                                    件
                                </label>
                                <br>
                                <label class="control-label cur-p m-l-30" style="float: left;">
                                    <input type="checkbox" class="icheck" name="limit_type_checks[]"
                                           value='1'>
                                    每天限购
                                    <input class="form-control ipt m-l-10 m-r-10" type="text"
                                           name='limit_num_day' data-rule-min="0" data-rule-digits="true"
                                           value=''>
                                    件
                                    <div class="help-block help-block-t">为0表示无限制</div>
                                </label>
                                <br>
                                <label class="control-label cur-p m-l-30" style="float: left;">
                                    <input type="checkbox" class="icheck" name="limit_type_checks[]"
                                           value='2'>
                                    每单限购
                                    <input class="form-control ipt m-l-10 m-r-10" type="text"
                                           name='limit_num_order' data-rule-min="0" data-rule-digits="true"
                                           value=''>
                                    件
                                    <div class="help-block help-block-t">为0表示无限制</div>
                                </label>
                            </div>
                            <div class="clearfix limit-type-item">
                                <label class="control-label cur-p" style="float: left;">
                                    <input type="radio" class="icheck" name="limit_type" value='2'>
                                    每人每种商品限前
                                    <input class="form-control ipt m-l-10 m-r-10" type="text"
                                           name='limit_num_2' data-rule-min="1" data-rule-digits="true"
                                           value=''>
                                    件享受折扣
                                </label>
                            </div>
                        </div>
                        <div class="help-block help-block-t">
                            开启周期重复后，每一个周期开始后都将重新计算限购条件；关闭周期重复后，限购条件是针对整个活动期间内的；
                        </div>
                    </div>
                </div>
            </div>

            <!-- 活动图片 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="limitdiscountmodel-act_img" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">活动推广图：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <div id="act_img_container"></div>
                            <input type="hidden" id="limitdiscountmodel-act_img" class="form-control"
                                   name="LimitDiscountModel[act_img]" value="{{ $model['act_img'] ?? '' }}">


                        </div>

                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">
                                限时折扣活动页面的图片，请使用585*390像素，上传活动推广图，此活动才可在前台限时折扣活动页面展示，大小1M内的图片，支持jpg、jpeg、gif、png格式上传
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<!-- 活动商品 -->
			<div class="simple-form-field">
				<div class="form-group">
					<label for="limitdiscountmodel-use_range" class="col-sm-3 control-label">
						<span class="ng-binding">参与商品：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box">
							<input type="hidden" name="LimitDiscountModel[use_range]" value="">
							<div id="limitdiscountmodel-use_range" class=""
								 name="LimitDiscountModel[use_range]"><label
										class="control-label cur-p m-r-10"><input type="radio"
																				  name="LimitDiscountModel[use_range]"
																				  value="0" checked>
									全部商品参与（包含出售中和已下架商品）</label>
								<label class="control-label cur-p m-r-10"><input type="radio"
																				 name="LimitDiscountModel[use_range]"
																				 value="2">
									全部出售中商品参与</label>
								<label class="control-label cur-p m-r-10"><input type="radio"
																				 name="LimitDiscountModel[use_range]"
																				 value="1"> 指定商品参与</label>
								<label class="control-label cur-p m-r-10"><input type="radio"
																				 name="LimitDiscountModel[use_range]"
																				 value="3"> 指定商品不参与</label>
							</div>
						</div>
						<div class="help-block help-block-t"></div>
					</div>
				</div>
			</div>
			<div class="simple-form-field act_price_type_div ">
				<div class="form-group">
					<label class="col-sm-3 control-label">
						<span class="text-danger ng-binding">*</span>
						<span class="ng-binding">参与商品活动价设置：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box m-r-10">
							<div class="" name="LimitDiscountModel[act_price_type]" value="0"><label
										class="control-label cur-p m-r-10"><input type="radio"
																				  name="LimitDiscountModel[act_price_type]"
																				  value="0" checked> 打折</label>
								<label class="control-label cur-p m-r-10"><input type="radio"
																				 name="LimitDiscountModel[act_price_type]"
																				 value="1"> 减价</label>
								<label class="control-label cur-p m-r-10"><input type="radio"
																				 name="LimitDiscountModel[act_price_type]"
																				 value="2"> 指定折扣价</label>
							</div>
							<div class='act_discount_div act_price_type_text  m-t-10 '>
								<input type="text" id="limitdiscountmodel-act_discount"
									   class="form-control ipt m-r-10"
									   name="LimitDiscountModel[act_discount]">折
							</div>
							<div class='act_mark_down_div act_price_type_text  m-t-10 hide'>
								<input type="text" id="limitdiscountmodel-act_mark_down"
									   class="form-control ipt m-r-10"
									   name="LimitDiscountModel[act_mark_down]">元
							</div>
							<div class='act_price_div act_price_type_text  m-t-10 hide'>
								<input type="text" id="limitdiscountmodel-act_price"
									   class="form-control ipt m-r-10" name="LimitDiscountModel[act_price]">元
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="simple-form-field act_stock_div ">
				<div class="form-group">
					<label class="col-sm-3 control-label">
						<span class="text-danger ng-binding">*</span>
						<span class="ng-binding">参与商品活动库存设置：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box m-r-10">
							<input type="text" id="limitdiscountmodel-act_stock" class="form-control ipt"
								   name="LimitDiscountModel[act_stock]">
						</div>
						<div class="help-block help-block-t">
							<div class="help-block help-block-t">
								<div class="help-block help-block-t">
									<div class="help-block help-block-t">
										编辑时，如果将活动库存设置为非0，则设置的值将替换参与活动的商品的活动库存，如果设置为0，商品活动库存不变
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="simple-form-field act_goods_div hide">
				<div class="form-group">
					<label class="col-sm-3 control-label">
						<span class="text-danger ng-binding">*</span>
						<span class="ng-binding">选择商品：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box m-r-10">
							<!--请在这里调取选择商品选择器插件-->
							<div id="widget_goods" class="p-l-15 p-r-15 w800"></div>
							<div id="goods_list">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="simple-form-field act_goods_no_join_div hide">
				<div class="form-group">
					<label class="col-sm-3 control-label">
						<span class="text-danger ng-binding">*</span>
						<span class="ng-binding">选择商品：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box m-r-10">
							<!--请在这里调取选择商品选择器插件-->
							<div id="widget_goods_no_join" class="p-l-15 p-r-15 w800"></div>
							<div id="no_join_goods_list">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="simple-form-field act_multistore_type_div ">
				<div class="form-group">
					<label class="col-sm-3 control-label">
						<span class="text-danger ng-binding">*</span>
						<span class="ng-binding">参与门店：</span>
					</label>
					<div class="col-sm-9">
						<div class="form-control-box m-r-10">
							<input type="hidden" name="LimitDiscountModel[act_multistore_type]" value="">
							<div id="limitdiscountmodel-act_multistore_type" class=""
								 name="LimitDiscountModel[act_multistore_type]"><label
										class="control-label cur-p m-r-10"><input type="radio"
																				  name="LimitDiscountModel[act_multistore_type]"
																				  value="0" checked>
									全部门店</label>
								<label class="control-label cur-p m-r-10"><input type="radio"
																				 name="LimitDiscountModel[act_multistore_type]"
																				 value="1"> 指定分组下的门店</label>
								<label class="control-label cur-p m-r-10"><input type="radio"
																				 name="LimitDiscountModel[act_multistore_type]"
																				 value="2"> 指定门店</label>
							</div>
							<input type="hidden" id="group_ids" name="group_ids" value="">
							<input type='hidden' name="store_ids" id="store_ids" value="">
							<div class="selector-set region-selected m-b-0 m-t-10" id="select_group"
								 style="">
							</div>
							<div class="selector-set region-selected m-b-0 m-t-10" id="select_store"
								 style="">
							</div>
						</div>
					</div>
				</div>
			</div>

{{--			<div class="simple-form-field">--}}
{{--                <div class="form-group">--}}
{{--                    <label class="col-sm-3 control-label">--}}
{{--                        <span class="text-danger ng-binding">*</span>--}}
{{--                        <span class="ng-binding">选择商品：</span>--}}
{{--                    </label>--}}
{{--                    <div class="col-sm-9">--}}
{{--                        <div class="form-control-box m-r-10">--}}
{{--                            <!--请在这里调取选择商品选择器插件-->--}}
{{--                            <div id="widget_goods" class="p-l-15 p-r-15"></div>--}}
{{--                            <!---->--}}
{{--                            <div id="goods_list">--}}
{{--                                @if(!empty($goods_list))--}}
{{--                                    <div class="table-responsive m-t-10" style="max-height: 300px; overflow-y: auto;">--}}
{{--                                        <table id="table_list" class="table table-hover m-b-0 w800 limit-discount-list">--}}
{{--                                            <thead>--}}
{{--                                            <tr>--}}
{{--                                                <th class="w200">商品名称</th>--}}
{{--                                                <th class="w100 text-c">价格</th>--}}
{{--                                                <th class="w80 text-c">--}}
{{--                                                    折扣（折）--}}
{{--                                                    --}}{{--                                                    <div class="batch">--}}
{{--                                                    --}}{{--                                                        <a class="batch-edit" title="批量设置">--}}
{{--                                                    --}}{{--                                                            <i class="fa fa-edit"></i>--}}
{{--                                                    --}}{{--                                                        </a>--}}
{{--                                                    --}}{{--                                                        <div class="batch-input" style="display: none">--}}
{{--                                                    --}}{{--                                                            <h6>批量设置折扣：</h6>--}}
{{--                                                    --}}{{--                                                            <a class="batch-close">X</a>--}}
{{--                                                    --}}{{--                                                            <input class="form-control text small batch_set_discount" type="text">--}}
{{--                                                    --}}{{--                                                            <a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type=0>设置</a>--}}
{{--                                                    --}}{{--                                                            <span class="arrow"></span>--}}
{{--                                                    --}}{{--                                                        </div>--}}
{{--                                                    --}}{{--                                                    </div>--}}
{{--                                                </th>--}}
{{--                                                <th class="w80 text-c">--}}
{{--                                                    减价（元）--}}
{{--                                                    --}}{{--                                                    <div class="batch">--}}
{{--                                                    --}}{{--                                                        <a class="batch-edit" title="批量设置">--}}
{{--                                                    --}}{{--                                                            <i class="fa fa-edit"></i>--}}
{{--                                                    --}}{{--                                                        </a>--}}
{{--                                                    --}}{{--                                                        <div class="batch-input" style="display: none">--}}
{{--                                                    --}}{{--                                                            <h6>批量设置减价：</h6>--}}
{{--                                                    --}}{{--                                                            <a class="batch-close">X</a>--}}
{{--                                                    --}}{{--                                                            <input class="form-control text small batch_set_mark_down" type="text">--}}
{{--                                                    --}}{{--                                                            <a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type=1>设置</a>--}}
{{--                                                    --}}{{--                                                            <span class="arrow"></span>--}}
{{--                                                    --}}{{--                                                        </div>--}}
{{--                                                    --}}{{--                                                    </div>--}}
{{--                                                </th>--}}
{{--                                                <th class="w120">指定折扣价（元）</th>--}}
{{--                                                <th class="w80 text-c">库存</th>--}}

{{--                                                <th class="handle w80">操作</th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody id="goods_info">--}}


{{--                                            @foreach($goods_list as $goods_id=>$v)--}}
{{--                                                <tr data-limit-discount-sku-id="{{ $v['sku_id'] }}"--}}
{{--                                                    data-limit-discount-goods-id="{{ $goods_id }}">--}}
{{--                                                    <td>--}}
{{--                                                        {{ $v['goods_name'] }}--}}
{{--                                                        <input type="hidden" name="goods_spu[]" value="{{ $goods_id }}">--}}
{{--                                                        <input type="hidden" name="goods_spu_discount[]" value=""--}}
{{--                                                               class="{{ $goods_id }}-discount calculation_price">--}}
{{--                                                        <input type="hidden" name="goods_spu_reduce[]"--}}
{{--                                                               value="{{ $goods_id }}-{{ $v['discount_num'] }}"--}}
{{--                                                               class="{{ $goods_id }}-reduce calculation_price">--}}
{{--                                                    </td>--}}
{{--                                                    <td class="text-c">￥{{ $v['goods_price'] }}</td>--}}
{{--                                                    <td class="text-c">--}}
{{--                                                        <input class="form-control small sm-height limit_discount_sku sku-act_price-{{ $v['sku_id'] }} discount discount-{{ $v['sku_id'] }}"--}}
{{--                                                               type="text" data-goods-id="{{ $goods_id }}"--}}
{{--                                                               data-min_price="{{ $v['min_goods_price'] }}"--}}
{{--                                                               data-max_price="{{ $v['max_goods_price'] }}"--}}
{{--                                                               data-rule-callback='act_price_callback'>--}}
{{--                                                    </td>--}}
{{--                                                    <td class="text-c">--}}
{{--                                                        <input class="form-control small sm-height limit_discount_sku sku-act_price-{{ $v['sku_id'] }} mark_down mark_down-{{ $v['sku_id'] }}"--}}
{{--                                                               type="text" data-goods-id="{{ $goods_id }}"--}}
{{--                                                               data-min_price="{{ $v['min_goods_price'] }}"--}}
{{--                                                               data-max_price="{{ $v['max_goods_price'] }}"--}}
{{--                                                               data-rule-callback='act_mark_down_callback'--}}
{{--                                                               value='{{ $v['discount_num'] }}'>--}}
{{--                                                    </td>--}}
{{--                                                    <td class="text-c">--}}
{{--                                                        <input type="text"--}}
{{--                                                               class="form-control small sm-height limit_discount_sku sku-act_price-{{ $v['sku_id'] }} set_act_price set_act_price-{{ $v['sku_id'] }}"--}}
{{--                                                               value="{{ $v['format_goods_price'] }}"--}}
{{--                                                               data-sku_id="{{ $v['sku_id'] }}"--}}
{{--                                                               data-goods_id="{{ $goods_id }}"--}}
{{--                                                               data-goods_price="{{ $v['goods_price'] }}"--}}
{{--                                                               data-type="set_act_price"--}}
{{--                                                               data-rule-callback="set_price_callback"></td>--}}

{{--                                                    --}}{{--                                                <td class="after-price after-price-{{ $goods_id }}" data-goods-id="{{ $goods_id }}">{{ $v['format_goods_price'] }}</td>--}}

{{--                                                    <td class="text-c">{{ $v['goods_number'] }}</td>--}}
{{--                                                    <td class="handle">--}}
{{--                                                        <a href="javascript:void(0);" data-sku-id="{{ $v['sku_id'] }}"--}}
{{--                                                           data-goods-id="{{ $goods_id }}"--}}
{{--                                                           data-goods-price="{{ $v['goods_price'] }}"--}}
{{--                                                           class="del border-none">删除</a>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            @endforeach--}}

{{--                                            --}}{{--<tr data-limit-discount-sku-id="871" data-limit-discount-goods-id="178">--}}
{{--                                                <td>--}}
{{--                                                    古古怪怪--}}
{{--                                                    <input type="hidden" name="goods_spu[]" value="178">--}}
{{--                                                    <input type="hidden" name="goods_spu_discount[]" value="178-9" class="178-discount calculation_price">--}}
{{--                                                    <input type="hidden" name="goods_spu_reduce[]" value="" class="178-reduce calculation_price">--}}
{{--                                                </td>--}}
{{--                                                <td class="text-c">￥1.00-￥2.00</td>--}}
{{--                                                <td class="text-c">69</td>--}}
{{--                                                <td class="limit-discount">--}}
{{--                                                    <input class="form-control form-control-sm w60 discount discount-178" type="text" data-goods-id="178" data-min_price="1.00" data-max_price="2.00" data-rule-callback='act_price_callback' value='9'>--}}
{{--                                                </td>--}}
{{--                                                <td class="limit-discount">--}}
{{--                                                    <input class="form-control form-control-sm w60 mark_down mark_down-178" type="text" data-goods-id="178" data-min_price="1.00" data-max_price="2.00" data-rule-callback='act_mark_down_callback' >--}}
{{--                                                </td>--}}
{{--                                                <td class="after-price after-price-178" data-goods-id="178">￥0.9-￥1.8</td>--}}
{{--                                                <td class="handle">--}}
{{--                                                    <a href="javascript:void(0);" data-sku-id="871" data-goods-id="178" data-goods-price="￥1.00-￥2.00" class="del border-none">删除</a>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}


{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                    <!--错误提示模块 star-->--}}
{{--                                    <div class="member-handle-error"></div>--}}
{{--                                    <!--错误提示模块 end-->--}}
{{--                                    <script type="text/javascript">--}}
{{--                                        //--}}
{{--                                    </script>--}}

{{--                                    <script type="text/javascript">--}}
{{--                                        //--}}
{{--                                    </script>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <!-- 排序 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="limitdiscountmodel-sort" class="col-sm-3 control-label">

                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="limitdiscountmodel-sort" class="form-control small"
                                   name="LimitDiscountModel[sort]" value="{{ $model['sort'] ?? 255 }}">


                        </div>

                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div>
                        </div>
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
	<div class="group_container " style="display: none">
		<div class="postage-detail m-20">
			<div class="p-15 p-t-5 p-b-5 default" style="background: rgba(93,178,255,.1);">
				<div class="m-b-5">
					<label class="control-label m-r-10 cur-p text-l l-h-18">
						<input type="checkbox" class="checkBox allCheckGroup m-r-5 cur-p"/>全部分组
					</label>
				</div>
				<label class="control-label m-r-10 cur-p w120 text-l l-h-18">
					<input type="checkbox" class="checkBox m-r-5 cur-p" value="6" name="group_id"
						   data-name="22"/>
					22
				</label>
				<label class="control-label m-r-10 cur-p w120 text-l l-h-18">
					<input type="checkbox" class="checkBox m-r-5 cur-p" value="5" name="group_id"
						   data-name="11"/>
					11
				</label>
			</div>
		</div>
	</div>
	<!--点击按钮为表格增加行-->
	<script id="opentime_template" type="text">
<div class="m-b-5 month_day">
<select name="month_day[]" class="form-control form-control-sm w100 m-r-10 month-day-select">
<option value="">--请选择--</option>
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
<!--   -->
<option value="31">31</option>
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
<div class="m-b-10 alert alert-warning br-0" style="background-color: #fff9e6; border: 1px solid #ffd77a;">
<p><b>重要提示</b></p>
<p class="m-t-5">商品“剩余活动库存”如果为&nbsp;0&nbsp;则活动商品将<b>恢复原价售卖</b>，活动期间请确保“剩余活动库存”充足</p>
</div>
    <div  class="1640703872Lzcc7F search-condition-table m-b-10">
        <div class="search-condition-box">
            <select name='keyword_type'  class="form-control w150 m-l-2 m-r-2">
                <option value='1'>商品名称</option>
                <option value='2'>商品ID</option>
                <option value='3'>商品货号</option>
            </select>
            <input type="text" name="keyword" class="form-control w150 m-l-2 m-r-2" placeholder="关键字">
            <input type="text" name="goods_barcode" class="form-control w150 m-l-2 m-r-2" placeholder="商品条形码">
            <input type="button" class="btn btn-primary m-l-2 m-r-2 btn-search" value="搜索商品">
        </div>
        <div class="clear"></div>
     </div>
<div id="1640703872Lzcc7F" class="table-responsive m-t-10" style="max-height: 450px; overflow-y: auto;">
    <table id="selected_table_list" class="table table-hover m-b-0 w800 limit-discount-list" >
        <thead>
            <tr>
                <th class="w50">
                    <input type="checkbox" />
                </th>
                <th class="w150">商品名称</th>
                <th class="w100 text-c">原价</th>
                <th class="w80 text-c">折扣（折）</th>
                <th class="w80 text-c">减价（元）</th>
                <th class="w120 text-c">指定<br/>折扣价（元）</th>
                <th class="w120 text-c">活动价</th>
                <th class="w100 text-c">活动库存</th>
                <th class="handle w100">操作</th>
            </tr>
        </thead>
        <tbody id="goods_info">
        </tbody>
        <tfoot>
            <tr>
                <td class="w50">
                    <input type="checkbox" class="checkBox" />
                </td>
                <td colspan="8">
                    <input type="button" class="btn btn-default m-r-2 batchset-discount" value="批量折扣" />
                    <input type="button" class="btn btn-default m-r-2 batchset-reduce" value="批量减价" />
                    <input type="button" class="btn btn-default m-r-2 batchset-set" value="批量指定折扣价" />
                    <input type="button" class="btn btn-default m-r-2 batchset-stock" value="批量设置活动库存" />
                </td>
            </tr>
        </tfoot>
    </table>
</div>
<!--错误提示模块 star-->
<div class="member-handle-error"></div>
<!--错误提示模块 end-->
<template id="batch_discount_template">
<div class="p-20 ">
    <div class="table-content m-t-10">
        <div class="form-horizontal">
            <!-- 服务保障 -->
            <div class="simple-form-field" >
<div class="form-group">
<label for="" class="col-sm-4 control-label">
<span class="ng-binding">折扣：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">
            <input type="text" id="batchset_discount_val" class="form-control w100" data-rule-callback="list_act_price_callback">
            <span class="m-l-5">折</span>
</div>
<div class="help-block help-block-t"></div>
</div>
</div>
</div>        </div>
    </div>
</div>
</template>
<template id="batch_reduce_template">
<div class="p-20 ">
    <div class="table-content m-t-10">
        <div class="form-horizontal">
            <!-- 服务保障 -->
            <div class="simple-form-field" >
<div class="form-group">
<label for="" class="col-sm-4 control-label">
<span class="ng-binding">减价：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">
            <span class="m-r-5">减</span>
            <input type="text" id="batchset_reduce_val" class="form-control w100" data-rule-callback="list_act_mark_down_callback">
            <span class="m-l-5">元</span>
</div>
<div class="help-block help-block-t"></div>
</div>
</div>
</div>        </div>
    </div>
</div>
</template>
<template id="batch_set_template">
<div class="p-20 ">
    <div class="table-content m-t-10">
        <div class="form-horizontal">
            <!-- 服务保障 -->
            <div class="simple-form-field" >
<div class="form-group">
<label for="" class="col-sm-4 control-label">
<span class="ng-binding">指定折扣价：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">
            <input type="text" id="batchset_set_val" class="form-control w100" data-rule-callback="list_set_price_callback">
            <span class="m-l-5">元</span>
</div>
<div class="help-block help-block-t"></div>
</div>
</div>
</div>        </div>
    </div>
</div>
</template>
<template id="batch_stock_template">
<div class="p-20 ">
    <div class="table-content m-t-10">
        <div class="form-horizontal">
            <!-- 服务保障 -->
            <div class="simple-form-field" >
<div class="form-group">
<label for="" class="col-sm-4 control-label">
<span class="ng-binding">剩余活动库存：</span>
</label>
<div class="col-sm-8">
<div class="form-control-box">
            <input type="text" id="batchset_stock_val" class="form-control w100 m-r-10" data-rule-callback="list_set_act_stock_callback">
</div>
<div class="help-block help-block-t"></div>
</div>
</div>
</div>        </div>
    </div>
</div>
</template>
<script type="text/javascript">
    $('#1640703872Lzcc7F').on('click','.checkBox',function(){
        $('#1640703872Lzcc7F').find('tbody').find('tr').removeClass('active')
    })
    $('.1640703872Lzcc7F').on('click','.btn-search',function(){
        var keyword_type = $('.1640703872Lzcc7F').find('select[name="keyword_type"]').val();
        var keyword = $('.1640703872Lzcc7F').find('input[name="keyword"]').val();
        var goods_barcode = $('.1640703872Lzcc7F').find('input[name="goods_barcode"]').val();
         $('#1640703872Lzcc7F').find('tbody').find('tr').removeClass('goods_info_search_selected');
        if(keyword !=''&& goods_barcode!='')
        {
            if(keyword_type ==1){
                $('#1640703872Lzcc7F').find('tbody').find('tr[data-goods_name*="'+keyword+'"][data-goods_barcode*="'+goods_barcode+'"]').addClass('goods_info_search_selected');
            }else if(keyword_type ==2){
                $('#1640703872Lzcc7F').find('tbody').find('tr[data-goods_id*="'+keyword+'"][data-goods_barcode*="'+goods_barcode+'"]').addClass('goods_info_search_selected');
            }else if(keyword_type==3){
                $('#1640703872Lzcc7F').find('tbody').find('tr[data-goods_sn*="'+keyword+'"][data-goods_barcode*="'+goods_barcode+'"]').addClass('goods_info_search_selected');
            }
        }else if(keyword != '')
        {
            if(keyword_type ==1){
                $('#1640703872Lzcc7F').find('tbody').find('tr[data-goods_name*="'+keyword+'"]').addClass('goods_info_search_selected');
            }else if(keyword_type ==2){
                $('#1640703872Lzcc7F').find('tbody').find('tr[data-goods_id*="'+keyword+'"]').addClass('goods_info_search_selected');
            }else if(keyword_type==3){
                $('#1640703872Lzcc7F').find('tbody').find('tr[data-goods_sn*="'+keyword+'"]').addClass('goods_info_search_selected');
            }
        }else if(goods_barcode != ''){
            $('#1640703872Lzcc7F').find('tbody').find('tr[data-goods_barcode*="'+goods_barcode+'"]').addClass('goods_info_search_selected');
        }
        var item=$("#1640703872Lzcc7F").find('.goods_info_search_selected').length;
        if(item >0){
            var item_top = $("#1640703872Lzcc7F").find('.goods_info_search_selected:first').offset().top
            var parent_top =$("#1640703872Lzcc7F").offset().top;
            var top = item_top - parent_top
            if(top > 0){
                $("#1640703872Lzcc7F").animate({
                    scrollTop:top
                }, 0);
            }
        }
    })
    // 自定义验证规则：指定折扣价
    function list_set_price_callback(element, value) {
        var sku_id = $(element).data('sku_id');
        var goods_price = $(element).data('goods_price');
        var regu = /^[0-9]+\.?[0-9]*$/;
        if (isNaN($(element).val())) {
            $(element).data("msg", "指定折扣价格必须是数字。");
            return false;
        }
        if ($(element).val() < 0) {
            $(element).data("msg", "指定折扣价格必须大于0。");
            return false;
        }
        //验证优惠价格与SKU价格
        if (goods_price * 100 < $(element).val() * 100) {
            $(element).data("msg", "指定折扣价格不能大于商品价格。");
            return false;
        }
        if ($(element).val().indexOf('.') > -1) {
            if ($(element).val().split('.')[1].length > 2) {
                $(element).data("msg", "指定折扣价格只能保留2位小数。");
                return false;
            }
        }
        return true;
    }
    // 自定义验证规则：折扣
    function list_act_price_callback(element, value) {
        var goods_id = $(element).data('goods_id');
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
        return true;
    }
    // 自定义验证规则：减价
    function list_act_mark_down_callback(element, value) {
        var goods_id = $(element).data('goods_id');
        var min_price = $(element).data('goods_price');
        var max_price = $(element).data('goods_price');
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
            $(element).data("msg", "减价金额必须小于商品最低金额￥" + min_price);
            return false;
        }
        if ($(element).val().indexOf('.') > -1) {
            if ($(element).val().split('.')[1].length > 2) {
                $(element).data("msg", "折扣只能保留2位小数。");
                return false;
            }
        }
        return true;
    }
    function list_set_act_stock_callback(element, value) {
        if (/^(([0])|([1-9](\d*)))$/.test($(element).val()) == false) {
            $(element).data("msg", "活动库存必须是一个大于等于 0 的整数");
            return false;
        }
        return true;
    }
    //设置价格
    $("body").on('change', ".limit_discount_sku", function() {
        var goods_id = $(this).data('goods_id');
        var sku_id = $(this).data('sku_id');
        var type = $(this).data('type');
        var val = $(this).val();
        var goods_price = $(this).data('goods_price');
        var discount = '';
        var reduce = '';
        var set = '';
        $(".sku-act_price-" + sku_id).val('');
        $(".sku-act_price-" + sku_id).removeClass('error');
        $("." + type + '-' + sku_id).val(val);
        if (isNaN(val) || val.length == 0) {
            $("#act_price-" + sku_id).html("--");
            return;
        }
        if (type == 'discount') {
            goods_price = (goods_price * val) / 10;
            $("." + goods_id + '-discount').val(sku_id + '-' + val);
            $("." + goods_id + '-reduce').val('');
            $("." + goods_id + '-set').val('');
        } else if (type == 'mark_down') {
            goods_price -= val;
            $("." + goods_id + '-reduce').val(sku_id + '-' + val);
            $("." + goods_id + '-discount').val('');
            $("." + goods_id + '-set').val('');
        } else {
            goods_price = parseFloat(val);
            $("." + goods_id + '-reduce').val('');
            $("." + goods_id + '-discount').val('');
            $("." + goods_id + '-set').val(sku_id + '-' + val);
        }
        $("#" + goods_id + "-goods-price").html("￥" + goods_price.toFixed(2));
    });
    // 设置库存
    $("body").on("change", ".set_act_stock", function() {
        var goods_id = $(this).data('goods_id');
        var sku_id = $(this).data('sku_id');
        var val = $(this).val();
        if ($(this).valid()) {
            $("." + goods_id + '-stock').val(sku_id + '-' + val);
        }
    });
    var tablelist = null;
    $().ready(function() {
        $("[data-toggle='popover']").popover();
        tablelist = $("#1640703872Lzcc7F").find("#selected_table_list").tablelist();
        //删除商品
        $("body").off("click", ".del").on("click", ".del", function() {
            var target = $(this).parents("tr");
            var goods_id = $(this).data("goods_id");
            var sku_id = $(this).data("sku-id");
            var goods_price = $(this).data("goods_price");
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
        // 设置
        $("body").off("click", ".set-price").on("click", ".set-price", function() {
            var goods_id = $(this).data("goods_id");
            var sku_discount = $("." + goods_id + "-discount").val();
            var sku_reduce = $("." + goods_id + "-reduce").val();
            var sku_set = $("." + goods_id + "-set").val();
            var sku_stock = $("." + goods_id + "-stock").val();
            $.loading.start();
            $.open({
                title: '折扣价设置',
                width: '1200px',
                ajax: {
                    url: '/dashboard/limit-discount/sku-info',
                    method: 'POST',
                    data: {
                        act_id: "",
                        goods_id: goods_id,
                        sku_discount: sku_discount,
                        sku_reduce: sku_reduce,
                        sku_set: sku_set,
                        sku_stock: sku_stock,
                    },
                    success: function(result) {
                        $.loading.stop();
                    },
                }
            });
        });
        // 展示错误信息
        function showError(element, error) {
            if (error) {
                if ($(element).parents(".form-group").find(".form-control-error").size() == 0) {
                    $(element).parents(".form-control-box").after('<span class="form-control-error"><i class="fa fa-warning"></i>' + error + '</span>')
                } else {
                    $(element).parents(".form-group").find(".form-control-error").html('<i class="fa fa-warning"></i>' + error);
                }
            } else {
                $(element).parents(".form-group").find(".form-control-error").html("");
            }
        }
        // 临时验证器
        function validate(element) {
            var value = $(element).val();
            var callback = $(element).data("rule-callback");
            callback = window[callback];
            var valid = value != "" && callback(element, value);
            if (valid) {
                showError(element, false);
            } else {
                showError(element, $(element).data("msg"));
            }
            $(element).data("valid", valid)
            return valid;
        }
        // 批量设置折扣
        $(".batchset-discount").unbind().click(function() {
            var ids = tablelist.checkedValues();
            ids = ids.join(",");
            if (!ids) {
                $.msg("请选择要设置的商品！");
                return;
            }
            $.open({
                title: '批量设置折扣',
                width: '480px',
                content: $("#batch_discount_template").html(),
                btn: ['确定', '取消'],
                success: function(obj) {
                    $(obj).find("#batchset_discount_val").keyup(function() {
                        var element = this;
                        $("#1640703872Lzcc7F").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
                            $(element).data($(this).data());
                            $(element).data("goods_id", $(this).val());
                            if(validate(element) == false){
                                return false;
                            }
                        })
                    });
                },
                yes: function(index, obj) {
                    var target = $(obj).find("#batchset_discount_val");
                    var value = $(target).val();
                    if ($(target).data("valid") != true) {
                        $(target).focus();
                        return;
                    }
                    $.loading.start();
                    $("#1640703872Lzcc7F").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
                        var goods_id = $(this).val();
                        var sku_id = $(this).data("sku_id");
                        var sku_open = $(this).data("sku_open");
                        var min_price = $(this).data("min_price");
                        var max_price = $(this).data("max_price");
                        // 数据
                        $("." + goods_id + "-discount").val("0-" + value);
                        $("." + goods_id + "-reduce").val("");
                        $("." + goods_id + "-set").val("");
                        // 价格
                        if(min_price == max_price){
                            $("#" + goods_id + "-goods-price").html("￥" + (min_price * value / 10).toFixed(2))
                        }else{
                            $("#" + goods_id + "-goods-price").html("￥" + (min_price * value / 10).toFixed(2) + "-￥" + (max_price * value / 10).toFixed(2))
                        }
                        // 展示
                        if(sku_open == 1){
                            $("#" + goods_id + "-discount-val").html(value);
                            $("#" + goods_id + "-reduce-val").html("--");
                            $("#" + goods_id + "-set-val").html("--");
                        }else{
                            $(".discount-" + sku_id).val(value);
                            $(".mark_down-" + sku_id).val("");
                            $(".set_act_price-" + sku_id).val("");
                        }
                    });
                    $.loading.stop();
                    $.closeDialog(index);
                }
            });
            return false;
        });
        // 批量设置减价
        $("body").on("click", ".batchset-reduce", function() {
            var ids = tablelist.checkedValues();
            ids = ids.join(",");
            if (!ids) {
                $.msg("请选择要设置的商品！");
                return;
            }
            $.open({
                title: '批量设置减价',
                width: '480px',
                content: $("#batch_reduce_template").html(),
                btn: ['确定', '取消'],
                success: function(obj) {
                    $(obj).find("#batchset_reduce_val").keyup(function() {
                        var element = this;
                        $("#1640703872Lzcc7F").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                            $(element).data($(this).data());
                            $(element).data("goods_id", $(this).val());
                            if (validate(element) == false) {
                                return false;
                            }
                        })
                    });
                },
                yes: function(index, obj) {
                    var target = $(obj).find("#batchset_reduce_val");
                    var value = $(target).val();
                    if ($(target).data("valid") != true) {
                        $(target).focus();
                        return;
                    }
                    $.loading.start();
                    $("#1640703872Lzcc7F").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
                        var goods_id = $(this).val();
                        var sku_id = $(this).data("sku_id");
                        var sku_open = $(this).data("sku_open");
                        var min_price = $(this).data("min_price");
                        var max_price = $(this).data("max_price");
                        // 数据
                        $("." + goods_id + "-discount").val("");
                        $("." + goods_id + "-reduce").val("0-" + value);
                        $("." + goods_id + "-set").val("");
                        // 价格
                        if(min_price == max_price){
                            $("#" + goods_id + "-goods-price").html("￥" + (min_price - value))
                        }else{
                            $("#" + goods_id + "-goods-price").html("￥" + (min_price - value) + "-￥" + (max_price - value))
                        }
                        // 展示
                        if(sku_open == 1){
                            $("#" + goods_id + "-discount-val").html("--");
                            $("#" + goods_id + "-reduce-val").html(value);
                            $("#" + goods_id + "-set-val").html("--");
                        }else{
                            $(".discount-" + sku_id).val("");
                            $(".mark_down-" + sku_id).val(value);
                            $(".set_act_price-" + sku_id).val("");
                        }
                    });
                    $.loading.stop();
                    $.closeDialog(index);
                }
            });
            return false;
        });
        // 批量设置指定折扣价
        $("body").on("click", ".batchset-set", function() {
            var ids = tablelist.checkedValues();
            ids = ids.join(",");
            if (!ids) {
                $.msg("请选择要设置的商品！");
                return;
            }
            $.open({
                title: '批量设置指定折扣价',
                width: '480px',
                content: $("#batch_set_template").html(),
                btn: ['确定', '取消'],
                success: function(obj) {
                    $(obj).find("#batchset_set_val").keyup(function() {
                        var element = this;
                        $("#1640703872Lzcc7F").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                            $(element).data($(this).data());
                            $(element).data("goods_id", $(this).val());
                            if (validate(element) == false) {
                                return false;
                            }
                        })
                    });
                },
                yes: function(index, obj) {
                    var target = $(obj).find("#batchset_set_val");
                    var value = $(target).val();
                    if ($(target).data("valid") != true) {
                        $(target).focus();
                        return;
                    }
                    $.loading.start();
                    $("#1640703872Lzcc7F").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
                        var goods_id = $(this).val();
                        var sku_id = $(this).data("sku_id");
                        var sku_open = $(this).data("sku_open");
                        var min_price = $(this).data("min_price");
                        var max_price = $(this).data("max_price");
                        // 数据
                        $("." + goods_id + "-discount").val("");
                        $("." + goods_id + "-reduce").val("");
                        $("." + goods_id + "-set").val("0-" + value);
                        // 价格
                        $("#" + goods_id + "-goods-price").html("￥" + value);
                        // 展示
                        if(sku_open == 1){
                            $("#" + goods_id + "-discount-val").html("--");
                            $("#" + goods_id + "-reduce-val").html("--");
                            $("#" + goods_id + "-set-val").html(value);
                        }else{
                            $(".discount-" + sku_id).val("");
                            $(".mark_down-" + sku_id).val("");
                            $(".set_act_price-" + sku_id).val(value);
                        }
                    });
                    $.loading.stop();
                    $.closeDialog(index);
                }
            });
            return false;
        });
        // 批量设置活动库存
        $("body").on("click", ".batchset-stock", function() {
            var ids = tablelist.checkedValues();
            ids = ids.join(",");
            if (!ids) {
                $.msg("请选择要设置的商品！");
                return;
            }
            $.open({
                title: '批量设置活动库存',
                width: '480px',
                content: $("#batch_stock_template").html(),
                btn: ['确定', '取消'],
                success: function(obj) {
                    $(obj).find("#batchset_stock_val").keyup(function() {
                        var element = this;
                        $("#1640703872Lzcc7F").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function() {
                            $(element).data($(this).data());
                            $(element).data("goods_id", $(this).val());
                            if (validate(element) == false) {
                                return false;
                            }
                        })
                    });
                },
                yes: function(index, obj) {
                    var target = $(obj).find("#batchset_stock_val");
                    var value = $(target).val();
                    if ($(target).data("valid") != true) {
                        $(target).focus();
                        return;
                    }
                    $.loading.start();
                    $("#1640703872Lzcc7F").find("#selected_table_list").find(".table-list-checkbox:checkbox:checked").each(function(){
                        var goods_id = $(this).val();
                        var sku_id = $(this).data("sku_id");
                        var sku_open = $(this).data("sku_open");
                        var goods_price = $(this).data("goods_price");
                        var min_price = $(this).data("min_price");
                        var max_price = $(this).data("max_price");
                        var sku_num = $(this).data("sku_num") ? $(this).data("sku_num") : 1;
                        // 数据
                        $("." + goods_id + "-stock").val("0-" + value);
                        // 展示
                        if(sku_open == 1){
                            $("#" + goods_id + "-stock-val").find(":input").val(value * sku_num);
                        }else{
                            $(".set_act_stock-" + sku_id).val(value * sku_num);
                        }
                    });
                    $.loading.stop();
                    $.closeDialog(index);
                }
            });
            return false;
        });
        /**
         * 初始化validator默认值自定义错误提示位置
         */
        var _errorPlacement = $.validator.defaults.errorPlacement;
        var _success = $.validator.defaults.success;
        $.validator.setDefaults({
            errorPlacement: function(error, element) {
                var error_id = $(error).attr("id");
                var error_msg = $(error).text();
                var element_id = $(error).attr("for");
                var sku_id = $(element).data("sku_id");
                var type = $(element).data("type");
                error_id += sku_id + type;
                if (!error_msg && error_msg == "") {
                    return;
                }
                var sku_error_id = "sku_error_" + error_id;
                //显示错误信息
                if (sku_id) {
                    if ($('body').find("#" + sku_error_id).size() == 0) {
                        $(".member-handle-error").append("<div id='"+sku_error_id+"' class='form-control-warning error m-t-10 m-r-10'></div>");
                        var error_dom = $("<p id='"+error_id+"'><i class='fa fa-times-circle'></i><span class='error-msg'>" + error_msg + "</span></p>");
                        $(".member-handle-error").find("#" + sku_error_id).append(error_dom).click(function() {
                            $(element).focus();
                        }).css("cursor", "pointer");
                    }
                } else {
                    if ($('body').find("#" + error_id).size() == 0) {
                        $(element).parent().after("<span id='"+error_id+"' class='form-control-error '></span>");
                        var error_dom = $("<i class='fa fa-times-circle'></i><span class='error-msg'>" + error_msg + "</span>");
                        $("#" + error_id).append(error_dom);
                    }
                }
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
                var sku_id = $(element).data("sku_id");
                var type = $(element).data("type");
                error_id += sku_id + type;
                var sku_error_id = "sku_error_" + error_id;
                //移除错误信息
                $('body').find("#" + error_id).remove();
                if ($('body').find("#" + sku_error_id).find("p").size() == 0) {
                    $('body').find("#" + sku_error_id).remove();
                }
            }
        });
        var validator = $("#1640703872Lzcc7F").find("form").validate();
        //提交
        $("#1640703872Lzcc7F").find("#btn_sku_price_submit").click(function() {
            var validat = 0;
            var show_msg = 0;
            $(".limit_discount_sku").each(function() {
                if ($(this).attr("aria-invalid") == 'true') {
                    validat = 1;
                    return false;
                }
                var sku_id = $(this).data('sku_id');
                var act_price = $("#act_price-" + sku_id).html();
                if (act_price == '--') {
                    show_msg = 1;
                }
            });
            if (show_msg == 1) {
                $.confirm("有规格未设置折扣是否将原价设置为活动价？", function() {
                    $(".limit_discount_sku").each(function() {
                        var sku_id = $(this).data('sku_id');
                        var goods_price = parseFloat($(this).data('goods_price'));
                        var act_price = $("#act_price-" + sku_id).html();
                        if (act_price == '--') {
                            //自动设置折扣
                            $(".discount-" + sku_id).val(10);
                            $("#act_price-" + sku_id).html("￥" + goods_price.toFixed(2));
                        }
                    });
                });
                return;
            }
            if (!validator.form() || validat > 0) {
                return false;
            }
            var sku_ids = new Array();
            var discount = new Array();
            var reduce = new Array();
            var set = new Array();
            var act_price_list = new Array();
            $(".limit_discount_sku").each(function() {
                var sku_id = $(this).data('sku_id');
                var goods_id = $(this).data('goods_id');
                var type = $(this).data('type');
                var val = parseFloat($(this).val());
                if (val >= 0) {
                    sku_ids.push(sku_id);
                    if (type == 'discount') {
                        discount.push(sku_id + '-' + val);
                    } else if (type == 'mark_down') {
                        reduce.push(sku_id + '-' + val);
                    } else {
                        set.push(sku_id + '-' + val);
                    }
                }
                var act_price = $("#act_price-" + sku_id).html();
                act_price_list.push(act_price.substr(1));
            });
            act_price_list.sort();
            var min = act_price_list.shift();
            var max = act_price_list.pop();
            var goods_id = $(this).data('goods_id');
            if (min == max) {
                $(".after-price-" + goods_id).html("￥" + min);
            } else {
                $(".after-price-" + goods_id).html("￥" + min + "-￥" + max);
            }
            $("." + goods_id + '-discount').val(discount.join());
            $("." + goods_id + '-reduce').val(reduce.join());
            $("." + goods_id + '-set').val(set.join());
            $.msg('设置成功', {
                time: 5000
            });
            $.closeAll();
        });
    })

            </script>
	<script type="text/javascript">
		$().ready(function () {
			/**
			 * 初始化validator默认值自定义错误提示位置
			 */
			var _errorPlacement = $.validator.defaults.errorPlacement;
			var _success = $.validator.defaults.success;
		})
	</script>
	</script>
	<script id="no_join_goods" type="text">
<div class="search-condition-table no_join_search m-b-10">
        <div class="search-condition-box">
            <select name='keyword_type'  class="form-control w150 m-l-2 m-r-2">
                <option value='1'>商品名称</option>
                <option value='2'>商品ID</option>
                <option value='3'>商品货号</option>
            </select>
            <input type="text" name="keyword" class="form-control w150 m-l-2 m-r-2" placeholder="关键字">
            <input type="text" name="goods_barcode" class="form-control w150 m-l-2 m-r-2" placeholder="商品条形码">
            <input type="button" class="btn btn-primary m-l-2 m-r-2 btn-search" value="搜索商品">
        </div>
        <div class="clear"></div>
     </div>
<div id="no_join_list" class="table-responsive m-t-10" style="max-height: 450px; overflow-y: auto;">
    <table id="selected_table_list_no_join" class="table table-hover m-b-0 w800 limit-discount-list">
        <thead>
            <tr>
                <th class="w50">
                    <input type="checkbox" />
                </th>
                <th class="w150">商品名称</th>
                <th class="w100 text-c">原价</th>
                <th class="handle w100">操作</th>
            </tr>
        </thead>
        <tbody id="goods_info_no_join">
        </tbody>
        <tfoot>
            <tr>
                <td class="w50">
                    <input type="checkbox" class="checkBox" />
                </td>
                <td colspan="4">
                    <input type="button" class="btn btn-default m-r-2 batchset-del" value="批量删除" />
                </td>
            </tr>
        </tfoot>
    </table>
</div>
<script type="text/javascript">
    var no_join_tablelist = null;
    $().ready(function() {
        $('#no_join_list').on('click','.checkBox',function(){
            $('#no_join_list').find('tbody').find('tr').removeClass('active')
        })
        $('.no_join_search').on('click','.btn-search',function(){
            var keyword_type = $('.no_join_search').find('select[name="keyword_type"]').val();
            var keyword = $('.no_join_search').find('input[name="keyword"]').val();
            var goods_barcode = $('.no_join_search').find('input[name="goods_barcode"]').val();
             $('#no_join_list').find('tbody').find('tr').removeClass('goods_info_search_selected');
            if(keyword !=''&& goods_barcode!='')
            {
                if(keyword_type ==1){
                    $('#no_join_list').find('tbody').find('tr[data-goods_name*="'+keyword+'"][data-goods_barcode*="'+goods_barcode+'"]').addClass('goods_info_search_selected');
                }else if(keyword_type ==2){
                    $('#no_join_list').find('tbody').find('tr[data-goods_id*="'+keyword+'"][data-goods_barcode*="'+goods_barcode+'"]').addClass('goods_info_search_selected');
                }else if(keyword_type==3){
                    $('#no_join_list').find('tbody').find('tr[data-goods_sn*="'+keyword+'"][data-goods_barcode*="'+goods_barcode+'"]').addClass('goods_info_search_selected');
                }
            }else if(keyword != '')
            {
                if(keyword_type ==1){
                    $('#no_join_list').find('tbody').find('tr[data-goods_name*="'+keyword+'"]').addClass('goods_info_search_selected');
                }else if(keyword_type ==2){
                    $('#no_join_list').find('tbody').find('tr[data-goods_id*="'+keyword+'"]').addClass('goods_info_search_selected');
                }else if(keyword_type==3){
                    $('#no_join_list').find('tbody').find('tr[data-goods_sn*="'+keyword+'"]').addClass('goods_info_search_selected');
                }
            }else if(goods_barcode != ''){
                $('#no_join_list').find('tbody').find('tr[data-goods_barcode*="'+goods_barcode+'"]').addClass('goods_info_search_selected');
            }
            var item=$("#no_join_list").find('.goods_info_search_selected').length;
            if(item >0){
                var item_top = $("#no_join_list").find('.goods_info_search_selected:first').offset().top
                var parent_top =$("#no_join_list").offset().top;
                var top = item_top - parent_top
                if(top > 0){
                    $("#no_join_list").animate({
                        scrollTop:top
                    }, 0);
                }
            }
        })
        $("[data-toggle='popover']").popover();
        no_join_tablelist = $("#no_join_list").find("#selected_table_list_no_join").tablelist();
        //删除商品
        $("body").off("click", ".del-no-join").on("click", ".del-no-join", function() {
            var target = $(this).parents("tr");
            var goods_id = $(this).data("goods_id");
            var sku_id = $(this).data("sku-id");
            var container = $(this).parents(".limit-discount-goods").find("#widget_goods_no_join");
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
        // 批量设置减价
        $("body").on("click", ".batchset-del", function() {
            var ids = no_join_tablelist.checkedValues();
            if (!ids) {
                $.msg("请选择要删除的商品！");
                return;
            }
            var container = $("#widget_goods_no_join");
            var goodspicker = $.goodspicker(container);
            for(j = 0,len=ids.length; j < len; j++) {
                var sku_id = $('.del-no-join[data-goods_id="'+ids[j]+'"]').data("sku-id");
                if (goodspicker) {
                    // 获取控件
                    goodspicker.remove(ids[j], sku_id);
                }
            }
            if (goodspicker) {
                var selected_number = goodspicker.goods_ids.length;
                if (selected_number == 0) {
                    $('#selected_table_list_no_join').remove();
                }
            }
            $('#selected_table_list_no_join').find('.table-list-checkbox:checked').parents('td').parents('tr').remove();
            return false;
        });
    })

            </script>
	</script>
	<style type="text/css">
		.limit-type .form-control-error {
			margin-top: 7px;
		}
	</style>
	<script type="text/javascript">
		$("[name='limit_type']:radio").change(function () {
			$(".limit-type").find(":text,:checkbox").prop("disabled", true);
			$(this).parents('label').parents('.limit-type-item').find(":text,:checkbox").prop("disabled", false).focus();
		});
		$("[name='limit_type']:radio").filter("[value='0']").prop("checked", true).change();
		//
	</script>
	<script id="client_rules" type="text">
[{"id": "limitdiscountmodel-act_name", "name": "LimitDiscountModel[act_name]", "attribute": "act_name", "rules": {"required":true,"messages":{"required":"活动名称不能为空。"}}},{"id": "limitdiscountmodel-start_time", "name": "LimitDiscountModel[start_time]", "attribute": "start_time", "rules": {"required":true,"messages":{"required":"活动有效期不能为空。"}}},{"id": "limitdiscountmodel-end_time", "name": "LimitDiscountModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"套餐结束时间不能为空。"}}},{"id": "limitdiscountmodel-sort", "name": "LimitDiscountModel[sort]", "attribute": "sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "limitdiscountmodel-purchase_num", "name": "LimitDiscountModel[purchase_num]", "attribute": "purchase_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"限购数量必须是整数。"}}},{"id": "limitdiscountmodel-shop_id", "name": "LimitDiscountModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "limitdiscountmodel-act_multistore_type", "name": "LimitDiscountModel[act_multistore_type]", "attribute": "act_multistore_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"参与门店必须是整数。"}}},{"id": "limitdiscountmodel-ext_info", "name": "LimitDiscountModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"扩展字段必须是一条字符串。"}}},{"id": "limitdiscountmodel-act_name", "name": "LimitDiscountModel[act_name]", "attribute": "act_name", "rules": {"string":true,"messages":{"string":"活动名称必须是一条字符串。","maxlength":"活动名称只能包含至多20个字符。"},"maxlength":20}},{"id": "limitdiscountmodel-act_label", "name": "LimitDiscountModel[act_label]", "attribute": "act_label", "rules": {"string":true,"messages":{"string":"活动标签必须是一条字符串。","minlength":"活动标签应该包含至少2个字符。","maxlength":"活动标签只能包含至多8个字符。"},"minlength":2,"maxlength":8}},{"id": "limitdiscountmodel-sort", "name": "LimitDiscountModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "limitdiscountmodel-act_stock", "name": "LimitDiscountModel[act_stock]", "attribute": "act_stock", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"活动库存必须是整数。","min":"活动库存必须不小于0。","max":"活动库存必须不大于999999。"},"min":0,"max":999999}},{"id": "limitdiscountmodel-start_time", "name": "LimitDiscountModel[start_time]", "attribute": "start_time", "rules": {"compare":{"operator":"<","type":"date","compareAttribute":"limitdiscountmodel-end_time","skipOnEmpty":1},"messages":{"compare":"开始时间不能大于结束时间"}}},{"id": "limitdiscountmodel-end_time", "name": "LimitDiscountModel[end_time]", "attribute": "end_time", "rules": {"compare":{"operator":">=","type":"date","compareAttribute":"limitdiscountmodel-start_time","skipOnEmpty":1},"messages":{"compare":"结束时间不能小于开始时间"}}},{"id": "limitdiscountmodel-act_discount", "name": "LimitDiscountModel[act_discount]", "attribute": "act_discount", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"折扣必须是一个数字。","decimal":"折扣必须是一个不大于2位小数的数字。","min":"折扣必须不小于0。","max":"折扣必须不大于10。"},"decimal":2,"min":0,"max":10}},{"id": "limitdiscountmodel-act_mark_down", "name": "LimitDiscountModel[act_mark_down]", "attribute": "act_mark_down", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"减价必须是一个数字。","decimal":"减价必须是一个不大于2位小数的数字。","min":"减价必须不小于0。","max":"减价必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "limitdiscountmodel-act_price", "name": "LimitDiscountModel[act_price]", "attribute": "act_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"指定价必须是一个数字。","decimal":"指定价必须是一个不大于2位小数的数字。","min":"指定价必须不小于0。","max":"指定价必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}}]

            </script>
	<script type="text/javascript">
		//
	</script>
	<!-- 商品选择器 -->
	<script type="text/javascript">
		//
	</script>
@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
	<script src="/assets/d2eace91/min/js/validate.min.js?v=2.1"></script>
	<script src="/assets/d2eace91/min/js/upload.min.js?v=2.1"></script>
	<script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=2.1"></script>
	<script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=2.1"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
	<script>
		$(".day-checked-box li").click(function () {
			var arr = new Array();
			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			} else {
				$(this).addClass('selected');
			}
			$(".day-checked-box li").each(function () {
				if ($(this).hasClass('selected')) {
					arr.push($(this).data('val'));
				}
			});
			$("#week").val(arr.join(','));
		});
		//周期重复选择
		$(".switch-on-off").on('switchChange.bootstrapSwitch', function (e, state) {
			if (!state) {
				$('.act_repeat_item').addClass('hide')
			} else {
				$('.act_repeat_item').removeClass('hide');
			}
		});
		$("body").on("change", ".month-day-select", function () {
			var days = [];
			var self = this;
			$(".month-day-select").each(function () {
				if (this != self) {
					days[$(this).val()] = true;
				}
			});
			var value = $(this).val();
			if (days[value]) {
				$.msg("日期【" + value + "】已被选择，请勿重复选择！");
				$(this).val("");
				return false;
			}
		});
		//添加日期
		$("#add_month").click(function () {
			if ($(".month_day").length < 5) {
				var html = $("#opentime_template").html();
				var element = $($.parseHTML(html));
				element.insertBefore($("#add_month"));
				checkLength();
			}
		});
		//移除月
		$("body").on("click", ".remove_month", function () {
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
			gallery: true,
			values: [''],
			callback: function (data) {
				$("#limitdiscountmodel-act_img").val(data.path);
			},
			remove: function (value, values) {
				$("#limitdiscountmodel-act_img").val('');
			}
		});
		//
		$().ready(function () {
			//悬浮显示上下步骤按钮
			window.onscroll = function () {
				$(window).scroll(function () {
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
			var validator = $("#LimitDiscountModel").validate();
			// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
			$.validator.addRules($("#client_rules").html());
			$("#btn_submit").click(function () {
				if (!validator.form()) {
					return;
				}
				var use_range = $('input[name="LimitDiscountModel[use_range]"]:checked').val();
				//如果不是指定商品 验证是否填写价格和库存
				if (use_range != 1) {
					var act_price_type = $('input[name="LimitDiscountModel[act_price_type]"]:checked').val();
					if (act_price_type == 0) {
						var act_discount = $('#limitdiscountmodel-act_discount').val();
						if (act_discount == '') {
							$.msg('折扣不能为空');
							return false;
						}
					} else if (act_price_type == 1) {
						var act_mark_down = $('#limitdiscountmodel-act_mark_down').val();
						if (act_mark_down == '') {
							$.msg('减价不能为空');
							return false;
						}
					} else if (act_price_type == 2) {
						var act_price = $('#limitdiscountmodel-act_price').val();
						if (act_price == '') {
							$.msg('指定价不能为空');
							return false;
						}
					}
					var act_stock = $('#limitdiscountmodel-act_stock').val();
					if (act_stock == '') {
						$.msg('活动库存不能为空');
						return false;
					}
				}
				var limit_type = $('input[name="limit_type"]:checked').val();
				if (limit_type == 1) {
					var limit_num = $('input[name="limit_num_1"]').val();
					if (limit_num <= 0) {
						$.msg('请设置每人每种商品限购数量！');
						return false;
					}
				}
				/**
				 if (!validator.form()) {
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
            }
				 **/
				var target = $(this);
				$(target).addClass("disabled");
				var url = null;
				var data = $("#LimitDiscountModel").serializeJson();
				var msg = null;
				if ("" == "") {
					url = '/dashboard/limit-discount/add';
					msg = '您确定添加限时折扣商品吗？当前操作可能会花费很长时间而且请勿中断！';
				} else {
					url = '/dashboard/limit-discount/edit?id=&is_copy=';
					if ("" == "1") {
						msg = '您确定复制限时折扣商品吗？当前操作可能会花费很长时间而且请勿中断！';
					} else {
						msg = '您确定编辑限时折扣商品吗？当前操作可能会花费很长时间而且请勿中断！';
					}
				}
				// 转换为JSON字符串
				// data = JSON.stringify($("#LimitDiscountModel").serializeJson());
				//console.log($("#LimitDiscountModel").serializeJson())
				//$(target).removeClass("disabled");
				//return;
				/* $.loading.start();
                $.ajax({
                    url: url,
                    data: data,
                    type: "POST",
                    contentType: "application/json",
                    dataType: "JSON",
                    success: function(result) {
                        // 停止加载
                        $.loading.stop();
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            }, function() {
                                $.go('/dashboard/limit-discount/list');
                            });
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                            $(target).removeClass("disabled");
                        }
                    }
                }); */
				$.confirm(msg, function () {
					$.progress({
						url: url,
						type: 'POST',
						ajaxContentType: "application/json",
						dataType: "JSON",
						data: data,
						key: 'seller-batch-add-limit-discount',
						endClose: false,
						start: function () {
							$(target).removeClass("disabled");
						},
						end: function (result) {
							if (result.code == 0) {
								$.msg(result.message, {
									time: 3000
								}, function () {
									$.go('/dashboard/limit-discount/list');
								});
							} else {
								$.msg(result.message, {
									time: 3000
								}, function () {
									$(target).removeClass("disabled");
								});
							}
						}
					});
				}, function () {
					$(target).removeClass("disabled");
				});
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
			}).on('changeDate', function (ev) {
				$(this).trigger("blur");
			});
		})
		//
		$(function () {
			var values = [];
			var no_join = [];
			// 商品选择器加载以选择的商品数据
			$("body").find(".limit-discount-list").find("#goods_info").find("tr").each(function () {
				var goods_id = $(this).data("limit-discount-goods-id");
				var sku_id = 0;
				values[goods_id] = {
					goods_id: goods_id,
					sku_id: sku_id,
				};
			});
			$("body").find(".limit-discount-list").find("#goods_info_no_join").find("tr").each(function () {
				var goods_id = $(this).data("limit-discount-goods-id");
				var sku_id = 0;
				no_join[goods_id] = {
					goods_id: goods_id,
					sku_id: sku_id,
				};
			});
			// 商品选择器
			var goodspicker = null;
			var goodspicker_no_join = null;

			// 批量加载商品信息
			function loadGoodsInfos(goods_ids) {
				$.loading.start();
				return $.ajax({
					type: "POST",
					url: "batch-goods-info",
					dataType: "json",
					data: {
						act_id: "",
						goods_ids: goods_ids,
					},
					success: function (result) {
						if (result.code == 0) {
							$('#goods_info').prepend(result.data);
							// 库存不足的商品
							if ($.isArray(result.unstock_goods_ids) && result.unstock_goods_ids.length > 0) {
								for (var i = 0; i < result.unstock_goods_ids.length; i++) {
									goodspicker.remove(result.unstock_goods_ids[i]);
								}
								$.msg("商品[" + result.unstock_goods_ids.join(",") + "]库存不足，已取消选择！", {
									time: 3000
								});
							}
						} else {
							if ($.isArray(goods_ids)) {
								for (var i = 0; i < goods_ids; i++) {
									goodspicker.remove(goods_ids[i]);
								}
							}
							$.msg(result.message, {
								time: 3000
							})
						}
					}
				}).always(function () {
					$.loading.stop();
				});
			}

			// 批量加载商品信息
			function loadGoodsInfosNoJoin(goods_ids) {
				$.loading.start();
				return $.ajax({
					type: "POST",
					url: "batch-goods-info",
					dataType: "json",
					data: {
						act_id: "",
						goods_ids: goods_ids,
						is_join: 0
					},
					success: function (result) {
						if (result.code == 0) {
							$('#goods_info_no_join').prepend(result.data);
							// 库存不足的商品
							if ($.isArray(result.unstock_goods_ids) && result.unstock_goods_ids.length > 0) {
								for (var i = 0; i < result.unstock_goods_ids.length; i++) {
									goodspicker.remove(result.unstock_goods_ids[i]);
								}
								$.msg("商品[" + result.unstock_goods_ids.join(",") + "]库存不足，已取消选择！", {
									time: 3000
								});
							}
						} else {
							if ($.isArray(goods_ids)) {
								for (var i = 0; i < goods_ids; i++) {
									goodspicker.remove(goods_ids[i]);
								}
							}
							$.msg(result.message, {
								time: 3000
							})
						}
					}
				}).always(function () {
					$.loading.stop();
				});
			}

			/*
            * fn [function] 需要防抖的函数
            * delay [number] 毫秒，防抖期限值
            */
			function debounce(fn, delay) {
				//借助闭包
				let timer = null;
				return function () {
					if (timer) {
						//进入该分支语句，说明当前正在一个计时过程中，并且又触发了相同事件。所以要取消当前的计时，重新开始计时
						clearTimeout(timer);
						timer = setTimeout(fn, delay);
					} else {
						// 进入该分支说明当前并没有在计时，那么就开始一个计时
						timer = setTimeout(fn, delay);
					}
				}
			}

			// 商品信息队列
			var goods_ids_queue = [];
			var doing = false;
			var no_join_goods_ids_queue = [];
			var no_join_doing = false;

			// 执行队列
			function executeQueue(token) {
				if (doing && !token) {
					return;
				}
				doing = true;
				if (goods_ids_queue.length == 0) {
					doing = false;
					return;
				}
				var goods_ids = [];
				while (goods_ids_queue.length > 0 && goods_ids.length < 100) {
					goods_ids.push(goods_ids_queue.shift());
				}
				var result = loadGoodsInfos(goods_ids);
				if (result !== false) {
					result.always(function () {
						executeQueue(true);
					});
				}
			}

			function executeQueueNoJoin(token) {
				if (no_join_doing && !token) {
					return;
				}
				no_join_doing = true;
				if (no_join_goods_ids_queue.length == 0) {
					no_join_doing = false;
					return;
				}
				var goods_ids = [];
				while (no_join_goods_ids_queue.length > 0 && goods_ids.length < 100) {
					goods_ids.push(no_join_goods_ids_queue.shift());
				}
				var result = loadGoodsInfosNoJoin(goods_ids);
				if (result !== false) {
					result.always(function () {
						executeQueueNoJoin(true);
					});
				}
			}

			function reloadGoodsPicker() {
				if (goodspicker == null) {
					// 初始化组件，为容器绑定组件
					goodspicker = $("#widget_goods").goodspicker({
						url: '/dashboard/limit-discount/picker?act_id=',
						// 组件ajax提交的数据，主要设置分页的相关设置
						data: {
							page: {
								// 分页唯一标识
								// page_id: page_id
							},
							//act_id: $('#goodsmixmodel-act_id').val(),
							is_sku: 0,
							is_excel: 1
							// 不能将自己作为赠品
							//except_sku_ids: sku_id
						},
						// 已加载的数据
						values: values,
						// 选择商品和未选择商品的按钮单击事件
						// @param selected 点击是否选中
						// @param sku 选中的SKU对象
						// @return 返回false代表
						click: function (selected, sku) {
							if (selected == true) {
								// 初始化模板
								if (this.goods_ids.length == 1) {
									$("#goods_list").html($("#goods").html());
									$('#goods_info').html('');
								}
								goods_ids_queue.push(sku.goods_id);
							} else {
								$("body").find('#selected_table_list').find("[data-limit-discount-goods-id='" + sku.goods_id + "']").remove();
								if (this.goods_ids.length == 0) {
									$('#selected_table_list').find(".limit-discount-list").remove();
								}
							}
							debounce(executeQueue, 200)();
						},
						uploadExcelCallback: function (data, selects) {
							var goods_ids = [];
							var sku_ids = [];
							var values = [];
							if (selects != '') {
								selects = selects.split(",");
							} else {
								selects = [];
							}
							for (key in selects) {
								var datas = selects[key].split("-");
								goods_ids.push(datas[0]);
								sku_ids.push(datas[1]);
								values[datas[0]] = {
									goods_id: datas[0],
									sku_id: datas[1]
								}
							}
							this.goods_ids = goods_ids;
							this.sku_ids = sku_ids;
							this.values = values;
							$('#widget_goods').find(".selected_number").html(this.goods_ids.length);
							$("#goods_list").html($("#goods").html());
							$('#goods_info').html(data);
						}
					});
				}
			}

			function reloadNoJoinGoodsPicker() {
				if (goodspicker_no_join == null) {
					// 初始化组件，为容器绑定组件
					goodspicker_no_join = $("#widget_goods_no_join").goodspicker({
						url: '/dashboard/limit-discount/picker?act_id=',
						// 组件ajax提交的数据，主要设置分页的相关设置
						data: {
							page: {
								// 分页唯一标识
								// page_id: page_id
							},
							//act_id: $('#goodsmixmodel-act_id').val(),
							is_sku: 0,
							is_join: 0,
							is_excel: 1
							// 不能将自己作为赠品
							//except_sku_ids: sku_id
						},
						// 已加载的数据
						values: no_join,
						// 选择商品和未选择商品的按钮单击事件
						// @param selected 点击是否选中
						// @param sku 选中的SKU对象
						// @return 返回false代表
						click: function (selected, sku) {
							if (selected == true) {
								// 初始化模板
								if (this.goods_ids.length == 1) {
									$("#no_join_goods_list").html($("#no_join_goods").html());
									$('#goods_info_no_join').html('');
								}
								no_join_goods_ids_queue.push(sku.goods_id);
							} else {
								$("body").find('#selected_table_list_no_join').find("[data-limit-discount-goods-id='" + sku.goods_id + "']").remove();
								if (this.goods_ids.length == 0) {
									$('#selected_table_list_no_join').find(".limit-discount-list").remove();
								}
							}
							debounce(executeQueueNoJoin, 200)();
						},
						uploadExcelCallback: function (data, selects) {
							var goods_ids = [];
							var sku_ids = [];
							var values = [];
							if (selects != '') {
								selects = selects.split(",");
							} else {
								selects = [];
							}
							for (key in selects) {
								var datas = selects[key].split("-");
								goods_ids.push(datas[0]);
								sku_ids.push(datas[1]);
								values[datas[0]] = {
									goods_id: datas[0],
									sku_id: datas[1]
								}
							}
							this.goods_ids = goods_ids;
							this.sku_ids = sku_ids;
							this.values = values;
							$('#widget_goods_no_join').find(".selected_number").html(this.goods_ids.length);
							$("#no_join_goods_list").html($("#no_join_goods").html());
							$('#goods_info_no_join').html(data);
						}
					});
				}
			}

			//商品选择
			$('input[name="LimitDiscountModel[use_range]"]').click(function () {
				var use_range = $(this).val();
				if (use_range == 0) {
					$('.act_price_type_div').removeClass('hide');
					$('.act_stock_div').removeClass('hide');
					$('.act_goods_div').addClass('hide');
					$('.act_goods_no_join_div').addClass('hide');
				} else if (use_range == 2) {
					$('.act_price_type_div').removeClass('hide');
					$('.act_stock_div').removeClass('hide');
					$('.act_goods_div').addClass('hide');
					$('.act_goods_no_join_div').addClass('hide');
				} else if (use_range == 1) {
					$('.act_price_type_div').addClass('hide');
					$('.act_stock_div').addClass('hide');
					$('.act_goods_div').removeClass('hide');
					$('.act_goods_no_join_div').addClass('hide');
					reloadGoodsPicker();
				} else if (use_range == 3) {
					$('.act_price_type_div').removeClass('hide');
					$('.act_stock_div').removeClass('hide');
					$('.act_goods_div').addClass('hide');
					$('.act_goods_no_join_div').removeClass('hide');
					reloadNoJoinGoodsPicker();
				}
			})
			//折扣价设置
			$('input[name="LimitDiscountModel[act_price_type]"]').click(function () {
				var act_price_type = $(this).val();
				if (act_price_type == 0) {
					$('.act_discount_div').removeClass('hide').siblings('.act_price_type_text').addClass('hide').find('input').attr('disabled', true);
					$('.act_discount_div').find('input').attr('disabled', false);
				} else if (act_price_type == 1) {
					$('.act_mark_down_div').removeClass('hide').siblings('.act_price_type_text').addClass('hide').find('input').attr('disabled', true);
					$('.act_mark_down_div').find('input').attr('disabled', false);
				} else if (act_price_type == 2) {
					$('.act_price_div').removeClass('hide').siblings('.act_price_type_text').addClass('hide').find('input').attr('disabled', true);
					$('.act_price_div').find('input').attr('disabled', false);
				}
			})
			//门店选择
			$('input[name="LimitDiscountModel[act_multistore_type]"]').click(function () {
				var act_multistore_type = $(this).val();
				if (act_multistore_type == 0) {
					//隐藏指定门店
					$("#select_store").hide();
					//隐藏分组
					$("#select_group").hide();
				} else if (act_multistore_type == 1) {
					//显示指定分组
					$("#select_group").show();
					//显示指定门店
					$("#select_store").hide();
					$.open({
						title: "选择分组",
						type: 1,
						content: $(".group_container").html(),
						area: ['500px', '300px'],
						fix: false, //不固定
						scrollbar: false,
						maxmin: false,
						btn: ['确认', '取消'],
						yes: function (index, obj) {
							dataCollect(obj, 1);
							content = '';
							group_ids = [];
							for (var id in data_collect_group) {
								collect = data_collect_group[id];
								group_id = collect['id'];
								group_name = collect['name'];
								group_ids.push(group_id);
								// 页面展示的内容
								content += '<a id="group_div_' + group_id + '" class="ss-item" data-id="' + group_id + '" data-type=1>' + group_name + '<i title="移除">×</i></a>';
							}
							group_ids_string = group_ids.join(',');
							$("#group_ids").val(group_ids_string);
							if (content == '') {
								$.msg('请选择分组');
								return false;
							}
							$("#select_group").html(content);
							$.closeAll();
						}
					})
				} else if (act_multistore_type == 2) {
					//显示指定分组
					$("#select_group").hide();
					//显示指定门店
					$("#select_store").show();
					$.open({
						title: "选择门店",
						type: 1,
						area: ['800px', '500px'],
						btn: ['确认', '取消'],
						ajax: {
							url: '/dashboard/multi-store/list',
							type: 'get',
							data: {
								store_ids: $("#store_ids").val(),
								type: 1,
								out_put: 1,
								uuid: 'store_list'
							}
						},
						yes: function (index, obj) {
							dataCollect(obj, 2);
							content = '';
							store_ids = [];
							for (var id in data_collect_store) {
								collect = data_collect_store[id];
								store_id = collect['id'];
								store_name = collect['name'];
								//store_ids.push(store_id);
								// 页面展示的内容
								content += '<a id="store_div_' + store_id + '" class="ss-item" data-id="' + store_id + '" data-type=2>' + store_name + '<i title="移除">×</i></a>';
							}
							//store_ids_string=store_ids.join(',');
							//$("#store_ids").val(store_ids_string);
							if (content == '') {
								$.msg('请选择门店');
								return false;
							}
							$("#select_store").html(content);
							$.closeAll();
						}
					}).always(function () {
						$.loading.stop();
					});
				}
			})
			var data_collect_group = [];
			var data_collect_store = [];

			function dataCollect(obj, type) {
				if (type == 1) {
					obj_ = $(obj).find("[name=group_id]:checkbox");
				}
				if (type == 2) {
					obj_ = $(obj).find(".storeCheckBox");
				}
				obj_.each(function () {
					var self = $(this);
					var is_checked = self.prop('checked');
					// 当前的分组id
					var id = self.val();
					if (is_checked) {
						// 勾选
						var name = self.data('name');
						if (type == 1) {
							data_collect_group[id] = {
								id: id,
								name: name,
							};
						} else {
							data_collect_store[id] = {
								id: id,
								name: name,
							};
						}
					} else {
						// 取消勾选
						if (type == 1) {
							delete data_collect_group[id];
						} else {
							delete data_collect_store[id];
						}
					}
				});
			}

			//勾选全部分组
			$("body").on("click", ".allCheckGroup", function () {
				$("[name=group_id]:checkbox").prop("checked", this.checked);
			});
			//勾选单个分组
			$("body").on("click", "[name=group_id]:checkbox", function () {
				var flag = true;
				$("[name=group_id]:checkbox").each(function () {
					if (!this.checked) {
						flag = false;
					}
				});
				$(".allCheckGroup").prop("checked", flag);
			});
			//删除分组或门店1分组 2门店
			$("body").on("click", ".ss-item", function () {
				var type = $(this).data('type');
				if (type == 1) {
					obj_ids = $("#group_ids");
				} else {
					obj_ids = $("#store_ids");
				}
				//处理ids
				var ids_string = obj_ids.val();
				var id = $(this).data('id');
				ids_string = ',' + ids_string + ',';
				ids_string = ids_string.replace(',' + id + ',', ',');
				ids_string = ids_string.substr(1, ids_string.length - 2);
				obj_ids.val(ids_string);
				//处理按钮内容
				if (type == 1) {
					$("#group_div_" + id).remove();
				} else {
					$("#store_div_" + id).remove();
				}
			});
		});
		//
		$().ready(function () {
			$(".seller-nav-list").mCustomScrollbar();
			$(".left-menu-box").mCustomScrollbar();
			$(".totop").click(function () {
				$("html, body").animate({
					scrollTop: 0
				}, 600);
				return false;
			});
		});
		//
		// 返回顶部js
		$(window).scroll(function () {
			var position = $(window).scrollTop();
			if (position > 0) {
				$('.totop').removeClass('bounceOut').addClass('animated bounceIn');
			} else {
				$('.totop').removeClass('bounceIn').addClass('animated bounceOut');
			}
		});
		//
		/*在线帮助客服*/
		$('.udesk-icon-con').click(function () {
			$('.udesk-container').removeClass('hide');
		});
		$('.udesk-close').click(function () {
			$('.udesk-container').addClass('hide');
		});

		function toFirst(target) {
			var url = $(target).parents("li").find(".left-menu").find("li:first").find("a").attr("href");
			$.go(url);
		}

		function to(url, target) {
		}

		function clearCache() {
			// 缓载
			$.loading.start();
			$.post("/site/clear-cache", {}, function (result) {
				if (result.code == 0) {
					$.msg(result.message);
				} else {
					$.msg(result.message, {
						time: 5000
					});
				}
			}).always(function () {
				$.loading.stop();
			});
		}

		// 登录成功关闭弹出框
		$.login.success = function () {
			// 关闭并销毁登录窗口
			$.login.close(true);
		}
		//
		// setInterval("auto_print()",10000);
		function auto_print(order_id) {
			if ($.isFunction($.autoPrint)) {
				$.autoPrint(order_id, "shop_1717");
			} else {
				$.ajax({
					type: "GET",
					url: "/site/auto-print",
					dataType: "json",
					data: {
						order_id: order_id
					},
					success: function (result) {
						if (result.code == 0) {
							lodop_print_html(result.print_title, result.data, result.printer, {
								width: result.print_spec_width,
								height: result.print_spec_height
							});
						}
					}
				});
			}
		}

		//
		$(function () {
			//声音监听
			WS_AddUser({
				'user_id': 'shop_{{ $shop->shop_id ?? 0 }}',
				'url': "{{ get_ws_url('4431') }}",
				'type': "add_user"
			});
		})

		//右下角消息提醒弹窗js
		function open_message_box(data) {
			if (!data) {
				data = {};
			}
			var src = window.location.href;
			// 如果当前框架中的链接地址和弹框的链接地址一致则不弹框
			if (data.auto_refresh == 1 && data.link && src.indexOf(data.link) != -1) {
				var contentWindow = window;
				if (contentWindow.tablelist) {
					contentWindow.tablelist.load({
						page: {
							cur_page: 1
						}
					});
				} else {
					contentWindow.location.reload();
				}
				return;
			}
			$('.message-pop-box').find('#message-pop-text').html(data.content);
			if (data.link) {
				$('.message-pop-box').find('.message-btn').attr('href', data.link).show();
			} else {
				$('.message-pop-box').find('.message-btn').hide();
			}
			if (data.content || data.link) {
				$('.message-pop-box').removeClass('down').addClass('up');
			}
			try {
				if (refresh_order && typeof (refresh_order) == "function") {
					refresh_order();
				}
			} catch (e) {
			}
		}

		$('.message-pop-box .close').click(function () {
			$('.message-pop-box').removeClass('up').addClass('down');
		});
		$('.message-btn').click(function () {
			$('.message-pop-box').removeClass('up').addClass('down');
		});
		//用户信息
		$(".admin").mouseenter(function () {
			window.focus();
			$("#admin-panel").show();
		}).mouseleave(function () {
			$("#admin-panel").hide();
		});
		//
		var clipboard = new Clipboard('.btn-copy');
		clipboard.on('success', function (e) {
			$.msg('复制成功');
		});
		clipboard.on('error', function (e) {
			$.msg('复制失败');
		});

		// 更新后台主框架消息弹窗
		function update_message() {
			// 是否重新获取数据
			if ($("#message-panel").html().length > 0) {
				// if (parseInt($("#counts_all").val()) != 0) {
				var time_step = 5; // 最小刷新间隔，单位：秒
				var this_time = new Date();
				if ((parseInt($("#counts_time").val()) + parseInt(time_step)) > parseInt(this_time.getTime() / 1000)) {
					return true;
				}
				// }
			}
			$.ajax({
				type: 'GET',
				url: '/site/update-message.html',
				data: {},
				dataType: 'json',
				success: function (result) {
					if (result.code == 0) {
						$("#message-panel").html(result.data);
					} else if (result.code == 1) {
					} else {
						$.msg(result.message);
					}
				}
			});
		}

		// 消息通知
		$("#message-box .notice-nav-message").click(function () {
			update_message();
			window.focus();
			$(".noticePanel").show();
		});
		$("#notice-close").click(function () {
			$(".noticePanel").hide();
		});
		$(function () {
			$("#btn_edit_password").click(function () {
				$.open({
					title: "修改密码",
					width: 450,
					ajax: {
						url: '/shop/account/edit-password',
					}
				});
			});
		});
		//
	</script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
