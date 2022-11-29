<div class="row">
    <div class="col-sm-3 b-r">
        <div class="form-group {{ $errors->has('from_branch_id') ? 'has-error' : '' }}">
            <label><strong>SENDER BRANCH</strong></label>
            {!! Form::select('from_branch_id',$branches_list,null,[
            'class' => 'select2_demo_1 form-control',
            'id'    => 'from_branch_id',
            'placeholder'=>'Select Sender Branch'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('from_branch_id') ? "".$errors->first('from_branch_id')."" : '' }} </font>
            </span>
        </div>
        <div class="form-group {{ $errors->has('to_branch_id') ? 'has-error' : '' }}">
            <label><strong>RECEIVER BRANCH</strong></label>
            {!! Form::select('to_branch_id',$branches_list,null,[
            'class' => 'select2_demo_2 form-control',
            'id'    => 'to_branch_id',
            'placeholder'=>'Select Receiver Branch'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('to_branch_id') ? "".$errors->first('to_branch_id')."" : '' }} </font>
            </span>
        </div>
    </div>
    <div class="col-sm-3 b-r">
        <div class="form-group {{ $errors->has('from_current_balance') ? 'has-error' : '' }}">
            <label><strong>CURRENT BALANCE</strong></label>
            {!! Form::text('from_current_balance',null,[
            'class' => 'form-control',
            'id'    => 'from_current_balance',
            'readonly',
            'placeholder' => 'Enter Current Balance'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('from_current_balance') ? "".$errors->first('from_current_balance')."" : '' }} </font>
            </span>
        </div>
        <div class="form-group {{ $errors->has('to_current_balance') ? 'has-error' : '' }}">
            <label><strong>CURRENT BALANCE</strong></label>
            {!! Form::text('to_current_balance',null,[
            'class' => 'form-control',
            'id'    => 'to_current_balance',
            'readonly',
            'placeholder' => 'Enter Current Balance'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('to_current_balance') ? "".$errors->first('to_current_balance')."" : '' }} </font>
            </span>
        </div>
    </div>
    <div class="col-sm-3 b-r">
        <div class="form-group {{ $errors->has('from_total_balance') ? 'has-error' : '' }}">
            <label><strong>TOTAL BALANCE</strong></label>
            {!! Form::text('from_total_balance',null,[
            'class' => 'form-control',
            'id'    => 'from_total_balance',
            'readonly',
            'placeholder' => 'Enter Total Balance'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('from_total_balance') ? "".$errors->first('from_total_balance')."" : '' }} </font>
            </span>
        </div>
        <div class="form-group {{ $errors->has('to_total_balance') ? 'has-error' : '' }}">
            <label><strong>TOTAL BALANCE</strong></label>
            {!! Form::text('to_total_balance',null,[
            'class' => 'form-control',
            'id'    => 'to_total_balance',
            'readonly',
            'placeholder' => 'Enter Total Balance'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('to_total_balance') ? "".$errors->first('to_total_balance')."" : '' }} </font>
            </span>
        </div>
    </div>
    <div class="col-sm-3 b-r">
        <div class="form-group {{ $errors->has('from_closing_balance') ? 'has-error' : '' }}">
            <label><strong>CLOSING BALANCE</strong></label>
            {!! Form::text('from_closing_balance',null,[
            'class' => 'form-control',
            'id'    => 'from_closing_balance',
            'readonly',
            'placeholder' => 'Enter Closing Balance'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('from_closing_balance') ? "".$errors->first('from_closing_balance')."" : '' }} </font>
            </span>
        </div>
        <div class="form-group {{ $errors->has('to_closing_balance') ? 'has-error' : '' }}">
            <label><strong>CLOSING BALANCE</strong></label>
            {!! Form::text('to_closing_balance',null,[
            'class' => 'form-control',
            'id'    => 'to_closing_balance',
            'readonly',
            'placeholder' => 'Enter Closing Balance'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('to_closing_balance') ? "".$errors->first('to_closing_balance')."" : '' }} </font>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3 b-r">
        <div class="form-group {{ $errors->has('from_commission') ? 'has-error' : '' }}">
            <label><strong>SENDER AMOUNT</strong></label>
            {!! Form::text('from_commission',null,[
            'class' => 'form-control',
            'id'    => 'from_commission',
            'autocomplete' => 'off',
            'placeholder' => 'Enter Sender Amount'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('from_commission') ? "".$errors->first('from_commission')."" : '' }} </font>
            </span>
        </div>
    </div>
    <div class="col-sm-3 b-r">
        <div class="form-group {{ $errors->has('to_commission') ? 'has-error' : '' }}">
            <label><strong>RECEIVER AMOUNT</strong></label>
            {!! Form::text('to_commission',null,[
            'class' => 'form-control',
            'id'    => 'to_commission',
            'autocomplete' => 'off',
            'placeholder' => 'Enter Receiver Amount'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('to_commission') ? "".$errors->first('to_commission')."" : '' }} </font>
            </span>
        </div>
    </div>
    <div class="col-sm-3 b-r">
        <div class="form-group {{ $errors->has('profit') ? 'has-error' : '' }}">
            <label><strong>OUR VATAV</strong></label>
            {!! Form::text('profit',null,[
            'class' => 'form-control',
            'id'    => 'profit',
            'readonly',
            'placeholder' => 'Enter Our Vatav'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('profit') ? "".$errors->first('profit')."" : '' }} </font>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3 b-r">
        <div class="form-group {{ $errors->has('sender_commission') ? 'has-error' : '' }}">
            <label><strong>SENDER COMMISSION</strong></label>
            {!! Form::text('sender_commission',null,[
            'class' => 'form-control',
            'id'    => 'sender_commission',
            'autocomplete' => 'off',
            'placeholder' => 'Enter Sender Commission'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('sender_commission') ? "".$errors->first('sender_commission')."" : '' }} </font>
            </span>
        </div>
    </div>
    <div class="col-sm-3 b-r">
        <div class="form-group {{ $errors->has('receiving_commission') ? 'has-error' : '' }}">
            <label><strong>RECEIVING COMMISSION</strong></label>
            {!! Form::text('receiving_commission',null,[
            'class' => 'form-control',
            'id'    => 'receiving_commission',
            'autocomplete' => 'off',
            'placeholder' => 'Enter Receiver Commission'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('receiving_commission') ? "".$errors->first('receiving_commission')."" : '' }} </font>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 b-r">
        <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
            <label><strong>REMARKS</strong></label>
            {!! Form::text('remarks',null,[
            'class' => 'form-control',
            'id'    => 'remarks',
            'autocomplete' => 'off',
            'placeholder' => 'Enter Remarks'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('remarks') ? "".$errors->first('remarks')."" : '' }} </font>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 b-r">
        <div class="form-group {{ $errors->has('sender_name') ? 'has-error' : '' }}">
            <label><strong>SENDER NAME</strong></label>
            {!! Form::text('sender_name',null,[
            'class' => 'form-control',
            'id'    => 'sender_name',
            'autocomplete' => 'off',
            'placeholder' => 'Enter Sender Name'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('sender_name') ? "".$errors->first('sender_name')."" : '' }} </font>
            </span>
        </div>
    </div>
    <div class="col-sm-6 b-r">
        <div class="form-group {{ $errors->has('sender_contact') ? 'has-error' : '' }}">
            <label><strong>SENDER CONTACT</strong></label>
            {!! Form::number('sender_contact',null,[
            'class' => 'form-control',
            'id'    => 'sender_contact',
            'autocomplete' => 'off',
            'placeholder' => 'Enter Sender Contact'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('sender_contact') ? "".$errors->first('sender_contact')."" : '' }} </font>
            </span>
        </div>
    </div>
    <div class="col-sm-6 b-r">
        <div class="form-group {{ $errors->has('receiver_name') ? 'has-error' : '' }}">
            <label><strong>RECEIVER NAME</strong></label>
            {!! Form::text('receiver_name',null,[
            'class' => 'form-control',
            'id'    => 'receiver_name',
            'autocomplete' => 'off',
            'placeholder' => 'Enter Receiver Name'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('receiver_name') ? "".$errors->first('receiver_name')."" : '' }} </font>
            </span>
        </div>
    </div>
    <div class="col-sm-6 b-r">
        <div class="form-group {{ $errors->has('receiver_contact') ? 'has-error' : '' }}">
            <label><strong>RECEIVER CONTACT</strong></label>
            {!! Form::number('receiver_contact',null,[
            'class' => 'form-control',
            'id'    => 'receiver_contact',
            'autocomplete' => 'off',
            'placeholder' => 'Enter Receiver Contact'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('receiver_contact') ? "".$errors->first('receiver_contact')."" : '' }} </font>
            </span>
        </div>
    </div>
</div>
<input type="hidden" name="sending_commsion" id="sending_commsion">
<input type="hidden" name="receving_commsion" id="receving_commsion">
@section('styles')
@endsection
@section('scripts')
<script>
    let _range = [
        {from : 1,    to : 50000},
        {from : 50001, to : 60000},
        {from : 60001, to : 70000},
        {from : 70001, to : 80000},
        {from : 80001, to : 90000},
        {from : 90001, to : 100000},
    ];

    function between(x, min, max) {
        return x >= min && x <= max;
    }
    

    function range_is(value, range)
    {
        let return_range = null;
        $.each(_range, function(index,obj){
            if (between(value, obj.from, obj.to)) {
                return_range = obj;
            }
        });  
        return return_range;  
    }
    $(".select2_demo_1").select2({
        placeholder: "Select Sender Branch",
        allowClear: true
    });
    $(".select2_demo_2").select2({
        placeholder: "Select Receiver Branch",
        allowClear: true
    });
    $(document).ready(function() {
        $('#from_branch_id').on('change', function() {
            var from_branch_id = $(this).val();
            var to_branch_id = $("#to_branch_id").val();
            var droup_down_id = "sender";
            $.ajax({
                url:"{{ route('admin.transactions.get_form_user') }}",
                type: "POST",
                data: {
                    from_branch_id: from_branch_id,
                    to_branch_id: to_branch_id,
                    droup_down_id: droup_down_id,
                    _token: '{{csrf_token()}}'
                },
                dataType : 'json',
                success: function(result){
                    $('#from_current_balance').val(result.data);
                    $('#sending_commsion').val(result.rang);
                    $('#sender_commission').val(0);
                    $('#from_commission').val(0);
                    $('#to_commission').val(0);
                }
            });
        });

        $('#to_branch_id').on('change', function() {
            var to_branch_id = this.value;
            var from_branch_id = $("#from_branch_id").val();
            var droup_down_id = "recever"; 
            $.ajax({
                url:"{{ route('admin.transactions.get_form_user') }}",
                type: "POST",
                data: {
                    to_branch_id: to_branch_id,
                    from_branch_id: from_branch_id,
                    droup_down_id: droup_down_id,
                    _token: '{{csrf_token()}}'
                },
                dataType : 'json',
                success: function(result){
                    $('#to_current_balance').val(result.data);
                    $('#receving_commsion').val(result.rang);
                    $('#receiving_commission').val(0);
                    $('#from_commission').val(0);
                    $('#to_commission').val(0);
                }
            });
        });
        $('#from_commission').blur(function() {
            let from_commssion = this.value;
            let fromAmount = (this.value / 1000).toFixed(3) || 0;
            $(this).val(fromAmount);
            let s_commission = range_is(from_commssion,_range);
            let ss_commission = (s_commission.to / 1000);
            let ddd = $('#sending_commsion').val();
            let dddd = ss_commission / ddd;
            $('#sender_commission').val(dddd.toFixed(2));
            var ssum = parseFloat(from_commssion) + parseFloat(dddd);
            let jk = $('#to_total_balance').val() || 0;
            let temp = fromAmount - jk;
            $('#profit').val(temp.toFixed(2));
            $('#from_total_balance').val(ssum.toFixed(2));
            let from_current_balance = $('#from_current_balance').val();
            let form_total_balance = $('#from_total_balance').val();
            let from_closing_balance = parseFloat(from_current_balance) + parseFloat(form_total_balance);
            $('#from_closing_balance').val(from_closing_balance.toFixed(2));
        });
        $('#to_commission').blur(function() {
            let to_commssion = this.value;
            let toAmount = (this.value / 1000).toFixed(3) || 0;
            $(this).val(toAmount);
            
            let r_commission = range_is(to_commssion,_range);
            let rr_commission = (r_commission.to / 1000);
            let sss = $('#receving_commsion').val();
            let ssss = rr_commission / sss;
            $('#receiving_commission').val(ssss.toFixed(2));
            var rsum = parseFloat(to_commssion) + parseFloat(ssss);
            let jk = $('#from_total_balance').val() || 0;
            let temp = jk - rsum;
            console.log(jk);
            console.log(toAmount);
            console.log(temp);
            console.log(rsum);
            $('#profit').val(temp.toFixed(2));
            $('#to_total_balance').val(rsum.toFixed(2));
            let to_current_balance = $('#to_current_balance').val();
            let to_total_balance = $('#to_total_balance').val();
            let to_closing_balance = parseFloat(to_current_balance) - parseFloat(to_total_balance);
            $('#to_closing_balance').val(to_closing_balance.toFixed(2));
        });
    });
    $('#sender_commission').blur(function(){
    let from_commssion = $('#from_commission').val();
    let fromAmount = ($('#from_commission').val() / 1000).toFixed(3) || 0;
    $(this).val(fromAmount);
    let s_commission = range_is(from_commssion,_range);
    let ss_commission = (s_commission.to / 1000);
    let ddd = $('#sending_commsion').val();
    let dddd = ss_commission / ddd;
    $('#sender_commission').val(dddd.toFixed(2));
    var ssum = parseFloat(from_commssion) + parseFloat(dddd);
    let jk = $('#to_total_balance').val() || 0;
    let temp = fromAmount - jk;
    $('#profit').val(temp.toFixed(2));
    $('#from_total_balance').val(ssum.toFixed(2));
    let from_current_balance = $('#from_current_balance').val();
    let form_total_balance = $('#from_total_balance').val();
    let from_closing_balance = parseFloat(from_current_balance) + parseFloat(form_total_balance);
    $('#from_closing_balance').val(from_closing_balance.toFixed(2));
    });

</script>
@endsection

public function get_form_user(Request $request){
        if($request->droup_down_id == "sender"){
            $currentBalance = User::where("id",$request->from_branch_id)->first();
            if(is_null($currentBalance->sender_commission)){
                $data2 = 65;
            }else{
                $data2 = $currentBalance->sender_commission;
            }
        } else {
            $currentBalance = User::where("id",$request->to_branch_id)->first();
            if(is_null($currentBalance->receiving_commission)){
                $data2 = 35;
            }else{
                $data2 = $currentBalance->receiving_commission;
            }
        }
        $data1 = Helper::decimalNumber($currentBalance->current_balance);
        return response()->json([
            'data'              => @$data1,
            'rang'              => @$data2,
        ]);
    }