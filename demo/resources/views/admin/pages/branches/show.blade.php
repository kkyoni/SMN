<div class="table-responsive">
	{!!Form::model($branches,array('method'=>'post','files'=>true,'route'=>array('admin.branches.updatebalance',$branches->id)))!!}
	<div class="form-group {{ $errors->has('current_balance') ? 'has-error' : '' }}">
		<label class="col-sm-6 col-form-label">
			{!! Form::text('current_balance',null,['class' => 'form-control','id' => 'current_balance']) !!}
		</label>
	</div>
	<div class="modal-footer">
			<button class="btn btn-primary btn-sm" type="submit">Update</button>
		</div>
	{!! Form::close() !!}
</div>