<?php

$value = '';
if (old($name)) {
    $value = old($name);
} elseif (isset($model) && $model->$name) {
    $value = $model->$name;
}

$attributes['type'] = 'text';
$attributes['class'] = 'form-control';
$attributes['id'] = $name;
$attributes['name'] = $name;
$attributes['value'] = $value;
$preHtml = $posHtml = '';
if (isset($prepend) || isset($append)) {
    $preHtml .= '<div class="input-group"><label class="d-block w-100">'.$label.'</label>';
    unset($label);
}
if (isset($append)) {
    $posHtml .= '<div class="input-group-append">
        <span class="input-group-text">'.$append.'</span>
    </div></div>';
}
if (isset($prepend)) {
    $preHtml .= '<div class="input-group-prepend">
        <span class="input-group-text">'.$prepend.'</span>
    </div>';
    $posHtml = '</div>';
}

if (!isset($wrapClass)) {
    $wrapClass = 'form-group';
}
if (isset($attributes)) {
    $attributes = array_merge($attributes, $attributes);
}

if ($errors->has($name) && isset($attributes['class'])) {
    $attributes['class'] .= ' is-invalid';
} elseif ($errors->has($name) && !isset($attributes['class'])) {
    $attributes['class'] = 'is-invalid';
}

$attrString = '';

foreach ($attributes as $attrKey => $attrValue) {
    $attrString .= "{$attrKey}=\"{$attrValue}\"";
}

?>

<div class="form-group">
    {!! $preHtml !!}
    @if(isset($label))
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
        <input {!! $attrString !!} />

    @if($errors->has($name))
        <div class="invalid-feedback">
        {{ $errors->first($name) }}
        </div>
    @endif

{!! $posHtml !!}
</div>

