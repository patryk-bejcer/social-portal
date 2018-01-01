<form action="{{ url('/posts') }}" method="POST">
    {{ csrf_field()  }}
    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
        <textarea class="form-control" placeholder="Co słychać?" name="content" style="width: 100%" name="" id="" rows="6"></textarea>
        <input style="margin-top:10px;" type="submit" class="btn btn-default pull-right" value="Opublikuj">
        @if ($errors->has('content'))
            <span class="help-block">
                <strong>{{ $errors->first('content') }}</strong>
            </span>
        @endif
    </div>
</form>