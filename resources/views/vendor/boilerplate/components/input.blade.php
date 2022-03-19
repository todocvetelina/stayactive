@if(empty($name))
<code>
    &lt;x-boilerplate::input>
    The name attribute has not been set
</code>
@else
<div class="form-group{{ isset($groupClass) ? ' '.$groupClass : '' }}"{!! isset($groupId) ? ' id="'.$groupId.'"' : '' !!}>
@isset($label)
    <label>{!! __($label) !!}</label>
@endisset
@if($prepend || $prependText || $append || $appendText)
    <div class="input-group">
@endif
@if($prepend || $prependText)
        <div class="input-group-prepend">
@if($prepend)
            {!! $prepend !!}
@else
            <span class="input-group-text">{!! $prependText !!}</span>
@endif
        </div>
@endif
@if($type === 'password')
    {!! Form::password($name, array_merge(['class' => 'form-control'.$errors->first($name,' is-invalid').(isset($class) ? ' '.$class : '')], $attributes)) !!}
@elseif($type === 'file')
    {!! Form::file($name, array_merge(['class' => 'form-control-file'.$errors->first($name,' is-invalid').(isset($class) ? ' '.$class : '')], $attributes)) !!}
@elseif($type === 'select')
    {!! Form::select($name, $options ?? [], old($name, $value ?? ''), array_merge(['class' => 'form-control'.$errors->first($name,' is-invalid').(isset($class) ? ' '.$class : '')], $attributes)) !!}
@else
    {!! Form::{$type ?? 'text'}($name, old($name, $value ?? ''), array_merge(['class' => 'form-control'.$errors->first($name,' is-invalid').(isset($class) ? ' '.$class : '')], $attributes)) !!}
@endif
@if($append || $appendText)
        <div class="input-group-append">
@if($append)
            {!! $append !!}
@else
            <span class="input-group-text">{!! $appendText !!}</span>
@endif
        </div>
@endif
@if($prepend || $prependText || $append || $appendText)
    </div>
@endif
@if($help ?? false)
    <small class="form-text text-muted">@lang($help)</small>
@endif
@error($name)
    <div class="error-bubble"><div>{{ $message }}</div></div>
@enderror
</div>
@endif
