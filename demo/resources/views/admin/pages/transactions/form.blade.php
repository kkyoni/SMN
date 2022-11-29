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
            'placeholder' => 'Enter Sender Amount'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('sender_commission') ? "".$errors->first('sender_commission')."" : '' }} </font>
            </span>
        </div>
    </div>
    <div class="col-sm-3 b-r">
        <div class="form-group {{ $errors->has('receiver_commission') ? 'has-error' : '' }}">
            <label><strong>RECEIVER COMMISSION</strong></label>
            {!! Form::text('receiver_commission',null,[
            'class' => 'form-control',
            'id'    => 'receiver_commission',
            'placeholder' => 'Enter Receiver Amount'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('receiver_commission') ? "".$errors->first('receiver_commission')."" : '' }} </font>
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
            'placeholder' => 'Enter Receiver Contact'
            ]) !!}
            <span class="help-block">
                <font color="red"> {{ $errors->has('receiver_contact') ? "".$errors->first('receiver_contact')."" : '' }} </font>
            </span>
        </div>
    </div>
</div>
<input type="text" value="" id="sender_branch_commission">
<input type="text" value="" id="reciver_branch_commission">
@section('styles')
@endsection
@section('scripts')
<script>
    // JSON range data get.
    var _range = null;
    $.getJSON("{{ asset('assets/admin/js/range.json') }}", (data) => { _range = data; }).fail(function(){ console.log("An error has occurred."); });
    
    // End.


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
                    $('#sender_branch_commission').val(result.commission);
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
                    $('#reciver_branch_commission').val(result.commission);
                    $('#from_commission').val(0);
                    $('#to_commission').val(0);
                }
            });
        });
        $('#from_commission').blur(function() {
            $("#sender_commission").val(from_commission_set($(this).val(), $("#sender_branch_commission").val()));

            let fromAmount = (this.value / 1000).toFixed(3) || 0;
            $(this).val(fromAmount);
            let jk = $('#to_total_balance').val() || 0;
            let temp = fromAmount - jk;
            $('#profit').val(temp.toFixed(3));
            $('#from_total_balance').val(fromAmount);
            let from_current_balance = $('#from_current_balance').val();
            let form_total_balance = $('#from_total_balance').val();
            let from_closing_balance = parseFloat(from_current_balance) + parseFloat(form_total_balance);
            $('#from_closing_balance').val(from_closing_balance.toFixed(3));
        });
        $('#to_commission').blur(function() {
            $("#receiver_commission").val(from_commission_set($(this).val(), $("#reciver_branch_commission").val()));

            let toAmount = (this.value / 1000).toFixed(3) || 0;
            $(this).val(toAmount);
            let jk = $('#from_total_balance').val() || 0;
            let temp = jk - toAmount;
            $('#profit').val(temp.toFixed(3));
            $('#to_total_balance').val(toAmount);
            let to_current_balance = $('#to_current_balance').val();
            let to_total_balance = $('#to_total_balance').val();
            let to_closing_balance = parseFloat(to_current_balance) - parseFloat(to_total_balance);
            $('#to_closing_balance').val(to_closing_balance.toFixed(3));
        });

        function from_commission_set(commission, branch_commission){
            return (commission * branch_commission) / 100;
        }


    });
</script>
@endsection